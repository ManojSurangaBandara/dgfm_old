<?php 
 
	//	$thisYear       =   date('Y');
	//	$log_year		=    $thisYear;
	
	//	$_SESSION['log_year'] 	= $log_year;
	

//	$log_year		=   isset( $_POST['cmb_allocated_year'])?$_POST['cmb_allocated_year']:$thisYear;	
		
		//$log_year	    = $_SESSION['log_year'];
	@session_start();	
		
require_once ('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/login.class.php');



if(isset($_SESSION['adminid']))
{
	session_unset();
	session_destroy();	
	 
						
						 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<link REL="SHORTCUT ICON" HREF="themes/images/omcrm_icon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DGFM :: BSMS</title>
<link rel="stylesheet" type="text/css" href="css/main.css">

<script type="text/javascript">

function showuser(str)
{
	
if (str=="")
  {
	 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getdata.php?q="+str,true);
xmlhttp.send();
}
	
	

	
</script>
</head>
<body style="padding:0; margin:0;">
<br>
<br>
<br>
<br>
<br><br>
<div align="center">	
  <table border="0" cellpadding="0" cellspacing="0" width="700">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
	</table>
	<!-- key to check session_out in Ajax key=s18i14i22a19 -->
	<!-- Login Starts -->
	<table border="0" cellspacing="0" cellpadding="0" width=700 class="tblborder_l" >
		<tr>
			<td colspan="2" align="right" class="login_h">&nbsp;</td>
		</tr>
		<tr>
			<td width="50%" align="center" class="bottumbg ">

				<img src="images/banner1.jpg" width="300" height="278">
			</td>
	       		<td width="50%" align="center" class="bottumbg2">
						<!-- Sign in form -->
				<br>
				<form method="post" action="controller/login.controller.php?mode=login" enctype="application/x-www-form-urlencoded">
				
					<table border="0" cellpadding="0" cellspacing="0" width="80%" class="loginTable2">
					
					<tr>
						<td class="small">
						<div id="error" align="center">
            
 					 <?php require_once('messages/login.messages.php');  ?>    
                     
						</div>
							<br>
							<table border="0" cellpadding="5" cellspacing="0" width="100%">
							<tr>
								<td width="42%" align="right" class="loginText">User Name</td>
								<td width="58%" align="left" class="small">
		        <input name="user" size="20" align="left" type="text" id="user">
	         </td>
							</tr>
							<tr>
								<td width="42%" align="right" class="loginText">Password</td>
							  <td width="58%" align="left" class="small"><input name="pass" size="20" align="left" type="password" id="pass" /></td>
							</tr>
							<tr>
								<td class="loginText" align="right" width="42%">User Type</td>
								<td class="small" align="left" width="58%">
                              
                                <select name="cmb_type" id="cmb_type" onChange="showuser(this.value)">
							  <?php 						  
							   
                            $user_Type = Login :: getUserType();
                            while($row=mysql_fetch_array($user_Type)){
                       
                            ?>
                              <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                           
                               
                              <?php }  ?>
                            </select>
                            </td>
							</tr>
                            <tr>
								<td colspan="2" align="left" class="small" id="txtHint">&nbsp;</td>
							  </tr>
                            
                            <tr>
								<td class="loginText" align="right" width="42%">Year</td>
								<td class="small" align="left" width="58%">
                              
				      <label>
					      <select name="cmb_allocated_year" id="cmb_allocated_year" style="width:110px"  class="ComboBoxces" >
					        <?php 
							  
							  $thisYear       =   date('Y');
							  
							for($i=$thisYear; $i>2011; $i--){
							?>
					        <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
					        <?php }  ?>
				          </select>
				      </label>
</td>
							</tr>
                            
							
														<tr>
								<td class="small">&nbsp;</td>
								<td class="small"><input title="Login [Alt+L]" alt="Login [Alt+L]" accesskey="Login [Alt+L]" src="images/btnSignInNEW.gif" type="image" name="Login" value="  Login  "  tabindex="5"></td>
							</tr>
						  </table>
					  </td>
					</tr>
					</table>
					<br><br>
				</form>
			</td>
		</tr>
	</table>
</div>
<style type="text/css">

body{
	background-image:none; /* remeove the background image from the 1st page in base tamplate*/
}
</style><!-- stopscrmprint --><style>
		.bggray
		{
			background-color: #dfdfdf;
		}
	.bgwhite
	{
		background-color: #FFFFFF;
	}
	.copy
	{
		font-size:9px;
		font-family: Verdana, Arial, Helvetica, Sans-serif;
	}
	</style>
		<br><br><br><table border=0 cellspacing=0 cellpadding=5 width=100% class=settingsSelectedUI style='padding:5px;	background:url(include/images/settingsSelUIBg.gif) repeat-x; background-position:25px; background-color:#ffffff;' height='50'><tr>
		    <td align=center class=small><span style='color: rgb(153, 153, 153);'>Copyright <?php echo date('Y');?> © Sri Lanka Army.  All rights reserved.</td>
		    </tr></table>		<script>
			var userDateFormat = "";
			var default_charset = "UTF-8";
		</script>
<!--end body panes-->
</td></tr>
<tr><td colspan="2" align="center">
</td></tr></table>
</body>
</html>
