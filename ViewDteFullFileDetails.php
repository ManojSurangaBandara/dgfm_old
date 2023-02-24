<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}


$billId	=	isset( $_GET['billId'])?$_GET['billId']:$billId;
$user_type_id = $_SESSION['userType'];
$branch_id		=	isset( $_GET['branch_id'])?$_GET['branch_id']:$branch_id;
$status			=	isset( $_GET['status'])?$_GET['status']:$status;
$vote_id =  isset( $_GET['vote_id'])?$_GET['vote_id']:$vote_id;
$alloc   = isset( $_GET['alloc'])?$_GET['alloc']:0;




/*switch ($branch_id) {
    case 8:
       $branch_id='8 || 3';
        break;
    case 60:
        $branch_id='60 || 3';
        break;
    case 37:
        $branch_id='37 || 3';
        break;
	case 63:
        $branch_id='63 || 3';
        break;
    default:
        $branch_id = $branch_id;	
}*/



$progressdata = Common :: GetDteDetailsToPsoView($billId,$user_type_id);


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
			<!--<a href="#" class="link"> Related Links</a>	-->	
		</div>
		<div id="center-column">			
            <div class="top-bar">
           
             <?php 
         
				echo "<a href=\"ViewFullDetailsforPSO.php?status=".$status."&branch_id=".$branch_id."&vote_id=".$vote_id."&alloc=".$alloc."\" class=\"button\"> BACK</a>";
           
            ?>
			<h1>Bill Details for the Year of <?php echo $_SESSION['log_year']; ?></h1>
			</div><br /><br />
			<br />
            <table width="100%" border="0">
  <tr>
    <td width="1%">&nbsp;</td>
    <td width="10%">
    <table width="100%" border="0">
     
      <tr>
        <td style="font-size:14px" height="20"><strong>Account Office</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px">Directorate of Finance</td>
      </tr>

      <tr>
        <td style="font-size:14px" height="20"><strong>Bill No</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Bill_No']; ?></td>
      </tr>

        <tr>
        <td style="font-size:14px" height="20"><strong>Invoice No</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Invoice_No']; ?></td>
      </tr>
      
       <tr>
        <td style="font-size:14px" height="20"><strong>Invoice Date</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Invoice_date']; ?></td>
      </tr>  
     
      
        <tr>
        <td style="font-size:14px" height="20"><strong>G-35 No</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['G35_No']; ?></td>
      </tr>
      
        <tr>
        <td style="font-size:14px" height="20"><strong>G-35 Date</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['G35_Date']; ?></td>
      </tr>
      
      <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
       <tr>
        <td style="font-size:14px" height="20"><strong>Supplier Name</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Sup_Name']; ?></td>
      </tr>
      
        <tr>
        <td style="font-size:14px" height="20"><strong>Supplier Address</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Hm_address']; ?></td>
      </tr>
         
         <tr>
        <td style="font-size:14px" height="20"><strong>Supplier Contact No</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Contact_no']; ?></td>
      </tr>   
         
        <tr>
        <td style="font-size:14px" height="20"><strong>VAT No</strong></td>
        <td><strong>:</strong></td>
        <td style="font-size:14px"><?php echo $progressdata['Vat_No']; ?></td>
      </tr>    
          
       <tr>
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
          
            
         <tr>  
         <td style="font-size:14px" height="20"><strong>Bill Ref No</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Bill_ref_no']; ?></td>
      </tr> 
      
        <tr>  
         <td style="font-size:14px" height="20"><strong>Bill Received Branch</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['branch_name']; ?></td>
      </tr>
      
      <tr>
        <td style="font-size:14px" height="20"><strong>Bill Received Date</strong></td>
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
							
							 if($progressdata['Bill_Status']==3)
							{
							echo '<p><b>Returned</b></p>';
							}  
						
						
						
						?></td>
      </tr>
      
      <?php if($progressdata['Bill_Status']==1)	{  ?>
      
      
       <tr>
        <td style="font-size:14px" height="20"><strong>Settled Date</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['Bill_Settled_Date']; ?></td>
      </tr>      
      
      
      <?php } ?>
      
            <?php if($progressdata['Bill_Status']==3)	{  ?>
      
      
       <tr>
        <td style="font-size:14px" height="20"><strong>Return Date</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['rtn_date']; ?></td>
      </tr>      
      
         <tr>
        <td style="font-size:14px" height="20"><strong>Return Reason</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['rtn_reason_detail']; ?></td>
      </tr>      
      
      
      <?php } ?>
      
      
      <tr>
        <td style="font-size:14px" height="20"><strong>Remarks</strong></td>
        <td><strong>:</strong></td>
         <td style="font-size:14px"><?php echo $progressdata['remarks']; ?></td>
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


<table width="725" cellpadding="0" cellspacing="0" class="listing">   

 			<tr>
					<th width="46"  class="first">No</th>					
					<th width="158" >Vote Code</th>
                    <th width="399" >Vote Name</th>
                    <th width="145" class="last"=>Amount</th>
            </tr>
            
            
            
             <?php 
			 $result = ProjectsProgress :: GetBillAmountandVotes($billId,$progressdata['Bill_No']);
					 $total=0;	
						$i=1;
						foreach ($result as $row2) 
						{
							$total= $total+ $row2[2];	
					?>
                  
					<tr>
						<td><?php echo $i; ?></td>         
						<td align="left"><?php echo $row2[3]; ?></td>   
                        <td align="left"><?php echo $row2[4]; ?></td> 
        				<td align="right"><?php echo  number_format($row2[2],'2','.',','); ?></td>					
					</tr>
                     <?php 
					 $i +=1;
					 } ?>
                     
                     
             	<tr >
                 		
					  <td colspan="3" class="first"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total</strong></td>
					  <td class="last"><strong><?php echo number_format($total,'2','.',','); ?></strong></td>
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
