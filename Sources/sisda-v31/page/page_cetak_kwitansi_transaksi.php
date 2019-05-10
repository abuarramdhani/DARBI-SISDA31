<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
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
<div id="main_contaciner">
<DIV id="TipLayer" style="visibility:hidden;position:absolute;z-index:1000;top:-100;"></DIV>
<SCRIPT language="JavaScript1.2" src="help_popup/style.js" type="text/javascript"></SCRIPT>   
<style media="screen" type="text/css">
#punya_button
{
	width:250px;
	height:40px;
	font-family:Verdana;
	font-size:14px;
	font-weight:bold;
}
#data_error
{
	font-family:Verdana;
	font-size:14px;
	font-weight:bold;
	color:#FF0000;
}
</style> 
<?PHP 
//let's make a good connection for our life..... muaaach
include ("../sisda-config.php");

//We have to use this file to generate the dynamic background.
include_once("../style_head.php");


$sender_unit					= $_POST["sender_unit"];
$sender_kasir					= $_POST["sender_kasir"];
$sender_no_kwitansi				= $_POST["sender_no_kwitansi"];
$sender_tanggal					= $_POST["sender_tanggal"];
$sender_no_sisda				= $_POST["sender_no_sisda"];
$sender_nama					= $_POST["sender_nama"];
$sender_kelas					= $_POST["sender_kelas"];
$sender_student_pay				= $_POST["sender_student_pay"];
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
$sender_cetak_nom_item_schspt	= $_POST["sender_cetak_nom_item_schspt"];
$sender_ket_schspt_enc			= $_POST["sender_ket_schspt_enc"];
	
	  
?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
    	<td height="30" colspan="5"></td>
    </tr>
    <tr>
    	<td width="40" height="20"></td>
        <td width="20"><img src="../images/border_mp_top_left.png" /></td>
    	<td background="../images/border_mp_top_center.png"></td>
        <td width="20"><img src="../images/border_mp_top_right.png" /></td>
        <td width="40"></td>
    </tr>
    <tr>
    	<td width="40" height="400"></td>
        <td width="20" background="../images/border_mp_middle_left.png"></td>
    	<td background="../images/border_mp_middle_center.png" valign="top" align="center">
            <table width="800" border="0" cellpadding="0" cellspacing="0" >
            	<tr>
                	<td height="40">&nbsp;</td>
                </tr>
            <?PHP
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////------------------------------------- Data Umum tarnsaksi-----------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			$must_be_paid	= 0;
			?>
            	<tr>
                	<td width="150" height="50" id="text_normal_white" align="center" colspan="3" bgcolor="#006699"><span style="font-size:24px;">Data Hasil Transaksi</span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30">&nbsp;</td>
                </tr>
                <tr>
                	<td width="150" id="text_normal_black"><span style="font-size:16px;">No Transaksi</span></td>
                    <td width="10">:</td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;"><b><?= $sender_no_kwitansi; ?></b></span></td>
                </tr>
                <tr>
                	<td width="150" id="text_normal_black"><span style="font-size:16px;">Tgl Transaksi</span></td>
                    <td width="10">:</td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;"><b><?= $sender_tanggal; ?></b></span></td>
                </tr>
                <tr>
                	<td width="150" id="text_normal_black"><span style="font-size:16px;">Kasir</span></td>
                    <td width="10">:</td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;"><b><?= $sender_kasir; ?></b></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30">&nbsp;</td>
                </tr>
                <tr>
                	<td width="150" id="text_normal_black"><span style="font-size:16px;">Nama Siswa</span></td>
                    <td width="10">:</td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;"><b><?= $sender_nama; ?></b></span></td>
                </tr>
                <tr>
                	<td width="150" id="text_normal_black"><span style="font-size:16px;">No Sisda</span></td>
                    <td width="10">:</td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;"><b><?= $sender_no_sisda; ?></b></span></td>
                </tr>
                <tr>
                	<td width="150" id="text_normal_black"><span style="font-size:16px;">Unit</span></td>
                    <td width="10">:</td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;"><b><?= $sender_unit; ?></b></span></td>
                </tr>
                <tr>
                	<td width="150" id="text_normal_black"><span style="font-size:16px;">Kelas</span></td>
                    <td width="10">:</td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;"><b><?= $sender_kelas; ?></b></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            </table>    
            <table width="800" border="0" cellpadding="0" cellspacing="0" >
            <?PHP
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////--------------------------------------- BIaya Masuk ------------------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sender_bima != 0 ) {
			
				if($sender_bima_succeed == "gagal") {
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Biaya Masuk Tidak Berhasil]</span></td>
            	</tr>
				<tr>
                	<td width="40"><img src="../images/icon_delete.png" /></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><?= $sender_bima_message; ?></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				} else {
				
				$sender_bima_succeed = "okeh";
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Biaya Masuk Berhasil]</span></td>
            	</tr>
            	<tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Nominal: <span style="color:#FF9966;"><b><?= "Rp ".number_format($sender_bima,0,",",".").",-"; ?></b></span></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
			
				$must_be_paid	= $must_be_paid+$sender_bima;
				
				}
			
			} 
			
			
			
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////--------------------------------------- Daftar Ulang -----------------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sender_daful != 0 ) {
			
				if($sender_daful_succeed == "gagal") {
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Daftar Ulang Tidak Berhasil]</span></td>
            	</tr>
				<tr>
                	<td width="40"><img src="../images/icon_delete.png" /></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="font-size:16px;"><?= $sender_daful_message; ?></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				} else {
				
				$sender_daful_succeed = "okeh";
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Daftar Ulang Berhasil]</span></td>
            	</tr>
            	<tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Nominal: <span style="color:#FF9966;"><b><?= "Rp ".number_format($sender_daful,0,",",".").",-"; ?></b></span></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
			
				$must_be_paid	= $must_be_paid+$sender_daful;
				
				}
			
			} 
			
			
			
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////------------------------------------------- SPP ----------------------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sender_spp != 0 || $sender_ks != 0) {
			
				if($sender_spp_succeed == "gagal") {
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi SPP Tidak Berhasil]</span></td>
            	</tr>
				<tr>
                	<td width="40"><img src="../images/icon_delete.png" /></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="font-size:16px;"><?= $sender_spp_message; ?></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				} else {
				
				$sender_spp_succeed = "okeh";
				
			?>
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi SPP Berhasil]</span></td>
            	</tr>	
            	<tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Nominal SPP: <span style="color:#FF9966;"><b><?= "Rp ".number_format($sender_spp,0,",",".").",-"; ?></b></span></span></td>
                </tr>
                <?PHP
					if($sender_ks != "") {
				?>
                <tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Nominal KS: <span style="color:#FF9966;"><b><?= "Rp ".number_format($sender_ks,0,",",".").",-"; ?></b></span></span></td>
                </tr>
                <?PHP
					}
				?>
                <tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Bulan: <b><?= $sender_spp_bulan; ?></b></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				
				$must_be_paid	= $must_be_paid+$sender_spp+$sender_ks;
				
				}
			
			} 
			
			
            
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////----------------------------------------- CATERING -------------------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sender_catering != 0 ) {
			
				if($sender_catering_succeed == "gagal") {
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Catering Tidak Berhasil]</span></td>
            	</tr>	
				<tr>
                	<td width="40"><img src="../images/icon_delete.png" /></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="font-size:16px;"><?= $sender_catering_message; ?></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				} else {
				
				$sender_catering_succeed = "okeh";
				
			?>
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Catering Berhasil]</span></td>
            	</tr>
            	<tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Nominal: <span style="color:#FF9966;"><b><?= "Rp ".number_format($sender_catering,0,",",".").",-"; ?></b></span></span></td>
                </tr>
                <tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Bulan: <b><?= $sender_catering_bulan; ?></b></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
			
				$must_be_paid	= $must_be_paid+$sender_catering;
				
				}
			
			} 
			
            
            
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////-------------------------------------- ANTAR JEMPUT ------------------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sender_antar_jemput != 0 ) {
			
				if($sender_antar_jemput_succeed == "gagal") {
				
			?>
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Antar Jemput Tidak Berhasil]</span></td>
            	</tr>	
				<tr>
                	<td width="40"><img src="../images/icon_delete.png" /></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="font-size:16px;"><?= $sender_antar_jemput_message; ?></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				} else {
				
				$sender_antar_jemput_succeed = "okeh";
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Antar Jemput Berhasil]</span></td>
            	</tr>
            	<tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Nominal: <span style="color:#FF9966;"><b><?= "Rp ".number_format($sender_antar_jemput,0,",",".").",-"; ?></b></span></span></td>
                </tr>
                <tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Bulan: <b><?= $sender_antar_jemput_bulan; ?></b></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				
				$must_be_paid	= $must_be_paid+$sender_antar_jemput;
				
				}
			
			} 
            
            
            
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////-------------------------------------- Rumah Berbagi -----------------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sender_ruba != 0 ) {
			
				if($sender_ruba_succeed == "gagal") {
				
			?>
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Rumah Berbagi Tidak Berhasil]</span></td>
            	</tr>	
				<tr>
                	<td width="40"><img src="../images/icon_delete.png" /></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="font-size:16px;"><?= $sender_ruba_message; ?></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				} else {
				
				$sender_ruba_succeed = "okeh";
			?>
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi Rumah Berbagi Berhasil]</span></td>
            	</tr>	
            	<tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Nominal: <span style="color:#FF9966;"><b><?= "Rp ".number_format($sender_ruba,0,",",".").",-"; ?></b></span></span></td>
                </tr>
                <tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Item pembayaran: <b><?= $sender_ruba_item; ?></b></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				
				$must_be_paid	= $must_be_paid+$sender_ruba;
				
				}
			
			} 
            
            
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/////-------------------------------------- School Support-----------------------------------------------/////
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if($sender_schspt != 0 ) {
			
				if($sender_schspt_succeed == "gagal") {
				
			?>	
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi School Support Tidak Berhasil]</span></td>
            	</tr>	
				<tr>
                	<td width="40"><img src="../images/icon_delete.png" /></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="font-size:16px;"><?= $sender_schspt_message; ?></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				} else {
				
				$sender_schspt_succeed = "okeh";
				
			?>
            	<tr>
            		<td height="40"  id="text_normal_black" colspan='3'><span style="font-size:16px;">[Transaksi School Support Berhasil]</span></td>
            	</tr>
            	<tr>
                	<td width='21'><img src="../images/icon_ok.png"/></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#006699; font-size:16px;">Item / Nominal: <span style="color:#ff9966;"><b><?= $sender_cetak_nom_item_schspt; ?></b></span></span></td>
                </tr>
                <tr>
                	<td colspan="3" height="30"><hr noshade="noshade" size="1" /></td>
                </tr>
            <?PHP	
				
				$must_be_paid	= $must_be_paid+$sender_schspt;
				
				}
			
			} 
			?>
         	</table>
            <?PHP
			if($sender_student_pay > $must_be_paid) { $kembali = $sender_student_pay - $must_be_paid; } else { $kembali = 0; }
			?>
         	<table width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            	<tr>
                	<td height="20" colspan="5"></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                	<td id="text_normal_black"><span style="font-size:16px;">Dibayarkan:</span></td>
                    <td></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#993366; font-size:20px;">Rp <?= number_format($sender_student_pay,0,",",".").",-"; ?></b></span></td>
                	<td>&nbsp;</td>
                </tr>
            	<tr>
                	<td width="30">&nbsp;</td>
                	<td width="200" id="text_normal_black"><span style="font-size:16px;">Yang harus dibayarkan:</span></td>
                    <td width="10"></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#993366; font-size:20px;">Rp <?= number_format($must_be_paid,0,",",".").",-"; ?></b></span></td>
                	<td width="30">&nbsp;</td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                	<td id="text_normal_black"><span style="font-size:16px;">Kembali:</span></td>
                    <td></td>
                	<td colspan="6" height="5" align="left" valign="top" id="text_normal_black"><span style="color:#FF0000; font-size:20px;">Rp <?= number_format($kembali,0,",",".").",-"; ?></b></span></td>
                	<td>&nbsp;</td>
                </tr>
            	<tr>
                	<td height="20">&nbsp;</td>
                </tr>
            </table>
            <form method="post" name="cetak_kwitansi" action="page_cetak_kwitansi_transaksi_final.php">
            <table width="800" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td height="30">
                    
                    <input type="hidden" name="sender_unit" value="<?= $sender_unit; ?>" />
                    <input type="hidden" name="sender_kasir" value="<?= $sender_kasir; ?>" />
                    <input type="hidden" name="sender_no_kwitansi" value="<?= $sender_no_kwitansi; ?>" />	
                    <input type="hidden" name="sender_tanggal" value="<?= $sender_tanggal; ?>" />	
                    <input type="hidden" name="sender_no_sisda" value="<?= $sender_no_sisda; ?>" />
                    <input type="hidden" name="sender_nama" value="<?= $sender_nama; ?>" />
                    <input type="hidden" name="sender_kelas" value="<?= $sender_kelas; ?>" />
                    <input type="hidden" name="sender_student_pay" value="<?= $sender_student_pay; ?>" />
                    
                    <input type="hidden" name="sender_bima" value="<?= $sender_bima; ?>"  />
					<input type="hidden" name="sender_bima_succeed" value="<?= $sender_bima_succeed; ?>"  />
					<input type="hidden" name="sender_bima_message" value="<?= $sender_bima_message; ?>" />

					<input type="hidden" name="sender_daful" value="<?= $sender_daful; ?>" />
					<input type="hidden" name="sender_daful_succeed" value="<?= $sender_daful_succeed; ?>" />
					<input type="hidden" name="sender_daful_message" value="<?= $sender_daful_message; ?>" />

					<input type="hidden" name="sender_spp" value="<?= $sender_spp; ?>" />
                    <input type="hidden" name="sender_ks" value="<?= $sender_ks; ?>" />
					<input type="hidden" name="sender_spp_bulan" value="<?= $sender_spp_bulan; ?>"	/>
					<input type="hidden" name="sender_spp_succeed" value="<?= $sender_spp_succeed; ?>" /> 
					<input type="hidden" name="sender_spp_message" value="<?= $sender_spp_message;?>" />

					<input type="hidden" name="sender_catering" value="<?= $sender_catering; ?>" />
					<input type="hidden" name="sender_catering_bulan" value="<?= $sender_catering_bulan; ?>" />
					<input type="hidden" name="sender_catering_succeed" value="<?= $sender_catering_succeed; ?>" />
					<input type="hidden" name="sender_catering_message" value="<?= $sender_catering_message; ?>" />

					<input type="hidden" name="sender_antar_jemput" value="<?= $sender_antar_jemput; ?>" />
					<input type="hidden" name="sender_antar_jemput_bulan" value="<?= $sender_antar_jemput_bulan; ?>" />	
					<input type="hidden" name="sender_antar_jemput_succeed" value="<?= $sender_antar_jemput_succeed; ?>" />
					<input type="hidden" name="sender_antar_jemput_message" value="<?= $sender_antar_jemput_message; ?>" />

					<input type="hidden" name="sender_ruba" value="<?= $sender_ruba; ?>" />
					<input type="hidden" name="sender_ruba_item" value="<?= $sender_ruba_item; ?>" />
					<input type="hidden" name="sender_ruba_succeed" value="<?= $sender_ruba_succeed; ?>" />
					<input type="hidden" name="sender_ruba_message" value="<?= $sender_ruba_message; ?>" />	

					<input type="hidden" name="sender_schspt" value="<?= $sender_schspt; ?>" />
					<input type="hidden" name="sender_schspt_item" value="<?= $sender_schspt_item; ?>" />
					<input type="hidden" name="sender_schspt_succeed" value="<?= $sender_schspt_succeed; ?>" />
					<input type="hidden" name="sender_schspt_message" value="<?= $sender_schspt_message; ?>" />
                    <input type="hidden" name="sender_cetak_nom_item_schspt" value="<?= $sender_cetak_nom_item_schspt; ?>" />
                    <input type="hidden" name="sender_ket_schspt_enc" value="<?= $sender_ket_schspt_enc; ?>" />
                    </td>
                </tr>
                <tr>
                	<td height="30" align="center"><input type="submit" value="Cetak Kuitansi" style="height:40px; width:250px; font-size:18px;" /></td>
                </tr>
                <tr>
                	<td height="30">&nbsp;</td>
                </tr>
            </table>
            </form>
        </td>
        <td width="20" background="../images/border_mp_middle_right.png"></td>
        <td width="40"></td>
    </tr>
    <tr>
    	<td width="40" height="20"></td>
        <td width="20"><img src="../images/border_mp_bottom_left.png" /></td>
    	<td background="../images/border_mp_bottom_center.png"></td>
        <td width="20"><img src="../images/border_mp_bottom_right.png" /></td>
        <td width="40"></td>
    </tr>
    <tr>
    	<td width="40" height="20"></td>
    	<td height="25" colspan="3" align="right">
        	<table cellpadding="0" cellspacing="0" border="0">
            	<tr>
                    <td id="footer" align="right"><b>SIT Darul Abidin</b><br />Jl. Karet Hijau No. 29 Beji Timur - Depok<br />Telp:(021) 77200857 - Fax:(021)77202272</td>
                    <td width="5"></td>
                    <td width="20"><img src="../images/icon_logo_black_small.png" /></td>
                </tr>
                <tr>
                	<td height="20" colspan="3"></td>
                </tr>
            </table>
        </td>
        <td width="40" height="20"></td>
    </tr>
</table>
</div>
</body>
</html>
<?PHP
}
?>