<?php 
if(!$_SESSION['isLoggedIn'] || !$_SESSION['isAdmin']) {
  header('Location: /index.php');
}
?>

<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
      <h4>Currently modifying the <?php echo $year; echo $coinName; ?> coin</h4>
        <form action="/admin/index.php" method="POST" class="form-horizontal well">
          <span class="error"><?php if(!empty($errorMessage)){echo "$errorMessage";} ?></span>
          <input type="hidden" name="action" value="commitCoinModifications">
          <input type="hidden" name="coinID" value="<?php echo $coinID; ?>">
          <input type="hidden" name="catID" value="<?php echo $catID; ?>">
          <input type="hidden" name="activeTab" value="<?php echo $activeTab; ?>">

          <div class="form-group">
            <label for="coinName" class="col-sm-2 control-label">Coin Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="coinName" name="coinName" value="<?php echo $coinName; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="coinDescription" class="col-sm-2 control-label">Coin Description</label>
            <div class="col-sm-10">
              <textarea class="form-control vresize" rows="10" id="coinDescription" name="coinDescription" required><?php echo $coinDescription; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="imageLink" class="col-sm-2 control-label">Coin Image (URL)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="imageLink" name="imageLink" value="<?php echo $coinImage; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="year" class="col-sm-2 control-label">Coin Year</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="year" name="year" value="<?php echo $year; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Commit Changes</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>