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
//A payment will called as an arrear, if they has been delayed at least 1 month
//So we must check every month if there is a new arrear
//There are 2 variables that we need to define
//They are current month and current education year.

//file $cur_month and $edu_year are taken from file define_month_spp.php
//This file will be included together below file define_month_spp.php in file proc_login.php

//$edu_year taken from include/check_date_error.php
$expl_year		= explode(" - ",$edu_year);
$last_edu_year 	= ($expl_year[0]-1)." - ".($expl_year[1]-1);

echo "<h1>".$edu_year."</h1>";

if($cur_month == "july") 		{ $cur_month_cataj = "jul_cataj"; $last_month_checked = "june"; 		$last_month_cataj_checked = "jun_cataj";		$year_checked = $last_edu_year; }
if($cur_month == "august") 		{ $cur_month_cataj = "aug_cataj"; $last_month_checked = "july"; 		$last_month_cataj_checked = "jul_cataj";		$year_checked = $edu_year; }
if($cur_month == "september") 	{ $cur_month_cataj = "sep_cataj"; $last_month_checked = "august"; 		$last_month_cataj_checked = "aug_cataj";		$year_checked = $edu_year; }
if($cur_month == "october") 	{ $cur_month_cataj = "oct_cataj"; $last_month_checked = "september"; 	$last_month_cataj_checked = "sep_cataj";		$year_checked = $edu_year; }
if($cur_month == "november") 	{ $cur_month_cataj = "nov_cataj"; $last_month_checked = "october"; 		$last_month_cataj_checked = "oct_cataj";		$year_checked = $edu_year; }
if($cur_month == "december") 	{ $cur_month_cataj = "dec_cataj"; $last_month_checked = "november"; 	$last_month_cataj_checked = "nov_cataj";		$year_checked = $edu_year; }
if($cur_month == "january") 	{ $cur_month_cataj = "jan_cataj"; $last_month_checked = "december"; 	$last_month_cataj_checked = "dec_cataj";		$year_checked = $edu_year; }
if($cur_month == "february") 	{ $cur_month_cataj = "feb_cataj"; $last_month_checked = "january"; 		$last_month_cataj_checked = "jan_cataj";		$year_checked = $edu_year; }
if($cur_month == "march") 		{ $cur_month_cataj = "mar_cataj"; $last_month_checked = "february"; 	$last_month_cataj_checked = "feb_cataj";		$year_checked = $edu_year; }
if($cur_month == "april") 		{ $cur_month_cataj = "apr_cataj"; $last_month_checked = "march"; 		$last_month_cataj_checked = "mar_cataj";		$year_checked = $edu_year; }
if($cur_month == "may") 		{ $cur_month_cataj = "may_cataj"; $last_month_checked = "april"; 		$last_month_cataj_checked = "apr_cataj";		$year_checked = $edu_year; }
if($cur_month == "june") 		{ $cur_month_cataj = "jun_cataj"; $last_month_checked = "may"; 			$last_month_cataj_checked = "may_cataj";		$year_checked = $edu_year; }


//We need current value of each field to be sent next in updating process below
$src_get_tunggakan		= 	"select no_sisda, $last_month_checked, $last_month_cataj_checked, $cur_month, $cur_month_cataj, jenis_tunggakan from tunggakan where 
							((jenis_tunggakan = 'spp' and substring($last_month_checked,1,1) = '1') or
							(jenis_tunggakan = 'catering' and substring($last_month_cataj_checked,1,1) = '1') or
							(jenis_tunggakan = 'antar_jemput' and substring($last_month_cataj_checked,1,1) = '1')) 
							and periode = '$year_checked'							
							";
							
//$src_get_tunggakan	= "select no_sisda, $last_month_checked, $last_month_cataj_checked, jenis_tunggakan from tunggakan where jenis_tunggakan = 'spp' and $last_month_checked = '1-35000' and periode ='$year_checked' ";							
$query_get_tunggakan	=	mysqli_query($mysql_connect, $src_get_tunggakan) or die(mysql_error()); 
//echo "<h1>".mysql_num_rows($query_get_tunggakan)."</h1><br>";
//echo $src_get_tunggakan;
//echo "<br><br>".$src_get_tunggakan;
//echo "<h1>".mysql_num_rows($query_get_tunggakan)."</h1>";

