<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$no_sisda 	= mysql_real_escape_string(htmlspecialchars($_GET["no"]));
	$p			= mysql_real_escape_string(htmlspecialchars($_GET["p"]));
	$j			= mysql_real_escape_string(htmlspecialchars($_GET["j"]));
	$enc		= mysql_real_escape_string(htmlspecialchars($_GET["enc"]));
	
	//$darbi_key dapat dari sisda-config.php
	$cek_enc = substr(md5($no_sisda.$p.$j.$darbi_key),0,15); 
	
	
	//echo "<h1>".$no_sisda."</h1>";
	//echo "<h1>".$p."</h1>";
	//echo "<h1>".$j."</h1>";
	//echo "<h1>".$enc."</h1>";
	//echo "<h1>".$cek_enc."</h1>";
	
	if($enc == $cek_enc) {
		
		//mau tahu status siswa pada tahun sekarang, anak guru atau umum
		//yang dikirim ke sini adalah tahun ajaran depan
		
		$src_tahun_sekarang = (substr($p,0,4)-1)." - ".(substr($p,7,4)-1);
		
		$src_cur_status 	= "select kat_status_anak, nama_siswa from siswa_finance where no_sisda = '$no_sisda' and periode = '$src_tahun_sekarang'";
		$query_cur_status 	= mysqli_query($mysql_connect, $src_cur_status) or die(mysql_error());
		$row_cur_status		= mysql_fetch_array($query_cur_status);
		
		$cur_status			= $row_cur_status["kat_status_anak"]; 
		$nama_siswa			= $row_cur_status["nama_siswa"];
		
		$src_get_persen 	= "select * from persen_bayar where periode = '$p'";
		$query_get_persen	= mysqli_query($mysql_connect, $src_get_persen) or die(mysqli_query($mysql_connect, ));
		$get_persen			= mysql_fetch_array($query_get_persen);
		
		
		
		$src_persen_kegiatan_tka 	= "";
		$src_persen_seragam_tka		= "";
		$src_persen_kegiatan_tkb 	= "";
		
		if($j == "TK A") { 		
			$src_item_byr 				= 'tka'; 
			$src_set_cat_adm 			= "dafultka"; 
			$src_persen_kegiatan_tka 	= $get_persen["kegiatan_tka"]; 
			$src_persen_seragam_tka 	= $get_persen["seragam_tka"]; 
		}
		
		//untuk tkb B gak ada biaya seragam ( kata bu fitri dia masih pake yang keas TK A - ini kebijakan TK), jadinya gak ada variabel $src_persen_seragam_tkb
		if($j == "TK B") { 
			$src_item_byr 				= 'tkb'; 
			$src_set_cat_adm 			= "dafultkb"; 
			$src_persen_kegiatan_tkb 	= $get_persen["kegiatan_tkb"]; 
		}
		
		if($cur_status == "umum") { 
			$persen_kegiatan_tka	= 1;
			$persen_seragam_tka		= 1;
			$persen_kegiatan_tkb	= 1;
			$persen_spp				= 1; 
			$persen_ict				= 1;
			$persen_elearning		= 1;
		}
		
		if($cur_status == "anak guru") { 
			$persen_kegiatan_tka	= $src_persen_kegiatan_tka / 100;
			$persen_seragam_tka		= $src_persen_seragam_tka / 100;
			$persen_kegiatan_tkb	= $src_persen_kegiatan_tkb / 100;
			$persen_spp				= $get_persen["spp_tk"] / 100;
			$persen_ict				= $get_persen["ict_tk"] / 100;
			$persen_elearning		= $get_persen["elearning_tk"] / 100;
		}
		
		/////////////////////////////////////////////////////////
		
		//echo "<h1>".$persen_daful."</h1>";
		//echo "<h1>".$persen_spp."</h1>";
		//echo "<h1>".$persen_ict."</h1>";
		//echo "<h1>".$persen_elearning."</h1>";
		
		//BIaya daful tahun depan
		$get_data_daful 	= "select * from set_cat_adm_bi_ma where periode = '$p' and jenjang = '$src_item_byr' and (cat_adm = 'kegia' or cat_adm = 'serag') and set_cat_adm = '$src_set_cat_adm'";
		$query_data_daful	= mysqli_query($mysql_connect, $get_data_daful) or die(mysql_error());		
		
		while($data_daful = mysql_fetch_array($query_data_daful)) {
		
			if($j == "TK A") {
		
				if($data_daful["cat_adm"] == "kegia") {
				
					$nominal_daful_kegia = $data_daful["nominal"] * $persen_kegiatan_tka;
					
				}
				
				if($data_daful["cat_adm"] == "serag") {
				
					$nominal_daful_serag = $data_daful["nominal"] * $persen_seragam_tka;
					
				}
			
			}
			
			if($j == "TK B") {
			
				if($data_daful["cat_adm"] == "kegia") {
				
					$nominal_daful_kegia = $data_daful["nominal"] * $persen_kegiatan_tkb;
					
				}
			
			}
		
		}	
		
		//echo $get_data_daful;
		//echo "<h1>".$data_daful["nominal"]."</h1>";	
		//echo "<h1>".$nominal_daful."</h1>";	
		
		//Biaya SPP, ICT, e-learning tahun depan
		$src_ket_disc = substr($p,2,2).substr($p,9,2);
		
		$get_data_daful_spp 	= "select * from set_spp where jenjang = '$src_item_byr' and periode = '$p' and ket_disc = '$src_ket_disc'";
		$query_data_daful_spp 	= mysqli_query($mysql_connect, $get_data_daful_spp) or die(mysql_error());
		
		$src_nom_daful_spp = "";
		$src_nom_daful_ict = "";
		$src_nom_daful_ler = "";
		
		while($data_daful_spp = mysql_fetch_array($query_data_daful_spp)) {
		    
			if($data_daful_spp["item_byr"] == "spp") { $src_nom_daful_spp = $data_daful_spp["nominal"] * $persen_spp; }
			if($data_daful_spp["item_byr"] == "ict") { $src_nom_daful_ict = $data_daful_spp["nominal"] * $persen_ict; }
			if($data_daful_spp["item_byr"] == "ler") { $src_nom_daful_ler = $data_daful_spp["nominal"] * $persen_elearning; }
		
		}
		
		if($j == "TK A") {
		
			$nominal_daful = $nominal_daful_kegia + $nominal_daful_serag;
		}
		
		if($j == "TK B") {
		
			$nominal_daful = $nominal_daful_kegia;
		}
		
		$nom_daful_spp = $src_nom_daful_spp + $src_nom_daful_ict + $src_nom_daful_ler;
		$nom_daful_spp_prefix = "0-".$nom_daful_spp;
		
		$src_add_siswa_finance = "
									insert into siswa_finance
									(
										no_sisda,
										aktif,
										nama_siswa,
										periode,
										jenjang,
										tingkat,
										kat_status_anak,
										kegiatan,
										spp,
										ict,
										elearning
									)
									values
									(
										'$no_sisda',
										'2',
										'$nama_siswa',
										'$p',
										'$j',
										'$j',
										'$cur_status',
										'$nominal_daful',
										'$src_nom_daful_spp',
										'$src_nom_daful_ict',
										'$src_nom_daful_ler'
										
									)	
								";
		
		//echo $src_add_siswa_finance;
								
		$query_add_siswa_finance = mysqli_query($mysql_connect, $src_add_siswa_finance) or die(mysql_error());
		
		if($query_add_siswa_finance) {
		
			$src_add_tunggakan_daful = "
										insert into tunggakan
										(
											no_sisda,
											periode,
											status,
											jenis_tunggakan,
											nominal_tunggakan,
											nom_kegiatan
										)
										values
										(
											'$no_sisda',
											'$p',
											'1',
											'daftar_ulang',
											'$nominal_daful',
											'$nominal_daful'										
										)
									
										";
								
			$query_add_tunggakan_daful = mysqli_query($mysql_connect, $src_add_tunggakan_daful) or die(mysql_error());
			
			if($query_add_tunggakan_daful) {
			
				$src_add_tunggakan_spp = "
											insert into tunggakan
											(
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
												
											)
											values
											(
												'$no_sisda',
												'$p',
												'2',
												'spp',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix',
												'$nom_daful_spp_prefix'
												
											)
				
										";
				$query_add_tunggakan_spp = mysqli_query($mysql_connect, $src_add_tunggakan_spp) or die(mysql_error());
			
			}
		
		}
	
	}
	
	
	
	if($query_add_tunggakan_spp) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add Daftar Ulang";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=transaction&no=$no_sisda";
		$redirect_text	= "Proses daftar ulang siswa<b> ".$nama_siswa."</b>, berhasil dilakukan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Proses daftar ulang gagal dilakukan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungi administrator"; }
?>