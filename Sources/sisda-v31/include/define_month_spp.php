<?PHP
/////////////////////////////////////////////////////////////
/////This file will be included in :                    /////
/////Engine/proc_login.php								/////
/////Page/Transaction.php								/////
/////////////////////////////////////////////////////////////

//Read this carefully.....this is really important (kata yang baca: "setiap ada komen pasti important, bosen dah....")
//Heheheh, let this be....

//please look at table "tunggakan" on database.
//we have 12 fields called month (starting from juli (current year) until juni (next year))
//At the first time all of them are valued with null.
//And then when the current month is coming (for example march, 2012 - 2013), all of data in field "march" will be changed to 1.
//The meaning is, the SPP payment for march 2012 - 2013 is starting.
//When a student do the payment for march 2012 - 2013, field march for this student in table tunggakan will be changed to 2.
//The meaning is, his/her arrears for march 2012 - 2013 already deleted from table "tunggakan".

// so, we ahve 7 conditions:
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////      0: month of transaction have not come               	                                               /////			
/////      1: month of trancaction have come, but the payment hasnt done    				                   /////
/////      2: month of transaceton has pass 1 month, and the payment hasn't done (defined as an arrear)	       /////
/////      3: nominal of payment with special case                     			                               /////
/////      4: no arrear                       				                                                   /////
/////      5: have paid on time                           			                                           /////
/////      6. have paid late 																				   /////
/////	   7: have paid before the month of payment come                                                       /////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
$per_begin	
$edu_year	
$squ

are taken from file include/check_date_error.php i
*/

//we have another table named "kontrol_bulan_spp"
//This table will help to define whether the spp month already starting or not yet
//Why this table is needed???
//Because we have to reduce the database load. if the page directly check the current month in table tunggakan, it will make the database word harder.
//So if the page checks the table kontrol_bulan_spp first, it will be easier for database, because we will have a short data in kontrol_bulan_spp only.
$src_check_cur_month	= "select bulan from kontrol_bulan_spp where periode = '$edu_year' and bulan = '$cur_month'";
$query_check_cur_month	= mysqli_query($mysql_connect, $src_check_cur_month) or die("terjadi kesalahan(1):".mysql_error());
$num_check_cur_month	= mysqli_num_rows($query_check_cur_month);




//if the result is null (0), it means the month hasn't been updated
//so make it
if($num_check_cur_month == 0) {

	$src_update_cur_month	= "insert into kontrol_bulan_spp (periode,periode_begin,bulan,real_month,real_year) values ('$edu_year','$per_begin','$cur_month','$src_squ','$cur_year')";
	$query_update_cur_month	= mysqli_query($mysql_connect, $src_update_cur_month) or die("terjadi kesalahan(2):".mysql_error());
	
	$run_check_spp_arrear = "go";
	
} else {

	$run_check_spp_arrear = "stop";

} 
//echo "<h1>cur_month: ".$cur_month."<br>periode: ".$edu_year."</h1>";

//$select_tunggakan	= mysqli_query($mysql_connect, "select * from tunggakan where $cur_month = '0' and periode = '$edu_year' and jenis_tunggakan = 'spp'") or die(mysql_error());
//$num_select_tunggakan	= mysql_num_rows($select_tunggakan);
//echo "<h1>jumlahnya: ".$num_select_tunggakan."</h1>";


//------------------- 
//we need to know if there is a data tunggakan with this condition in 'where' below:
//And it's mean the payment month is started.
//$src_check_month	= "update tunggakan set $cur_month = '1' where $cur_month = '0' and periode = '$edu_year' and jenis_tunggakan = 'spp'";
//$query_check_year	= mysqli_query($mysql_connect, $src_check_month) or die("terjadi kesalahan(3):".mysql_error());
//if($query_check_year) { echo "ok deh"; }
?>