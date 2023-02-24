<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/progress_report.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}
if($_SESSION['userType'] != 2 )
{
	header("Location:index.php");
}
$unit_id		  =	isset( $_GET['unitid'])?$_GET['unitid']:1;
$projType         =	isset( $_GET['projType'])?$_GET['projType']:0;

$search_str = "";
$search = $_POST['tags'] ?? "";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Directorate of Engineer Service</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>
    
    <link type="text/css" href="themes/base/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.4.1.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="ui/jquery.ui.autocomplete.js"></script>
	<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
	<link type="text/css" href="demos.css" rel="stylesheet" />
    <?php	 
	$project = Common :: GetProjectNames($unit_id,$projType);
	 foreach ($project as $rowproject){
	 
		 if($search_str == ""){
			 $search_str = "'{$rowproject[1]}'";
		 }
		 else{
			 $search_str = $search_str.",'{$rowproject[1]}'"; 	// stripslashes()
		 }
		 
	 }
	 
	?>
<script type="text/javascript">
	$(function() {
			   
			   
		var availableTags = [<?php echo $search_str; ?>];		
		$("#tags").autocomplete({
			source: availableTags
		});
	});
	</script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
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
		  <p><a href="#" class="link"> Related Links</a></p>
		  <p>&nbsp;</p>
        </div>
		<div id="center-column">
			<div class="top-bar">
				
				<h1>Directorate of Engineer Service </h1>
				<div class="breadcrumbs"></div>
			</div><br />
             <form action="" method="post">
             
             
		  <div class="select-bar">
           <div style="height:25px; ">
           <td>CES Unit:</td>
           <td align="justify"><label>
             <select name="esr_unit" class="ComboBoxcesSmall" style="width:70px;" id="esr_unit" onchange="getProjTypeDES(this.value,'<?php echo $projType; ?>')">
               <?php 
							$esrunit = Common :: GetUnitName();
							foreach ($esrunit as $rowesrunit) {
							?>
               <option value="<?php echo $rowesrunit[0]; ?>" <?php if( $rowesrunit[0] == $unit_id){ echo "selected=selected"; }?>><?php echo $rowesrunit[1]; ?></option>
               <?php } ?>
             </select>
           </label></td>
             <td></td>
        
        
        
           
        <td>
Project Name or Job Number:	
            <span class="ui-widget">
            <input id="tags" type="text" class="textBoxces"size="30" name="tags" />
           
            <span class="last">
            <input type="submit"  name="btnsubmit" id="btnsubmit" value="      Submit      " />
            </span></span>  
            
            </td>
        
         <td></td>
            <td>Status:</td>
           <td><label>         
           
<select name="ProjType" class="ComboBoxcesSmall" id="ProjType"  onchange="getProjTypeDES('<?php echo $unit_id; ?>' ,this.value)" style="width:100px;" >
						   
			<option value="0" <?php if( $_GET['projType'] == 0){ echo "selected=selected"; }?>>Running</option>
            <option value="1" <?php if( $_GET['projType'] == 1){ echo "selected=selected"; }?>>Completed</option>
             <option value="2" <?php if( $_GET['projType'] == 2){ echo "selected=selected"; }?>>Canceled</option>
						      
	          </select>
	    </label> </td>
        
        
        <td></td>
        
        
        
           
          </div>
           </div>
          
          
	<?php //-----------------First part-----------------------------------------------------?>	
		      
<?php 
	
	@$max_rec = $_GET["max"];
	@$limit = $_GET["limit"];
	@$page_id = $_GET["page"];	
	$id = trim(@$_GET['id']);
		
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 10;		
	
	if (!$max_rec) 
		{					
			$result = Common :: GetDesHomePage($unit_id,$search,$projType);		
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				$length = $limit;
				
				$result = Common :: GetDesHomePagePagination($unit_id,$search,$projType,$current1, $length);				
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
		          <th class="first" width="20">No</th>
                  <th width="80">Job Number</th>
		          <th width="400">Project Name</th>                  
		          <th width="250">Location</th>
		          <!--<th width="74"> Start Date</th>-->
		       <!--   <th width="110">End Date</th>-->
		         <!-- <th width="86">Project Type</th>-->
		         <!-- <th width="185" >Description</th>-->
		          <th width="30" class="last">View</th>
	            </tr>		
						
						 <?php 
						
						$i = $page_id *10 +1;
						foreach ($result as $row)
						{
					?>
		        <tr>
		          <td><?php echo $i; ?></td>
                  <td><?php echo $row[9]; ?></td>
		      
          <td><a href="DESViewProgressReport.php?projectID=<?php echo $row[0];?>&projname=<?php echo $row[1]; ?>&ptype=<?php echo $row[8]; ?>"><?php echo $row[1]; ?></a></td>
		          <td><?php echo $row[2]; ?></td>
		       <?php /*?><!--   <td><?php echo $row[3]; ?></td>--><?php */?>
		         
             <?php /*?>   <!--  <td><?php echo $row[4]; ?></td>--><?php */?>
                  
		        <?php /*?><!--  <td><?php echo $row[5]; ?></td>--><?php */?>
		         <?php /*?><!-- <td><?php echo $row[6]; ?></td>		--><?php */?>         
                  <td><a href="display_project.php?projectID=<?php echo $row[0];?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></td>
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
				<a href="home.php?&page=<?php echo($page_id - 1); ?>&unitid=<?php echo "$unit_id"; ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="home.php?page=<?php echo($page_id + 1); ?>&projectID=<?php echo $project_id; ?>&max=<?php echo($max_rec)?>&unitid=<?php echo "$unit_id"; ?>">Next &raquo</a>
				
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
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>
