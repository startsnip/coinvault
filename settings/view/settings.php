<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
	<main class="grid">
		<div class="unit one-fifth"></div>
    <div class="unit three-fifths">
      <form action="/settings/index.php" method="POST" class="basic-grey">
        <h1>Settings for <?php echo $_SESSION['displayName']; ?>
        </h1>
        <h1>
          <span>Change your display name</span>
          <span class="error"><?php if(!empty($errorMessage)){
            echo "$errorMessage";
          } ?></span>
        </h1>
        <input type="hidden" name="action" value="changeDisplayName">
        <label for="displayName">
          <span>Display Name:</span>
          <input type="text" name="newDisplayName" id="displayName" required>
        </label>
        <label for="submit">
          <span></span>
          <button type="submit" name="submit" id="submit">Submit</button>
        </label> 
      </form>
      <form action="/settings/index.php" method="POST" class="basic-grey">
				<h1>
					<span>Change your password</span>
				</h1>
				<input type="hidden" name="action" value="changePassword">
				<label for="currentPassword">
					<span>Current Password: </span>
					<input type="password" name="currentPassword" id="currentPassword" required>
				</label>
				<label for="newPassword">
					<span>New Password: </span>
					<input type="password" name="newPassword" id="newPassword" required>
				</label>
				<label for="newPasswordVerify">
					<span>Verify Your Password: </span>
					<input type="password" name="newPasswordVerify" id="newPasswordVerify" required>
				</label>
				<label for="submit2">
          <span></span>
          <button type="submit" name="submit" id="submit2">Submit</button>
        </label> 
      </form>
    </div>
    <div class="unit one-fifth"></div>
	</main>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>