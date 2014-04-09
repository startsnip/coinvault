<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/nav.php'; ?>
  <main class="grid">
  <?php $count = 0; ?>
    <?php foreach ($items as $key => $value) { ?>
    <div class="no-gutters item unit one-fifth center-on-mobiles" style="<?php if($count % 5 == 0) { echo 'clear: both;'; } ?>">
      <a href="/dashboard/index.php?action=displayItem&amp;coinID=<?php echo $value['coinID']; ?>" title="<?php echo $value['year'] . " " . $value['coinName']; ?>"><img src="<?php echo $value['coinImage']; ?>" alt="<?php $value['coinName']; ?>"></a>
      <h2 class="show-on-mobiles"><?php echo $value['year'] . " " . $value['coinName']; ?></h2>
    </div>
    <?php $count++; ?>
    <?php } ?>
    <?php if(empty($items)){
      echo "There are no items to display";
    } ?>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>