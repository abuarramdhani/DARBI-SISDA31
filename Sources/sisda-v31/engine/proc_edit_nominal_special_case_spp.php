<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	$srch_nama_siswa 	= mysql_real_escape_string($_POST['nama_siswa']);
	$srch_jenjang 		= mysql_real_escape_string($_POST['jenjang']);
	$srch_tingkat 		= mysql_real_escape_string($_POST['tingkat']);			  
	$srch_no_sisda 		= mysql_real_escape_string($_POST['no_sisda']);
	$srch_periode 		= mysql_real_escape_string($_POST['periode']);
	
	$src_chk_prefix_spp 	= "select * from tunggakan where no_sisda = '$srch_no_sisda' and periode = '$srch_periode' and jenis_tunggakan = 'spp'";
	$query_chk_prefix_spp 	= mysqli_query($mysql_connect, $src_chk_prefix_spp) or die(mysql_error());
	$chk_prefix_spp			= mysql_fetch_array($query_chk_prefix_spp);
	
	$src_val_jul_spp	= $_POST["val_jul_spp"]; 
	$str_jul =  substr($chk_prefix_spp["july"],0,1); 
	if($str_jul == 2 || $str_jul == 1 || $str_jul == 0) { $edit_jul_spp = "july = '".$str_jul."-".$src_val_jul_spp."',"; } else { $edit_jul_spp = ""; }
	
	$src_val_aug_spp	= $_POST["val_aug_spp"];
	$str_aug =  substr($chk_prefix_spp["august"],0,1); 
	if($str_aug == 2 || $str_aug == 1 || $str_aug == 0) { $edit_aug_spp = "august = '".$str_aug."-".$src_val_aug_spp."',"; } else { $edit_aug_spp = ""; }
	
	$src_val_sep_spp	= $_POST["val_sep_spp"];
	$str_sep =  substr($chk_prefix_spp["september"],0,1); 
	if($str_sep == 2 || $str_sep == 1 || $str_sep == 0) { $edit_sep_spp = "september = '".$str_sep."-".$src_val_sep_spp."',"; } else { $edit_sep_spp = ""; }
	
	$src_val_oct_spp	= $_POST["val_oct_spp"];
	$str_oct =  substr($chk_prefix_spp["october"],0,1); 
	if($str_oct == 2 || $str_oct == 1 || $str_oct == 0) { $edit_oct_spp = "october = '".$str_oct."-".$src_val_oct_spp."',"; } else { $edit_oct_spp = ""; }
	
	$src_val_nov_spp	= $_POST["val_nov_spp"];
	$str_nov =  substr($chk_prefix_spp["november"],0,1); 
	if($str_nov == 2 || $str_nov == 1 || $str_nov == 0) { $edit_nov_spp = "november = '".$str_nov."-".$src_val_nov_spp."',"; } else { $edit_nov_spp = ""; }
	
	$src_val_dec_spp	= $_POST["val_dec_spp"];
	$str_dec =  substr($chk_prefix_spp["december"],0,1); 
	if($str_dec == 2 || $str_dec == 1 || $str_dec == 0) { $edit_dec_spp = "december = '".$str_dec."-".$src_val_dec_spp."',"; } else { $edit_dec_spp = ""; }
	
	$src_val_jan_spp	= $_POST["val_jan_spp"];
	$str_jan =  substr($chk_prefix_spp["january"],0,1); 
	if($str_jan == 2 || $str_jan == 1 || $str_jan == 0) { $edit_jan_spp = "january = '".$str_jan."-".$src_val_jan_spp."',"; } else { $edit_jan_spp = ""; }
	
	$src_val_feb_spp	= $_POST["val_feb_spp"];
	$str_feb =  substr($chk_prefix_spp["february"],0,1); 
	if($str_feb == 2 || $str_feb == 1 || $str_feb == 0) { $edit_feb_spp = "february = '".$str_feb."-".$src_val_feb_spp."',"; } else { $edit_feb_spp = ""; }
	
	$src_val_mar_spp	= $_POST["val_mar_spp"];
	$str_mar =  substr($chk_prefix_spp["march"],0,1); 
	if($str_mar == 2 || $str_mar == 1 || $str_mar == 0) { $edit_mar_spp = "march = '".$str_mar."-".$src_val_mar_spp."',"; } else { $edit_mar_spp = ""; }
	
	$src_val_apr_spp	= $_POST["val_apr_spp"];
	$str_apr =  substr($chk_prefix_spp["april"],0,1); 
	if($str_apr == 2 || $str_apr == 1 || $str_apr == 0) { $edit_apr_spp = "april = '".$str_apr."-".$src_val_apr_spp."',"; } else { $edit_apr_spp = ""; }
	
	$src_val_may_spp	= $_POST["val_may_spp"];
	$str_may =  substr($chk_prefix_spp["may"],0,1); 
	if($str_may == 2 || $str_may == 1 || $str_may == 0) { $edit_may_spp = "may = '".$str_may."-".$src_val_may_spp."',"; } else { $edit_may_spp = ""; }
	
	$src_val_jun_spp	= $_POST["val_jun_spp"];
	$str_jun =  substr($chk_prefix_spp["june"],0,1); 
	if($str_jun == 2 || $str_jun == 1 || $str_jun == 0) { $edit_jun_spp = "june = '".$str_jun."-".$src_val_jun_spp."',"; } else { $edit_jun_spp = ""; }
	
	//here we go again baby,....
	$src_update_value_spp	= 
								"
									update tunggakan set
									$edit_jul_spp
									$edit_aug_spp
									$edit_sep_spp
									$edit_oct_spp
									$edit_nov_spp
									$edit_dec_spp
									$edit_jan_spp
									$edit_feb_spp
									$edit_mar_spp
									$edit_apr_spp
									$edit_may_spp
									$edit_jun_spp
									jenis_tunggakan = 'spp'
									
									where
									
									no_sisda = '$srch_no_sisda' and
									periode = '$srch_periode' and
									jenis_tunggakan = 'spp'
									
								"; //echo $src_update_value_spp;
	$query_update_value_spp	= mysqli_query($mysql_connect, $src_update_value_spp) or die ("There is an error with mysql: ".mysql_error());
	
	if($query_update_value_spp) {
		//---------------------------------------
		//here are variables that used in prog_log.php
		include_once("include/url.php");
		$activity	= "Add bank name";
		$url		= curPageURL();
		$id			= $_SESSION["id"];
		$need_log	= true;
		include_once("include/log.php");
		//---------------------------------------
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_true.png";
		$redirect_url	= "page/page_edit_nominal_special_case_redirect.php?t=spp&no_sisda=$srch_no_sisda&jenjang=$srch_jenjang&tingkat=$srch_tingkat&periode=$srch_periode";
		$redirect_text	= "Data tagihan sudah diperbarui";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Nama bank gagal ditambahkan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>