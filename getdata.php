<?php 
require_once ('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/login.class.php');

$id = isset( $_GET['q'])?$_GET['q']:$id;
if($id == 3 || $id == 10 ){
	$sfhq = Login :: getSFHQ();
  ?>
  <label for="cmb_sfhq" style="transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);opacity: 0.65;">SFHQ</label>
                <select name="cmb_sfhq" id="cmb_sfhq" class="form-control">
                      
               
  <?php
  foreach ($sfhq as $row) 
  {
	?>
    <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
  <?php 
  }
  ?>
  </select>
  <?php
}
elseif($id == 4){
?>
  <label for="cmb_sfhq" style="transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);opacity: 0.65;">Branch</label>
    <select name="cmb_branch" id="cmb_branch" class="form-control">
      <?php 
	$branches = Login :: getBranches();
  foreach ($branches as $row) {
	
	?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
      <?php } ?>
    </select>
    </label>

<?php 
}
elseif($id == 4){
echo "";	
}
?>