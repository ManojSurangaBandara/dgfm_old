<!--<h3>Menu</h3>
<br/>
<div class="sidebarmenu">
            <?php 
		$menu1 = Common :: GetMenu($_SESSION['userType']);
		while($row=mysql_fetch_array($menu1)){
	
		?>
                <a class="menuitem submenuheader link" href="<?php echo $row[2]; ?>"><?php echo $row[1]; ?></a>
                <div class="submenu">
                    <ul >
                    <?php 
                    $menu2 = Common :: GetSubMenu($row[0]);
                    while($subrow=mysql_fetch_array($menu2)){                
                    ?> 
                  
                    <li><a href="<?php echo $subrow[2]; ?>"><?php echo $subrow[1]; ?></a></li>                    
                    
                    <?php } ?>
                    </ul>
                </div>
          <?php } ?>
            </div>
-->

<h3>Menu</h3>
			<ul class="nav">
				<?php 
		$menu = Common :: GetMenu($_SESSION['userType']);
		while($row=mysql_fetch_array($menu)){
	
		?>
                <li><a href="<?php echo $row[2]; ?>"><?php echo $row[1]; ?></a></li>
          <?php } ?>
				<li class="last"></li>
			</ul>
            
            
            
