<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once "../includes/inc_config.php";
	include_once "../includes/inc_folder_path.php";	
	//include_once 'searchpopcalendar.php';
	/**********************************************************
	Programm 	  : add_product_subcategory.php	
	Purpose 	  : For add Product SubCategory  Details
	Company 	  : Adroit
	************************************************************/	
	global $gmsg;
		//---------------------------------------User Condition--------------------------------------------------------//	
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(1,$sesvalary) || ($rqst_stp_attn[1]=='1') || ($rqst_stp_attn[1]=='2')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}
	
   //------------------------------------------------------------------------------------------------------------//	


	
	if(isset($_POST['btnempsbmt']) && (trim($_POST['btnempsbmt']) != "") &&
	   isset($_POST['txtcode']) && (trim($_POST['txtcode']) != "") && 
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){	 
	    include_once "../includes/inc_fnct_fleupld.php"; // For uploading files  
		include_once "../database/iqry_emp_mst.php";
	}
	
	
	
		$rqst_stp      	= $rqst_arymdl[0];
	$rqst_stp_attn  = explode("::",$rqst_stp);
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(1,$sesvalary) || ($rqst_stp_attn[1]=='1')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}
?>
	
	<?php 
	include_once ('script.php');
	include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
	</head>

<body onLoad="setfocus()">


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    <script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>

	<script language="javascript" src="../includes/yav.js"></script>

	<script language="javascript" src="../includes/yav-config.js"></script>	
<script language="javaScript" type="text/javascript" src="wysiwyg.js"></script>
	<script language="javascript" type="text/javascript">
    	/*$(function() {
			$( "#txtdob1" ).datepicker({ changeMonth: true,
      		  changeYear: true,
			  yearRange: "c-100:c+10",
			  dateFormat: 'dd-mm-yy' });
			$( "#txtjoin" ).datepicker({ changeMonth: true,
      		  changeYear: true,
			  yearRange: "c-100:c+10",
			  dateFormat: 'dd-mm-yy' });
		  });
		*/
		var rules=new Array();
    	//rules[0]='edtseshdnlstdeptid:Category|required|Select Group';
    	rules[1]='txtcode:Code|required|Enter Code';
		rules[2]='lstdesig:Category|required|Select Designation';
		rules[3]='txtname:Name|required|Enter Name';
		rules[4]='txtnname:Category|required|Enter Nick Name';
		rules[5]='txtaddr1:Address|required|Enter Address Line1';
		rules[6]='txtcty:City|required|Enter City';
		rules[7]='txtcnty:State|required|Enter State';
		rules[8]='txtcntry:State|required|Enter Country';
		rules[9]='txtpin:Pin|required|Enter Pin';
		rules[10]='txtpin:Phone|numeric|Enter Only Numbers';
		//rules[11]='txtphno1:Phone|required|Enter Phone1';
		rules[12]='txtphno1:Phone|numeric|Enter Only Numbers';
		rules[13]='txtpcnct1:Phone|required| Enter Primary Contact';
		rules[14]='txtdesig1:Designation|required| Enter Designation';
		rules[15]='txtmbno1:Designation|required| Enter Mobile No';
		rules[16]='txtemail1:Email|required| Enter Email';
		rules[17]='txtemail1|email|Enter your Email Id';		
		rules[18]='txtdob1|required|Select your DoB';	
		
		
		rules[19]='txtcaddr1:Address|required|Enter Address Line1';
		rules[20]='txtccty:City|required|Enter City';
		rules[21]='txtccnty:State|required|Enter State';
		rules[22]='txtccntry:State|required|Enter Country';
		rules[23]='txtcpin:Pin|required|Enter Pin';
		rules[24]='txtcpin:Phone|numeric|Enter Only Numbers';
		//rules[25]='txtcphno1:Phone|required|Enter Phone1';
		rules[26]='txtmbno1:Phone|numeric|Enter Only Numbers';
		
		//rules[27]='txtcmbno1:Designation|required| Enter Mobile No';
		rules[28]='txtcemail1:Email|required| Enter Email';
		rules[29]='txtcemail1|email|Enter your Email Id';	
		rules[30]='txtjoin|required|Select Joining Date';	
		rules[31]='lstjoindesc|required|Select Joining Designation';		
		rules[32]='txtprior:Rank|required|Enter Rank';
		rules[33]='txtprior:Rank|numeric|Enter Only Numbers';
		
		function funcGetAddr(){
			var chkaddr = document.getElementById('chkaddsm').checked;
			document.getElementById('txtcaddr1').value = '';
				document.getElementById('txtcaddr2').value =''; 
				document.getElementById('txtcpin').value ='';
				document.getElementById('txtccty').value ='';
				document.getElementById('txtccnty').value ='';
				document.getElementById('txtccntry').value ='';
				document.getElementById('txtcphno1').value ='';
				document.getElementById('txtcmbno1').value ='';
				document.getElementById('txtcemail1').value ='';
			if(chkaddr==true){
				document.getElementById('txtcaddr1').value = document.getElementById('txtaddr1').value;
				document.getElementById('txtcaddr2').value = document.getElementById('txtaddr2').value;
				document.getElementById('txtcpin').value = document.getElementById('txtpin').value;
				document.getElementById('txtccty').value = document.getElementById('txtcty').value;
				document.getElementById('txtccnty').value = document.getElementById('txtcnty').value;
				document.getElementById('txtccntry').value = document.getElementById('txtcntry').value;
				document.getElementById('txtcphno1').value = document.getElementById('txtphno1').value;
				document.getElementById('txtcmbno1').value = document.getElementById('txtmbno1').value;
				document.getElementById('txtcemail1').value = document.getElementById('txtemail1').value;
			}
		}
		
		function setfocus(){
			document.getElementById('txtname').focus();
		}
	</script>

