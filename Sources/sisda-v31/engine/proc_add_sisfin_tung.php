<?PHP
session_start(); 

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$no_sisda 	= empty($_GET["ns"]) ? "" : $_GET["ns"];
	$periode	= empty($_GET["p"]) ? "" : $_GET["p"];
	$sis_fin	= empty($_GET["sf"]) ? "" : $_GET["sf"];
	
	$no_sisda_enc = mysql_real_escape_string($no_sisda);
	$periode_enc = mysql_real_escape_string($periode);
	$sis_fin_enc = mysql_real_escape_string($sis_fin);
	
	$src_cur_month = date("F");
	if($src_cur_month == "January") 	{ $edu_month = 7; } 
	if($src_cur_month == "February") 	{ $edu_month = 8; }
	if($src_cur_month == "March") 		{ $edu_month = 9; }
	if($src_cur_month == "April") 		{ $edu_month = 10; }
	if($src_cur_month == "May") 		{ $edu_month = 11; }
	if($src_cur_month == "June") 		{ $edu_month = 12; }
	if($src_cur_month == "July") 		{ $edu_month = 1; }
	if($src_cur_month == "August") 		{ $edu_month = 2; }
	if($src_cur_month == "September") 	{ $edu_month = 3; }
	if($src_cur_month == "October") 	{ $edu_month = 4; }
	if($src_cur_month == "November") 	{ $edu_month = 5; }
	if($src_cur_month == "December") 	{ $edu_month = 6; }
	
	
	if($no_sisda != "" && $periode != "" && ($sis_fin != "" || $tunggakan != "")) {
	
		$first_last_year 	= substr($periode,0,4) - 1;
		$second_last_year 	= substr($periode,7,4) - 1;
		$last_year_periode	= $first_last_year." - ".$second_last_year; //echo "<h1>".$last_year_periode."</h1>";
	
		//Check dulu siswa_finance untuk tahun ini sudah ada apa belum
		$src_chk_sisfin_cur 	= "select id,spp,ict,elearning,ks from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$periode_enc'";
		$query_chk_sisfin_cur	= mysqli_query($mysql_connect, $src_chk_sisfin_cur) or die(mysql_error());
		$num_chk_sisfin_cur		= mysql_num_rows($query_chk_sisfin_cur); //echo "<h1>".$src_chk_sisfin_cur."</h1>";
		
		if($num_chk_sisfin_cur == "0") {
		
			$src_get_data_lastyear 		= "select kat_status_anak,tingkat from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$last_year_periode'";
			$query_get_data_lastyear 	= mysqli_query($mysql_connect, $src_get_data_lastyear) or die(mysql_error());
			$get_data_lastyear			= mysql_fetch_array($query_get_data_lastyear);		
			
			$status_lastyear			= $get_data_lastyear["kat_status_anak"]; //echo $status_lastyear;
			if($status_lastyear == "umum") { $prosen_status = 1; }
			else if($status_lastyear == "anak guru") { $prosen_status = 0.5; }
			
			$tingkat_lastyear			= $get_data_lastyear["tingkat"]; //echo "tingkat_lastyear= ".$tingkat_lastyear;
			
			$src_get_data_siswa		= "select periode,nama_siswa from siswa where no_sisda = '$no_sisda_enc'";
			$query_get_data_siswa	= mysqli_query($mysql_connect, $src_get_data_siswa) or die(mysql_error());
			$get_data_siswa			= mysql_fetch_array($query_get_data_siswa);
			//
			$src_tahun_siswa_masuk	= $get_data_siswa["periode"];			
			$tahun_siswa_masuk		= substr($src_tahun_siswa_masuk,2,2).substr($src_tahun_siswa_masuk,9,2);
			$tahun_siswa_masuk_cur	= substr($periode_enc,2,2).substr($periode_enc,9,2);
			//
			$src_nama_siswa			= $get_data_siswa["nama_siswa"];
			
			//Tentang $periode_tingkat kenapa tahun ajaran untuk tingkat sekarang yang 
			//PG dari Toddler, TK A dari PG, TK B dari TK A, 1 dari TK B, 6 ke 7
			//dia pakai tahun ajaran yang berjalan (sekarang)???????
			//Karena di Setting SPP, untuk tingkat-tingkat tersebut tidak ada opsi tahun masuknya
			//Cuma ada satu, yaitu tahun sekarang. 
			//Sedang untuk kelas 2 ke atas, dia punya opsi lebih dari satu tahun masuk
			//Liat aja sendiri klo gak percaya....
			
						
			if($tingkat_lastyear == "toddler")	{ $tingkat_cur = "PG";		$tingkat_get_spp = "pg";	$jenjang_cur = "PG";	$periode_tingkat = $tahun_siswa_masuk_cur; }
			if($tingkat_lastyear == "PG") 		{ $tingkat_cur = "TK A"; 	$tingkat_get_spp = "tka";	$jenjang_cur = "TK A";  $periode_tingkat = $tahun_siswa_masuk_cur; }
			if($tingkat_lastyear == "TK A") 	{ $tingkat_cur = "TK B";	$tingkat_get_spp = "tkb";	$jenjang_cur = "TK B";	$periode_tingkat = $tahun_siswa_masuk_cur; }
			if($tingkat_lastyear == "TK B") 	{ $tingkat_cur = "1";		$tingkat_get_spp = "1";		$jenjang_cur = "SD"; 	$periode_tingkat = $tahun_siswa_masuk_cur; }
			if($tingkat_lastyear == 1)			{ $tingkat_cur = "2";		$tingkat_get_spp = "2";		$jenjang_cur = "SD";  	$periode_tingkat = $tahun_siswa_masuk; }
			if($tingkat_lastyear == 2) 			{ $tingkat_cur = "3";		$tingkat_get_spp = "3";		$jenjang_cur = "SD"; 	$periode_tingkat = $tahun_siswa_masuk; }
			if($tingkat_lastyear == 3) 			{ $tingkat_cur = "4";		$tingkat_get_spp = "4";		$jenjang_cur = "SD"; 	$periode_tingkat = $tahun_siswa_masuk; }
			if($tingkat_lastyear == 4) 			{ $tingkat_cur = "5";		$tingkat_get_spp = "5";		$jenjang_cur = "SD"; 	$periode_tingkat = $tahun_siswa_masuk; }
			if($tingkat_lastyear == 5) 			{ $tingkat_cur = "6";		$tingkat_get_spp = "6";		$jenjang_cur = "SD"; 	$periode_tingkat = $tahun_siswa_masuk; }
			if($tingkat_lastyear == 6) 			{ $tingkat_cur = "7";		$tingkat_get_spp = "7";		$jenjang_cur = "SMP"; 	$periode_tingkat = $tahun_siswa_masuk_cur; }
			if($tingkat_lastyear == 7) 			{ $tingkat_cur = "8";		$tingkat_get_spp = "8";		$jenjang_cur = "SMP"; 	$periode_tingkat = $tahun_siswa_masuk; }
			if($tingkat_lastyear == 8) 			{ $tingkat_cur = "9";		$tingkat_get_spp = "9";		$jenjang_cur = "SMP"; 	$periode_tingkat = $tahun_siswa_masuk; }
			
			//echo "<h1>tinglast=".$tingkat_lastyear."</h1>";
			
			$src_get_spp_cur	= "select nominal,item_byr from set_spp where tingkat = '$tingkat_get_spp' and periode = '$periode_enc' and ket_disc = '$periode_tingkat'";
			$query_get_spp_cur	= mysqli_query($mysql_connect, $src_get_spp_cur) or die(mysql_error()); 
			$num_get_spp_cur	= mysql_num_rows($query_get_spp_cur);
			//echo mysql_num_rows($query_get_spp_cur);
			echo $src_get_spp_cur;
			
			if($num_get_spp_cur != 0) {
			
				while($get_spp_cur = mysql_fetch_array($query_get_spp_cur)) {
				
					if($get_spp_cur["item_byr"] == "spp") { $cur_nom_spp = $get_spp_cur["nominal"]*$prosen_status; }
					if($get_spp_cur["item_byr"] == "ict") { $cur_nom_ict = $get_spp_cur["nominal"]*$prosen_status; }
					if($get_spp_cur["item_byr"] == "ler") { $cur_nom_ler = $get_spp_cur["nominal"]*$prosen_status; }
					if($get_spp_cur["item_byr"] == "kts") { 
					
						if($jenjang_cur == "SD") { $cur_nom_kts = $get_spp_cur["nominal"]*$prosen_status; } //SD KS anak guru 50%
						else { $cur_nom_kts = $get_spp_cur["nominal"]; } // SMP KS anak tetap 100% & TK gak ada KS
						
					}
				
				}
			
				$all_spp_cur = $cur_nom_spp + $cur_nom_ict + $cur_nom_kts + $cur_nom_ler;
			
				$src_add_new_data_finance = "insert into siswa_finance 
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
												
													'$no_sisda_enc',
													'1',
													'$src_nama_siswa',
													'$periode_enc',
													'$jenjang_cur',
													'$tingkat_cur',
													'$status_lastyear',
													'$cur_nom_spp',
													'$cur_nom_ict',
													'$cur_nom_ler',
													'$cur_nom_kts'
												
												)
													
											";
				$query_add_new_data_finance = mysqli_query($mysql_connect, $src_add_new_data_finance) or die(mysql_error());
			
				if($query_add_new_data_finance) {
				
					$src_change_last_status 	= "update siswa_finance set aktif = '2' where no_sisda = '$no_sisda_enc' and periode = '$last_year_periode'";
					$query_change_last_status	= mysqli_query($mysql_connect, $src_change_last_status) or die(mysql_error());
					
					if($query_change_last_status) { 
						
						//echo "query_change_last_status ok";
					
						if( $tingkat_cur == "PG" || $tingkat_cur == "TK A" || $tingkat_cur == "TK B" || $tingkat_cur == "1" || $tingkat_cur == "7" ) {
					
							$src_update_tahun_masuk 	= "update siswa set periode = '$periode_enc' where no_sisda = '$no_sisda_enc'";
							$query_update_tahun_masuk	= mysqli_query($mysql_connect, $src_update_tahun_masuk) or die(mysql_error());
							
							if($query_update_tahun_masuk) {
							
								$go_check_tunggakan = "ya"; 
								
							} else {							
								
								echo "
								<body style = 'margin:0px;'>
								<table cellspacing='0' cellpadding='0' border='0' width='100%' height='100%' bgcolor='#cccccc'>						
								<tr>
								<td align='center' style='font-family:verdana; font-size:14px;'	>
								<img src='images/error.png'><br><br>					
								<u>Mohon dicatat pesan di bawah ini untuk keperluan admin:</u><br><br>
								Periode tahun masuk pada table \"siswa\" dengan nama siswa <b>".ucwords($src_nama_siswa)." [".$no_sisda_enc."]</b> tahun ajaran <b>$periode_enc</b> tidak dapat di<i>update</i>
								<br>Hubungi admin!	<br><br>			
								<input type='button' value='Kembali ke halaman transaksi' onclick=\"window.location.href='mainpage.php?pl=transaction_src_idsisda';\" style='font-size:14px;' />
								</td>
								</tr>
								</table>
								</body>
								";
						
								$go_check_tunggakan = "tidak";
								$back_to_transaksi 	= "tidak";
															
							}
							
							
						} else {
						
							$go_check_tunggakan = "ya"; 
						
						}
						
					}
					
				}
				
			
			} else {
						
				//data setting sppnya gak ketemu....
				echo "
						<body style = 'margin:0px;'>
						<table cellspacing='0' cellpadding='0' border='0' width='100%' height='100%' bgcolor='#cccccc'>						
						<tr>
						<td align='center' style='font-family:verdana; font-size:14px;'	>
						<img src='images/error.png'><br><br>					
						<u>Mohon dicatat pesan di bawah ini untuk keperluan admin:</u><br><br>
						Data keuangan siswa <b>".ucwords($src_nama_siswa)." [".$no_sisda_enc."]</b> untuk tahun ajaran <b>$periode_enc</b> tidak dapat dibuat<br>
						Setting SPP untuk tingkat = <b>$tingkat_cur</b>, periode = <b>$periode_enc</b> dan ket_disc = <b>$tahun_siswa_masuk</b> tidak diketahui.<br>Hubungi admin!	<br><br>			
						<input type='button' value='Kembali ke halaman transaksi' onclick=\"window.location.href='mainpage.php?pl=transaction_src_idsisda';\" style='font-size:14px;' />
						</td>
						</tr>
						</table>
						</body>
				";
				$go_check_tunggakan = "tidak";
				$back_to_transaksi 	= "tidak";
			
			}
			
		
		} else {
		
			$row_chk_sisfin_cur = mysql_fetch_array($query_chk_sisfin_cur);
			
			$cur_nom_spp = $row_chk_sisfin_cur["spp"]; //echo "spp: ". $cur_nom_spp."<br>";
			$cur_nom_ict = $row_chk_sisfin_cur["ict"]; //echo "ict: ". $cur_nom_ict."<br>";
			$cur_nom_kts = $row_chk_sisfin_cur["ks"]; //echo "kts: ". $cur_nom_kts."<br>";
			$cur_nom_ler = $row_chk_sisfin_cur["elearning"]; //echo "ler: ". $cur_nom_ler."<br>";
			
			$all_spp_cur = $cur_nom_spp + $cur_nom_ict + $cur_nom_kts + $cur_nom_ler; //echo "all_spp_cur: ". $all_spp_cur."<br>";
		
			$go_check_tunggakan = "ya";
		
		}

	}
	
	if($go_check_tunggakan == "ya") { 
	
		//echo "cek tunggakan ok";
	
		$src_check_tunggakan 	= "select id from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$periode_enc' and jenis_tunggakan = 'spp'";
		$query_check_tunggakan 	= mysqli_query($mysql_connect, $src_check_tunggakan) or die(mysql_error());
		$num_check_tunggakan	= mysql_num_rows($query_check_tunggakan);
		
		if($num_check_tunggakan == 0) {
			
			if($edu_month == 1) 	{ $add_val_july =  "1-".$all_spp_cur; } 
			else if($edu_month > 1) { $add_val_july =  "4-".$all_spp_cur; }
			
			if($edu_month < 2) 			{ $add_val_august =  "0-".$all_spp_cur; } 
			else if($edu_month == 2) 	{ $add_val_august =  "1-".$all_spp_cur; }
			else if($edu_month > 2) 	{ $add_val_august =  "4-".$all_spp_cur; }
			
			if($edu_month < 3) 			{ $add_val_september =  "0-".$all_spp_cur; } 
			else if($edu_month == 3) 	{ $add_val_september =  "1-".$all_spp_cur; }
			else if($edu_month > 3) 	{ $add_val_september =  "4-".$all_spp_cur; }
			
			if($edu_month < 4) 			{ $add_val_october =  "0-".$all_spp_cur; } 
			else if($edu_month == 4) 	{ $add_val_october =  "1-".$all_spp_cur; }
			else if($edu_month > 4) 	{ $add_val_october =  "4-".$all_spp_cur; }
			
			if($edu_month < 5) 			{ $add_val_november =  "0-".$all_spp_cur; } 
			else if($edu_month == 5) 	{ $add_val_november =  "1-".$all_spp_cur; }
			else if($edu_month > 5) 	{ $add_val_november =  "4-".$all_spp_cur; }
			
			if($edu_month < 6) 			{ $add_val_december =  "0-".$all_spp_cur; } 
			else if($edu_month == 6) 	{ $add_val_december =  "1-".$all_spp_cur; }
			else if($edu_month > 6) 	{ $add_val_december =  "4-".$all_spp_cur; }
			
			if($edu_month < 7) 			{ $add_val_january =  "0-".$all_spp_cur; } 
			else if($edu_month == 7) 	{ $add_val_january =  "1-".$all_spp_cur; }
			else if($edu_month > 7) 	{ $add_val_january =  "4-".$all_spp_cur; }
			
			if($edu_month < 8) 			{ $add_val_february =  "0-".$all_spp_cur; } 
			else if($edu_month == 8) 	{ $add_val_february =  "1-".$all_spp_cur; }
			else if($edu_month > 8) 	{ $add_val_february =  "4-".$all_spp_cur; }
			
			if($edu_month < 9) 			{ $add_val_march =  "0-".$all_spp_cur; } 
			else if($edu_month == 9) 	{ $add_val_march =  "1-".$all_spp_cur; }
			else if($edu_month > 9) 	{ $add_val_march =  "4-".$all_spp_cur; }
			
			if($edu_month < 10) 		{ $add_val_april =  "0-".$all_spp_cur; } 
			else if($edu_month == 10) 	{ $add_val_april =  "1-".$all_spp_cur; }
			else if($edu_month > 10) 	{ $add_val_april =  "4-".$all_spp_cur; }
			
			if($edu_month < 11) 		{ $add_val_may =  "0-".$all_spp_cur; } 
			else if($edu_month == 11) 	{ $add_val_may =  "1-".$all_spp_cur; }
			else if($edu_month > 11) 	{ $add_val_may =  "4-".$all_spp_cur; }
			
			if($edu_month < 12) 		{ $add_val_june =  "0-".$all_spp_cur; } 
			else if($edu_month == 12) 	{ $add_val_june =  "1-".$all_spp_cur; }
			
			$src_insert_cur_tunggakan = "
			
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
												'$no_sisda_enc',
												'$periode_enc',
												'1',
												'spp',
												'$add_val_july',
												'$add_val_august',
												'$add_val_september',
												'$add_val_october',
												'$add_val_november',
												'$add_val_december',
												'$add_val_january',
												'$add_val_february',
												'$add_val_march',
												'$add_val_april',
												'$add_val_may',
												'$add_val_june'
											)
			
										";
										
			$query_insert_cur_tunggakan = mysqli_query($mysql_connect, $src_insert_cur_tunggakan) or die(mysql_error());
			
			$back_to_transaksi = "iya";
		
		} else {
		
			$back_to_transaksi = "iya";
		
		}
		
	}

	if($back_to_transaksi == "iya") {
	
		header('Location:'.$darbi_url.'mainpage.php?pl=transaction&no='.$no_sisda);
		//echo "Send to transaktion";	
	
	}

}
?>