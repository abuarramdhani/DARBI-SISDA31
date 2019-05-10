<?PHP
/////////////////////////////////////////////////////////////
/////This file will be included in engine/proc_login.php/////
/////////////////////////////////////////////////////////////

/*
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
////																			   ////
////   WE HAVE TO ENSURE THAT OUR PRODUCTION SYSTEM ALWAYS RUNNING ALL TIME        ////
////   BECAUSE, IF IT IS BEING LATE (SYSTEM DOWN) AT LEAST 1 MONTH,                ////
////   ALL ARREARS THAT SHOULD BE CHECKED IN THAT MONTH, HAS TO BE DONE MANUALLY   ////
////   OUR PRODUCTION SYSTEM WILL WORK FOR CURRENT MONTH ONLY, it's to bad hehehe  ////
////																			   ////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
*/
//Why we have to make this page????
//Because with this application (sisda v3), foundation (Darbi) wants to know how many arrear happen everytime
//A payment will called as an arrear, if they has been delayed at least 1 month
//So we must check every month if there is a new arrear
//There are 2 variables that we need to define
//They are current month and current education year.

//file $cur_month and $edu_year are taken from file define_month_spp.php
//This file will be included together below file define_month_spp.php in file proc_login.php

//$edu_year taken from include/check_date_error.php
$expl_year		= explode(" - ",$edu_year);
$last_edu_year 	= ($expl_year[0]-1)." - ".($expl_year[1]-1);

if($cur_month == "july") 		{ $month_checked = "june"; 		$month_cataj_checked = "jun_cataj"; 	$year_checked = $last_edu_year; }
if($cur_month == "august") 		{ $month_checked = "july"; 		$month_cataj_checked = "jul_cataj";		$year_checked = $edu_year; }
if($cur_month == "september") 	{ $month_checked = "august"; 	$month_cataj_checked = "aug_cataj";		$year_checked = $edu_year; }
if($cur_month == "october") 	{ $month_checked = "september"; $month_cataj_checked = "sep_cataj";		$year_checked = $edu_year; }
if($cur_month == "november") 	{ $month_checked = "october"; 	$month_cataj_checked = "oct_cataj";		$year_checked = $edu_year; }
if($cur_month == "december") 	{ $month_checked = "november"; 	$month_cataj_checked = "nov_cataj";		$year_checked = $edu_year; }
if($cur_month == "january") 	{ $month_checked = "december"; 	$month_cataj_checked = "dec_cataj";		$year_checked = $edu_year; }
if($cur_month == "february") 	{ $month_checked = "january"; 	$month_cataj_checked = "jan_cataj";		$year_checked = $edu_year; }
if($cur_month == "march") 		{ $month_checked = "february"; 	$month_cataj_checked = "feb_cataj";		$year_checked = $edu_year; }
if($cur_month == "april") 		{ $month_checked = "march"; 	$month_cataj_checked = "mar_cataj";		$year_checked = $edu_year; }
if($cur_month == "may") 		{ $month_checked = "april"; 	$month_cataj_checked = "apr_cataj";		$year_checked = $edu_year; }
if($cur_month == "june") 		{ $month_checked = "may"; 		$month_cataj_checked = "may_cataj";		$year_checked = $edu_year; }

//Update jumlah_item_tunggakan in two conditions. (to 1)
//update jumlah_item_tunggakan (SPP) to 1 for a record where value of last month of this record is 1
//update jumlah_item_tunggakan (pengembangan) to 1 for a record where value nominal tunggakan is not null (0).
$src_month_checked_to_1		= "update tunggakan set status = '1' where 
								(jenis_tunggakan = 'spp' 			and status = '0' and substring($month_checked,1,1) = '1' and periode = '$year_checked') or 
								(jenis_tunggakan = 'biaya_masuk' 	and status = '0' and nominal_tunggakan != '0') or
								(jenis_tunggakan = 'daftar_ulang' 	and status = '0' and nominal_tunggakan != '0') or
								(jenis_tunggakan = 'catering' 		and status = '0' and substring($month_checked,1,1) = '1' and periode = '$year_checked') or
								(jenis_tunggakan = 'antar_jemput' 	and status = '0' and substring($month_checked,1,1) = '1' and periode = '$year_checked')
								";
