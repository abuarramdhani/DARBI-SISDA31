<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$id_schspt		= mysql_real_escape_string(htmlspecialchars($_GET["id"]));
	$token			= mysql_real_escape_string(htmlspecialchars($_GET["token"]));
	
	//Recheck it... re re re recheck it....
	$check_token =  substr(md5($id_schspt.$darbi_key),0,15);
	
	//If it is absolutely the same,... we'll do it
	if($token == $check_token) {
	
		//here we go again baby,....
		$src_delete_schspt		= "delete from school_support where id ='$id_schspt'";
		$query_delete_schspt	= mysqli_query($mysql_connect, $src_delete_schspt) or die ("There is an error with mysql: ".mysql_error());
	
	
		if($query_delete_schspt) {
			//---------------------------------------
			//here are variables that used in prog_log.php
			include_once("include/url.php");
			$activity	= "Hapus item school support";
			$url		= curPageURL();
			$id			= $_SESSION["id"];
			$need_log	= true;
			include_once("include/log.php");
			//---------------------------------------
			
			$redirect_path	= "";
			$redirect_icon	= "images/icon_true.png";
			$redirect_url	= "mainpage.php?pl=delete_item_school_support";
			$redirect_text	= "Item School Support sudah dihapus";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
		} else { echo "Item Support tidak dapat dihapus, hubungi Administrator<br>[error 1]"; }
	} else { echo "Token yang dikirim tidak dikenali, hubungi Administrator<br>[error 2]"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungi administrator<br>[error 3]"; }
?>