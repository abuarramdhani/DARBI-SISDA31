<?PHP
if($do_check_daftar_ulang == "ok") {

	//file ini akan di-include oleh file page/page_transaksi.php

	/////////////////////////////////////////////////////////
	/////Syarat proses daftar ulang adalah///////////////////
	/////Jika Setting SPP untuk tahun ajaran berikutnya//////
	/////Sudah ditentukan (diinput di table set_spp)/////////
	/////////////////////////////////////////////////////////
	
	//$edu_year_siswa dapat dari page/page_transaksi.php
	//$edu_year_siswa_next dapat dari page/page_transaksi.php juga sih....
	
	//Nyok kita cek dulu, apa bu fitri udah buat data keuangan untuk daftar ulang tahun ajaran depan.
	
	$src_check_daful_next_year = "
									select nominal,jenjang from set_cat_adm_bi_ma 
									where
									((jenjang = 'tkb' and  cat_adm = 'kegia' and set_cat_adm = 'dafultkb') or
									(jenjang = 'tka' and  cat_adm = 'kegia' and set_cat_adm = 'dafultka')) and
									periode = '$edu_year_siswa_next' 
								";
	//echo $src_check_daful_next_year;
	$query_check_daful_next_year = mysqli_query($mysql_connect, $src_check_daful_next_year) or die(mysql_error());
	
	while($check_daful_next_year = mysql_fetch_array($query_check_daful_next_year)) {
	
		$jenjang_daful_next = $check_daful_next_year["jenjang"];
	
		if($jenjang_daful_next == "tka") {
		
			if($check_daful_next_year["nominal"] == "" || $check_daful_next_year["nominal"] == 0) { $data_daful_tka = "kosong"; }
			else { $data_daful_tka = "ada"; }
		}
		
		if($jenjang_daful_next == "tkb") {
		
			if($check_daful_next_year["nominal"] == "" || $check_daful_next_year["nominal"] == 0) { $data_daful_tkb = "kosong"; }
			else { $data_daful_tkb = "ada"; }
		}
		
		//echo $check_daful_next_year["nominal"]."<br>";
	
	}
	
	$src_ket_disc = substr($edu_year_siswa_next,2,2).substr($edu_year_siswa_next,9,2);
	
	
	///ini mau check juga apakah nilai SPP TK A & TK B tahun ajaran depan dah dibuat belom sama bu FItri
	$src_check_spp_daful_next_year 		= "select nominal,item_byr from set_spp where periode = '$edu_year_siswa_next' and ket_disc = '$src_ket_disc' and tingkat = '$next_daful_spp'";
	$query_check_spp_daful_next_year	= mysqli_query($mysql_connect, $src_check_spp_daful_next_year) or die(mysql_error());
	$num_check_spp_daful_next_year		= mysql_num_rows($query_check_spp_daful_next_year);
	
	$next_nom_daful_spp = "";
	$next_nom_daful_ict = "";
	$next_nom_daful_ler = "";
	
	if($num_check_spp_daful_next_year != 3) {
	
		
	
		while($check_spp_daful_next_year = mysql_fetch_array($query_check_spp_daful_next_year)) {
		
			if($check_spp_daful_next_year["item_byr"] == "spp" ) { $next_nom_daful_spp = ($check_spp_daful_next_year["nominal"]); }
			if($check_spp_daful_next_year["item_byr"] == "ict" ) { $next_nom_daful_ict = ($check_spp_daful_next_year["nominal"]); }
			if($check_spp_daful_next_year["item_byr"] == "ler" ) { $next_nom_daful_ler = ($check_spp_daful_next_year["nominal"]); }
		
		//////////////////////////////////////HELOOOOOOOOOOOOOO SMAPAI SINI/////////////////////////
		}
		
		if($next_nom_daful_spp == "" || $next_nom_daful_spp == 0 || $next_nom_daful_ict == "" || $next_nom_daful_ict == 0 || $next_nom_daful_ler == "" || $next_nom_daful_ler == 0) { $data_daful_tka_spp = "ada"; } else { $data_daful_tka_spp = "kosong"; }

	}
	
	if($data_daful_tka_spp == "ada") {
?>	
	<span id="text_normal_white">Nominal biaya SPP, ICT dan KS untuk TK A/TK B, belum dilakukan / belum lengkap</span><br /><input type="button" value="Setting SPP TK A/ TK B" onclick="window.location.href='?pl=spp_setting&j=<?PHP echo $next_daful_spp; //$next_daful_spp dapet dari page_transaction.php ?>';" />
<?PHP	
	} else if($data_daful_tka == "kosong" || $data_daful_tkb == "kosong") {
	
?>
	<span id="text_normal_white">Nominal biaya daftar ulang untuk TK A/TK B, belum dilakukan</span><br /><input type="button" value="Setting Biaya Daftar Ulang TK A/ TK B" onclick="window.location.href='?pl=cat_adm_bi_ma_setting_frame';" />
<?PHP	
	} else {
	
		$enc = substr(md5($no_sisda_enc.$edu_year_siswa_next.$next_tingkat_daful.$darbi_key),0,15);
?>	
	<span id="text_normal_white"><b><?= $row_select_siswa["nama_siswa"]; ?></b> belum melakukan daftar ulang untuk tingkat <?= $next_tingkat_daful; ?>,<br /> tahun <?= $edu_year_siswa_next; ?></span><br /><input type="button" value="Lakukan Daftar Ulang" onclick="window.location.href='engine.php?case=add_daful&no=<?= $no_sisda_enc; ?>&enc=<?= $enc; ?>&p=<?= $edu_year_siswa_next; ?>&j=<?= $next_tingkat_daful; ?>';" />
<?PHP	
	}

} 
?>