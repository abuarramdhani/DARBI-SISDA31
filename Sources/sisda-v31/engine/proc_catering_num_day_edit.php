<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$daftar_catering	= !empty($_POST["daftarkan"]) ? $_POST["daftarkan"] : "";
	$berhenti_catering	= !empty($_POST["berhenti"]) ? $_POST["berhenti"] : ""; 
	$back_url			= $_POST["back_url"];
		
	//Grab all...bezzzzziiig
	$bulan			= !empty($_POST["the_month"]) ? htmlspecialchars($_POST["the_month"]) : "";
	$tahun			= !empty($_POST["edu_year"]) ? htmlspecialchars($_POST["edu_year"]) : "";
	$num_day		= !empty($_POST["catering_num_day"]) ? htmlspecialchars($_POST["catering_num_day"]) : "";
	$src_siswa		= !empty($_POST["pilih"]) ? $_POST["pilih"] : "";
	
	$bulan_enc		= mysql_real_escape_string($bulan);
	$tahun_enc		= mysql_real_escape_string($tahun);
	$num_day_enc	= mysql_real_escape_string($num_day);
	
	//Someday you'll find me caught beneath in a land slide...........
	
	//We have to ensure that all of the data tat we need has been sent here
	//Other wise, do not do the process
	
	if($bulan != "" && $tahun != "" && $num_day != "" && $src_siswa != "") {
	
		if($bulan_enc == 1){ $bulan_tung = "jan_cataj"; }
		if($bulan_enc == 2){ $bulan_tung = "feb_cataj"; }
		if($bulan_enc == 3){ $bulan_tung = "mar_cataj"; }
		if($bulan_enc == 4){ $bulan_tung = "apr_cataj"; }
		if($bulan_enc == 5){ $bulan_tung = "may_cataj"; }
		if($bulan_enc == 6){ $bulan_tung = "jun_cataj"; }
		if($bulan_enc == 7){ $bulan_tung = "jul_cataj"; }
		if($bulan_enc == 8){ $bulan_tung = "aug_cataj"; }
		if($bulan_enc == 9){ $bulan_tung = "sep_cataj"; }
		if($bulan_enc == 10){ $bulan_tung = "oct_cataj"; }
		if($bulan_enc == 11){ $bulan_tung = "nov_cataj"; }
		if($bulan_enc == 12){ $bulan_tung = "des_cataj"; }	
				
		//How many checkbox has been checked????
		$num_siswa		= count($src_siswa);		
		
		//Let's do it, as much as the number of checked checkbox
		for($i=0; $i < $num_siswa; $i++) {
						
			$siswa_expl		= explode("-",$src_siswa[$i]); 
			$cur_no_sisda	= $siswa_expl[0];
			$nominal		= $siswa_expl[1];
			$val_cataj		= "4-".($nominal*$num_day_enc);
			
			//---Cause all of the stars are fading away. Just try not to worry and you'll see it someday. Take what you need i'll be on your way and stop crying your heart out---

			$src_update_tunggakan	= "update tunggakan set $bulan_tung = '$val_cataj' where jenis_tunggakan = 'catering' and no_sisda = '$cur_no_sisda' and periode = '$tahun_enc'";
			$query_update_tunggakan	= mysqli_query($mysql_connect, $src_update_tunggakan) or die(mysql_error());	
			
		}
	}		
	
	if($query_update_tunggakan) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Merubah jumlah hari catering";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= $back_url;
		$redirect_text	= "Jumlah hari catering sudah di edit";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Catering / Antar jemput tidak dapat ditambahkan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>