<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	//We need to know what page is this (including their GET variable in URL
	//We'll send it to prod page.
	include "include/url.php";
	$url = curPageURL();
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Rekapitulasi Transaksi SPP</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td align="center">
        	<?PHP
			//let's define whether these variables empty or not (in POST method)
			$srch_no_sisda 		= (empty($_POST['no_sisda'])) ? '' : $_POST['no_sisda'];
			$srch_jenjang 		= (empty($_POST['jenjang'])) ? '' : $_POST['jenjang'];
			$srch_tingkat 		= (empty($_POST['tingkat'])) ? '' : $_POST['tingkat'];
			$srch_nama_siswa 	= (empty($_POST['nama_siswa'])) ? '' : $_POST['nama_siswa'];
			$srch_periode 		= (empty($_POST['periode'])) ? '' : $_POST['periode'];
			$srch_unit_tk 		= (empty($_POST['unit_tk'])) ? '' : $_POST['unit_tk'];
			$srch_unit_sd 		= (empty($_POST['unit_sd'])) ? '' : $_POST['unit_sd'];
			$srch_unit_smp 		= (empty($_POST['unit_smp'])) ? '' : $_POST['unit_smp'];
			
			
			$srch_teknik_pembayaran	= empty($_POST['teknik_pembayaran']) ? '' : $_POST['teknik_pembayaran'];
			
			$srch_date_begin 	= empty($_POST['date_begin']) ? '' : $_POST['date_begin']; //echo "srch_date_begin: ".$srch_date_begin."<br>";
			$srch_month_begin 	= empty($_POST['month_begin']) ? '' : $_POST['month_begin']; //echo "srch_month_begin: ".$srch_month_begin."<br>";
			$srch_year_begin 	= empty($_POST['year_begin']) ? '' : $_POST['year_begin']; //echo "srch_year_begin: ".$srch_year_begin."<br>";			$srch_datetra_begin	= $srch_year_begin."-".$srch_month_begin."-".$srch_date_begin;
			$srch_datetra_begin	= $srch_year_begin."-".$srch_month_begin."-".$srch_date_begin;
			
			$srch_date_end 		= empty($_POST['date_end']) ? '' : $_POST['date_end']; //echo "srch_date_end: ".$srch_date_end."<br>";
			$srch_month_end 	= empty($_POST['month_end']) ? '' : $_POST['month_end']; //echo "srch_month_end: ".$srch_month_end."<br>";
			$srch_year_end 		= empty($_POST['year_end']) ? '' : $_POST['year_end']; //echo "srch_year_end: ".$srch_year_end."<br>";
			$srch_datetra_end	= $srch_year_end."-".$srch_month_end."-".$srch_date_end;
			?>
            <form name="search" method="post" action="?pl=rekap_spp">
            <input type="hidden" name="v" value="1" />
            
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td align="left" width="150" id="text_normal_black">No Sisda</td>
                    <td width="20"></td>
                    <td><input type="text" name="no_sisda" size="25" <?PHP if($srch_no_sisda != "") { ?>value="<?= $srch_no_sisda; ?>"<?PHP } ?>/></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Nama siswa</td>
                    <td></td>
                    <td><input type="text" name="nama_siswa" size="25" <?PHP if($srch_nama_siswa != "") { ?>value="<?= $srch_nama_siswa; ?>"<?PHP } ?>/></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Tingkat</td>
                    <td></td>
                    <td>
                    <select name="tingkat">
                    <option value="">Pilih</option>
                    <option value="Toddler" <?PHP if($srch_tingkat == "Toddler") { ?>selected="selected" <?PHP } ?>>Toddler</option>
                    <option value="PG" <?PHP if($srch_tingkat == "PG") { ?>selected="selected" <?PHP } ?>>PG</option>
                    <option value="TK A" <?PHP if($srch_tingkat == "TK A") { ?>selected="selected" <?PHP } ?>>TK A</option>
                    <option value="TK B" <?PHP if($srch_tingkat == "TK B") { ?>selected="selected" <?PHP } ?>>TK B</option>
                    <option value="1" <?PHP if($srch_tingkat == "1") { ?>selected="selected" <?PHP } ?>>1</option>
                    <option value="2" <?PHP if($srch_tingkat == "2") { ?>selected="selected" <?PHP } ?>>2</option>
                    <option value="3" <?PHP if($srch_tingkat == "3") { ?>selected="selected" <?PHP } ?>>3</option>
                    <option value="4" <?PHP if($srch_tingkat == "4") { ?>selected="selected" <?PHP } ?>>4</option>
                    <option value="5" <?PHP if($srch_tingkat == "5") { ?>selected="selected" <?PHP } ?>>5</option>
                    <option value="6" <?PHP if($srch_tingkat == "6") { ?>selected="selected" <?PHP } ?>>6</option>
                    <option value="7" <?PHP if($srch_tingkat == "7") { ?>selected="selected" <?PHP } ?>>7</option>
                    <option value="8" <?PHP if($srch_tingkat == "8") { ?>selected="selected" <?PHP } ?>>8</option>
                    <option value="9" <?PHP if($srch_tingkat == "9") { ?>selected="selected" <?PHP } ?>>9</option>
                    </select>
                    </td>
                </tr>
                <?PHP $src_select_periode = $srch_periode; ?>
                <tr>
                    <td align="left" id="text_normal_black">Periode</td>
                    <td></td>
                    <td><?PHP include("include/periode.php"); ?></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Tanggal transaksi</td>
                    <td></td>
                    <td id="text_normal_black">
                    <?PHP 
					$cur_check_d 	= date("d");
					$cur_check_m 	= date("m");
					$cur_check_y 	= date("Y");
					$y_bottom		= $cur_check_y-5;
					$y_top			= $cur_check_y+6;
					?>
                    <select name="date_begin">
                    <?PHP for($idb=1; $idb<32; $idb++) { ?>
                    <option value="<?= $idb; ?>" <?PHP if($srch_date_begin != "") { if($srch_date_begin == $idb) { ?>selected='selected'<?PHP } } else if($cur_check_d == $idb) { ?>selected="selected"<?PHP } ?>><?= $idb; ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="month_begin">
                    <?PHP for($imb=1; $imb<13; $imb++) { ?>
                    <option value="<?= $imb; ?>" <?PHP if($srch_month_begin != "") { if($srch_month_begin == $imb) { ?>selected='selected'<?PHP } } else if($cur_check_m == $imb) { ?>selected="selected"<?PHP } ?>><?= $imb; ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="year_begin">
                    <?PHP for($iyb=$y_bottom; $iyb<$y_top; $iyb++) { ?>
                    <option value="<?= $iyb; ?>" <?PHP if($srch_year_begin != "") { if($srch_year_begin == $iyb) { ?>selected='selected'<?PHP } } else if($cur_check_y == $iyb) { ?>selected="selected"<?PHP } ?>><?= $iyb; ?></option>
                    <?PHP } ?>
                    </select>
                     s/d 
                    <select name="date_end">
                    <?PHP for($ide=1; $ide<32; $ide++) { ?>
                    <option value="<?= $ide; ?>" <?PHP if($srch_date_end != "") { if($srch_date_end == $ide) { ?>selected='selected'<?PHP } } else if($cur_check_d == $ide) { ?>selected="selected"<?PHP } ?>><?= $ide; ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="month_end">
                    <?PHP for($ime=1; $ime<13; $ime++) { ?>
                    <option value="<?= $ime; ?>" <?PHP if($srch_month_end != "") { if($srch_month_end == $ime) { ?>selected='selected'<?PHP } } else if($cur_check_m == $ime) { ?>selected="selected"<?PHP } ?>><?= $ime; ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="year_end">
                    <?PHP for($iye=$y_bottom; $iye<$y_top; $iye++) { ?>
                    <option value="<?= $iye; ?>" <?PHP if($srch_year_end != "") { if($srch_year_end == $iye) { ?>selected='selected'<?PHP } } else if($cur_check_y == $iye) { ?>selected="selected"<?PHP } ?>><?= $iye; ?></option>
                    <?PHP } ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black" height="25">Unit</td>
                    <td></td>
                    <td id="text_normal_black">                    
                    <input type="checkbox" value="TK" name="unit_tk" <?PHP if($srch_unit_tk != "") { ?> checked="checked"<?PHP } ?> /> TK | <input type="checkbox" value="SD" name="unit_sd" <?PHP if($srch_unit_sd != "") { ?> checked="checked"<?PHP } ?> /> SD | <input type="checkbox" value="SMP" name="unit_smp" <?PHP if($srch_unit_smp != "") { ?> checked="checked"<?PHP } ?> /> SMP
                    </td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black"></td>
                    <td></td>
                    <td><input type="submit" value="Tampilkan rekapitulasi" style="width:200px; height:40px;" /></td>
                </tr>
                <tr>
                    <td height="10" colspan="3"><hr noshade="noshade" color="#666666" size="1" /></td>
                </tr>
            </table>
            </form>
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
			
			if($srch_date_begin == "" && $srch_month_begin == "" && $srch_year_begin == "" && $srch_date_end == "" && $srch_month_end == "" && $srch_year_end == "") {
			
				$src_cari_tgl_begin	= $cur_check_y."-".$cur_check_m."-".$cur_check_d." 00:00:00";
				$src_cari_tgl_end	= $cur_check_y."-".$cur_check_m."-".$cur_check_d." 23:59:59";
			
			} else {
			
				$src_cari_tgl_begin	= $srch_year_begin."-".$srch_month_begin."-".$srch_date_begin." 00:00:00";
				$src_cari_tgl_end	= $srch_year_end."-".$srch_month_end."-".$srch_date_end." 23:59:59";
			
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
									(tanggal_transaksi between '$src_cari_tgl_begin' and '$src_cari_tgl_end')
									$where_jenjang
									
									order by tanggal_transaksi desc";  //echo $src_get_siswa;
									
			$query_get_siswa		= mysqli_query($mysql_connect, $src_get_siswa) or die("There is an error with mysql: ".mysql_error());
			$num_get_siswa_all		= mysql_num_rows($query_get_siswa);
			?>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                	<td id="text_normal_black" colspan="3">Ditemukan: <b><?PHP echo $num_get_siswa_all; ?> data</b></td>
                    <td align="right">
                    <form method="post" name="cetak_spp" action="page/page_cetak_rekap_spp.php">
                    <input type="hidden" name="srch_no_sisda" value="<?= $srch_no_sisda; ?>" />
                    <input type="hidden" name="srch_jenjang" value="<?= $srch_jenjang; ?>" />
                    <input type="hidden" name="srch_tingkat" value="<?= $srch_tingkat; ?>" />
                    <input type="hidden" name="srch_nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                    <input type="hidden" name="srch_periode" value="<?= $srch_periode; ?>" />
                    <input type="hidden" name="srch_unit_tk" value="<?= $srch_unit_tk; ?>" />
                    <input type="hidden" name="srch_unit_sd" value="<?= $srch_unit_sd; ?>" />
                    <input type="hidden" name="srch_unit_smp" value="<?= $srch_unit_smp; ?>" />
                    <input type="hidden" name="srch_datetra_begin" value="<?= $src_cari_tgl_begin; ?>" />
                    <input type="hidden" name="srch_datetra_end" value="<?= $src_cari_tgl_end; ?>" />
                    <input type="submit" name="submit_cetak" value="Cetak Halaman" style="height:40px; width:150px; color:#ffffff; background-color:#006699;" />
                    </form>
                    </td>
                </tr>
            </table>
            <style type="text/css">
			#cetak_rekap_putih { font-family:verdana; font-size:10px; color:#FFFFFF; }
			#cetak_rekap_hitam { font-family:verdana; font-size:10px; color:#000000; }
			</style>
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
						$total_nom_ict_trs 			= $total_nom_ict_trs + $nom_ict;
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
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                	<td id="text_normal_black" colspan="3">Ditemukan: <b><?PHP echo $num_get_siswa_all; ?> data</b></td>
                    <td align="right">
                    <form method="post" name="cetak_spp" action="page/page_cetak_rekap_spp.php">
                    <input type="hidden" name="srch_no_sisda" value="<?= $srch_no_sisda; ?>" />
                    <input type="hidden" name="srch_jenjang" value="<?= $srch_jenjang; ?>" />
                    <input type="hidden" name="srch_tingkat" value="<?= $srch_tingkat; ?>" />
                    <input type="hidden" name="srch_nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                    <input type="hidden" name="srch_periode" value="<?= $srch_periode; ?>" />
                    <input type="hidden" name="srch_unit_tk" value="<?= $srch_unit_tk; ?>" />
                    <input type="hidden" name="srch_unit_sd" value="<?= $srch_unit_sd; ?>" />
                    <input type="hidden" name="srch_unit_smp" value="<?= $srch_unit_smp; ?>" />
                    <input type="hidden" name="srch_datetra_begin" value="<?= $srch_datetra_begin; ?>" />
                    <input type="hidden" name="srch_datetra_end" value="<?= $srch_datetra_end; ?>" />
                    <input type="submit" name="submit_cetak" value="Cetak Halaman" style="height:40px; width:150px; color:#ffffff; background-color:#006699;" />
                    </form>
                    </td>
                </tr>
            </table>
            <table border="0">
                <tr>
                	<td height="20"></td>
                </tr>
			</table>
		</td>
        <td></td>
     </tr>
</table>
<?PHP
} else {	
	
	header("location:index.php");
		
}
?>