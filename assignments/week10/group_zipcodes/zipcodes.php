<?php
require_once __DIR__ . '/functions.php';

// load data
$dataFile = __DIR__ . '/USCities.json';
try {
    $zipMap = readZipData($dataFile);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// handle form
$zip1   = $_POST['zip1']   ?? '';
$zip2   = $_POST['zip2']   ?? '';
$debug  = isset($_POST['debug']);

$info1    = $zip1 ? getZipInfo($zipMap, $zip1) : null;
$info2    = $zip2 ? getZipInfo($zipMap, $zip2) : null;
$distance = ($info1 && $info2)
          ? calculateDistance($info1['lat'], $info1['lng'], $info2['lat'], $info2['lng'])
          : null;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ZIP Code Distance Calculator</title>
  <link rel="stylesheet" href="zipcodes.css">
</head>
<body>
  <h1>ZIP Distance Calculator</h1>
  <form method="post">
    <label>
      ZIP 1:
      <input type="text" name="zip1" value="<?= htmlspecialchars($zip1) ?>" required>
    </label>
    <label>
      ZIP 2:
      <input type="text" name="zip2" value="<?= htmlspecialchars($zip2) ?>" required>
    </label>
    <button type="submit">Compute Distance</button>
    <label class="debug">
      <input type="checkbox" name="debug" <?= $debug ? 'checked' : '' ?>>
      Show Debug Info
    </label>
  </form>

  <?php if ($distance !== null): ?>
    <div class="result">
      Distance: <?= number_format($distance, 2) ?> miles
    </div>
    <section id="debug-section" class="debug-section<?= $debug ? '' : ' hidden' ?>">
      <h2>Debug Information</h2>
      <div class="verify-link">
        Verify on NOAA Great Circle Calculator:
        <a href="https://www.nhc.noaa.gov/gccalc.shtml">
        Latitude/Longitude Distance Calculator
        </a>
      </div>
      <div class="debug-details">
        <div><strong>ZIP 1 Info:</strong> <?= htmlspecialchars(var_export($info1, true)) ?></div>
        <div><strong>ZIP 2 Info:</strong> <?= htmlspecialchars(var_export($info2, true)) ?></div>
        <div><strong>Intermediate Values:</strong>
          <pre><?php
  $rad  = pi()/180;
  $dLat = ($info2['lat'] - $info1['lat'])*$rad;
  $dLng = ($info2['lng'] - $info1['lng'])*$rad;
  $a    = sin($dLat/2)**2 + cos($info1['lat']*$rad)*cos($info2['lat']*$rad)*sin($dLng/2)**2;
  $c    = 2*atan2(sqrt($a), sqrt(1-$a));
  echo "Δlat={$dLat}\nΔlng={$dLng}\na={$a}\nc={$c}";
?></pre>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <script src="debug.js"></script>
</body>
</html>