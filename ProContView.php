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
$path="";

$user_type_id 	= $_SESSION['userType'];
$branch_id  	= $_SESSION['branchID'];
$log_year		= $_SESSION['log_year'];	



$Branch = Vote :: GetBranchNametoPsoView($branch_id);

$OpsCon_Id 	= isset( $_GET['OpsCon_Id'])?$_GET['OpsCon_Id']:$branch_id;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>DGFM :: BSMS</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
    
    <script language="JavaScript" type="text/JavaScript" src="js/deleteconfirmations.js"></script>    
    <script language="JavaScript" type="text/JavaScript" src="js/comonscript.js"></script>  
   
  
</head>
<body>
<div id="main">
	<div id="header">
	 	      
	
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
            
               
                          
				<h1>VOTES CONTROLLED BY <?php echo $Branch['branch_name']; ?></h1>
				<div class="breadcrumbs"></div>
			</div><br />
		  <div class="select-bar">
		   <div id="error" align="center" style="height:25px;">
           
             
                 <td>Operational Controller</td>
           <td><label>         
           
<select name="opscon_id" class="ComboBoxcesSmall" id="opscon_id" onchange="getOpsControllerId(this.value)" style="width:100px;">
						   
							 <?php 
							$esrunit = Projects::get_all_OpesController($branch_id);
							while($rowesrunit=mysql_fetch_array($esrunit)){?>
                           
						     <option value="<?php echo $rowesrunit[0];  ?>" <?php if( $rowesrunit[0] == $OpsCon_Id){ echo "selected=selected"; }?> > <?php echo $rowesrunit[1]; ?></option>
						      <?php }?>
	          </select>
	    </label> </td>
                 
           
		   <?php /*?>  <?php require_once('messages/vote.message.php'); ?><?php */?>
		   </div>
		  </div>
          
          
	
				
       <?php 
			
			$result = Vote :: GetVoteDetailstoPsoViewCapital($OpsCon_Id,$log_year);
			$result2 = Vote :: GetVoteDetailstoPsoViewRecurrent($OpsCon_Id,$log_year);	
			
			
			
		//	$Exp_Alloc = Vote :: GetExpenditureDetailsReporttoPsoview($log_year,$vote_id);
				
		?>	
                
          
          
			<div class="table">
				<img  width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0">
                <tr> <h3>CAPITAL VOTES</h3></tr>
					<tr>
						<th class="first" rowspan="2" width="31">No</th>
						<th width="161" rowspan="2">Vote Number</th>
						<th width="522" rowspan="2">Description</th> 
                        <th width="100" rowspan="2">Allocation</th>
                        <th width="100" rowspan="2">Expenditure</th>
                        <th width="100" rowspan="2">Remaining</th>
                        
                        
				  </tr>
                  
                  
                  <?php 
								
						$i = 1;
						while($row = mysql_fetch_array($result))
						{ 
						 $val1 = $row[5]-($row[6]+$row[7])
						 ?>
					<tr>
                    <tr align="right" >
						<td><?php echo $i; ?></td>                        
						<td align="left"><a href="ViewFullDetailsforPSO.php?status=1&vote_id=<?php echo $row[4];?>&alloc=<?php echo $row[5];?>&branch_id=<?php echo $OpsCon_Id; ?>"><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>  
                        
                        <td align="right" class=""><?php echo  number_format($row[5],'2','.',','); ?></td>  
                        <td><?php echo  number_format($row[6] +$row[7],'2','.',','); ?></td>  
                        <td><?php echo  number_format($val1,'2','.',','); ?></td>  
                        <?php /*?><td><?php echo $row[3]; ?></td> <?php */?>                   
                    </tr>
					</tr>
                     <?php 
					 $i +=1;
					 } ?>
                     
                     
                     
                     
                     
                     
			  </table>
	           
		  </div>
          
          
			<div class="table">
				<img  width="8" height="7" alt="" class="left" />
				<table class="listing" cellpadding="0" cellspacing="0">
                <tr> <h3>RECURRENT VOTES</h3></tr>
					<tr>
						<th class="first" rowspan="2" width="31">No</th>
						<th width="161" rowspan="2">Vote Number</th>
						<th width="522" rowspan="2">Description</th> 
                         <th width="100" rowspan="2">Allocation</th>
                        <th width="100" rowspan="2">Expenditure</th>
                        <th width="100" rowspan="2">Remaining</th>
                        <!--<th width="100" rowspan="2">vote type temperay</th> -->
                        
                        
				  </tr>
                  
                  
                  <?php 
								
						$i = 1;
						while($row2 = mysql_fetch_array($result2))
						{  
						
						  $val = $row2[5]-($row2[6]+$row2[7])
						?>
					<tr>
                    <tr>
						<td><?php echo $i; ?></td>                        
						<td align="left"><a href="ViewFullDetailsforPSO.php?status=1&vote_id=<?php echo $row2[4]; ?>&alloc=<?php echo $row2[5];?>&branch_id=<?php echo $OpsCon_Id; ?>"><?php echo $row2[1]; ?></td>
                        <td><?php echo $row2[2]; ?></td>  
                        
                      
                        <td><?php echo  number_format($row2[5],'2','.',','); ?></td>  
                        <td><?php echo  number_format($row2[6] +$row2[7],'2','.',','); ?></td>  
                        <td><?php echo  number_format($val,'2','.',','); ?></td>  
                       <?php /*?> <td><?php echo $row2[3]; ?></td><?php */?>                    
                    </tr>
					</tr>
                     <?php 
					 $i +=1;
					 } ?>
                     
                     
                     
                     
                     
                     
			  </table>
	           
		  </div>
		</div>
	</div>
	<div id="footer"></div>
    <?php include_once("tpl/footter.tpl");?>
</div>


</body>
</html>
