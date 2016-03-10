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
      <h4>Adding a new coin to the <?php echo $catName; ?> category</h4>
        <form action="/admin/index.php" method="POST" class="form-horizontal well">
          <span class="error"><?php if(!empty($errorMessage)){echo "$errorMessage";} ?></span>
          <input type="hidden" name="action" value="addCoin">
          <input type="hidden" name="catID" value="<?php echo $catID; ?>">
          <input type="hidden" name="activeTab" value="<?php echo $activeTab; ?>">
          
          <div class="form-group">
            <label for="coinName" class="col-sm-2 control-label">Coin Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="coinName" name="coinName" required>
            </div>
          </div>

          <div class="form-group">
            <label for="coinDescription" class="col-sm-2 control-label">Coin Description</label>
            <div class="col-sm-10">
              <textarea class="form-control vresize" rows="10" id="coinDescription" name="coinDescription" required></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="imageLink" class="col-sm-2 control-label">Coin Image (URL)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="imageLink" name="imageLink" required>
            </div>
          </div>

          <div class="form-group">
            <label for="year" class="col-sm-2 control-label">Coin Year</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="year" name="year" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="submitMore" value="false" class="btn btn-primary">Save this coin</button>
              <button type="submit" name="submitMore" value="true" class="btn btn-primary">Save this coin and add more</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>