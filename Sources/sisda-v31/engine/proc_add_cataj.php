<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	$type				= !empty($_POST["type"]) ? mysql_real_escape_string($_POST["type"]) : "";
	$name				= !empty($_POST["name"]) ? mysql_real_escape_string($_POST["name"]) : "";
	$opsi				= !empty($_POST["opsi"]) ? mysql_real_escape_string($_POST["opsi"]) : "";
	$nominal			= !empty($_POST["nominal"]) ? mysql_real_escape_string($_POST["nominal"]) : "";
	
	//here we go again baby,....
	$src_insert_cataj	= "insert into cataj (type,name,opsi,nominal) values ('$type','$name','$opsi','$nominal')";
	$query_insert_cataj	= mysqli_query($mysql_connect, $src_insert_cataj) or die ("There is an error with mysql: ".mysql_error());
	
	if($query_insert_cataj) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add catering / antar jemput";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=cataj";
		$redirect_text	= "Data <b>".$type."</b>, sudah didaftarkan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Catering / Antar jemput ditambahkan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>