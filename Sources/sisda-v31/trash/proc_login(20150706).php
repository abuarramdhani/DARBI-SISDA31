<?PHP
session_start();
//error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL);

//sandy said: yea... connect to db...:)
include ("sisda-config.php");

/////////////////////////---- i'm too lazy to explain this step----////////////////////////////////////
////////////////----but the point is, -this step is needed to make your engine secure-----/////////////
if (isset($_POST["username"]) && isset($_POST["password"])) {

	//----------------------------------------------------------------------------
	$get_username = htmlspecialchars($_POST["username"]);
	$get_password = htmlspecialchars($_POST["password"]);	

	if(get_magic_quotes_gpc())	{

		$fil_username     = stripslashes($get_username);
		$fil_password_src = stripslashes($get_password);
	} 
	else {	

		$fil_username     = $get_username;
		$fil_password_src = $get_password;
	}	
	
	//encrypt untuk check get DB
	$fil_password         = substr(md5($fil_password_src.$darbi_key),0,15);	

	$login_query_src = sprintf("select id,name,privilege,ip_address from user where username = '%s' and password = '%s'",
						mysql_real_escape_string($fil_username),
						mysql_real_escape_string($fil_password));
    /////////////////////////---- the security ends here---//////////////////////////////
	$query_login = mysqli_query($mysql_connect, $login_query_src) or die ("There is an error with mysql: ".mysql_error());
	
	
	//we have to check first, whether the query result return zero
	$num_row = mysql_num_rows($query_login);
	//send the result into array
	$row    = mysql_fetch_array ($query_login);
	
	//query found the user data in database
	if ($num_row != "0") {	
	
		//Please look at table kontrol_bulan_spp (include/check_date_error.php)
		//it CANNOT BE EMPTY,
		//it should be filled with data of the first time when this application starts
		//it should be starting from july
		
		//////////////////////////////////////
		////periode 		= 2013 - 2014 ////
		////periode_begin	= 2013        ////
		////real_year		= 2013        ////
		////bulan			= july        ////
		////real_month	= 7           	  ////
		//////////////////////////////////////
		
		include_once("include/check_date_error.php");
		
		if($year_status == "okay" && $month_status	== "okay") {
		
			//both are the sessions that need to be registered
			$id_user				= $row["id"];
			$_SESSION["id"]			= $id_user;		
			$_SESSION["privilege"] 	= $row["privilege"];
			
			
			//we need to execute a page that check whether current month (for SPP payment) already defined or not yet
			include_once("include/define_month_spp.php");
			
			//we need to execute a page that check if a student has an arrear of their SPP payment
			include_once("include/check_spp_arrear.php");
			
			//we need the user ip address for setting the background
			//$user_ip = current ip when user access system. compare it with the existing one in database.
			$user_ip	= $_SERVER['REMOTE_ADDR'];
			if(empty($row["ip_address"]) || $row["ip_address"] != $user_ip) { 
				$src_update_ip		= "update user set ip_address = '$user_ip' where id = '$id_user'"; 
				$query_update_ip	= mysqli_query($mysql_connect, $src_update_ip) or die ("There is an error with mysql: ".mysql_error());
			}
			//---------------------------------------
			//here are variables that used in prog_log.php
			include_once("include/url.php");
			$activity	= "Login";
			$url		= curPageURL();
			$id			= $id_user;	
			$need_log	= true;
			include_once("include/log.php");
			//---------------------------------------
			
			
			//here are variables that used in redirect.php
			$redirect_path	= "";
			$redirect_icon	= "images/icon_true.png";
			$redirect_url	= "mainpage.php";
			$redirect_text	= "Selamat datang <B>".$row["name"]."</B><br>proses login anda berhasil";
			
			//call him also, baby
			$need_redirect	= true;
			include ("include/redirect.php");
			
		} else {
		
			echo $note_error;
		
		}
			
	} else {
	//query can't found the user data in database	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "index.php";
		$redirect_text	= "Anda memasukan username atau password yang salah";
		
		$need_redirect	= true;
		include ("include/redirect.php");	
		
	}
}
?>