if(mysql_num_rows($query_get_tunggakan) != 0) {

	//Do it as many as data we got
	while($row_tunggakan = mysql_fetch_array($query_get_tunggakan)) {
		
		$check_no_sisda			= $row_tunggakan["no_sisda"];
		$cur_jenis_tunggakan	= $row_tunggakan["jenis_tunggakan"];
		//echo "jetung:".$cur_jenis_tunggakan."<br>";
		
		//If you see above, you'll find that we have 3 conditions, where the data should be updated based on the changing of month.
		//1. SPP
		//2. Catering
		//3. Antar jemput
		
		//it's different to handling between SPP vs Catering and Antar jemput
		//use CATAJ for catering and antar jemput
		if($cur_jenis_tunggakan == "spp") { 
		
			$last_src_value		= $row_tunggakan[$last_month_checked]; 		
			$last_field_checked	= $last_month_checked; 
			$cur_src_value		= $row_tunggakan[$cur_month]; 		
			$cur_field_checked	= $cur_month; 
			
			//echo $last_src_value." -> dadas<br>";
			//echo $last_field_checked." -> dadas<br>";
			//echo $cur_src_value." -> dadas<br>";
			//echo $cur_field_checked." -> dadas<br>";
			
		} else { 
		
			$last_src_value		= $row_tunggakan[$last_month_cataj_checked];	
			$last_field_checked	= $last_month_cataj_checked; 
			$cur_src_value		= $row_tunggakan[$cur_month_cataj];	
			$cur_field_checked	= $cur_month_cataj; 
			
			//echo $last_src_value." -> dadas<br>";
			//echo $last_field_checked." -> dadas<br>";
			//echo $cur_src_value." -> dadas<br>";
			//echo $cur_field_checked." -> dadas<br>";
		}
		
			
		//echo "dfsd=".$src_value."<br>";
		$last_src_value_exp	= explode("-",$last_src_value);
		$cur_src_value_exp	= explode("-",$cur_src_value);
		
		if($cur_jenis_tunggakan == "spp") {
			
			$last_value	= "2-".$last_src_value_exp[1];
			$cur_value	= "1-".$cur_src_value_exp[1];
			
			//Yo-yo-yo, barudak keur arindit ka TMB di aula badar, urang keur coding didieu sorangan... wioz coy..... (20140603)
			//So right now, let's check the arrears for last month
			//we got to change first digit from 1 to 2, (1-350000) to (2-350000) #####--- only if the 1st digit = 1 ---##### because it means, student hasn't paid their payment last month.... nunggak coy..		
			//$src_new_value		= "update tunggakan set $last_field_checked = '$last_value' where no_sisda = '$check_no_sisda' and jenis_tunggakan = '$cur_jenis_tunggakan' and periode = '$year_checked'";
			
			$src_new_value_spp		= "update tunggakan set $last_month_checked = '$last_value', $cur_month = '$cur_value' where jenis_tunggakan = '$cur_jenis_tunggakan' and periode = '$year_checked' and no_sisda = '$check_no_sisda'";
			$query_new_value_spp	= mysqli_query($mysql_connect, $src_new_value_spp) or die(mysql_error());
			
			$nooo = "spp"; 
			//echo "spp";
			//echo $src_new_value_spp;
		} else {
			
			if($last_src_value_exp[1] == "x") {
			
				$last_value	= "1-x";
				
			} else {
				
				$last_value	= "2-".$last_src_value_exp[1];
				
			}
			
			if($cur_src_value_exp[1] == "x") {
			
				$cur_value	= "1-x";
				
			} else {
				
				$cur_value	= "1-".$last_src_value_exp[1];
				
			}
			
			$src_new_value_cataj	= "update tunggakan set $last_month_cataj_checked = '$last_value', $cur_month_cataj = '$cur_value' where jenis_tunggakan = '$cur_jenis_tunggakan' and periode = '$year_checked' and no_sisda = '$check_no_sisda'";
			$query_new_value_cataj	= mysqli_query($mysql_connect, $src_new_value_cataj) or die(mysql_error());
			
			$nooo = "spp"; 
			//echo "bukan spp";
			//echo $src_new_value_cataj;
		}
	}
}

