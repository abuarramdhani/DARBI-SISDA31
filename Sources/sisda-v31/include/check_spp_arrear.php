<?PHP
/////////////////////////////////////////////////////////////
/////This file will be included in engine/proc_login.php/////
/////This file cannot stand alone////////////////////////////
/////////////////////////////////////////////////////////////

/*
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////																			   ////
////   WE HAVE TO ENSURE THAT OUR PRODUCTION SYSTEM ALWAYS RUNNING ALL TIME        ////
////   BECAUSE, IF IT IS BEING LATE (SYSTEM DOWN) AT LEAST 1 MONTH,                ////
////   ALL ARREARS THAT SHOULD BE CHECKED IN THAT MONTH, HAS TO BE DONE MANUALLY   ////
////   OUR PRODUCTION SYSTEM WILL WORK FOR CURRENT MONTH ONLY, it's too bad hehehe  ////
////																			   ////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
*/

//Why we have to make this page????
//Because with this application (sisda v3), foundation (Darbi) wants to know how many arrear happen everytime
//A payment will be called as an arrear, if they has been delayed at least 1 month
//So we must check every month if there is a new arrear
//There are 2 variables that we need to define
//They are current month and current education year.

//Variable $cur_month and $edu_year are taken from file define_month_spp.php
//This file will be included together below file define_month_spp.php in file proc_login.php

//$edu_year taken from include/check_date_error.php
$expl_year		= explode(" - ",$edu_year);
$last_edu_year 	= ($expl_year[0]-1)." - ".($expl_year[1]-1);

//echo "<h1>".$edu_year."</h1>";
$num_cur_month	= date("n");

