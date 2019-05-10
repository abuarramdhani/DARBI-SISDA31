<?PHP
/*
include_once("sisda-config.php");

$src_get_smp 	= "select nama_siswa,no_sisda,ks,elearning,tingkat from siswa_finance where jenjang = 'smp' and periode = '2015 - 2016' and ks != '15000'";
$query_get_smp 	= mysqli_query($mysql_connect, $src_get_smp) or die(mysql_error());

$i = 0;
while($get_smp = mysql_fetch_array($query_get_smp)) {

	$i++;
	$no_sisda 	= $get_smp["no_sisda"];
	$ks			= $get_smp["ks"];
	$tingkat	= $get_smp["tingkat"];
	$nama		= $get_smp["nama_siswa"];
	$elearning	= $get_smp["elearning"];
	
	echo $i." --- ".$no_sisda." --- ".$tingkat." --- ".$ks." --- ".$elearning." --- ".$nama."<br>";
	
	$src_update_smp = "update siswa_finance set ks = '15000' where no_sisda = '$no_sisda' and periode = '2015 - 2016' and ks != '15000'";
	$query_update_smp = mysqli_query($mysql_connect, $src_update_smp) or die(mysql_error());
	
	echo $src_update_smp."<br><br>";

}
*/
?>