if($cur_month == "july") {

	$src_get_tunggakan_data_baru = 	"select no_sisda, $cur_month, $cur_month_cataj, jenis_tunggakan from tunggakan where 
									(jenis_tunggakan = 'spp' or jenis_tunggakan = 'catering' or jenis_tunggakan = 'antar_jemput') 
									and periode = '$edu_year' and data_baru = '1'						
									";
	$query_get_tunggakan_data_baru	=	mysqli_query($mysql_connect, $src_get_tunggakan_data_baru) or die(mysql_error()); 
	echo "<h1>$src_get_tunggakan_data_baru</h1>";
	
	if(mysql_num_rows($query_get_tunggakan_data_baru) != 0) {		
		
		while($row_tunggakan_data_baru = mysql_fetch_array($query_get_tunggakan_data_baru)) {
	
			$check_no_sisda_data_baru		= $row_tunggakan_data_baru["no_sisda"];
			$cur_jenis_tunggakan_data_baru	= $row_tunggakan_data_baru["jenis_tunggakan"];
			
			if($cur_jenis_tunggakan_data_baru == "spp") { 			
				
				$cur_src_value_data_baru		= $row_tunggakan_data_baru[$cur_month]; 		
				$cur_field_checked_data_baru	= $cur_month; 
				
			} else { 
			
				$cur_src_value_data_baru		= $row_tunggakan_data_baru[$cur_month_cataj];	
				$cur_field_checked_data_baru	= $cur_month_cataj; 
				
			}
			
			$cur_src_value_exp_data_baru	= explode("-",$cur_src_value_data_baru);
			
			if($cur_jenis_tunggakan_data_baru == "spp") {			
			
				$cur_value_data_baru	= "1-".$cur_src_value_exp_data_baru[1];
				
				$src_new_value_spp_data_baru	= "update tunggakan set july = '$cur_value_data_baru', data_baru = '0' where jenis_tunggakan = 'spp' and periode = '$edu_year' and no_sisda = '$check_no_sisda_data_baru'";
				$query_new_value_spp_data_baru	= mysqli_query($mysql_connect, $src_new_value_spp_data_baru) or die(mysql_error());
				
				echo "<h1>hua".$src_new_value_spp_data_baru."</h1>";
				
			} else {
				
				if($cur_src_value_exp_data_baru[1] == "x") {
				
					$cur_value_data_baru	= "1-x";
					
				} else {
					
					$cur_value_data_baru	= "1-".$last_src_value_exp_data_baru[1];
					
				}
				
				$src_new_value_cataj_data_baru		= "update tunggakan set jul_cataj = '$cur_value', data_baru = '0' where jenis_tunggakan = '$cur_jenis_tunggakan_data_baru' and periode = '$edu_year' and no_sisda = '$check_no_sisda_data_baru'";
				$query_new_value_cataj_data_baru	= mysqli_query($mysql_connect, $src_new_value_cataj_data_baru) or die(mysql_error());
				
				echo "<h1>hiu".$src_new_value_cataj_data_baru."</h1>";
				
			}			
		}
	}
}
//echo $src_new_value_cataj;
/*
"UPDATE  tableName
SET     num_yes = CASE  WHEN $yes_no = 1 
                        THEN num_yes + 1
                        ELSE num_yes - 1
                    END,
        num_no = CASE   WHEN $yes_no = 1 
                        THEN num_no - 1
                        ELSE num_no + 1
                    END";
*/

