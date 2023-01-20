

<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/progress_report.class.php');
require_once('classes/common.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
$rid="";
$id		=	isset( $_GET['id'])?$_GET['id']:$id;
if($id !=0 || $id != "id"){
	$result = ProjectsProgress :: GetTembillDetails($id);
	foreach ($result as $rowdata) {
		$rid = $rowdata[0];
		$des = $rowdata[1];
		$amount = $rowdata[2];
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Bills Details</title>
		
    <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>
	<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>
	<body>
     <form action="controller/progress_report.controller.php?mode=tempsave&rid=<?php echo $rid; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0">
                      
        
	 <tr>
			<td class="first" width="172"><strong>Description</strong></td>
			<td class="last">
			<label>
            	<input name="description" type="text" class="textBoxces" id="description" size="45" value="<?php echo $des; ?>" />
            </label>
            </td>
		 
     </tr>
		  
      <tr class="bg">
   			<td class="first"><strong>Amount</strong></td>
			<td class="last"></span><span id="sprytextfield1">
             <label>
             <input type="text" name="amount" id="amount" value="<?php echo number_format($amount,'2','.',','); ?>">
             </label>
             <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
             </td>
		
    </tr>
     

  <tr>
    <td>&nbsp;</td>
     <td class="last">
     <input type="submit" name="btnsubmit" id="btnsubmit" value="Add" />
	</td>
    
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
  <tr>
		          <th width="20" class="first" align="left">Id</th>
		          <th width="500" align="left">Description</th>
		          <th width="200" align="left">Amount</th>		          
		          <th width="100" align="left">Edit</th>		        
		          <th width="100" align="left" class="last">Delete</th>
	   </tr>
		      
		        <?php 
						
						$id= "id";
						$result = ProjectsProgress :: GetTembillDetails($id);
						foreach ($result as $row)
						{
					?>
		        <tr>
		          <td width="20" align="left"><?php echo $row[0]; ?></td>         
		          <td width="500" align="left"><?php echo $row[1]; ?></td>
		          <td width="200" align="left"><?php echo number_format($row[2],'2','.',','); ?></td>
		       
		        <td width="100" align="left"><a href="BillsDetails.php?id=<?php echo $row[0];?>"><img src="images/edit-icon.gif" width="16" height="16" alt="" /></a></td>                
                	<td width="100"  align="left"><a onClick="deletetembills('<?php echo $row[0];?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td>              
		        
	            </tr>
		        <?php 
					 $i +=1;
					 } ?>
                     
                  <tr></td></tr>  <tr></td></tr>  
                   <tr></td></tr>  <tr></td></tr> 
                    <tr></td></tr>   <tr></td></tr>  
                    <tr></td></tr>  <tr></td></tr>  
                   <tr></td></tr>  <tr></td></tr> 
                    <tr></td></tr>   <tr></td></tr> 
                    
                
                     
</table>
    <script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "currency");
//-->
        </script>
        
        </form>
</body>
</html>