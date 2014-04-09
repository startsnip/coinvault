<nav class="grid">
  <ul class="unit whole align-center">
  	<li><a href="/index.php" title="home">Home</a></li>
    <?php foreach ($categories as $key => $value) { ?>
      <li><a href="/dashboard/index.php?action=displayItems&amp;catID=<?php echo $value['catID']; ?>" title="<?php echo $value['catName']; ?>"><?php echo $value['catName']; ?></a></li>
    <?php } ?>
  </ul>
</nav>