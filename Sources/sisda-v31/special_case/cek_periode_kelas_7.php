<?PHP
/*
include("../sisda-config.php");

$src_get_sisfin 	= "select * from siswa_finance where periode = '2015 - 2016' and tingkat = '7'";
$query_get_sisfin	= mysqli_query($mysql_connect, $src_get_sisfin) or die(mysql_error());

while($get_sisfin = mysql_fetch_array($query_get_sisfin)) {

	$no_sisda_sisfin 	= $get_sisfin["no_sisda"];
	$nama_siswa			= $get_sisfin["nama_siswa"];
	
	$src_get_siswa 		= "select periode from siswa where no_sisda = '$no_sisda_sisfin'";
	$query_get_siswa 	= mysqli_query($mysql_connect, $src_get_siswa) or die(mysql_error());
	$get_siswa			= mysql_fetch_array($query_get_siswa);
	
	$periode = $get_siswa["periode"];
	
	$update_periode = "update siswa set periode = '2015 - 2016' where no_sisda = '$no_sisda_sisfin'";
	$query_periode = mysqli_query($mysql_connect, $update_periode) or die(mysql_error());
	
	echo $no_sisda_sisfin." | ".$periode." | ".$nama_siswa."<br>";

}
*/
?>