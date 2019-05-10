<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	//these data taken from page_seeting_spp.php
	$jenjang	= htmlspecialchars($_POST["jenjang"]);
	$ket_disc	= htmlspecialchars($_POST["ket_disc"]);
	$period		= htmlspecialchars($_POST["period"]);
	$spp		= htmlspecialchars($_POST["spp"]);
	$ict		= htmlspecialchars($_POST["ict"]);
	$pta		= htmlspecialchars($_POST["pta"]);
	
	//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
	//So here we will make a filter to avoid data duplication.
	//Check if the new data already exist in database.
	//2 fields have to be checked are jenjang, ket_disc and period
	
	$src_check_exist	= "select id from set_spp where jenjang = '$jenjang' and ket_disc = '$ket_disc' and periode = '$period'";
	$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
	$num_check_exist	= mysql_num_rows($query_check_exist);
	
	//tell admin if the data already exist
	if($num_check_exist != 0) {
			
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=setting_spp";
		$redirect_text	= "Nominal untuk jenjang $jenjang, periode $period dan untuk $ket_disc sudah di buat. Jika ingin merubahnya silahkan lakukan proses edit";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else {
		//if the data hasnt be defined, go ahead.
		$src_insert_spp 		= "insert into set_spp (jenjang,periode,spp,ict,pta,ket_disc) values ('$jenjang','$period','$spp','$ict','$pta','$ket_disc')";
		$query_insert_spp	= mysqli_query($mysql_connect, $src_insert_spp) or die ("There is an error with mysql: ".mysql_error());
		
		if($query_insert_spp) {
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
			$redirect_url	= "mainpage.php?pl=setting_spp";
			$redirect_text	= "Nilai SPP/ICT/PTA sudah disimpan";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
		}
	}
}
?>