<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}


$SupId	=	isset( $_GET['SupId'])?$_GET['SupId']:SupId;

$progressdata = Common :: GetAllSupplierDetails($SupId);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM - BSMS</title>
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
			<!--<a href="#" class="link"> Related Links</a>-->		
		</div>
		<div id="center-column">			
            <div class="top-bar">
           
           <a href="Suppliers.php" class="button">&lt;&lt; Back</a>
			<h1>Supplier Details</h1>
			</div><br /><br />
			<br />
            <table width="100%" border="0">
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="86%">
    <table width="95%" border="0">
     
<?php /*?>      <tr>
        <td width="32%" height="26" style="font-size:14px"><strong>Supplier Code</strong></td>
        <td width="3%"><strong>:</strong></td>
        <td width="65%" style="font-size:14px"><?php echo $progressdata['Sup_Code']; ?></td>
      </tr>
     
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr><?php */?>
      
       <tr>
        <td width="32%" height="26" style="font-size:14px" height="20"><strong>Supplier Name</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Sup_Name']; ?></td>
      </tr>
        
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <?php if($progressdata['is_vehicle']==1){   ?>
      
      
      
       <tr>
        <td style="font-size:14px" height="20"><strong>Vehicle No</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['civil_veh_no']; ?></td>
      </tr>
      
          <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
        <tr>
        <td style="font-size:14px" height="20"><strong>NIC Number</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['nic']; ?></td>
      </tr>
        
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
         <tr>
        <td style="font-size:14px" height="20"><strong>Vehicle Running Place</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['veh_Place']; ?></td>
      </tr>
        
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
     <?php }   ?>
            
        <tr>  
         <td style="font-size:14px" height="20"><strong>Address </strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['address_line1']." ".$progressdata['address_line2']." ".$progressdata['address_line3']." ".$progressdata['address_line4']; ?></td>
      </tr> 
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
        <tr>  
         <td style="font-size:14px" height="20"><strong>Mobile No</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['mobile']; ?></td>
      </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
          <tr>  
         <td style="font-size:14px" height="20"><strong>Land Phone No</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Contact_no']; ?></td>
      </tr>
      
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
       <tr>  
         <td style="font-size:14px" height="20"><strong>E Mail Address</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Email_Add']; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
       <tr>  
         <td style="font-size:14px" height="20"><strong>VAT Registered No</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['vat_no']; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
            
      <tr>
        <td style="font-size:14px" height="20"><strong>Bank Name</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Bnk_Code']; ?></td>
      </tr>   
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
         
        <tr>
        <td style="font-size:14px" height="20"><strong>Account No</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Act_No']; ?></td>
      </tr>  
     
    
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
         <tr>
        <td style="font-size:14px" height="20"><strong>Bank Branch</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['bnk_loc_id']; ?></td>
      </tr>   
      
          <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
         <tr>
        <td style="font-size:14px" height="20"><strong>Created User</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php
		 
		 switch($progressdata['sfhq_id']){
			
			case 0:
			$val="Directorate of Finance";
			break; 
			
			case 1:
			$val="SFHQ (WEST)";
			break;
			
			case 2:
			$val="SFHQ (W)";
			break;
			
			case 3:
			$val="SFHQ (E)";
			break;
			
			case 4:
			$val="SFHQ (J)";
			break;
		
			case 5:
			$val="SFHQ (KLN)";
			break;
			
			case 6:
			$val="SFHQ (MLT)";
			break;
			
			case 7:
			$val="SFHQ (C)";
			break;
			
			default :
			$val="Directorate of Finance";
			break;
			
			 
		 }
		 
		 
		 
		 
		 
		  echo $progressdata['Name']." - ".$val; ?></td>
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
    <td width="10%">&nbsp;</td>
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
