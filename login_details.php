<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
require_once('classes/login_details.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
//$_GET['unitid'] = 3;
$unit_id	      =	isset( $_GET['unitid'])?$_GET['unitid']:'';
$projType         =	isset( $_GET['projType'])?$_GET['projType']:0;
$user_type_select = isset( $_GET['user_type_select'])?$_GET['user_type_select']:false;
$user_type        = isset( $_GET['user_type'])?$_GET['user_type']:1;	
$disabled  		  = isset( $_GET['disabled'])?$_GET['disabled']:'';
$unit_wise		  = isset( $_GET['unit_wise'])?$_GET['unit_wise']:'';
$select_submit	  = isset( $_GET['select_submit'])?$_GET['select_submit']:'';
$user_name		  = isset( $_GET['user_name'])?$_GET['user_name']:'';
$from_date_two	  = isset( $_GET['from_date'])?$_GET['from_date']:'';
$to_date_two	  = isset( $_GET['to_date'])?$_GET['to_date']:'';

if($_SESSION['userType'] != 1 )
{
	header("Location:index.php");
	
}
else
{
	if(($disabled=='') && (($user_type =='1')||($user_type =='')))
	{
		$disabled = 'disabled';
	}
}
//$disabled = 'disabled';


$search_str = "";
$search = $_POST['tags'] ?? '';

//login_details::insert_logouttime();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Directorate of Engineer Service</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
     <style media="all" type="text/css">@import "css/style.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
    
    <link type="text/css" href="themes/base/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.4.1.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.autocomplete.js"></script>
	<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
    
    
    
    
    
    
    
	<link type="text/css" href="demos.css" rel="stylesheet" />
    <?php	
	//echo "hi".$unit_id;
	//echo "mmm".$disabled;	 
	?>
	
    <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
     <script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>
<script language="JavaScript" type="text/JavaScript" src="js/jquery.min.js"></script>  
<script language="JavaScript" type="text/JavaScript" src="js/ddaccordion.js"></script>  
<script language="JavaScript" type="text/JavaScript" src="js/niceforms.js"></script> 
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
				
				<h1>Directorate of Engineering Services</h1>
				<div class="breadcrumbs"></div>
			</div><br />
             <form action="" method="get" enctype="multipart/form-data" name="form1" id="form1">
        
		  <div class="select-bar">
           <div style="height:25px; ">
           </div>
           </div>
           <tr>
           <td>
            
              <table width="77%" border="0">
                <tr>
                  <td width="26%">User Type: </td>
                  <td width="74%"><select name="user_type" class="ComboBoxcesSmall" style="width:100px;" 
           onchange="select_user_type('<?php echo $unit_id; ?>',this.value)">
                <?php $user_types = login_details::get_user_types(); 
			 foreach ($user_types as $row) {
			 
			 ?>
                <option value="<?php echo $row[0]; ?>"<?php if( $row[0] == $user_type){ echo "selected=selected"; }?>>
                <?php echo $row[1]; ?></option>
                <?php }  ?>
              </select>  
            </td>
                </tr>
              <?php   
			  if($disabled!='disabled')
			  {
			  	echo  "<tr>
                  <td>";
             
             
			 
               echo "Unit:";
			   
			 
              echo "</td>";
                  
					echo "<td>";
                 
				 
			 
                  echo"<select name='esr_unit' class='ComboBoxcesSmall' style='width:100px;' id='esr_unit' onchange='unit_wise_user_name(this.value,"."$user_type)'"; if($disabled=='disabled'){echo 'disabled='.$disabled;} echo ">";
                 
							$esrunit = Common :: GetUnitName();
							foreach ($esrunit as $rowesrunit) {
							
                 echo "<option value='"."$rowesrunit[0]'"; if( $rowesrunit[0] == $unit_id){ echo 'selected=selected'; }
				 echo  ">";
                 if(($user_type==1)||($user_type==2)){}else {echo $rowesrunit[1];}
                 echo "</option>";
                  } 
               echo "</select>";
                  
                  
				  
                  echo "</td>
				  </tr>";
				 }
				?>
                <tr>
                  <td>Usename</td>
                  <td><select name="user_name" class="ComboBoxcesSmall" style="width:100px;">
                 <?php 
				 if($disabled=='disabled')
				 {
				 	$user_id_wise = login_details::get_admin_user_names($user_type);
				 }
				 if(($unit_wise=='unit_wise') && ($disabled!='disabled'))
				 {
				 	$user_id_wise = login_details::unit_wise_user_names($user_type, $unit_id);
					echo "jan";
				 }
				 else if(($unit_wise!='unit_wise') && ($disabled!='disabled'))
				 {
				 	$user_id_wise = login_details::unit_wise_user_names($user_type, $unit_id); 
				 }
				 echo "<option value =".'ALL'." >"."ALL"."</option>";
					foreach ($user_id_wise as $row) {
			 
			 ?>
                 <option value="<?php echo $row[1]; ?>"<?php if( $row[1] == $user_name){ echo "selected=selected"; }
				 ?>> <?php echo $row[1]; ?></option>
                 <?php }  ?>
               </select></td>
                </tr>
              
            
              <tr>
              <td><?php echo "From:";?></td>
               <td><span id="sprytextfield1">
                 <input type="text" name="from_date" id="from_date" value="<?php echo $from_date_two;?>"/>
                <span class="textfieldRequiredMsg">*</span></span><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.from_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt="" /></a>               </td>
               <tr>
               <td>
			   			  <?php echo "To:";?>	
               </td>
               <td><span id="sprytextfield2">
                 <input type="text" name="to_date" id="to_date"  value="<?php echo $to_date_two;?>"/>
                 <span class="textfieldRequiredMsg">*</span></span><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.to_date);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date_calander/calbtn.gif" width="34" height="22" border="0" alt="" /></a>              </td>
              </tr>
              <tr>
              <td>
			  			
              </td>
              <td>
              <input type="hidden" name="unitid" id="unitid" value="<?php echo $unit_id; ?>" />
              <input type="hidden" name="select_submit" id="select_submit" value="<?php echo $unit_id; ?>" />
              <input type="hidden" name="projType" id="projType" value="<?php echo $projType; ?>" />
              <input type="hidden" name="user_type_select" id="user_type_select" value="<?php echo $user_type_select; ?>" />
              <input type="hidden" name="user_type" id="user_type" value="<?php echo $user_type; ?>" />
              <input type="hidden" name="disabled" id="disabled" value="<?php echo $disabled; ?>" />
              <input type="hidden" name="unit_wise" id="unit_wise" value="<?php echo $unit_wise; ?>" />
              <input type="hidden" name="select_submit" id="select_submit" value="<?php echo $select_submit; ?>" />
              <input type="hidden" name="user_name_two" id="user_name_two" value="<?php echo $user_name; ?>" />
              <input type="hidden" name="from_date_two" id="from_date_two" value="<?php echo $from_date_two; ?>" />
              <input type="hidden" name="to_date_two" id="to_date_two" value="<?php echo $to_date_two; ?>" />
               
               			<input type="submit" name="" id="" align="left" value="Submit"/>
               </td>
               </tr>
             
        
        
        </table>
        
        
        
        
           
           
          
          
          
	<?php //-----------------First part-----------------------------------------------------?>	

