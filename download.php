<?php 

    $document = $_GET['filename']; 	
	
    	$file_path = 'uploads/';
  
		$fp = fopen($file_path . $document, 'r');
   
    header('Content-Type: application/x-octetstream');
    header('Content-Disposition: attachment; filename="'.$document.'"');
    fpassthru($fp);
	?>