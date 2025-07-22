<?php 
/* 
  File: zipcodes_model.php
  Author: Shane John
  Date: 2025-07-19
  Course: CPSC 3750 – Web Application Development
  Purpose: Server side logic for zipcode distance assignment         
  Notes: With the benefit of hindsight, I should have focus more on the debug printout first.
*/

function readZipData ($fileName) : array
{
    //File Error Checker
    if (!file_exists($fileName))
    {
        throw new Exception(" Zipcodes File ( $fileName ) not found");
    }
    $jsonData = file_get_contents($fileName);
    $fileData = json_decode($jsonData, true);

    // Load Zipcode Data into array
    $dataMap = [];
    foreach ($fileData as $zipRecord)
    {
        $zipcode = $zipRecord['zip_code'];
        $dataMap[$zipcode] = 
        [
            'lat' => (float)$zipRecord['latitude'],
            'lng' => (float)$zipRecord['longitude'],
            'city' => $zipRecord['city'],
            'state' => $zipRecord['state'],
            'county' => $zipRecord['county']
        ];
    }
    return $dataMap;
}

// Key-Value Get For A Zipcode
function getZipRecord($dataMap, $zipcode) : ?array 
{
    return $dataMap[$zipcode] ?? null;
}
// Haversine formula Plus
function findDistance(float $lat1, float $lng1, float $lat2, float $lng2) : array
{   
    //Radian conversion
    $rad = pi() / 180.0;
    //Earth's radius (Normal miles)
    $earthRadius = 3958.8;
    //Zipcode Data Array
    $distanceData=[];

    // The Great-Circle Distance Calculations (Normal Miles)
    $dLat = ($lat2 - $lat1) * $rad;
    $dLng = ($lng2 - $lng1) * $rad;
    $a = (sin($dLat/2)**2)
       + (cos($lat1 * $rad) * cos($lat2 * $rad))
       * (sin($dLng/2)**2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    // Debug Package
    $distanceData[0] = $earthRadius * $c;
    $distanceData[1] = $dLat;
    $distanceData[2] = $dLng;
    $distanceData[3] = $a;
    $distanceData[4] = $c;
    $distanceData[5] = round($distanceData[0]);

    return $distanceData;
}