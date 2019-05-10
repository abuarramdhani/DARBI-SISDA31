<?PHP
$username	= "root";
$password	= "";
$host		= "localhost";
$db			= "sisda31";

$mysql_connect		= mysql_connect($host,$username,$password);
$mysql_select_db	= mysql_select_db($db,$mysql_connect);


$src_get_siswa = "select no_sisda,kat_status_anak from siswa_finance where tingkat = '1' and periode = '2017 - 2018'";
$query_get_siswa = mysqli_query($mysql_connect, $src_get_siswa) or die(mysql_error());

while($get_siswa = mysql_fetch_array($query_get_siswa)) {

	$no_sisda = $get_siswa["no_sisda"];

	if($get_siswa["kat_status_anak"] == "umum") { $value_ks = "15000"; $value_ks_tung = "5000"; }
	else if($get_siswa["kat_status_anak"] == "anak guru") { $value_ks = "7500"; $value_ks_tung = "2500"; }

	$src_update_ks = "update siswa_finance set ks = '$value_ks' where no_sisda = '$no_sisda'";
	$query_update_ks = mysqli_query($mysql_connect, $src_update_ks) or die(mysql_error());
	
	if($query_update_ks) {
	
		$src_get_tung = "select * from tunggakan where no_sisda = '$no_sisda' and periode = '2017 - 2018' and jenis_tunggakan = 'spp'";
		$query_get_tung = mysqli_query($mysql_connect, $src_get_tung) or die(mysql_error());
		$get_tung = mysql_fetch_array($query_get_tung);
		
		$src_val_jul = explode("-",$get_tung["july"]);			$val_jul = ($src_val_jul[0])."-".(($src_val_jul[1]) + $value_ks_tung);
		$src_val_aug = explode("-",$get_tung["august"]);		$val_aug = ($src_val_aug[0])."-".(($src_val_aug[1]) + $value_ks_tung);
		$src_val_sep = explode("-",$get_tung["september"]);		$val_sep = ($src_val_sep[0])."-".(($src_val_sep[1]) + $value_ks_tung);
		$src_val_oct = explode("-",$get_tung["october"]);		$val_oct = ($src_val_oct[0])."-".(($src_val_oct[1]) + $value_ks_tung);
		$src_val_nov = explode("-",$get_tung["november"]);		$val_nov = ($src_val_nov[0])."-".(($src_val_nov[1]) + $value_ks_tung);
		$src_val_dec = explode("-",$get_tung["december"]);		$val_dec = ($src_val_dec[0])."-".(($src_val_dec[1]) + $value_ks_tung);
		$src_val_jan = explode("-",$get_tung["january"]);		$val_jan = ($src_val_jan[0])."-".(($src_val_jan[1]) + $value_ks_tung);
		$src_val_feb = explode("-",$get_tung["february"]);		$val_feb = ($src_val_feb[0])."-".(($src_val_feb[1]) + $value_ks_tung);
		$src_val_mar = explode("-",$get_tung["march"]);			$val_mar = ($src_val_mar[0])."-".(($src_val_mar[1]) + $value_ks_tung);
		$src_val_apr = explode("-",$get_tung["april"]);			$val_apr = ($src_val_apr[0])."-".(($src_val_apr[1]) + $value_ks_tung);
		$src_val_may = explode("-",$get_tung["may"]);			$val_may = ($src_val_may[0])."-".(($src_val_may[1]) + $value_ks_tung);
		$src_val_jun = explode("-",$get_tung["june"]);			$val_jun = ($src_val_jun[0])."-".(($src_val_jun[1]) + $value_ks_tung);
		
		$src_update_tung = "
								update tunggakan set
								july 		= '$val_jul',
								august 		= '$val_aug',
								september	= '$val_sep',
								october		= '$val_oct',
								november	= '$val_nov',
								december	= '$val_dec',
								january		= '$val_feb',
								february	= '$val_feb',
								march		= '$val_mar',
								april		= '$val_apr',
								may			= '$val_may',
								june		= '$val_jun'
								where
								no_sisda 	= '$no_sisda' and
								periode 	= '2017 - 2018' and
								jenis_tunggakan = 'spp'
								
							";
		$query_update_tung = mysqli_query($mysql_connect, $src_update_tung) or die(mysql_error());
		
		if($query_update_tung) { echo "okay"; }
	
	}
}
?>