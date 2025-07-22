<!--
  File: zipcodes.php
  Author: Shane John
  Date: 2025-07-19
  Course: CPSC 3750 – Web Application Development1
  Purpose: Frontend page for zipcode distance assignment         
  Notes:  - Fun fact, the magority of the time spent on this assignment
            was spent figuring out a workable way to geo-code.
          - I used JSON data for this assignment, the instructions say to "find a free data file" 
            without specificing a type...hope that's okay.
-->

<?php
    // Include for PHP controller functions
    require_once __DIR__ . '/zipcodes_model.php';

    // Set zipcode data location
    $zipData = __DIR__ . '/USCities.json';
    // Little extra error catching for a little extra testing
    try
    {
        //load zipcode data
        $zipMap = readZipData($zipData);
    }
    catch ( Exception $readFail)
    {
        die("Error: " . $readFail->getMessage());
    }
    // 
    $zip1 = $_POST['zip1'] ?? '';
        $zipRecord1 = $zip1 ? getZipRecord($zipMap, $zip1) : null;
    $zip2 = $_POST['zip2'] ?? '';
       $zipRecord2 = $zip2 ? getZipRecord($zipMap, $zip2) : null;
    
    $distance = ($zipRecord1 && $zipRecord2) ? findDistance($zipRecord1['lat'], $zipRecord1['lng'], $zipRecord2['lat'], $zipRecord2['lng']) :null;
    $debug = isset($_POST['debug']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>ZIP Code Distance Calculator</title>
    <link rel="stylesheet" href="../../../main_style.css">
    <link rel="stylesheet" href="zipcodes.css">
</head>
<body>
  <!-- Common Navbar -->
  <div class="wrapper">
      <?php include '../../../navbar.php'; ?>
  </div >
  <!-- Distance Calculater -->
  <div class="zip-container">
    <h1>Zipcode Distance Calculator</h1>
    <!-- Zipcodes Entry Form-->
    <form method="post">
      <div class="row">
        <!-- Inputs for Zipcodes -->
        <div class="zip-inputs">
          <div>
            <label for="zip1"> START ZIP </label>
            <input type="text" name="zip1" value="<?= htmlspecialchars($zip1) ?>" required>
          </div>
          <div> 
            <label for="zip2"> END ZIP </label>
            <input type="text" name="zip2" value="<?= htmlspecialchars($zip2) ?>" required>
          </div>
        </div>
        <!-- User Interactions -->
        <div class="actions">
          <button type="submit"><b>Compute Distance</b></button>
          <div class="debug" >
            <input type="checkbox" name="debug" <?= $debug ? 'checked' : '' ?>>
            <label for="debug">Debug Info </label>
          </div>
        </div>
      </div>
    </form>

    <?php if ($distance !== null): ?>
  

    <div class="distance-display">
      <div class="location">
        <h4><?= htmlspecialchars($zipRecord1['city'] . ', ' . $zipRecord1['state']) ?></h4>
        <h5><?= htmlspecialchars($zipRecord1['county']) ?></h5>
      </div>
      <div class="result">
        <h3>Distance: <?= $distance[5] ?> miles</h3>
        <div class="distance-line" style="width: <?= $distance[5] ?>px;"></div>
      </div>
      <div class="location">
        <h4><?= htmlspecialchars($zipRecord2['city'] . ', ' . $zipRecord2['state']) ?></h4>
        <h5><?= htmlspecialchars($zipRecord2['county']) ?></dh5>
      </div>  
    </div>
  </div>

      <section id="debug-section" class="debug-section<?= $debug ? '' : ' hidden' ?>">
      <h2>Debug Information</h2>
      <div class="debug-details">
        <div><b>ZIPCODE 1:</b> <?= htmlspecialchars(var_export($zipRecord1, true)) ?></div>
        <div><b>ZIPCODE 2:</b> <?= htmlspecialchars(var_export($zipRecord2, true)) ?></div>
        <div><b>Intermediate Values:</b>
          <pre><?php
              $dLat = $distance[1];
              $dLng = $distance[2];
              $a = $distance[3];
              $c = $distance[4];
              echo "  Δlatitude = {$dLat}\n  Δlongitude = {$dLng}\n  a = {$a}\n  c = {$c}";
          ?></pre>
           <div class="verify-link">
            <b>Verify On NOAA Great Circle Calculator:</b>
            <a href="https://www.nhc.noaa.gov/gccalc.shtml">Latitude/Longitude Distance Calculator</a>
            </div>
             <div class="source-link">
            <b>Review Zipcode Data Soure:</b>
            <a href="https://github.com/millbj92/US-Zip-Codes-JSON/blob/master/USCities.json">US-Zip-Codes-JSON</a>
            </div>
        </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
  <script src="debug.js"></script>
</body>
</html>