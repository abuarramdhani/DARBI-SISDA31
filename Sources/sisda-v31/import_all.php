<?PHP
include("sisda-config.php");

$src_get_data_import = "select * from import_data_mentah_siswa";
$query_get_data_import	= mysqli_query($mysql_connect, $src_get_data_import) or die(mysql_error());

while($get_data_import = mysql_fetch_array($query_get_data_import)) {

	$no_sisda 								= $get_data_import["no_sisda"];
	//echo $no_sisda."<br>";
	$aktif 									= 1;
	$src_periode							= $get_data_import["periode"];
	$periode								= substr($src_periode,0,4)." - ".substr($src_periode,5,4);
	$tahun_masuk							= $get_data_import["tahun_masuk"];
	
	$prefix_jul								= substr($get_data_import["tunggakan"],0,1);
	$prefix_aug								= substr($get_data_import["tunggakan"],2,1);
	$prefix_sep								= substr($get_data_import["tunggakan"],4,1);
	$prefix_oct								= substr($get_data_import["tunggakan"],6,1);
	$prefix_nov								= substr($get_data_import["tunggakan"],8,1);
	$prefix_dec								= substr($get_data_import["tunggakan"],10,1);
	$prefix_jan								= substr($get_data_import["tunggakan"],12,1);
	$prefix_feb								= substr($get_data_import["tunggakan"],14,1);
	$prefix_mar								= substr($get_data_import["tunggakan"],16,1);
	$prefix_apr								= substr($get_data_import["tunggakan"],18,1);
	$prefix_may								= substr($get_data_import["tunggakan"],20,1);
	$prefix_jun								= substr($get_data_import["tunggakan"],22,1);
	
	$type_spp								= strtolower($get_data_import["spp"]);
	//$nom_spp								= $get_data_import["nominal_spp"];
	
	$penyedia_catering						= $get_data_import["catering"];
	
	if($type_spp == "umum") {
	
		$nom_catering = ($get_data_import["nom_catering"])*10; //dikali 10 karena bulan desember cuma 10 hari
		
	} else if($type_spp == "anak guru" || $type_spp == "khusus") {
	
		$nom_catering = (($get_data_import["nom_catering"])/2)*10;//dikali 10 karena bulan desember cuma 10 hari
	
	}
	
	$all_catering_jul_value					= "4-0";
	$all_catering_aug_value					= "4-0";
	$all_catering_sep_value					= "4-0";
	$all_catering_oct_value					= "4-0";
	$all_catering_nov_value					= "4-0";
	$all_catering_dec_value					= "1-".$nom_catering;
	$all_catering_jan_value					= "0-0";
	$all_catering_feb_value					= "0-0";
	$all_catering_mar_value					= "0-0";
	$all_catering_apr_value					= "0-0";
	$all_catering_may_value					= "0-0";
	$all_catering_jun_value					= "0-0";
	
	$supir									= $get_data_import["supir"];
	$rute									= $get_data_import["rute"];
	$nom_antar_jemput						= ($get_data_import["tarif"])*0.6; //dikali 60% karena cuma 10 hari masuk
	
	$penyedia_antar_jemput					= $supir."-".$rute;
	
	$all_antar_jemput_jul_value				= "4-0";
	$all_antar_jemput_aug_value				= "4-0";
	$all_antar_jemput_sep_value				= "4-0";
	$all_antar_jemput_oct_value				= "4-0";
	$all_antar_jemput_nov_value				= "4-0";
	$all_antar_jemput_dec_value				= "1-".$nom_antar_jemput;
	$all_antar_jemput_jan_value				= "0-0";
	$all_antar_jemput_feb_value				= "0-0";
	$all_antar_jemput_mar_value				= "0-0";
	$all_antar_jemput_apr_value				= "0-0";
	$all_antar_jemput_may_value				= "0-0";
	$all_antar_jemput_jun_value				= "0-0";
	
	$jenjang								= $get_data_import["jenjang"];
	$tingkat								= $get_data_import["tingkat"];
	
	$kelas									= $get_data_import["kelas"];
	$nama_siswa								= $get_data_import["nama_siswa"];
	$nama_panggilan							= $get_data_import["nama_panggilan"];
	$nisn									= $get_data_import["nisn"];
	
	$tempat_lahir							= $get_data_import["tempat_lahir"];
	$tanggal_lahir							= $get_data_import["tanggal_lahir"];
	
	$jenis_kelamin							= $get_data_import["jenis_kelamin"];
	
	$nama_ayah								= $get_data_import["nama_ayah"];
	$nama_ibu								= $get_data_import["nama_ibu"];

	$telp_ayah								= $get_data_import["telepon_ayah"];
	$telp_ibu								= $get_data_import["telepon_ibu"];
	
	$kerja_ayah								= $get_data_import["kerja_ayah"];
	$kerja_ibu								= $get_data_import["kerja_ibu"];	
	
	$email_ortu								= $get_data_import["email"];
	
	$alamat									= $get_data_import["alamat"];
	
	$asal_sekolah							= $get_data_import["asal_sekolah"];
	
	$anak_ke								= $get_data_import["anak_ke"];
	$jumlah_saudara							= $get_data_import["jumlah_saudara"];
	
	$agama									= $get_data_import["agama"];
	$suku									= $get_data_import["suku"];
	
	$kewarganegaraan						= $get_data_import["kewarganegaraan"];
	
	$tinggi_badan							= $get_data_import["tinggi_badan"];
	$berat_badan							= $get_data_import["berat_badan"];
	
	$golongan_darah							= $get_data_import["golongan_darah"];
	$jarak_rumah_sekolah					= $get_data_import["jarak_rumah_sekolah"];
	
	
	
	/////////////////
	
	$src_insert	= "insert into siswa
				
				(
					no_sisda,
					aktif,
					periode,
					jenjang,
					tingkat,
					kelas,
					nama_siswa,
					nama_panggilan,
					nisn,
					tempat_lahir,
					tanggal_lahir,
					jenis_kelamin,
					nama_ayah,
					nama_bunda,
					telp_ayah,
					telp_bunda,
					kerja_ayah,
					kerja_ibu,
					email_ortu,
					alamat,
					asal_sekolah,
					anak_ke,
					jumlah_saudara,
					agama,
					suku,
					kewarganegaraan,
					tinggi_badan,
					berat_badan,
					golongan_darah,
					jarak_rumah_sekolah
					
				) values (
								
					'$no_sisda',
					'$aktif',
					'$periode',
					'$jenjang',
					'$tingkat',
					'$kelas',
					'$nama_siswa',
					'$nama_panggilan',
					'$nisn',
					'$tempat_lahir',
					'$tanggal_lahir',
					'$jenis_kelamin',
					'$nama_ayah',
					'$nama_ibu',
					'$telp_ayah',
					'$telp_ibu',
					'$kerja_ayah',
					'$kerja_ibu',
					'$email_ortu',
					'$alamat',
					'$asal_sekolah',
					'$anak_ke',
					'$jumlah_saudara',
					'$agama',
					'$suku',
					'$kewarganegaraan',
					'$tinggi_badan',
					'$berat_badan',
					'$golongan_darah',
					'$jarak_rumah_sekolah'
									
				)
	
				";
	$query_insert	= mysqli_query($mysql_connect, $src_insert) or die(mysql_error());
	
	if($query_insert) {
	
	///////
		
		$periode_enc 		= $periode; 
		
		$tahun_masuk_enc 	= $tahun_masuk; 
		$ket_disc			= substr($tahun_masuk_enc,2,2).substr($tahun_masuk_enc,7,2);
		
		$level_enc			= mysql_real_escape_string($jenjang);
		
		
		
		//Jenjang in table set_spp writen in lower case and without space, so make it
		//I've called ika, but she didnt answer,.....so i asked Bu Hesti, she told me:
		//we have PTA & KS...hehehe
		if($jenjang	== "Toddler") 	{ $jenjang_lower	= "toddler"; 	$kspta	= "PTA"; }
		if($jenjang	== "PG") 		{ $jenjang_lower	= "pg"; 		$kspta	= "PTA"; }
		if($jenjang	== "TK A") 		{ $jenjang_lower	= "tka"; 		$kspta	= "PTA"; }
		if($jenjang	== "TK B")	 	{ $jenjang_lower	= "tkb"; 		$kspta	= "PTA"; }
		if($jenjang	== "SD") 		{ $jenjang_lower	= "sd"; 		$kspta	= "KS"; }
		if($jenjang	== "SMP") 		{ $jenjang_lower	= "smp"; 		$kspta	= "KS"; }
		
		//And so the tingkat
		if($tingkat	== "Toddler") 	{ $tingkat_lower	= "toddler"; }
		if($tingkat	== "PG") 		{ $tingkat_lower	= "pg"; }
		if($tingkat	== "TK A") 		{ $tingkat_lower	= "tka"; }
		if($tingkat	== "TK B") 		{ $tingkat_lower	= "tkb"; }
		if($tingkat	== "1") 		{ $tingkat_lower	= "1"; }
		if($tingkat	== "2") 		{ $tingkat_lower	= "2"; }
		if($tingkat	== "3") 		{ $tingkat_lower	= "3"; }
		if($tingkat	== "4") 		{ $tingkat_lower	= "4"; }
		if($tingkat	== "5") 		{ $tingkat_lower	= "5"; }
		if($tingkat	== "6") 		{ $tingkat_lower	= "6"; }
		if($tingkat	== "7") 		{ $tingkat_lower	= "7"; }
		if($tingkat	== "8") 		{ $tingkat_lower	= "8"; }
		if($tingkat	== "9") 		{ $tingkat_lower	= "9"; }
		
		$src_get_spp	= "select * from set_spp where periode = '$periode_enc' and jenjang = '$jenjang_lower' and tingkat = '$tingkat_lower' and ket_disc = '$ket_disc'";
		$query_get_spp	= mysqli_query($mysql_connect, $src_get_spp) or die ("There is an error with mysql: ".mysql_error());
		$num_row		= mysql_num_rows($query_get_spp); 
		
		//echo $src_get_spp."<br>";
		//echo $num_row;
		
		//echo "<h1>status_anak:".$_POST["kat_status_anak"]."</h1><br>";
		
		if($num_row != 0 ) {
		
			while($row_get_spp = mysql_fetch_array($query_get_spp)) {
			
				if($row_get_spp["item_byr"] == "spp") { $nominal_spp = $row_get_spp["nominal"]; }
				if($row_get_spp["item_byr"] == "ict") { $nominal_ict = $row_get_spp["nominal"]; }
				if($row_get_spp["item_byr"] == "ler") { $nominal_ler = $row_get_spp["nominal"]; }
				if($row_get_spp["item_byr"] == "kts") { $nominal_kts = $row_get_spp["nominal"]; }
			}
		
			$cur_total_spp = 0;
			
			//Kind of discount category
			//Umum -> they must pay 100% of payment
			//Anak guru -> they must pay 50% of payment only
			if($type_spp == "umum") {	
					
				$cat_disc_spp		= $nominal_spp;
				$cat_disc_ict		= $nominal_ict;
				$cat_disc_ler		= $nominal_ler;
				$cat_disc_kts		= $nominal_kts;	
				
				$cat_disc_spp_error = "tak_ok";
				
			} else if ($type_spp == "anak guru") {
			
				$cat_disc_spp		= $nominal_spp*0.5;
				$cat_disc_ict		= $nominal_ict*0.5;
				$cat_disc_ler		= $nominal_ler*0.5;
				$cat_disc_kts		= $nominal_kts*0.5;	
				
				$cat_disc_spp_error = "tak_ok";
				
			} else if ($type_spp == "khusus") {
			
				$src_spp_khusus	= $get_data_import["value_khusus"];
				
				if($src_spp_khusus <= $nominal_kts) {
				
					$cat_disc_kts 	= $src_spp_khusus;	$cat_disc_ler 	= 0;	$cat_disc_ict	= 0;	$cat_disc_spp	= 0;
					
				} else {
				
					$cat_disc_kts 	= $nominal_kts;
					$src_spp_khusus	= $src_spp_khusus - $nominal_kts;
				}
				
				if($src_spp_khusus <= $nominal_ler) {
				
					$cat_disc_ler 	= $src_spp_khusus;	$cat_disc_ict	= 0;	$cat_disc_spp	= 0;
					
				} else {
				
					$cat_disc_ler 	= $nominal_ler;
					$src_spp_khusus	= $src_spp_khusus - $nominal_ler;
				}
				
				if($src_spp_khusus <= $nominal_ict) {
				
					$cat_disc_ict 	= $src_spp_khusus;	$cat_disc_spp	= 0;
					
				} else {
				
					$cat_disc_ict 	= $nominal_ict;
					$cat_disc_spp	= $src_spp_khusus - $nominal_ict;
				}
			}
			
			$all_spp_value	= $cat_disc_spp + $cat_disc_ict + $cat_disc_ler	+ $cat_disc_kts;
			
			$all_jul_value	= $prefix_jul."-".$all_spp_value;
			$all_aug_value	= $prefix_aug."-".$all_spp_value;
			$all_sep_value	= $prefix_sep."-".$all_spp_value;
			$all_oct_value	= $prefix_oct."-".$all_spp_value;
			$all_nov_value	= $prefix_nov."-".$all_spp_value;
			$all_dec_value	= $prefix_dec."-".$all_spp_value;
			$all_jan_value	= $prefix_jan."-".$all_spp_value;
			$all_feb_value	= $prefix_feb."-".$all_spp_value;
			$all_mar_value	= $prefix_mar."-".$all_spp_value;
			$all_apr_value	= $prefix_apr."-".$all_spp_value;
			$all_may_value	= $prefix_may."-".$all_spp_value;
			$all_jun_value	= $prefix_jun."-".$all_spp_value;
				
		}
	}
	
	
	//////
	
	$src_insert_siswa_finance	= "
	
									insert into siswa_finance (
									
										no_sisda,
										aktif,
										nama_siswa,
										periode,
										jenjang,
										tingkat,
										kelas,
										spp,
										ict,
										elearning,
										ks,
										catering,
										antar_jemput
										
										
									
									) values (
									
										'$no_sisda',
										'1',
										'$nama_siswa',
										'$periode',
										'$jenjang',
										'$tingkat',
										'$kelas',
										'$cat_disc_spp',
										'$cat_disc_ict',
										'$cat_disc_ler',
										'$cat_disc_kts',
										'$penyedia_catering',
										'$penyedia_antar_jemput'
										
									)		
									";
										
		$query_insert_siswa_finance	= mysqli_query($mysql_connect, $src_insert_siswa_finance) or die(mysql_error());
		
		if($query_insert_siswa_finance) {
		
			$src_insert_spp	= "
			
								insert into tunggakan (
								
									no_sisda,
									periode,
									status,
									jenis_tunggakan,
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
								
								) values (
								
									'$no_sisda',
									'$periode',
									'1',
									'spp',
									'$all_jul_value',
									'$all_aug_value',
									'$all_sep_value',
									'$all_oct_value',
									'$all_nov_value',
									'$all_dec_value',
									'$all_jan_value',
									'$all_feb_value',
									'$all_mar_value',
									'$all_apr_value',
									'$all_may_value',
									'$all_jun_value'
								
								)
								";
		
			$query_insert_spp	= mysqli_query($mysql_connect, $src_insert_spp) or die(mysql_error());
			
			if($penyedia_catering != "") {
			
				$src_insert_catering	= "
			
									insert into tunggakan (
									
										no_sisda,
										periode,
										status,
										jenis_tunggakan,
										jul_cataj,
										aug_cataj,
										sep_cataj,
										oct_cataj,
										nov_cataj,
										dec_cataj,
										jan_cataj,
										feb_cataj,
										mar_cataj,
										apr_cataj,
										may_cataj,
										jun_cataj
									
									) values (
									
										'$no_sisda',
										'$periode',
										'1',
										'catering',
										'$all_catering_jul_value',
										'$all_catering_aug_value',
										'$all_catering_sep_value',
										'$all_catering_oct_value',
										'$all_catering_nov_value',
										'$all_catering_dec_value',
										'$all_catering_jan_value',
										'$all_catering_feb_value',
										'$all_catering_mar_value',
										'$all_catering_apr_value',
										'$all_catering_may_value',
										'$all_catering_jun_value'
									
									)
									";
			
				$query_insert_catering	= mysqli_query($mysql_connect, $src_insert_catering) or die(mysql_error());
				
			}
			
			if($penyedia_antar_jemput != "") {
			
				$src_insert_antar_jemput	= "
			
												insert into tunggakan (
												
													no_sisda,
													periode,
													status,
													jenis_tunggakan,
													jul_cataj,
													aug_cataj,
													sep_cataj,
													oct_cataj,
													nov_cataj,
													dec_cataj,
													jan_cataj,
													feb_cataj,
													mar_cataj,
													apr_cataj,
													may_cataj,
													jun_cataj
												
												) values (
												
													'$no_sisda',
													'$periode',
													'1',
													'antar_jemput',
													'$all_antar_jemput_jul_value',
													'$all_antar_jemput_aug_value',
													'$all_antar_jemput_sep_value',
													'$all_antar_jemput_oct_value',
													'$all_antar_jemput_nov_value',
													'$all_antar_jemput_dec_value',
													'$all_antar_jemput_jan_value',
													'$all_antar_jemput_feb_value',
													'$all_antar_jemput_mar_value',
													'$all_antar_jemput_apr_value',
													'$all_antar_jemput_may_value',
													'$all_antar_jemput_jun_value'
												
												)
												";
			
				$query_insert_antar_jemput	= mysqli_query($mysql_connect, $src_insert_antar_jemput) or die(mysql_error());
				
			}
			
		
	
	}
	
}
?>