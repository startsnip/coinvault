<header class="grid">
  <a class="unit one-fifth hide-on-mobiles" href="/index.php" title="NumisMint">NumisMint</a>
  <ul class="unit four-fifths align-right">
    <?php if($_SESSION['isLoggedIn']) { ?>
      <?php if($_SESSION['isAdmin']) { ?>
      <li><form action="/admin/index.php" method="POST">
        <button type="submit">Admin Panel</button>
      </form></li>
      <?php } ?>
    <li><form action="/settings/index.php" method="POST">
      <button type="submit"><?php echo $_SESSION['displayName']; ?></button>
    </form></li>
    <li><form action="/dashboard/index.php" method="POST">
      <input type="hidden" name="action" value="logout">
      <button type="submit">Logout</button>
    </form></li>
    <?php } else { ?>
    <li><form action="/index.php" method="POST">
      <input type="hidden" name="action" value="showLogin">
      <button type="submit">Login</button>
    </form></li>
    <li><form action="/index.php" method="POST">
      <input type="hidden" name="action" value="showSignup">
      <button type="submit">Sign Up</button>
    </form></li>
    <?php } ?>
  </ul>
</header>