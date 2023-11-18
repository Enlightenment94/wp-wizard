<form action='scanerVT.php'>
    <input type='text' name='pvt' value='' />
    <input type='submit' value='scanVt' />
</form>

<?php
if(isset($_GET['pvt'])){
    $apiKey = "dc4a63733feaf4f3a351dc01fbef58fac12e6a611c9cceee18cc9801c4580fb2";
    $apiUrl = "https://www.virustotal.com/vtapi/v2/file/report";
    $filePath = $_GET['pvt'];
    $fileHash = hash_file("sha256", $filePath);
    $params = array(
        "apikey" => $apiKey,
        "resource" => $fileHash
    );
    $response = file_get_contents($apiUrl . '?' . http_build_query($params));
    $report = json_decode($response);
    if ($report->positives > 0) {
        echo "Uploaded file is potentially malicious.";
        echo $filePath . " : " .$report->positives . "\n";
    } else {
        echo "Uploaded file is clean.";
    }
    //echo json_encode($report, JSON_PRETTY_PRINT);
}
?>