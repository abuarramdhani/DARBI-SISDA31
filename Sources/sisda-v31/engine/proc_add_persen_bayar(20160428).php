<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$periode 		= mysql_real_escape_string(htmlspecialchars($_POST["periode"]));
	$daful_tka 		= mysql_real_escape_string(htmlspecialchars($_POST["daful_tka"]));
	$daful_tkb 		= mysql_real_escape_string(htmlspecialchars($_POST["daful_tkb"]));
	$spp_tk 		= mysql_real_escape_string(htmlspecialchars($_POST["spp_tk"]));
	$ict_tk 		= mysql_real_escape_string(htmlspecialchars($_POST["ict_tk"]));
	$elearning_tk 	= mysql_real_escape_string(htmlspecialchars($_POST["elearning_tk"]));
	$ks_tk 			= mysql_real_escape_string(htmlspecialchars($_POST["ks_tk"]));
	$spp_sd 		= mysql_real_escape_string(htmlspecialchars($_POST["spp_sd"]));
	$ict_sd 		= mysql_real_escape_string(htmlspecialchars($_POST["ict_sd"]));
	$elearning_sd 	= mysql_real_escape_string(htmlspecialchars($_POST["elearning_sd"]));
	$ks_sd 			= mysql_real_escape_string(htmlspecialchars($_POST["ks_sd"]));
	$spp_smp 		= mysql_real_escape_string(htmlspecialchars($_POST["spp_smp"]));
	$ict_smp 		= mysql_real_escape_string(htmlspecialchars($_POST["ict_smp"]));
	$elearning_smp 	= mysql_real_escape_string(htmlspecialchars($_POST["elearning_smp"]));
	$ks_smp 			= mysql_real_escape_string(htmlspecialchars($_POST["ks_smp"]));
	
	$check_exist 	= "select id from persen_bayar where periode = '$periode'";
	$query_exist 	= mysqli_query($mysql_connect, $check_exist) or die ("There is an error with mysql: ".mysql_error());
	$num_exixt		= mysql_num_rows($query_exist);
	
	if($num_exixt == 0) {
	
		//here we go again baby,....
		$src_insert_persen		= "insert into persen_bayar (
									periode,
									daful_tka,
									daful_tkb,
									spp_tk,
									ict_tk,
									elearning_tk,
									ks_tk,
									spp_sd,
									ict_sd,
									elearning_sd,
									ks_sd,
									spp_smp,
									ict_smp,
									elearning_smp,
									ks_smp
									) 
									values 
									(
									'$periode',
									'$daful_tka',
									'$daful_tkb',
									'$spp_tk',
									'$ict_tk',
									'$elearning_tk',
									'$ks_tk',
									'$spp_sd',
									'$ict_sd',
									'$elearning_sd',
									'$ks_sd',
									'$spp_smp',
									'$ict_smp',
									'$elearning_smp',
									'$ks_smp'
									)";
		$query_insert_persen	= mysqli_query($mysql_connect, $src_insert_persen) or die ("There is an error with mysql: ".mysql_error());
	
		$exist_log 	= true;
		$exist_icon = "true";
		$exist_text = "Persen pembayaran anak guru untuk tahun <b>".$periode."</b>, sudah didaftarkan";
		$query_ok	= true;
	
	} else {
	
		$exist_log 	= false;
		$exist_icon = "false";
		$exist_text = "Persen pembayaran anak guru untuk tahun <b>".$periode."</b>, tidak bisa disimpan, karena sudah pernah dibuat";
		$query_ok	= true;
	
	}
	
	if($query_ok == true) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add persen bayar";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= $exist_log;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_".$exist_icon.".png";
		$redirect_url	= "mainpage.php?pl=persen_bayar";
		$redirect_text	= $exist_text;
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Persen pembayaran anak guru untuk tahun <b>".$periode."</b> tidak dapat dilakukan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>