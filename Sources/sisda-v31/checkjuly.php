<?PHP
$username	= "root";
$password	= "";
$host		= "localhost";
$db			= "sisda31";

$mysql_connect		= mysql_connect($host,$username,$password);
$mysql_select_db	= mysql_select_db($db,$mysql_connect);

$src_get_sisfin = "select no_sisda,nama_siswa,tingkat,spp,ict,elearning,ks from siswa_finance where periode = '2016 - 2017'";
$query_get_sisfin = mysqli_query($mysql_connect, $src_get_sisfin) or die(mysql_error());

$i = "";

while($get_sisfin = mysql_fetch_array($query_get_sisfin)) {

	$no_sisda_check = $get_sisfin["no_sisda"];
	$nama_check		= $get_sisfin["nama_siswa"];
	$kelas_check	= $get_sisfin["tingkat"];
	$src_nominal_insert	= $get_sisfin["spp"] + $get_sisfin["ict"] + $get_sisfin["elearning"] + $get_sisfin["ks"];
	$nominal_july	= "2-".$src_nominal_insert;
	$nominal_august	= "1-".$src_nominal_insert;
	$nominal_rest	= "0-".$src_nominal_insert;
	
	
	$src_get_tunggakan = "select id from tunggakan where no_sisda = '$no_sisda_check' and periode = '2016 - 2017' and jenis_tunggakan = 'spp'";
	$query_get_tunggakan = mysqli_query($mysql_connect, $src_get_tunggakan) or die(mysql_error());	
	$num_get_tunggakan = mysql_num_rows($query_get_tunggakan);
	
	if($num_get_tunggakan == 0) {
	
		$i++;
			
		echo $i." - [".$no_sisda_check." / ".$kelas_check." / ".$nominal_insert."] - ".$nama_check."<br>";
		
		$src_insert_tunggakan = "insert into tunggakan 
									(
										no_sisda,
										periode,
										status,
										jenis_tunggakan,
										july,
										august,
										september,
										october,
										november,
										december,
										january,
										february,
										march,
										april,
										may,
										june
										
									)
									
									values
									
									(
										'$no_sisda_check',
										'2016 - 2017',
										'1',
										'spp',
										'$nominal_july',
										'$nominal_august',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest',
										'$nominal_rest'
									)
									
								";
		echo $src_insert_tunggakan."<br><br>";
		
		$query_insert_tunggakan = mysqli_query($mysql_connect, $src_insert_tunggakan) or die(mysql_error());;
	
	}
}
?>