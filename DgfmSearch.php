<?php 
	require_once('includes/config.php');
	require_once('classes/db_con.php');
	require_once('classes/common.class.php');
	require_once('classes/projects.class.php');
	


//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");
}

$search_str = "";
$search = $_POST['tags'] ?? "";

$user_id 		= $_SESSION['userID'];
$Isprivilege_user = $_SESSION['Isprivilege_user'];
$log_year	= $_SESSION['log_year'];

//$user_type_id 	= $_SESSION['userType'];
$user_type_id 	= 5;
$status   		= isset( $_GET['status'])?$_GET['status']:0;	
$branch_id 		= isset( $_GET['branch_id'])?$_GET['branch_id']:6;


//$unit_id		  =	isset( $_GET['unitid'])?$_GET['unitid']:1;
//$projType         =	isset( $_GET['projType'])?$_GET['projType']:0;
				




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM - BILLS SETTLEMENT MONITORING SYSTEM </title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    <style media="all" type="text/css">@import "css/style.css";</style>
    
    
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>  
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>  
    
     <script language="JavaScript" type="text/JavaScript" src="js/jquery.min.js"></script>  
    <script language="JavaScript" type="text/JavaScript" src="js/ddaccordion.js"></script>  
      <script language="JavaScript" type="text/JavaScript" src="js/niceforms.js"></script> 
  
    
    <link type="text/css" href="themes/base/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-1.4.1.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="ui/jquery.ui.autocomplete.js"></script>    
	
    
	<link type="text/css" href="demos.css" rel="stylesheet" />
    <?php	

	 
	$project = Common :: GetDGFMBillDetailsToBigUser($status,$branch_id,$user_type_id,$log_year);
	 foreach ($project as $rowproject){
	 
		 if($search_str == ""){
			 $search_str = "'{$rowproject[1]}'";
		 }
		 else{
			 $search_str = $search_str.",'{$rowproject[1]}'";
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
<script type="text/javascript" src="jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
	
</script>


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
				<a href="Units.php" class="button">BACK</a>
               
              <!--  <a href="add_progress_report.php" class="button_r">PROGRESS REPORT </a>-->
				<h1>Home</h1>
				<div class="breadcrumbs">   
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php require_once('messages/project.message.php'); ?></div>
			</div><br />
          <form action="" method="post">
		  <div class="select-bar">
            <div style="height:200px; ">
         
        
        <td>
          <p>&nbsp;</p>
          
        <td>Directorate</td>
           <td><label>         
           
<select name="branch_id" class="ComboBoxcesSmall" id="branch_id" style="width:100px;">
						   
							 <?php 
							$esrunit = Projects::get_all_branches();
							foreach ($esrunit as $rowesrunit) {?>
						     <option value="<?php echo $rowesrunit[0];  ?>" <?php if( $rowesrunit[0] == $branch_id){ echo "selected=selected"; }?> > <?php echo $rowesrunit[1]; ?></option>
						      <?php }?>
            </select>
	    </label> </br></td>
         <td>&nbsp;&nbsp;&nbsp;</td> 
        
Bill No or Sup. Name	
            <span class="ui-widget">
            <input id="tags" type="text" class="textBoxces"size="32" name="tags" />
           
        
            </span>
            <td>&nbsp;&nbsp;&nbsp;&nbsp; <p>&nbsp;</p>
            <p>&nbsp;</p></td> 
             </br>
              Status <select name="billstatus" class="ComboBoxcesSmall" id="billstatus"   style="width:100px;" >
			 <option value="4" <?php if( $status == 4){ echo "selected=selected"; }?>>All</option>
              <option value="0" <?php if( $status == 0){ echo "selected=selected"; }?>>Not Settled</option>
              <option value="1" <?php if( $status == 1){ echo "selected=selected"; }?>>Settled</option>
              <option value="2" <?php if( $status == 2){ echo "selected=selected"; }?>>Canceled</option>
              <option value="3" <?php if( $status == 3){ echo "selected=selected"; }?>>RTN</option>
            </select>
			
			
			    <span class="last">
            <input type="submit"  name="btnsubmit" id="btnsubmit" value="Submit" />            
            </span>
<div class="demo">
  <div class="ui-widget"></div>
</div>
           </td> 
            <td>&nbsp;</td>
           <td>&nbsp;</td>
           
		  </div>
            </div>
          
          
	<?php //-----------------First part-----------------------------------------------------?>	
		      


<?php //-----------------end second part-----------------------------------------------------?>

   </div>
   </form>
		
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>


</body>
</html>

