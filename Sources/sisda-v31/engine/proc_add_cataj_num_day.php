<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	$num_catering		= !empty($_POST["catering_num_day"]) ? mysql_real_escape_string($_POST["catering_num_day"]) : "";
	$num_antar_jemput	= !empty($_POST["antar_jemput_num_day"]) ? mysql_real_escape_string($_POST["antar_jemput_num_day"]) : "";
	$periode			= !empty($_POST["periode"]) ? mysql_real_escape_string($_POST["periode"]) : "";
	$month				= !empty($_POST["month"]) ? mysql_real_escape_string($_POST["month"]) : "";
	
	//avoid inserting duplication month and year in the same row
	//go & check it.....
	$src_check_year_month	= "select id from cataj_num_day where periode = '$periode' and month = '$month'";
	$query_check_year_month	= mysqli_query($mysql_connect, $src_check_year_month) or die(mysql_error());
	$num_check_year_month	= mysql_num_rows($query_check_year_month);
	
	//We will do the process if month and period is not exit yet only
	if($num_check_year_month == 0) {
	
		//here we go again baby,....
		$src_insert_cataj	= "insert into cataj_num_day (periode,month,catering,antar_jemput) values ('$periode','$month','$num_catering','$num_antar_jemput')";
		$query_insert_cataj	= mysqli_query($mysql_connect, $src_insert_cataj) or die ("There is an error with mysql: ".mysql_error());
		
		if($query_insert_cataj) {
		
			//Ok let's update table tunggakan, as the we've got
			if($month == 1) { $arrear_month = "jan_cataj"; }
			if($month == 2) { $arrear_month = "feb_cataj"; }
			if($month == 3) { $arrear_month = "mar_cataj"; }
			if($month == 4) { $arrear_month = "apr_cataj"; }
			if($month == 5) { $arrear_month = "may_cataj"; }
			if($month == 6) { $arrear_month = "jun_cataj"; }
			if($month == 7) { $arrear_month = "jul_cataj"; }
			if($month == 8) { $arrear_month = "aug_cataj"; }
			if($month == 9) { $arrear_month = "sep_cataj"; }
			if($month == 10) { $arrear_month = "oct_cataj"; }
			if($month == 11) { $arrear_month = "nov_cataj"; }
			if($month == 12) { $arrear_month = "dec_cataj"; }
			
			//Select all nominal and catering name from table cataj where it values are similar with what table siswa_finance has
			$src_get_catering	= "select siswa_finance.catering,siswa_finance.no_sisda,cataj.name,cataj.nominal from siswa_finance, cataj where siswa_finance.catering = cataj.name and siswa_finance.periode = '$periode'";
			$query_get_catering	= mysqli_query($mysql_connect, $src_get_catering) or die(mysql_error());
			$num_get_catering	= mysql_num_rows($query_get_catering);
			//echo "<h1> cetering=".$src_get_catering."</h1>";
			//echo "<h1>  num_rows".$num_get_catering."</h1>";
			//we will do the process while at least there is 1 record found
			if($num_get_catering != 0) {
			
				//We repeate it as much as the amount we've got from the query above
				while($row_get_catering	= mysql_fetch_array($query_get_catering)) {
				
					//Yea... we got the id sisda
					$no_sisda_catering	= $row_get_catering["no_sisda"];
					//echo "<h1>  num_rows".$no_sisda_catering."</h1>";
					//if the day number of catering is 0, it means no catering for that month
					if($num_catering == 0) { 
						
						//so in table tunggakan we have to keep value x.
						$nominal_catering 	= "x";
						
						//if day amount of catering is zero (0), it's mean no claim of catering for that month
						//4 = no claim
						$status_arrear_catering		= "4-";
						
					} else { 
					
						//if the day number of catering is not 0, we have to multiplicate it with the nominal 
						$nominal_catering 			= $row_get_catering["nominal"]*$num_catering;
						$status_arrear_catering		= "substring($arrear_month,1,2)";
						
					}
					//echo $status_arrear_catering	;
					
					//and then now we update table tunggakan with the values above. 
					//one thing you have to know that we dont need to change 2 first digit (0-,1-,2-,3-,4-,5-) from existing values, because it will be updated in transaction precess
					//We only let our system to update table tunggakan if the first digit of field month_cataj (jul_cataj,jun_cataj,aug_cataj....ect) equal with 0 or 1
					//So we only accept 2,3,4 and 5.
					//Why..???
					//Please check this pattern
					// 0: month of transaction has not come yet                 
				 	// 1: month of transaction has come, but the payment hasnt been done
					// 2: Month of payment has passed 1 month, but the payment hasnt been done (arrear)                  
					// 3: Nominal with special case                      
					// 4: By defaultm no arrear for this month                            
   					// 5. Has been paid on time
					// 6. Has been paid late
					$src_update_tunggakan	= "
												update tunggakan set $arrear_month = concat($status_arrear_catering,$nominal_catering) 
												where 
												(
													no_sisda = '$no_sisda_catering' and 
													periode = '$periode' and 
													jenis_tunggakan = 'catering' and
													
													(
													substring($arrear_month,1,1) != '3' or
													substring($arrear_month,1,1) != '4' or
													substring($arrear_month,1,1) != '5' or
													substring($arrear_month,1,1) != '6'
													) 
												)
												";
					$query_update_tunggakan	= mysqli_query($mysql_connect, $src_update_tunggakan) or die(mysql_error());
					
					//echo "<br><br>".$src_update_tunggakan."<br><br>";
					
				}				
			}
			//note: see comments above 
			$src_get_antar_jemput	= "select siswa_finance.antar_jemput,siswa_finance.no_sisda,cataj.name,cataj.nominal from siswa_finance, cataj where siswa_finance.antar_jemput = cataj.name and siswa_finance.periode = '$periode'";
			$query_get_antar_jemput	= mysqli_query($mysql_connect, $src_get_antar_jemput) or die(mysql_error());
			$num_get_antar_jemput	= mysql_num_rows($query_get_antar_jemput);
			
			if($num_get_antar_jemput != 0) {
			
				while($row_get_antar_jemput	= mysql_fetch_array($query_get_antar_jemput)) {
				
					$no_sisda_antar_jemput	= $row_get_antar_jemput["no_sisda"];
					
					if($num_antar_jemput == 0) { 
					
						$nominal_antar_jemput 			= "x"; 
						$status_arrear__antar_jemput	= "4-";
					
					} else if($num_antar_jemput == 1) { 
					
						$nominal_antar_jemput 		= $row_get_antar_jemput["nominal"]*0.6; 
						$status_arrear_antar_jemput	= "substring($arrear_month,1,2)";
						
					} else if($num_antar_jemput == 2) { 
					
						$nominal_antar_jemput = $row_get_antar_jemput["nominal"]; 
						$status_arrear_antar_jemput	= "substring($arrear_month,1,2)";
					
					}
					
					$src_update_antar_jemput	= "update tunggakan set $arrear_month = concat($status_arrear_antar_jemput,$nominal_antar_jemput) where no_sisda = '$no_sisda_antar_jemput' and periode = '$periode' and substring($arrear_month,3,1) = 'x' and jenis_tunggakan = 'antar_jemput'";
					$query_update_antar_jemput	= mysqli_query($mysql_connect, $src_update_antar_jemput) or die(mysql_error());
					
				}				
			}
		}
		
		//this is provided for $act_note
		$redirect_text		= "Jumlah hari catering dan antar jemput untuk bulan $month, $periode, sudah didaftarkan";
		
	} else {
	
		//hehe, month in that year already exist,.... go back and use button edit... :)
		$query_insert_cataj = true;
		$redirect_path		= "";
		$redirect_icon		= "images/icon_false.png";
		$redirect_url		= "mainpage.php?pl=cataj_num_day";
		$redirect_text		= "Terjadi duplikasi bulan dan tahun yang sama, proses tidak dilanjutkan";
		
		
	}
	
	if($query_insert_cataj) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add day number of catering / antar jemput";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$act_note	= $redirect_text;
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
		
		/*$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=cataj_num_day";
		$redirect_text	= "Jumlah hari catering dan antar jemput untuk bulan $month, $periode, sudah didaftarkan";*/
		
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "mainpage.php?pl=cataj_num_day";
		$redirect_text	= "Jumlah hari catering dan antar jemput untuk bulan $month, $periode, sudah didaftarkan";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Catering / Antar jemput ditambahkan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }

//you know buddy, i'm not too clever to talk. that's why i wrote a thousand papers to say something that similar with a negative word: no
?>