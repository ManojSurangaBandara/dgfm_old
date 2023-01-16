<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}


$billId	=	isset( $_GET['billId'])?$_GET['billId']:billId;
//$progressID =  $_GET['progressID'];
//$ptype =  $_GET['ptype'];
//if this is des should have see all sent and not send progress report

$progressdata = Common :: GetBillDetailsToView($billId);

//$result = ProjectsProgress :: GetBillDetails($billId);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM - VIEW BILL DETAILS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
    <script type="text/javascript" src="javascripts/top_up-min.js"></script>
    <script type="text/javascript">
      TopUp.addPresets({
        "#images a": {
          fixed: 0,
          group: "images",
          modal: 0,
          title: "Example"
        },
        "#movies": {
          resizable: 0
        }
      });
    </script>
</head>
<body>
<div id="main">
	<div id="header">
	  <?php //include ('tpl/topmenu.tpl'); ?>
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
           
            <?php 
            if($_SESSION['userType'] == 1)
            {				
            	echo "<a href=\"admin_home.php\" class=\"button\"> Home</a>";
            }if ($_SESSION['userType'] == 2)
            {            	
				echo "<a href=\"home.php\" class=\"button\"> Home</a>";
            }
			if ($_SESSION['userType'] == 3)
            {            	
				echo "<a href=\"projects.php\" class=\"button\"> Home</a>";
            }
			if ($_SESSION['userType'] == 4)
            {            	
				echo "<a href=\"projects.php\" class=\"button\"> Home</a>";
            }
			
			
            ?>
            
    
		
		
			
			<h1><?php echo $progressdata['Bill_Name']; ?></h1>
			</div><br /><br />
			<br />
            <table width="100%" border="0">
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="10%">
    <table width="100%" border="0">
     
      <tr>
        <td style="font-size:14px" height="20"><strong>Bill No</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Bill_No']; ?></td>
      </tr>
       
      <tr>
       <td style="font-size:14px" height="20"><strong>Bill Amount Rs </strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo number_format($progressdata['Amount'],'2','.',','); ?></td>
      </tr>
      
        <tr>  
         <td style="font-size:14px" height="20"><strong>Bill Recieved Branch</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Branch']; ?></td>
      </tr>
      <tr>  
         <td style="font-size:14px" height="20"><strong>Bill Recieved Unit</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Unit']; ?></td>
      </tr>
      <tr>
        <td style="font-size:14px" height="20"><strong>Bill Recieved Date</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Recieved_Date']; ?></td>
      </tr>   
     
    
      <tr>
        <td style="font-size:14px" height="20"><strong>Bill Status</strong></td>
        <p style="fo"></p>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php if($progressdata['Bill_Status']==1)
							{
							echo '<p style="color:green;">Settled</p>';							
							
							} 
						 if($progressdata['Bill_Status']==0)
							{
							echo '<p align="left" style="color:red;">Not Settled</p>';
							}  
						 if($progressdata['Bill_Status']==2)
							{
							echo '<p><b>Canceled</b></p>';
							}  
						
						
						?></td>
      </tr>
      
      <?php if($progressdata['Bill_Status']==1)	{  ?>
      
      
       <tr>
        <td style="font-size:14px" height="20"><strong>Settled Date</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Bill_Settled_Date']; ?></td>
      </tr> 
      
       <tr>
        <td style="font-size:14px" height="20"><strong>Settled Vote</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['vote_number']; ?></td>
      </tr> 
      
      <?php } ?>
      
      
      <tr>
        <td style="font-size:14px" height="20"><strong>Remarks</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['remarks']; ?></td>
      </tr>    
  
       <tr>
        <?php if($progressdata['Picture'] != ""){?>
         <td style="font-size:14px" height="20"><strong>View Bill</strong></td>
        <td><strong>:</strong></td>
        <td>        
          <a href="uploads/<?php echo $progressdata['Picture']; ?>" toptions="noGroup = 1, layout = dashboard" ><img src="uploads/<?php echo $progressdata['Picture']; ?>" width="120" height="100" /></a>
        <?php }?>
          </td>
      </tr>
      
      
       <?php /*?> <tr>
        <td height="20"><strong>View Bill</strong></td>
        <td><strong>:</strong></td>
        <td> <a href="uploads/<?php echo $progressdata['Picture']; ?>" toptions="noGroup = 1, layout = dashboard"><img src="uploads/<?php echo $progressdata['Picture']; ?>" width="120" height="100" /></a></td>
      </tr><?php */?>
      
     <?php /*?> <tr>
        <td height="20"><strong>Report File</strong></td>
        <td><strong>:</strong></td>
       <td><a href="download.php?filename=<?php echo $progressdata['report_file3']; ?>"><?php echo $progressdata['report_file3']; ?></a></td>
      </tr>
      <?php */?>
      
        
      
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
          
		</div>
		<div id="right-column">
	  </div>
	
	<div id="footer"></div>
   <?php include_once("tpl/footter.tpl");?>
</div>
    
</div>


</body>
</html>
