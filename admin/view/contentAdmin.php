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
    <h1>Content Administration - Categories</h1>
    <div class="categories">
      <table class="bordered">
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($categories as $key => $value) { ?>
        <tr>
          <td><?php echo $value[0]; ?></td>
          <td><a href="/admin/index.php?action=showCoinList&amp;catID=<?php echo $value[0]; ?>" title="Show <?php echo $value[2]; ?> list"><?php echo $value[1]; ?></a></td>
          <td><?php echo $value[2]; ?></td>
          <td><img src="<?php echo $value[3]; ?>" alt="<?php echo $value[1]; ?>"></td>
          <td>
            <form action="/admin/index.php" method="POST">
              <input type="hidden" name="action" value="modifyCategory">
              <input type="hidden" name="catID" value="<?php echo $value[0]; ?>">
              <button type="submit">Modify Category</button>
            </form>
          </td>
          <td>
            <form action="/admin/index.php" method="POST">
              <input type="hidden" name="action" value="deleteCategory">
              <input type="hidden" name="catID" value="<?php echo $value[0]; ?>">
              <button type="submit">Delete Category</button>
            </form>
          </td>
        </tr>
        <?php } ?>
      </table>
      <form action="/admin/index.php" method="POST" class="align-center">
        <input type="hidden" name="action" value="showAddCategory">
        <button type="submit">Add Category</button>
      </form>
    </div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>