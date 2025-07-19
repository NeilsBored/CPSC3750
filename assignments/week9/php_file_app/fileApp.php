<!--
  File: fileApp.php
  Author: Shane John
  Date: 2025-07-17
  Course: CPSC 3750 – Web Application Development
  Purpose: Simple-ish frontend interface for PHP File i/o App assignment
  Notes: Please let me know if the cookie acceptance implementation could have been simplified.
-->

<?php
  // Include backend sever logic
  require_once __DIR__ . '../../../../../fileapp/logic.php';
  // Disable Buttons, if cookies are a no-go
  $cookieConsent = $_COOKIE['cookie_consent'] ?? null;
    $disableButtons = ($cookieConsent === 'no');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP I/O File App</title>
  <link rel="stylesheet" href="fileApp.css">
  <link rel="stylesheet" href="../../../main_style.css">
</head>
<body>
  <!-- Common Navbar-->
  <div class="wrapper">
    <?php include '../../../navbar.php'; ?>
  </div >
  <!--Check for need to prompt for cookie permission -->
  <?php if ( ($_COOKIE['cookie_consent'] ?? null) !== 'yes' ): ?>
    <div class="cookie-banner">
      <span>This site uses cookies. Do you accept?</span>
        <button id="acceptCookies">Accept</button>
        <button id="declineCookies">Decline</button>
    </div>
    <!-- Cookie constent button interactions -->
    <script>
      document.getElementById('acceptCookies').addEventListener('click', ()=> 
      {
        document.cookie = 'cookie_consent=yes; path=/; max-age=' + 60*60*24;
        location.reload();
      });
      document.getElementById('declineCookies').addEventListener('click', ()=> 
      {
        document.cookie = 'cookie_consent=no; path=/; max-age=' + 60*60*24;
        document.querySelector('.cookie-banner').style.display = 'none';
      });
    </script>
  <?php endif; ?>
  <!-- Start of Demo Area-->
  <div class="number-sort">
    <h1>FILE I/O DEMO</h1>
    <!-- Sorting and other service messages -->
    <?php foreach ($messages as $msg): ?>
      <div class="message"><?= htmlspecialchars($msg) ?></div>
    <?php endforeach; ?>
      <!-- Message life timer (currently 10secs) -->
      <script>
        window.addEventListener('DOMContentLoaded', () => 
        {
          setTimeout(() => 
          {
            document.querySelectorAll('.message').forEach(el => el.style.display = 'none');
          }, 10000);
        });
      </script>
    <!-- Start of numbers form -->
    <form method="post">
      <!-- Numbers entry-->
      <label for="numbers">
        <h4>Enter Numbers:</h4>
          <p>(separate by comma or space)</p>
      </label><br>
      <textarea id="numbers" name="numbers"><?= $action==='CHECK' ? '' : htmlspecialchars($_POST['numbers'] ?? '') ?></textarea><br>
      <button type="submit" name="action" value="CHECK" <?php if ($disableButtons) echo 'disabled'; ?>>CHECK NUMBERS</button>
      <!-- Application buttons-->
      <div class="buttons">
        <div>
           <!-- Reset number files -->
          <button type="submit" name="action" value="RESET" <?php if ($disableButtons) echo 'disabled'; ?>>RESET</button>
        </div>
         <!-- Sorted number list selection -->
        <button type="submit" name="action" value="PRIME" <?php if ($disableButtons) echo 'disabled'; ?>>PRIME</button>
        <button type="submit" name="action" value="ARMSTRONG" <?php if ($disableButtons) echo 'disabled'; ?>>ARMSTRONG</button>
        <button type="submit" name="action" value="FIBONACCI" <?php if ($disableButtons) echo 'disabled'; ?>>FIBONACCI</button>
        <button type="submit" name="action" value="NONE" <?php if ($disableButtons) echo 'disabled'; ?>>NONE</button>
      </div>
    </form>
    <!-- Sorted number list display-->
    <?php if (!empty($outputNumbers)): ?>
      <div class="results <?= strtolower($action) ?>">
        <?php foreach ($outputNumbers as $num): ?>
          <span class="number <?= strtolower($action) ?>"><?= htmlspecialchars($num) ?></span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    </div>
</body>
</html>
