<?PHP
/*
include_once("../sisda-config.php");

$now_periode = "2014 - 2015";

$src_check_cat 		= "select no_sisda from siswa_finance where periode = '$now_periode' and catering = ''";
$query_check_cat 	= mysqli_query($mysql_connect, $src_check_cat) or die(mysql_error());

while($row_check_cat = mysql_fetch_array($query_check_cat)) {

	$no_sisda_cat = $row_check_cat["no_sisda"];
	
	$src_delete_cat		= "delete from tunggakan where no_sisda = '$no_sisda_cat' and jenis_tunggakan = 'catering' and periode = '$now_periode'";
	$query_delete_cat	= mysqli_query($mysql_connect, $src_delete_cat) or die(mysql_error());

}

$src_check_aj 		= "select no_sisda from siswa_finance where periode = '$now_periode' and antar_jemput = ''";
$query_check_aj 	= mysqli_query($mysql_connect, $src_check_aj) or die(mysql_error());

while($row_check_aj = mysql_fetch_array($query_check_aj)) {

	$no_sisda_aj = $row_check_aj["no_sisda"];
	
	$src_delete_aj		= "delete from tunggakan where no_sisda = '$no_sisda_aj' and jenis_tunggakan = 'antar_jemput' and periode = '$now_periode'";
	$query_delete_aj	= mysqli_query($mysql_connect, $src_delete_aj) or die(mysql_error());

}

/*
$src_fix_error_antar_jemput	= "update tunggakan set dec_cataj = '4-0', jan_cataj = '1-x' where dec_cataj = '2-0' and jenis_tunggakan = 'antar_jemput' and periode = '$now_periode'";
$query_fix_error_antar_jemput = mysqli_query($mysql_connect, $src_fix_error_antar_jemput) or die(mysql_error());
*/
?>