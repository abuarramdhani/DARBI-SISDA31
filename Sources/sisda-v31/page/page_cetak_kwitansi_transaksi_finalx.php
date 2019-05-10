<?PHP
$sender_unit					= $_POST["sender_unit"];
$sender_kasir					= $_POST["sender_kasir"];
$sender_no_kwitansi				= $_POST["sender_no_kwitansi"];
$sender_tanggal					= $_POST["sender_tanggal"];
$sender_no_sisda				= $_POST["sender_no_sisda"];
$sender_nama					= $_POST["sender_nama"];
$sender_kelas					= $_POST["sender_kelas"];
$sender_student_pay				= $_POST["sender_student_pay"];
$must_be_paid1					= 0;
$must_be_paid2					= 0;
//////////
$sender_bima					= $_POST["sender_bima"];
$sender_bima_succeed			= $_POST["sender_bima_succeed"];
$sender_bima_message			= $_POST["sender_bima_message"];
//////////
$sender_daful					= $_POST["sender_daful"];
$sender_daful_succeed			= $_POST["sender_daful_succeed"];
$sender_daful_message			= $_POST["sender_daful_message"];
//////////
$sender_spp						= $_POST["sender_spp"];
$sender_ks						= empty($_POST["sender_ks"]) ? "" : $_POST["sender_ks"];
$sender_spp_bulan				= $_POST["sender_spp_bulan"];
$sender_spp_succeed				= $_POST["sender_spp_succeed"];
$sender_spp_message				= $_POST["sender_spp_message"];
//////////
$sender_catering				= $_POST["sender_catering"];
$sender_catering_bulan			= $_POST["sender_catering_bulan"];
$sender_catering_succeed		= $_POST["sender_catering_succeed"];
$sender_catering_message		= $_POST["sender_catering_message"];
//////////
$sender_antar_jemput			= $_POST["sender_antar_jemput"];
$sender_antar_jemput_bulan		= $_POST["sender_antar_jemput_bulan"];	
$sender_antar_jemput_succeed	= $_POST["sender_antar_jemput_succeed"];
$sender_antar_jemput_message	= $_POST["sender_antar_jemput_message"];
//////////
$sender_ruba					= $_POST["sender_ruba"];
$sender_ruba_item				= $_POST["sender_ruba_item"];
$sender_ruba_succeed			= $_POST["sender_ruba_succeed"];
$sender_ruba_message			= $_POST["sender_ruba_message"];	
///////////	
$sender_schspt					= $_POST["sender_schspt"];
$sender_schspt_item				= $_POST["sender_schspt_item"];
$sender_schspt_succeed			= $_POST["sender_schspt_succeed"];
$sender_schspt_message			= $_POST["sender_schspt_message"];
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
<table width="1045" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td>
        	<table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td width="40" id="text_normal_black"><img src="../images/icon_logo_black_small.png" /></td>
                    <td id="text_normal_black">Sekolah Islam Terpadu Darul Abidin</td>
                </tr>
                <tr>
                	<td colspan="2"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr>
                	<td colspan="2" id="text_normal_black" align="center" height="35"><span style="font-size:16px;">KWITANSI PEMBAYARAN SPP DAN ADMINISTRASI</span></td>
                </tr>
            </table>
            <table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr height="30">
                	<td width="100" id="text_normal_black">No Kwitansi</td>
                    <td width="10" id="text_normal_black">:</td>
                    <td id="text_normal_black"><?= $sender_no_kwitansi; ?> | <?= $sender_tanggal; ?></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Nama</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b><?= $sender_nama; ?></b></td>
                </tr>
                <tr>
                	<td id="text_normal_black"></td>
                    <td id="text_normal_black"></td>
                    <td id="text_normal_black"><b><?= $sender_no_sisda; ?> | <?= $sender_kelas; ?></b></td>
                </tr>
                <tr height="20">
                	<td colspan="3">&nbsp;</td>
                </tr>
                <?PHP
				if($sender_bima != 0 && $sender_bima_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Biaya masuk</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_bima,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_bima;
				}
				?>
                <?PHP
				if($sender_daful != 0 && $sender_daful_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Daftar ulang</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><?= $sender_daful; ?>Rp <?= number_format($sender_daful,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_daful;
				}
				?>
                <?PHP
				if($sender_spp != 0 && $sender_spp_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">SPP</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_spp,0,",",".").",-"; ?> [<?= $sender_spp_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_spp;
				}
				?>
                <?PHP
				if($sender_ks != 0 && $sender_spp_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">KS</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_ks,0,",",".").",-"; ?> [<?= $sender_spp_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_ks;
				}
				?>
                <?PHP
				if($sender_catering != 0 && $sender_catering_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Catering</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_catering,0,",",".").",-"; ?> [<?= $sender_catering_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_catering;
				}
				?>
                <?PHP
				if($sender_antar_jemput != 0 && $sender_antar_jemput_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Antar jemput</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_antar_jemput,0,",",".").",-"; ?> [<?= $sender_antar_jemput_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_antar_jemput;
				}
				?>
                <?PHP
				if($sender_ruba != 0 && $sender_ruba_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Rumah berbagi</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_ruba,0,",",".").",-"; ?> [<?= $sender_ruba_item; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_ruba;
				}
				?>
                <?PHP
				if($sender_schspt != 0 && $sender_schspt_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">School support</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_schspt,0,",",".").",-"; ?> [<?= $sender_schspt_item; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid1 = $must_be_paid1+$sender_schspt;
				}
				?>
                <tr height="20">
                	<td colspan="3"><hr noshade="noshade" size="1" /></td>
                </tr>
             </table>
             <table width="512" border="0" cellpadding="0" cellspacing="0">
                <?PHP
				if($sender_student_pay > $must_be_paid1) { $kembali = $sender_student_pay - $must_be_paid1; } else { $kembali = 0; }
				?>
                <tr height="20">
                	<td width="80" id="text_normal_black">Total</td>
                    <td width="10" id="text_normal_black">:</td>
                    <td id="text_normal_black"><b>Rp <?= number_format($must_be_paid1,0,",",".").",-"; ?></b></td>
                    <td width="21" rowspan="3" background="../images/batas_kwitansi.png"></td>
                    <td width="135" rowspan="3" align="center" id="text_normal_black">Oleh<br /><br /><br /><br /><span style="font-size:10px; color:#cccccc;">----- nama ----</span></td>
                    <td width="21" rowspan="3" background="../images/batas_kwitansi.png"></td>
                    <td width="135" rowspan="3" align="center" id="text_normal_black">Kasir<br /><br /><br /><br /><?= $sender_kasir; ?></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Uang bayar</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b>Rp <?= number_format($sender_student_pay,0,",",".").",-"; ?></b></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Kembali</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b>Rp <?= number_format($kembali,0,",",".").",-"; ?></b></td>
                </tr>
                <tr height="20">
                	<td colspan="7"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black" colspan="7" align="center">
                    <span style="font-size:12px;">
                    Dengan ditandatanganinya kwitansi ini, maka sekolah dan pemohon setuju atas data transaksi yang tertera di atas. Mohon disimpan hingga pembayaran berikutnya - Terima kasih
                    </span>
                    </td>
                 </tr>
            </table>
        </td>
        <td width="21" background="../images/batas_kwitansi.png"></td>
        <td>
        	<table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td width="40" id="text_normal_black"><img src="../images/icon_logo_black_small.png" /></td>
                    <td id="text_normal_black">Sekolah Islam Terpadu Darul Abidin</td>
                </tr>
                <tr>
                	<td colspan="2"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr>
                	<td colspan="2" id="text_normal_black" align="center" height="35"><span style="font-size:16px;">KWITANSI PEMBAYARAN SPP DAN ADMINISTRASI</span></td>
                </tr>
            </table>
            <table width="512" border="0" cellpadding="0" cellspacing="0">
            	<tr height="30">
                	<td width="100" id="text_normal_black">No Kwitansi</td>
                    <td width="10" id="text_normal_black">:</td>
                    <td id="text_normal_black"><?= $sender_no_kwitansi; ?> | <?= $sender_tanggal; ?></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Nama</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b><?= $sender_nama; ?></b></td>
                </tr>
                <tr>
                	<td id="text_normal_black"></td>
                    <td id="text_normal_black"></td>
                    <td id="text_normal_black"><b><?= $sender_no_sisda; ?> | <?= $sender_kelas; ?></b></td>
                </tr>
                <tr height="20">
                	<td colspan="3">&nbsp;</td>
                </tr>
                <?PHP
				if($sender_bima != 0 && $sender_bima_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Biaya masuk</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_bima,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_bima;
				}
				?>
                <?PHP
				if($sender_daful != 0 && $sender_daful_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Daftar ulang</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><?= $sender_daful; ?>Rp <?= number_format($sender_daful,0,",",".").",-"; ?></td>
                </tr>
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_daful;
				}
				?>
                <?PHP
				if($sender_spp != 0 && $sender_spp_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">SPP</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_spp,0,",",".").",-"; ?> [<?= $sender_spp_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_spp;
				}
				?>
                <?PHP
				if($sender_ks != 0 && $sender_spp_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">KS</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_ks,0,",",".").",-"; ?> [<?= $sender_spp_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_ks;
				}
				?>
                <?PHP
				if($sender_catering != 0 && $sender_catering_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Catering</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_catering,0,",",".").",-"; ?> [<?= $sender_catering_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_catering;
				}
				?>
                <?PHP
				if($sender_antar_jemput != 0 && $sender_antar_jemput_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Antar jemput</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_antar_jemput,0,",",".").",-"; ?> [<?= $sender_antar_jemput_bulan; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_antar_jemput;
				}
				?>
                <?PHP
				if($sender_ruba != 0 && $sender_ruba_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">Rumah berbagi</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_ruba,0,",",".").",-"; ?> [<?= $sender_ruba_item; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_ruba;
				}
				?>
                <?PHP
				if($sender_schspt != 0 && $sender_schspt_succeed == "okeh") {
				?>
                <tr height="20">
                	<td id="text_normal_black">School support</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black">Rp <?= number_format($sender_schspt,0,",",".").",-"; ?> [<?= $sender_schspt_item; ?>]</td>
                </tr>
                	
                <?PHP
                	$must_be_paid2 = $must_be_paid2+$sender_schspt;
				}
				?>
                <tr height="20">
                	<td colspan="3"><hr noshade="noshade" size="1" /></td>
                </tr>
             </table>
             <table width="512" border="0" cellpadding="0" cellspacing="0">
                <?PHP
				if($sender_student_pay > $must_be_paid2) { $kembali = $sender_student_pay - $must_be_paid2; } else { $kembali = 0; }
				?>
                <tr height="20">
                	<td width="80" id="text_normal_black">Total</td>
                    <td width="10" id="text_normal_black">:</td>
                    <td id="text_normal_black"><b>Rp <?= number_format($must_be_paid2,0,",",".").",-"; ?></b></td>
                    <td width="21" rowspan="3" background="../images/batas_kwitansi.png"></td>
                    <td width="135" rowspan="3" align="center" id="text_normal_black">Oleh<br /><br /><br /><br /><span style="font-size:10px; color:#cccccc;">----- nama ----</span></td>
                    <td width="21" rowspan="3" background="../images/batas_kwitansi.png"></td>
                    <td width="135" rowspan="3" align="center" id="text_normal_black">Kasir<br /><br /><br /><br /><?= $sender_kasir; ?></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Uang bayar</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b>Rp <?= number_format($sender_student_pay,0,",",".").",-"; ?></b></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black">Kembali</td>
                    <td id="text_normal_black">:</td>
                    <td id="text_normal_black"><b>Rp <?= number_format($kembali,0,",",".").",-"; ?></b></td>
                </tr>
                <tr height="20">
                	<td colspan="7"><hr noshade="noshade" size="1" /></td>
                </tr>
                <tr height="20">
                	<td id="text_normal_black" colspan="7" align="center">
                    <span style="font-size:12px;">
                    Dengan ditandatanganinya kwitansi ini, maka sekolah dan pemohon setuju atas data transaksi yang tertera pada kwitansi ini. Mohon disimpan hingga pembayaran berikutnya - Terima kasih
                    </span>
                    </td>
                 </tr>
            </table>
        </td>
    </tr>
</table>
<table width="1045" border="0" cellpadding="0" cellspacing="0">
	<tr height="20">
    	<td><input type="button" value="." onclick="window.location.href='../../sisda-v31/mainpage.php';" style="background-color:#FFFFFF;"  /></td>
    </tr>
</table>
</body>
</html>