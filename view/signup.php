<!DOCTYPE html>
<html lang="en-us">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/head.php'; ?>
<body>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?> 
  <main class="grid">
    <div class="unit one-fifth"></div>
    <div class="unit three-fifths">
      <form action="/index.php" method="POST" class="basic-grey">
        <h1>Sign up for a free account
          <span>Please fill out all fields</span>
          <span class="error"><?php if(!empty($errorMessage)){
            echo "$errorMessage";
          } ?></span>
        </h1>
        <input type="hidden" name="action" value="createAccount">
        <label for="email">
          <span>Your Email:</span>
          <input type="email" name="email" id="email" required value="<?php echo $_COOKIE['email']; ?>">
        </label>
        <label for="password">
          <span>Password: (8 Characters)</span>
          <input type="password" name="password" id="password" required>
        </label>
        <label for="passowrdVerify">
          <span>Verify your password:</span>
          <input type="password" name="passwordVerify" id="passwordVerify" required>
        </label>
        <label for="displayName">
          <span>Display Name:</span>
          <input type="text" name="displayName" id="displayName" required>
        </label>
        <label for="submit">
          <span></span>
          <button type="submit" name="submit" id="submit">Create your account</button>
        </label> 
      </form>
    <?php if(!empty($errorMessage)){
      echo "<p>$errorMessage</p>";
    } ?>
  </main>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php'; ?>
</body>
</html>