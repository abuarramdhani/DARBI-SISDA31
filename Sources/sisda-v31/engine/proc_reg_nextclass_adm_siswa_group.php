<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	if(!empty($_POST["periode"]) && !empty($_POST["tingkat"])) {
	
		
		$tingkat	= mysql_real_escape_string($_POST["tingkat"]);
		$periode	= mysql_real_escape_string($_POST["periode"]);
		
		//where are going to get this pattern from field (tingkat) values
		// Kelas Play Group ke TK A
		// Kelas TK A ke TK B
		// Kelas 1 ke 2
		if(!is_numeric($tingkat))  {
			if($tingkat == "A") {
			
				$cur_tingkat 	= "Toddler";
				$next_tingkat	= "TK A";
				$jen_cat_adm	= "tka";
				$set_cat_adm	= "dafultka";
			}
			
			if($src_tingkat == "B") {
				
				$cur_tingkat 	= "TK A";
				$next_tingkat	= "TK B";
				$jen_cat_adm	= "tkb";
				$set_cat_adm	= "dafultkb";				
			}
		} else {
		
			$cur_tingkat	= $tingkat-1;
			$next_tingkat	= $tingkat;
			
		}
			
		//echo $cur_tingkat."<br>";
		//echo $next_tingkat."<br>";
		
		$cur_year_edu	= $periode; //echo $cur_year_edu."<br>";
		$next_year_edu	= (substr($periode,0,4)+1)." - ".(substr($periode,7,4)+1); //echo $next_year_edu."<br>";
		
		$bulan_text	= strtolower(date("F"));
		$bulan_num	= date("m");
		
		//Lets get the amount of month
		$src_get_month		= "select * from kontrol_bulan_spp where periode = '$next_year_edu'";
		$query_get_month	= mysqli_query($mysql_connect, $src_get_month) or die("Terjadi kesalahan: ".mysql_error());
		
		//We have to know how many months are available (the month already came) in this educatioan year.
		$num_month			= mysql_num_rows($query_get_month);	
		
		//Set as a default value for each month with 0, the meaning is payment time (month) for each month is not coming yet
		$val_july		= 0;
		$val_august		= 0;
		$val_september	= 0;
		$val_october	= 0;
		$val_november	= 0;
		$val_december	= 0;
		$val_january	= 0;
		$val_february	= 0;
		$val_march		= 0;
		$val_april		= 0;
		$val_may		= 0;
		$val_june		= 0;
		
		//Once more,..... this importanttantantantantnantantnant......... mal kamal
		//if $num_month = 0, it means year education hanst coming yet, so keep the val_month above as 0
					
		if($num_month != 0) {
		
			//When is the month where student does registration? ==> $tanggal_daftar_exp[1] = month when student registration
			//we need to know it, because we want to set current month in table tunggakan to 1 
			//-----------IMPORTANT: Education Year Starts on JULY------------------
			if($tanggal_daftar_exp[1] == 1 ) { $current_month = 7; } 	// 1=January, 	so January is the 7th month from july
			if($tanggal_daftar_exp[1] == 2 ) { $current_month = 8; } 	// 2=February, 	so February is the 8th month from july
			if($tanggal_daftar_exp[1] == 3 ) { $current_month = 9; } 	// 3=March, 	so March is the 9th month from july
			if($tanggal_daftar_exp[1] == 4 ) { $current_month = 10; }	// 4=April, 	so April is the 10th month from july
			if($tanggal_daftar_exp[1] == 5 ) { $current_month = 11; }	// 5=May, 		so May is the 11th month from july
			if($tanggal_daftar_exp[1] == 6 ) { $current_month = 12; }	// 6=June, 		so June is the 12th month from july
			if($tanggal_daftar_exp[1] == 7 ) { $current_month = 1; }	// 7=July, 		so July is the 1st month in this education year
			if($tanggal_daftar_exp[1] == 8 ) { $current_month = 2; }	// 8=August, 	so August is the 2nd month from july
			if($tanggal_daftar_exp[1] == 9 ) { $current_month = 3; }	// 9=Sebtember,	so Sebtember is the 3rd month from july
			if($tanggal_daftar_exp[1] == 10 ) { $current_month = 4; }	// 10=October, 	so October is the 4th month from july
			if($tanggal_daftar_exp[1] == 11 ) { $current_month = 5; }	// 11=November, so November is the 5th month from july
			if($tanggal_daftar_exp[1] == 12 ) { $current_month = 6; }	// 12=December, so December is the 6th month from july
			
			//echo $num_month;
			
			/*
			---Anda Opah Kamal harap perhatikan baik-baik, sebab ini bagian paling krusial di sisda v3, jangan ngurusin domba garut terus... hehehe---
			
			Before, i'll explain you about the logic of this function..... 
			You have to understand that, it's all about student registration. why this function must be created?
			As we know, sometimes in Darbi, there is 1 or more student that joint to darbi, not in the beginning of year of education (in july)
			Let say, in august, December or another else. It usually happen to moving student from another school... (siswa pindahan boss....)
			If a stundent (moving student) does his registration in December, of course he/she doesnt need to pay SPP from july, August, September, October and November
			He just need to pay the SPP for December. Agree..????
			So, we have to ensure this system knows, when a student joint to Darbi (Does his/her registration)
			So, we have to tell our system that this student doesnt need to pay SPP for july, August, September, October and November.
			
			==It Doesn't matter for regular student that do their registration in july on the education year, or before it. This system understand it.==
			
			In Database, field month in table kontrol_bulan_spp will be updated automatically when the month is already came. 
			It's being done by page proc_login.php.
			So it is imposible that a student does his/her registration more than the last month that has been recorded in kontrol_bulan_spp, it's imposiblebelbelbelllll.......

			Firstly, We will loop this funtion as many months as we've got from table kontrol_bulan_spp
			As the example above, Let say, the education year has run until December. So it means, this month is december.
			And the student does his/her registration in December.
			What should this system do???
			This system has to set months in table tunggakan for this education year (period) as:
			July 			with 2 (has been paid)
			August 			with 2 (has been paid)
			September 		with 2 (has been paid)
			October 		with 2 (has been paid)
			November 		with 2 (has been paid)
			December 		with 1 (has to be paid)
			January			with 0 (hans't to be paid yet)
			February		with 0 (hans't to be paid yet)
			March			with 0 (hans't to be paid yet)
			April			with 0 (hans't to be paid yet)
			May				with 0 (hans't to be paid yet)
			June			with 0 (hans't to be paid yet)
			
						
			And then what?? 
			Here we go......
			$num_month has to be equal with 6, because it's December... you know it. check it above
			And also $current_month has to be equal with 6, becase it's december.. hehehehehhahahahaihihi 
			
			>>>>$num_month = 6; $current_month = 6;<<<<
			
			in our looping...
			
			If $i=1, we have to check whether current month of payment equal with $i (1/one) or not?
			1!=6,... so we set july with 2
			
			If $i=2, we have to check whether current month of payment equal with $i (2/two) or not?
			2!=6,... so we set August with 2
			
			If $i=3, we have to check whether current month of payment equal with $i (3/three) or not?
			3!=6,... so we set September with 2
			
			If $i=4, we have to check whether current month of payment equal with $i (4/four) or not?
			4!=6,... so we set october with 2
			
			If $i=5, we have to check whether current month of payment equal with $i (5/five) or not?
			5!=6,... so we set November with 2
			
			If $i=6, we have to check whether current month of payment equal with $i (6/six) or not?
			6=6,... Yoa ma mannnnnn,.......so we set December with 1
			
			And the rest (January, February, March, April, May and June) still 0, as defined is $val_month above.......
			
			[[[[[Wah, dari tadi gunain so udah berapa kali tuh di atas..... biar deh yang penting nggak nyasab kemana-mana...]]]]]
			*/
			
			for($i=0; $i<=$num_month; $i++) {			
				if($i == 1) { 
					//echo "current_month:".$current_month." num_month:".	$i."<br>";		
					if($current_month == $i) { $val_july = 1; } else { $val_july = 2; }
				}
				if($i == 2) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_august = 1; } else { $val_august = 2; }
				}
				if($i == 3) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_september = 1; } else { $val_september = 2; }
				}
				if($i == 4) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_october = 1; } else { $val_october = 2; }
				}
				if($i == 5) { 
					//echo "current_month:".$current_month." num_month:".	$i."<br>";				
					if($current_month == $i) { $val_november = 1; } else { $val_november = 2; }
				}	
				if($i == 6) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_december = 1; } else { $val_december = 2; }
				}
				if($i == 7) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_january = 1; } else { $val_january = 2; }
				}
				if($i == 8) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_february = 1; } else { $val_february = 2; }
				}
				if($i == 9) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_march = 1; } else { $val_march = 2; }
				}	
				if($i == 10) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_april = 1; } else { $val_april = 2; }
				}	
				if($i == 11) {
					//echo "current_month:".$current_month." num_month:".	$i."<br>"; 				
					if($current_month == $i) { $val_may = 1; } else { $val_may = 2; }
				}	
				if($i == 12) { 	
					//echo "current_month:".$current_month." num_month:".	$i."<br>";			
					if($current_month == $i) { $val_june = 1; } else { $val_june = 2; }
				}		
			}
		}
		
		/*echo $val_july.
		$val_august.
		$val_september.
		$val_october.
		$val_november.
		$val_december.
		$val_january.
		$val_february.
		$val_march.
		$val_april.
		$val_may.
		$val_june;*/
		
		//We need to know jenjang, it's should be like this.
		//tingkat 1,2,3,4,5,6 = sd
		//tingkat 7,8,9 = smp
		//But why it is starting from 2 for SD and from 8 for smp, you know because we are talking about "naik kelas browwwww".....
		
		if($next_tingkat == 2 || $next_tingkat == 3 || $next_tingkat == 4 || $next_tingkat = 5 || $next_tingkat ==6) {
		
			$next_jenjang	= "SD";
		
		} else if($next_tingkat == 8 || $next_tingkat == 9) {
		
			$next_jenjang	= "SMP";
		
		} else { echo "Siswa naik kelas ke tingkat berapa? tidak diketahui! Hubungi administrator"; }
		
		//And then, we need to know, how many student has to move to the next class... (naik kelas broww maksute)...
		//Lets go get their no_sisda and name.
		
		$src_select_siswa	= "select no_sisda,nama_siswa from siswa_finance where periode = '$periode' and tingkat = '$tingkat'";
		$query_select_siswa	= mysqli_query($mysql_connect, $src_select_siswa) or die (mysql_error());
		
		//echo $src_select_siswa."<br>";
		
		while($siswa = mysql_fetch_array($query_select_siswa)) {
		
			$id_sisda 	= ($siswa["no_sisda"]);
			$nama		= $siswa["nama_siswa"];
			//echo $id_sisda."<br>";
			
			/*
			/////////////////////////////////////////////////////////////////////
			/////////////////////////////IMPORTANT///////////////////////////////
			//Look! when we are talking about "student move to the next class"....
			//there are 2 ways to update data in table siswa_finance & tunggakan:
			// - from menu naik kelas
			// - from menu siswa baru (example: from other school to TK B darbi)
			//But, we have to ensure that there is no duplication for each data in those tables, in the same no_sisda and periode (education year)
			//So, what we are going to do now is, to check whether a record already exist or not yet.
			//If so, we should avoid inserting the second data.
			//We need to check in table siswa_finance only. 
			//Because table tunggakan will be inserted if the table siswa finance has been full filled only.
			/////////////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////
			*/
			
			//we have to check based on these three variables id sisda, next year education and next tingkat, whether the record already exist.
			$src_check_exist	= "select distinct no_sisda from siswa_finance where no_sisda = '$id_sisda' and periode = '$next_year_edu' and tingkat = '$next_tingkat'";
			$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die (mysql_error());
			$num_check_exist	= mysql_num_rows($query_check_exist);
			
			//Lets the system making an insertion for new record of (student move the next class) payment
			//If the result of query above is zero (0), it's mean the data has not been made.
			//So let it go
			if($num_check_exist == 0) {
			
				//In our system, spp that must be paid by a student is depend on when was that student joint to darbi, i mean when is the year education.
				//Because it's defferent between student level 5, that joint to darbi since the beginning of year of education (example: july 2009-2010)
				//with the student level 5, that joint to darbi two years after regular of education year (example: october 2011-2012)
				//So we need to know from table siswa, when a student joint to darbi.	
				
				$src_core_siswa		= "select periode, kat_status_anak from siswa where no_sisda = '$id_sisda'";
				$query_core_siswa	= mysqli_query($mysql_connect, $src_core_siswa) or die (mysql_error());
				$core_siswa			= mysql_fetch_array($query_core_siswa);
				
				$periode_siswa_masuk 	= $core_siswa["periode"]; 
				$status_anak			= strtolower($core_siswa["kat_status_anak"]); //echo "(".$periode_siswa_masuk." ".$status_anak.")<br>";
			
				
				//in table set_spp field src_ket_disc is written with this pattern: 1314,1415,1516, ect)
				//So wht are you waiting for,....... let's make it!
				$src_ket_disc		= substr($periode_siswa_masuk,2,2).substr($periode_siswa_masuk,9,2);
				
				//Another case is, about student status, umum and anak guru.
				//As we've known that anak guru has a discount of payment about 50% from regular payment.
				if($status_anak == "umum") { $var_payment = 1; }
				if($status_anak == "anak guru") { $var_payment = 0.5; }
				
				//echo $status_anak."<br>";
			
				//An then this is the point
				//We have to know about the nominal of next year payment for each student 
				//Also, we have to ensure that the nominal of payment in table set_spp, has been set by Mrs Fitri
				//if it hasn't been set, this couldnt work.
				$src_get_spp	= "select * from set_spp where tingkat = '$next_tingkat' and ket_disc = '$src_ket_disc' and periode ='$next_year_edu'";
				$query_get_spp	= mysqli_query($mysql_connect, $src_get_spp) or die(mysql_error());
				//echo "<h1>".mysql_num_rows($query_get_spp)."</h1>";
				
				//echo $src_get_spp."<br>";
			
				//Look!
				//It should there are 4 data records taken from database, spp, ict, kts (komite sekolah), ler (e-learning)
				//And before we use those data, we have to multiplicate it with the $status_anak
				while($data_spp =  mysql_fetch_array($query_get_spp)){
					//echo $data_spp["item_byr"].$data_spp["nominal"]."<br>";
					if($data_spp["item_byr"] == "spp") { $next_spp	= $data_spp["nominal"]*$var_payment; }
					if($data_spp["item_byr"] == "ict") { $next_ict	= $data_spp["nominal"]*$var_payment; }
					if($data_spp["item_byr"] == "kts") { $next_kts	= $data_spp["nominal"]*$var_payment; }
					if($data_spp["item_byr"] == "ler") { $next_ler	= $data_spp["nominal"]*$var_payment; }
				}
				
				//if the variable is not numeric, it means they are tka/b
				//We have another variable that have to be defined, in table finance
				//Those are seragam, kegiatan and peralatan
				if(!is_numeric($tingkat)) { 
					
					$src_get_adm	= "select nominal from set_cat_adm_bi_ma where set_cat_adm = '$set_cat_adm' and periode = '$next_year_edu' and jenjang = '$jen_cat_adm'";
					$query_get_adm	= mysqli_query($mysql_connect, $src_get_adm) or die(mysql_error());
					
					while($row_get_adm = mysql_fetch_array($query_get_adm)) {
						
						if($row_get_adm["serag"]) { $seragam 	= $row_get_adm["nominal"]; } //no discount for seragam... siapapun oknumnya hehehehe... soalnya jait di luar hehehe...
						if($row_get_adm["kegia"]) { $kegiatan	= $row_get_adm["nominal"]*$var_payment; }
						if($row_get_adm["peral"]) { $peralatan	= $row_get_adm["nominal"]*$var_payment; }
						
						//in table tunggakan nominal daful is an addition of seragam, kegiatan dan peralatan
						$src_daful	= $seragam + $kegiatan + $peralatan;
						
					}					
				} else {
				
					//these are for other student from SD/SMP
					$seragam	= "";
					$kegiatan	= "";
					$peralatan	= "";
				
				}
					
				//insert all data to siswa_finance as a guidance before students do their spp payment next year.
				$src_add_siswa_next	= "insert into siswa_finance (
										no_sisda,
										nama_siswa,
										periode,
										jenjang,
										tingkat,
										seragam,
										kegiatan,
										peralatan,
										spp,
										ict,
										elearning,
										ks
										) values (
										'$id_sisda',
										'$nama',									
										'$next_year_edu',
										'$next_jenjang',
										'$next_tingkat',
										'$seragam',
										'$kegiatan',
										'$peralatan',
										'$next_spp',
										'$next_ict',
										'$next_kts',
										'$next_ler'
										)
										";
				//echo $src_add_siswa_next;
				$query_add_siswa_next	= mysqli_query($mysql_connect, $src_add_siswa_next) or die(mysql_error());
				
				if($query_add_siswa_next) {
				
					//if the variable is not numeric, it means they are tka/b
					//let's make an insertion to table tunggakan					
					if(!is_numeric($tingkat)) { 
					
						$src_arrear_tkab	= "insert into tunggakan ( 
													no_sisda,
													periode,
													jenis_tunggakan,
													nominal_tunggakan,
													nom_pengembangan,
													nom_kegiatan,
													nom_peralatan,
													nom_seragam,
													nom_paket
													
												) value {
												
													'$id_sisda',
													'$next_year_edu',
													'daftar_ulang',
													'$src_daful',
													'$enc_pengembangan',
													'$enc_kegiatan',
													'$enc_peralatan',
													'$enc_seragam',
													'$enc_paket'
												}";	
												
						$mysql_arrear_tkab	= mysqli_query($mysql_connect, $src_arrear_tkab) or die(mysql_error());
					}
					
					
				
					//in table tunggakan, the nominal of errear is an addition of all payment component of spp, and the result is multiplicated with "status anak"
					$total_spp_group	= ($next_spp + $next_ict + $next_kts + $next_ler) * $var_payment;
					
					$src_insert_spp		= "insert into tunggakan (
												no_sisda,
												periode,
												jenis_tunggakan,
												nominal_tunggakan,
												jumlah_bulan,
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
												'$id_sisda',
												'$next_year_edu',
												'spp',
												'$total_spp_group',
												'12',
												'$val_july',
												'$val_august',
												'$val_september',
												'$val_october',
												'$val_november',
												'$val_december',
												'$val_january',
												'$val_february',
												'$val_march',
												'$val_april',
												'$val_may',
												'$val_june'
											)";
					//echo $src_insert_spp;						
					$query_insert_spp	= mysqli_query($mysql_connect, $src_insert_spp) or die("Terjadi kesalahan: ".mysql_error());
				} else { "proses input data ke table siswa_finance gagal dilakukan. Silakan hubungi adminisrator"; }				
			} else { "proses input data keuangan siswa tidak dapat dilakukan. Silakan hubungi administrator"; }
		} 
		
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
	} else { echo "Proses pengaktifan status siswa naik kelas tidak berhasil, silakan hubungi Admin"; } // if($query_change_aktif)
} else { header("location:../index.php"); } //user privilege is not 2*/
?>