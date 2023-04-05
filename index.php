<?php
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
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DGMS :: BSMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/custom.min.css">
   
    <link rel="stylesheet" href="css/animate.css">
<!--     <link rel="stylesheet" href="css/prism-okaidia.css"> 
    <link rel="stylesheet" href="css/font-awesome.min.css"> 
     -->
    <script src="js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
    <script type="text/javascript">
      function showuser(str)
      {
        if (str=="") 
        {
          document.getElementById("sfhq_or_branch").innerHTML="";
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
              document.getElementById("sfhq_or_branch").innerHTML = xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","getdata.php?q="+str,true);
        xmlhttp.send();
      }
    </script>
  </head>
   <body class="body_bg_image">

<div class="container">
 
<div class="row">
  <!-- <div class="col-lg-2"></div> -->
   <div class="col-lg-6">

      <div class="wow fadeInLeft" style="text-align: center;">
          <img src="images/Army_Logo_my.png" width="200px" align="centere" >
      <p width="350px" align="centere"  style="color:rgb(255, 165, 0); font-size:30px; text-align: center; font-family: sans-serif; text-shadow: 1px 1px 2px black;"  >

        FINANCE MANAGEMENT <br/> AND  <br/> MONITORING SYSTEM</p> 
      <!-- <p width="350px" align="centere"  style="color:rgb(255, 165, 0); font-size:30px; text-align: center; font-family: sans-serif; text-shadow: 1px 1px 2px black;"  >

        SRI LANKA ARMY</p>  -->
          </div>
     <br>  
   </div>
  <div class="col-lg-4 align-self-center wow fadeInRight">
 
        <form method="post" action="controller/login.controller.php?mode=login" enctype="application/x-www-form-urlencoded" autocomplete="off">
         
          <div class="form-group">
              <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="User name" name="user" autocomplete="off"  value="" required>
                <label for="floatingInput">User name</label>
                <!-- <span class="error invalid-feedback"></span> -->
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"  name="pass" required >
                <label for="floatingPassword">Password</label>
                <!-- <span class="error invalid-feedback"></span> -->
              </div>
              <?php require_once('messages/login.messages.php');  ?>
              <div class="form-floating">
                <!-- <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password"  name="pass" > -->
                <label for="cmb_type" style="transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);opacity: 0.65;">User Type</label>
                <select name="cmb_type" id="cmb_type" onChange="showuser(this.value)" class="form-control">
                  <?php 						  
                    $user_Type = Login :: getUserType();
							      foreach ($user_Type as $row) {
                  ?>
                  <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                  <?php }  ?>
                </select>
                <!-- <span class="error invalid-feedback"></span> -->
              </div>
              <div class="form-floating" id="sfhq_or_branch">
                
              </div>
              <div class="form-floating">
                <!-- <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password"  name="pass" > -->
                <label for="cmb_allocated_year" style="transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);opacity: 0.65;">Year</label>
                <select name="cmb_allocated_year" id="cmb_allocated_year"  class="form-control" >
                  <?php 
                    $thisYear = date('Y');
                    for($i=$thisYear; $i>2011; $i--){
                  ?>
                    <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                  <?php }  ?>
                </select>
                <!-- <span class="error invalid-feedback"></span> -->
              </div>
          </div>
          <div class="form-group">
             <br>
             <input  type="submit" class="btn btn-outline-info" value="Sign In">

          </div>

      </form>
  </div>
  <!-- <div class="col-lg-12">
       <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        <strong>මෙම පද්ධතියේ පිවිසුම් ද්වාරය ( LOGIN PAGE ) 2022.06.22 දින සිට යාවත්කාලීන කර ඇති අතර දැනට ඔබ සතු පරිශීලක ගිණුම් නාමයන් සහ මුරපද භාවිතයෙන් පද්ධතියට ප්‍රවිෂ්ඨ විය හැක .
      </div>


  </div> -->
</div>

</div> 
<div class="newstyle fixed-bottom">
    <div class="container">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
              <center><a href="#" class="footer_text">Software Solution by Dte of IT - SL Army</a></center>
          </div>
          <div class="col-lg-2 "><a href="#" class="footer_text"> Version 1.10 </a></div>
        </div>
    </div>
      
    </div>


</body>
 <script src="{{ asset('login/js/jquery.min.js') }}"></script>
 <script src="{{ asset('login/js/bootstrap.bundle.min.js'); }}"></script>
 <script src="{{ asset('login/js/prism.js'); }}" data-manual></script>  
 <script src="{{ asset('login/js/custom.js'); }}"></script> 
 
</html>

