<?PHP
include_once("sisda-config.php");

$src_get_data = "select no_sisda,spp,ict,elearning,ks from siswa_finance where tingkat = '1' and spp = '0' and ict = '0' and elearning = '0' and ks = '0'";
$query_get_data	= mysqli_query($mysql_connect, $src_get_data) or die(mysql_error());
 echo mysql_num_rows($query_get_data);
$i=0;
 echo "ok";
while($get_data	= mysql_fetch_array($query_get_data	)) {

	$i++;
	echo "no $i".$get_data["no_sisda"]."<br>";

}
?>