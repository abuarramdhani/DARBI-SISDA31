<?PHP
include_once("../sisda-config.php");
$srch_no_sisda		= empty($_POST["srch_no_sisda"]) ? "" : $_POST["srch_no_sisda"];
$srch_jenjang		= empty($_POST["srch_jenjang"]) ? "" : $_POST["srch_jenjang"];
$srch_tingkat		= empty($_POST["srch_tingkat"]) ? "" : $_POST["srch_tingkat"];
$srch_nama_siswa	= empty($_POST["srch_nama_siswa"]) ? "" : $_POST["srch_nama_siswa"];
$srch_periode		= empty($_POST["srch_periode"]) ? "" : $_POST["srch_periode"];
$srch_unit_tk		= empty($_POST["srch_unit_tk"]) ? "" : $_POST["srch_unit_tk"]; 
$srch_unit_sd		= empty($_POST["srch_unit_sd"]) ? "" : $_POST["srch_unit_sd"];
$srch_unit_smp		= empty($_POST["srch_unit_smp"]) ? "" : $_POST["srch_unit_smp"];
$srch_datetra_begin	= $_POST["srch_datetra_begin"];
$srch_datetra_end	= $_POST["srch_datetra_end"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
<title>Sistem Informasi Sekolah Islam Terpadu Darul Abidin - v3</title>
<link media="screen" type="text/css" rel="stylesheet" href="../style.css">
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="40" id="text_normal_black"><img src="../images/icon_logo_black_small.png" /></td>
        <td id="text_normal_black"><span style="font-size:18px;">Sekolah Islam Terpadu Darul Abidin</span></td>
    </tr>
    <tr>
        <td colspan="2"><hr noshade="noshade" size="1" /></td>
    </tr>
    <tr>
        <td colspan="2" id="text_normal_black" align="center" height="35"><span style="font-size:24px; font-weight:bold;">Rekapitulasi Transaksi SPP</span></td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td height="20"></td>
    </tr>
    <tr>
    	<td align="center">
            <?PHP
			$where_jenjang = "";
			
			if($srch_unit_tk != "" || $srch_unit_sd != "" || $srch_unit_smp != "") { 
			
				$where_jenjang = " and (";
				
				if($srch_unit_tk != "") {
				
					$where_jenjang =  $where_jenjang."jenjang = 'Toddler' || jenjang = 'PG' || jenjang = 'TK A' || jenjang = 'TK B'"; 
					
				}
				if($srch_unit_sd != "") {
				
					if($srch_unit_tk != "") {
					
						$where_jenjang = $where_jenjang." || jenjang = 'SD'";
					
					} else {
					
						$where_jenjang = $where_jenjang."jenjang = 'SD'";
					
					}
				
				}
				if($srch_unit_smp != "") {
				
					if($srch_unit_tk != "" || $srch_unit_sd != "") {
					
						$where_jenjang = $where_jenjang." || jenjang = 'SMP'";
					
					} else {
					
						$where_jenjang = $where_jenjang."jenjang = 'SMP'";
					
					}
				
				}
				
				$where_jenjang = $where_jenjang.")";
				
			}
			
			
			//weleh-weleh, take a look at this query.....
			//$the_limit       = defines where should the query begin from
			//$show_per_page   = defines how many record should be shown
			$src_get_siswa		= "
									select * from transaksi 
									
									where 
									
									spp_spp != '0' and									
									no_sisda like '%$srch_no_sisda%' and
									nama_siswa like '%$srch_nama_siswa%' and
									teknik_pembayaran like '%$srch_teknik_pembayaran%' and									
									tingkat like '%$srch_tingkat%' and 
									periode like '%$srch_periode%' and
									(tanggal_transaksi between '$srch_datetra_begin' and '$srch_datetra_end')
									$where_jenjang
									
									order by tanggal_transaksi desc";  //echo $src_get_siswa;
			echo 	$src_get_siswa;					
			$query_get_siswa		= mysqli_query($mysql_connect, $src_get_siswa) or die("There is an error with mysql: ".mysql_error());
			$num_get_siswa_all		= mysql_num_rows($query_get_siswa);
			?>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <style type="text/css">
			#cetak_rekap_putih { font-family:verdana; font-size:12px; color:#FFFFFF; }
			#cetak_rekap_hitam { font-family:verdana; font-size:12px; color:#000000; }
			#cetak_ket_rekap_hitam { font-family:verdana; font-size:14px; color:#000000; }
			</style>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">  
            	<?PHP
				if($srch_no_sisda != "") {
				?>
                <tr>  
                    <td" id="cetak_ket_rekap_hitam">No Sisda</td>
                    <td>:</td>
                    <td align="left" id="cetak_ket_rekap_hitam"><?= $srch_no_sisda; ?></td>
                </tr>
                <?PHP
				}
				?>
                <?PHP
				if($srch_nama_siswa != "") {
				?>
                <tr>  
                    <td id="cetak_ket_rekap_hitam">Nama siswa</td>
                    <td>:</td>
                    <td align="left" id="cetak_ket_rekap_hitam"><?= $srch_nama_siswa; ?></td>
                </tr>
                <?PHP
				}
				?>
                <?PHP
				if($srch_tingkat != "") {
				?>
                <tr>  
                    <td id="cetak_ket_rekap_hitam">Tingkat</td>
                    <td>:</td>
                    <td align="left" id="cetak_ket_rekap_hitam"><?= $srch_tingkat; ?></td>
                </tr>
                <?PHP
				}
				?>
                <?PHP
				if($srch_periode != "") {
				?>
                <tr>  
                    <td id="cetak_ket_rekap_hitam">Periode</td>
                    <td>:</td>
                    <td align="left" id="cetak_ket_rekap_hitam"><?= $srch_periode; ?></td>
                </tr>
                <?PHP
				}
				?>
                <?PHP
				if($srch_unit_tk != "" || $srch_unit_sd != "" || $srch_unit_smp != "") {
				?>
                <tr>  
                    <td id="cetak_ket_rekap_hitam">Unit</td>
                    <td>:</td>
                    <td align="left" id="cetak_ket_rekap_hitam"><?= $srch_unit_tk; ?> <?= $srch_unit_sd; ?> <?= $srch_unit_smp; ?> </td>
                </tr>
                <?PHP
				}
				?>
                <tr>  
                    <td width="130"id="cetak_ket_rekap_hitam">Tanggal transaksi</td>
                    <td width="10">:</td>
                    <td align="left" id="cetak_ket_rekap_hitam"><?= substr($srch_datetra_begin,0,10); ?> s/d <?= substr($srch_datetra_end,0,10); ?></td>
                </tr>
                <tr>  
                    <td width="130"id="cetak_ket_rekap_hitam">Jumlah data</td>
                    <td width="10">:</td>
                    <td align="left" id="cetak_ket_rekap_hitam"><?PHP echo $num_get_siswa_all; ?></td>
                </tr>
                <tr>
                	<td height="10" colspan="3"></td>
                </tr>
            </table>
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" style="border: 1px blue dotted; font-size:10px;">  
            	<tr height="30">  
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">No</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Tgl transaksi</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">kasir</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Cara<br />Bayar</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Nama Siswa</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Unit</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">kelas</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Periode</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Jumlah<br />bulan</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Bulan<br />bayar</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">SPP</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">ICT</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">E-Learning</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">KS</td>
                    <td width="" bgcolor="#999999" id="cetak_rekap_putih" align="center">Jumlah</td>
                </tr>
                <?PHP
				if($num_get_siswa_all != 0) {
				
					//$bg used to generate zebra background.
					$bg	="#ffffff";	
					
					//this is for row  number, you know...it starts from 0
					$row_number	= 1;
					
					$total_nom_spp_trs 			= "";
					$total_nom_ict_trs 			= "";
					$total_nom_elearning_trs 	= "";
					$total_nom_ks_trs 			= "";
					$total_nom_all_trs 			= "";
					
					
					while($get_siswa = mysql_fetch_array($query_get_siswa)) {
					
						if($get_siswa["tingkat"] == "Toddler" || $get_siswa["tingkat"] == "PG" || $get_siswa["tingkat"] == "TK A" || $get_siswa["tingkat"] == "TK B") { $unit = "TK"; }
						if(
							$get_siswa["tingkat"] == "1" ||
							$get_siswa["tingkat"] == "2" ||
							$get_siswa["tingkat"] == "3" ||
							$get_siswa["tingkat"] == "4" ||
							$get_siswa["tingkat"] == "5" ||
							$get_siswa["tingkat"] == "6"
						) { $unit = "SD"; }
						if($get_siswa["tingkat"] == "7" || $get_siswa["tingkat"] == "8" || $get_siswa["tingkat"] == "9")  { $unit = "SMP"; }
					
						$nom_spp 		= $get_siswa["spp_spp"];
						$nom_ict 		= $get_siswa["ict_spp"];
						$nom_elearning 	= $get_siswa["elearning_spp"];
						$nom_ks 		= $get_siswa["ks_spp"];
								
						$jmlh = $nom_spp + $nom_ict + $nom_elearning + $nom_ks;		
										
					?>
					<tr height="30">                
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP /*The number of record will be similar with $the_limit*/echo $row_number++; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["tanggal_transaksi"]; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["kasir"]; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["teknik_pembayaran"]; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["nama_siswa"]; ?></td>
                        <td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $unit; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["kelas"]; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["periode"]; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["jumlah_bulan_spp"]; ?></td>                    
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo $get_siswa["bulan_spp"]; ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP if($get_siswa["spp_spp"] == 0) { echo "0"; } else { echo "Rp ".number_format($get_siswa["spp_spp"],0,",",".").",-"; } ?></td>
                        <td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP if($get_siswa["ict_spp"] == 0) { echo "0"; } else { echo "Rp ".number_format($get_siswa["ict_spp"],0,",",".").",-"; } ?></td>
                        <td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP if($get_siswa["elearning_spp"] == 0) { echo "0"; } else { echo "Rp ".number_format($get_siswa["elearning_spp"],0,",",".").",-"; } ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP if($get_siswa["ks_spp"] == 0) { echo "0"; } else { echo "Rp ".number_format($get_siswa["ks_spp"],0,",",".").",-"; } ?></td>
						<td width="" bgcolor="<?PHP echo $bg; ?>" id="cetak_rekap_hitam" align="center"><?PHP echo "Rp ".number_format($jmlh,0,",",".").",-";  ?></td>
					</tr>
					<?PHP
						
						$total_nom_spp_trs 			= $total_nom_spp_trs + $nom_spp;
						$total_nom_ict_trs 			= $total_nom_nom_ict + $nom_ict;
						$total_nom_elearning_trs	= $total_nom_elearning_trs + $nom_elearning;
						$total_nom_ks_trs 			= $total_nom_ks_trs + $nom_ks;
						$total_nom_all_trs			= $total_nom_all_trs + $jmlh; 
						
						if($bg	== "#ffffff") {
							$bg	= "#f1f1f1";
						}
						else {
							$bg	= "#ffffff";
						}
					}
					?>
					<tr height="30">                
						<td width="" bgcolor="#333333" id="cetak_rekap_putih" align="left" colspan="10"><b>Jumlah total:</b></td>
						<td width="" bgcolor="#333333" id="cetak_rekap_putih" align="center"><?PHP if($total_nom_spp_trs == 0) { echo "0"; } else { echo "Rp ".number_format($total_nom_spp_trs,0,",",".").",-"; } ?></td>
                        <td width="" bgcolor="#333333" id="cetak_rekap_putih" align="center"><?PHP if($total_nom_ict_trs == 0) { echo "0"; } else { echo "Rp ".number_format($total_nom_ict_trs,0,",",".").",-"; } ?></td>
						<td width="" bgcolor="#333333" id="cetak_rekap_putih" align="center"><?PHP if($total_nom_elearning_trs == 0) { echo "0"; } else { echo "Rp ".number_format($total_nom_elearning_trs,0,",",".").",-"; } ?></td>
						<td width="" bgcolor="#333333" id="cetak_rekap_putih" align="center"><?PHP if($total_nom_ks_trs == 0) { echo "0"; } else { echo "Rp ".number_format($total_nom_ks_trs,0,",",".").",-"; } ?></td>
                        <td width="" bgcolor="#333333" id="cetak_rekap_putih" align="center"><?PHP if($total_nom_all_trs == 0) { echo "0"; } else { echo "Rp ".number_format($total_nom_all_trs,0,",",".").",-"; } ?></td>
					</tr>
                 <?PHP
				 }
				 ?>
            </table>
            <table border="0">
                <tr>
                	<td height="20"></td>
                </tr>
			</table>
		</td>
     </tr>
</table>
<table width="1045" border="0" cellpadding="0" cellspacing="0">
	<tr height="20">
    	<td><input type="button" value="." onclick="window.location.href='<?= $darbi_url; ?>mainpage.php?pl=rekap_spp';" style="background-color:#FFFFFF;"  /></td>
    </tr>
</table>
</body>
</html>