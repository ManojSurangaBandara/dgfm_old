<?php 
require_once ('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/login.class.php');

$id = isset( $_GET['q'])?$_GET['q']:$id;
if($id == 3 || $id == 10 ){
?>
<table width="100%" border="0">
  <tr>
    <td width="30%" align="right" class="loginText">SFHQ</td>
    <td width="62%">
    <label>
    <select name="cmb_sfhq" id="cmb_sfhq">
      <?php 
	$sfhq = Login :: getSFHQ();
	while($row=mysql_fetch_array($sfhq)){
	
	?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
      <?php } ?>
    </select>
    </label>
    </td>
  </tr>
</table>
<?php 
}
elseif($id == 4){
?>
<table width="100%" border="0">
  <tr>
    <td width="30%" align="right" class="loginText">Branch</td>
    <td width="58%">
    <label>
    <select name="cmb_branch" id="cmb_branch">
      <?php 
	$branches = Login :: getBranches();
	while($row=mysql_fetch_array($branches)){
	
	?>
      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
      <?php } ?>
    </select>
    </label>
    </td>
  </tr>
</table>
<?php 
}
elseif($id == 4){
echo "";	
}
?>