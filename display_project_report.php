<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$unit_id	=	isset( $_GET['unitid'])?$_GET['unitid']:1;
$project_id =  $_GET['projectID'];

$projdata = Common :: GetProject($project_id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Progress Report</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
	  <?php //include ('tpl/topmenu.tpl');?>
	</div>
	<div id="middle">
		<div id="left-column">
			<?php include ('tpl/log_out.tpl');?>
            <p></p>
            <?php include ('tpl/left_munu.tpl');?>
		<a href="#" class="link"> Related Links</a>		
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="admin_home.php" class="button"> Home</a>
				<h1><?php echo $projdata['project_name']; ?></h1>
			</div><br /><br />
			<br />
            <table width="100%" border="0">
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="93%"><table width="100%" border="0">
      <tr>
        <td width="35%" height="20"><strong>Project Reference ID  </strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="62%"><?php echo $projdata['project_reference_id']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project Name </strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_name']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project Allocated Amount</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_allocated_amount']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project Start Date</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_start_date']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project End Date</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_end_date']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project Location</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_location']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Date of Tender Called</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tender_called']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Date of Tender Opened</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tender_opened']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Date of Tec Appointed</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tec_appointed']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Date of tb Appointed</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['date_of_tb_appointed']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Name of Contractor</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['name_of_contractor']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Awarded Date</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['awarded_date']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Extension Given</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['extension_given']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>ESR Unit</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['unit_name']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project Allocated Stations</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_location']; ?></td>
      </tr>
      <tr>
        <td height="20"><strong>Project Description</strong></td>
        <td><strong>:</strong></td>
        <td><?php echo $projdata['project_Description']; ?></td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="6%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
		</div>
		<div id="right-column">
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
