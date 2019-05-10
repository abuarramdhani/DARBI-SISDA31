<?PHP
//Why we have to make this page????
//Because with this application (sisda v3), foundation (Darbi) wants to know how many arrear happen everytime
//A payment will called as an arrear, if they has been delayed at least 1 month
//So we must check every month if there is a new arrear
//There are 2 variables that we need to define
//They are current month and current education year.

//file $cur_month and $edu_year are taken from file define_month_spp.php
$expl_year		= explode(" ",$edu_year);
$last_edu_year 	= $expl_year[0]-(1)." - ".$expl_year[2]-(1);



if($cur_month == "july") 		{ $month_checked = "june"; $year_checked = $last_edu_year; }
if($cur_month == "august") 		{ $month_checked = "july"; $year_checked = $edu_year; }
if($cur_month == "september") 	{ $month_checked = "august"; $year_checked = $edu_year; }
if($cur_month == "october") 	{ $month_checked = "september"; $year_checked = $edu_year; }
if($cur_month == "november") 	{ $month_checked = "october"; $year_checked = $edu_year; }
if($cur_month == "december") 	{ $month_checked = "november"; $year_checked = $edu_year; }
if($cur_month == "january") 	{ $month_checked = "december"; $year_checked = $edu_year; }
if($cur_month == "february") 	{ $month_checked = "january"; $year_checked = $edu_year; }
if($cur_month == "march") 		{ $month_checked = "february"; $year_checked = $edu_year; }
if($cur_month == "april") 		{ $month_checked = "march"; $year_checked = $edu_year; }
if($cur_month == "may") 		{ $month_checked = "april"; $year_checked = $edu_year; }
if($cur_month == "june") 		{ $month_checked = "may"; $year_checked = $edu_year; }

//Update jumlah_item_tunggakan in two conditions. (to 1)
//update jumlah_item_tunggakan (SPP) to 1 for a record where value of last month of this record is 1
//update jumlah_item_tunggakan (pengembangan) to 1 for a record where value nominal tunggakan is not null (0).
$src_month_checked_to_1		= "update tunggakan set jumlah_item_tunggakan = '1' where (jumlah_item_tunggakan = '0' and $month_checked = '1' and periode = '$year_checked' and jenis_tunggakan = 'spp') or (nominal_tunggakan != '0' and jenis_tunggakan = 'pengembangan')";
$query_month_checked_to_1	= mysqli_query($mysql_connect, $src_month_checked_to_1) or die(mysql_error());

//Update jumlah_item_tunggakan in two conditions. (to 2)
//update jumlah_item_tunggakan (SPP) to 0 for a record where value of last month of this record is 2
//update jumlah_item_tunggakan (pengembangan) to 0 for a record where value nominal tunggakan is zero (0).
$src_month_checked_to_2		= "update tunggakan set jumlah_item_tunggakan = '0' where (jumlah_item_tunggakan = '1' and $month_checked = '2' and periode = '$year_checked' and jenis_tunggakan = 'spp') or (nominal_tunggakan = '0' and jenis_tunggakan = 'pengembangan')";
$query_month_checked_to_2	= mysqli_query($mysql_connect, $src_month_checked_to_2) or die(mysql_error());
?>