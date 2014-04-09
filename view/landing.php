<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?> 
  <main class="grid">
    <div class="unit one-fifth"></div>
    <div class="unit three-fifths">
      <form action="/index.php" method="POST" class="basic-grey">
        <h1>Login Below
          <span>Please fill out all fields</span>
          <span class="error"><?php if(!empty($errorMessage)){
            echo "$errorMessage";
          } ?></span>
        </h1>
        <input type="hidden" name="action" value="login">
        <label for="email">
          <span>Your Email:</span>
          <input type="email" name="email" id="email" required value="<?php echo $_COOKIE['email']; ?>">
        </label>
        <label for="password">
          <span>Password:</span>
          <input type="password" name="password" id="password" required>
        </label>
        <label for="storeUser">
          <input type="checkbox" name="storeUser" id="storeUser" <?php if (!empty($_COOKIE['email'])) {echo 'checked';} ?>>Remember Me
        </label>
        <label for="login">
          <span></span>
          <button type="submit" name="login" id="login">Login</button>
        </label> 
      </form>
      <form action="/index.php" method="POST" class="basic-grey">
        <input type="hidden" name="action" value="showSignup">
        <label for="signup">
          <span></span>
          <button type="submit" name="signup" id="signup">Sign Up</button>
        </label>
      </form>
    </div>
    <div class="unit one-fifth"></div>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>