if($cur_month == "july") 		{ $cur_month_cataj = "jul_cataj"; $last_month_checked = "june"; 		$last_month_cataj_checked = "jun_cataj"; }
if($cur_month == "august") 		{ $cur_month_cataj = "aug_cataj"; $last_month_checked = "july"; 		$last_month_cataj_checked = "jul_cataj"; }
if($cur_month == "september") 	{ $cur_month_cataj = "sep_cataj"; $last_month_checked = "august"; 		$last_month_cataj_checked = "aug_cataj"; }
if($cur_month == "october") 	{ $cur_month_cataj = "oct_cataj"; $last_month_checked = "september"; 	$last_month_cataj_checked = "sep_cataj"; }
if($cur_month == "november") 	{ $cur_month_cataj = "nov_cataj"; $last_month_checked = "october"; 		$last_month_cataj_checked = "oct_cataj"; }
if($cur_month == "december") 	{ $cur_month_cataj = "dec_cataj"; $last_month_checked = "november"; 	$last_month_cataj_checked = "nov_cataj"; }
if($cur_month == "january") 	{ $cur_month_cataj = "jan_cataj"; $last_month_checked = "december"; 	$last_month_cataj_checked = "dec_cataj"; }
if($cur_month == "february") 	{ $cur_month_cataj = "feb_cataj"; $last_month_checked = "january"; 		$last_month_cataj_checked = "jan_cataj"; }
if($cur_month == "march") 		{ $cur_month_cataj = "mar_cataj"; $last_month_checked = "february"; 	$last_month_cataj_checked = "feb_cataj"; }
if($cur_month == "april") 		{ $cur_month_cataj = "apr_cataj"; $last_month_checked = "march"; 		$last_month_cataj_checked = "mar_cataj"; }
if($cur_month == "may") 		{ $cur_month_cataj = "may_cataj"; $last_month_checked = "april"; 		$last_month_cataj_checked = "apr_cataj"; }
if($cur_month == "june") 		{ $cur_month_cataj = "jun_cataj"; $last_month_checked = "may"; 			$last_month_cataj_checked = "may_cataj"; }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////      0-***********: month of transaction hasnt come               	                                          /////			
/////      1-***********: month of trancaction have come, but the payment hasnt done    				              /////
/////      2-***********: month of transaceton has passed 1 month, and the payment hasn't done (defined as an arrear)	  /////
/////      3-***********: nominal of payment with special case                     			                          /////
/////      4-***********: no arrear                       				                                              /////
/////      5-***********: paid on time                           			                                      /////
/////      6-***********: paid late 																			  /////
/////	   7-***********: paid before the month of payment come  												  /////
/////      1-x: (cataj) does not apply						                                                   		  /////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if($cur_month == "july") {

	////////////////////////////////////////////////////
	////////////// JULY CURRENT SPP ONLY ///////////////
	////////////////////////////////////////////////////
	
	/*for current month condition, cataj cannot be defined*/
	
	$src_cur_july	= "select no_sisda, july, jul_cataj, jenis_tunggakan from tunggakan where (jenis_tunggakan = 'spp' or jenis_tunggakan = 'catering' or jenis_tunggakan = 'antar_jemput') and periode = '$edu_year'";	
	$query_cur_july	= mysqli_query($mysql_connect, $src_cur_july) or die(mysql_error());

	if(mysql_num_rows($query_cur_july) != 0) {
	
		while($row_cur_july = mysql_fetch_array($query_cur_july)) {
		
			if($row_cur_july["jenis_tunggakan"] == "spp") {
		
				if(substr($row_cur_july["july"],0,1) == 0) {
				
					$no_sisda_cur_july = $row_cur_july["no_sisda"];
					
					$src_update_cur_july 	= "update tunggakan set july = concat('1-',substring(july,3)) where jenis_tunggakan = 'spp' and no_sisda = '$no_sisda_cur_july' and periode = '$edu_year'";
					$query_update_cur_july 	= mysqli_query($mysql_connect, $src_update_cur_july) or die(mysql_error());
				
				}//hoeeeeeeeeeeyyyyy cuba rubah last harussss didefinisikan sebelum cur...... aterus ada terfikir untuk membatasi proses check spp arrear ini hanya 1 kali saja. gimana caranya.
				
			} else {
			
				$no_sisda_cur_july 		= $row_cur_july["no_sisda"];
				$exp_cataj_cur_july 	= explode("-",$row_cur_july["jul_cataj"]);
				//bisa catering & bisa antar jemput
				$jetung_cataj_cur_july	= $row_cur_july["jenis_tunggakan"];
				
				if($row_cur_july["jul_cataj"] == "y-0") {
				
					$val_cataj_cur_july	= "y-0";
					
				} else if($row_cur_july["jul_cataj"] == "0-0") {
					
					$src_cataj_num_day_cur_july		= "select catering from cataj_num_day where periode = '$edu_year' and month = '$num_cur_month'";
					$query_cataj_num_day_cur_july	= mysqli_query($mysql_connect, $src_cataj_num_day_cur_july) or die(mysqli_query($mysql_connect, ));
					$row_cataj_num_day_cur_july		= mysql_fetch_array($query_cataj_num_day_cur_july);
					
					if(!empty($row_cataj_num_day_cur_july["catering"])) {
						
						$val_cataj_cur_july	= "1-".$row_cataj_num_day_cur_july["catering"];
					
					} else {
				
						$val_cataj_cur_july	= "1-x";
						
					} 
						
				} else {
				
						$val_cataj_cur_july = $row_cur_july["jul_cataj"];
				
				}
				
				$src_update_cur_july	= "update tunggakan set jul_cataj = '$val_cataj_cur_july' where jenis_tunggakan = '$jetung_cataj_cur_july' and no_sisda = '$no_sisda_cur_july' and periode = '$edu_year'";
				$query_update_cur_july	= mysqli_query($mysql_connect, $src_update_cur_july) or die(mysql_error());
				
			}
		}
	}
	
	//////////////////////////////////////////////////////
	////////////// JULY LAST MONTH SPP CATAJ /////////////
	//////////////////////////////////////////////////////
	$src_last_july		= "select no_sisda, june, jun_cataj, jenis_tunggakan from tunggakan where (jenis_tunggakan = 'spp' or jenis_tunggakan = 'catering' or jenis_tunggakan = 'antar_jemput') and periode = '$last_edu_year'";	
	$query_last_july	= mysqli_query($mysql_connect, $src_last_july) or die(mysql_error());
	
	if(mysql_num_rows($query_last_july) != 0) {
	
		while($row_last_july = mysql_fetch_array($query_last_july)) {
		
			if($row_last_july["jenis_tunggakan"] == "spp") {
			
				if(substr($row_last_july["june"],0,1) == 1 || substr($row_last_july["june"],0,1) == 3) {
				
					$no_sisda_last_july = $row_last_july["no_sisda"];
					
					$src_update_last_july	= "update tunggakan set june = concat('2-',substring(june,3)) where jenis_tunggakan = 'spp' and no_sisda = '$no_sisda_last_july' and periode = '$last_edu_year'";
					$query_update_last_july	= mysqli_query($mysql_connect, $src_update_last_july) or die(mysql_error());
				}
			
			} else {
			
				if(substr($row_last_july["jun_cataj"],0,1) == 1) {
				
					$no_sisda_last_july 		= $row_last_july["no_sisda"];					
					$exp_cataj_last_july 		= explode("-",$row_last_july["jun_cataj"]);
					//bisa catering & bisa antar jemput
					$jetung_cataj_last_non_july	= $row_last_july["jenis_tunggakan"];
					
					//jika pada bulan sebelumnya nilai cataj (catering atau antar jemput) adalah tetap 1-x, tidak berubah menjadi 1-350000 misalnya.
					//Berarti pada bulan tersebut dianggap Darbi tidak menyelenggarakan catering, sebab tidak ada nilai yang ditagihkan
					//Maka pada bulan sebelumnya tersebut siswa dibebaskan dari tagihan cataj. Dan dianggap tidak ikut cataj.
					//Maka ia mendapat prefix 4.
					//Nah, konsekwensinya adalah katakanlah bulan kemarin adalah agustus dengan  nilai 4-x, maka value untuk bulan sekarang (sepetember) adalah tetap 4-x
					//4-x dianggap siswa tersebut telahmengundurkan diri dari cari cataj. dan ini berlaku untuk seluruh siswa.
					//Maka pada bulann september, seluruh siswa yang ingin ikut catering harus didaftarkan kembali seperti di awal.
					//okeeehhhh?????
					
					if($exp_cataj_last_july[1] == "x") {
			
						$last_val_cataj_last_july	= "4-x";
						
					} else {
						
						$last_val_cataj_last_july	= "2-".$exp_cataj_last_july[1];
						
					}
					
					$src_update_last_july	= "update tunggakan set jun_cataj = '$last_val_cataj_last_july' where jenis_tunggakan = '$jetung_cataj_last_non_july' and no_sisda = '$no_sisda_last_july' and periode = '$last_edu_year'";
					$query_update_last_july	= mysqli_query($mysql_connect, $src_update_last_july) or die(mysql_error());
				}
			}
		}
	}
	
} else {

	//////////////////////////////////////////////////////
	///////////// NON JULY CURRENT MONTH SPP  ////////////
	//////////////////////////////////////////////////////
	
	/*cataj will be defined by page page/cataj.php monthly. The page has it own rule*/
	$src_cur_non_july	= "select no_sisda, $cur_month,$cur_month_cataj, jenis_tunggakan from tunggakan where (jenis_tunggakan = 'spp' or jenis_tunggakan = 'catering' or jenis_tunggakan = 'antar_jemput') and periode = '$edu_year'";
	$query_cur_non_july	= mysqli_query($mysql_connect, $src_cur_non_july) or die(mysql_error());
	
	//echo $src_cur_non_july."<br><br>";
	
	if(mysqli_num_rows($query_cur_non_july) != 0 ) {
	
		while($row_cur_non_july = mysql_fetch_array($query_cur_non_july)) {
		
			if($row_cur_non_july["jenis_tunggakan"] == 'spp') {
	
				if(substr($row_cur_non_july[$cur_month],0,1) == 0) {
						
					$no_sisda_cur_non_july = $row_cur_non_july["no_sisda"];
					
					$src_update_cur_non_july	= "update tunggakan set $cur_month = concat('1-',substring($cur_month,3)) where jenis_tunggakan = 'spp' and no_sisda = '$no_sisda_cur_non_july' and periode = '$edu_year'";
					//echo $src_update_cur_non_july;
					$query_update_cur_non_july	= mysqli_query($mysql_connect, $src_update_cur_non_july) or die(mysql_error());
				}
				
			} else {
			
				$no_sisda_cur_non_july 		= $row_cur_non_july["no_sisda"];
				$exp_cataj_cur_non_july 	= explode("-",$row_cur_non_july[$cur_month_cataj]);
				//bisa catering & bisa antar jemput
				$jetung_cataj_cur_non_july	= $row_cur_non_july["jenis_tunggakan"];
				
				//echo "cur_con=". $row_cur_non_july[$cur_month_cataj]."<br><br>";
				
				//Y shows that this student not joint cataj anymore
				if($row_cur_non_july[$cur_month_cataj] == "1-x") {
				
					$val_cataj_cur_non_july	= "1-x";
					
				} else if($row_cur_non_july[$cur_month_cataj] == "y-0") {
				
					$val_cataj_cur_non_july	= "y-0";
					
				} else if($row_cur_non_july[$cur_month_cataj] == "0-0") {
				
					$src_val_cataj_cur_non_july		= "select nominal,type from (cataj left join siswa_finance on cataj.name = (siswa_finance.catering or siswa_finance.antar_jemput)) where no_sisda = '$no_sisda_cur_non_july' and periode = '$edu_year'";
					$query_val_cataj_cur_non_july	= mysqli_query($mysql_connect, $src_val_cataj_cur_non_july) or die(mysql_error());
					
					while($row_val_cataj_cur_non_july = mysql_fetch_array($query_val_cataj_cur_non_july)) {
					
						if($row_val_cataj_cur_non_july["type"] == "Catering") {
						
							$row_val_cataj_cur_non_july_catering = $row_val_cataj_cur_non_july["nominal"];
						
						} else if($row_val_cataj_cur_non_july["type"] == "Antar Jemput") {
						
							$row_val_cataj_cur_non_july_antar_jemput = $row_val_cataj_cur_non_july["nominal"];
						
						}
					
					}
				
					$src_cataj_num_day_cur_non_july		= "select catering,antar_jemput from cataj_num_day where periode = '$edu_year' and month = '$num_cur_month'";
					$query_cataj_num_day_cur_non_july	= mysqli_query($mysql_connect, $src_cataj_num_day_cur_non_july) or die(mysqli_query($mysql_connect, ));
					$row_cataj_num_day_cur_non_july		= mysql_fetch_array($query_cataj_num_day_cur_non_july);
					
					if(!empty($row_cataj_num_day_cur_non_july["catering"])) {
						
						$nom_total_catering_cur_non_july	= $row_val_cataj_cur_non_july_catering * $row_cataj_num_day_cur_non_july["catering"];
						$val_cataj_cur_non_july				= "1-".$nom_total_catering_cur_non_july;
						
						//echo $val_cataj_cur_non_july;
					
					} else {
				
						$val_cataj_cur_non_july	= "1-x";
						
					} 
					
					if(!empty($row_cataj_num_day_cur_non_july["antar_jemput"])) {
						
						if($row_cataj_num_day_cur_non_july["antar_jemput"] == 2) {
						
							$nom_total_antar_jemput_cur_non_july	= $row_val_cataj_cur_non_july_catering * $row_cataj_num_day_cur_non_july["catering"];
						
						}
						
						if($row_cataj_num_day_cur_non_july["antar_jemput"] == 1) {
						
							$nom_total_antar_jemput_cur_non_july	= ($row_val_cataj_cur_non_july_catering * $row_cataj_num_day_cur_non_july["catering"]) * 0.6;
						
						}
						
						$val_cataj_cur_non_july			= "1-".$nom_total_antar_jemput_cur_non_july;
						
						//echo $val_cataj_cur_non_july;
					
					} else {
				
						$val_cataj_cur_non_july	= "1-x";
						
					} 
					
				} else {
				
					$val_cataj_cur_non_july = $row_cur_non_july[$cur_month_cataj];
				
				}
				
				$src_update_cur_non_july	= "update tunggakan set $cur_month_cataj = '$val_cataj_cur_non_july' where jenis_tunggakan = '$jetung_cataj_cur_non_july' and no_sisda = '$no_sisda_cur_non_july' and periode = '$edu_year'";
				$query_update_cur_non_july	= mysqli_query($mysql_connect, $src_update_cur_non_july) or die(mysql_error());
			
			}
		}
	}
	
	//////////////////////////////////////////////////
	///////////// NON JULY LAST MONTH SPP  ///////////
	//////////////////////////////////////////////////
	$src_last_non_july		= "select no_sisda, $last_month_checked, $last_month_cataj_checked, jenis_tunggakan from tunggakan where (jenis_tunggakan = 'spp' or jenis_tunggakan = 'catering' or jenis_tunggakan = 'antar_jemput') and periode = '$edu_year'";
	$query_last_non_july	= mysqli_query($mysql_connect, $src_last_non_july) or die(mysql_error());
	
	if(mysql_num_rows($query_last_non_july) != 0 ) {
	
		while($row_last_non_july = mysql_fetch_array($query_last_non_july)) {
		
			if($row_last_non_july["jenis_tunggakan"] == 'spp') {
			
				if(substr($row_last_non_july[$last_month_checked],0,1) == 1 || substr($row_last_non_july[$last_month_checked],0,1) == 3) {
				
					$no_sisda_last_non_july = $row_last_non_july["no_sisda"];
					
					$src_update_last_non_july	= "update tunggakan set $last_month_checked = concat('2-',substring($last_month_checked,3)) where jenis_tunggakan = 'spp' and no_sisda = '$no_sisda_last_non_july' and periode = '$edu_year'";
					$query_update_last_non_july	= mysqli_query($mysql_connect, $src_update_last_non_july) or die(mysql_error());				
				}
				 
			} else {
				
				if(substr($row_last_non_july[$last_month_cataj_checked],0,1) == 1 || substr($row_last_non_july[$last_month_cataj_checked],0,1) == 3) {
				
					$no_sisda_last_non_july 	= $row_last_non_july["no_sisda"];					
					$exp_cataj_last_non_july 	= explode("-",$row_last_non_july[$last_month_cataj_checked]);
					//bisa catering & bisa antar jemput
					$jetung_cataj_last_non_july	= $row_last_non_july["jenis_tunggakan"];
					//echo "<h1>sdfsdf=".$exp_cataj_last_non_july[1]."</h1>";
					/*
					OK INI DI CEK DULU NANTI KONDISINYA GIMANA, APAKAH BULAN YANG SUDAH LEWAT KLO DIA 1-X MAKA SETELAH LEWAT BULANNYA TETAP 1-X
					KLO YANG ADA VALUENYA DAH PASTI 1-350000 MAKA AKAN JADI 2-350000
					*/
					if($exp_cataj_last_non_july[1] == "x") {
			
						$last_val_cataj_last_non_july	= "4-x";
						
					} else {
						
						$last_val_cataj_last_non_july	= "2-".$exp_cataj_last_non_july[1];
						
					}
				
					$src_update_last_non_july	= "update tunggakan set $last_month_cataj_checked = '$last_val_cataj_last_non_july' where jenis_tunggakan = '$jetung_cataj_last_non_july' and no_sisda = '$no_sisda_last_non_july' and periode = '$edu_year'";
					$query_pdate_last_non_july	= mysqli_query($mysql_connect, $src_update_last_non_july) or die(mysql_error());
				}
			}
		}
	}
}

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
////////////////UPDATE STATUS TUNGGAKAN////////////////
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

