<?PHP
session_start();
//privilege 2 is finance admin: Bu fitri gitu lhooohhh
if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	//these data taken from page_seeting_disc_adm.php
	$jenjang		= htmlspecialchars($_POST["jenjang"]);
	$cat_adm		= htmlspecialchars($_POST["cat_adm"]);
	$disc_cat_adm	= htmlspecialchars($_POST["disc_cat_adm"]);
	$period			= htmlspecialchars($_POST["period"]);
	$nominal		= htmlspecialchars($_POST["nominal"]);
	
	//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
	//So here we will make a filter to avoid data duplication.
	//Check if the new data already exist in database.
	//2 fields have to be checked are jenjang, cat_adm, disc_cat_adm and period
	
	$src_check_exist	= "select id from set_disc_adm where jenjang = '$jenjang' and cat_adm = '$cat_adm' and disc_cat_adm = '$disc_cat_adm' and periode = '$period'";
	$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
	$num_check_exist	= mysql_num_rows($query_check_exist);
	
	//tell admin if the data already exist
	if($num_check_exist != 0) {
			
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=setting_disc_adm";
		$redirect_text	= "Nominal untuk jenjang $jenjang, kategory administrasi $cat_adm, discount kategory administrasi $disc_cat_adm untuk periode $period sudah pernah di buat. Jika ingin merubahnya silahkan lakukan proses edit";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else {
		//if the data hasnt be defined, go ahead.
		$src_disc_adm 		= "insert into set_disc_adm (jenjang,cat_adm,disc_cat_adm,periode,nominal) values ('$jenjang','$cat_adm','$disc_cat_adm','$period','$nominal')";
		$query_disc_adm		= mysqli_query($mysql_connect, $src_disc_adm) or die ("There is an error with mysql: ".mysql_error());
		
		if($query_disc_adm) {
			//---------------------------------------
			//here are variables that used in log.php
			include_once("include/url.php");
			$activity	= "Set SPP value";
			$url		= curPageURL();
			$id			= $_SESSION["id"];
			$need_log	= true;
			include_once("include/log.php");
			//---------------------------------------
			
			$redirect_path	= "";
			$redirect_icon	= "images/icon_true.png";
			$redirect_url	= "mainpage.php?pl=setting_disc_adm";
			$redirect_text	= "Nilai SPP/ICT/PTA sudah disimpan";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
		}
	}
}
?>