<?php
/////////////////////////////////////////////////////////////
/////This file will be included in engine/proc_login.php/////
/////////////////////////////////////////////////////////////

//We need to know current month and year
$cur_month	= strtolower(date("F"));
$cur_year	= date("Y");

//We need this sequeantial value from 1 to 12, to avoid using of expired month and year many cases.
//month in number
$src_squ	= date("n");


//July is the first month in education year. so let's convert it
if($src_squ == 1) { $squ = 7; }
if($src_squ == 2) { $squ = 8; }
if($src_squ == 3) { $squ = 9; }
if($src_squ == 4) { $squ = 10; }
if($src_squ == 5) { $squ = 11; }
if($src_squ == 6) { $squ = 12; }
if($src_squ == 7) { $squ = 1; } //july
if($src_squ == 8) { $squ = 2; }
if($src_squ == 9) { $squ = 3; }
if($src_squ == 10) { $squ = 4; }
if($src_squ == 11) { $squ = 5; }
if($src_squ == 12) { $squ = 6; }

//we have to change the year into education year
//where the education year starts per july
//So from January until June, set the year as (current year minus 1) - current year
//From July until December, set the year as current year - (current year plus 1)
if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	
	$edu_year	= ($cur_year-1)." - ".$cur_year;
	$per_begin	= $cur_year-1;
} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
	$edu_year	= $cur_year." - ".($cur_year+1);
	$per_begin	= $cur_year;
}

//The idea is all years and months have to be recorded sequentially, i mean 2013, 2014, 2015 and july, august, september and so on.
//it would be an error, if the time zone experienced something like this:

// 1. It is set as next year, but more then 1 year:
//we have missing month and year, in our recored, 
//Because year is not changing sequentially and jump more then one year
//Like 2013, 2014, 2016, 2017 (2015 is missing) or 2013, 2017, 2018 (2014, 2015, 2016 are missing)
//and also on month
//july, August, october, November (september is missing) or July, december, january (september, october, november are missing)

// 2. It is set as past year or past month
// For Example, this system start from 2013, so we have to prevent using year below 2013 in any transaction in this system 
//2012, 2011, 2010, etc, MAY CAUSE ANY DATA TRANSACTION ERROR.
//The same thing goes to the month. Month cannot run backward 
//Let's say that now is April, so any transaction for next month can't using March, February, or another month before April.

//so if
//why it's suppposed to be like that..???
//Because our system is running based on realtime. and we will count every arrear each month.
//In case above, all errear for all month will be lost in 2015.... gaswat mannnn, bisa kolaps darbi
//Another case above is, all arrears on september will be lost.... ini juga gaswat

//Please look at table kontrol_bulan_spp (include/check_date_error.php)
//it CANNOT BE EMPTY,
//At least, it should be filled with data of the first time when this application starts
//it should be starting from july

//////////////////////////////////////
////periode 		= 2013 - 2014 ////
////periode_begin	= 2013        ////
////real_year		= 2013        ////
////bulan			= july        ////
////real_month	= 7           	  ////
//////////////////////////////////////


//check year error
$src_year_error		= "select max(real_year) as max_year from kontrol_bulan_spp";
$query_year_error	= mysqli_query($mysql_connect, $src_year_error) or die(mysql_error());
$row_year_error		= mysqli_fetch_array($query_year_error, MYSQLI_ASSOC);
$max_year			= $row_year_error["max_year"];
if($row_year_error) {

	//$src_month_error	= "select * from kontrol_bulan_spp where real_year = '2013' and real_month = (select max(real_month) from kontrol_bulan_spp)";
	$src_month_error	= "select max(real_month) as real_month from kontrol_bulan_spp where real_year = $max_year";
	$query_month_error	= mysqli_query($mysql_connect, $src_month_error) or die (mysql_error());
	$row_month_error	= mysqli_fetch_array($query_month_error, MYSQLI_ASSOC);
	$max_month			= $row_month_error["real_month"];
	if($max_month == 1) $bulan = "Januari"; 
	if($max_month == 2) $bulan = "Februari";
	if($max_month == 3) $bulan = "Maret";
	if($max_month == 4) $bulan = "April";
	if($max_month == 5) $bulan = "Mei";
	if($max_month == 6) $bulan = "Juni";
	if($max_month == 7) $bulan = "Juli";
	if($max_month == 8) $bulan = "Agustus";
	if($max_month == 9) $bulan = "September";
	if($max_month == 10) $bulan = "Oktober";
	if($max_month == 11) $bulan = "November";
	if($max_month == 12) $bulan = "Desember";
	
}

