<?php

require 'vendor/autoload.php';

function report($filePath){
    $apiKey = "dc4a63733feaf4f3a351dc01fbef58fac12e6a611c9cceee18cc9801c4580fb2";
    $apiKey = "4b53d1b76e237b75dbc7f251ad8cd2f2b030dfaaa5020ac28661b20f1d931ae1";

    $apiUrl = "https://www.virustotal.com/vtapi/v2/file/report";
    $fileHash = hash_file("sha256", $filePath);
    $params = array(
        "apikey" => $apiKey,
        "resource" => $fileHash
    );
    $response = file_get_contents($apiUrl . '?' . http_build_query($params));
    $report = json_decode($response);
    $encode = json_decode($response, true);
    $responseCode = $encode['response_code'];
    echo "response_code: " . $responseCode . "</br>";
    if (isset($report->positives) && $report->positives > 0) {
        echo $filePath . " : " . "malicious"  . " : " .$report->positives . "</br>\n";
    } elseif($responseCode == 0) {
        echo $filePath . " : " . "queue" . "</br>\n";
    } elseif($responseCode == -2) {
        echo $filePath . " : " . "analyst" . "</br>\n";
    }else{
        echo $filePath . " : " . "clean" . "</br>\n";
    }
    $guiLink = "https://www.virustotal.com/gui/file/" . $fileHash . "/detection";

    echo "<a href='" . $guiLink . "'>" . $guiLink . "</a></br>";
    // teraz $encode jest tablicą PHP, więc wykorzystamy to, aby uzyskać response_code
    //echo json_encode($report, JSON_PRETTY_PRINT);
    return $responseCode;
} 

function scanVt($filePath){
    $responseCode = report($filePath);
    echo "</br>";
    if($responseCode == 0){
        $client = new \GuzzleHttp\Client();

        $api_key = '4b53d1b76e237b75dbc7f251ad8cd2f2b030dfaaa5020ac28661b20f1d931ae1'; 

        $url = 'https://www.virustotal.com/vtapi/v2/file/scan';

        $response = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name' => 'apikey',
                    'contents' => $api_key
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen($filePath, 'r'),
                    'filename' => basename($filePath)
                ]
            ]
        ]);

        $body = $response->getBody();
        //echo $body;
        //echo "</br>";

        //$responseCode = report($filePath);
    }else{
        return "";
    }
}

function scanVtLarg($filePath){
    $apiKey = "dc4a63733feaf4f3a351dc01fbef58fac12e6a611c9cceee18cc9801c4580fb2";
    $apiKey = "4b53d1b76e237b75dbc7f251ad8cd2f2b030dfaaa5020ac28661b20f1d931ae1";
    $apiUrl = "https://www.virustotal.com/vtapi/v2/file/scan";
    $fileSize = filesize($filePath);
    $fileHandle = fopen($filePath, "r");
    $fileContent = fread($fileHandle, $fileSize);
    fclose($fileHandle);
    $boundary = '--------------------------' . time();
    $header = "Content-Type: multipart/form-data; boundary={$boundary}";
    $postData = "--{$boundary}\r\n" .
                "Content-Disposition: form-data; name=\"apikey\"\r\n\r\n" .
                "{$apiKey}\r\n" .
                "--{$boundary}\r\n" .
                "Content-Disposition: form-data; name=\"file\"; filename=\"{$filePath}\"\r\n" .
                "Content-Type: application/octet-stream\r\n\r\n" .
                "{$fileContent}\r\n" .
                "--{$boundary}--\r\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (!$response) {
        echo "Error: " . curl_error($ch);
    } else {
        $json = json_decode($response);
        $resource = $json->resource;
        $reportUrl = "https://www.virustotal.com/gui/file/{$resource}/detection";
        echo "File was uploaded: {$filePath}\n";
        echo "Report URL: {$reportUrl}\n";
    }
    curl_close($ch);
}