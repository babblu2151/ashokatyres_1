<?php include_once "includes/inc_config.php";// site and  files confige
	include_once "includes/inc_connection.php";// database connection
	include_once "includes/inc_usr_functions.php";	// user define functions(code reuse)
   	include_once "includes/inc_folder_path.php";//  folder path confige?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
 <?php  include('header.php');?>
<body>
<form method="post">
<div class="row">
		<div class="col-lg-3 col-md-6">
								<div class="form-group">
									<label>Select Brand</label>
							<select class="form-control" id="tye"  onchange="funcfltvechtype('Car')" >
                            <option value="Car" >car</option>
                            <option value="Bike" >bike</option>
                                </select>
								</div> </div>
		<div class="col-lg-3 col-md-6">
								<div class="form-group">
									<label>Select Brand</label>
							<select class="form-control"  id="getmolnm" name="getmolnm" >
                                </select>
								</div>
                                </div> </div>
</form>
<?php include_once('footer.php'); ?>
<script>
							
  function funcfltvechtype(vechtype)
  {
	//alert(typeof (vechtype))
  	debugger;
  	var vehtypnm = vechtype;
   // alert(vehtypnm);
  	$.ajax({
  		type: "POST",
  		url: "prdserchflt.php",
  		data:'vechtypnm='+vehtypnm,
  		success: function(data){
			//debugger;
  		 alert(data);
  			$("#getmolnm").html(data);
  		}
  	});
  }
  </script>
  
</body>
</html>