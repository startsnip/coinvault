<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <div class="container page-header">
    <div class="row">
      <h2 class="col-sm-12"><?php echo $catName; ?></h2>
    </div>
    <div class="row">
      <img class="col-sm-2 img-responsive" src="<?php echo $catImage; ?>" alt="Image of <?php echo $catName; ?>">
      <p class="col-sm-10"><?php echo $catDescription; ?></p>
    </div>
  </div> <!-- !container -->

  <?php foreach ($items as $key => $value) { ?>
  <div class="container well">
    <div class="row">
      <h2 class="col-sm-12"><?php echo $value['year']; ?> <?php echo $value['coinName']; ?></h2>
    </div>
    <div class="row">
      <img class="col-sm-2 img-responsive" src="<?php echo $value['coinImage']; ?>" alt="Image of <?php echo $value['coinName']; ?>">
      <p <?php if($_SESSION['isAdmin']) echo 'class="col-sm-7"'; else echo 'class="col-sm-10"'; ?>><?php echo $value['coinDescription']; ?></p>
      <?php if($_SESSION['isAdmin']) { ?>
        <div class="col-sm-3">
          <form action="/admin/index.php" method="POST">
            <div class="form-group">
              <input type="hidden" name="action" value="modifyCoin">
              <input type="hidden" name="coinID" value="<?php echo $value[0]; ?>">
              <input type="hidden" name="activeTab" value="<?php echo $activeTab; ?>">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Modify Coin</button>
            </div>
          </form>
          <form action="/admin/index.php" method="POST">
            <div class="form-group">
              <input type="hidden" name="action" value="deleteCoin">
              <input type="hidden" name="coinID" value="<?php echo $value[0]; ?>">
              <input type="hidden" name="catID" value="<?php echo $catID; ?>">
              <input type="hidden" name="activeTab" value="<?php echo $activeTab; ?>">
              <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="return confirm('Are you sure that you want to delete this coin? This is not reversable!')">Delete Coin</button>
            </div>
          </form>
        </div>
      <?php } ?>
    </div>
  </div> <!-- !container -->
  <?php } ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <?php if($_SESSION['isAdmin']) { ?>
        <form action="/admin/index.php" method="POST">
            <input type="hidden" name="action" value="showAddCoin">
            <input type="hidden" name="catID" value="<?php echo $catID; ?>">
            <input type="hidden" name="activeTab" value="<?php echo $activeTab; ?>">
            <button class="btn btn-primary btn-lg" type="submit">Add Coin</button>
        </form>
      <?php } ?>
      </div>
    </div>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>