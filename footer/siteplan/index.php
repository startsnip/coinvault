<?php
if (!is_array($_SESSION)) {
  session_set_cookie_params(60 * 24, '/');
  session_start();
} 
$title = "Site Plan";
?>

<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <main class="grid">
    <div class="unit whole">
      <h1>CIT 336 - Site Plan</h1>
      <p>In progress</p>
    </div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>