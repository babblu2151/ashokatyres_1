<?php	
include_once "../includes/inc_nocache.php"; // Clearing the cache information
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
include_once "../includes/inc_folder_path.php";
if(isset($_POST['btnprodscatsbmt']) && (trim($_POST['btnprodscatsbmt']) != "") &&
	  isset($_POST['lstprodcat']) && (trim($_POST['lstprodcat']) != "") && 	
	  isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	  isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")){
	  
		$name     	= glb_func_chkvl($_POST['txtname']);
		$prodcat   	= glb_func_chkvl($_POST['lstprodcat']);
		$desc     	= addslashes(trim($_POST['txtdesc']));
		$prior  	 	= glb_func_chkvl($_POST['txtprior']);
		$szchrt  	 	= glb_func_chkvl($_POST['txtszchrt']);
		$title  	 	= glb_func_chkvl($_POST['txtseotitle']);
		$seodesc 		= glb_func_chkvl($_POST['txtseodesc']);
		$seokywrd 		= glb_func_chkvl($_POST['txtkywrd']);
		
		$seoh1_tle = glb_func_chkvl($_POST['txtseoh1tle']);
		$seoh2_tle = glb_func_chkvl($_POST['txtseoh2tle']);
		$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
		$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
		
		/*$frmdate  	= glb_func_chkvl($_POST['txtfrmdt']);
		$todate   	= glb_func_chkvl($_POST['txttodt']);
		$frmdt = 'NULL';
	 	if(isset($_POST['txtfrmdt']) && $_POST['txtfrmdt'] !=''){
			$frmdt 		= "'".date('Y-m-d', strtotime($frmdate))."'";
	 	}
	 	$todt = 'NULL';
	 	if(isset($_POST['txttodt']) && $_POST['txttodt'] !=''){
			$todt 		= "'".date('Y-m-d', strtotime($todate))."'";
	 	}
	  */
		$sts     = glb_func_chkvl($_POST['lststs']);
		$curdt    = date('Y-m-d h-i-s');
		//$emp     = $_SESSION['sesadmin'];
    $sqryprodsubcat_mst="select 
								prodscatm_name 
					   	from 
						  	 prodscat_mst								 
					   	where 
						 		 prodscatm_name ='$name' and
								 prodscatm_prodcatm_id='$prodcat'";
		$srsprodsubcat_mst = mysqli_query($conn,$sqryprodsubcat_mst);
		$rows      = mysqli_num_rows($srsprodsubcat_mst);
		if($rows < 1){
			if(isset($_FILES['fleszchrtimg']['tmp_name']) && ($_FILES['fleszchrtimg']['tmp_name']!="")){
				$szimgval = funcUpldImg('fleszchrtimg','cimg');
				if($szimgval != ""){
					$szimgary  = explode(":",$szimgval,2);
					$szdest 	= $szimgary[0];					
					$szsource 	= $szimgary[1];	
				}
			}
			$iqryprodsubcat_mst="insert into prodscat_mst(
								 prodscatm_name,prodscatm_desc,prodscatm_prodcatm_id,prodscatm_seotitle,
							 	 prodscatm_seodesc,prodscatm_seokywrd,prodscatm_seohonetitle,prodscatm_seohonedesc,
								 prodscatm_seohtwotitle,prodscatm_seohtwodesc,prodscatm_prty,prodscatm_sts,
								 prodscatm_szchrtimg,prodscatm_crtdon, prodscatm_crtdby) values(
								 '$name','$desc','$prodcat','$title',
							 	 '$seodesc','$seokywrd','$seoh1_tle','$seoh1_desc',
								 '$seoh2_tle','$seoh2_desc','$prior','$sts',
								 '$szdest','$curdt','$ses_admin')";
			$irsprodsubcat_mst= mysqli_query($conn,$iqryprodsubcat_mst) or die(mysqli_error());
			if($irsprodsubcat_mst==true){
				if(($szsource!='none') && ($szsource!='') && ($szdest != "")){ 					
					move_uploaded_file($szsource,$gszchrt_upldpth.$szdest);					
				}
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
		}
		else{		
			$gmsg = "Duplicate name. Record not saved";
		}
	}
?>