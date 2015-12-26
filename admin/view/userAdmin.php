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
    <h1>User Administration</h1>
    <div class="users">
      <table class="bordered">
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Display Name</th>
          <th>is Admin</th>
          <th>Date Created</th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach ($users as $key => $value) { ?>
        <tr>
          <td><?php echo $value[0]; ?></td>
          <td><?php echo $value[1]; ?></td>
          <td><?php echo $value[3]; ?></td>
          <td><?php echo $value[4]; ?></td>
          <td><?php echo $value[5]; ?></td>
          <td>
          <?php if ($value[4] == 0) { ?>
            <form action="/admin/index.php" method="POST">
              <input type="hidden" name="action" value="promoteUser">
              <input type="hidden" name="email" value="<?php echo $value[1]; ?>">
              <button type="submit">Promote User</button>
            </form>
            <?php } ?>
            <?php if ($value[4] == 1 && $value[1] != $_SESSION['email']) { ?>
            <form action="/admin/index.php" method="POST">
              <input type="hidden" name="action" value="demoteUser">
              <input type="hidden" name="email" value="<?php echo $value[1]; ?>">
              <button type="submit">Demote User</button>
            </form>
            <?php } ?>
          </td>
          <td>
            <?php if ($value[1] != $_SESSION['email']) { ?>
            <form action="/admin/index.php" method="POST">
              <input type="hidden" name="action" value="deleteUser">
              <input type="hidden" name="email" value="<?php echo $value[1]; ?>">
              <button type="submit">Delete User</button>
            </form>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>