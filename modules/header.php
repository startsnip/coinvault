<body>

<header>
  <nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/index.php">CoinVault</a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="collapse-1">
        <ul class="nav navbar-nav">
          <li <?php if($activeTab == 0) echo 'class="active"' ?>><a href="/index.php" title="home">Home</a></li>
          <?php foreach ($categories as $key => $value) { ?>
            <li <?php if($activeTab == ($key+1)) echo 'class="active"' ?>><a href="/dashboard/index.php?action=displayCoins&amp;catID=<?php echo $value['catID']; ?>&amp;activeTab=<?php echo ($key+1); ?>" title="<?php echo $value['catName']; ?>"><?php echo $value['catName']; ?></a></li>
          <?php } ?>
        </ul>
        <?php if($_SESSION['isLoggedIn'] && $_SESSION['isAdmin']) { ?>
        <ul class="nav navbar-nav navbar-right">
            <li><p class="navbar-text">! - Administration Mode - Please edit responsibly - !</p>
            <li><a href="/admin/index.php?action=userSettings"><?php echo $_SESSION['displayName']; ?></a></li>
            <li><a href="/admin/index.php?action=logout">Logout</a></li>
        </ul>
        <?php } ?>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav>
</header>
