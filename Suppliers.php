<?php 
require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/vote.class.php');
require_once('classes/projects.class.php');
//session_start();
if(!isset($_SESSION['userID'])){
header("Location:index.php");

}

$sfhq_id 	= $_SESSION['sfhqID'];
$user_type_id = $_SESSION['userType'];

$veh_type 	= isset( $_GET['veh_type'])?$_GET['veh_type']:2;

$search_str = "";
$search = $_POST['tags'] ?? "";

$path="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
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
	
   <script type="text/javascript" >
   function getvehtype(veh_type){
	document.location.href="Suppliers.php?veh_type="+veh_type;                                     
	}
   </script>
    
	<link type="text/css" href="demos.css" rel="stylesheet" />
   
   <?php /*?> <?php		 
	$project = Projects :: get_all_Suplier($sfhq_id);
	 foreach ($project as $rowproject){
	 
		 if($search_str == ""){
			 $search_str = "'{$rowproject[1]}'";
		 }
		 else{
			 $search_str = $search_str.",'{$rowproject[1]}'";
		 }
	 }
	 
	?><?php */?>
    
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
			
		</div>
		<div id="center-column">
			<div class="top-bar">
                &nbsp; &nbsp; &nbsp;
               <!-- <a href="SupplierDetailExporter.php?brach_id=2&newSup_id=1"  class="button">SLY</a>-->
        
				
                <?php if($user_type_id !=9){ ?>
                <a href="New_Supplier.php" class="button">ADD NEW </a>
                <?php } ?>
                 
                 
                <!-- <a href="excel/DownloadSupList.php" class="button">DOWNLOAD </a>   -->
                
                
				<h1>Registered Suppliers - <?php echo $_SESSION['log_year'];  ?></h1>
				<div class="breadcrumbs"></div>
			</div><br />
             <form action="" method="post">
		  <div class="select-bar">
		   <div id="error" align="left" style="height:25px;">
		     <td align="left" ><?php require_once('messages/vote.message.php'); ?></td>
                     <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
Supplier Name	
          <td align="right">  <span class="ui-widget">
            <input id="tags" type="text" class="textBoxces"size="20" name="tags" />
           
            <span class="last" >
            <input type="submit"  name="btnsubmit" id="btnsubmit" value="Submit" />            
            </span> 
            
            <td>
            
            
               <td>&nbsp;&nbsp; Type</td> 
            
             <select name="billstatus" class="ComboBoxcesSmall" id="billstatus"  onchange="getvehtype(this.value)" style="width:120px;" >
        <option value="2" <?php if( $veh_type == "2"){ echo "selected=selected"; }?>>All</option>    
        <option value="1" <?php if( $veh_type == "1"){ echo "selected=selected"; }?>>Vehicle</option>  
       <option value="0" <?php if( $veh_type == "0"){ echo "selected=selected"; }?>>Not a vehicle</option>            
            </select>
            
            
            
		   </div>
               

        
		  </div>
          
     
          
          
          
          
          <?php //-----------------First part-----------------------------------------------------?>	
		      
<?php 
	
	@$max_rec = $_GET["max"];
	@$limit = $_GET["limit"];
	@$page_id = $_GET["page"];	
	$id = $_GET['id'] ?? "";
		
	if (!$page_id) $page_id = 0;
	if (!$limit) $limit = 25;		
	
	if (!$max_rec) 
		{					
			$result = Vote :: GetSupplierDetails($search,$veh_type);
			if (!$result) return;
		
			$max_rec = count($result);
	     }
		           
				$current1 = $page_id * $limit;
				//$length = $limit;
				
				$result = Vote :: GetSupplierDetails_pagination($search,$veh_type,$current1,  $limit);				
				if (!$result) return;			
				$num_rows = count($result);
				
				$color_arr = array("#F6F6F6", "#EBEBEB");
				$row_count = ($page_id * $limit) + 1;
			?>	
				
                <?php //-----------------end first part-----------------------------------------------------?>
                
          
          
          
          
          
          
			<div class="table">
				<img src="images/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" rowspan="2" width="20">No</th>
						<!--<th width="300" rowspan="2">Supplier Code</th>-->
						<th width="250" rowspan="2">Supplier Name</th> 
                        <th width="300" rowspan="2">Address</th> 
                        <th width="100" rowspan="2">Mobile No</th> 
                         <th width="50" rowspan="2"><center>View</center></th>
                        <th width="50" rowspan="2"><center>Edit</center></th>
						<th width="80" rowspan="2" class="last">Delete</th>
				  </tr>
                  
                  
                  <?php 
				  
								if($_SESSION['userType']==1)
								{
									$path='admin_home.php';
								}
								
								if($_SESSION['userType']==2)
								{
									$path='home.php';
								}
						
						$i = $page_id *25 +1;
						foreach ($result as $row)
						{  ?>
					<tr>
                    <tr>
						<td><?php echo $i; ?></td>                        
						<?php /*?><td align="left"><?php echo $row[2]; ?></td><?php */?>
                        <td><?php echo $row[1]; ?></td>   
                        
                        <td><?php echo $row[13]." ".$row[14]." ".$row[15]." ".$row[16]; ?></td>   
                        <td><?php echo $row[19]; ?></td>                    
        
                      <td class="last"><center><a href="ViewSupDetails.php?SupId=<?php echo $row[0]; ?>" class="link"><img src="images/Play-Normal.ico" width="16" height="16" alt="" /></a></center></td>
                      
                        <td><center><a href="EditSupplier.php?sup_id=<?php echo $row[0]; ?>"><img src="images/edit-icon.gif" width="16" height="16" alt="" /></a></center></td>
                        
                        
                        
						<!-- <?php /*?><td class="last"><a onclick="delete_Sup('<?php echo $row[0];?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></td><?php */?> -->
						<td class="last"><center><a onclick="delete_Sup('<?php echo $row[0];?>');" href="#" ><img src="images/hr.gif" width="16" height="16" alt="Delete" /></a></center></td>
                                       
                        </tr>
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
				<a href="Suppliers.php?&page=<?php echo($page_id - 1); ?>&veh_type=<?php echo $veh_type; ?>&max=<?php echo($max_rec); ?>">&laquo; Previous</a> | <?php } ?>
				<?php echo((($page_id * $limit) + 1));?> - <?php echo((($page_id * $limit) + $num_rows)); ?> of <?php echo($max_rec); ?>
				<?php if ((($page_id * $limit) + $limit) < $max_rec) { ?>
				| <a href="Suppliers.php?page=<?php echo($page_id + 1); ?>&veh_type=<?php echo $veh_type; ?>&max=<?php echo($max_rec)?>">Next &raquo</a>
				
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
        </form>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>


</body>
</html>
