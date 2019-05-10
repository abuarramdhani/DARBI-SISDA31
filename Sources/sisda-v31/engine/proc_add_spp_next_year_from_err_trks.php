<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$src_no_sisda 	= empty($_POST["n"]) ? '' : $_POST["n"]; //echo $src_no_sisda."<br>";
	$src_periode	= empty($_POST["p"]) ? '' : $_POST["p"]; //echo $src_periode."<br>";
	$src_tingkat	= empty($_POST["t"]) ? '' : $_POST["t"]; //echo $src_tingkat."<br>";
	$src_status		= empty($_POST["s"]) ? '' : $_POST["s"]; //echo $src_status."<br>";
	$src_jenjang	= empty($_POST["j"]) ? '' : $_POST["j"]; //echo $src_jenjang."<br>";
	$src_nama		= empty($_POST["na"]) ? '' : $_POST["na"]; //echo $src_nama."<br>";
	$src_nama_slash	= addslashes($src_nama);
	
	$no_sisda 	= mysql_real_escape_string($src_no_sisda);
	$periode	= mysql_real_escape_string($src_periode);
	$tingkat	= mysql_real_escape_string($src_tingkat);
	$jenjang	= mysql_real_escape_string($src_jenjang);
	$status		= mysql_real_escape_string($src_status);
	$nama_siswa	= mysql_real_escape_string($src_nama_slash);
	
	if($src_no_sisda != "" && $src_periode != "" && $src_tingkat != "" && $src_status != "" && $src_jenjang != "" && $src_nama_slash) {
	
		//Tetep aje bo' kite cek dulu ape data_siswa finance untuk SPP tahun depannya udah dibuat apa belom ama system
		$src_check_siswa 	= "select id,spp,ict,elearning,ks from siswa_finance where no_sisda = '$no_sisda' and periode = '$periode'";
		$query_check_siswa 	= mysqli_query($mysql_connect, $src_check_siswa) or die(mysql_error());
		$check_siswa		= mysql_fetch_array($query_check_siswa);
		$num_check_siswa 	= mysql_num_rows($query_check_siswa);
		
		if($num_check_siswa == 0) {
		
			//ambil datanya dulu dari setting SPP
			
			//Cek dulu ade kita ini masuknya kapan ke darbi, ini kan berhubungan dengan discount yang ia dapat, dibawah cek, boss
			$src_get_tahun_masuk 	= "select periode,nama_siswa from siswa where no_sisda = '$no_sisda'";
			$query_get_tahun_masuk	= mysqli_query($mysql_connect, $src_get_tahun_masuk) or die(mysql_error());
			$get_tahun_masuk		= mysql_fetch_array($query_get_tahun_masuk);
			$tahun_masuk			= $get_tahun_masuk["periode"];
			
			//Dari tahun masuk, kita ambil 2 angka terakhir buat nauin keterangan discountnya... yoa
			$src_ket_disc = substr($tahun_masuk,2,2).substr($tahun_masuk,9,2);
			
			$src_check_set_spp 		= "select nominal,item_byr from set_spp where periode = '$periode' and ket_disc = '$src_ket_disc' and tingkat = '$tingkat'";
			$query_check_set_spp	= mysqli_query($mysql_connect, $src_check_set_spp) or die(mysql_error());
			
			$set_spp_for_spp = "";
			$set_spp_for_ict = "";
			$set_spp_for_kts = "";
			$set_spp_for_ler = "";
			
			while($check_set_spp = mysql_fetch_array($query_check_set_spp)) {
			
				if($check_set_spp["item_byr"] == "spp") { $set_spp_for_spp = $check_set_spp["nominal"]; }
				if($check_set_spp["item_byr"] == "ict") { $set_spp_for_ict = $check_set_spp["nominal"]; }
				if($check_set_spp["item_byr"] == "kts") { $set_spp_for_kts = $check_set_spp["nominal"]; }
				if($check_set_spp["item_byr"] == "ler") { $set_spp_for_ler = $check_set_spp["nominal"]; }
		
			}
			
			//Sekarang kita cek prosentasi nominal pembayaran SPP berdasarkan status anak guru atau umum
			//tapi klo dia statusnya umum mah, gak usah.. kaliin aja 1.
			
			if($status == "anak guru" || $status == "anak_guru") { //ini nih.... di database ternyata penulisannya $status ada 2 jenis....payah dah.... gak standard....
			
				if($jenjang == "TK") { $var_spp = "spp_tk"; $var_ict = "ict_tk"; $var_elearning = "elearning_tk";  $var_ks = "ks_tk"; }
				else if($jenjang == "SD") { $var_spp = "spp_sd"; $var_ict = "ict_sd"; $var_elearning = "elearning_sd";  $var_ks = "ks_sd"; }
				else if($jenjang == "SMP") { $var_spp = "spp_smp"; $var_ict = "ict_smp"; $var_elearning = "elearning_smp";  $var_ks = "ks_smp"; }
				
				$src_get_prosentase 	= "select $var_spp,$var_ict,$var_elearning,$var_ks from persen_bayar where periode = '$periode'"; //echo $src_get_prosentase;
				$query_get_prosentase 	= mysqli_query($mysql_connect, $src_get_prosentase) or die(mysql_error());
				$get_prosentase			= mysql_fetch_array($query_get_prosentase);
				
				//dia didatabasenya di tampilkan dalam bentuk jumlah persennya. misal: 50,75,85 atau 100. gichu boss....
				//makanya kita bagi dengan 100, biar jadi pecahan decimal....wakwaw...
				$prosentase_spp 		= $get_prosentase[$var_spp] / 100; //echo $prosentase_spp."<br>";
				$prosentase_ict 		= $get_prosentase[$var_ict] / 100; //echo $prosentase_ict."<br>";
				$prosentase_elearning 	= $get_prosentase[$var_elearning] / 100; //echo $prosentase_elearning."<br>";
				$prosentase_ks 			= $get_prosentase[$var_ks] / 100; //echo $prosentase_ks."<br>";
				
				//nah nnominal sppnya kita kaliin dah sama prosentase status anak gurunya
				$val_spp_for_spp	= $set_spp_for_spp * $prosentase_spp;
				$val_spp_for_ict	= $set_spp_for_ict * $prosentase_ict;
				$val_spp_for_kts	= $set_spp_for_kts * $prosentase_ks;
				$val_spp_for_ler	= $set_spp_for_ler * $prosentase_elearning;
				
				//$val_total = "0-".($val_spp_for_spp + $val_spp_for_ict + $val_spp_for_kts + $val_spp_for_ler); //echo $val_total."<br>";
			
			} else if($status == "umum" || $status == "") {
			
				$val_spp_for_spp	= $set_spp_for_spp;
				$val_spp_for_ict	= $set_spp_for_ict;
				$val_spp_for_kts	= $set_spp_for_kts;
				$val_spp_for_ler	= $set_spp_for_ler;
			}
				
			$cur_month	= strtolower(date("F"));
			if($cur_month == "july") {
				$prev_jul = 1; $prev_aug = 0; $prev_sep = 0; $prev_oct = 0 ; $prev_nov = 0; $prev_dec = 0; $prev_jan = 0; $prev_feb = 0; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "august") {
				$prev_jul = 4; $prev_aug = 1; $prev_sep = 0; $prev_oct = 0 ; $prev_nov = 0; $prev_dec = 0; $prev_jan = 0; $prev_feb = 0; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "september") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 1; $prev_oct = 0 ; $prev_nov = 0; $prev_dec = 0; $prev_jan = 0; $prev_feb = 0; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "october") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 1 ; $prev_nov = 0; $prev_dec = 0; $prev_jan = 0; $prev_feb = 0; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "november") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 1; $prev_dec = 0; $prev_jan = 0; $prev_feb = 0; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "december") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 4; $prev_dec = 1; $prev_jan = 0; $prev_feb = 0; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "january") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 4; $prev_dec = 4; $prev_jan = 1; $prev_feb = 0; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "february") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 4; $prev_dec = 4; $prev_jan = 4; $prev_feb = 1; $prev_mar = 0; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "march") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 4; $prev_dec = 4; $prev_jan = 4; $prev_feb = 4; $prev_mar = 1; $prev_apr = 0; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "april") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 4; $prev_dec = 4; $prev_jan = 4; $prev_feb = 4; $prev_mar = 4; $prev_apr = 1; $prev_may = 0; $prev_jun = 0;
			}
			if($cur_month == "may") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 4; $prev_dec = 4; $prev_jan = 4; $prev_feb = 4; $prev_mar = 4; $prev_apr = 4; $prev_may = 1; $prev_jun = 0;
			}
			if($cur_month == "june") {
				$prev_jul = 4; $prev_aug = 4; $prev_sep = 4; $prev_oct = 4 ; $prev_nov = 4; $prev_dec = 4; $prev_jan = 4; $prev_feb = 4; $prev_mar = 4; $prev_apr = 4; $prev_may = 4; $prev_jun = 1;
			}
				
			//////////////////////////
			//////////////////////////
			////////////////////////// 
			
			$src_add_siswa_finance_spp = "
										insert into siswa_finance 
										(
											no_sisda,
											aktif,
											nama_siswa,
											periode,
											jenjang,
											tingkat,
											kat_status_anak,
											spp,
											ict,
											elearning,
											ks
										)
										values
										(
											'$no_sisda',
											'1',
											'$nama_siswa',
											'$periode',
											'$jenjang',
											'$tingkat',
											'$status',
											'$val_spp_for_spp',
											'$val_spp_for_ict',
											'$val_spp_for_ler',
											'$val_spp_for_kts'
										)	
									";
			$query_add_siswa_finance_spp = mysqli_query($mysql_connect, $src_add_siswa_finance_spp) or die(mysql_error());
		
			if($query_add_siswa_finance_spp) {
		
				$go_redirect 		= "ok";
				$src_redirect_icon 	= "images/icon_true.png";
				$src_redirect_text	= "Proses input data finance siswa $nama_siswa [$no_sisda] untuk $periode berhasil dilakukan";
				
			} else {
			
				$go_redirect 		= "ok";
				$src_redirect_icon 	= "images/icon_false.png";
				$src_redirect_text	= "[Error no 1] Proses input data finance siswa $nama_siswa [$no_sisda] untuk $periode <b>tidakberhasil</b> dilakukan. Hubungi admin.";
				
			}
		
		} else {
		
			$val_spp_for_spp	= $check_siswa["spp"];
			$val_spp_for_ict	= $check_siswa["ict"];
			$val_spp_for_kts	= $check_siswa["ks"];
			$val_spp_for_ler	= $check_siswa["elearning"];
			
			$val_total = "0-".($val_spp_for_spp + $val_spp_for_ict + $val_spp_for_kts + $val_spp_for_ler);
		
			$go_input_tunggakan = "ok";
			
		}
		
		if($go_input_tunggakan == "ok") {
		
			$src_insert_tunggakan = 
									"
										insert into tunggakan
										(
											no_sisda,
											periode,
											jenis_tunggakan,
											status,
											july,
											august,
											september,
											october,
											november,
											december,
											january,
											february,
											march,
											april,
											may,
											june
										)
										values
										(
											'$no_sisda',
											'$periode',
											'spp',
											'1',
											'$prev_jul',
											'$prev_aug',
											'$prev_sep',
											'$prev_oct',
											'$prev_nov',
											'$prev_dec',
											'$prev_jan',
											'$prev_feb',
											'$prev_mar',
											'$prev_apr',
											'$prev_may',
											'$prev_june'
										)
									";
			$query_insert_tunggakan = mysqli_query($mysql_connect, $src_insert_tunggakan) or die(mysql_error());
			
			if($query_insert_tunggakan) {
			
				$go_redirect 		= "ok";
				$src_redirect_icon 	= "images/icon_true.png";
				$src_redirect_text	= "Proses input data finance siswa $nama_siswa [$no_sisda] untuk $periode berhasil dilakukan";
				
			} else {
			
				$go_redirect 		= "ok";
				$src_redirect_icon 	= "images/icon_false.png";
				$src_redirect_text	= "[Error no 2] Proses input data finance siswa $nama_siswa [$no_sisda] untuk $periode <b>tidakberhasil</b> dilakukan. Hubungi admin.";
				
			}
		}
		
	} else {
	
		$go_redirect 		= "ok";
		$src_redirect_icon 	= "images/icon_false.png";
		$src_redirect_text	= "[Error no 3] Data nama, no_sisda, periode, tingkat, jenjang atau status siswa ada yang kosong. Proses input data keuangan tidak dapat dilanjutkan";
		
	}
	
	if($go_redirect == "ok") {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Insert siswa_finance & tunggakan SPP tahun $periode";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= $src_redirect_icon;
		$redirect_url	= "mainpage.php?pl=transaction&no=$no_sisda";
		$redirect_text	= $src_redirect_text;
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "setting data keuangan gagal ditambahkan, hubungi administator"; }
} else { echo "privilege tidak di ketahui"; }
?>