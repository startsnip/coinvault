<?php
if(!is_array($_SESSION)){
  session_set_cookie_params(60 * 24, '/');
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en-us">
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
  <body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <main>
    <div>
      <h2> <?php echo $errorMessage; ?> </h2>
    </div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
  </body>
</html>