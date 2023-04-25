<?php
//include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more

/***************************************************************
Programm : getproddtls.php
Company : Adroit
************************************************************/
// ------------------------ To get product details---------------
if(isset($_REQUEST['prodsku']) && (trim($_REQUEST['prodsku']) != ""))
{
	$sku = glb_func_chkvl($_REQUEST['prodsku']);
	$dat = date('Y-m-d');
	$sqryprod_dtls = "SELECT prodm_id, prodm_code, prodm_name, tyrbrndm_name, tyrtypm_name, vehtypm_name, prodm_size, prodm_ptrn, prodm_cstprc, prodm_mdyon from prod_mst
		inner join tyr_brnd_mst on tyrbrndm_id = prodm_tyr_brnd
		inner join tyr_type_mst on tyrtypm_id = prodm_tyrtyp
		inner join veh_type_mst on vehtypm_id = prodm_vehtyp
		where prodm_sku='$sku'";
		/*echo $sqryprod_dtls;
		and prdprchs_dat <='$dat' and prdprchs_lcn = $loc*/
	$srsproddtls = mysqli_query($conn,$sqryprod_dtls);
	$cnt = mysqli_num_rows($srsproddtls);
	if ($cnt > 0)
	{
		$rwsproddtls = mysqli_fetch_assoc($srsproddtls);
		$prodm_id = $rwsproddtls['prodm_id'];
		$prodm_code = $rwsproddtls['prodm_code'];
		$prodm_name = $rwsproddtls['prodm_name'];
		$tyrbrndm_name = $rwsproddtls['tyrbrndm_name'];
		$tyrtypm_name = $rwsproddtls['tyrtypm_name'];
		$vehtypm_name = $rwsproddtls['vehtypm_name'];
		$prodm_size = $rwsproddtls['prodm_size'];
		$prodm_ptrn = $rwsproddtls['prodm_ptrn'];
		$prodm_cstprc = $rwsproddtls['prodm_cstprc'];
		$prodm_mdyon = $rwsproddtls['prodm_mdyon'];
		$sqry_prdinvt = "SELECT prdinvt_id, prdinvt_cstprc, date_format(prdinvt_dat,'%Y-%m-%d') as prdinvt_dat, date_format(prdprchs_crton,'%H:%i:%s') as prdprchs_time from product_inventory
		left join prdprchs_inventory on prdprchs_id = prdinvt_prdprchs_id
		where prdinvt_prdid = $prodm_id and prdprchs_dat <='$dat' and prdinvt_prdprchs_in != '' order by prdinvt_id DESC limit 1";
		// echo $sqry_prdinvt;
		$srsprdinvt = mysqli_query($conn,$sqry_prdinvt);
		$prod_invtcnt = mysqli_num_rows($srsprdinvt);
		$rwsprodinvt = mysqli_fetch_assoc($srsprdinvt);
		@$prdinvt_id = $rwsprodinvt['prdinvt_id'];
		@$prdinvt_cstprc = $rwsprodinvt['prdinvt_cstprc'];
		@$prdinvt_dat = $rwsprodinvt['prdinvt_dat'];
		@$prdprchs_time = $rwsprodinvt['prdprchs_time'];
		$prev_prchsdt = $prdinvt_dat." ".$prdprchs_time;
		if(($prodm_mdyon > $prev_prchsdt) || ($prdinvt_cstprc == ""))
		{
			$prchsamt = $prodm_cstprc;
		}
		else
		{
			$prchsamt = $prdinvt_cstprc;
		}
		$sqry_loc = "SELECT strlocm_id, strlocm_name from store_loc_mst where strlocm_sts = 'a' order by strlocm_id ASC";
		$srslocdtls = mysqli_query($conn,$sqry_loc);
		$loc_cnt = mysqli_num_rows($srslocdtls);
		$loc_id = array();
		$loc_nm = array();
		$prdinvt_clsbls = array();
		while($rwslocdtls = mysqli_fetch_assoc($srslocdtls))
		{
			$loc = $rwslocdtls['strlocm_id'];
			$loc_name = $rwslocdtls['strlocm_name'];
			$loc_id[] = $loc;
			$loc_nm[] = $loc_name;
			$sqryclsbls = "SELECT prdinvt_clsbls from product_inventory where prdinvt_prdid = $prodm_id and prdinvt_dat <='$dat' and prdinvt_lcn = '$loc' order by prdinvt_id DESC limit 1";
			$srsclsbls = mysqli_query($conn,$sqryclsbls);
			$prod_clscnt = mysqli_num_rows($srsclsbls);
			$rwsclsbls = mysqli_fetch_assoc($srsclsbls);
			@$prdinvt_clsbls[] = $rwsclsbls['prdinvt_clsbls'];
		}
		$locid = implode("|",$loc_id);
		$locnm = implode("|",$loc_nm);
		$clsbls = implode("|",$prdinvt_clsbls);
		echo $prodm_id."-".$prodm_code."-".$prodm_name."-".$tyrbrndm_name."-".$tyrtypm_name."-".$vehtypm_name."-".$prodm_size."-".$prodm_ptrn."-".$locid."-".$locnm."-".$prchsamt."-".$clsbls;
	}
	else
	{
		echo "No data found. Please enter correct SKU code";
	}
}
// ---------------------- end get product details -----------------------------
// ------------------------ To get individual location stock---------------
if(isset($_REQUEST['locid']) && (trim($_REQUEST['locid']) != ""))
{
	$locid = glb_func_chkvl($_REQUEST['locid']);
	$locnm = glb_func_chkvl($_REQUEST['locnm']);
	$locstk = glb_func_chkvl($_REQUEST['locstk']);
	$loc = explode("|", $locid);
	$locnm = explode("|", $locnm);
	$stk = explode("|", $locstk);
	?>
	<div class="form-group clearfix">
		<div class="table-responsive">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-condensed table-bordered table-striped" style="color:black">
				<tr>
					<td bgcolor="#F3F3F3" align="center"><strong>Location</strong></td>
					<td bgcolor="#F3F3F3" align="center"><strong>Stock</strong></td>
				</tr>
				<?php
				$i = 0;
				while($i < count($loc))
				{ 
					if ($stk[$i] == "")
					{
						$stock = 0;
					}
					else
					{
						$stock = $stk[$i];
					}
					?>
					<tr id="<?php echo $loc[$i]."-".$stock; ?>">
						<td><?php echo $locnm[$i];?></td>
						<td><?php echo $stock;?></td>
					</tr>
					<?php
					$i++;
				}
				?>
			</table>
		</div>
	</div>
	<?php
}
// ------------------------End To get individual location stock---------------
// ------------------------ To get individual location stock---------------
if(isset($_REQUEST['frm_id']) && (trim($_REQUEST['frm_id']) != ""))
{
	$frm_id = glb_func_chkvl($_REQUEST['frm_id']);
	$result = "";
	$sqrytoloc_mst = "SELECT strlocm_id, strlocm_name from store_loc_mst where strlocm_sts = 'a' and strlocm_id != $frm_id  order by strlocm_name";
	// echo $sqrytoloc_mst; exit;
	$srstoloc_mst = mysqli_query($conn,$sqrytoloc_mst) or die(mysqli_error());
	$cnttoloc_inc = mysqli_num_rows($srstoloc_mst);
	$dispstr = "";
	?>
	<option value disabled selected>Select To Location</option>
	<?php
	while ($prg = mysqli_fetch_array($srstoloc_mst))
	{ ?>
		<option value="<?php echo $prg["strlocm_id"]; ?>"><?php echo $prg["strlocm_name"]; ?></option>
		<?php
	}
}
// ------------------------End To get individual location stock---------------