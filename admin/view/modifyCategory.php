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
      <h4>Currently modifying the <?php echo $catName; ?> category</h4>
        <form action="/admin/index.php" method="POST" class="form-horizontal well">
          <span class="error"><?php if(!empty($errorMessage)){echo "$errorMessage";} ?></span>
          <input type="hidden" name="action" value="commitCategoryModifications">
          <input type="hidden" name="catID" value="<?php echo $catID; ?>">
          
          <div class="form-group">
            <label for="catName" class="col-sm-2 control-label">Category Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="catName" name="catName" value="<?php echo $catName; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="catDescription" class="col-sm-2 control-label">Category Description</label>
            <div class="col-sm-10">
              <textarea class="form-control vresize" rows="10" id="catDescription" name="catDescription" required><?php echo $catDescription; ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="imageLink" class="col-sm-2 control-label">Category Image (URL)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="imageLink" name="imageLink" value="<?php echo $catImage; ?>" required>
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