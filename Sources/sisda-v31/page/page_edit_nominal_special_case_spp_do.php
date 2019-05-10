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
							tunggakan.january,
							tunggakan.february,
							tunggakan.march,
							tunggakan.april,
							tunggakan.may,
							tunggakan.june,
							tunggakan.july,
							tunggakan.august,
							tunggakan.september,
							tunggakan.october,
							tunggakan.november,
							tunggakan.december,
							siswa_finance.nama_siswa,
							siswa_finance.kelas
							from tunggakan,siswa_finance
							where
							tunggakan.no_sisda = '$srch_no_sisda' and
							tunggakan.jenis_tunggakan = 'spp' and
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
        <td id="text_title_page1" align="center">Edit Nominal SPP<br /></td>
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
				
				function read_only($pref2) {
				
					if($pref2 == 4  || $pref2 == 5 || $pref2 == 6 || $pref2 == 7) { echo "style='background-color:#669900; color:#ffffff; text-align:center; border:0px;' readonly='readonly' title='Sudah dibayar / tidak ada tagihan (tidak dapat diedit)'"; }
					else { echo "style='text-align:center;'"; }
					
				}
				?>
                <tr height="25" id="text_normal_black" bgcolor="#f1f1f1">
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["july"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["july"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["august"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["august"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["september"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["september"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["october"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["october"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["november"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["november"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["december"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["december"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["january"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["january"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["february"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["february"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["march"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["march"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["april"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["april"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["may"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["may"]; ?></td>
                    <td align="center"  <?PHP $pref = substr($row_get_tunggakan["june"],0,1); text_color($pref); ?>><?PHP echo $row_get_tunggakan["june"]; ?></td>
                </tr>
                <form method="post" name="reg_adm_siswa" action="engine.php?case=edit_nominal_special_case_spp">
                <input type="hidden" name="nama_siswa" value="<?PHP echo srch_nama_siswa; ?>" />
                <input type="hidden" name="jenjang" value="<?PHP echo $srch_jenjang; ?>" />
                <input type="hidden" name="tingkat" value="<?PHP echo $srch_tingkat; ?>" />
                <input type="hidden" name="no_sisda" value="<?PHP echo $srch_no_sisda; ?>" />
                <input type="hidden" name="periode" value="<?PHP echo $srch_periode; ?>" />
                <tr height="30" id="text_normal_black" bgcolor="#ffffff">
                    <td align="center"><input type="text" size="7" name="val_jul_spp" value="<?PHP echo substr($row_get_tunggakan["july"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["july"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_aug_spp" value="<?PHP echo substr($row_get_tunggakan["august"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["august"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_sep_spp" value="<?PHP echo substr($row_get_tunggakan["september"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["september"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_oct_spp" value="<?PHP echo substr($row_get_tunggakan["october"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["october"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_nov_spp" value="<?PHP echo substr($row_get_tunggakan["november"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["november"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_dec_spp" value="<?PHP echo substr($row_get_tunggakan["december"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["december"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_jan_spp" value="<?PHP echo substr($row_get_tunggakan["january"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["january"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_feb_spp" value="<?PHP echo substr($row_get_tunggakan["february"],2); ?>" <?PHP $pref2 = substr($row_get_tunggakan["february"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_mar_spp" value="<?PHP echo substr($row_get_tunggakan["march"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["march"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_apr_spp" value="<?PHP echo substr($row_get_tunggakan["april"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["april"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_may_spp" value="<?PHP echo substr($row_get_tunggakan["may"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["may"],0,1); read_only($pref2); ?> /></td>
                    <td align="center"><input type="text" size="7" name="val_jun_spp" value="<?PHP echo substr($row_get_tunggakan["june"],2); ?>"  <?PHP $pref2 = substr($row_get_tunggakan["june"],0,1); read_only($pref2); ?> /></td>
                </tr>
                <tr>
                	<td height="30"></td>
                </tr>
                <tr>
                	<td align="center" colspan="12"><input type="submit" value="Edit data tunggakan SPP" style="width:250px; height:50px; background-color:#663333; color:#FFFFFF;" /></td>
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