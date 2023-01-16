<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');

//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}


$id	=	isset( $_GET['id'])?$_GET['id']:$id;
$data 	= Common :: GetRegAccAddress($id);
$sfhq_id 		= $_SESSION['sfhqID'];

switch($sfhq_id){
	
	case 1:
	$sfhq="SECURITY FORCE HEADQUARTERS(WEST)";
	$sfhq_place="PANAGODA";
	$other_adds1="ARMY CANTONMENT";	
	$other_adds2="PANAGODA";
	break;
	
	case 2:
	$sfhq="SECURITY FORCE HEADQUARTERS(WANNI)";
	$sfhq_place="ANURADHAPURA";
	$other_adds1=" ";
	$other_adds2=" ";
	break;
	
	case 3:
	$sfhq="SECURITY FORCE HEADQUARTERS(EAST)";
	$sfhq_place="MINNERIYA";
	$other_adds1=" ";
	$other_adds2=" ";
	break;
	
	case 4:
	$sfhq="SECURITY FORCE HEADQUARTERS(JAFFNA)";
	$sfhq_place="JAFFNA";
	$other_adds1=" ";
	$other_adds2=" ";
	break;
	
	case 5:
	$sfhq="SECURITY FORCE HEADQUARTERS(KILLINOCHCHI)";
	$sfhq_place="KILINOCHCHI";
	$other_adds1=" ";
	$other_adds2=" ";
	break;
	
	case 6:
	$sfhq="SECURITY FORCE HEADQUARTERS(MULLAITIVU)";
	$sfhq_place="MULAITIVU";
	$other_adds1=" ";
	$other_adds2=" ";
	break;
	
	case 7:
	$sfhq="SECURITY FORCE HEADQUARTERS(CENTRAL)";
	$sfhq_place="DIYATALAWA";
	$other_adds1=" ";
	$other_adds2=" ";
	break;
	
	default :
	$sfhq="Wrong";
	
}


?>





<html>  
<head>  
<style>   
   
@page { size: 9in 4in }  
   
#content {  
width: 892px;  
height: 392px;  
border: none;  
Padding: 24px;  
font-size: 12pt;  
font-family: arial;  
   
/* for firefox, safari, chrome, etc. */  
-webkit-transform: rotate(0deg);  
-moz-transform: rotate(0deg);  
/* for ie */  
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);   
}  
</style>  
</head>  
   
<body> 

 <form>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;<input type="button" value="REGISTERED POST" onClick="window.print()">
</form>

<table border="0">

<tr>
	<td width="700"><u>FROM</u></td>
    <td width="100">&nbsp;</td>
    <td width="800"><u>TO</u> </td>
</tr>

<tr>
	<td><upper>&nbsp;&nbsp;&nbsp;THE ACCOUNTANT</upper></td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['Sup_Name']; ?> </upper></td>
</tr>

<tr>
	<td><upper>&nbsp;&nbsp;&nbsp;REGIONAL ACCOUNT OFFICE - <?php echo $sfhq_place; ?> </upper></td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['address_line1']; ?> </upper></td>
</tr>

<tr>
	<td><upper>&nbsp;&nbsp;&nbsp;<?php echo $sfhq; ?></upper></td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['address_line2']; ?> </upper></td>
</tr>

<tr>
	<td><upper>&nbsp;&nbsp;&nbsp;<?php echo $other_adds1; ?></upper></td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['address_line3']; ?> </upper></td>
</tr>

<tr>
	<td><upper>&nbsp;&nbsp;&nbsp;<?php echo $other_adds2; ?></upper></td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['address_line4']; ?> </upper></td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;</td>
</tr>


<tr>
<td colspan="3"> File Reference : <?php   echo $data['fileref'] ." & Number : ".$data['chkno'] ; ?> </td>
  
</tr>



</table>




   
</body>  
</html>  