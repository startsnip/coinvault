<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <?php foreach ($categories as $key => $value) { ?>
  <div class="container well">
    <div class="row">
      <h2 class="col-sm-12"><a href="/dashboard/index.php?action=displayCoins&amp;catID=<?php echo $value['catID']; ?>&amp;activeTab=<?php echo ($key+1); ?>" title="<?php echo $value['catName']; ?>"><?php echo $value['catName']; ?></a></h2>
    </div>
    <div class="row">
      <img class="col-sm-2 img-responsive" src="<?php echo $value['imageFront']; ?>" alt="Image of <?php echo $value['catName']; ?>">
      <p <?php if($_SESSION['isAdmin']) echo 'class="col-sm-7"'; else echo 'class="col-sm-10"'; ?>><?php echo $value['catDescrption']; ?></p>
      <?php if($_SESSION['isAdmin']) { ?>
        <div class="col-sm-3">
          <form action="/admin/index.php" method="POST">
            <div class="form-group">
              <input type="hidden" name="action" value="modifyCategory">
              <input type="hidden" name="catID" value="<?php echo $value[0]; ?>">
              <input type="hidden" name="activeTab" value="<?php echo ($key+1); ?>">
              <button class="btn btn-primary btn-lg btn-block" type="submit">Modify Category</button>
            </div>
          </form>
          <form action="/admin/index.php" method="POST">
            <div class="form-group">
              <input type="hidden" name="action" value="deleteCategory">
              <input type="hidden" name="catID" value="<?php echo $value[0]; ?>">
              <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="return confirm('Are you sure that you want to delete this category? This is not reversable!')">Delete Category</button>
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
            <input type="hidden" name="action" value="showAddCategory">
            <button class="btn btn-primary btn-lg" type="submit">Add Category</button>
        </form>
      <?php } ?>
      </div>
    </div>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>