$is_year_error	= $cur_year - $max_year; // current year - max year in database
$is_month_error	= $src_squ - $max_month; // converter current month - max month (real_month) in database

if($max_month == 12) { // max month in database (12 = Desember)
	
	$allowed_change_month	= "Januari";
	$allowed_change_year 	= ($max_year+1);
	
	if($is_year_error == 0) { // it means current year = max year in database (year not change)
	
		if($src_squ == 12) { //current month (converted to education year), still not change
		
			$month_status	= "okay"; //no problem with current month
		
		} else { // we are talking about month 12 (june), if the year still the same, it's imposible the month change to 1 (july)
		
			$month_status	= "error"; //current month is not match
			$error_month	= "Bulan".$cur_month;
				
		}
		
		$year_status 	= "okay"; //current year = max year in database is ok if month = 12		
		
	} else if ($is_year_error == 1) { // has changed to the next year
	
		if($src_squ == 1) { // 1 = july
		
			$month_status	= "okay"; //no problem with current month
		
		} else {
		
			$month_status	= "error"; //current month is not match, yea because it is supposted to be 1 (july) after 12 (june)
			$error_month	= "Bulan".$cur_month;
		
		}
	
		$year_status 	= "okay"; //no problem with current year
	
	} else {//the change interval of year is cannot be accepted (-2, -1 , 2, 3, 4 an so on)

		$year_status 	= "error"; //current year is not match
		$error_year		= "Tahun ".$per_begin;
	
	}
	
} else {

	if($max_month == 1) $allowed_change_month	= "Februari";
	else if($max_month == 2) $allowed_change_month	= "Maret";
	else if($max_month == 3) $allowed_change_month	= "April";
	else if($max_month == 4) $allowed_change_month	= "Mei";
	else if($max_month == 5) $allowed_change_month	= "Juni";
	else if($max_month == 6) $allowed_change_month	= "Juli";
	else if($max_month == 7) $allowed_change_month	= "Agustus";
	else if($max_month == 8) $allowed_change_month	= "September";
	else if($max_month == 9) $allowed_change_month	= "Oktober";
	else if($max_month == 10) $allowed_change_month	= "November";
	else if($max_month == 11) $allowed_change_month	= "Desember";
	
	$allowed_change_year = $max_year;

	if($is_year_error == 0) {
	
		// 0 means month not change, and it's okay, enver mind
		// 1 means month has change to the next month sequentially, 1 to 2 or 2 to 3 or 3 to 4 and so on.
		if($is_month_error == 0 || $is_month_error == 1) { 
		
			$month_status	= "okay"; //no problem with current month
		
		} else { // month cannot change more than 1. (example: july to september and so on)
		
			$month_status	= "error"; //current month is not match, yea because it is supposted to be 1 (july) after 12 (june)
			$error_month	= "Bulan".$cur_month;
		
		}
		
		$year_status 	= "okay"; // yea, if month is not 12 (june), year may not change
		
		
	} else { // No-no-no, year may not change for this situation, because now is not june
	
		$year_status 	= "error";
		$error_type		= "Tahun ".$per_begin;
	
	}
	
}

if($year_status == "error" || $month_status	== "error") {

	$note_error = 	"
					<center id='text_title_page1'>
					<div style='background-color:#990000; font-family:Verdana;  width:100%; height:100%; top:50px;'>
					<table width='800' border='0'>
					<tr>
					<td height='100'></td>
					</tr>
					</table>
					<table width='850' heigth='600' border='0' bgcolor='#660000'>
					<tr height='100'>
					<td align='center' colspan='4'><img src='images/logo.png'></td>
					</tr>
					<tr>
					<td width='30'></td>
					<td><img src='images/error.png' width='175'></td>
					<td style='color:#FFFFFF;'>					
					Sisda mendeteksi kesalahan (perubahan) yang terjadi pada <i>setting date time</i> di server.<br> <br>
					<b>Waktu terakhir</b> yang tercatat di database sisda adalah,<b> $bulan $max_year</b><br>
					Waktu yang ter<i>setting</i> pada server saat ini adalah, <b>".ucfirst($cur_month)." $cur_year</b><br><br>
					Perubahan yang waktu yang diizinkan untuk periode berikutnya adalah <b>".$allowed_change_month." ".$allowed_change_year."</b><br>
					</td>
					<td width='30'></td>
					</tr>
					<tr>
					<td height='30'></td>
					</tr>
					</table>
					</div>
					</center>
					"; 
	
} 
?>