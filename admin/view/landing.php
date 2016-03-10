<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
  <div class="container main">
    <div class="row">
      <div class="col-md-12 same-height-panel well">
        <h4>Speak Friend and Enter</h4>
        <form class="form-horizontal" action="/admin/index.php" method="POST">
          <input type="hidden" name="action" value="login">
          
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
              <input type="email" class="form-control" id="email" name="email" required placeholder="John.Smith@NewWorld.net" value="<?php echo $_COOKIE['email']; ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-6">
              <input type="password" class="form-control" id="password" name="password" required placeholder="Pocahontis">
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label for="storeUser">
                  <input type="checkbox" name="storeUser" id="storeUser"<?php if (!empty($_COOKIE['email'])) {echo 'checked';} ?>> Remember me
                </label>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </div>
          
          <span class="error"><?php if(!empty($errorMessage)){
            echo "$errorMessage";
          } ?></span>
        </form>
      </div>
    </div>
  </div>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>