/*
$src_month_checked_status	= 	"
									update tunggakan set status = case 
									when
									(
										(jenis_tunggakan = 'biaya_masuk' 			and status = '0' and nominal_tunggakan != '0' ) or
										(jenis_tunggakan = 'daftar_ulang' 			and status = '0' and nominal_tunggakan != '0') or
										(jenis_tunggakan = 'spp' 					and status = '0' and substring($last_month_checked,1,1) = '1' and periode = '$year_checked') or
										(jenis_tunggakan = 'catering' 				and status = '0' and substring($last_month_cataj_checked,1,1) = '1' and periode = '$year_checked') or
										(jenis_tunggakan = 'antar_jemput' 			and status = '0' and substring($last_month_cataj_checked,1,1) = '1' and periode = '$year_checked')
									)	
									then '1' 
									when
									(
										(jenis_tunggakan = 'biaya_masuk' 	and status = '1' 	and nominal_tunggakan = '0' )or
										(jenis_tunggakan = 'daftar_ulang' 	and status = '1' 	and nominal_tunggakan = '0') or
										(jenis_tunggakan = 'spp' 			and status = '1' 	and (substring($last_month_checked,1,1) = '4' || substring($last_month_checked,1,1) = '5' || substring($last_month_checked,1,1) = '6') and periode = '$year_checked') or
										(jenis_tunggakan = 'catering' 		and status = '1' 	and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_checked,1,1) = '5' || substring($last_month_checked,1,1) = '6') and periode = '$year_checked') or
										(jenis_tunggakan = 'antar_jemput' 	and status = '1' 	and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_checked,1,1) = '5' || substring($last_month_checked,1,1) = '6') and periode = '$year_checked') 
									)
									then '0'
									end 
									where periode = '$year_checked'
								";
								
$query_month_checked_status	= mysqli_query($mysql_connect, $src_month_checked_status) or die(mysql_error());
echo $src_month_checked_status;								
*/
/*
$src_check_status_biaya_masuk	= 	"
										update tunggakan set 
										status = case
										when jenis_tunggakan = 'biaya_masuk' and status = '0' and nominal_tunggakan != '0' then '1'
										end,
										status = case
										when jenis_tunggakan = 'biaya_masuk' and status = '1' and nominal_tunggakan = '0' then '0' 
										end
									";
									
$query_check_status_biaya_masuk	= mysqli_query($mysql_connect, $src_check_status_biaya_masuk) or die(mysql_error());
echo $src_check_status_biaya_masuk;	*/


$src_check_status_biaya_masuk_0		= "update tunggakan set status = '0' where jenis_tunggakan = 'biaya_masuk' 	and status = '1' and nominal_tunggakan = '0'";
$src_check_status_daftar_ulang_0	= "update tunggakan set status = '0' where jenis_tunggakan = 'daftar_ulang' and status = '1' and nominal_tunggakan = '0'";
$src_check_status_spp_0				= "update tunggakan set status = '0' where jenis_tunggakan = 'spp' 			and status = '1' and (substring($last_month_checked,1,1) = '4' || substring($last_month_checked,1,1) = '5' || substring($last_month_checked,1,1) = '6' || substring($last_month_checked,1,1) = '7') and periode = '$year_checked'";
$src_check_status_catering_0		= "update tunggakan set status = '0' where jenis_tunggakan = 'catering' 	and status = '1' and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_cataj_checked,1,1) = '5' || substring($last_month_cataj_checked,1,1) = '6'|| substring($last_month_cataj_checked,1,1) = '7') and periode = '$year_checked'";
$src_check_status_antar_jemput_0	= "update tunggakan set status = '0' where jenis_tunggakan = 'antar_jemput' and status = '1' and (substring($last_month_cataj_checked,1,1) = '4' || substring($last_month_cataj_checked,1,1) = '5' || substring($last_month_cataj_checked,1,1) = '6'|| substring($last_month_cataj_checked,1,1) = '7') and periode = '$year_checked'";

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

$src_check_status_biaya_masuk_1		= "update tunggakan set status = '1' where jenis_tunggakan = 'biaya_masuk' 	and (status = '0' || status = '2') and nominal_tunggakan != '0'";
$src_check_status_daftar_ulang_1	= "update tunggakan set status = '1' where jenis_tunggakan = 'daftar_ulang' and (status = '0' || status = '2') and nominal_tunggakan != '0'";

