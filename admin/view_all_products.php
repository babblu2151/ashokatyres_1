<?php
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/**************************************************************
Programm : view_all_products.php
Purpose : For Viewing Products
Created By : Bharath
Created On :	31-12-2021
Modified By : 
Modified On : 
Company : Adroit
***************************************************************/
/*****header link********/
$pagemncat = "Products";
$pagecat = "Products";
$pagenm = "View Products";
/*****header link********/
global $msg,$loc;
$clspn_val = "7";
$rd_adpgnm = "add_products.php";
$rd_edtpgnm = "edit_products.php";
$rd_crntpgnm = "view_all_products.php";
$rd_vwpgnm = "view_detail_prod.php";
if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts']) != "") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval']) != ""))
{
	$dchkval = substr($_POST['hdnchksts'],1);
	$id = glb_func_chkvl($dchkval);
	$chkallval	= glb_func_chkvl($_POST['hdnallval']);
	$updtsts = funcUpdtAllRecSts($conn,'prod_mst','prodm_id',$id,'prodm_sts',$chkallval);
	if($updtsts == 'y')
	{
		$msg = "<font color=red>Record updated successfully</font>";
	}
	elseif($updtsts == 'n')
	{
		$msg = "<font color=red>Record not updated</font>";
	}
}
if(($_POST['hdnchkval'] != "") && isset($_REQUEST['hdnchkval']))
{
	$dchkval = substr($_POST['hdnchkval'],1);
	$did = glb_func_chkvl($dchkval);
	$del = explode(',',$did);
	$count = sizeof($del);
	$delsts1 = funcDelAllRec($conn,'prod_veh_dtl','prodd_prodm_id',$did);
	$delsts3 = funcDelAllRec($conn,'prod_store_dtl','prods_prodm_id',$did);
	$delsts4 = funcDelAllRec($conn,'prodimg_dtl','prodimgd_prodm_id',$did);
	$delsts = funcDelAllRec($conn,'prod_mst','prodm_id',$did);
	if($delsts == 'y')
	{
		$msg = "<font color=red>Record deleted successfully</font>";
	}
	elseif($delsts == 'n')
	{
		$msg = "<font color=red>Record can't be deleted(child records exist)</font>";
	}
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts'])=='y'))
{
	$msg = "<font color=red>Record updated successfully</font>";
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == 'n'))
{
	$msg = "<font color=red>Record not updated</font>";
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts'])=='d'))
{
	$msg = "<font color=red>Duplicate Recored Name Exists ,Record Not updated</font>";
}
$rowsprpg = 20; //maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination
$sqryprod_mst1="SELECT prodm_id, prodm_sku, prodm_code, prodm_name, prodm_sts, tyrbrndm_name, vehtypm_name from prod_mst
	inner join tyr_brnd_mst on tyr_brnd_mst.tyrbrndm_id = prod_mst.prodm_tyr_brnd
	inner join veh_type_mst on veh_type_mst.vehtypm_id = prod_mst.prodm_vehtyp
	where prodm_id !=''";
// echo $sqryprod_mst1 ;exit;
if(isset($_REQUEST['txtsrchcd']) && (trim($_REQUEST['txtsrchcd'])!=""))
{
	$txtsrchcd = glb_func_chkvl($_REQUEST['txtsrchcd']);
	$loc .= "&txtsrchcd=".$txtsrchcd;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryprod_mst2.=" and prodm_code = '$txtsrchcd'";
	}
	else
	{
		$sqryprod_mst2.=" and prodm_code like '%$txtsrchcd%'";
	}
}
if(isset($_REQUEST['txtsrchsku']) && (trim($_REQUEST['txtsrchsku'])!=""))
{
	$txtsrchsku = glb_func_chkvl($_REQUEST['txtsrchsku']);
	$loc .= "&txtsrchsku=".$txtsrchsku;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryprod_mst2.=" and prodm_sku = '$txtsrchsku'";
	}
	else
	{
		$sqryprod_mst2.=" and prodm_sku like '%$txtsrchsku%'";
	}
}
if(isset($_REQUEST['txtsrchsnm']) && (trim($_REQUEST['txtsrchsnm'])!=""))
{
	$txtsrchsnm = glb_func_chkvl($_REQUEST['txtsrchsnm']);
	$loc .= "&txtsrchsnm=".$txtsrchsnm;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryprod_mst2.=" and prodm_name = '$txtsrchsnm'";
	}
	else
	{
		$sqryprod_mst2.=" and prodm_name like '%$txtsrchsnm%'";
	}
}
if(isset($_REQUEST['lstsrchtyrbrnd']) && (trim($_REQUEST['lstsrchtyrbrnd'])!=""))
{
	$lstsrchtyrbrnd = glb_func_chkvl($_REQUEST['lstsrchtyrbrnd']);
	$loc .= "&lstsrchtyrbrnd=".$lstsrchtyrbrnd;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryprod_mst2.=" and prodm_tyr_brnd = '$lstsrchtyrbrnd'";
	}
	else
	{
		$sqryprod_mst2.=" and prodm_tyr_brnd like '%$lstsrchtyrbrnd%'";
	}
}
$sqryprod_mst1 = $sqryprod_mst1.$sqryprod_mst2;
$sqryprod_mst = $sqryprod_mst1." group by prodm_id order by prodm_name limit $offset, $rowsprpg";
// echo $sqryprod_mst;
$srsprod_mst = mysqli_query($conn,$sqryprod_mst);
$cnt_recs	 = mysqli_num_rows($srsprod_mst);
include_once ('script.php');
?>
<script language='javascript' src="../includes/searchpopcalendar.js"></script>
<script language="javascript">
	function addnew()
	{
		document.frmprod.action="<?php echo $rd_adpgnm;?>";
		document.frmprod.submit();
	}
	function srch()
	{
		var urlval = "";
		var txtsrchcd = document.frmprod.txtsrchcd.value;
		var txtsrchsku = document.frmprod.txtsrchsku.value;
		var txtsrchsnm = document.frmprod.txtsrchsnm.value;
		var lstsrchtyrbrnd = document.frmprod.lstsrchtyrbrnd.value;
		if((txtsrchcd=="") && (txtsrchsku=="") && (txtsrchsnm=="") && (lstsrchtyrbrnd==""))
		{
			alert("Select Search Criteria");
			document.frmprod.txtsrchcd.focus();
			return false;
		}
		if(txtsrchcd !='')
		{
			if(urlval == "")
			{
				urlval +="txtsrchcd="+txtsrchcd;
			}
			else
			{
				urlval +="&txtsrchcd="+txtsrchcd;
			}
		}
		if(txtsrchsku !='')
		{
			if(urlval == "")
			{
				urlval +="txtsrchsku="+txtsrchsku;
			}
			else
			{
				urlval +="&txtsrchsku="+txtsrchsku;
			}
		}
		if(txtsrchsnm !='')
		{
			if(urlval == "")
			{
				urlval +="txtsrchsnm="+txtsrchsnm;
			}
			else
			{
				urlval +="&txtsrchsnm="+txtsrchsnm;
			}
		}
		if(lstsrchtyrbrnd !='')
		{
			if(urlval == "")
			{
				urlval +="lstsrchtyrbrnd="+lstsrchtyrbrnd;
			}
			else
			{
				urlval +="&lstsrchtyrbrnd="+lstsrchtyrbrnd;
			}
		}
		if(document.frmprod.chkexact.checked==true)
		{
			document.frmprod.action="view_all_products.php?"+urlval+"&chk=y";
			document.frmprod.submit();
		}
		else
		{
			document.frmprod.action="view_all_products.php?"+urlval;
			document.frmprod.submit();
		}
		return true;
	}
	function exprt()
	{
		var urlval = "prdsts=y";
		var txtsrchcd		= document.frmprod.txtsrchcd.value;
		var txtsrchnm 	= document.frmprod.txtsrchnm.value;
		var txtsrchprc 	= document.frmprod.txtsrchprc.value;
		var lstsrchptrn		= document.frmprod.lstsrchptrn.value;
		var lstsrchtyrbrnd 	= document.frmprod.lstsrchtyrbrnd.value;
		var lstsrchtyrtyp = document.frmprod.lstsrchtyrtyp.value;
		var lstsrchbrnd = document.frmprod.lstsrchbrnd.value;
		var lstsrchmnfctr = document.frmprod.lstsrchmnfctr.value;
		var lstsrchfbrc = document.frmprod.lstsrchfbrc.value;
		var chkexactval="";
		if(document.frmprod.chkexact.checked==true)
		{
			chkexactval='y';
		}
		var lstsrchsplrnm = document.frmprod.lstsrchsplrnm.value;
		if((txtsrchcd!="") || (txtsrchnm!="") || (txtsrchprc!="") || (lstsrchptrn!="") || (lstsrchtyrbrnd!="") || (lstsrchtyrtyp!="") || (lstsrchbrnd!="") || (lstsrchmnfctr!="")|| (lstsrchfbrc!="")|| (lstsrchsplrnm!=""))
		{
			urlval +="&txtsrchcd="+txtsrchcd+"&txtsrchnm="+txtsrchnm+"&txtsrchprc="+txtsrchprc+"&lstsrchptrn="+lstsrchptrn+"&lstsrchtyrbrnd="+lstsrchtyrbrnd+"&lstsrchtyrtyp="+lstsrchtyrtyp+"&lstsrchbrnd="+lstsrchbrnd+"&lstsrchmnfctr="+lstsrchmnfctr+"&lstsrchfbrc="+lstsrchfbrc+"&lstsrchsplrnm="+lstsrchsplrnm+"&chk="+chkexactval;
			document.frmprod.action="exp_prdct_details.php?"+urlval;
			document.frmprod.submit();
		}
		else
		{
			document.frmprod.action="exp_prdct_details.php?"+urlval;
			document.frmprod.submit();
		}
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
 			<div class="row mb-2">
 				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Products</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
 						<li class="breadcrumb-item active">Products</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- Default box -->
	<div class="card">
 		<?php if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
 		{ ?>
 			<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids">
 				<strong>Deleted Successfully !</strong>
 				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<?php
 		}
 		?>
 		<div class="alert alert-warning alert-dismissible fade show" role="alert" id="updid" style="display:none">
 			<strong>Updated Successfully !</strong>
 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 				<span aria-hidden="true">&times;</span>
 			</button>
 		</div>
 		<div class="alert alert-info alert-dismissible fade show" role="alert" id="sucid" style="display:none">
 			<strong>Added Successfully !</strong>
 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 				<span aria-hidden="true">&times;</span>
 			</button>
 		</div>
 		<div class="card-body p-0">
 			<div class="card-body p-0">
 				<form action="" method="post" enctype="multipart/form-data" name="frmprod" id="frmprod">
 					<input type="hidden" name="hdnchkval" id="hdnchkval">
 					<input type="hidden" name="hdnchksts" id="hdnchksts">
 					<input type="hidden" name="hdnallval" id="hdnallval">
 					<div class="col-md-12"><h2 class="mt-2">Search By</h2>
 						<div class="row justify-content-left align-items-center mt-3">
 							<div class="col-sm-4">
 								<div class="form-group">
 									<div class="row">
 										<div class="col-sm-7">
 											<input type="text" name="txtsrchcd" id="txtsrchcd" class="form-control" placeholder="Search by Code" value="<?php if(isset($_REQUEST['txtsrchcd']) && (trim($_REQUEST['txtsrchcd'])!="")){echo $_REQUEST['txtsrchcd'];}else{echo "";}?>">
 										</div>
 									</div>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<div class="row">
 										<div class="col-sm-7">
 											<input type="text" name="txtsrchsku" id="txtsrchsku" class="form-control" placeholder="Search by SKU" value="<?php if(isset($_REQUEST['txtsrchsku']) && (trim($_REQUEST['txtsrchsku'])!="")){echo $_REQUEST['txtsrchsku'];}else{echo "";}?>">
 										</div>
 									</div>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<div class="row">
 										<div class="col-sm-7">
 											<input type="text" name="txtsrchsnm" id="txtsrchsnm" class="form-control" placeholder="Search by Name" value="<?php if(isset($_REQUEST['txtsrchsnm']) && (trim($_REQUEST['txtsrchsnm'])!="")){echo $_REQUEST['txtsrchsnm'];}else{echo "";}?>">
 										</div>
 									</div>
 								</div>
 							</div>
 							<div class="col-sm-4">
 								<div class="form-group">
 									<div class="row">
 										<div class="col-sm-7">
 											<select name="lstsrchtyrbrnd" id="lstsrchtyrbrnd" class="form-control">
 												<option value="">-- Select Brand--</option>
 												<?php
 												$sqrytyrbrnd_mst="SELECT tyrbrndm_id,tyrbrndm_name from tyr_brnd_mst where tyrbrndm_sts='a' group by tyrbrndm_id order by tyrbrndm_name";
 												$srstyrbrnd_mst = mysqli_query($conn,$sqrytyrbrnd_mst);
 												while($srowtyrbrnd_mst = mysqli_fetch_assoc($srstyrbrnd_mst))
 												{ ?>
 													<option value="<?php echo $srowtyrbrnd_mst['tyrbrndm_id'];?>"<?php if(isset($_REQUEST['lstsrchtyrbrnd']) && $_REQUEST['lstsrchtyrbrnd']==$srowtyrbrnd_mst['tyrbrndm_id']){echo 'selected';}?>><?php echo $srowtyrbrnd_mst['tyrbrndm_name'];?></option>
 													<?php
 												}
 												?>
 											</select>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="col-sm-8">
							<div class="form-group">Exact
								<input type="checkbox" name="chkexact" value="1" <?php if(isset($_POST['chkexact']) && ($_POST['chkexact']==1)){echo 'checked';}elseif(isset($_REQUEST['chk']) && ($_REQUEST['chk']=='y')){echo 'checked';}?>>
								&nbsp;&nbsp;&nbsp;
								<input type="submit" value="Search" class="btn btn-primary" name="btnsbmt" onClick="srch();">
								<!-- <input name="btnexprt" id='btnexprt' type="button" class="btn btn-primary" onClick="exprt()" value="Export to Excel"> -->
								<a href="<?php echo $rd_crntpgnm; ?>" class="btn btn-primary">Refresh</a>
								<button type="submit" class="btn btn-primary" onClick="addnew();">+ Add</button>
							</div>
						</div>
 					</div>
 				</div>
 			</div>
 			<div class="card-body p-0">
 				<div class="table-responsive">
 					<table width="100%" height="185" border="0" cellpadding="3" cellspacing="1" class="table table-striped projects">
 						<tr>
							<td colspan="<?php echo $clspn_val; ?>">&nbsp;</td>
							<td align="center">
								<input name="btnsts" id="btnsts" type="button" value="Status" class="btn btn-xs btn-primary" onClick="updatests('hdnchksts','frmprod','chksts')">
							</td>
							<td align="center"><input name="btndel" id="btndel" type="button" value="Delete" class="btn btn-xs btn-primary" onClick="deleteall('hdnchkval','frmprod','chkdlt');" ></td>
						</tr>
						<tr>
							<td><strong>SL. No</strong></td>
							<td><strong>Code</strong></td>
							<td><strong>SKU</strong></td>
							<td><strong>Name</strong></td>
							<td ><strong>Tyre Brand</strong></td>
							<td ><strong>Vehicle Type</strong></td>
							<td width="7%" align="center" class="td_bg"><strong>Edit</strong></td>
							<td width="7%" align="center"><strong>
								<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"onClick="Check(document.frmprod.chksts,'Check_ctr','hdnallval')"></strong>
							</td>
							<td width="7%" align="center"><strong>
								<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmprod.chkdlt,'Check_dctr')"><b></b></strong>
							</td>
						</tr>
						<?php
						if($cnt_recs > 0)
						{
							while($rowsprod_mst=mysqli_fetch_assoc($srsprod_mst))
							{
								$cnt+=1;
								$prodid = $rowsprod_mst['prodm_id'];
								$prodcode = $rowsprod_mst['prodm_code'];
								$prodsku = $rowsprod_mst['prodm_sku'];
								$prodname = $rowsprod_mst['prodm_name'];
								$prodbrnd = $rowsprod_mst['tyrbrndm_name'];
								$prodvehtyp = $rowsprod_mst['vehtypm_name'];
								$prodimg = $rowsprod_mst['prodm_img'];
								$prodsts = $rowsprod_mst['prodm_sts'];
								?>
								<tr <?php if($cnt%2==0){echo "";}else{echo "";}?>>
									<td height="54"><?php echo $cnt;?></td>
									<td><a href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $prodid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>"><?php echo $prodcode; ?></a></td>
									<td><?php echo $prodsku; ?></td>
									<td><?php echo $prodname; ?></td>
									<td><?php echo $prodbrnd;?></td>
									<td><?php echo $prodvehtyp;?></td>
									<td align="center">
										<a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $prodid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="orongelinks">Edit</a>
									</td>
									<td align="center">
										<input type="checkbox" name="chksts" id="chksts" value="<?php echo $rowsprod_mst['prodm_id'];?>" <?php if($rowsprod_mst['prodm_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $rowsprod_mst['prodm_id'];?>,'hdnchksts','frmprod','chksts');">
									</td>
									<td align="center">
										<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $rowsprod_mst['prodm_id'];?>">
									</td>
								</tr>
								<?php
							}
						}
						else
						{
							$msg="<font color=red>No Records In Database</font>";
						}
						?>
						<tr>
							<td colspan="<?php echo $clspn_val; ?>">&nbsp;</td>
							<td width="7%" align="center" valign="bottom">
								<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmprod','chksts')" class="btn btn-xs btn-primary">
							</td>
							<td width="7%" align="center" valign="bottom">
								<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmprod','chkdlt');" class="btn btn-xs btn-primary">
							</td>
						</tr>
						<?php
						$disppg = funcDispPag($conn,'links',$loc,$sqryprod_mst1	,$rowsprpg,$cntstart,$pgnum);
						$colspanval = $clspn_val+2;
						if($disppg != "")
						{
							$disppg = "<br><tr><td colspan='$colspanval' align='center' >$disppg</td></tr>";
							echo $disppg;
						}
						if($msg != "")
						{
							$dispmsg = "<tr><td colspan='$colspanval' align='center' >$msg</td></tr>";
							echo $dispmsg;
						}
						?>
					</table>
				</div>
			</div>
		</form>
	</div>
	<!-- /.card-body -->
</div>
<!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>