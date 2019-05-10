<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	//We need to know what page is this (including their GET variable in URL
	//We'll send it to prod page.
	include "include/url.php";
	$url = curPageURL();
				
	$srch_nama_siswa 	= mysql_real_escape_string($_POST['nama_siswa']);
	$srch_jenjang 		= mysql_real_escape_string($_POST['jenjang']);
	$srch_tingkat 		= mysql_real_escape_string($_POST['tingkat']);			  
	$srch_no_sisda 		= mysql_real_escape_string($_POST['nosisdanya']);
	$srch_periode 		= mysql_real_escape_string($_POST['periode']);
	
	$src_get_tunggakan	= "
							select 
							tunggakan.jenis_tunggakan,
							tunggakan.status,
							tunggakan.jan_cataj,
							tunggakan.feb_cataj,
							tunggakan.mar_cataj,
							tunggakan.apr_cataj,
							tunggakan.may_cataj,
							tunggakan.jun_cataj,
							tunggakan.jul_cataj,
							tunggakan.aug_cataj,
							tunggakan.sep_cataj,
							tunggakan.oct_cataj,
							tunggakan.nov_cataj,
							tunggakan.dec_cataj,
							tunggakan.jan_provider,
							tunggakan.feb_provider,
							tunggakan.mar_provider,
							tunggakan.apr_provider,
							tunggakan.may_provider,
							tunggakan.jun_provider,
							tunggakan.jul_provider,
							tunggakan.aug_provider,
							tunggakan.sep_provider,
							tunggakan.oct_provider,
							tunggakan.nov_provider,
							tunggakan.dec_provider,
							siswa_finance.nama_siswa,
							siswa_finance.kelas
							from tunggakan,siswa_finance
							where
							tunggakan.no_sisda = '$srch_no_sisda' and
							tunggakan.jenis_tunggakan = 'antar_jemput' and
							tunggakan.periode = '$srch_periode' and
							siswa_finance.no_sisda =  '$srch_no_sisda' and
							siswa_finance.aktif = '1' 
							";
							
	$query_get_tunggakan 	= mysqli_query($mysql_connect, $src_get_tunggakan) or die(mysql_error());
	$row_get_tunggakan		= mysql_fetch_array($query_get_tunggakan);	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Edit Nominal Antar Jemput<br /></td>
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
             <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td align="center" id="text_normal_black">
                    <span style="color:#3366CC; font-size:16px; font-weight:bold;">(<?PHP echo $row_get_tunggakan["nama_siswa"]; ?>/<?PHP echo $srch_no_sisda; ?>/<?PHP echo $row_get_tunggakan["kelas"]; ?>)</span>
                    <br />
                     <span style="color:#663399; font-size:14px; font-weight:bold;">Periode: <?PHP echo $srch_periode; ?></span>
                    </td>
                 </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
            	<tr>
                	<td height="40" colspan="12"></td>
                </tr>
            	<tr height="25" id="text_normal_white" style="font-weight:bold;" bgcolor="#999999">
                    <td align="center">Jul</td>
                    <td align="center">Aug</td>
                    <td align="center">Sep</td>
                    <td align="center">Oct</td>
                    <td align="center">Nov</td>
                    <td align="center">Dec</td>
                    <td align="center">Jan</td>
                    <td align="center">Feb</td>
                    <td align="center">Mar</td>
                    <td align="center">Apr</td>
                    <td align="center">May</td>
                    <td align="center">Jun</td>
                </tr>
                <?PHP
                function text_color($pref) {
				
					if($pref == 4  || $pref == 5 || $pref == 6 || $pref == 7) { echo "style='color:#cc0000;' title='Sudah dibayar / tidak ada tagihan'"; }
					if($pref == 2  || $pref == 1) { echo "style='color:#33cc99;' title='Belum dilakukan pembayaran'"; }
					if($pref == 0) { echo "style='color:#333333;' title='Belum ditagihkan'"; }
					
				}
				
				function read_only($prevval_cataj) {
				
					$pref2 	= substr($prevval_cataj,0,1);
					$value2 = substr($prevval_cataj,2);
					
					if($pref2 == 4  || $pref2 == 5 || $pref2 == 6 || $pref2 == 7) { echo "style='background-color:#669900; color:#ffffff; text-align:center; border:0px;' readonly='readonly' title='Sudah dibayar / tidak ada tagihan (tidak dapat diedit)'"; }
					else if ($pref2 == 0) { echo "style='background-color:#cc6600; color:#ffffff; text-align:center; border:0px;' readonly='readonly' title='Belum jatuh tempo (tidak dapat diedit)'"; }
					else if ($pref2 == 1) { if($value2 == "x") { echo "style='background-color:#3399ff; color:#ffffff; text-align:center; border:0px;' readonly='readonly' title='Jumlah hari antar_jemput belum didefiniskan (tidak dapat diedit)'"; } else { echo "style='text-align:center;'"; }  }
					else { echo "style='text-align:center;'"; }
					
				}
				
				function provider($prov,$prov_val) {
				
					$pref_prov 		= substr($prov,0,1);
					$val_for_prov	= substr($prov,2);
					
					if($prov_val == "") { $show_pro_val = ""; } else { $show_pro_val = $prov_val; }
					
					if($pref_prov == 4  || $pref_prov == 5 || $pref_prov == 6 || $pref_prov == 7) { echo "style='background-color:#669900; color:#ffffff; text-align:center; border:0px;' readonly='readonly' value='".$show_pro_val."' title='Sudah dibayar / tidak ada tagihan (tidak dapat diedit)'"; }
					else if($pref_prov == 1) { if($val_for_prov == 'x') { echo "style='background-color:#0099cc; color:#ffffff; text-align:center; border:0px;' readonly='readonly' value='' title='Jumlah hari antar_jemput belum ditentukan (tidak dapat diedit)'"; } else { echo "style='text-align:center;' value='".$prov_val."'"; } }
					else if ($pref_prov == 0) { echo "style='background-color:#cc6600; color:#ffffff; text-align:center; border:0px;' readonly='readonly' title='Belum jatuh tempo (tidak dapat diedit)'"; }
					else { echo "style='text-align:center;' value='".$prov_val."'"; }
					
				}
				?>
                <tr height="25" id="text_normal_black" bgcolor="#f1f1f1">
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["jul_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["jul_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["aug_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["aug_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["sep_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["sep_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["oct_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["oct_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["nov_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["nov_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["dec_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["dec_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["jan_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["jan_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["feb_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["feb_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["mar_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["mar_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["apr_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["apr_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["may_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["may_cataj"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["jun_cataj"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["jun_cataj"]; ?></td>
                </tr>
                <form method="post" name="reg_adm_siswa" action="engine.php?case=edit_nominal_special_case_cataj">
                <input type="hidden" name="nama_siswa" value="<?PHP echo srch_nama_siswa; ?>" />
                <input type="hidden" name="jenjang" value="<?PHP echo $srch_jenjang; ?>" />
                <input type="hidden" name="tingkat" value="<?PHP echo $srch_tingkat; ?>" />
                <input type="hidden" name="no_sisda" value="<?PHP echo $srch_no_sisda; ?>" />
                <input type="hidden" name="periode" value="<?PHP echo $srch_periode; ?>" />
                <tr height="30" id="text_normal_black" bgcolor="#ffffff">
                    <td align="center"><input type="text" size="7" name="val_jul_cataj" value="<?PHP echo substr($row_get_tunggakan["jul_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["jul_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_aug_cataj" value="<?PHP echo substr($row_get_tunggakan["aug_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["aug_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_sep_cataj" value="<?PHP echo substr($row_get_tunggakan["sep_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["sep_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_oct_cataj" value="<?PHP echo substr($row_get_tunggakan["oct_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["oct_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_nov_cataj" value="<?PHP echo substr($row_get_tunggakan["nov_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["nov_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_dec_cataj" value="<?PHP echo substr($row_get_tunggakan["dec_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["dec_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_jan_cataj" value="<?PHP echo substr($row_get_tunggakan["jan_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["jan_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_feb_cataj" value="<?PHP echo substr($row_get_tunggakan["feb_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["feb_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_mar_cataj" value="<?PHP echo substr($row_get_tunggakan["mar_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["mar_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_apr_cataj" value="<?PHP echo substr($row_get_tunggakan["apr_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["apr_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_may_cataj" value="<?PHP echo substr($row_get_tunggakan["may_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["may_cataj"]; read_only($prevval_cataj); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_jun_cataj" value="<?PHP echo substr($row_get_tunggakan["jun_cataj"],2); ?>"  <?PHP $prevval_cataj = $row_get_tunggakan["jun_cataj"]; read_only($prevval_cataj); ?> /></td>
                </tr>
                <tr height="30" id="text_normal_black" bgcolor="#f1f1f1">
                    <td align="center"><input type="text" size="7" name="prov_jul_cataj" <?PHP $prov_val = $row_get_tunggakan["jul_provider"]; $prov = $row_get_tunggakan["jul_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_aug_cataj" <?PHP $prov_val = $row_get_tunggakan["aug_provider"]; $prov = $row_get_tunggakan["aug_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_sep_cataj" <?PHP $prov_val = $row_get_tunggakan["sep_provider"]; $prov = $row_get_tunggakan["sep_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_oct_cataj" <?PHP $prov_val = $row_get_tunggakan["oct_provider"]; $prov = $row_get_tunggakan["oct_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_nov_cataj" <?PHP $prov_val = $row_get_tunggakan["nov_provider"]; $prov = $row_get_tunggakan["nov_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_dec_cataj" <?PHP $prov_val = $row_get_tunggakan["dec_provider"]; $prov = $row_get_tunggakan["dec_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_jan_cataj" <?PHP $prov_val = $row_get_tunggakan["jan_provider"]; $prov = $row_get_tunggakan["jan_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_feb_cataj" <?PHP $prov_val = $row_get_tunggakan["feb_provider"]; $prov = $row_get_tunggakan["feb_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_mar_cataj" <?PHP $prov_val = $row_get_tunggakan["mar_provider"]; $prov = $row_get_tunggakan["mar_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_apr_cataj" <?PHP $prov_val = $row_get_tunggakan["apr_provider"]; $prov = $row_get_tunggakan["apr_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_may_cataj" <?PHP $prov_val = $row_get_tunggakan["may_provider"]; $prov = $row_get_tunggakan["may_cataj"]; provider($prov,$prov_val); ?> /></td>
                    <td align="center"><input type="text" size="7" name="prov_jun_cataj" <?PHP $prov_val = $row_get_tunggakan["jun_provider"]; $prov = $row_get_tunggakan["jun_cataj"]; provider($prov,$prov_val); ?> /></td>
                </tr>
                <tr>
                	<td height="30"><input type="hidden" name="jenis_tunggakan" value="antar_jemput" /></td>
                </tr>
                <tr>
                	<td align="center" colspan="12"><input type="submit" value="Edit data tunggakan Antar Jemput" style="width:250px; height:50px; background-color:#663333; color:#FFFFFF;" /></td>
                </tr>
                </form>
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

<script language="javascript">
function toggle(source) {
  checkboxes = document.getElementsByName('pilih[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

<SCRIPT type="text/javascript" >
function verification() { 
	
	if(document.add_del_antar_jemput.the_month.value == "") {
		alert('Field "Bulan" tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.edu_year.value == "") {
		alert('Field "Tahun ajaran" tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.antar_jemput_name.value == "") {
		alert('Field "Penyedia layanan antar-jemput" tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.day_antar_jemput.value == "") {
		alert('Field "Jumlah hari" tidak boleh kosong');
		return false;
	}	
	return true;	
}

function verification1() {

	if(document.add_del_antar_jemput.the_month.value == "") {
		alert('Field "Bulan" yang akan dihapus tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.edu_year.value == "") {
		alert('Field "Tahun ajaran" yang akan dihapus tidak tidak boleh kosong');
		return false;
	}
	return true;
}
</SCRIPT>