if($cur_month == "july") {
	$src_check_status_spp_1				= "update tunggakan set status = '1' where jenis_tunggakan = 'spp' 			and (status = '0' || status = '2') and periode = '$year_checked'";
	$src_check_status_catering_1		= "update tunggakan set status = '1' where jenis_tunggakan = 'catering' 	and (status = '0' || status = '2') and periode = '$year_checked'";
	$src_check_status_antar_jemput_1	= "update tunggakan set status = '1' where jenis_tunggakan = 'antar_jemput' and (status = '0' || status = '2') and periode = '$year_checked'";

} else {
	$src_check_status_spp_1				= "update tunggakan set status = '1' where jenis_tunggakan = 'spp' 			and (status = '0' || status = '2') and substring($last_month_checked,1,1) = '2' and periode = '$year_checked'";
	$src_check_status_catering_1		= "update tunggakan set status = '1' where jenis_tunggakan = 'catering' 	and (status = '0' || status = '2') and substring($last_month_cataj_checked,1,1) = '2' and periode = '$year_checked'";
	$src_check_status_antar_jemput_1	= "update tunggakan set status = '1' where jenis_tunggakan = 'antar_jemput' and (status = '0' || status = '2') and substring($last_month_cataj_checked,1,1) = '2' and periode = '$year_checked'";
}

/**/



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
/**/

//echo $src_check_status_spp_0;
/*
//Update jumlah_item_tunggakan in two conditions. (to 1)
//update jumlah_item_tunggakan (SPP) to 1 for a record where value of last month of this record is 1
//update jumlah_item_tunggakan (pengembangan) to 1 for a record where value nominal tunggakan is not null (0).
$src_month_checked_to_1		= "update tunggakan set status = '1' where 
								(jenis_tunggakan = 'spp' 			and status = '0' and substring($last_month_checked,1,1) = '1' and periode = '$year_checked') or 
								(jenis_tunggakan = 'biaya_masuk' 	and status = '0' and nominal_tunggakan != '0') or
								(jenis_tunggakan = 'daftar_ulang' 	and status = '0' and nominal_tunggakan != '0') or
								(jenis_tunggakan = 'catering' 		and status = '0' and substring($last_month_checked,1,1) = '1' and periode = '$year_checked') or
								(jenis_tunggakan = 'antar_jemput' 	and status = '0' and substring($last_month_checked,1,1) = '1' and periode = '$year_checked')
								";
$query_month_checked_to_1	= mysqli_query($mysql_connect, $src_month_checked_to_1) or die(mysql_error());

//Update jumlah_item_tunggakan in two conditions. (to 2)
//update jumlah_item_tunggakan (SPP) to 0 for a record where value of last month of this record is 2
//update jumlah_item_tunggakan (pengembangan) to 0 for a record where value nominal tunggakan is zero (0).
$src_month_checked_to_2		= "update tunggakan set status = '0' where 
								(jenis_tunggakan = 'spp' 			and status = '1' 	and ($last_month_checked = '4' || $last_month_checked = '5' || $last_month_checked = '6') and periode = '$year_checked') or 
								(jenis_tunggakan = 'biaya_masuk' 	and status = '1`' 	and nominal_tunggakan = '0') or
								(jenis_tunggakan = 'daftar_ulang' 	and status = '1' 	and nominal_tunggakan = '0') or
								(jenis_tunggakan = 'catering' 		and status = '1' 	and ($last_month_checked = '4' || $last_month_checked = '5' || $last_month_checked = '6') and periode = '$year_checked') or
								(jenis_tunggakan = 'antar_jemput' 	and status = '1' 	and ($last_month_checked = '4' || $last_month_checked = '5' || $last_month_checked = '6') and periode = '$year_checked')
								";
$query_month_checked_to_2	= mysqli_query($mysql_connect, $src_month_checked_to_2) or die(mysql_error());
*/


?>