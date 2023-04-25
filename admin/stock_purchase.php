<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**************************************************************
Programm : stock_purchase.php	
Purpose : For adding stock
Created By : Bharath
Created On :	31-01-2022
Modified By : 
Modified On : 
Company : Adroit
***********************************************************/
/*****header link********/
$pagemncat = "Stock";
$pagecat = "Stock";
$pagenm = "Purchase";
/*****header link********/
global $gmsg;		 
$rd_crntpgnm = "stock_purchase.php";
$clspn_val = "4";
if(isset($_POST['btnaddstk']) && ($_POST['btnaddstk'] != "") && isset($_POST['txtsku']) && ($_POST['txtsku'] != ""))
{
	include_once "../database/iqry_prod_prchs.php";	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<title><?php echo $pgtl;?></title>
		<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
		<script language="javascript" src="../includes/yav.js"></script>
		<script language="javascript" src="../includes/yav-config.js"></script>	
		<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
		<script language="javascript" type="text/javascript">
			var rules=new Array();
			rules[0]='txtsku:SKU|required|Enter SKU / Bar Code';
			rules[1]='txtcstprc:Cost Price|required|Enter Cost Price';
			rules[2]='txtcstprc:Cost Price|double|Enter Numeric Values';
			rules[3]='txtqty:Quantity|required|Enter Quantity';
			rules[4]='txtqty:Quantity|numeric|Enter Numeric Values';
			function setfocus()
			{
				document.getElementById('txtsku').focus();
			}
		</script>
		<?php 
		include_once ('script.php');
		include_once ('../includes/inc_fnct_ajax_validation.php');	
		?>
		<script language="javascript" type="text/javascript">
			function funcGetProddtls()
			{
				var sku;
				sku = document.getElementById('txtsku').value;
				if(sku != "")
				{
					var url = "getproddtls.php?prodsku="+sku;
					xmlHttp	= GetXmlHttpObject(stateChanged);
					xmlHttp.open("GET", url , true);
					xmlHttp.send(null);
				}
				else
				{
					document.getElementById('errorsDiv_txtsku').value = "";
				}	
			}
			function stateChanged()
			{
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{
					var temp=xmlHttp.responseText;
					// alert(temp);
					if (temp != "No data found. Please enter correct SKU code")
					{
						proddtls = new Array();
		    		proddtls = temp.split('-');
		    		var prodm_id = proddtls[0];
		    		var prodm_code = proddtls[1];
				    var prodm_name = proddtls[2];
				    var tyrbrndm_name = proddtls[3];
				    var tyrtypm_name = proddtls[4];
				    var vehtypm_name = proddtls[5];
				    var prodm_size = proddtls[6];
				    var prodm_ptrn = proddtls[7];
				    var loc_id = proddtls[8].split("|");
				    var loc_nm = proddtls[9].split("|");
				    var prodm_cstprc = proddtls[10];
				    var prdinvt_clsbls = proddtls[11].split("|");
				    var i = 0;
				    var totstk = 0;
				    var clsbls;
				    while(i<loc_id.length)
				    {
				    	if(prdinvt_clsbls[i] == "")
				    	{
				    		clsbls = 0;
				    	}
				    	else
				    	{
				    		clsbls = prdinvt_clsbls[i];
				    	}
				    	prchsloc = document.getElementById("prchsloc").value;
				    	if (prchsloc == loc_id[i])
				    	{
				    		document.getElementById("opnbls").value = clsbls;
				    	}
				    	/*else
				    	{
				    		document.getElementById("opnbls").value = 0;
				    	}*/
				    	totstk = totstk+Number(clsbls);
				    	i++;
				    }
				    var tot_stk = "<a href='#' onclick='str_stk(\""+proddtls[8]+"\",\""+proddtls[9]+"\",\""+proddtls[11]+"\")'>"+totstk+"</a>"

						if(prodm_code!= '' && prodm_name!= '' && tyrbrndm_name!= '' && tyrtypm_name!= '' && vehtypm_name!= '' && prodm_size!= '' && prodm_ptrn!= '')
						{
							document.getElementById("errorsDiv_txtsku").innerHTML = "";
							document.getElementById("prodid").value = prodm_id;
							document.getElementById("prodcde").innerHTML = prodm_code;
							document.getElementById("prodnm").innerHTML = prodm_name;
							document.getElementById("prodbrnd").innerHTML = tyrbrndm_name;
							document.getElementById("prodtyp").innerHTML = tyrtypm_name;
							document.getElementById("prodvehtyp").innerHTML = vehtypm_name;
							document.getElementById("prodsz").innerHTML = prodm_size;
							document.getElementById("prodptrn").innerHTML = prodm_ptrn;
							document.getElementById("prodstk").innerHTML = tot_stk;
							document.getElementById("txtcstprc").value = prodm_cstprc;
							document.getElementById('txtqty').focus();
						}
					}
					else
					{
						document.getElementById("errorsDiv_txtsku").style.color = "red";
						document.getElementById("errorsDiv_txtsku").innerHTML = temp;
						document.getElementById('txtsku').focus();
					}
				}
			}
			function prdactprc()
			{
				var prdqty = $("#txtqty").val();
				if(Number(prdqty) > 0)
				{
					document.getElementById("errorsDiv_txtqty").innerHTML = "";
					var prdprc = $("#txtcstprc").val();
					var prdfnprc = Number(prdqty)*Number(prdprc);
					$("#stknetprc").html(prdfnprc);
					$("#txtnetprc").val(prdfnprc);
					document.getElementById('btnaddstk').disabled=false;
          document.getElementById('btnaddstk').style.cursor="pointer";
				}
				else
				{
					document.getElementById("errorsDiv_txtqty").style.color = "red";
					document.getElementById("errorsDiv_txtqty").innerHTML = "Quatity should be greater than 0";
					document.getElementById('btnaddstk').disabled=true;
          document.getElementById('btnaddstk').style.cursor="not-allowed";
				}
			}
			function prc_validate()
			{
				var prdprc = $("#txtcstprc").val();
				if(Number(prdprc) > 0)
				{
					document.getElementById("errorsDiv_txtcstprc").innerHTML = "";
					document.getElementById('txtqty').focus();
					prdactprc();
					document.getElementById('btnaddstk').disabled=false;
          document.getElementById('btnaddstk').style.cursor="pointer";
				}
				else
				{
					document.getElementById("errorsDiv_txtcstprc").style.color = "red";
					document.getElementById("errorsDiv_txtcstprc").innerHTML = "Price should be greater than 0";
					document.getElementById('txtcstprc').focus();
					document.getElementById('btnaddstk').disabled=true;
          document.getElementById('btnaddstk').style.cursor="not-allowed";
				}
			}
			function str_stk(locid, locnm, locstk)
			{
				if(locid != "")
				{
					var url = "getproddtls.php?locid="+locid+"&locnm="+locnm+"&locstk="+locstk;
					xmlHttp	= GetXmlHttpObject(funcprodstkChanged);
					xmlHttp.open("GET", url , true);
					xmlHttp.send(null);
				}
			} 
			function funcprodstkChanged()
			{
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{
					var temp=xmlHttp.responseText;
					// alert(temp);
					var tmpval = document.getElementById('divprod').innerHTML=temp
					if(tmpval!=0)
					{
						$(function() {
							$("#showPopup").modal('show');
						});
					}		
				}
			}
		</script>
	</head>
	<body onLoad="setfocus()">
		<?php include_once ('../includes/inc_adm_header.php'); ?>
		<section class="content">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Purchase</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Purchase</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- Default box -->
			<div class="card">
				<?php
				if($gmsg != "")
				{
					echo "<center><div class='col-12'>
					<font face='Arial' size='2' color = 'red'>$gmsg</font>
					</div></center>";
				}
				?>
				<div class="alert alert-info alert-dismissible fade show" role="alert" id="sucid" style="display:none">
					<strong>Added Successfully !</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="card-body p-0">
					<form name="frmprodprchs" id="frmprodprchs" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmprodprchs', rules, 'inline');">
						<div class="col-md-12">
							<div class="row justify-content-center align-items-center">
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>SKU / Bar Code *</label>
										</div>
										<div class="col-sm-9">
											<input name="txtsku" type="text" id="txtsku" size="45" maxlength="40" onBlur="funcGetProddtls()" class="form-control">
											<span id="errorsDiv_txtsku"></span>
										</div>
									</div>
								</div>
								<input type="hidden" name="prchsloc" id="prchsloc" value="1">
								<input type="hidden" name="prodid" id="prodid" value="">
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Product Code :</label>
										</div>
										<div class="col-sm-9" id="prodcde">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Product Name :</label>
										</div>
										<div class="col-sm-9" id="prodnm">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Product Brand :</label>
										</div>
										<div class="col-sm-9" id="prodbrnd">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Product Type :</label>
										</div>
										<div class="col-sm-9" id="prodtyp">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Vehicle Type :</label>
										</div>
										<div class="col-sm-9" id="prodvehtyp">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Size :</label>
										</div>
										<div class="col-sm-9" id="prodsz">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Pattern :</label>
										</div>
										<div class="col-sm-9" id="prodptrn">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Stock :</label>
										</div>
										<div class="col-sm-9" id="prodstk" style="color: red;">
										</div>
										<input type="hidden" name="opnbls" id="opnbls" value="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Price *</label>
										</div>
										<div class="col-sm-9">
											<input name="txtcstprc" type="text" id="txtcstprc" size="45" maxlength="40" class="form-control" onblur="prc_validate();">
											<span id="errorsDiv_txtcstprc"></span>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Quantity *</label>
										</div>
										<div class="col-sm-9">
											<input name="txtqty" type="text" id="txtqty" size="45" maxlength="40" class="form-control" onBlur="prdactprc();">
											<span id="errorsDiv_txtqty"></span>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row mb-2 mt-2">
										<div class="col-sm-3">
											<label>Net Price :</label>
										</div>
										<div class="col-sm-9" id="stknetprc">
										</div>
										<input type="hidden" name="txtnetprc" id="txtnetprc" value="">
									</div>
								</div>
								<p class="text-center">
									<input type="Submit" class="btn btn-primary" name="btnaddstk" id="btnaddstk" value="Submit" disabled="true" style="cursor:not-allowed;">
									&nbsp;&nbsp;&nbsp;
									<input type="reset" class="btn btn-primary" name="btnaddstkreset" value="Clear" id="btnaddstkreset">
									&nbsp;&nbsp;&nbsp;
									<!-- <input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm; ?>'"> -->
								</p>
							</div>
						</div>
					</form>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</section>
		<div id='showPopup' class="modal fade" role="dialog" aria-labelledby="showPopup">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body" id='divprod'></div>
				</div>
			</div>
		</div>
		<?php include_once '../includes/inc_adm_footer.php';?>
	</body>
</html>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdlvry');
</script>

<!--<script language="javascript" type="text/javascript">
	generate_wysiwyg('txtseodesc');
</script>-->