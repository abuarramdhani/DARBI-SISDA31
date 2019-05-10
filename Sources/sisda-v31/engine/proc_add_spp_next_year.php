<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$src_no_sisda 	= empty($_GET["n"]) ? '' : $_GET["n"]; //echo $src_no_sisda."<br>";
	$src_periode	= empty($_GET["p"]) ? '' : $_GET["p"]; //echo $src_periode."<br>";
	$src_tingkat	= empty($_GET["t"]) ? '' : $_GET["t"]; //echo $src_tingkat."<br>";
	$src_status		= empty($_GET["s"]) ? '' : $_GET["s"]; //echo $src_status."<br>";
	$src_en			= empty($_GET["en"]) ? '' : $_GET["en"]; //echo $src_en."<br>";
	
	$no_sisda 	= mysql_real_escape_string($src_no_sisda);
	$periode	= mysql_real_escape_string($src_periode);
	$tingkat	= mysql_real_escape_string($src_tingkat);
	$status		= mysql_real_escape_string($src_status);
	//en mah gak usah, kita gak bakal utik-utik di query koq...
	
	$src_check_data_finance_next_year_eng = substr(md5($darbi_key.$src_no_sisda.$src_periode.$src_tingkat.$src_status),0,15);
	//echo $src_en."<br>".$src_check_data_finance_next_year_eng;
	
	if($src_check_data_finance_next_year_eng == $src_en) {
	
		if($src_tingkat == 2 || $src_tingkat == 3 || $src_tingkat == 4 || $src_tingkat == 5 || $src_tingkat == 6) {
				
			$var_spp 		= "spp_sd";
			$var_ict		= "ict_sd";
			$var_elearning	= "elearning_sd";
			$var_ks			= "ks_sd";
			$jenjang		= "SD";
		
		} else if($src_tingkat == 8 || $src_tingkat == 9) {
		
			$var_spp 		= "spp_smp";
			$var_ict		= "ict_smp";
			$var_elearning	= "elearning_smp";
			$var_ks			= "ks_smp";
			$jenjang		= "SMP";
		
		}
		
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
			$nama_siswa				= addslashes($get_tahun_masuk["nama_siswa"]);
			
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
			
			if($status == "anak guru" || $status == "anak_guru") {
			
				$src_get_prosentase 	= "select $var_spp,$var_ict,$var_elearning,$var_ks from persen_bayar where periode = '$periode'";
				$query_get_prosentase 	= mysqli_query($mysql_connect, $src_get_prosentase) or die(mysql_error());
				$get_prosentase			= mysql_fetch_array($query_get_prosentase);
				
				//dia didatabasenya di tampilkan dalam bentuk jumlah persennya. misal: 50,75,85 atau 100. gichu boss....
				//makanya kita bagi dengan 100, biar jadi pecahan decimal....wakwaw...
				$prosentase_spp 		= $get_prosentase[$var_spp] / 100;
				$prosentase_ict 		= $get_prosentase[$var_ict] / 100;
				$prosentase_elearning 	= $get_prosentase[$var_elearning] / 100;
				$prosentase_ks 			= $get_prosentase[$var_ks] / 100;
				
				//nah nnominal sppnya kita kaliin dah sama prosentase status anak gurunya
				$val_spp_for_spp	= $set_spp_for_spp * $prosentase_spp;
				$val_spp_for_ict	= $set_spp_for_ict * $prosentase_spp;
				$val_spp_for_kts	= $set_spp_for_kts * $prosentase_spp;
				$val_spp_for_ler	= $set_spp_for_ler * $prosentase_spp;
				
				$val_total = "0-".($val_spp_for_spp + $val_spp_for_ict + $val_spp_for_kts + $val_spp_for_ler);
			
			} else if($status == "umum" || $status == "") {
			
				$val_spp_for_spp	= $set_spp_for_spp;
				$val_spp_for_ict	= $set_spp_for_ict;
				$val_spp_for_kts	= $set_spp_for_kts;
				$val_spp_for_ler	= $set_spp_for_ler;
				
				$val_total = "0-".($val_spp_for_spp + $val_spp_for_ict + $val_spp_for_kts + $val_spp_for_ler);
			
			}
		
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
												'2',
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
			
			if($query_add_siswa_finance_spp) { $go_input_tunggakan = "ok"; } else { $go_input_tunggakan = "gak_ok"; }
			
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
											'2',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total',
											'$val_total'
										)
									";
			$query_insert_tunggakan = mysqli_query($mysql_connect, $src_insert_tunggakan) or die(mysql_error());
			
			if($query_insert_tunggakan) {
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
				$redirect_icon	= "images/icon_true.png";
				$redirect_url	= "mainpage.php?pl=transaction&no=$no_sisda";
				$redirect_text	= "Nominal SPP siswa <b>$nama_siswa</b> untuk tahun <b>".$periode."</b>, sudah didaftarkan";
				
				$need_redirect	= true;
				include_once ("include/redirect.php");
			} else { echo "setting data keuangan gagal ditambahkan, hubungi administator"; }
		} else { echo "error 1"; }
	} else { echo "error 2"; }
} else { echo "error 3"; }