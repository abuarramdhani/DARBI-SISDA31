<?PHP
/*
include_once("sisda-config.php");

$src_get_sd 	= "select nama_siswa,no_sisda,kat_status_anak,elearning,ks,tingkat from siswa_finance where jenjang = 'sd' and periode = '2015 - 2016' and ks != '10000'";
$query_get_sd 	= mysqli_query($mysql_connect, $src_get_sd) or die(mysql_error());

$i = 0;
while($get_sd = mysql_fetch_array($query_get_sd)) {

	$i++;
	$no_sisda 	= $get_sd["no_sisda"];
	$status		= $get_sd["kat_status_anak"];
	$tingkat	= $get_sd["tingkat"];
	$nama		= $get_sd["nama_siswa"];
	$elearning	= $get_sd["elearning"];
	$ks			= $get_sd["ks"];
	
	//if($status == "umum") { $nom_elearning = '10000'; } 
	//else if ($status == "anak_guru") { $nom_elearning = '5000'; } 
	
	$nom_ks 		= "10000";
	$nom_elearning	= "5000";
	
	echo $i." --- ".$no_sisda." --- ".$tingkat." --- ".$status." --- ".$ks." ---".$nama."<br>";
	
	//$src_update_sd = "update siswa_finance set elearning = '$nom_elearning', ks = '$nom_ks' where no_sisda = '$no_sisda' and jenjang = 'sd' and periode = '2015 - 2016' and elearning = '10000' and ks = '5000'";
	//$query_update_sd = mysqli_query($mysql_connect, $src_update_sd) or die(mysql_error());
	
	echo $src_update_sd."<br><br>";

}
*/
?>