//..........................WHY THESE ALL BEING MARKED? BECAUSE HAVE DONE IN engine/proc_add_transaction.php.............................................//
//.......................................................................................................................................................//

/*
---Untuk biaya masuk & daftar ulang---
Murid dikatakan menunggak jika nominal_tunggakan tidak sama dengan 0 (memiliki nilai)
Syarat status = 0 jika nominal_tunggakan = 0 (tidak tergantung kepada bulan)
Syarat status = 1 jika nominal_tunggakan != 0 (tidak tergantung kepada bulan)


---Untuk SPP & CATAJ---
Murid dikatakan menunggak pembayaran, terhitung dari status pembayaran bula yang lalu. 
Jadi kalau pada bulan berjalan (bulan sekarang) belum dilakukan pembayaran, maka itu belum dikategorikan sebagai tunggakan

Syarat status = 0 (tidak punya tunggakan), jika kewajiban pembayaran pada bulan sebelumnya sudah dibayarkan atau tidak memiliki kewajiban pembayaran pada bulan sebelumnya.
Didefinisikan dengan prefix 0,4,5,6,7 & x pada field bulan dan bulan_cataj (september dan sep_cataj)

Syarat status = 1 (memiliki tunggakan), jika pada bulan sebelumny ada kewajiban yang belum terbayarkan
Didefinisikan dengan prefix 2,3 dan 0 (karena untuk SPP dia bisa bulan di depan yang belum terbayarkan, misal mau bayar 1 tahun), pada field bulan (september, october)
Didefiniskan dengan prefix 2 & 3 pada bulan_cataj (sep_cataj dan oct_cataj)
*/


