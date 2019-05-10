<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$no_sisda	= mysql_real_escape_string(htmlspecialchars($_POST["no_sisda"]));
	$kelas		= mysql_real_escape_string(htmlspecialchars($_POST["kelas"]));
	$periode	= mysql_real_escape_string(htmlspecialchars($_POST["periode"]));
	
	//Yea-yea-yea... come on baby.....
	$src_add_class		= "update siswa_finance set kelas = '$kelas' where no_sisda ='$no_sisda' and periode = '$periode'";
	$query_add_class	= mysqli_query($mysql_connect, $src_add_class);
	
	
	if($query_add_class) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add bank name";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=adm_kelas&kls=$kelas&th=$periode";
		$redirect_text	= "Kelas <b>".$kelas."</b>, sudah didaftarkan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
		
	} else { echo "Kelas gagal ditambahkan, hubungi administator"; }
	
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>