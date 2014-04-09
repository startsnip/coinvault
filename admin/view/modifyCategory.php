<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <nav class="grid">
    <ul class="unit whole align-center">
      <li><a href="/admin/index.php?action=userAdmin" title="User Administration">User Administration</a></li>
      <li><a href="/admin/index.php?action=contentAdmin" title="Content Administration">Content Administraton</a></li>
    </ul>
  </nav>
  <main class="grid">
    <div class="unit one-fifth"></div>
    <div class="unit three-fifths">
    <form action="/admin/index.php" method="POST" class="basic-grey">
        <h1>Category Modifications - <?php echo $catName; ?>
          <span>Update Category details below</span>
          <span class="error"><?php if(!empty($errorMessage)){
            echo "$errorMessage";
          } ?></span>
        </h1>
        <input type="hidden" name="action" value="commitCategoryModifications">
        <input type="hidden" name="catID" value="<?php echo $catID; ?>">
        <label for="catName">
          <span>Cat Name:</span>
          <input type="text" name="catName" id="catName" value="<?php echo $catName; ?>" required>
        </label>
        <label for="catDescription">
          <span>Cat Description:</span>
          <input type="text" name="catDescription" id="catDescription" class="description" value="<?php echo $catDescription; ?>" required>
        </label>
        <label for="imageLink">
          <span>Coin Image (URL):</span>
          <input type="text" name="imageLink" id="imageLink" value="<?php echo $catImage; ?>" required>
        </label>
        <label for="submit">
          <span></span>
          <button type="submit" name="submit" id="submit">Submit</button>
        </label> 
      </form>
    </div>
    <div class="unit one-fifth"></div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>