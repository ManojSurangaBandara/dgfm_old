<ul id="top-navigation">
    <!--<li class="active"><span><span><a href="home.php">Home</a></span></span></li>-->
        <?php 
		$menu = Common :: GetMenu($_SESSION['userType']);
        foreach ($menu as $row) {
	
		?>
       <li><span><span><a href="<?php echo $row[2]; ?>"><?php echo $row[1]; ?></a></span></span></li>
      <?php } ?>
	  </ul>