<?php 
   global $conn; 
   $hstnm	= "localhost";
   $usrnm	= "root";
   $usrpwd 	= "";
   $dbnm	= "ashokatyres_3";
   $conn    = mysqli_connect($hstnm,$usrnm,$usrpwd,$dbnm) or die ("System Cannot Connect To The Database Because: " . mysqli_connect_errno(). PHP_EOL);   
   if(!$conn){
   		echo "Connection Could Not be Established";
   }   
   error_reporting(E_ALL ^ E_NOTICE); 
?>

<?php 


