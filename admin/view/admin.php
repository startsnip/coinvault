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
    <h1>Welcome to the administration panel</h1>
    <p>Please be cautious as you make additions and edits. these changes are live the moment the submit button is clicked.</p>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>