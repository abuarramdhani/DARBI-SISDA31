<?PHP
/*
include_once("../sisda-config.php");

$now_periode = "2014 - 2015";

$src_get_cataj_siswa_finance 	= "select no_sisda,catering,antar_jemput from siswa_finance where periode = '$now_periode' and (catering != '' || antar_jemput != '')";
$mysql_get_cataj_siswa_finance = mysqli_query($mysql_connect, $src_get_cataj_siswa_finance) or die(mysql_error());

while($get_cataj_siswa_finance = mysql_fetch_array($mysql_get_cataj_siswa_finance)) {

	$no_sisda_update	= $get_cataj_siswa_finance["no_sisda"]; echo $no_sisda_update."<br>";
	$catering_update	= $get_cataj_siswa_finance["catering"]; echo $catering_update."<br>";
	$antar_jemput_update	= $get_cataj_siswa_finance["antar_jemput"]; echo $antar_jemput_update."<br>";
	
	if($catering_update != "") {
	
		$src_update_catering_provider 	= "update tunggakan set dec_provider = '$catering_update', jan_provider = '$catering_update' where no_sisda = '$no_sisda_update' and periode = '$now_periode' and jenis_tunggakan = 'catering'";
		$query_update_catering_provider = mysqli_query($mysql_connect, $src_update_catering_provider) or die (mysql_error());
	
	}
	
	if($antar_jemput_update != "") {
	
		$src_update_antar_jemput_provider 	= "update tunggakan set dec_provider = '$antar_jemput_update', jan_provider = '$antar_jemput_update' where no_sisda = '$no_sisda_update' and periode = '$now_periode' and jenis_tunggakan = 'antar_jemput'";
		$query_update_antar_jemput_provider = mysqli_query($mysql_connect, $src_update_antar_jemput_provider) or die (mysql_error());
		
	}
	
}

/*
$src_fix_error_antar_jemput	= "update tunggakan set dec_cataj = '4-0', jan_cataj = '1-x' where dec_cataj = '2-0' and jenis_tunggakan = 'antar_jemput' and periode = '$now_periode'";
$query_fix_error_antar_jemput = mysqli_query($mysql_connect, $src_fix_error_antar_jemput) or die(mysql_error());
*/
?>