$query_month_checked_to_1	= mysqli_query($mysql_connect, $src_month_checked_to_1) or die(mysql_error());

//Update jumlah_item_tunggakan in two conditions. (to 2)
//update jumlah_item_tunggakan (SPP) to 0 for a record where value of last month of this record is 2
//update jumlah_item_tunggakan (pengembangan) to 0 for a record where value nominal tunggakan is zero (0).
$src_month_checked_to_2		= "update tunggakan set status = '0' where 
								(jenis_tunggakan = 'spp' 			and status = '1' 	and ($month_checked = '4' || $month_checked = '5' || $month_checked = '6') and periode = '$year_checked') or 
								(jenis_tunggakan = 'biaya_masuk' 	and status = '1`' 	and nominal_tunggakan = '0') or
								(jenis_tunggakan = 'daftar_ulang' 	and status = '1' 	and nominal_tunggakan = '0') or
								(jenis_tunggakan = 'catering' 		and status = '1' 	and ($month_checked = '4' || $month_checked = '5' || $month_checked = '6') and periode = '$year_checked') or
								(jenis_tunggakan = 'antar_jemput' 	and status = '1' 	and ($month_checked = '4' || $month_checked = '5' || $month_checked = '6') and periode = '$year_checked')
								";
$query_month_checked_to_2	= mysqli_query($mysql_connect, $src_month_checked_to_2) or die(mysql_error());


//We need current value of each field to be sent next in updating process below
$src_get_tunggakan		= 	"select no_sisda, $month_checked, $month_cataj_checked, jenis_tunggakan from tunggakan where 
							((jenis_tunggakan = 'spp' and substring($month_checked,1,1) = '1') or
							(jenis_tunggakan = 'catering' and substring($month_cataj_checked,1,1) = '1') or
							(jenis_tunggakan = 'antar_jemput' and substring($month_cataj_checked,1,1) = '1')) 
							and periode = '$year_checked'							
							";

//Okey, let's play with current month
//Do something that supposed to be done with tunggakan in current month
							
//$src_get_tunggakan	= "select no_sisda, $month_checked, $month_cataj_checked, jenis_tunggakan from tunggakan where jenis_tunggakan = 'spp' and $month_checked = '1-35000' and periode ='$year_checked' ";							
$query_get_tunggakan	=	mysqli_query($mysql_connect, $src_get_tunggakan) or die(mysql_error()); 
//echo mysql_num_rows($query_get_tunggakan)."<br>";
//echo $src_get_tunggakan;

while($row_tunggakan = mysql_fetch_array($query_get_tunggakan)) {
	$cur_no_sisda			= $row_tunggakan["no_sisda"];
	$cur_jenis_tunggakan	= $row_tunggakan["jenis_tunggakan"];
	
	if($row_tunggakan["jenis_tunggakan"] == "spp") { 
	
		$src_value		= $row_tunggakan[$month_checked]; 		
		$field_checked 	= $month_checked; 
		
	} else { 
	
		$src_value		= $row_tunggakan[$month_cataj_checked];	
		$field_checked 	= $month_cataj_checked; 
	}
	
		
	//echo "dfsd=".$src_value."<br>";
	$src_value_exp	= explode("-",$src_value);
	
	if($row_tunggakan["jenis_tunggakan"] == "spp") {
	
		$cur_value	= "2-".$src_value_exp[1];
		
	} else {
	
		if($src_value_exp[1] == "x") {
		
			$cur_value	= "1-x";
			
		} else {
			
			$cur_value	= "2-".$src_value_exp[1];
			
		}
		
	}
	
	//Yo-yo-yo, barudak keur arindit ka TMB di aula badar, urang keur coding didieu sorangan... wioz coy..... (20140603)
	//So right now, let's check the arrears for last month
	//we got to change first digit from 1 to 2, (1-350000) to (2-350000) #####--- only if the 1st digit = 1 ---##### because it means, student hasn't paid their payment last month.... nunggak coy..		
	$src_new_value		= "update tunggakan set $field_checked = '$cur_value' where no_sisda = '$cur_no_sisda' and jenis_tunggakan = '$cur_jenis_tunggakan' and periode = '$year_checked'";
	$query_new_value	= mysqli_query($mysql_connect, $src_new_value) or die(mysql_error());
}

?>