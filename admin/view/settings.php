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
      <div class="col-md-12 same-height-panel">
        <h4>Settings for <?php echo $_SESSION['displayName']; ?></h4>
        <form class="form-horizontal well" action="/admin/index.php" method="POST">
          <input type="hidden" name="action" value="changeDisplayName">
          
          <div class="form-group">
            <label for="displayName" required class="col-sm-3 control-label">Enter a new display name: </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="displayName" name="newDisplayName" required placeholder="Fernando">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
              <button type="submit" class="btn btn-primary">Change display name</button>
            </div>
          </div>
        </form> 

        <form class="form-horizontal well" action="/admin/index.php" method="POST">
          <input type="hidden" name="action" value="changePassword">
          
          <div class="form-group">
            <label for="currentPassword" required class="col-sm-3 control-label">Enter your current password </label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
            </div>
          </div>

          <div class="form-group">
            <label for="newPassword" required class="col-sm-3 control-label">Enter your new password </label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>
          </div>

          <div class="form-group">
            <label for="newPasswordVerify" required class="col-sm-3 control-label">Re-enter your new password </label>
            <div class="col-sm-8">
              <input type="password" class="form-control" id="newPasswordVerify" name="newPasswordVerify" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button type="submit" class="btn btn-primary">Change your password</button>
            </div>
          </div>

        </form> 
        <span class="error"><?php if(!empty($errorMessage)){ echo "$errorMessage"; } ?></span>
      </div>
    </div>
  </div>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>