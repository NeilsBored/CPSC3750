<?php

function readZipData(string $file): array {
    if (!file_exists($file)) 
    {

        throw new Exception("Data file not found: $file");
    }

    $json = file_get_contents($file);
    $data = json_decode($json, true);




    if (!is_array($data)) 
    {
        throw new Exception("Invalid JSON in $file");
    }
    
    $map = [];
    foreach ($data as $entry) {
        // JSON:
        // {
        //   "zip_code": "10001",
        //   "latitude": "40.750633",
        //   "longitude": "-73.997177",
        //   ....
        // }



        $zip = $entry['zip_code'];
        $map[$zip] = [
            'lat' => (float)$entry['latitude'],
            'lng' => (float)$entry['longitude'],
        ];
    }
    return $map;
}


function getZipInfo(array $map, string $zip): ?array {
    return $map[$zip] ?? null;

}

function calculateDistance(float $lat1, float $lng1, float $lat2, float $lng2): float {
    $rad = pi() / 180.0;


 $dLat = ($lat2 - $lat1) * $rad;
    $dLng = ($lng2 - $lng1) * $rad;
    $a = sin($dLat/2)**2
       + cos($lat1 * $rad) * cos($lat2 * $rad)
       * sin($dLng/2)**2;
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
$earthRadius = 3958.8; // miles


    return $earthRadius * $c;

}
