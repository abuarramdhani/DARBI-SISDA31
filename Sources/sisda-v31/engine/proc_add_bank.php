<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	$bank_name		= mysql_real_escape_string(htmlspecialchars($_POST["nama_bank"]));
	
	//here we go again baby,....
	$src_insert_bank	= "insert into bank (bank_name) values ('$bank_name')";
	$query_insert_bank	= mysqli_query($mysql_connect, $src_insert_bank) or die ("There is an error with mysql: ".mysql_error());
	
	if($query_insert_bank) {
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
		$redirect_url	= "mainpage.php?pl=bank";
		$redirect_text	= "Nama bank <b>".$bank_name."</b>, sudah didaftarkan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Nama bank gagal ditambahkan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>