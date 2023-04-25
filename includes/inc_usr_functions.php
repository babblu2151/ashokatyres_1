<?php
	//Function for checking the valid values
	
	function glb_func_chkvl($cntrlval)
	{
		$crntval = $cntrlval;
		$newval =  htmlspecialchars(trim($cntrlval),ENT_QUOTES);
		return $newval;		
	}	
	function funcUpdtRecSts($tblnm,$idfldnm,$idval,$ufldnm,$curval,$conn){
	         
		$tblname 	= $tblnm;    // Stores the table name
		$idfldname  = $idfldnm;  //Stores the id field name
		$recid	 	= $idval;    // Stores the id value
		$updtfldnm  = $ufldnm;   // Stores the update field name
		$curfldval	= $curval;  // Stores the current field value
		$updtval 	= "";
		
		if($curfldval == 'a'){
			$updtval = 'i';
		}
		elseif($curfldval == 'i'){
			$updtval = 'a';
		}		
		$funcuqry = "update $tblname
				 	 set $updtfldnm = '$updtval'
				 	 where $idfldname = $recid";		
		mysqli_query($conn,$funcuqry);	
		if(mysqli_query($conn,$funcuqry))
		{
			return  "y";
		}
		else
		{
			return "n";
		}		
		$funcuqry = "";
	}	