<?php 
$mncat = "Setup";

$crntcat = "Product Group";

$crntpg = "Employee Creation";
	include_once 'header.php';
?>
 <section class="content">
      <div class="row">
 <div class="col-md-8">
   <div class="card card-primary">
     <div class="card-header">
<h3 class="card-title"> Add Employee Creation</h3>

<div class="card-tools">
  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
    <i class="fas fa-minus"></i></button>
</div>
     </div>

      
		    <form name="frmaddcat" id="frmaddcat" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" 
		  		onSubmit="return performCheck('frmaddcat', rules, 'inline');" enctype="multipart/form-data">
			   <input type="hidden" name="edtseshdnlstdeptid" id="edtseshdnlstdeptid">
<input type="hidden" name="edtseshdnlstdeptnm" id="edtseshdnlstdeptnm">


		   
   
      


				<strong><font color="#fda33a">

				<?php

					if(isset($gmsg) && $gmsg!=""){

						echo $gmsg;

					}

				  ?>

				  </font></strong>

	     
<div class="card-body">

      <div class="form-group">
  <label for="inputName">Code</label>

	<input name="txtcode" type="text" class="form-control input-sm" id="txtcode"   maxlength="250" onBlur="funcChkDupName()"/>		 

  <span id="errorsDiv_txtcode"></span>

 
  </div>

	<div class="form-group">
  <label for="inputName">Name</label>

	<input name="txtname" type="text" class="form-control input-sm" id="txtname"   maxlength="250" onBlur="funcChkDupName()"/>	 

  <span id="errorsDiv_txtname"></span>

 
  </div>
			  <div class="form-group">
  <label for="inputName">  Last Name *</label>
   
 <input name="txtfname" type="text" class="form-control input-sm" id="txtfname" 
						size="40" maxlength="250">	 

  <span id="errorsDiv_txtfname"></span>

 
  </div>
			  <div class="form-group">
  <label for="inputName"> Date Of Birth *</label>
 
      <input name="datepicker" type="text" class="form-control input-sm" id="datepicker" 
						size="40" maxlength="250">	 

  <span id="errorsDiv_txtdob1"></span>
</div>
			  <div class="form-group">
  <label for="inputName">Joining Date *</label>

      <input name="datepicker1" type="text" class="form-control input-sm" id="datepicker1" 
						size="40" maxlength="250">	 

  <span id="errorsDiv_joining_date"></span>
    
    </div>
			  <div class="form-group">
  <label for="inputName">  Permanent Address *</label>

    <input name="txtaddr2" type="text" class="form-control input-sm" id="txtaddr2" 
						size="40" maxlength="250">	 

  <span id="errorsDiv_txtaddr2"></span>
   
  </div>
			  <div class="form-group">
  <label for="inputName"> Pin *</label>
    
    <input name="txtpin" type="text" class="form-control input-sm" id="txtpin" 
						size="40" maxlength="250"> 

  <span id="errorsDiv_txtpin"></span>

 </div>
			  <div class="form-group">
  <label for="inputName"> City *</label>
     
 
     <input name="txtcty" type="text" class="form-control input-sm" id="txtcty" 
						size="40" maxlength="250">

  <span id="errorsDiv_txtcty"></span>

 
