<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	$srch_nama_siswa 		= mysql_real_escape_string($_POST['nama_siswa']);
	$srch_jenjang 			= mysql_real_escape_string($_POST['jenjang']);
	$srch_tingkat 			= mysql_real_escape_string($_POST['tingkat']);			  
	$srch_no_sisda 			= mysql_real_escape_string($_POST['no_sisda']);
	$srch_periode 			= mysql_real_escape_string($_POST['periode']);
	$src_jenis_tunggakan 	= mysql_real_escape_string($_POST['jenis_tunggakan']);
	
	$src_chk_prefix_cataj 	= "select * from tunggakan where no_sisda = '$srch_no_sisda' and periode = '$srch_periode' and jenis_tunggakan = '$src_jenis_tunggakan'";
	$query_chk_prefix_cataj 	= mysqli_query($mysql_connect, $src_chk_prefix_cataj) or die(mysql_error());
	$chk_prefix_cataj			= mysql_fetch_array($query_chk_prefix_cataj);
	
	$src_val_jul_cataj	= $_POST["val_jul_cataj"]; 
	$str_jul =  substr($chk_prefix_cataj["jul_cataj"],0,1); 
	if($str_jul == 2 || $str_jul == 1 || $str_jul == 0) { $edit_jul_cataj = "jul_cataj = '".$str_jul."-".$src_val_jul_cataj."',"; } else { $edit_jul_cataj = ""; }
	
	$src_val_aug_cataj	= $_POST["val_aug_cataj"];
	$str_aug =  substr($chk_prefix_cataj["aug_cataj"],0,1); 
	if($str_aug == 2 || $str_aug == 1 || $str_aug == 0) { $edit_aug_cataj = "aug_cataj = '".$str_aug."-".$src_val_aug_cataj."',"; } else { $edit_aug_cataj = ""; }
	
	$src_val_sep_cataj	= $_POST["val_sep_cataj"];
	$str_sep =  substr($chk_prefix_cataj["sep_cataj"],0,1); 
	if($str_sep == 2 || $str_sep == 1 || $str_sep == 0) { $edit_sep_cataj = "sep_cataj = '".$str_sep."-".$src_val_sep_cataj."',"; } else { $edit_sep_cataj = ""; }
	
	$src_val_oct_cataj	= $_POST["val_oct_cataj"];
	$str_oct =  substr($chk_prefix_cataj["oct_cataj"],0,1); 
	if($str_oct == 2 || $str_oct == 1 || $str_oct == 0) { $edit_oct_cataj = "oct_cataj = '".$str_oct."-".$src_val_oct_cataj."',"; } else { $edit_oct_cataj = ""; }
	
	$src_val_nov_cataj	= $_POST["val_nov_cataj"];
	$str_nov =  substr($chk_prefix_cataj["nov_cataj"],0,1); 
	if($str_nov == 2 || $str_nov == 1 || $str_nov == 0) { $edit_nov_cataj = "nov_cataj = '".$str_nov."-".$src_val_nov_cataj."',"; } else { $edit_nov_cataj = ""; }
	
	$src_val_dec_cataj	= $_POST["val_dec_cataj"];
	$str_dec =  substr($chk_prefix_cataj["dec_cataj"],0,1); 
	if($str_dec == 2 || $str_dec == 1 || $str_dec == 0) { $edit_dec_cataj = "dec_cataj = '".$str_dec."-".$src_val_dec_cataj."',"; } else { $edit_dec_cataj = ""; }
	
	$src_val_jan_cataj	= $_POST["val_jan_cataj"];
	$str_jan =  substr($chk_prefix_cataj["jan_cataj"],0,1); 
	if($str_jan == 2 || $str_jan == 1 || $str_jan == 0) { $edit_jan_cataj = "jan_cataj = '".$str_jan."-".$src_val_jan_cataj."',"; } else { $edit_jan_cataj = ""; }
	
	$src_val_feb_cataj	= $_POST["val_feb_cataj"];
	$str_feb =  substr($chk_prefix_cataj["feb_cataj"],0,1); 
	if($str_feb == 2 || $str_feb == 1 || $str_feb == 0) { $edit_feb_cataj = "feb_cataj = '".$str_feb."-".$src_val_feb_cataj."',"; } else { $edit_feb_cataj = ""; }
	
	$src_val_mar_cataj	= $_POST["val_mar_cataj"];
	$str_mar =  substr($chk_prefix_cataj["mar_cataj"],0,1); 
	if($str_mar == 2 || $str_mar == 1 || $str_mar == 0) { $edit_mar_cataj = "mar_cataj = '".$str_mar."-".$src_val_mar_cataj."',"; } else { $edit_mar_cataj = ""; }
	
	$src_val_apr_cataj	= $_POST["val_apr_cataj"];
	$str_apr =  substr($chk_prefix_cataj["apr_cataj"],0,1); 
	if($str_apr == 2 || $str_apr == 1 || $str_apr == 0) { $edit_apr_cataj = "apr_cataj = '".$str_apr."-".$src_val_apr_cataj."',"; } else { $edit_apr_cataj = ""; }
	
	$src_val_may_cataj	= $_POST["val_may_cataj"];
	$str_may =  substr($chk_prefix_cataj["may_cataj"],0,1); 
	if($str_may == 2 || $str_may == 1 || $str_may == 0) { $edit_may_cataj = "may_cataj = '".$str_may."-".$src_val_may_cataj."',"; } else { $edit_may_cataj = ""; }
	
	$src_val_jun_cataj	= $_POST["val_jun_cataj"];
	$str_jun =  substr($chk_prefix_cataj["jun_cataj"],0,1); 
	if($str_jun == 2 || $str_jun == 1 || $str_jun == 0) { $edit_jun_cataj = "jun_cataj = '".$str_jun."-".$src_val_jun_cataj."',"; } else { $edit_jun_cataj = ""; }
	
	/////////////////////////////////////
	
	$src_prov_jul_cataj	= $_POST["prov_jul_cataj"]; 
	if($str_jul == 2 || $str_jul == 1) { $edit_prov_jul_cataj = "jul_provider = '".$src_prov_jul_cataj."',"; } else {  $edit_prov_jul_cataj = ""; }
	
	$src_prov_aug_cataj	= $_POST["prov_aug_cataj"];
	if($str_aug == 2 || $str_aug == 1) { $edit_prov_aug_cataj = "aug_provider = '".$src_prov_aug_cataj."',"; } else {  $edit_prov_aug_cataj = ""; }
	
	$src_prov_sep_cataj	= $_POST["prov_sep_cataj"];
	if($str_sep == 2 || $str_sep == 1) { $edit_prov_sep_cataj = "sep_provider = '".$src_prov_sep_cataj."',"; } else {  $edit_prov_sep_cataj = ""; }
	
	$src_prov_oct_cataj	= $_POST["prov_oct_cataj"];
	if($str_oct == 2 || $str_oct == 1) { $edit_prov_oct_cataj = "oct_provider = '".$src_prov_oct_cataj."',"; } else {  $edit_prov_oct_cataj = ""; }
	
	$src_prov_nov_cataj	= $_POST["prov_nov_cataj"];
	if($str_nov == 2 || $str_nov == 1) { $edit_prov_nov_cataj = "nov_provider = '".$src_prov_nov_cataj."',"; } else {  $edit_prov_nov_cataj = ""; }
	
	$src_prov_dec_cataj	= $_POST["prov_dec_cataj"];
	if($str_dec == 2 || $str_dec == 1) { $edit_prov_dec_cataj = "dec_provider = '".$src_prov_dec_cataj."',"; } else {  $edit_prov_dec_cataj = ""; }
	
	$src_prov_jan_cataj	= $_POST["prov_jan_cataj"];
	if($str_jan == 2 || $str_jan == 1) { $edit_prov_jan_cataj = "jan_provider = '".$src_prov_jan_cataj."',"; } else {  $edit_prov_jan_cataj = ""; }
	
	$src_prov_feb_cataj	= $_POST["prov_feb_cataj"];
	if($str_feb == 2 || $str_feb == 1) { $edit_prov_feb_cataj = "feb_provider = '".$src_prov_feb_cataj."',"; } else {  $edit_prov_feb_cataj = ""; }
	
	$src_prov_mar_cataj	= $_POST["prov_mar_cataj"];
	if($str_mar == 2 || $str_mar == 1) { $edit_prov_mar_cataj = "mar_provider = '".$src_prov_mar_cataj."',"; } else {  $edit_prov_mar_cataj = ""; }
	
	$src_prov_apr_cataj	= $_POST["prov_apr_cataj"];
	if($str_apr == 2 || $str_apr == 1) { $edit_prov_apr_cataj = "apr_provider = '".$src_prov_apr_cataj."',"; } else {  $edit_prov_apr_cataj = ""; }
	
	$src_prov_may_cataj	= $_POST["prov_may_cataj"];
	if($str_may == 2 || $str_may == 1) { $edit_prov_may_cataj = "may_provider = '".$src_prov_may_cataj."',"; } else {  $edit_prov_may_cataj = ""; }
	
	$src_prov_jul_cataj	= $_POST["prov_jun_cataj"];
	if($str_jun == 2 || $str_jun == 1) { $edit_prov_jun_cataj = "jun_provider = '".$src_prov_jun_cataj."',"; } else {  $edit_prov_jun_cataj = ""; }
	
	//here we go again baby,....
	$src_update_value_cataj	= 
								"
									update tunggakan set
									$edit_jul_cataj
									$edit_aug_cataj
									$edit_sep_cataj
									$edit_oct_cataj
									$edit_nov_cataj
									$edit_dec_cataj
									$edit_jan_cataj
									$edit_feb_cataj
									$edit_mar_cataj
									$edit_apr_cataj
									$edit_may_cataj
									$edit_jun_cataj									
									$edit_prov_jul_cataj
									$edit_prov_aug_cataj
									$edit_prov_sep_cataj
									$edit_prov_oct_cataj
									$edit_prov_nov_cataj
									$edit_prov_dec_cataj
									$edit_prov_jan_cataj
									$edit_prov_feb_cataj
									$edit_prov_mar_cataj
									$edit_prov_apr_cataj
									$edit_prov_may_cataj
									$edit_prov_jun_cataj
									jenis_tunggakan = '$src_jenis_tunggakan'
									
									where
									
									no_sisda = '$srch_no_sisda' and
									periode = '$srch_periode' and
									jenis_tunggakan = '$src_jenis_tunggakan'
									
								"; //echo $src_update_value_cataj;
	$query_update_value_cataj	= mysqli_query($mysql_connect, $src_update_value_cataj) or die ("There is an error with mysql: ".mysql_error());
	
	if($query_update_value_cataj) {
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
		$redirect_url	= "page/page_edit_nominal_special_case_redirect.php?t=$src_jenis_tunggakan&no_sisda=$srch_no_sisda&jenjang=$srch_jenjang&tingkat=$srch_tingkat&periode=$srch_periode";
		$redirect_text	= "Data tagihan sudah diperbarui";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	} else { echo "Nama bank gagal ditambahkan, hubungi administator"; }
} else { echo "Anda tidak dapat mengakses halaman ini, hubungin administrator"; }
?>