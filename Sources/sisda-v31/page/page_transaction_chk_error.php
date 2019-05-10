<?PHP
//Yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	?>
<!-- i dont think that i should give many comments here, hope you understand the script step by step -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Cek Error Transaksi</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td align="center" id="text_normal_black" height="250">
        <?PHP
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
		//ada 2 kondisi dimana nama siswa tidak muncul pada saat transaksi
		//1. karena emang data siswa_finance untuk tahun ajaran sekarang belum ada
		//2. meskipun data siswa_finance untuk tahun ajaran sekarang udah ada, tapi nilai field "aktif" tidak sama dengan 1 (0 / 2)
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$src_no_sisda = empty($_POST["no_sisda"]) ? '' : $_POST["no_sisda"];
		
		if($src_no_sisda != '' && is_numeric($src_no_sisda)) {
		
			$no_sisda = mysqli_real_escape_string($mysql_connect, $src_no_sisda);
			
			//namanya siap
			$src_nama 	= "select nama_siswa from siswa where no_sisda = '$no_sisda'";
			$query_nama	= mysqli_query($mysql_connect, $src_nama) or die(mysql_error());
			$row_nama	= mysqli_fetch_array($query_nama, MYSQLI_ASSOC);
			$nama		= $row_nama["nama_siswa"]; 
			
			$cur_month	= strtolower(date("F"));
			$cur_year	= date("Y");
			
			if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	
				
				$edu_year		= ($cur_year-1)." - ".$cur_year;
				$edu_year_last	= ($cur_year-2)." - ".($cur_year-1);
				
			} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
				
				$edu_year		= $cur_year." - ".($cur_year+1);
				$edu_year_last	= ($cur_year-1)." - ".$cur_year;
				
			}
			
			//cek apa setting siswa finance untuk tahun ajaran sekarang sudah ada
			$src_chk_cur_sisfin 	= "select id from siswa_finance where no_sisda = '$no_sisda' and periode = '$edu_year'";
			$query_chk_cur_sisfin	= mysqli_query($mysql_connect, $src_chk_cur_sisfin) or die(mysql_error());
			$num_chk_cur_sisfin		= mysqlI_num_rows($query_chk_cur_sisfin);
			
			if($num_chk_cur_sisfin != 0) {
			
				$cur_sisfin = "ok";
			
			} else {
			
				$cur_sisfin = "gak_ok";
			
			}
			
			//cek data tunggakan dilakukan jika siswa finance tahun ajaran sekarang sudah ada
			//logikannya, setting siswa finance dibuat selalu bersamaan dengan data tunggakan
			$src_chk_cur_tunggakan 		= "select id from tunggakan where no_sisda = '$no_sisda' and periode = '$edu_year'";
			$query_chk_cur_tunggakan 	= mysqli_query($mysql_connect, $src_chk_cur_tunggakan) or die(mysql_error());
			$num_chk_cur_tunggakan		= mysqlI_num_rows($query_chk_cur_tunggakan);
			
			if($num_chk_cur_tunggakan != 0) {
			
				$cur_tunggakan = "ok";
			
			} else {
			
				$cur_tunggakan = "gak_ok";
			
			}
			
			/////////////////////////////////////////
			/////////////////////////////////////////
			/////////////////////////////////////////
			
			if($cur_sisfin == "gak_ok" && $cur_tunggakan = "gak_ok") {
			
				//ambil data tahun lalu dari siswa finance untuk tahu di tahun ajaran kemarin siswa ini kelas berapa
				$src_get_data_sisfin_last_year 		= "select jenjang, tingkat, kat_status_anak from siswa_finance where no_sisda = '$no_sisda' and periode = '$edu_year_last'";
				$query_get_data_sisfin_last_year 	= mysqli_query($mysql_connect, $src_get_data_sisfin_last_year) or die(mysql_error());
				$num_get_data_sisfin_last_year		= mysqlI_num_rows($query_get_data_sisfin_last_year);
				
				if($num_get_data_sisfin_last_year != 0) {
				
					$row_get_data_sisfin_last_year = mysqlI_fetch_array($query_get_data_sisfin_last_year, MYSQLI_ASSOC);
					
					//tahun lalu tingkat berapa? maka tahun ini ya naik satu tingkat aja bro....
					$last_tingkat		= $row_get_data_sisfin_last_year["tingkat"];
					
					if($last_tingkat == 1) { $cur_tingkat = 2; $cur_jenjang = "SD"; }
					if($last_tingkat == 2) { $cur_tingkat = 3; $cur_jenjang = "SD"; }
					if($last_tingkat == 3) { $cur_tingkat = 4; $cur_jenjang = "SD"; }
					if($last_tingkat == 4) { $cur_tingkat = 5; $cur_jenjang = "SD"; }
					if($last_tingkat == 5) { $cur_tingkat = 6; $cur_jenjang = "SD"; }
					if($last_tingkat == 7) { $cur_tingkat = 8; $cur_jenjang = "SMP"; }
					if($last_tingkat == 8) { $cur_tingkat = 9; $cur_jenjang = "SMP"; }
					
					$kat_status_anak	= $row_get_data_sisfin_last_year["kat_status_anak"];
					
					if(
						$last_tingkat == 1 || 
						$last_tingkat == 2 || 
						$last_tingkat == 3 || 
						$last_tingkat == 4 || 
						$last_tingkat == 5 || 
						$last_tingkat == 6 || 
						$last_tingkat == 7 || 
						$last_tingkat == 8 
					) {
				?>
                <form name="fix_data_keuangan" action="engine.php?case=add_spp_next_year_from_err_trks" method="post">
                <input type="submit" value="Buat data keuangan tahun ajaran <?= $edu_year; ?> untuk siswa <?= $nama; ?> [<?= $no_sisda; ?>]" style="height:40px;" />
                <input type="hidden" name="n" value="<?= $no_sisda; ?>" />
                <input type="hidden" name="na" value="<?= $nama; ?>" />
                <input type="hidden" name="p" value="<?= $edu_year; ?>" />
                <input type="hidden" name="t" value="<?= $cur_tingkat; ?>" />
                <input type="hidden" name="j" value="<?= $cur_jenjang; ?>" />
                <input type="hidden" name="s" value="<?= $kat_status_anak; ?>" />
                </form>
                
                
                <?PHP
					} else { echo "<h1>Proses tidak dilanjutkan.</h1><br>Proses ini hanya berlaku untuk siswa tingkat SD & SMP. <br>Untuk siswa TK & Toddler, silakan lakukan proses pendaftaran <b>Siswa Baru</b> melalui menu <b>Registrasi Administrasi Siswa</b>."; }
					
				} else {
				
					echo "<h3>Mohon maaf,terjadi masalah.<br>Data keuangan [siswa_finance] siswa $nama [$no_sisda] untuk tahun ajaran lalu [$edu_year_last] tidak ada.
							<br> Sehingga data keuangan untuk tahun ajaran ini [$edu_year] tidak dapat dibuat, karena jenjang, tingkat dan status siswa tidak diketahui
							<br> Mohon dicatat no_sisda siswa dan hubungi admin</h3>";	
				
				}
			
			} else {
			
				echo "<h3>Data siswa_finance atau data tunggakan milik siswa $nama [$no_sisda] untuk tahun ajaran ini [$edu_year] sudah dibuat. <br>Silakan Hubungi admin untuk proses lebih lanjut.</h3>";
			
			}
		}
		?>	
		</td>
        <td></td>
     </tr>
     <tr>
    	<td colspan="3" height="10"></td>
    </tr>
</table>
<?PHP
}
?>
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.select_no_sisda.no_sisda.value == "")
	{
		alert('Nomor sisda harus diisi');
		return false;
	}

return true;	
}
</SCRIPT>