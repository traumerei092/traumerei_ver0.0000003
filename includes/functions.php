<?php
function getDataForStore($store) {
    $data = [
        'names' => [],
        'ages' => [],
        'movies' => [],
        'sports' => [],
        'hobbies' => []
    ];

    if (($file = fopen("data/{$store}.csv", "r")) !== FALSE) {
        while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
            $data['names'][] = $row[0];
            $data['ages'][] = $row[1];
            $data['movies'][] = $row[2];
            $data['sports'][] = $row[3];
            $data['hobbies'][] = $row[4];
        }
        fclose($file);
    }
    return $data;
}
?>
