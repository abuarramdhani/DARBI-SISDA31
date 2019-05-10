<?PHP
if($do_check_naik_kelas == "ok") {

	/////////////////////////////////////////////////////////
	/////Syarat proses naik kelas adalah/////////////////////
	/////Jika Setting SPP untuk tahun ajaran berikutnya//////
	/////Sudah ditentukan (diinput di table set_spp)/////////
	/////////////////////////////////////////////////////////

	//2015 - 2016
	//tahun ajaran berikutnya, diperoleh dari file include/check_date_error.php
	$next_edu_year = (substr($edu_year,0,4)+1)." - ".(substr($edu_year,7,4)+1);
	//echo $next_edu_year;
	$year_nakel = $edu_year;
	
	//cek apa data SPP untuk tahun SPP yang akan datang sudah diInput lengkap sama bu Fitri
	//Klo semua dah lengkap (harus semua, SD dan SMP), nggak ada yang kelewat, baru kita proses
	//Semuanya harus ada 108 record
	
	$src_check_complete_spp_nakel = "
										select nominal from set_spp 
										where
										(jenjang = 'sd' or jenjang = 'smp') and
										periode = '$year_nakel' and
										nominal != '0'									
									";
	$query_check_complete_spp_nakel = mysqli_query($mysql_connect, $src_check_complete_spp_nakel) or die(mysql_error());
	$num_check_complete_spp_nakel 	= mysql_num_rows($query_check_complete_spp_nakel);
	
	//echo "<h1>".$num_check_complete_spp_nakel."</h1>";
	//echo "<h1>".$src_check_complete_spp_nakel."</h1>";
	
	//Harus ada 108 record yang tidak 0 (artinya value SPPnya dah ada nominalnya)
	if($num_check_complete_spp_nakel == 108) {
	
		//Kalau OK. sekarang kita cek apakah proses naik kelas sudah pernah dilakuan apa belom
		//Klo sudah, mestinya dia sudah terecord tahun ajarannya (misal: 2015 - 2016) di table kontrol_naik_kelas
		$src_check_nakel_have_done 		= "select id from kontrol_naik_kelas where periode = '$year_nakel'";
		$query_check_nakel_have_done 	= mysqli_query($mysql_connect, $src_check_nakel_have_done) or die(mysql_error());
		$num_check_nakel_have_done		= mysql_num_rows($query_check_nakel_have_done);
		
		if($num_check_nakel_have_done == 0) {
		
			//Di database, tahun (periode) masuk anak-anak ini beda-beda kemungkinannya untuk setiap tingkat
			//untuk tahu kapan periodenya, kita ambil datanya dari table siswa/periode
			//nah di table setting spp sendiri mengikuti pola ini 2014 - 2015 jadi 1415
			//Pusing kepala nih,... mau buka puasa bentar lagi.... heudeuhhhhh......
			
			$subperiode_2_1 = (substr($year_nakel,2,2)-1).(substr($year_nakel,9,2)-1); 	//misal masuk SD tahun 1314
			$subperiode_2_2 = substr($year_nakel,2,2).substr($year_nakel,9,2);			//misal masuk SD tahun 1415
			
			$subperiode_3_1 = (substr($year_nakel,2,2)-2).(substr($year_nakel,9,2)-2);	//misal masuk SD tahun 1213
			$subperiode_3_2 = (substr($year_nakel,2,2)-1).(substr($year_nakel,9,2)-1);	//misal masuk SD tahun 1314
			$subperiode_3_3 = substr($year_nakel,2,2).substr($year_nakel,9,2);			//misal masuk SD tahun 1415
			
			$subperiode_4_1 = (substr($year_nakel,2,2)-3).(substr($year_nakel,9,2)-3);	//misal masuk SD tahun 1112
			$subperiode_4_2 = (substr($year_nakel,2,2)-2).(substr($year_nakel,9,2)-2);	//misal masuk SD tahun 1213
			$subperiode_4_3 = (substr($year_nakel,2,2)-1).(substr($year_nakel,9,2)-1);	//misal masuk SD tahun 1314
			$subperiode_4_4 = substr($year_nakel,2,2).substr($year_nakel,9,2);			//misal masuk SD tahun 1415
			
			$subperiode_5_1 = (substr($year_nakel,2,2)-4).(substr($year_nakel,9,2)-4);	//misal masuk SD tahun 1011
			$subperiode_5_2 = (substr($year_nakel,2,2)-3).(substr($year_nakel,9,2)-3);	//misal masuk SD tahun 1112
			$subperiode_5_3 = (substr($year_nakel,2,2)-2).(substr($year_nakel,9,2)-2);	//misal masuk SD tahun 1213
			$subperiode_5_4 = (substr($year_nakel,2,2)-1).(substr($year_nakel,9,2)-1);	//misal masuk SD tahun 1314
			$subperiode_5_5 = substr($year_nakel,2,2).substr($year_nakel,9,2);			//misal masuk SD tahun 1415
			
			//sprintf("%02d",variable) digunakan untuk buat 2 digit yang dimulai dengan 0, misalnya ya kayak di bawah 0910
			//Soalnya khawatir masih ada murid yang masuk tahun 2009 ke bawah... itu aja sih....
			$subperiode_6_1 = sprintf("%02d",(substr($year_nakel,2,2)-5)).(substr($year_nakel,9,2)-5);	//misal masuk SD tahun 0910
			$subperiode_6_2 = (substr($year_nakel,2,2)-4).(substr($year_nakel,9,2)-4);	//misal masuk SD tahun 1011
			$subperiode_6_3 = (substr($year_nakel,2,2)-3).(substr($year_nakel,9,2)-3);	//misal masuk SD tahun 1112
			$subperiode_6_4 = (substr($year_nakel,2,2)-2).(substr($year_nakel,9,2)-2);	//misal masuk SD tahun 1213
			$subperiode_6_5 = (substr($year_nakel,2,2)-1).(substr($year_nakel,9,2)-1);	//misal masuk SD tahun 1314
			$subperiode_6_6 = substr($year_nakel,2,2).substr($year_nakel,9,2);			//misal masuk SD tahun 1415			
			
			$subperiode_8_1 = (substr($year_nakel,2,2)-1).(substr($year_nakel,9,2)-1); 	//misal masuk SMP tahun 1314
			$subperiode_8_2 = substr($year_nakel,2,2).substr($year_nakel,9,2);			//misal masuk SMP tahun 1415
			
			$subperiode_9_1 = (substr($year_nakel,2,2)-2).(substr($year_nakel,9,2)-2); 	//misal masuk SMP tahun 1213
			$subperiode_9_2 = (substr($year_nakel,2,2)-1).(substr($year_nakel,9,2)-1); 	//misal masuk SMP tahun 1314
			$subperiode_9_3 = substr($year_nakel,2,2).substr($year_nakel,9,2);			//misal masuk SMP tahun 1415
		
			//Tis first thing we have to do is..... tak all data of nextyear SPP
			//Ngerti ra son?
			$src_nominal_spp_ny_nakel 	= "select nominal,ket_disc,item_byr,tingkat from set_spp where (jenjang = 'sd' || jenjang = 'smp') and periode = '$year_nakel'";
			$query_nominal_spp_ny_nakel	= mysqli_query($mysql_connect, $src_nominal_spp_ny_nakel) or die(mysql_error());	
			
			//echo "<h1>".$src_nominal_spp_ny_nakel."</h1>";
			//echo mysql_num_rows($query_nominal_spp_ny_nakel);
			
			while($nominal_spp_ny_nakel = mysql_fetch_array($query_nominal_spp_ny_nakel)) {
			
				//echo $nominal_spp_ny_nakel["tingkat"]." - ".$nominal_spp_ny_nakel["ket_disc"]."<br>";
				
				//jadi ini nanti mau kita pakai untuk dapatkan value nominal SPPnya
				//jadi gini nanti pola arraynya: ting_2_1314 => 560000, nah ginilah kira-kira
				//Artinya: untuk siswa kelas 2 yang masuk tahun ajaran 2013 - 2014 SPP tahun depan adalah Rp 560.000,-
				
				/////////////// Naik ke kelas 2
				if($nominal_spp_ny_nakel["tingkat"] == 2 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_2_1) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_2_1_spp = array('ting_2_spp_'.$subperiode_2_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_2_1_ict = array('ting_2_ict_'.$subperiode_2_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_2_1_kts = array('ting_2_kts_'.$subperiode_2_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_2_1_ler = array('ting_2_ler_'.$subperiode_2_1 => $nominal_spp_ny_nakel["nominal"]); }
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 2 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_2_2) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_2_2_spp = array('ting_2_spp_'.$subperiode_2_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_2_2_ict = array('ting_2_ict_'.$subperiode_2_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_2_2_kts = array('ting_2_kts_'.$subperiode_2_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_2_2_ler = array('ting_2_ler_'.$subperiode_2_2 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				/////////////// Naik ke kelas 3
				if($nominal_spp_ny_nakel["tingkat"] == 3 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_3_1) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_3_1_spp = array('ting_3_spp_'.$subperiode_3_1 => $nominal_spp_ny_nakel["nominal"]); }	
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_3_1_ict = array('ting_3_ict_'.$subperiode_3_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_3_1_kts = array('ting_3_kts_'.$subperiode_3_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_3_1_ler = array('ting_3_ler_'.$subperiode_3_1 => $nominal_spp_ny_nakel["nominal"]); }				
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 3 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_3_2) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_3_2_spp = array('ting_3_spp_'.$subperiode_3_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_3_2_ict = array('ting_3_ict_'.$subperiode_3_2 => $nominal_spp_ny_nakel["nominal"]); }	
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_3_2_kts = array('ting_3_kts_'.$subperiode_3_2 => $nominal_spp_ny_nakel["nominal"]); }	
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_3_2_ler = array('ting_3_ler_'.$subperiode_3_2 => $nominal_spp_ny_nakel["nominal"]); }					
				}				
				
				if($nominal_spp_ny_nakel["tingkat"] == 3 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_3_3) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_3_3_spp = array('ting_3_spp_'.$subperiode_3_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_3_3_ict = array('ting_3_ict_'.$subperiode_3_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_3_3_kts = array('ting_3_kts_'.$subperiode_3_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_3_3_ler = array('ting_3_ler_'.$subperiode_3_3 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				/////////////// Naik ke kelas 4
				if($nominal_spp_ny_nakel["tingkat"] == 4 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_4_1) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_4_1_spp = array('ting_4_spp_'.$subperiode_4_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_4_1_ict = array('ting_4_ict_'.$subperiode_4_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_4_1_kts = array('ting_4_kts_'.$subperiode_4_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_4_1_ler = array('ting_4_ler_'.$subperiode_4_1 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 4 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_4_2) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_4_2_spp = array('ting_4_spp_'.$subperiode_4_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_4_2_ict = array('ting_4_ict_'.$subperiode_4_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_4_2_kts = array('ting_4_kts_'.$subperiode_4_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_4_2_ler = array('ting_4_ler_'.$subperiode_4_2 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 4 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_4_3) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_4_3_spp = array('ting_4_spp_'.$subperiode_4_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_4_3_ict = array('ting_4_ict_'.$subperiode_4_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_4_3_kts = array('ting_4_kts_'.$subperiode_4_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_4_3_ler = array('ting_4_ler_'.$subperiode_4_3 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 4 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_4_4) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_4_4_spp = array('ting_4_spp_'.$subperiode_4_4 => $nominal_spp_ny_nakel["nominal"]); }	
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_4_4_ict = array('ting_4_ict_'.$subperiode_4_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_4_4_kts = array('ting_4_kts_'.$subperiode_4_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_4_4_ler = array('ting_4_ler_'.$subperiode_4_4 => $nominal_spp_ny_nakel["nominal"]); }				
				}
				
				/////////////// Naik ke kelas 5
				if($nominal_spp_ny_nakel["tingkat"] == 5 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_5_1) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_5_1_spp = array('ting_5_spp_'.$subperiode_5_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_5_1_ict = array('ting_5_ict_'.$subperiode_5_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_5_1_kts = array('ting_5_kts_'.$subperiode_5_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_5_1_ler = array('ting_5_ler_'.$subperiode_5_1 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 5 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_5_2) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_5_2_spp = array('ting_5_spp_'.$subperiode_5_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_5_2_ict = array('ting_5_ict_'.$subperiode_5_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_5_2_kts = array('ting_5_kts_'.$subperiode_5_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_5_2_ler = array('ting_5_ler_'.$subperiode_5_2 => $nominal_spp_ny_nakel["nominal"]); }				
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 5 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_5_3) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_5_3_spp = array('ting_5_spp_'.$subperiode_5_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_5_3_ict = array('ting_5_ict_'.$subperiode_5_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_5_3_kts = array('ting_5_kts_'.$subperiode_5_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_5_3_ler = array('ting_5_ler_'.$subperiode_5_3 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 5 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_5_4) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_5_4_spp = array('ting_5_spp_'.$subperiode_5_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_5_4_ict = array('ting_5_ict_'.$subperiode_5_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_5_4_kts = array('ting_5_kts_'.$subperiode_5_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_5_4_ler = array('ting_5_ler_'.$subperiode_5_4 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 5 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_5_5) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_5_5_spp = array('ting_5_spp_'.$subperiode_5_5 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_5_5_ict = array('ting_5_ict_'.$subperiode_5_5 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_5_5_kts = array('ting_5_kts_'.$subperiode_5_5 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_5_5_ler = array('ting_5_ler_'.$subperiode_5_5 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				/////////////// Naik ke kelas 6
				if($nominal_spp_ny_nakel["tingkat"] == 6 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_6_1) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_6_1_spp = array('ting_6_spp_'.$subperiode_6_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_6_1_ict = array('ting_6_ict_'.$subperiode_6_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_6_1_kts = array('ting_6_kts_'.$subperiode_6_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_6_1_ler = array('ting_6_ler_'.$subperiode_6_1 => $nominal_spp_ny_nakel["nominal"]); }				
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 6 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_6_2) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_6_2_spp = array('ting_6_spp_'.$subperiode_6_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_6_2_ict = array('ting_6_ict_'.$subperiode_6_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_6_2_kts = array('ting_6_kts_'.$subperiode_6_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_6_2_ler = array('ting_6_ler_'.$subperiode_6_2 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 6 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_6_3) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_6_3_spp = array('ting_6_spp_'.$subperiode_6_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_6_3_ict = array('ting_6_ict_'.$subperiode_6_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_6_3_kts = array('ting_6_kts_'.$subperiode_6_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_6_3_ler = array('ting_6_ler_'.$subperiode_6_3 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 6 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_6_4) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_6_4_spp = array('ting_6_spp_'.$subperiode_6_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_6_4_ict = array('ting_6_ict_'.$subperiode_6_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_6_4_kts = array('ting_6_kts_'.$subperiode_6_4 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_6_4_ler = array('ting_6_ler_'.$subperiode_6_4 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 6 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_6_5) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_6_5_spp = array('ting_6_spp_'.$subperiode_6_5 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_6_5_ict = array('ting_6_ict_'.$subperiode_6_5 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_6_5_kts = array('ting_6_kts_'.$subperiode_6_5 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_6_5_ler = array('ting_6_ler_'.$subperiode_6_5 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 6 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_6_5) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_6_6_spp = array('ting_6_spp_'.$subperiode_6_6 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_6_6_ict = array('ting_6_ict_'.$subperiode_6_6 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_6_6_kts = array('ting_6_kts_'.$subperiode_6_6 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_6_6_ler = array('ting_6_ler_'.$subperiode_6_6 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				/////////////// Naik ke kelas 8
				if($nominal_spp_ny_nakel["tingkat"] == 8 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_8_1) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_8_1_spp = array('ting_8_spp_'.$subperiode_8_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_8_1_ict = array('ting_8_ict_'.$subperiode_8_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_8_1_kts = array('ting_8_kts_'.$subperiode_8_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_8_1_ler = array('ting_8_ler_'.$subperiode_8_1 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 8 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_8_2) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_8_2_spp = array('ting_8_spp_'.$subperiode_8_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_8_2_ict = array('ting_8_ict_'.$subperiode_8_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_8_2_kts = array('ting_8_kts_'.$subperiode_8_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_8_2_ler = array('ting_8_ler_'.$subperiode_8_2 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				/////////////// Naik ke kelas 9
				if($nominal_spp_ny_nakel["tingkat"] == 9 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_9_1) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_9_1_spp = array('ting_9_spp_'.$subperiode_9_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_9_1_ict = array('ting_9_ict_'.$subperiode_9_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_9_1_kts = array('ting_9_kts_'.$subperiode_9_1 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_9_1_ler = array('ting_9_ler_'.$subperiode_9_1 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 9 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_9_2) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_9_2_spp = array('ting_9_spp_'.$subperiode_9_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_9_2_ict = array('ting_9_ict_'.$subperiode_9_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_9_2_kts = array('ting_9_kts_'.$subperiode_9_2 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_9_2_ler = array('ting_9_ler_'.$subperiode_9_2 => $nominal_spp_ny_nakel["nominal"]); }					
				}
				
				if($nominal_spp_ny_nakel["tingkat"] == 9 && $nominal_spp_ny_nakel["ket_disc"] == $subperiode_9_3) {
					if($nominal_spp_ny_nakel["item_byr"] == "spp") { $nakel_ar_9_3_spp = array('ting_9_spp_'.$subperiode_9_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ict") { $nakel_ar_9_3_ict = array('ting_9_ict_'.$subperiode_9_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "kts") { $nakel_ar_9_3_kts = array('ting_9_kts_'.$subperiode_9_3 => $nominal_spp_ny_nakel["nominal"]); }
					if($nominal_spp_ny_nakel["item_byr"] == "ler") { $nakel_ar_9_3_ler = array('ting_9_ler_'.$subperiode_9_3 => $nominal_spp_ny_nakel["nominal"]); }					
				}
			
			}
			
			echo $subperiode_9_1."<br>";;
			
			//Sekarang kita kumpulin semuanya jadi satu array,.... heheheheh..hahaha..haus euy....es kelapa enak nih
			$all_spp_ny_nakel_spp = array_merge($nakel_ar_2_1_spp,$nakel_ar_2_2_spp,$nakel_ar_3_1_spp,$nakel_ar_3_2_spp,$nakel_ar_3_3_spp,$nakel_ar_4_1_spp,$nakel_ar_4_2_spp,$nakel_ar_4_3_spp,$nakel_ar_4_4_spp,$nakel_ar_5_1_spp,$nakel_ar_5_2_spp,$nakel_ar_5_3_spp,$nakel_ar_5_4_spp,$nakel_ar_5_5_spp,$nakel_ar_6_1_spp,$nakel_ar_6_2_spp,$nakel_ar_6_3_spp,$nakel_ar_6_4_spp,$nakel_ar_6_5_spp,$nakel_ar_6_6_spp,$nakel_ar_8_1_spp,$nakel_ar_8_2_spp,$nakel_ar_9_1_spp,$nakel_ar_9_2_spp,$nakel_ar_9_3_spp);
			$all_spp_ny_nakel_ict = array_merge($nakel_ar_2_1_ict,$nakel_ar_2_2_ict,$nakel_ar_3_1_ict,$nakel_ar_3_2_ict,$nakel_ar_3_3_ict,$nakel_ar_4_1_ict,$nakel_ar_4_2_ict,$nakel_ar_4_3_ict,$nakel_ar_4_4_ict,$nakel_ar_5_1_ict,$nakel_ar_5_2_ict,$nakel_ar_5_3_ict,$nakel_ar_5_4_ict,$nakel_ar_5_5_ict,$nakel_ar_6_1_ict,$nakel_ar_6_2_ict,$nakel_ar_6_3_ict,$nakel_ar_6_4_ict,$nakel_ar_6_5_ict,$nakel_ar_6_6_ict,$nakel_ar_8_1_ict,$nakel_ar_8_2_ict,$nakel_ar_9_1_ict,$nakel_ar_9_2_ict,$nakel_ar_9_3_ict);
			$all_spp_ny_nakel_kts = array_merge($nakel_ar_2_1_kts,$nakel_ar_2_2_kts,$nakel_ar_3_1_kts,$nakel_ar_3_2_kts,$nakel_ar_3_3_kts,$nakel_ar_4_1_kts,$nakel_ar_4_2_kts,$nakel_ar_4_3_kts,$nakel_ar_4_4_kts,$nakel_ar_5_1_kts,$nakel_ar_5_2_kts,$nakel_ar_5_3_kts,$nakel_ar_5_4_kts,$nakel_ar_5_5_kts,$nakel_ar_6_1_kts,$nakel_ar_6_2_kts,$nakel_ar_6_3_kts,$nakel_ar_6_4_kts,$nakel_ar_6_5_kts,$nakel_ar_6_6_kts,$nakel_ar_8_1_kts,$nakel_ar_8_2_kts,$nakel_ar_9_1_kts,$nakel_ar_9_2_kts,$nakel_ar_9_3_kts);
			$all_spp_ny_nakel_ler = array_merge($nakel_ar_2_1_ler,$nakel_ar_2_2_ler,$nakel_ar_3_1_ler,$nakel_ar_3_2_ler,$nakel_ar_3_3_ler,$nakel_ar_4_1_ler,$nakel_ar_4_2_ler,$nakel_ar_4_3_ler,$nakel_ar_4_4_ler,$nakel_ar_5_1_ler,$nakel_ar_5_2_ler,$nakel_ar_5_3_ler,$nakel_ar_5_4_ler,$nakel_ar_5_5_ler,$nakel_ar_6_1_ler,$nakel_ar_6_2_ler,$nakel_ar_6_3_ler,$nakel_ar_6_4_ler,$nakel_ar_6_5_ler,$nakel_ar_6_6_ler,$nakel_ar_8_1_ler,$nakel_ar_8_2_ler,$nakel_ar_9_1_ler,$nakel_ar_9_2_ler,$nakel_ar_9_3_ler);
			/////////////////////
		
			//Panggil dari tabel siswa_finance, siswa kelas 1,2,3,4,5,7,8 (cuma mereka doang yang ngalamin naik kelas toh?
			//sekalian panggil juga dari table siswa, tahun periode dia masuknya
			$src_get_siswa_nakel = "
									select siswa_finance.no_sisda,siswa_finance.nama_siswa, siswa_finance.kat_status_anak, siswa_finance.tingkat, siswa.periode from siswa_finance,siswa where 
									(
									siswa_finance.tingkat = '1' or
									siswa_finance.tingkat = '2' or
									siswa_finance.tingkat = '3' or
									siswa_finance.tingkat = '4' or
									siswa_finance.tingkat = '5' or
									siswa_finance.tingkat = '7' or
									siswa_finance.tingkat = '8'
									) and
									siswa_finance.periode = '2014 - 2015' and
									siswa_finance.no_sisda = siswa.no_sisda
									";
									
			$query_get_siswa_nakel = mysqli_query($mysql_connect, $src_get_siswa_nakel) or die(mysql_error());
			
			while($get_siswa_nakel = mysql_fetch_array($query_get_siswa_nakel)) {			
								
				//check apa data finance tahun berikutnya sudah dibuat apa belum
				//klo belum ya kita buat sekarang. kalau udah ya jangan buat lagi
				//Harusnya sih belum....
				//Tapi kali aja ada yang iseng buat-buat....... hiii seiyemmmm
				$src_chk_finance_nakel_next 	= "select no_sisda from siswa_finance where periode = '2015 -2016'";
				$query_chk_finance_nakel_next 	= mysqli_query($mysql_connect, $src_chk_finance_nakel_next) or die(mysql_error());
				$num_chk_finance_nakel_next		= mysql_num_rows($query_chk_finance_nakel_next);
				
				//echo $num_chk_finance_nakel_next;
				
				if($num_chk_finance_nakel_next == 0) {
					
					$src_no_sisda_nakel			= $get_siswa_nakel["no_sisda"];
					$src_nama_siswa_nakel		= $get_siswa_nakel["nama_siswa"];
					$src_periode_nakel			= "2015 - 2016";
					$src_kat_status_anak_nakel 	= $get_siswa_nakel["kat_status_anak"];
					$src_tingkat_nakel 			= $get_siswa_nakel["tingkat"];
					
					//////////////////	
					if($src_kat_status_anak_nakel == "anak guru") { $kat_status_anak_nakel = "anak_guru"; $percent_nakel = "0,5"; } else { $kat_status_anak_nakel = "umum"; $percent_nakel = "1"; }
					
					//////////////////
					if($src_tingkat_nakel == "1") { $tingkat_nakel = "2"; $jenjang_nakel = "SD"; }
					if($src_tingkat_nakel == "2") { $tingkat_nakel = "3"; $jenjang_nakel = "SD"; }
					if($src_tingkat_nakel == "3") { $tingkat_nakel = "4"; $jenjang_nakel = "SD"; }
					if($src_tingkat_nakel == "4") { $tingkat_nakel = "5"; $jenjang_nakel = "SD"; }
					if($src_tingkat_nakel == "5") { $tingkat_nakel = "6"; $jenjang_nakel = "SD"; }
					if($src_tingkat_nakel == "7") { $tingkat_nakel = "8"; $jenjang_nakel = "SMP"; }
					if($src_tingkat_nakel == "8") { $tingkat_nakel = "9"; $jenjang_nakel = "SMP"; }
					
					//tahun masuk siswa yang dari tabel siswa kita rubah patternnya jadi kayak begini
					//2014 - 2015 jadi 1415
					$src_siswa_masuk	= substr($get_siswa_nakel["periode"],2,2).substr($get_siswa_nakel["periode"],9,2);
					
					$src_val_spp_nakel = $all_spp_ny_nakel_spp["ting_".$tingkat_nakel."_spp_".$src_siswa_masuk] * $percent_nakel;
					$src_val_ict_nakel = $all_spp_ny_nakel_ict["ting_".$tingkat_nakel."_ict_".$src_siswa_masuk] * $percent_nakel;
					$src_val_kts_nakel = $all_spp_ny_nakel_kts["ting_".$tingkat_nakel."_kts_".$src_siswa_masuk] * $percent_nakel;
					$src_val_ler_nakel = $all_spp_ny_nakel_ler["ting_".$tingkat_nakel."_ler_".$src_siswa_masuk] * $percent_nakel;
					
					//echo $get_siswa_nakel["nama_siswa"]." - ".$get_siswa_nakel["periode"]."-".$src_val_spp_nakel."-".$src_val_ict_nakel."-".$src_val_kts_nakel."-".$src_val_ler_nakel."<br>";
				
					$src_add_finance_nakel_next = "
													insert into siswa_finance 
													(
													no_sisda,
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
													'$src_no_sisda_nakel',
													'$src_nama_siswa_nakel',
													'$src_periode_nakel',
													'$jenjang_nakel',
													'$tingkat_nakel',
													'$kat_status_anak_nakel',
													'$src_val_spp_nakel',
													'$src_val_ict_nakel',
													'$src_val_ler_nakel',
													'$src_val_kts_nakel'
													)
													";
					//echo $src_add_finance_nakel_next."<br><br>";
					
					$query_add_finance_nakel_next = mysqli_query($mysql_connect, $src_add_finance_nakel_next) or die(mysql_error());
					
					if($query_add_finance_nakel_next) {
					
						$total_spp_nakel_next 		= $src_val_spp_nakel + $src_val_ict_nakel + $src_val_kts_nakel + $src_val_ler_nakel;
						$pref_total_spp_nakel_next	= "0-".$total_spp_nakel_next;
					
						$src_add_tunggakan_nakel_next = 
														"
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
														'$src_no_sisda_nakel',
														'$src_periode_nakel',
														'2',
														'spp',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next',
														'$pref_total_spp_nakel_next'
														)
														";
						//echo $src_add_tunggakan_nakel_next."<br><br>";								
						$query_tunggakan_nakel_next = mysqli_query($mysql_connect, $src_add_tunggakan_nakel_next) or die(mysql_error());	
						
						
					}
				}
			}
			
			if($query_tunggakan_nakel_next) {
							
				$src_insert_kontrol_nakel = "insert into kontrol_naik_kelas (periode) values ('$src_periode_nakel')";
				$query_insert_kontrol_nakel = mysqli_query($mysql_connect, $src_insert_kontrol_nakel) or die(mysql_error());
				
			}		
		}
	}
}
?>