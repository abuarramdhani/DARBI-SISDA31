<?PHP
/*
include_once("sisda-config.php");

$src_get_siswa 		= "select no_sisda,nama_siswa,spp,ict,ks,elearning from siswa_finance where tingkat = '7' and periode = '2015 - 2016'";
$query_get_siswa	= mysqli_query($mysql_connect, $src_get_siswa) or die(mysql_error());

$i = 0;
while($get_siswa = mysql_fetch_array($query_get_siswa)) {

	$i++;

	$no_sisda 		= $get_siswa["no_sisda"];
	$nama_siswa		= $get_siswa["nama_siswa"];
	$total_finance 	= $get_siswa["spp"]+$get_siswa["ict"]+$get_siswa["ks"]+$get_siswa["elearning"];
	
	$src_get_tung 	= "select * from tunggakan where no_sisda = '$no_sisda' and jenis_tunggakan = 'spp' and periode = '2015 - 2016'";
	$query_get_tung = mysqli_query($mysql_connect, $src_get_tung) or die(mysql_error());
	$get_tung		= mysql_fetch_array($query_get_tung);
	
	$july 		= $get_tung["july"];
	$august 	= $get_tung["august"];
	$september 	= $get_tung["september"];
	$october 	= $get_tung["october"];
	$november 	= $get_tung["november"];
	$december 	= $get_tung["december"];
	$january 	= $get_tung["january"];
	$february 	= $get_tung["february"];
	$march 		= $get_tung["march"];
	$april 		= $get_tung["april"];
	$may 		= $get_tung["may"];
	$june 		= $get_tung["june"];
	

	$july_no_prefix = substr($july,2);
	
	if($july_no_prefix == '615000' ) {	
	
		$pref_july 		= substr($july,0,1)."-".$total_finance; 		
		$pref_august 	= substr($august,0,1)."-".$total_finance; 		
		$pref_september = substr($september,0,1)."-".$total_finance; 	
		$pref_october 	= substr($october,0,1)."-".$total_finance; 	
		$pref_november 	= substr($november,0,1)."-".$total_finance; 	
		$pref_december 	= substr($december,0,1)."-".$total_finance; 	
		$pref_january 	= substr($january,0,1)."-".$total_finance; 	
		$pref_february 	= substr($february,0,1)."-".$total_finance; 	
		$pref_march 	= substr($march,0,1)."-".$total_finance; 		
		$pref_april		= substr($april,0,1)."-".$total_finance; 		
		$pref_may 		= substr($may,0,1)."-".$total_finance; 		
		$pref_june 		= substr($june,0,1)."-".$total_finance;
		
		$update_tung = "update tunggakan set 
						
						july 		= '$pref_july',
						august		= '$pref_august',
						september	= '$pref_september',
						october		= '$pref_october',
						november	= '$pref_november',
						december	= '$pref_december',
						january		= '$pref_january',
						february	= '$pref_february',
						march		= '$pref_march',
						april		= '$pref_april',
						may			= '$pref_may',
						june		= '$pref_june'
						
						where no_sisda = '$no_sisda' and jenis_tunggakan = 'spp' and periode = '2015 - 2016'							
						"; 	
						
		$query_update_tung	= mysqli_query($mysql_connect, $update_tung) or die(mysql_error());
		echo $update_tung."<br>"; 	
	
		//echo $i." - ".$nama_siswa."(".$total_finance.") - july = ". $july."<br>";
		
	}
}
*/
?>