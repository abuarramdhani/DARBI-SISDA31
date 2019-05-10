<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	//here they are the variable
	//========
	//========
	/////////////////////////////////////////
	//These are the student's data
	$nama_siswa			= htmlspecialchars($_POST["nama_siswa"]);
	$nama_ayah			= htmlspecialchars($_POST["nama_ayah"]);
	$nama_bunda			= htmlspecialchars($_POST["nama_bunda"]);
	$kat_status_anak	= htmlspecialchars($_POST["kat_status_anak"]);
	$telp_ayah			= htmlspecialchars($_POST["telp_ayah"]);
	$telp_bunda			= htmlspecialchars($_POST["telp_bunda"]);
	$nama_sekolah_asal	= htmlspecialchars($_POST["nama_sekolah_asal"]);
	$stat_sekolah_asal	= htmlspecialchars($_POST["stat_sekolah_asal"]);
	
	//**For date format field, we have to set it with this pattern: year-month-date which is 0000-00-00
	$src_tanggal_daftar	= htmlspecialchars($_POST["src_tanggal_daftar"]);
	$tanggal_daftar		= substr($src_tanggal_daftar,6,4)."-".substr($src_tanggal_daftar,3,2)."-".substr($src_tanggal_daftar,0,2);
	
	$jenjang			= htmlspecialchars($_POST["jenjang"]);
	$kelas				= htmlspecialchars($_POST["kelas"]);
	
	//A value of 'tingkat' is defined by the value of 'kelas' 
	//But, how to catch the value are different between (SD, SMP) and others
	if($jenjang != "SD" && $jenjang != "SMP") {
		if($kelas == "White Rabbit" || $kelas == "Black Rabbit") {
			
			$tingkat	= "Todler";
			
		}else if($kelas == "Yellow Ant" || $kelas == "Black Ant" || $kelas == "Red Ant") {
			
			$tingkat	= "Play Group";
			
		}else if($kelas == "Little Butterfly" || $kelas == "Little Bee" || $kelas == "Little Bird") {
		
			$tingkat	= "TK A";
			
		}else if($kelas == "Little Camel" || $kelas == "Little Cat" || $kelas == "Little Cow") {
		
			$tingkat	= "TK B";
		
		}
	}else{
			$tingkat = substr($kelas,0,1);
	}	
	
	$periode			= htmlspecialchars($_POST["periode"]);
	$shift_test			= htmlspecialchars($_POST["shift_test"]);
	//Look at ** above
	$src_fase_1_date	= htmlspecialchars($_POST["src_fase_1_date"]);
	$fase_1_date		= substr($src_fase_1_date,6,4)."-".substr($src_fase_1_date,3,2)."-".substr($src_fase_1_date,0,2);
	//Look at ** above
	$src_fase_2_date	= htmlspecialchars($_POST["src_fase_2_date"]);
	$fase_2_date		= substr($src_fase_2_date,6,4)."-".substr($src_fase_2_date,3,2)."-".substr($src_fase_2_date,0,2);		
	
	////////////////////////////////////////		
	//these are the discount category's data
	$disc_cat_adm	= (empty($_POST["disc_cat_adm"])) ? '' : htmlspecialchars($_POST["disc_cat_adm"]);
	$pengembangan	= (empty($_POST["pengembangan"])) ? '' : htmlspecialchars($_POST["pengembangan"]);
	$kegiatan		= (empty($_POST["kegiatan"])) ? '' : htmlspecialchars($_POST["kegiatan"]);
	$peralatan		= (empty($_POST["peralatan"])) ? '' : htmlspecialchars($_POST["peralatan"]);
	$seragam		= (empty($_POST["seragam"])) ? '' : htmlspecialchars($_POST["seragam"]);
	$paket			= (empty($_POST["paket"])) ? '' : htmlspecialchars($_POST["paket"]);
	
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
	$enc_nama_siswa			= mysql_real_escape_string($nama_siswa);
	$enc_nama_ayah			= mysql_real_escape_string($nama_ayah);
	$enc_nama_bunda			= mysql_real_escape_string($nama_bunda);
	$enc_kat_status_anak	= mysql_real_escape_string($kat_status_anak);
	$enc_telp_ayah			= mysql_real_escape_string($telp_ayah);
	$enc_telp_bunda			= mysql_real_escape_string($telp_bunda);
	$enc_nama_sekolah_asal	= mysql_real_escape_string($nama_sekolah_asal);
	$enc_stat_sekolah_asal	= mysql_real_escape_string($stat_sekolah_asal);
	$enc_tanggal_daftar		= mysql_real_escape_string($tanggal_daftar);
	$enc_jenjang			= mysql_real_escape_string($jenjang);
	$enc_tingkat			= mysql_real_escape_string($tingkat);
	$enc_kelas				= mysql_real_escape_string($kelas);
	$enc_periode			= mysql_real_escape_string($periode);
	$enc_shift_test			= mysql_real_escape_string($shift_test);
	$enc_fase_1_date		= mysql_real_escape_string($fase_1_date);
	$enc_fase_2_date		= mysql_real_escape_string($fase_2_date);
	
	$enc_disc_cat_adm	= mysql_real_escape_string($disc_cat_adm);
	$enc_pengembangan	= mysql_real_escape_string($pengembangan);
	$enc_kegiatan		= mysql_real_escape_string($kegiatan);
	$enc_peralatan		= mysql_real_escape_string($peralatan);
	$enc_seragam		= mysql_real_escape_string($seragam);
	$enc_paket			= mysql_real_escape_string($paket);
	
	$enc_spp			= mysql_real_escape_string($spp);
	$enc_ks				= mysql_real_escape_string($ks);
	
	$enc_zakat_mal		= mysql_real_escape_string($zakat_mal);
	$enc_zakat_profesi	= mysql_real_escape_string($zakat_profesi);
	$enc_infaq_shodaqoh	= mysql_real_escape_string($infaq_shodaqoh);
	$enc_wakaf			= mysql_real_escape_string($wakaf);
	$enc_lain_lain		= mysql_real_escape_string($lain_lain);
	
	//Firstly,...
	//All of this data is depend on NO SISDA, which can be taken from table siswa. Note that the every student will have a unique NO SISDA which is generated automatically 
	//every registration data has been added into database. 
	//we will have two conditions with this registration process, thet are:
	//1. Registration for new student, it means that we have to generate new unique NO SISDA for them. how to do that? get the last NO SISDA from DB, add it with 1, 
	//   that is the new SISDA for new student.
	//2. Reregistration for old student that will get into the next level, we can use the existing NO SISDA, that taken from their data in DB.
	
	/*get current NO SISDA*/
	//look at the + 0 in below query. it's used to convert string data to integer, because the original data type of NO SISDA is string , 
	//but we only can select the max value of NO SISDA serial number(last 5 digits) in integer type. dont porgetgetget about it baby(but when i check in db, is already integer hehehe)....
	//$src_get_no_sisda	= "select no_sisda, MAX(SUBSTRING(no_sisda,5) + 0) from siswa";
	$src_get_no_sisda	= "select MAX(SUBSTRING(no_sisda from 5 for 5)) as cur_no_sisda from siswa"; 
	$query_get_no_sisda	= mysqli_query($mysql_connect, $src_get_no_sisda);
	$no_sisda_row		= mysql_fetch_array($query_get_no_sisda);
	
	//add 1 to the last no_sisda.
	//it's become current no_sisda.
	$last_no_sisda	= $no_sisda_row["cur_no_sisda"]+1;
	
	//we have problem with the 4 zeroes from the serial number, ex: 00001,00012,00356,06478
	//Check how many 'zore' that we have to add next to the last value
	$lenght_no_sisda 	= 5-(strlen($last_no_sisda)); 
	if($lenght_no_sisda == 4) { $add_digit = "0000"; }
	else if($lenght_no_sisda == 3) { $add_digit = "000"; }
	else if($lenght_no_sisda == 2) { $add_digit = "00"; }
	else if($lenght_no_sisda == 1) { $add_digit = "0"; }
	
	//We need current year
	$cur_year	= date("Y");
	
	//And here is the last no_sisda for the last student
	$cur_no_sisda	= $cur_year.$add_digit.$last_no_sisda;
	
	//We have to seperate, between basic student data and finance data
	//why is that? because the table of them is different.
	//The steps are: insert the basic data first, then the finance data
	///////////////////////////////////////////////////////////////////		
	
	//here we go again baby,....
	//lets insert the student data first
	$src_insert_user	= "insert into siswa (
							
							no_sisda,
							periode,
							nama_siswa,
							nama_ayah,
							nama_bunda,
							kat_status_anak,
							telp_ayah,
							telp_bunda,
							asal_sekolah,								
							tanggal_daftar,
							jenjang,
							tingkat,
							gelombang_test,
							tahap1,
							tahap2
							
							) values (
							
							'$cur_no_sisda',
							'$enc_periode',
							'$enc_nama_siswa',
							'$enc_nama_ayah',
							'$enc_nama_bunda',
							'$enc_kat_status_anak',
							'$enc_telp_ayah',
							'$enc_telp_bunda',
							'$enc_nama_sekolah_asal',
							'$enc_tanggal_daftar',
							'$enc_jenjang',
							'$enc_tingkat',
							'$enc_shift_test',
							'$enc_fase_1_date',
							'$enc_fase_2_date'								
							
							)";
	$query_insert_user	= mysqli_query($mysql_connect, $src_insert_user) or die ("There is an error with mysql: ".mysql_error());
	
	//By defining that the query_insert_user working successfuly, it's meaning that we already had no_sisda for this student.
	//Which is this no_sisda is needed to identify every finance data related to this student
	//Ok here is the insertion process
	
	$src_insert_data_finance	= "insert into siswa_finance (
									
									no_sisda,
									nama_siswa,
									periode,
									jenjang,
									tingkat,
									kelas,
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
									
									'$cur_no_sisda',
									'$enc_nama_siswa',
									'$enc_periode',
									'$enc_jenjang',
									'$enc_tingkat',
									'$enc_kelas',
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
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add registrasi administasi siswa";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "/sisda-v3/mainpage.php?pl=reg_adm_siswa";
		$redirect_text	= "Registrasi Administrasi Siswa berhasil";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
		
	}	
} else {
	header("location:../index.php");
}
?>