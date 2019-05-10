<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	//here they are the variable
	//========
	//========
	/////////////////////////////////////////
	//These are the student's data
	$src_no_sisda			= $_POST["no_sisda"];
	$src_nisn				= $_POST["nisn"];
	$src_nama_siswa			= $_POST["nama_siswa"];
	$src_nama_panggilan		= $_POST["nama_panggilan"];
	$src_ttl_tempat			= $_POST["tempat_lahir"];
	$src_ttl				= $_POST["tahun_lahir"]."-".$_POST["bulan_lahir"]."-".$_POST["tanggal_lahir"];
	$src_jenis_kelamin		= $_POST["jenis_kelamin"];
	$src_nama_ayah			= $_POST["nama_ayah"];
	$src_nama_bunda			= $_POST["nama_bunda"];
	$src_kat_status_anak	= $_POST["kat_status_anak"];
	$src_telp_ayah			= $_POST["telp_ayah"];
	$src_telp_bunda			= $_POST["telp_bunda"];
	$src_email_ortu			= $_POST["email_ortu"];
	$src_hub_saya_melalui	= $_POST["hub_saya_melalui"];
	$src_alamat				= $_POST["alamat"];
	$src_kota				= $_POST["kota"];
	$src_kodepos			= $_POST["kodepos"];
	$src_provinsi			= $_POST["provinsi"];
	$src_negara				= $_POST["negara"];
	$src_asal_sekolah		= $_POST["asal_sekolah"];
	$src_stat_sekolah_asal	= $_POST["stat_sekolah_asal"];
	$src_nama_saudara		= $_POST["nama_saudara"];
	$src_gambar 			= $_FILES['gambar']['name'];
	
	//Escape it.....
	$no_sisda			= mysql_real_escape_string($src_no_sisda);
	$nisn				= mysql_real_escape_string($src_nisn);
	$nama_siswa			= mysql_real_escape_string($src_nama_siswa);
	$nama_panggilan		= mysql_real_escape_string($src_nama_panggilan);
	$ttl_tempat			= mysql_real_escape_string($src_ttl_tempat);
	$ttl				= mysql_real_escape_string($src_ttl);
	$jenis_kelamin		= mysql_real_escape_string($src_jenis_kelamin);
	$nama_ayah			= mysql_real_escape_string($src_nama_ayah);
	$nama_bunda			= mysql_real_escape_string($src_nama_bunda);
	$kat_status_anak	= mysql_real_escape_string($src_kat_status_anak);
	$telp_ayah			= mysql_real_escape_string($src_telp_ayah);
	$telp_bunda			= mysql_real_escape_string($src_telp_bunda);
	$email_ortu			= mysql_real_escape_string($src_email_ortu);
	$hub_saya_melalui	= mysql_real_escape_string($src_hub_saya_melalui);
	$alamat				= mysql_real_escape_string($src_alamat);
	$kota				= mysql_real_escape_string($src_kota);
	$kodepos			= mysql_real_escape_string($src_kodepos);
	$provinsi			= mysql_real_escape_string($src_provinsi);
	$negara				= mysql_real_escape_string($src_negara);
	$asal_sekolah		= mysql_real_escape_string($src_asal_sekolah);
	$stat_sekolah_asal	= mysql_real_escape_string($src_stat_sekolah_asal);
	$nama_saudara		= mysql_real_escape_string($src_nama_saudara);	
	$gambar				= mysql_real_escape_string($src_gambar);
	
	
	
	if(!empty($gambar)) {
	
		$name_date		= date('hisdmY');
		$new_file_name 	= $name_date."-".$gambar;
		$path			= "photo/".$new_file_name;
		
		$src_chk_photo_ext		= "select * from siswa where no_sisda = '$no_sisda'";
		$query_chk_photo_ext	= mysqli_query($mysql_connect, $src_chk_photo_ext) or die("Terjadi kesalahan: ".mysql_error());
		$chk_photo_ext			= mysql_fetch_array($query_chk_photo_ext);
	
		if($chk_photo_ext["photo"] != "") {
		
			$ext_file_name	= $chk_photo_ext["photo"];
			
			chmod("photo/". $ext_file_name, 0755);

			$delete_file = unlink("photo/".$ext_file_name);
			
			if($delete_file) {
			
				$upld_photo	= move_uploaded_file(htmlspecialchars($_FILES['gambar']['tmp_name']), $path);
				
				if($upld_photo) {
				
					$src_insert_photo_name	= $new_file_name;
					$status_upload			= "okeh";
					
				} else {
				
					$src_insert_photo_name	= "";
					
				}
			}				
		} else {
		
			$upld_photo	= move_uploaded_file(htmlspecialchars($_FILES['gambar']['tmp_name']), $path);
				
				if($upld_photo) {
				
					$src_insert_photo_name	= $new_file_name;
					
				} else {
				
					$src_insert_photo_name	= "";
					
				}
			
		}
	} else {
	
		$src_insert_photo_name	= "";
		
	}
	
	$src_insert_data_siswa	= "update siswa set 
									
									nisn 				= '$nisn',
									nama_siswa			= '$nama_siswa',
									nama_panggilan 		= '$nama_panggilan',
									tempat_lahir		= '$ttl_tempat',
									tanggal_lahir		= '$ttl',
									jenis_kelamin 		= '$jenis_kelamin',
									nama_ayah 			= '$nama_ayah',
									nama_bunda 			= '$nama_bunda',
									kat_status_anak 	= '$kat_status_anak',
									telp_ayah			= '$telp_ayah',
									telp_bunda			= '$telp_bunda',
									email_ortu			= '$email_ortu',
									hub_saya_melalui	= '$hub_saya_melalui',
									alamat				= '$alamat',
									kota				= '$kota',
									kodepos				= '$kodepos',
									provinsi			= '$provinsi',
									negara				= '$negara',
									asal_sekolah		= '$asal_sekolah',
									stat_sekolah_asal	= '$stat_sekolah_asal',
									nama_saudara		= '$nama_saudara',
									photo				= '$src_insert_photo_name'
									
									where no_sisda 		= '$no_sisda'";
	
	$query_insert_data_siswa = mysqli_query($mysql_connect, $src_insert_data_siswa) or die ("There is an error with mysql: ".mysql_error());
	
	if($query_insert_data_siswa) {
	
		$src_insert_data_siswa_finance 		= "update siswa_finance set nama_siswa = '$nama_siswa' where no_sisda = '$no_sisda'";		
		$query_insert_data_siswa_finance	= mysqli_query($mysql_connect, $src_insert_data_siswa_finance) or die(mysql_error());
	
	}
	
	if($query_insert_data_siswa_finance) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "update data administasi siswa";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=preview_adm_siswa";
		$redirect_text	= "Data Administrasi Siswa <b>$src_nama_siswa</b> sudah ter-update";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
		
	}	
} else {
	header("location:../index.php");
}
?>