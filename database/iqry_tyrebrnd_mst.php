<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btntyrbrndsbmt']) && (trim($_POST['btntyrbrndsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$prior = glb_func_chkvl($_POST['txtprior']);
	$brndimg = glb_func_chkvl($_POST['txtbrndimg']);
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$seokywrd = glb_func_chkvl($_POST['txtkywrd']);
	$seoh1_tle = glb_func_chkvl($_POST['txtseoh1tle']);
	$seoh2_tle = glb_func_chkvl($_POST['txtseoh2tle']);
	$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
	$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$curdt = date('Y-m-d h-i-s');
	$sqrytyr_brnd_mst = "SELECT tyrbrndm_name from tyr_brnd_mst where tyrbrndm_name ='$name'";
	$srstyrbrnd_mst = mysqli_query($conn,$sqrytyr_brnd_mst);
	$rows = mysqli_num_rows($srstyrbrnd_mst);
	if($rows < 1)
	{
		if(isset($_FILES['flebrndimg']['tmp_name']) && ($_FILES['flebrndimg']['tmp_name']!=""))
		{
			$brndimgval = funcUpldImg('flebrndimg','tyrbrndimg');
			if($brndimgval != "")
			{
				$brndimgary = explode(":",$brndimgval,2);
				$brnddest = $brndimgary[0];
				$brndsource = $brndimgary[1];
			}
		}
		$iqrytyrbrnd_mst="INSERT into tyr_brnd_mst(tyrbrndm_name, tyrbrndm_desc, tyrbrndm_seotitle, tyrbrndm_seodesc, tyrbrndm_seokywrd, tyrbrndm_seohonetitle, tyrbrndm_seohonedesc, tyrbrndm_seohtwotitle, tyrbrndm_seohtwodesc, tyrbrndm_prty, tyrbrndm_sts, tyrbrndm_brndimg, tyrbrndm_crtdon, tyrbrndm_crtdby) values ('$name', '$desc', '$title', '$seodesc', '$seokywrd', '$seoh1_tle', '$seoh1_desc', '$seoh2_tle', '$seoh2_desc', '$prior', '$sts', '$brnddest', '$curdt', '$ses_admin')";
		$irstyrbrnd_mst= mysqli_query($conn,$iqrytyrbrnd_mst) or die(mysqli_error());
		if($irstyrbrnd_mst==true)
		{
			if(($brndsource!='none') && ($brndsource!='') && ($brnddest != ""))
			{ 			
				move_uploaded_file($brndsource,$gtyrbrndimg_upldpth.$brnddest);					
			}
			$gmsg = "Record saved successfully";
		}
		else
		{
			$gmsg = "Record not saved";
		}
	}
	else
	{		
		$gmsg = "Duplicate name. Record not saved";
	}
}
?>