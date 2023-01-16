<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');

//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}


$id	=	isset( $_GET['id'])?$_GET['id']:$id;
$data 	= Common :: GetAddress($id);

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
<form>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;
<input type="button" style="font-size:24px" value="REGISTERED POST" onClick="window.print()">
</form>
<table border="0">

<tr>
	<td align="left" width="700"><u>FROM</u></td>
    <td width="100">&nbsp;</td>
    <td width="800"><u>TO</u> </td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;DIRECTOR FINANCE</td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['Sup_Name']; ?> </upper></td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;DIRECTORATE OF FINANCE</td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['address_line1']; ?> </upper></td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;ARMY HEADQUARTERS</td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['address_line2']; ?> </upper></td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;SRI JAYAWARDANAPURA</td>
    <td>&nbsp;</td>
    <td><upper>&nbsp;&nbsp;&nbsp;<?php echo $data['address_line3']; ?> </upper></td>
</tr>

<tr>
	<td>&nbsp;&nbsp;&nbsp;COLOMBO</td>
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