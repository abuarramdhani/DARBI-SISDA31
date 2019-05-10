<?PHP
/*
include_once("../sisda-config.php");

$src_cek_provider 	= "select jan_provider,no_sisda from tunggakan where jenis_tunggakan = 'antar_jemput' and jan_cataj = '1-1520000'";
$query_cek_provider = mysqli_query($mysql_connect, $src_cek_provider) or die(mysql_error($src_cek_provider));

//echo mysql_num_rows($query_cek_provider)."<br>";

while($cek_provider = mysql_fetch_array($query_cek_provider)) {

	$taken_provider 	= $cek_provider["jan_provider"];
	$no_sisda			= $cek_provider["no_sisda"];
	$exp_taken_provider	= explode("-",$taken_provider);
	
	$name	= $exp_taken_provider[0]; //echo $name;
	$opsi	= $exp_taken_provider[1]; //echo $opsi."<br>";

	$src_get_value_provider 	= "select nominal from  cataj where name = '$name' and opsi = '$opsi'";
	$query_get_value_provider 	= mysqli_query($mysql_connect, $src_get_value_provider) or die(mysql_error());
	$get_value_provider			= mysql_fetch_array($query_get_value_provider);

	$value_provider		= $get_value_provider["nominal"];
	$mix_value_provider = "1-".$value_provider;
	
	$src_update_jan_provider 	= "update tunggakan set jan_cataj = '$mix_value_provider' where jenis_tunggakan = 'antar_jemput' and no_sisda = '$no_sisda' and jan_cataj = '1-1520000'";
	$query_update_jan_provider	= mysqli_query($mysql_connect, $src_update_jan_provider) or die(mysql_error());
	//echo $src_update_jan_provider."<br><br>";
}
*/
?>