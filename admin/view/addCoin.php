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
        <h1>New Coin
          <span>Enter the new coin details below</span>
          <span class="error"><?php if(!empty($errorMessage)){
            echo "$errorMessage";
          } ?></span>
        </h1>
        <input type="hidden" name="action" value="addCoin">
        <input type="hidden" name="catID" value="<?php echo $catID; ?>">
        <label for="coinName">
          <span>Coin Name:</span>
          <input type="text" name="coinName" id="coinName" value="<?php echo $coinName; ?>" required>
        </label>
        <label for="coinDescription">
          <span>Coin Description:</span>
          <input type="text" name="coinDescription" id="coinDescription" class="description" value="<?php echo $coinDescription; ?>" required>
        </label>
        <label for="imageLink">
          <span>Coin Image (URL):</span>
          <input type="text" name="imageLink" id="imageLink"value="<?php echo $coinImage; ?>" required>
        </label>
        <label for="year">
          <span>Coin Image (URL):</span>
          <input type="text" name="year" id="year" value="<?php echo $year; ?>" required>
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