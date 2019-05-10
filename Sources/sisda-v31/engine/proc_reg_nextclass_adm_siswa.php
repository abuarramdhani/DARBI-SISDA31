<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	//here they are the variables
	//========
	//========
	/////////////////////////////////////////
	//These are the student's data
	$no_sisda			= htmlspecialchars($_POST["no_sisda"]);
	$id					= htmlspecialchars($_POST["id"]);
	$v					= htmlspecialchars($_POST["v"]);
	$n					= htmlspecialchars($_POST["n"]);
	$j					= htmlspecialchars($_POST["j"]);
	$send_periode		= htmlspecialchars($_POST["send_periode"]);
	
	//////////////////////////////////////////	
	$nama_siswa			= htmlspecialchars($_POST["nama_siswa"]);
	$nama_ayah			= htmlspecialchars($_POST["nama_ayah"]);
	$nama_bunda			= htmlspecialchars($_POST["nama_bunda"]);
	$kat_status_anak	= htmlspecialchars($_POST["kat_status_anak"]);
	
	//**For date format field, we have to set it with this pattern: year-month-date which is 0000-00-00
	$src_tanggal_daftar	= htmlspecialchars($_POST["src_tanggal_daftar"]);
	$tanggal_daftar		= substr($src_tanggal_daftar,6,4)."-".substr($src_tanggal_daftar,3,2)."-".substr($src_tanggal_daftar,0,2);
	
	$jenjang			= htmlspecialchars($_POST["jenjang"]);
	$tingkat			= htmlspecialchars($_POST["tingkat"]);
	
	//A value of 'tingkat' is defined by the value of 'kelas' 
	//But, how to catch the value are different between (SD, SMP) and others
	/*if($jenjang != "SD" && $jenjang != "SMP") {
		if($tingkat == "White Rabbit" || $tingkat == "Black Rabbit") {
			
			$src_tingkat	= "Todler";
			
		}else if($tingkat == "Yellow Ant" || $tingkat == "Black Ant" || $tingkat == "Red Ant") {
			
			$src_tingkat	= "Play Group";
			
		}else if($tingkat == "Little Butterfly" || $tingkat == "Little Bee" || $tingkat == "Little Bird") {
		
			$src_tingkat	= "TK A";
			
		}else if($tingkat == "Little Camel" || $tingkat == "Little Cat" || $tingkat == "Little Cow") {
		
			$src_tingkat	= "TK B";
		
		}
	}else{
			$src_tingkat = substr($tingkat,0,1);
	}*/	
	
	$periode			= htmlspecialchars($_POST["periode"]);
	
	////////////////////////////////////////		
	//these are the discount category's data
	$disc_cat_adm	= (empty($_POST["disc_cat_adm"])) ? '' : htmlspecialchars($_POST["disc_cat_adm"]);
	$pengembangan	= (empty($_POST["pengembangan"])) ? '' : htmlspecialchars($_POST["pengembangan"]);
	$kegiatan		= (empty($_POST["kegiatan"])) ? '' : htmlspecialchars($_POST["kegiatan"]);
	$peralatan		= (empty($_POST["peralatan"])) ? '' : htmlspecialchars($_POST["peralatan"]);
	$seragam		= (empty($_POST["seragam"])) ? '' : htmlspecialchars($_POST["seragam"]);
	$paket			= (empty($_POST["paket"])) ? '' : htmlspecialchars($_POST["paket"]);
	$sub_total_bima	= (empty($_POST["sub_total_bima"])) ? '' : htmlspecialchars($_POST["sub_total_bima"]);
	
	////////////////////////////////////////
	//These ara the SPP's data
	$spp			= (empty($_POST["spp"])) ? '' : htmlspecialchars($_POST["spp"]);
	$ks				= (empty($_POST["ks"])) ? '' : htmlspecialchars($_POST["ks"]);
	
	////////////////////////////////////////
	//These are the rumah berbagi's data
	$zakat_mal		= htmlspecialchars($_POST["zakat_mal"]);
	$zakat_profesi	= htmlspecialchars($_POST["zakat_profesi"]);
	$infaq_shodaqoh	= htmlspecialchars($_POST["infaq_shodaqoh"]);
	$wakaf			= htmlspecialchars($_POST["wakaf"]);
	$lain_lain		= htmlspecialchars($_POST["lain_lain"]);
	
	
	//escape them..........
	$enc_no_sisda			= mysql_real_escape_string($no_sisda);
	$enc_id					= mysql_real_escape_string($id);
	$enc_nama_siswa			= mysql_real_escape_string($nama_siswa);
	$enc_nama_ayah			= mysql_real_escape_string($nama_ayah);
	$enc_nama_bunda			= mysql_real_escape_string($nama_bunda);
	$enc_kat_status_anak	= mysql_real_escape_string($kat_status_anak);
	$enc_tanggal_daftar		= mysql_real_escape_string($tanggal_daftar);
	$enc_jenjang			= mysql_real_escape_string($jenjang);
	$enc_tingkat			= mysql_real_escape_string($tingkat);
	$enc_periode			= mysql_real_escape_string($periode);
	
	$enc_disc_cat_adm	= mysql_real_escape_string($disc_cat_adm);
	$enc_pengembangan	= mysql_real_escape_string($pengembangan);
	$enc_kegiatan		= mysql_real_escape_string($kegiatan);
	$enc_peralatan		= mysql_real_escape_string($peralatan);
	$enc_seragam		= mysql_real_escape_string($seragam);
	$enc_paket			= mysql_real_escape_string($paket);
	//This value will be used for value in table tunggakan
	$enc_sub_total_bima	= mysql_real_escape_string($sub_total_bima);
	
	$enc_spp			= mysql_real_escape_string($spp);
	$enc_ks				= mysql_real_escape_string($ks);
	
	$enc_zakat_mal		= mysql_real_escape_string($zakat_mal);
	$enc_zakat_profesi	= mysql_real_escape_string($zakat_profesi);
	$enc_infaq_shodaqoh	= mysql_real_escape_string($infaq_shodaqoh);
	$enc_wakaf			= mysql_real_escape_string($wakaf);
	$enc_lain_lain		= mysql_real_escape_string($lain_lain);
	
	//Hello everybody, we have to change field "Aktif" for current id, from Aktif to Tidak aktif (from 1 to 2)
	//Why?
	//Because we have to define that this data siswa_finance  is won't be used anymore by changing it to 2. (already expired)
	
	$src_change_aktif	= "update siswa_finance set aktif = '2' where id = '$enc_id'";
	$query_change_aktif	= mysqli_query($mysql_connect, $src_change_aktif) or die ("There is an error with mysql: ".mysql_error());
	
	//active data is 1
	$cur_aktif			= 1;
	
	if($query_change_aktif) {
	
		//and this is the new data siswa finance that we want to use during this education year,....
		$src_insert_data_finance	= "insert into siswa_finance (
										
										no_sisda,
										aktif,
										nama_siswa,
										periode,
										jenjang,
										tingkat,
										discount_payment,
										pengembangan,
										kegiatan,
										peralatan,
										seragam,
										paket,
										spp,
										ks,
										zakat_mal,
										zakat_profesi,
										infaq_shodaqoh,
										wakaf,
										lainlain
										
										) values (
										
										'$enc_no_sisda',
										'$cur_aktif',
										'$enc_nama_siswa',
										'$enc_periode',
										'$enc_jenjang',
										'$enc_tingkat',
										'$enc_disc_cat_adm',
										'$enc_pengembangan',
										'$enc_kegiatan',
										'$enc_peralatan',
										'$enc_seragam',
										'$enc_paket',
										'$enc_spp',
										'$enc_ks',
										'$enc_zakat_mal',
										'$enc_zakat_profesi',
										'$enc_infaq_shodaqoh',
										'$enc_wakaf',
										'$enc_lain_lain'
										
										)";
		
		$query_insert_data_finance = mysqli_query($mysql_connect, $src_insert_data_finance) or die ("There is an error with mysql: ".mysql_error());
		
		if($query_insert_data_finance) {
			//Yo-yo-yo
			//As Mrs Fitri said that for daftar ulang, it just implemented for students from PG to TKA and TKA to TKB only.
			//So, we have to prepare data tunggakan taken from sub_total_bima for them
			//And here we go
			
			if($enc_jenjang == "" || $enc_jenjang == "") {
			
				$src_insert_daftar_ulang	= "insert into tunggakan (
												no_sisda, 
												periode, 
												jenis_tunggakan, 
												nominal_tunggakan,
												nom_pengembangan,
												nom_kegiatan,
												nom_peralatan,
												nom_seragam,
												nom_paket
												
												) values (
												
												'$cur_no_sisda',
												'$enc_periode',
												'daftar_ulang',
												'$enc_sub_total_bima',
												'$enc_pengembangan',
												'$enc_kegiatan',
												'$enc_peralatan',
												'$enc_seragam',
												'$enc_paket'
												)";
				$query_insert_daftar_ulang	= mysqli_query($mysql_connect, $src_insert_daftar_ulang) or die("Terjadi kesalahan: ".mysql_error());
				
			}
			
			//Pleaseeeeeeeeeeeeeeeee read this comment carefully
			//we need to split the payment as 12 months for each student.
			//So we have to defined it in following table
			//This is really important since we have to know parents that havent paid their billing.
			//And then there is a problem when a parent hasnt finished their payment, for two months in different year
			//For example, because education year starts on juli, payment for June 1st and July 1 st, is different.
			//June and July is in the same year, but in education year, Juli is a new year.
			//And of course the nominal that has to be paid is different.
			//So we have to define it. We have to be careful with this. (bi kerpullll mennnnn)
			//Once we make a mistake with this condition,.... all payment for each student would be failed, bahaya mennnnnnn.....
			//But,... this system will explode gedebooooooooooom (suicide/harakiri/kill it self or something like that)... 
			//when the government (education minister) decides that education year not starts on July anymore....
			//Wakkkkkkkkkkkkkkkkkssssssssssssssssssssssssssssssss
			
			//Wait a moment,
			//Om Tony, where is om Tony,.... urang can dahar yeuh....			
			
			$src_insert_spp		= "insert into tunggakan (no_sisda,periode,jenis_tunggakan,jumlah_bulan) values ('$cur_no_sisda','$enc_periode','spp','12')";
			$query_insert_spp	= mysqli_query($mysql_connect, $src_insert_spp) or die("Terjadi kesalahan".mysql_error());
		
			if($query_insert_spp) {
			
				//---------------------------------------
				//here are variables that used in prog_log.php
				include_once("include/url.php");
				$activity	= "Add registrasi administasi siswa naik kelas";
				$url		= curPageURL();
				$id			= $_SESSION["id"];
				$need_log	= true;
				include_once("include/log.php");
				//---------------------------------------
				
				$redirect_path	= "";
				$redirect_icon	= "images/icon_true.png";
				$redirect_url	= "mainpage.php?pl=nextclass_adm_siswa&v=$v&s=$no_sisda&n=$n&j=$j&periode=$send_periode";
				$redirect_text	= "Registrasi Administrasi Siswa naik kelas berhasil";
				
				$need_redirect	= true;
				include_once ("include/redirect.php");
				
			} else { echo "Proses input data informasi acuan TUNGGAKAN SPP siswa tidak dapat dilakukan, silakan hubungi admin"; } //if($query_insert_spp)
		} else { echo "Proses input data untuk siswa naik kelas tidak berhasil, silakan hubungi admin"; } // if($query_insert_data_finance)
	} else { echo "Proses pengaktifan status siswa naik kelas tidak berhasil, silakan hubungi Admin"; } // if($query_change_aktif)
} else { header("location:../index.php"); } //user privilege is not 2
?>