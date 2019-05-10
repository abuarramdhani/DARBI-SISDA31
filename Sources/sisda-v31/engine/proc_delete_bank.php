<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	$id_bank		= mysql_real_escape_string(htmlspecialchars($_GET["id"]));
	$token			= mysql_real_escape_string(htmlspecialchars($_GET["token"]));
	
	//Recheck it... re re re recheck it....
	$check_token =  substr(md5($id_bank.$darbi_key),0,15);
	
	//If it is absolutely the same,... we'll do it
	if($token == $check_token) {
	
		//here we go again baby,....
		$src_delete_bank	= "delete from bank where id ='$id_bank'";
		$query_delete_bank	= mysqli_query($mysql_connect, $src_delete_bank) or die ("There is an error with mysql: ".mysql_error());
	
	
		if($query_delete_bank) {
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
			$redirect_text	= "Bank sudah dihapus";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
		} else { echo "Nama Bank tidak dapat dihapus, hubungi Administrator"; }
	} else { echo "Token yang dikirim tidak dikenali, hubungi Administrator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungi administrator"; }
?>