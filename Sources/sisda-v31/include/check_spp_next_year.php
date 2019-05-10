<?PHP
if($do_check_spp_next_year == "ok") { 

	echo "<b>note:check_spp_next_year.php</b>";
	//echo "<h2>Bu Nisa/Gita, saya di sebelah. Nanti kalau bu fitri datang, minta tolong bu fitri klik tombol Setting Persen Pembayaran anak guru/umum.</h2>";
	
	//$src_cur_tingkat di dapat dari halaman page/page_transaction.php
	//$edu_year_siswa_next didapat dari halaman page/page_transaction.php
	//$no_sisda_enc didapat dari halaman page/page_transaction.php
	//$src_cur_status didapat dari halaman page/page_transaction.php
	
	//sebenarnya yang perlu di check tuh dua tabel, tunggakan dan siswa finance
	//Tapi insyaALlah klo tunggakan spp dah ada, seyogyanya dan semesti, bahkan seharusnya, siswa finance juga dah ada untuk tahun ajaran yang bersangkutan (tahun depan)
	//Nah ini kita cek apakah data tunggakan spp untuk tahun depan udah dibuat apa belom, jangan-jangan udah
	$src_check_spp_tunggakan_next_year 		= "select id from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$edu_year_siswa_next' and jenis_tunggakan = 'spp'";
	$query_check_spp_tunggakan_next_year	= mysqli_query($mysql_connect, $src_check_spp_tunggakan_next_year) or die(mysql_error());
	$num_check_spp_tunggakan_net_year		= mysql_num_rows($query_check_spp_tunggakan_next_year);
	
	if($num_check_spp_tunggakan_net_year	 == 0) {
?>
<table bgcolor="#CCCC99" border="0" cellpadding="0" cellspacing="0" width="495">
    <tr>
        <td height="20" colspan="2"></td>
    </tr>
    <tr>
        <td width="20"></td>
        <td>
<?PHP
		//halaman ini akan diincludekan di halaman page/page_transaction.php
	
		//////////////////////////////////////////////////////////////////
		///// syarat untuk bisa dilakukan input data SPP tahun depan//////
		///// adalah bahwa setting SPP tahun depan di DB sudah////////////
		///// dilakukan oleh bu Fitri, yoa....////////////////////////////
		//////////////////////////////////////////////////////////////////
		
		if($src_cur_tingkat == "1") { $src_next_tingkat_spp = "2"; $src_next_jenjang_spp = "sd"; } 
		else if($src_cur_tingkat == "2") { $src_next_tingkat_spp = "3"; $src_next_jenjang_spp = "sd"; }
		else if($src_cur_tingkat == "3") { $src_next_tingkat_spp = "4"; $src_next_jenjang_spp = "sd"; }
		else if($src_cur_tingkat == "4") { $src_next_tingkat_spp = "5"; $src_next_jenjang_spp = "sd"; }
		else if($src_cur_tingkat == "5") { $src_next_tingkat_spp = "6"; $src_next_jenjang_spp = "sd"; }
		else if($src_cur_tingkat == "7") { $src_next_tingkat_spp = "8"; $src_next_jenjang_spp = "smp"; }
		else if($src_cur_tingkat == "8") { $src_next_tingkat_spp = "9"; $src_next_jenjang_spp = "smp"; }
		
		//buat ngamanin proses adding biar gak ada yang isengin
		$src_check_data_finance_next_year_eng = substr(md5($darbi_key.$no_sisda_enc.$edu_year_siswa_next.$src_next_tingkat_spp.$src_cur_status),0,15);
		
		$src_get_tahun_masuk 	= "select periode from siswa where no_sisda = '$no_sisda_enc'";
		$query_get_tahun_masuk	= mysqli_query($mysql_connect, $src_get_tahun_masuk) or die(mysql_error());
		$get_tahun_masuk		= mysql_fetch_array($query_get_tahun_masuk);
		$tahun_masuk			= $get_tahun_masuk["periode"];
		
		$src_ket_disc = substr($tahun_masuk,2,2).substr($tahun_masuk,9,2);
		
		$src_check_set_spp 		= "select nominal,item_byr from set_spp where periode = '$edu_year_siswa_next' and ket_disc = '$src_ket_disc' and tingkat = '$src_next_tingkat_spp'";
		$query_check_set_spp	= mysqli_query($mysql_connect, $src_check_set_spp) or die(mysql_error());
		$num_check_set_spp		= mysql_num_rows($query_check_set_spp);
		
		//echo $src_check_set_spp."<br>";
		
		if($num_check_set_spp == 4) { 
		
			$set_spp_for_spp = "";
			$set_spp_for_ict = "";
			$set_spp_for_kts = "";
			$set_spp_for_ler = "";
		
			while($check_set_spp = mysql_fetch_array($query_check_set_spp)) {
			
				if($check_set_spp["item_byr"] == "spp") { $set_spp_for_spp = $check_set_spp["nominal"]; }
				if($check_set_spp["item_byr"] == "ict") { $set_spp_for_ict = $check_set_spp["nominal"]; }
				if($check_set_spp["item_byr"] == "kts") { $set_spp_for_kts = $check_set_spp["nominal"]; }
				if($check_set_spp["item_byr"] == "ler") { $set_spp_for_ler = $check_set_spp["nominal"]; }
		
			}
			//echo "<h1>fff $set_spp_for_spp - $set_spp_for_ict - $set_spp_for_kts - $set_spp_for_ler</h1>";
			if($set_spp_for_spp == 0 || $set_spp_for_ict == 0 || $set_spp_for_kts == 0 || $set_spp_for_ler == 0) {
			
				$status_check_set_spp = "belom_lengkap";
			
			} else {
			
				$status_check_set_spp = "lengkap"; 
			
			}
		
		} else {
		
			$status_check_set_spp = "belom_lengkap"; //echo "<h1>iki lho</h1>";
		
		}
		
		
		////// cek bu fitri apa sudah tentukan persen bayar untuk anak guru tahun ajaran depan
		$src_get_persen_spp 	= "select * from persen_bayar where periode = '$edu_year_siswa_next'";
		$query_get_persen_spp	= mysqli_query($mysql_connect, $src_get_persen_spp) or die(mysqli_query($mysql_connect, ));
		$num_get_persen_spp		= mysql_num_rows($query_get_persen_spp);
		
		if($num_get_persen_spp == 0)  {
	?>	
		<span id="text_normal_black">Prosentase pembayaran untuk SPP tahun ajaran <?= $edu_year_siswa_next ?> belum dilakukan</span><br /><input type="button" value="Setting Persen Pembayaran anak guru / umum" onclick="window.location.href='?pl=persen_bayar';" style="height:35px; background-color:#663366; color:#FFFFFF;" />
	<?PHP
		} else if($status_check_set_spp == "belom_lengkap") {
	?>	
		<span id="text_normal_black">Nominal biaya SPP, ICT, KS atau e-Learning tahun ajaran <?= $edu_year_siswa_next ?>  belum lengkap / belum ditentukan</span><br /><input type="button" value="Setting SPP tahun <?= $edu_year_siswa_next ?>" onclick="window.location.href='?pl=spp_setting&j=<?PHP echo $src_next_jenjang_spp; //$next_daful_spp dapet dari page_transaction.php ?>';" style="height:35px; background-color:#663366; color:#FFFFFF;" />
	<?PHP
		} else if($status_check_set_spp == "lengkap") {
	?>	
		<span id="text_normal_black">Lakukan input nominal SPP untuk tahun ajaran <?= $edu_year_siswa_next ?></span><br /><input type="button" value="Setting SPP tahun <?= $edu_year_siswa_next ?>" onclick="window.location.href='engine.php?case=add_spp_next_year&n=<?= $no_sisda_enc; ?>&p=<?= $edu_year_siswa_next; ?>&en=<?= $src_check_data_finance_next_year_eng; ?>&t=<?= $src_next_tingkat_spp; ?>&s=<?= $src_cur_status; ?>';" style="height:35px; background-color:#663366; color:#FFFFFF;"/>
	<?PHP
		}
?>
 		</td>
    </tr>
    <tr>
        <td height="20" colspan="2"></td>
    </tr>
</table>
<?PHP
	} else { echo "<h1>dsfsdfsd</h1>"; }
}
?>