</div>
			  <div class="form-group">
  <label for="inputName">    State *</label>
 
   

    	<input name="txtcnty" type="text" class="form-control input-sm" id="txtcnty" 
						size="40" maxlength="250">

  <span id="errorsDiv_txtcnty"></span>

 </div>
			  <div class="form-group">
  <label for="inputName">    Country *</label>
      
      
 

    <input name="txtcntry" type="text" class="form-control input-sm" id="txtcntry" 
						value='India' size="40" maxlength="250">
   
   

  <span id="errorsDiv_txtcntry"></span>

 </div>
			  <div class="form-group">
  <label for="inputName"> Phone *</label>
      
    	 <input name="txtphno1" type="text" class="form-control input-sm" id="txtphno1" size="40" maxlength="250">
   
   

  <span id="errorsDiv_txtphno1"></span>

 
  </div>
			  <div class="form-group">
  <label for="inputName">  Mobile *</label>
    
      



 

  

	 <input name="txtmbno1" type="text" class="form-control input-sm" id="txtmbno1" size="40" maxlength="250"> 
   

  <span id="errorsDiv_txtmbno1"></span>

 
  
  </div>
			  <div class="form-group">
  <label for="inputName">Email *</label>
  

 	 <input name="txtemail1" type="text" class="form-control input-sm" id="txtemail1" size="40" maxlength="250">
   

  <span id="errorsDiv_txtemail1"></span>

 
  
  
   </div>
			  <div class="form-group">
  <label for="inputName"> Rank *</label>

 	<input name="txtprior" type="text" class="form-control input-sm" id="txtprior" 
						size="40" maxlength="250" value='1'>
   

  <span id="errorsDiv_txtprior"></span>

 
   
   </div>
			  <div class="form-group">
  <label for="inputName">Status</label>



 	<select name="lststs" id="lststs" class="form-control input-sm">
<option value="a" selected>Active</option>
<option value="i">Inactive</option>
     </select>
   

  <span id="errorsDiv_txtprior"></span>

 
      
      </div>
			  <div class="form-group">

				<input type="Submit" class="btn bg-gradient-success btn-lg"   name="btnempsbmt" id="btnempsbmt" value="Submit">&nbsp;&nbsp;&nbsp;

				<input type="Reset" class="btn bg-gradient-secondary btn-lg"  name="btncatreset" value="Reset" id="btncatreset">&nbsp;&nbsp;&nbsp;

    		      <input type="button"  name="btnBack" value="Back" class="btn bg-gradient-info btn-lg" onClick="location.href='view_employee_creation.php'">

</div>
			</div>
     <!-- /.card-body -->
     
   </div>
   <!-- /.card -->
 </div>
</div>
      
	  </form>
      </div>
    
    </section>
    <!-- /.content -->
  </div>
  <?php include 'footer.php' ?>


  <script language="javascript" type="text/javascript">
	generate_wysiwyg('txtdesc');
</script>
<script language="javascript" type="text/javascript">
	function funcChkDupName(){
		var name = document.getElementById('txtcode').value;
		//var emptypid  = document.getElementById('lstemptyp').value;		
		if(name != ""){
			var url = "chkvalidname.php?empname="+name;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else{
		    //document.getElementById('errorsDiv_lstemptyp').innerHTML="";
			document.getElementById('errorsDiv_txtcode').innerHTML = "";
		}	
	}
	function stateChanged(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtcode").innerHTML = temp;
			if(temp!=0){
				document.getElementById('txtcode').focus();
			}		
		}
	}	
	
	function funcchkloc(locname,locid,cntrlnm,hdncntrlnm){
		//var curval;
		var curname;
		var curid;
		var flg;
		var cntrlval,hdncntrlval;		
		cntrlval = cntrlnm;
		hdncntrlval = hdncntrlnm; 
		flg = 0;		
		//curval = document.frmprod.txtlistloc.value;		
		curname = 	document.getElementById(cntrlval).value;
		curid	=   document.getElementById(hdncntrlnm).value;
		if((curname != "") && (curid != "")){
			curvalarrnm = curname.split(","); // Stores the selected names
			curvalarrid = curid.split(","); // Stores the selected ids
			
			for(var i = 0;  i < curvalarrnm.length; i++){
				if(curvalarrnm[i] == locname){
					// Check whether location name is exist or not
					flg = 1;
					break;
				}
			}
			if(flg == 1){
				curvalarrnm.splice(i,1); // Remove the name from the list 
				curvalarrid.splice(i,1); // Remove the id from the list
				curname = curvalarrnm; // Assign
				curid	= curvalarrid;
			}
			else if (flg == 0){													
				if(curname == ""){
					curname = locname;
					curid   = locid;
				}
				else{
					curname = curname + "," + locname;
					curid	= curid + "," + locid;
				}										
			}
		}
		else{
			curname = locname;
			curid 	= locid;
		}
		document.getElementById(cntrlval).value = curname;
		document.getElementById(hdncntrlnm).value = curid;
	}	
	</script>
    
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "#datepicker" ).datepicker({
		dateFormat: 'yy-dd-mm'
		
		});
	
	
  } );
  </script>
  
     <script>
  $( function() {
    $( "#datepicker1" ).datepicker({
		dateFormat: 'yy-dd-mm'
		
		});
	
	
  } );
  </script>
  