/*
$src_check_status_biaya_masuk_0		= "update tunggakan set status = '0' where jenis_tunggakan = 'biaya_masuk' 	and status = '1' and nominal_tunggakan = '0'";
$src_check_status_daftar_ulang_0	= "update tunggakan set status = '0' where jenis_tunggakan = 'daftar_ulang' and status = '1' and nominal_tunggakan = '0'";

if($cur_month == "july") {

	$src_check_status_spp_0				= "update tunggakan set status = '0' where jenis_tunggakan = 'spp' 			and status = '1' and (substring($last_month_checked,1,1) = '4' || substring($last_month_checked,1,1) = '5' || substring($last_month_checked,1,1) = '6' || substring($last_month_checked,1,1) = '7') and periode = '$last_edu_year'";
	$src_check_status_catering_0		= "update tunggakan set status = '0' where jenis_tunggakan = 'catering' 	and status = '1' and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_cataj_checked,1,1) = '5' || substring($last_month_cataj_checked,1,1) = '6'|| substring($last_month_cataj_checked,1,1) = '7') and periode = '$last_edu_year'";
	$src_check_status_antar_jemput_0	= "update tunggakan set status = '0' where jenis_tunggakan = 'antar_jemput' and status = '1' and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_cataj_checked,1,1) = '5' || substring($last_month_cataj_checked,1,1) = '6'|| substring($last_month_cataj_checked,1,1) = '7') and periode = '$last_edu_year'";

} else {

	$src_check_status_spp_0				= "update tunggakan set status = '0' where jenis_tunggakan = 'spp' 			and status = '1' and (substring($last_month_checked,1,1) = '4' || substring($last_month_checked,1,1) = '5' || substring($last_month_checked,1,1) = '6' || substring($last_month_checked,1,1) = '7') and periode = '$edu_year'";
	$src_check_status_catering_0		= "update tunggakan set status = '0' where jenis_tunggakan = 'catering' 	and status = '1' and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_cataj_checked,1,1) = '5' || substring($last_month_cataj_checked,1,1) = '6'|| substring($last_month_cataj_checked,1,1) = '7') and periode = '$edu_year'";
	$src_check_status_antar_jemput_0	= "update tunggakan set status = '0' where jenis_tunggakan = 'antar_jemput' and status = '1' and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_cataj_checked,1,1) = '5' || substring($last_month_cataj_checked,1,1) = '6'|| substring($last_month_cataj_checked,1,1) = '7') and periode = '$edu_year'";

}
///////////////////////////////////////////////////////

$src_check_status_biaya_masuk_1		= "update tunggakan set status = '1' where jenis_tunggakan = 'biaya_masuk' 	and (status = '0' || status = '2') and nominal_tunggakan != '0'";
$src_check_status_daftar_ulang_1	= "update tunggakan set status = '1' where jenis_tunggakan = 'daftar_ulang' and (status = '0' || status = '2') and nominal_tunggakan != '0'";

if($cur_month == "july") {

	$src_check_status_spp_1				= "update tunggakan set status = '1' where jenis_tunggakan = 'spp' 			and (status = '0' || status = '2') and (substring(june,1,1) = 2 || substring(june,1,1) = 3) and periode = '$last_edu_year'";
	$src_check_status_catering_1		= "update tunggakan set status = '1' where jenis_tunggakan = 'catering' 	and (status = '0' || status = '2') and (substring(jun_cataj,1,1) = 2 || substring(jun_cataj,1,1) = 3) and periode = '$last_edu_year'";
	$src_check_status_antar_jemput_1	= "update tunggakan set status = '1' where jenis_tunggakan = 'antar_jemput' and (status = '0' || status = '2') and (substring(jun_cataj,1,1) = 2 || substring(jun_cataj,1,1) = 3) and periode = '$last_edu_year'";

} else {

	$src_check_status_spp_1				= "update tunggakan set status = '1' where jenis_tunggakan = 'spp' 			and (status = '0' || status = '2') and (substring($last_month_checked,1,1) = '2' || substring($last_month_checked,1,1) = '3') and periode = '$edu_year'";
	$src_check_status_catering_1		= "update tunggakan set status = '1' where jenis_tunggakan = 'catering' 	and (status = '0' || status = '2') and (substring($last_month_cataj_checked,1,1) = '2' || substring($last_month_cataj_checked,1,1) = '3') and periode = '$edu_year'";
	$src_check_status_antar_jemput_1	= "update tunggakan set status = '1' where jenis_tunggakan = 'antar_jemput' and (status = '0' || status = '2') and (substring($last_month_cataj_checked,1,1) = '2' || substring($last_month_cataj_checked,1,1) = '3') and periode = '$edu_year'";
}

///////////////////////////////////////////////////////

$query_check_status_biaya_masuk_0	= mysqli_query($mysql_connect, $src_check_status_biaya_masuk_0) or die(mysql_error());
$query_check_status_daftar_ulang_0	= mysqli_query($mysql_connect, $src_check_status_daftar_ulang_0) or die(mysql_error());
$query_check_status_spp_0			= mysqli_query($mysql_connect, $src_check_status_spp_0) or die(mysql_error());
$query_check_status_catering_0		= mysqli_query($mysql_connect, $src_check_status_catering_0) or die(mysql_error());
$query_check_status_antar_jemput_0	= mysqli_query($mysql_connect, $src_check_status_antar_jemput_0) or die(mysql_error());

$query_check_status_biaya_masuk_1	= mysqli_query($mysql_connect, $src_check_status_biaya_masuk_1) or die(mysql_error());
$query_check_status_daftar_ulang_1	= mysqli_query($mysql_connect, $src_check_status_daftar_ulang_1) or die(mysql_error());
$query_check_status_spp_1			= mysqli_query($mysql_connect, $src_check_status_spp_1) or die(mysql_error());
$query_check_status_catering_1		= mysqli_query($mysql_connect, $src_check_status_catering_1) or die(mysql_error());
$query_check_status_daftar_ulang_1	= mysqli_query($mysql_connect, $src_check_status_antar_jemput_1) or die(mysql_error());
*/
?>