/*	function funcUpdtAllRecSts($tblnm,$idfldnm,$idval,$ufldnm){	
		$tblname 	= $tblnm;    // Stores the table name
		$idfldname  = $idfldnm;  //Stores the id field name
		$recid	 	= $idval;    // Stores the id value
		$updtfldnm  = $ufldnm;   // Stores the update field name
		$updtval 	= "";			
		$funcuqry = "update $tblname set 
					 	$updtfldnm = if($updtfldnm='a','i','a') 
				 	 where 
					 	$idfldname in($recid)";				
		if(mysqli_query($conn,$funcuqry)){
			$updtval = mysqli_affected_rows($conn);						
		}
		return  $updtval;
		$funcuqry = "";
	}*/
		/*function funcUpdtAllRecSts($tblnm,$idfldnm,$idval,$ufldnm)
	{
		$tblname 	= $tblnm;    // Stores the table name
		$idfldname  = $idfldnm;  //Stores the id field name
		$recid	 	= $idval;    // Stores the id value
		$updtfldnm  = $ufldnm;   // Stores the update field name
		$updtval 	= "";
			
		$funcuqry = "update $tblname
				 	 	  set 
					      $updtfldnm =if($updtfldnm='a','i','a') 
				 	      where $idfldname in($recid)";		
		if(mysqli_query($conn,$funcuqry)){
			return  "y";
		}
		else{
			return "n";
		}		
		$funcuqry = "";
	}*/
	function funcUpdtAllRecSts($conn,$tblnm,$idfldnm,$idval,$ufldnm){	
		$tblname 	= $tblnm;    // Stores the table name
		$idfldname  = $idfldnm;  //Stores the id field name
		$recid	 	= $idval;    // Stores the id value
		$updtfldnm  = $ufldnm;   // Stores the update field name
		$updtchkval = $chkval;   //Chkbox Value
		$updtval 	= "";		
		$funcuqry = "update $tblname set";
		
		if($updtchkval =='n'){
			$funcuqry .= " $updtfldnm='i'";
		}
		elseif($updtchkval =='y'){
			$funcuqry .= " $updtfldnm='a'";
		}		
		if($updtchkval == ''){	
			$funcuqry .= " $updtfldnm =if($updtfldnm='a','i','a') 
				 	      where $idfldname in($recid)";		
		}
		if(mysqli_query($conn,$funcuqry)){
			return  "y";
		}
		else{
			return "n";
		}		
		$funcuqry = "";
	}
	function funcDelAllRec($conn,$tblnm,$idfldnm,$idval)
	{
		$tblname 	= $tblnm; // Stores the table name
		$idfldname  = $idfldnm; //Stores the id field name
		$recid	 	= $idval; // Stores the id value		
		$funcdqry = "delete from $tblname
				 	 where $idfldname in($recid)";		
		if(mysqli_query($conn,$funcdqry))
		{
			return  "y";
		}
		else
		{
			return "n";
		}	
		$funcdqry = "";
	}	
	function funcDelRec($tblnm,$idfldnm,$idval,$conn){	
		$tblname 	= $tblnm; // Stores the table name
		$idfldname  = $idfldnm; //Stores the id field name
		$recid	 	= $idval; // Stores the id value		
		$funcdqry = "delete from $tblname
				 	 where $idfldname = $recid";		
		if(mysqli_query($conn,$funcdqry))
		{
			return  "y";
		}
		else
		{
			return "n";
		}	
		$funcdqry = "";
	}
	/*function funcDelAllRec($tblnm,$idfldnm,$idval){
	
		$tblname 	= $tblnm; // Stores the table name
		$idfldname  = $idfldnm; //Stores the id field name
		$recid	 	= $idval; // Stores the id value	
		$del_qrysts	= ""; 	
		$funcdqry = "delete from $tblname
				 	 where $idfldname in($recid)";		
		if(mysqli_query($conn,$funcdqry)){
			$del_qrysts = mysqli_affected_rows($conn);
		}
		return $del_qrysts;
		$funcdqry = "";
	}		*/
	function funcGetImg ($tblnm,$idval,$sidfldnm,$idfldnm)
	{
		$tblname 	= $tblnm; // Stores the table name
		$sidfldname  = $sidfldnm; //Stores the id field name
		$idfldname  = $idfldnm; //Stores the id field name
		$recid	 	= $idval; // Stores the id value	
		$fieldval	= "";
		$funcsqry = "select $sidfldname from $tblname
				 	 	 where $idfldname in($recid)";	
		
		$funcsrs	= mysqli_query($conn,$funcsqry);
		while($funcsrow	= mysqli_fetch_array($funcsrs))
		{
			$fieldval	= $fieldval.",".$funcsrow[$sidfldname];
		}
		 $newfieldval = substr($fieldval,1);
		return $newfieldval;
		$funcsqry = "";	
		$newfieldval = "";
	}
	function funcRmvFle($tblnm,$updtfldnm,$updtfldval,$idfldnm,$idval)
	{
		$tblname 	 = $tblnm; // Stores the table name
		$ufldname 	 = $updtfldnm; //Stores the update field name
		$ufldval  	 = $updtfldval; //Stores the update field name
		$idfldname   = $idfldnm; //Stores the id field name
		$recid	 	 = $idval; // Stores the id value
				
		$funcuqry = "update $tblnm
					 set $ufldname = '$ufldval'
					 where $idfldnm = '$recid'";	
					 					 
		if(mysqli_query($conn,$funcuqry))
		{
			return  "y";
		}
		else
		{
			return "n";
		}	
		$funcuqry = "";
	}
	
	/***************************************************/
	/********Function for displaying the status*********/
	/***************************************************/
	
	function funcDispSts($cursts)
	{			
		$recsts = $cursts;		
		if($recsts == 'a')
		{
			return 'Active';
			
		}
		elseif($recsts == 'i')
		{
			return 'Inactive';
			
		}
		elseif($recsts == 'u')
		{
			return  'Invalid';
			
		}
	}
	
	
	
	function funcDispShpngCntry($cursts)
	{			
		$recsts = $cursts;		
		if($recsts == '2')
		{
			return 'India';
			
		}
		elseif($recsts == '1')
		{
			return 'Other Countries';
			
		}
	}
	
	
	function funcDispMedium($cursts)
	{			
		$recsts = $cursts;		
		if($recsts == 'a')
		{
			return 'All';
			
		}
		elseif($recsts == 'l')
		{
			return 'Languges Known';
			
		}
		elseif($recsts == 'm')
		{
			return 'Medium';
			
		}
	}	
	function funcDisptyp($cursts)
	{			
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Day';
			
		}
		elseif($recsts == '2')
		{
			return 'Month';
			
		}
		elseif($recsts == '3')
		{
			return 'Year';
			
		}
	}	
	/******************************************************/	
	
	/***************************************************/
	/********Function for displaying the current********/
	/***************************************************/
	
	function funcDispCrnt($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == 'y')
		{
			return 'Yes';
		}
		elseif($recsts == 'n')
		{
			return 'No';
		}
	}	
	function funcDispType($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == '1')
		{
			return 'Media';
		}
		elseif($recsts == '2')
		{
			return 'Gallery';
		}
		elseif($recsts == '3')
		{
			return 'Events';
		}
	}		
	function funcDispPos($cursts)
	{		
		$recsts = $cursts;		
		if($recsts == 'l')
		{
			return 'Left';
		}
		elseif($recsts == 'r')
		{
			return 'Right';
		}
		elseif($recsts == 'c')
		{
			return 'Center';
		}
	}
	function funcDsplyTyp($cursts){
		if($cursts == '0'){
			return 'General';
		}
		elseif($cursts == '1'){
			return 'Assorted Sets';
		}
		elseif($cursts == '2'){
			return 'Featured Products';
		}
		elseif($cursts == '3'){
			return 'New Arrivals & Best Sellers';
		}
		elseif($cursts == '4'){
			return 'New Arrivals';
		}	
		elseif($cursts == '6'){
			return 'Monthly Special';
		}
		elseif($cursts == '7'){
			return 'Festive Collection';
		}
		elseif($cursts == '8'){
			return 'Home';
		}
		elseif($cursts == '9'){
			return 'Ready To Ship';
		}
	}
	
	function funcDsplyAltTyp($cursts){
		if($cursts == 'k'){
			return 'Type1';
		}
		elseif($cursts == 'l'){
			return 'Type2';
		}
		
		}
	
	
	function get_months($date1, $date2)
	{ 
  		 $time1  = strtotime($date1); 
   		 $time2  = strtotime($date2); 
   		 $my     = date('mY', $time2); 
	     $months = array(date('F', $time1)); 
   		$f      = ''; 
	   while($time1 < $time2) { 
			  $time1 = strtotime((date('Y-m-d', $time1).' +15days')); 
			  if(date('F', $time1) != $f) { 
				 $f = date('F', $time1); 
				 if(date('mY', $time1) != $my && ($time1 < $time2)) 
					$months[] = date('F', $time1); 
			  } 
		   } 
		  $months[] = date('F', $time2); 
   return $months; 
} 
function GetDays($sStartDate, $sEndDate)
{   
	 $sStartDate = date("Y-m-d", strtotime($sStartDate));   
	 $sEndDate   = date("Y-m-d", strtotime($sEndDate));   
 	 $aDays[] = $sStartDate;   
	 $sCurrentDate = $sStartDate;   
     while($sCurrentDate < $sEndDate)
	 {   
     	 $sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));   
        $aDays[] = $sCurrentDate;   
     }   

  return $aDays;   
} 
function days_between($datefrom,$dateto)
{ 
    $fromday_start = mktime(0,0,0,date("m",$datefrom),date("d",$datefrom),date("Y",$datefrom)); 
	$diff = $dateto - $datefrom;  
    $days = intval( $diff / 86400 );
    if( ($datefrom - $fromday_start) + ($diff % 86400) > 86400 )   
	   $days++;    
	return  $days; 
}  
function weeks_between($datefrom, $dateto) 
{     
	$day_of_week = date("w", $datefrom);    
	$fromweek_start = $datefrom - ($day_of_week * 86400) - ($datefrom % 86400);  
	$diff_days = days_between($datefrom, $dateto);   
	$diff_weeks = intval($diff_days / 7);   
	$seconds_left = ($diff_days % 7) * 86400;   
	if( ($datefrom - $fromweek_start) + $seconds_left > 604800 )   
	   $diff_weeks ++;    
  return $diff_weeks;
 } 
	  $month_array = array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July',
			  						  '8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
									  
									  
	

	function funcSzRplc($prmstr){		 
		 // echo $prmstr;
		  $gnrtstr = str_replace(';',', ',$prmstr);

		return $gnrtstr;		 
	}

	function funcStrRplc($prmstr){		 
		$gnrtstr = strtolower(str_replace(' ','-',$prmstr));
		 $gnrtstr = strtolower(str_replace('.','-',$gnrtstr));
		  $gnrtstr = strtolower(str_replace(':','-',$gnrtstr));
		  $gnrtstr = strtolower(str_replace(',','-',$gnrtstr));

		return $gnrtstr;		 
	}	
	function funcStrUnRplc($prmstr){		 
		$gnrtstr = strtolower(str_replace('-',' ',$prmstr));
		return $gnrtstr;		
	}
	
	function funcPayMod($cursts)
	{
		if($cursts == 'c')
		{
			return 'Pay By Net Banking';		
		}
		elseif($cursts == 'b')
		{
			return "Pay By Credit Card";		
		}
		elseif($cursts == 'a')
		{
			return 'Cash On Delivery';		
		}
		elseif($cursts == 'd')
		{
			return 'Pay By Debit Card';		
		}
		elseif($cursts == 'o')
		{
			return 'Online Payment';		
		}
	}
	function funcCrncyNm($crncyval){
		$crncyfxval = $crncyval;
		if($crncyfxval == 1){
			return 'INR';
		}
		elseif($crncyfxval == 2){
			return 'USD';
		}
		elseif($crncyfxval == 3){
			return 'EUR';
		}		
		elseif($crncyfxval == 4){
			return 'GBP';
		}
		elseif($crncyfxval == 5){
			return 'AUD';
		}
		elseif($crncyfxval == 6){
			return 'AED';
		}	
		elseif($crncyfxval == 7){
			return 'BDT';
		}				
	
/**********************************************************Dolar Price ***************************/	
	
	
	
	
	
	
	
	
	
	
	
	}
	
	function funcDlrprc($inrprc,$conn){
					$sqrydolr_mst="select 
								   dolrm_id,dolrm_prc,dolrm_desc,
								   dolrm_prty,dolrm_sts
							   from 
							   dolr_mst
							   where
							   dolrm_sts = 'a' 
		                     order by dolrm_prty asc limit 1";
               	$sqrydolr_mst=mysqli_query($conn,$sqrydolr_mst);
				$rwsdolr_mst = mysqli_fetch_array($sqrydolr_mst);
				$dlrval = $rwsdolr_mst['dolrm_prc']; 
	
     $dlrprc = $inrprc/$dlrval;
	 $dlrprc = number_format($dlrprc, 2) ;
		return $dlrprc;		 
	}
?>