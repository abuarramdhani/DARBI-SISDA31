<?PHP
include("sisda-config.php");

if(empty($_POST["case"])&& empty($_GET["case"])) {
	$redirect_path	= "";
	$redirect_icon	= "images/icon_false.png";
	$redirect_url	= "mainpage.php";
	$redirect_text	= "Halaman proses tidak dapat diakses";
	
	$need_redirect	= true;
	include_once ("include/redirect.php");	
} else{
	if(!empty($case_post)) {
		$current_case	= $_POST["case"];
	} else {
		echo "case : " . $_GET["case"];
		$current_case	= $_GET["case"];
	}
}

include_once("engine/proc_".$current_case.".php");
?>