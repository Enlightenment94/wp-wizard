<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../wp-load.php');

// pobierz listę wszystkich wtyczek
$all_plugins = get_plugins();

// wyświetl listę wszystkich wtyczek
foreach ($all_plugins as $plugin_file => $plugin_info) {
    // wyświetl nazwę wtyczki
    echo $plugin_info['Name'] . '<br>';

    // wyświetl autora wtyczki
    echo 'Autor: ' . $plugin_info['Author'] . '<br>';

    // wyświetl opis wtyczki
    echo 'Opis: ' . $plugin_info['Description'] . '<br>';

    //echo $plugin_info['DomainPath'] . "</br>";

    //echo $plugin_info['AuthorURI'] . "</br>";
    echo "<a href='" . $plugin_info['AuthorURI'] . "'>" . $plugin_info['AuthorURI'] . "</a>";
    echo "</br>";

    $wp_repository_url = 'https://wordpress.org/plugins/';
    //echo $plugin_info['TextDomain'] . "</br>";
    echo "<a href='" . $wp_repository_url . $plugin_info['TextDomain'] . "'>" . $wp_repository_url . $plugin_info['TextDomain'] ."</a>";
    echo "</br>";

    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin_file, false, false);
    echo "<a href='" . $plugin_data['PluginURI'] . "''>". $plugin_data['PluginURI'] ."</a>";
    echo "</br>";

    echo '<hr>';
}
?>