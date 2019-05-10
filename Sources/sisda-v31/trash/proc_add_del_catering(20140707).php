<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	$daftar_catering	= !empty($_POST["daftarkan"]) ? $_POST["daftarkan"] : "";
	$berhenti_catering	= !empty($_POST["berhenti"]) ? $_POST["berhenti"] : ""; 
	$back_url			= $_POST["back_url"];
	
	if($daftar_catering == "Daftarkan Catering") {
		
		//Grab all...bezzzzziiig
		$bulan			= !empty($_POST["the_month"]) ? htmlspecialchars($_POST["the_month"]) : "";
		$tahun			= !empty($_POST["edu_year"]) ? htmlspecialchars($_POST["edu_year"]) : "";
		$src_name		= !empty($_POST["catering_name"]) ? htmlspecialchars($_POST["catering_name"]) : "";
		$src_siswa		= !empty($_POST["pilih"]) ? $_POST["pilih"] : "";
		
		$bulan_enc	= mysql_real_escape_string($bulan);
		$tahun_enc	= mysql_real_escape_string($tahun);
		$name_enc	= mysql_real_escape_string($src_name);
		$siswa_enc	= $src_siswa;
		
		//echo "bulan:".$bulan."<br>";
		//echo "tahun:".$tahun."<br>";
		//echo "pilih:".$_POST["pilih"]."<br>";
		//echo "count:".count($src_siswa)."<br>";
		//echo "$back_url<br>";
		//echo "name:".$src_name."<br>";
		//echo $src_siswa[0];
		//echo $src_siswa[1];
		//echo $src_siswa[2];
		//echo "adalah:".$_POST["adalah"];
		
		//We have to ensure that all of the data tat we need has been sent here
		//Other wise, do not do the process
		if($bulan != "" && $tahun != "" && $src_name != "" && $src_siswa != "") {
		
			//We have to ensure that admin do not choose old date.
			//I mean admin do not choose a month before current month
			//For example: Current month is March 2013. So using Februari, Januari 2013 or December, November, October, September, August, July 2012,
			//as 'catering month' is forbiden.
			//WHY...??????????
			//Because all fields in table tunggakan will corrupt.
			$fisrt_digit_year	= substr($tahun_enc,0,4);
			
			$src_check_exp_year		= "select max(periode_begin) as last_year from kontrol_bulan_spp";
			$query_check_exp_year	= mysqli_query($mysql_connect, $src_check_exp_year)or die(mysql_error());
			$row_check_exp_year		= mysql_fetch_array($query_check_exp_year);
			$last_year				= $row_check_exp_year["last_year"];
			
			if($last_year <= $fisrt_digit_year) {
			
				if($bulan_enc == 1 ) { $current_month = 7; } 	// 1=January, 	so January is the 7th month from july
				if($bulan_enc == 2 ) { $current_month = 8; } 	// 2=February, 	so February is the 8th month from july
				if($bulan_enc == 3 ) { $current_month = 9; } 	// 3=March, 	so March is the 9th month from july
				if($bulan_enc == 4 ) { $current_month = 10; }	// 4=April, 	so April is the 10th month from july
				if($bulan_enc == 5 ) { $current_month = 11; }	// 5=May, 		so May is the 11th month from july
				if($bulan_enc == 6 ) { $current_month = 12; }	// 6=June, 		so June is the 12th month from july
				if($bulan_enc == 7 ) { $current_month = 1; }	// 7=July, 		so July is the 1st month in this education year
				if($bulan_enc == 8 ) { $current_month = 2; }	// 8=August, 	so August is the 2nd month from july
				if($bulan_enc == 9 ) { $current_month = 3; }	// 9=Sebtember,	so Sebtember is the 3rd month from july
				if($bulan_enc == 10 ) { $current_month = 4; }	// 10=October, 	so October is the 4th month from july
				if($bulan_enc == 11 ) { $current_month = 5; }	// 11=November, so November is the 5th month from july
				if($bulan_enc == 12 ) { $current_month = 6; }	// 12=December, so December is the 6th month from july
				
				$src_get_max_year		= "select max(real_year) as max_year from kontrol_bulan_spp";
				$query_get_max_year		= mysqli_query($mysql_connect, $src_get_max_year) or die(mysql_error());
				$row_get_max_year		= mysql_fetch_array($query_get_max_year	);
				$max_year				= $row_get_max_year["max_year"];
			
				//$src_check_exp_month	= "select max(real_month) as last_month from kontrol_bulan_spp where real_year = 'max(real_year)'";
				//teuing kunaon, teu jalan urang nganggo ieu query......
				
				$src_check_exp_month	= "select max(real_month) as last_month from kontrol_bulan_spp where real_year = '$max_year'";
				$query_check_exp_month	= mysqli_query($mysql_connect, $src_check_exp_month) or die(mysql_error());
				$row_check_exp_month	= mysql_fetch_array($query_check_exp_month);
				$last_month				= $row_check_exp_month["last_month"];
				//echo $last_month; echo "$bulan_enc";
				if($last_month <= $bulan_enc) {		
		
					//Get the nominal of catering
					$src_get_nominal_catering	= "select nominal from cataj where type = 'Catering' and name = '$name_enc'";
					$query_get_nominal_catering	= mysqli_query($mysql_connect, $src_get_nominal_catering) or die(mysql_error());
					$get_nominal_catering		= mysql_fetch_array($query_get_nominal_catering);
					$src_nominal				= $get_nominal_catering["nominal"];
				
					//Check if the number of 'day of catering' has been set
					$src_get_num_day 	= "select * from cataj_num_day where periode = '$tahun_enc' and month = '$bulan_enc'"; 
					$query_get_num_day	= mysqli_query($mysql_connect, $src_get_num_day) or die(mysql_error());
					$get_num_day		= mysql_fetch_array($query_get_num_day);
					$num_get_num_day	= mysql_num_rows($query_get_num_day);
					
					if($num_get_num_day == 0 ) {
					
						$nominal = "x";
						
					} else {
					
						$nominal = $src_nominal * ($get_num_day["catering"]);
						
					}
					
					//Lets get the amount of month
					$src_get_month		= "select * from kontrol_bulan_spp where periode = '$tahun_enc'";
					$query_get_month	= mysqli_query($mysql_connect, $src_get_month) or die("Terjadi kesalahan: ".mysql_error());
					
					//We have to know how many months are available (the month already came) in this educatioan year.
					$num_month			= mysql_num_rows($query_get_month);	
				
					//As a default, we have to set the value of catering month as zero (0)
					//0-0 -> first 0 is a status (has been paid, or not yet). second 0 is the nominal of catering has to be paid each month 		
					$val_july		= "0-0";
					$val_august		= "0-0";
					$val_september	= "0-0";
					$val_october	= "0-0";
					$val_november	= "0-0";
					$val_december	= "0-0";
					$val_january	= "0-0";
					$val_february	= "0-0";
					$val_march		= "0-0";
					$val_april		= "0-0";
					$val_may		= "0-0";
					$val_june		= "0-0";
					
					for($i=0; $i<=$num_month; $i++) {	
						
						if($i == 1) { 						
							if($current_month == $i) { $val_july = "1-".$nominal; } else { $val_july = "4-0"; }
						}
						if($i == 2) { 			
							if($current_month == $i) { $val_august = "1-".$nominal; } else { $val_august = "4-0"; }
						}
						if($i == 3) { 		
							if($current_month == $i) { $val_september = "1-".$nominal; } else { $val_september = "4-0"; }
						}
						if($i == 4) { 		
							if($current_month == $i) { $val_october = "1-".$nominal; } else { $val_october = "4-0"; }
						}
						if($i == 5) { 		
							if($current_month == $i) { $val_november = "1-".$nominal; } else { $val_november = "4-0"; }
						}	
						if($i == 6) { 			
							if($current_month == $i) { $val_december = "1-".$nominal; } else { $val_december = "4-0"; }
						}
						if($i == 7) { 		
							if($current_month == $i) { $val_january = "1-".$nominal; } else { $val_january = "4-0"; }
						}
						if($i == 8) { 			
							if($current_month == $i) { $val_february = "1-".$nominal; } else { $val_february = "4-0"; }
						}
						if($i == 9) { 			
							if($current_month == $i) { $val_march = "1-".$nominal; } else { $val_march = "4-0"; }
						}	
						if($i == 10) { 		
							if($current_month == $i) { $val_april = "1-".$nominal; } else { $val_april = "4-0"; }
						}	
						if($i == 11) {		
							if($current_month == $i) { $val_may = "1-".$nominal; } else { $val_may = "4-0"; }
						}	
						if($i == 12) { 	
							if($current_month == $i) { $val_june = "1-".$nominal; } else { $val_june = "4-0"; }
						}	
						
					}
					
					//How many checkbox has been checked????
					$num_siswa		= count($src_siswa);
					$catering_name	= mysql_real_escape_string($src_name);
					
					//Let's do it, as much as the number of checked checkbox
					for($i=0; $i < $num_siswa; $i++) {
									
						$cur_no_sisda	= $src_siswa[$i]; 
						
						//let's check whether the student has a row of tunggakan with type catering in table tunggakan, if so, lets the system  just update that row.
						//if it he/she doesnt have, insert a new row for them with jwnis_tunggakan = catering
						$src_check_edu_year		= "select distinct id from tunggakan where periode = '$tahun' and no_sisda = '$cur_no_sisda' and jenis_tunggakan = 'catering'";
						$query_check_edu_year	= mysqli_query($mysql_connect, $src_check_edu_year) or die(mysql_error());
						$num_check_edu_year		= mysql_num_rows($query_check_edu_year);
						
						if($num_check_edu_year != 0) {
							
							$src_add_catering	= "update siswa_finance set catering = '$catering_name' where no_sisda = '$cur_no_sisda' and periode = '$tahun'";
							$query_add_catering	= mysqli_query($mysql_connect, $src_add_catering) or die(mysql_error());
								
							if($query_add_catering) {
								
								$src_catering_tunggakan	= 
								
									"
									update tunggakan set 
									jul_cataj	= '$val_july',
									aug_cataj	= '$val_august',
									sep_cataj	= '$val_september',
									oct_cataj	= '$val_september',
									nov_cataj	= '$val_november',
									dec_cataj	= '$val_december',
									jan_cataj	= '$val_january',
									feb_cataj	= '$val_february',
									mar_cataj	= '$val_march',
									apr_cataj	= '$val_april',
									may_cataj	= '$val_may',
									jun_cataj	= '$val_june'
									
									where no_sisda = '$cur_no_sisda' and periode = '$tahun' and jenis_tunggakan = 'catering'
									";
									
								$query_catering_tunggakan	= mysqli_query($mysql_connect, $src_catering_tunggakan) or die(mysql_error());
								
								if($query_catering_tunggakan) {
									
									$catering_succeed 	= true;
									$redirect_icon		= "images/icon_true.png";
									$activity			= "Daftarkan catering catering";
									$redirect_text		= "Data catering didaftarkan";
									
								} else { 
								
									$catering_succeed 	= true;
									$redirect_icon		= "images/icon_false.png";
									$activity			= "Daftarkan catering catering";
									$redirect_text		= "Query_catering ke table tunggakan tidak berhasil. silakan Hubungi Administrator";
									
								}
							
							} else { 
							
								$catering_succeed 	= true;
								$redirect_icon		= "images/icon_false.png";
								$activity			= "Daftarkan catering catering";
								$redirect_text		= "Update tabel siswa_finance tidak dapat dilakukan. Hubungi administrator";
								
							}	
							
						} else {
						
							$src_add_catering	= "update siswa_finance set catering = '$catering_name' where no_sisda = '$cur_no_sisda' and periode = '$tahun'";
							$query_add_catering	= mysqli_query($mysql_connect, $src_add_catering) or die(mysql_error());
								
							if($query_add_catering) {
						
								$src_catering_tunggakan	= 
								
									"
									insert into tunggakan
									(
										no_sisda,
										periode,
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
										'$cur_no_sisda',
										'$tahun',
										'catering',
										'$val_july',
										'$val_august',
										'$val_september',
										'$val_september',
										'$val_november',
										'$val_december',
										'$val_january',
										'$val_february',
										'$val_march',
										'$val_april',
										'$val_may',
										'$val_june'
									)
									";
								$query_catering_tunggakan = mysqli_query($mysql_connect, $src_catering_tunggakan) or die(mysql_error());
								
								if($query_catering_tunggakan) {
										
									$catering_succeed 	= true;
									$redirect_icon		= "images/icon_true.png";
									$activity			= "Daftarkan catering catering";
									$redirect_text		= "Data catering didaftarkan";
								} else { 
								
									$catering_succeed 	= true;
									$redirect_icon		= "images/icon_false.png";
									$activity			= "Query ke tabel tunggakan";
									$redirect_text		= "Query_catering ke table tunggakan tidak berhasil. Silakan Hubungi Administrator";
									
								}
								
							} else { 
							
								$catering_succeed 	= true;
								$redirect_icon		= "images/icon_false.png";
								$activity			= "Update table siswa_finance";
								$redirect_text		= "Update tabel siswa_finance tidak dapat dilakukan. Hubungi administrator";
							
							}
						}			
					} 
				} else { 
				
					$catering_succeed 	= true;
					$redirect_icon		= "images/icon_false.png";
					$activity			= "Pendaftaran catering siswa";
					$redirect_text		= "Bulan $bulan_enc untuk tahun $tahun_enc sudah terlewat1, tidak dapat diproses untuk menentukan bulan catering";
					//echo "Bulan $bulan_enc untuk tahun $tahun_enc sudah terlewat, tidak dapat diproses untuk menentkan bulan catering<br><button onclick='window.history.go(-1)'>Kembali</button>";  
					
				}
			} else { 
			
				$catering_succeed 	= true;
				$redirect_icon		= "images/icon_false.png";
				$activity			= "Pendaftaran catering siswa";
				$redirect_text		= "Bulan $bulan_enc untuk tahun $tahun_enc sudah terlewat2, tidak dapat diproses untuk menentukan bulan catering";
				//echo "Tahun yang anda pilih untuk catering sudah terlewat, tidak dapat diproses<br><button onclick='window.history.go(-1)'>Kembali</button>";  
			}
							
		} else { 
		
			$catering_succeed 	= true;
			$redirect_icon		= "images/icon_false.png";
			$activity			= "Pendaftaran catering siswa";
			$redirect_text		= "variable bulan atau tahun atau pemberi layanan catering atau nama siswa tidak diketahui. Hubungi administrator";
			//echo "variable bulan atau tahun atau pemberi layanan catering atau nama siswa tidak diketahui. Hubungi administrator"; 
			
		}
		
	///////////////////////////////////////////////	
	/////// delete the catering ///////////////////
	///////////////////////////////////////////////
	} else if($berhenti_catering == "Berhenti Catering") {
	
		$src_siswa	= !empty($_POST["pilih"]) ? $_POST["pilih"] : "";
		$bulan		= !empty($_POST["the_month"]) ? $_POST["the_month"] : "";
		$tahun		= !empty($_POST["edu_year"]) ? $_POST["edu_year"] : "";		
		
		if($src_siswa != "" && $bulan != "" && $tahun != "") {
	
			if($bulan == 1) 	{ $bulan_catering = "jan_cataj = '0-0'"; }
			if($bulan == 2) 	{ $bulan_catering = "feb_cataj = '0-0'"; }
			if($bulan == 3) 	{ $bulan_catering = "mar_cataj = '0-0'"; }
			if($bulan == 4) 	{ $bulan_catering = "apr_cataj = '0-0'"; }
			if($bulan == 5) 	{ $bulan_catering = "may_cataj = '0-0'"; }
			if($bulan == 6) 	{ $bulan_catering = "jun_cataj = '0-0'"; }
			if($bulan == 7) 	{ $bulan_catering = "jul_cataj = '0-0'"; }
			if($bulan == 8) 	{ $bulan_catering = "aug_cataj = '0-0'"; }
			if($bulan == 9) 	{ $bulan_catering = "sep_cataj = '0-0'"; }
			if($bulan == 10) 	{ $bulan_catering = "oct_cataj = '0-0'"; }
			if($bulan == 11) 	{ $bulan_catering = "nov_cataj = '0-0'"; }
			if($bulan == 12) 	{ $bulan_catering = "dec_cataj = '0-0'"; }
			
			$cur_month_catering	= substr($bulan_catering,0,9);	
			
			//How many checkbox has been checked????
			$num_siswa		= count($src_siswa);
			
			//$catering_name	= mysql_real_escape_string($src_name);	
					
			//Let's do it, as much as the number of checked checkbox
			for($i=0; $i < $num_siswa; $i++) {
				
				$cur_no_sisda	= $src_siswa[$i];
				
				///////////////////////////////////////////////////////////////////////////////////////////
				///// Dont let the admin delete nominal of a month catering if 
				///// (2-*********) it has an arrear 
				///// (4-*********) no arrear
				///// (5-*********) (6-**********) the arrear has been paid
				///////////////////////////////////////////////////////////////////////////////////////////
				$check_arrear_catering	= "select substring($cur_month_catering,1,1) as coba from tunggakan where no_sisda = '$cur_no_sisda' and periode = '$tahun' and jenis_tunggakan = 'catering'";
				$query_arrear_catering	= mysqli_query($mysql_connect, $check_arrear_catering) or die(mysql_error());
				$row_arrear_catering	= mysql_fetch_array($query_arrear_catering);	
				
				echo "<h1>".$cur_month_catering."</h1>";
				echo "<h1>".$row_arrear_catering["coba"]."</h1>";
				//example: aug_cataj (when jenis_tunggakan = catering) the value is 1-350000, it means student has arrear of catering Rp 350.000,- for august, it cannot be deleted
				//Because this data will be used for menu tagihan
				//Below is data history, hast to be kept
				//example: jul_cataj (in jenis_tunggakan = catering) the value is 2-175000, it means the student has paid his/her catering payment for july without arrear, it can't be deleted also 
				//example: sep_cataj (in jenis_tunggakan = catering) the value is 3-225000, it means the student has paid his/her catering payment for september with arrear, it cant be deleted also 
				if($row_arrear_catering["coba"] != 2 && $row_arrear_catering["coba"] != 4 && $row_arrear_catering["coba"] != 5 && $row_arrear_catering["coba"] != 6) {			
				
					//(catering = '') means that the student not a member of catering anymore
					$src_erase_catering		= "update siswa_finance set catering = '' where no_sisda = '$cur_no_sisda' and periode = '$tahun'";
					$query_erase_catering	= mysqli_query($mysql_connect, $src_erase_catering) or die(mysql_error());
					
					if($query_erase_catering) {
					
						$src_erase_catering_tunggakan	= "update tunggakan set $bulan_catering where no_sisda = '$cur_no_sisda' and periode = '$tahun' and jenis_tunggakan = 'catering'";
						$query_erase_catering_tunggakan	= mysqli_query($mysql_connect, $src_erase_catering_tunggakan) or die(mysql_error());
						//echo $src_erase_catering_tunggakan;
						if($query_erase_catering_tunggakan) {
						
							$catering_succeed 	= true;
							$redirect_icon		= "images/icon_true.png";
							$activity			= "delete catering";
							$redirect_text		= "Data catering sudah dihapus";
							
						} else { 
						
							$catering_succeed 	= true;
							$redirect_icon		= "images/icon_false.png";
							$activity			= "Delete catering";
							$redirect_text		= "Penghapusan data catering di table tunggakan tidak dapat dilakukan. Silakan hubungi administrator (1)";
							
						}
				
					} else { 
					
						$catering_succeed 	= true;
						$redirect_icon		= "images/icon_false.png";
						$activity			= "Delete catering";
						$redirect_text		= "Penghapusan data catering pada table siswa_finance tidak dapat dilakukan. Hubungi administrator (2)"; 
						
					}
				} else {
				
					$catering_succeed 	= true;
					$redirect_icon		= "images/icon_false.png";
					$activity			= "Delete catering";
					$redirect_text		= "Data catering tidak dapat dihapus, siswa memiliki tunggakan untuk bulan tersebut (3)";
				
				}
			}	
			
		} else {
		
			$catering_succeed 	= true;
			$redirect_icon		= "images/icon_false.png";
			$activity			= "Pendaftaran catering siswa";
			$redirect_text		= "variable bulan atau tahun atau nama siswa belum diisi. Silakan diulangi";
		
		}
	
	} else { 
	
		$catering_succeed 	= true;
		$redirect_icon		= "images/icon_false.png";
		$activity			= "Pendaftaran catering siswa";
		$redirect_text		= "Perintah tidak jelas, daftarkan catering atau hapus. Silakan hubungi admin";
		//echo "Perintah tidak jelas, daftarkan catering atau hapus. Silakan hubungi admin"; 
		
	}
	
	if($catering_succeed) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= $activity;
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$act_note	= $redirect_text;
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		$redirect_path	= "";
		$redirect_icon	= $redirect_icon;
		$redirect_url	= $back_url;
		$redirect_text	= $redirect_text;
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Catering / Antar jemput tidak dapat ditambahkan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>