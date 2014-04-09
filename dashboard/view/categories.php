<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/nav.php'; ?>
  <main class="grid">
    <?php foreach ($categories as $key => $value) { ?>
    <div class="category unit whole grid center-on-mobiles">
      <img class="unit one-quarter" src="<?php echo $value['imageFront']; ?>" alt="Image of <?php echo $value['catName']; ?>">
      <h2><a href="/dashboard/index.php?action=displayItems&amp;catID=<?php echo $value['catID']; ?>" title="<?php echo $value['catName']; ?>"><?php echo $value['catName']; ?></a></h2>
      <p><?php echo $value['catDescrption']; ?></p>
    </div>
    <?php } ?>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>