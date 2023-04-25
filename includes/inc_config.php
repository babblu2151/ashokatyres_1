<?php	
global $pgtl,$usr_pgtl;	
$pgtl = "Ashoka Tyres";	
$usr_pgtl	= "Ashoka Tyres";
date_default_timezone_set('UTC');
$crntyr = date('Y');
if($crntyr != 2021)
{
	$prd	= "2021" .'--'. $crntyr;
}
else
{
	$prd = 2021;
}
$pgftr = "$prd, $pgtl Designed &amp; Developed By";
$usr_cmpny = "Ashoka Tyres";
$u_prjct_url = "Ashokatyre.com";
//$u_prjct_mnurl = "www.vanitafashion.com";
$u_prjct_url1 = "info@Ashokatyre.com";
$u_prjct_mnurl = "www.Ashokatyre.com";
$u_prjct_mnurlhttp = "http://Ashokatyre.com/";
$prjct_dmn = "info@Ashokatyre.com";
$u_prjct_email = "info@Ashokatyre.com";
$u_prjct_email_contact = "info@Ashokatyre.com";
$u_prjct_email_info = "info@Ashokatyre.com";
$site_logo = 'images/Ashokatyre-logo.png';
$site_logo2 = 'images/Ashokatyre-logo.png';
$site_mail_logo = 'images/Ashokatyre-logo.png';
$adm_logo = '../images/Ashokatyre-logo.png';

$rtpth = "/projects/a/ashokatyres_1/";
/**************include files*****************/
/**************include files*****************/
$inc_nocache = "../includes/inc_nocache.php";
$adm_session = "../includes/inc_adm_session.php";
$inc_cnctn = "../includes/inc_connection.php";
$inc_usr_fnctn = "../includes/inc_usr_functions.php";
$inc_fnct_fleupld	= "../includes/inc_fnct_fleupld.php";
$inc_adm_hdr = "../includes/inc_adm_header.php";
$inc_adm_lftlnk = "../includes/inc_adm_leftlinks.php";
$inc_adm_ftr = "../includes/inc_adm_footer.php";
$inc_fnc_ajax_vdtn = "../includes/inc_fnct_ajax_validation.php";
$inc_fldr_pth = "../includes/inc_folder_path.php";
$inc_pgng_fnctns	= "../includes/inc_paging_functions.php";
$inc_pgng1 = "../includes/inc_paging1.php";
$adm_scrpt = '../admin/script.php';
$vndr_session = "../includes/inc_vndr_session.php";
$inc_vndr_lftlnk = "../includes/inc_vndr_toplinks.php";
/*****************User*************************/
/*****************User*************************/
$inc_user_cnctn = "includes/inc_connection.php";
$inc_user_usr_fnctn = "includes/inc_usr_functions.php";
$inc_user_fnct_fleupld = "includes/inc_fnct_fleupld.php";
$inc_user_fnc_ajax_vdtn = "includes/inc_fnct_ajax_validation.php";
$inc_user_fldr_pth = "includes/inc_folder_path.php";
$inc_user_pgng_fnctns = "includes/inc_paging_functions.php";
$inc_user_pgng1 = "includes/inc_paging1.php";
$inc_user_usrsesn = "includes/inc_usr_sessions.php";
$inc_user_lftblck = "leftblock.php";
$inc_user_rgtblck = "rightblock.php";
$inc_user_ftr = "footer.php";
$inc_user_hdr = "header.php";
$inc_user_hotprgm = "hot-programs.php";
$inc_user_socialhub = "social-hub.php";
$inc_user_hmright = "home-right.php";
$inc_user_upcmngcrses = "upcoming-courses.php";
$inc_user_rqinffrm = "req-info-form.php";
$inc_user_rltedprgrm = "related-programs.php";
$inc_usr_nocache = "includes/inc_nocache.php";
?>