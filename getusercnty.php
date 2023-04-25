<?php
	include_once "includes/inc_nocache.php";// Includes no data cache
	//include_once "includes/inc_usr_sessions.php";	 //Including user session value
	//include_once "includes/inc_membr_session.php";//checking for session
	include_once "includes/inc_connection.php";//Making database Connection
	include_once "includes/inc_usr_functions.php";
/*if(isset($_SESSION['prodid']) && (trim($_SESSION['prodid'] != "")))
	   
	   {
			   }else{
		include_once "includes/inc_membr_session.php";
			   }*/
	if(isset($_REQUEST['selctyid']) && (trim($_REQUEST['selctyid']) != "")){ // creating Drop Down for City
		$ctryid = strip_tags(trim($_REQUEST['selctyid']));		
		$sqrymbrcnty_mst = "select 
								ctym_id,ctym_name,ctym_sts
						    from 
								vw_cntnt_cntry_cnty_cty_mst
						    where 
								(ctym_sts ='a' or ctym_sts ='u') and
							    ctym_cntym_id = $ctryid
						    order by 
								ctym_name";									
		$srsmbrcnty_mst	  	   = mysqli_query($conn,$sqrymbrcnty_mst) or die(mysql_error());
		while($srowmbrcnty_mst = mysqli_fetch_assoc($srsmbrcnty_mst)){
			$ctymid  = $srowmbrcnty_mst['ctym_id'];
			$ctymnm  = $srowmbrcnty_mst['ctym_name'];			
			$ctysts  = $srowmbrcnty_mst['ctym_sts'];			
			$dispstr .= ","."$ctymid:$ctymnm";
			if($ctysts =='u'){
			  	$dispstr .="*";
			}
		}
		$dispstr .= ","."co:Other";	
		$result = substr($dispstr,1);		
		echo $result;
	}
	if(isset($_REQUEST['selcntryid']) && (trim($_REQUEST['selcntryid']) != "")){	// creating Drop Down for County
		$result = "";		
		$cntryid = addslashes(trim($_REQUEST['selcntryid']));
		$sqrymbrcnty_mst =  "select 
								  cntym_id,cntym_name,cntym_sts
						     from 
							     cntry_mst 
							inner join cnty_mst on cntry_mst.cntrym_id = cnty_mst.cntym_cntrym_id
						   where
							 	 (cntym_sts ='a' or cntym_sts ='u') and
							     cntym_cntrym_id = $cntryid
						   group by 
							 	 cntym_id 
							order by 
								 cntym_name";
		$srsmbrcnty_mst	  = mysqli_query($conn,$sqrymbrcnty_mst) or die(mysql_error());
		$dispstr		  = "";
		while($srowmbrcnty_mst = mysqli_fetch_assoc($srsmbrcnty_mst)){
			$cntymid  = $srowmbrcnty_mst['cntym_id'];
			$cntymnm  = $srowmbrcnty_mst['cntym_name'];	
			$cntysts  = $srowmbrcnty_mst['cntym_sts'];		
			$dispcntystr .= ","."$cntymid:$cntymnm";
			if($cntysts =='u'){
			  	$dispcntystr .="*";
			}
		}
		$dispcntystr .= ","."so:Other";	
		$result = substr($dispcntystr,1);		
		echo $result;
	}
	if(isset($_REQUEST['selstateid']) && (trim($_REQUEST['selstateid']) != ""))	{
		// creating Drop Down for Country    
/**/		$result = "";		
		$stateid = addslashes(trim($_REQUEST['selstateid']));
		$sqrymbrcnty_mst =   "select 
							ctym_name,ctym_id 
						from 
							cty_mst
						inner join cnty_mst on ctym_cntym_id =cntym_id
						where  	ctym_cntym_id = '".$stateid."'";
							
		$srsmbrcnty_mst	  = mysqli_query($conn,$sqrymbrcnty_mst) or die(mysql_error());
		$dispstr		  = "";
		while($srowmbrcnty_mst = mysqli_fetch_assoc($srsmbrcnty_mst)){
			$cntymid  = $srowmbrcnty_mst['ctym_id'];
			$cntymnm  = $srowmbrcnty_mst['ctym_name'];			
			$dispstr .= ","."$cntymid:$cntymnm";	
		}
		//$dispstr .= ","."1001:Other";
		$result = substr($dispstr,1);		
		echo $result;
		   // checking Duplicate name for City name
	  /* $result = "";
		$name = strip_tags(substr(trim($_REQUEST['selcntntid']),0,249));		
		$sqrycty_mst = "select 
							ctym_name 
						from 
							cty_mst
						inner join cnty_mst on ctym_cntym_id =cntym_id
						where  	ctym_cntym_id = '".$name."'";
						
						
						//echo $sqrycty_mst;exit;
		if(isset($_REQUEST['cntyid']) && (trim($_REQUEST['cntyid']) != "")){
			$cntyid = glb_func_chkvl($_REQUEST['cntyid']);
			$sqrycty_mst .= " and  	ctym_cntym_id = $cntyid";	
		}	
		$srscty_mst  = mysqli_query($conn,$sqrycty_mst);
		$reccnt		   = mysqli_num_rows($srscty_mst);		
		if($reccnt > 0){
			$result = "<font color ='red'><b>Duplicate City name</b></font>";
		}
		echo $result;*/
	}
	
	if(isset($_REQUEST['cntyname']) && (trim($_REQUEST['cntyname']) != "")){
		$result = "";
		$name = strip_tags(substr(trim($_REQUEST['cntyname']),0,249));
		$sqrycnty_mst = "select 
							   cntym_name 
					  	 from 
						 	  cnty_mst
						  where 
						      cntym_name = '".mysqli_real_escape_string($conn,$name)."'";						
		if(isset($_REQUEST['cntyid']) && (trim($_REQUEST['cntyid']) != "")){
			$cntyid = glb_func_chkvl($_REQUEST['cntyid']);
			$sqrycnty_mst .= " and cntym_id != $cntyid";	
		}	
		$srscnty_mst  = mysqli_query($conn,$sqrycnty_mst);
		$reccnt		   = mysqli_num_rows($srscnty_mst);		
		if($reccnt > 0){
			$result = "<font color ='red'><b>Already State Name Exists</b></font>";
		}
		echo $result;
	}	
	if(isset($_REQUEST['ctyname']) && (trim($_REQUEST['ctyname']) != "")){
	   // checking Duplicate name for City name
	   $result = "";
		$name = strip_tags(substr(trim($_REQUEST['ctyname']),0,249));		
		$sqrycty_mst = "select 
							ctym_name 
						from 
							cty_mst
						inner join cnty_mst on ctym_cntym_id =cntym_id
						where ctym_name = '".mysqli_real_escape_string($conn,$name)."'";
		if(isset($_REQUEST['cntyid']) && (trim($_REQUEST['cntyid']) != "")){
			$cntyid = glb_func_chkvl($_REQUEST['cntyid']);
			$sqrycty_mst .= " and ctym_cntym_id = $cntyid";	
		}	
		$srscty_mst  = mysqli_query($conn,$sqrycty_mst);
		$reccnt		   = mysqli_num_rows($srscty_mst);		
		if($reccnt > 0){
			$result = "<font color ='red'><b>Duplicate City name</b></font>";
		}
		echo $result;
	}
?>