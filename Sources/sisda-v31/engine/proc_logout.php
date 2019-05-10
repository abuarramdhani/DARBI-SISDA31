<?PHP
session_start();

$id_user		= $_SESSION["id"];
$src_name		= "select name from user where id='$id_user'"; 
$query_name		= mysqli_query($mysql_connect, $src_name) or die("There is an error with mysql: ".mysql_error());
$row_name		= mysql_fetch_array($query_name);

$_SESSION	= array();

if(session_destroy()) {

	//here are variables that used in prog_log.php
	include_once("include/url.php");
	$activity	= "Logout";
	$url		= curPageURL();
	$id			= $id_user;
	
	//call him
	$need_log	= true;
	include_once("include/log.php");
	
	//here are variables that used in redirect.php
	$redirect_path	= "";
	$redirect_icon	= "images/icon_true.png";
	$redirect_url	= "";
	$redirect_text	= "Terima kasih <B>".$row_name["name"]."</B> telah menggunakan Sisda-V3<br>proses logout anda berhasil";
	
	//call him also, baby
	$need_redirect	= true;
	include ("include/redirect.php");

}
?>