<?php 
	@$max_rec = $_GET["max"] ?? "";
	@$limit = $_GET["limit"] ?? 10;
	@$page_id = $_GET["page"] ?? 0;
	$id = isset($_GET['id'])?trim(@$_GET['id']):'';
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 10;		
	
	if (!$max_rec) 
		{					
			
			$str_today_one = strtotime($from_date_two);
				$today_one = date("y-m-d", $str_today_one);
		     $result = login_details ::display_login_details_2($user_name, $from_date_two, $to_date_two, $unit_id, $user_type,             $today_one);	
			
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				//echo "length".$length = $limit;
			echo '<br>';
			//echo $page_id;
			echo '<br>';
			//echo $limit;
				
				
				$start = ($page_id * $limit);
				$str_today = strtotime($from_date_two);
				$today = date("y-m-d", $str_today);
				
				$result = login_details ::display_login_details_2_page($user_name, $from_date_two, $to_date_two, $start, 	                $limit, $unit_id, $user_type, $today);
					
					if (!$result) return;			 
					$num_rows = count($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;
				
			?>	
				
                <?php //-----------------end first part-----------------------------------------------------?>
                
                		
			<div class="table">
		    <div class="table"> <img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
		      <table class="listing" cellpadding="0" cellspacing="0">
		        <tr>
		          <th class="first" width="20">No </th>
                  <th width="187">User Name</th>
                  <th width="187">Login Time</th>
		          <th width="179">Log Out Time</th>
		          <th class="last "width="179">Login Duration </th>
		          </tr>		
						
						 <?php 
						
						$i = $page_id *10 +1;
						
		  				
						//print_r($row2);
						foreach ($result as $row)
						{
					?>
		        <tr>
		          <td><?php echo $i; ?></td>
		  <td><?php echo $row[3];?></td>     
          <td><?php echo $row[5];?></td>
          <td><?php if($row[6]==0){echo "Not logged out";}else{echo $row[6];}?></td>
          <td><?php //$login_duration = login_details::getDifference(date("Y-m-d G:i:s"), '1980-08-05 00:00:00');
		  			  $login_duration = login_details::getDifference($row[5],$row[6]);
		  				
		  			//while($row2 = mysql_fetch_array($login_duration));
		  			//echo $from_date_two;
					$hours = $login_duration/60;
					$seconds = ($login_duration - (int)$login_duration)*60; 
					$minutes = $login_duration % 60;
					if($login_duration>0)
					{
						if($hours>=1)
						{
							echo "Hrs : ".(int)$hours." ,";
						}
							echo "   "."Mins : ".(int)$minutes." ";
							echo ", Secs : ".(int)$seconds;
					}
					else
					{
						echo "Not lgged out";
					}
					
					?></td>
		          
	            </tr>
		        <?php 
					 $i +=1;
					 } ?>
	          </table>
              
              
              
		     <?php //-----------------second part-----------------------------------------------------?>

<?php
if ($num_rows > 0) {
	?>	
		<table align="center">
		<tr><td align="right">
			<?php
				if ((($page_id * $limit) - ($limit - 1)) > 0) { 
                	  
				?>
				<a href="login_details.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>&user_type_select=<?php echo "$user_type_select"; ?>&disabled=<?php echo "$disabled"; ?>&user_type=<?php echo "$user_type"; ?>&user_name=<?php echo "$user_name"; ?>&from_date=<?php echo "$from_date_two"; ?>&to_date=<?php echo "$to_date_two"; ?>&user_type=<?php echo "$user_type"; ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="login_details.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec);?>&unitid=<?php echo "$unit_id"; ?>&user_type_select=<?php echo $user_type_select; ?>&disabled=<?php echo $disabled; ?>&user_type=<?php echo $user_type; ?>&user_name=<?php echo $user_name; ?>&from_date=<?php echo "$from_date_two"; ?>&to_date=<?php echo $to_date_two; ?>&user_type=<?php echo "$user_type"; ?>">Next &raquo</a>
				
<?php
}
}
?>
</td>
</tr>
</table>

<?php //-----------------end second part-----------------------------------------------------?>
	        </div>          
		  </div>
		</div>
		<div id="right-column">
         </form>
	  </div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>


<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date_calander/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
