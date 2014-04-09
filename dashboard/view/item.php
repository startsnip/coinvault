<!DOCTYPE html>
<html lang="en-us">
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
  <body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/nav.php'; ?>
  <main class="grid">
    <div class="item" class="unit whole">
      <h1><?php echo $item['year'] . " " . $item['coinName']; ?></h1>
      <p><?php echo $item['coinDescription']; ?></p>
      <img style="width: 200px;" src="<?php echo $item['coinImage']; ?>" alt="<?php echo $item['coinName']; ?>">
    </div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
  </body>
</html>