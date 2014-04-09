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
    <main>
    <h1>Content Administration - Coins</h1>
    <div class="items">
      <table class="bordered">
        <tr>
          <th>Coin ID</th>
          <th>Coin Name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Year</th>
          <td></td>
          <td></td>
        </tr>
        <?php foreach ($coins as $key => $value) { ?>
        <tr>
          <td><?php echo $value[0]; ?></td>
          <td><?php echo $value[2]; ?></td>
          <td><?php echo $value[3]; ?></td>
          <td><img src="<?php echo $value[4]; ?>" alt="<?php echo $value[2]; ?>"></td>
          <td><?php echo $value[5]; ?></td>
          <td>
            <form action="/admin/index.php" method="POST">
              <input type="hidden" name="action" value="modifyCoin">
              <input type="hidden" name="coinID" value="<?php echo $value[0]; ?>">
              <input type="hidden" name="catID" value="<?php echo $carID; ?>">
              <button type="submit">Modify Item</button>
            </form>
          </td>
          <td>
            <form action="/admin/index.php" method="POST">
              <input type="hidden" name="action" value="deleteCoin">
              <input type="hidden" name="coinID" value="<?php echo $value[0]; ?>">
              <input type="hidden" name="catID" value="<?php echo $catID; ?>">
              <button type="submit">Delete Item</button>
            </form>
          </td>
        </tr>
        <?php } ?>
      </table>
      <form action="/admin/index.php" method="POST" class="align-center">
        <input type="hidden" name="action" value="showAddCoin">
        <input type="hidden" name="catID" value="<?php echo $catID; ?>">
        <button type="submit">Add Coin</button>
      </form>
    </div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>