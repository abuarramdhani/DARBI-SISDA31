<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "1") {
	$name		= htmlspecialchars($_POST["name"]);
	$username	= htmlspecialchars($_POST["username"]);
	$password	= htmlspecialchars($_POST["password1"]);
	$privilege	= htmlspecialchars($_POST["privilege"]);
	$status		= htmlspecialchars($_POST["status"]);
	
	//i'm too lazy to explain this hashing
	$eng_password	= substr(md5($password.$darbi_key),0,15);
	
	//we need to know user privilege explanation. so here we go....
	//the return variable is $priv_expl, use this var to insert the privilege explanation
	include("include/privilege.php");	
	$priv_expl = user_priv($privilege);
	
	//here we go again baby,....
	$src_insert_user	= "insert into user (name,username,password,privilege,priv_expl,status) values ('$name','$username','$password','$privilege','$priv_expl','$status')";
	$query_insert_user	= mysqli_query($mysql_connect, $src_insert_user) or die ("There is an error with mysql: ".mysql_error());
	
	if($query_insert_user) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add user";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=user_management";
		$redirect_text	= "User <b>".ucwords($name)."</b>, sudah didaftarkan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	}
}
?>