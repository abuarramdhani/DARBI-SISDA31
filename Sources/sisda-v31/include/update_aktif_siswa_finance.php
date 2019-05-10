<?PHP
//ini untuk menghindari data siswa finance (table: siswa_finance) terbaca dua kali atau lebih, dikerenakan status aktif-nya.
//jadi yang harus terbaca adalah data tahun terakhir(terkini), maka status aktifnya = 1 (ini sudah set default)
//nah tahun-tahun sebelumnya yang tidak terupdate status akan terbaca juga. ini akan bermasalah di proses transaksi
//karena di cetak kuitansi data kelasnya akan mengambil dari data tahun ajaran yg pertama terbaca sama query
//maka kita rubah statusnya
$do_update_aktif_siswa_finance = empty($src_do_update_aktif_siswa_finance) ? "" : $src_do_update_aktif_siswa_finance;

if($do_update_aktif_siswa_finance == true) {

	$src_get_max_year 	= "SELECT MAX(periode_begin) as tahun_ajaran FROM kontrol_bulan_spp";
	$query_get_max_year	= mysqli_query($mysql_connect, $src_get_max_year) or die(mysql_error());
	$get_max_year		= mysqli_fetch_array($query_get_max_year, MYSQLI_ASSOC);
	//echo "jumlah=(".mysql_num_rows($query_get_max_year).")";
	
	//this last education year, not the current one
	//because we want to set to 0 the last edu year, and keep 1 for current year
	$begin_max_year_aktsisfin	= $get_max_year["tahun_ajaran"] - 1;
	$end_max_year_aktsisfin		= $get_max_year["tahun_ajaran"];	
	
	$cur_aktsisfin_edu_year 	= $begin_max_year_aktsisfin." - ".$end_max_year_aktsisfin;
	
	//echo "<h1> thaunyua=". $get_max_year["tahun_ajaran"]."</h1>";
	
	$src_update_aktsisfin	= "update siswa_finance set aktif = '2' where periode = '$cur_aktsisfin_edu_year'";
	$query_update_aktsisfin	= mysqlI_query($mysql_connect, $src_update_aktsisfin) or die(mysql_error());	

}
?>
