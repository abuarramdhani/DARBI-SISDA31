<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	$chk_sekolah_asl 	= empty($_POST["chk_sekolah_asl"]) ? "" : $_POST["chk_sekolah_asl"];
	$chk_no_sisda		= empty($_POST["chk_no_sisda"]) ? "" : $_POST["chk_no_sisda"];
	//echo "<h1>".$chk_sekolah_asl."</h1>";
	//echo "<h1>".$chk_no_sisda."</h1>";
	
	if($chk_no_sisda != "" || $chk_sekolah_asl != "") { 
		
		$adm_ok	= "ok";
		
		if($chk_no_sisda != "") {
		
			$src_chk_no_sisda_exist 	= "select nama_siswa,nama_ayah,nama_bunda,telp_ayah,telp_bunda from siswa where no_sisda = '$chk_no_sisda'";
			$query_chk_no_sisda_exist 	= mysqli_query($mysql_connect, $src_chk_no_sisda_exist) or die(mysql_error());
			$num_chk_no_sisda_exist		= mysql_num_rows($query_chk_no_sisda_exist);
			
			if($num_chk_no_sisda_exist != 0) {
			
				$no_sisda_not_found = "ketemu";
				
				$get_chk_no_sisda_exist	= mysql_fetch_array($query_chk_no_sisda_exist);
			
				$from_db_nama_siswa	= $get_chk_no_sisda_exist["nama_siswa"];
				$from_db_nama_ayah	= $get_chk_no_sisda_exist["nama_ayah"];
				$from_db_nama_bunda	= $get_chk_no_sisda_exist["nama_bunda"];
				$from_db_telp_ayah	= $get_chk_no_sisda_exist["telp_ayah"];
				$from_db_telp_bunda	= $get_chk_no_sisda_exist["telp_bunda"];
				
			} else  {
			
				$no_sisda_not_found = "gak ketemu";
			
			}
			
		} else {
		
			$no_sisda_not_found = "gak ketemu";
			
		}
		
	} else {
	
		$adm_ok == "gak ok";
	
	}
	
	if($adm_ok == "ok") {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Registrasi Administrasi Siswa Baru</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
        	<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_adm_siswa_next">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="45">
                    <td width="200" id="text_normal_black" colspan="4"><b>Data Siswa</b></td>
                </tr>
                <?PHP if($no_sisda_not_found == "gak ketemu") { ?>
            	<tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_siswa" size="78" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Ayah / Bunda</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_ayah" size="35" /> / <input type="text" name="nama_bunda" size="35" />	
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Telepon Ayah / Bunda</td>
                    <td width="5"></td>
                    <td><input type="text" name="telp_ayah" size="35" /> / <input type="text" name="telp_bunda" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Asal Sekolah</td>
                    <td width="5"></td>
                    <td id="text_normal_black"><input type="hidden" name="stat_sekolah_asal" value="umum" /><input type="text" name="nama_sekolah_asal" size="35" value="<?= $chk_sekolah_asl; ?>" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <?PHP
				} if($no_sisda_not_found == "ketemu") {
				?>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_siswa" size="78" value="<?= $from_db_nama_siswa; ?>" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Ayah / Bunda</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_ayah" size="35" value="<?= $from_db_nama_ayah; ?>" /> / <input type="text" name="nama_bunda" size="35" value="<?= $from_db_nama_bunda; ?>" />	
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Telepon Ayah / Bunda</td>
                    <td width="5"></td>
                    <td><input type="text" name="telp_ayah" size="35" value="<?= $from_db_telp_ayah; ?>" /> / <input type="text" name="telp_bunda" size="35" value="<?= $from_db_telp_bunda; ?>" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Asal Sekolah</td>
                    <td width="5"></td>
                    <td id="text_normal_black"><input type="hidden" name="stat_sekolah_asal" value="darbi" /><input type="text" name="nama_sekolah_asal" size="35" value="Darul Abidin" />
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <?PHP } ?>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Kategori SPP</td>
                    <td width="5"></td>
                    <td id="text_normal_black">
                    &nbsp;Umum <input type="radio" name="kat_status_anak" value="umum" /> &nbsp;&nbsp;&nbsp; Anak guru<input type="radio" name="kat_status_anak" value="anak guru" />                                         
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tanggal Daftar</td>
                    <td width="5"></td>
                    <td><select name="tanggal_daftar"><?PHP include("include/cur_date_opt.php"); ?></select><select name="month"><?PHP include("include/cur_month_opt.php"); ?></select><select name="year"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>     
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tingkat</td>
                    <td width="5"></td>
                    <td>
                    <select name="tingkat">
                    <option value="">Pilih</option>
                    <option value="Toddler">Toddler</option>
                    <option value="PG">PG</option>
                    <option value="TK A">TK A</option>
                    <option value="TK B">TK B</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <?PHP
				$cur_year	= date("Y");
				$cur_month	= strtolower(date("F"));
				
				if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	
					$edu_year	= ($cur_year-1)." - ".$cur_year;
					$edu_year2	= $cur_year." - ".($cur_year+1);
				} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
					$edu_year	= $cur_year." - ".($cur_year+1);
					$edu_year2	= ($cur_year+1)." - ".($cur_year+2);
				}
				?>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Periode terdaftar siswa</td>
                    <td width="5"></td>
                    <td>
                    <select name="bulan_terdaftar">
                    <option value="">Pilih</option>
                    <option value="1">Juli</option>
                    <option value="2">Agustus</option>
                    <option value="3">September</option>
                    <option value="4">Oktober</option>
                    <option value="5">November</option>
                    <option value="6">Desember</option>
                    <option value="7">Januari</option>
                    <option value="8">Februari</option>
                    <option value="9">Maret</option>
                    <option value="10">April</option>
                    <option value="11">Mei</option>
                    <option value="12">Juni</option>
                    </select>
                    
                    </select>
					<select name="periode">
                    <option value="<?PHP echo $edu_year; ?>" selected="selected"><?PHP echo $edu_year; ?></option>
                    <option value="<?PHP echo $edu_year2; ?>"><?PHP echo $edu_year2; ?></option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Gelombang Tes</td>
                    <td width="5"></td>
                    <td>
						<select name="shift_test">
                        <option value="">Pilih</option>
                        <?PHP
						for($shift = 1; $shift < 5; $shift++) {
							echo "<option value='$shift'> $shift</option>";
						}
						?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tahap I</td>
                    <td width="5"></td>
                    <td><select name="fase_1_date"><?PHP include("include/cur_date_opt.php"); ?></select><select name="fase_1_month"><?PHP include("include/cur_month_opt.php"); ?></select><select name="fase_1_year"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tahap II</td>
                    <td width="5"></td>
                    <td><select name="fase_2_date"><?PHP include("include/cur_date_opt.php"); ?></select><select name="fase_2_month"><?PHP include("include/cur_month_opt.php"); ?></select><select name="fase_2_year"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="15"></td>
                </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                	<td width="10"></td>  
                    <td width="200"></td>
                    <td width="5"></td>                  
                    <td colspan="3" id="text_normal_red">
                    Pengaturan:<br />
                    - nominal biaya masuk<br />
                    - SPP<br />
                    - Rumah Berbagi<br />
                    - Daftar ulang<br />
                    - Berikut proses penyimpanan data ini, <br />
                    Silahkan klik tombol <strong>Lanjutkan</strong><br />
                    Untuk menentukan <u>kelas siswa</u> dan <u>mengupload photo siswa</u>, dapat dilakukan di halaman <strong>Lihat Semua Data (Modifikasi)</strong>
                    </td>
                </tr>
            	<tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10"></td>  
                    <td width="200"></td>
                    <td width="5"></td>                  
                    <td colspan="3"><!-- the verification function returned here, in submit button, check the whole script below --><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Lanjutkan" onClick="return verification();"/> <input style="background:#000000; color:#ffffff;" type="reset" value="Kosongkan" /></td>
                </tr>
            </table>     
            </form>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td height="20"></td>
                </tr>
            </table>     
            <!--================================ end here =================================-->
        </td>
        <td></td>
    </tr>
</table>
<?PHP
	} else { echo "status calon siswa tidak diketahui apakah dari Darbi atau selain Darbi."; }//if($chk_no_sisda == "" && $chk_sekolah_asl == "") 
} //if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {
?>

<?PHP

/*
<script type="text/javascript">
//this script is for dependent field
var jenjanglist=document.reg_adm_siswa.jenjang
var kelaslist=document.reg_adm_siswa.kelas

var kelas=new Array()
kelas[0]=""
kelas[1]= 
			["White Rabbit|White Rabbit",
			"Black Rabbit|Black Rabbit"]
kelas[2]= 
			["Yellow Ant|Yellow Ant",
			"Black Ant|Black Ant",
			"Red Ant|Red Ant"]
kelas[3]= 
			["Little Butterfly|Little Butterfly",
			"Little Bee|Little Bee",
			"Little Bird|Little Bird"]
kelas[4] = 
			["Little Camel|Little Camel",
			"Little Cat|Little Cat",
			"Little Cow|Little Cow"]
kelas[5]=
			["1 Makkah|1 Makkah", 
			"1 Madinah|1 Madinah", 
			"1 Marwah|1 Marwah", 
			"2 Makkah|2 Makkah", 
			"2 Madinah|2 Madinah", 
			"2 Marwah|2 Marwah",
			"3 Makkah|3 Makkah", 
			"3 Madinah|3 Madinah", 
			"3 Marwah|3 Marwah",
			"4 Makkah|4 Makkah", 
			"4 Madinah|4 Madinah", 
			"5 Marwah|5 Marwah",
			"6 Makkah|6 Makkah", 
			"6 Madinah|6 Madinah", 
			"6 Marwah|6 Marwah"]
kelas[6]=
			["7 Cordova A|7 Cordova A", 
			"7 Cordova B|7 Cordova B", 
			"7 Cordova C|7 Cordova C", 
			"7 Cordova D|7 Cordova D", 
			"8 Cordova A|8 Cordova A", 
			"8 Cordova B|8 Cordova B", 
			"8 Cordova C|8 Cordova C", 
			"8 Cordova D|8 Cordova D",
			"9 Cordova A|9 Cordova A", 
			"9 Cordova B|9 Cordova B", 
			"9 Cordova C|9 Cordova C", 
			"9 Cordova D|9 Cordova D"]

function upkelas(selectedcitygroup){
kelaslist.options.length=0
if (selectedcitygroup>0){
for (i=0; i<kelas[selectedcitygroup].length; i++)
kelaslist.options[kelaslist.options.length]=new Option(kelas[selectedcitygroup][i].split("|")[0], kelas[selectedcitygroup][i].split("|")[1])
}
}
</script>

<script language="javascript">
//this script is for show/hidden table function
imageX1='plus';
imageX2='plus';
imageX3='plus';
imageX4='plus';

function toggleDisplay(e){
imgX="imagePM"+e;
tableX="table"+e;
imageX="imageX"+e;
tableLink="tableHref"+e;
imageXval=eval("imageX"+e);
element = document.getElementById(tableX).style;
 if (element.display=='none') {element.display='block';}
 else {element.display='none';}
 if (imageXval=='plus') {document.getElementById(imgX).src='images/minus.png';eval("imageX"+e+"='minus';");document.getElementById(tableLink).title='Hide Table #'+e+'a';}
 else {document.getElementById(imgX).src='images/plus.png';eval("imageX"+e+"='plus';");document.getElementById(tableLink).title='Show Table #'+e+'a';}
}
</script>

*/ 
?>

<SCRIPT type="text/javascript" >
function verification() 
{ 
	
	if(document.reg_adm_siswa.nama_siswa.value == "")
	{
		alert('Field "Nama siswa" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.nama_ayah.value == "")
	{
		alert('Field "Nama ayah" tidak boleh kosong');
		return false;
	}	
	if(document.reg_adm_siswa.nama_bunda.value == "")
	{
		alert('Field "Nama bunda" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.telp_ayah.value == "" && document.reg_adm_siswa.telp_bunda.value == "")
	{
		alert('Lengkapi no telp ayah atau no telp bunda');
		return false;
	}	
	if(document.reg_adm_siswa.stat_sekolah_asal.value == "")
	{
		alert('Field "Kategori Asal sekolah" tidak boleh kosong');
		return false;
		
	}
	if(document.reg_adm_siswa.kat_status_anak[0].checked == "" && document.reg_adm_siswa.kat_status_anak[1].checked == "")
	{
		alert('Field "Kategori SPP" hasus dipilih');
		return false;
	}
	if(document.reg_adm_siswa.tanggal_daftar.value == "")
	{
		alert('Field "Tanggal daftar tidak" boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.month.value == "")
	{
		alert('Field "Bulan daftar" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.year.value == "")
	{
		alert('Field "Tahun daftar" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.tingkat.value == "")
	{
		alert('Field "Tingkat" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.bulan_terdaftar.value == "")
	{
		alert('Field "Bulan periode terdaftar" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.periode.value == "")
	{
		alert('Field "Periode" tidak boleh kosong');
		return false;
	}
	<?PHP
	//gak boleh pilih waktu yang telah berlalu...hehehe kayak sinetron kan :D....
	$nor_cur_month 		= date("n");
	
	if($nor_cur_month == 1) { $chk_cur_month = 7; }
	if($nor_cur_month == 2) { $chk_cur_month = 8; }
	if($nor_cur_month == 3) { $chk_cur_month = 9; }
	if($nor_cur_month == 4) { $chk_cur_month = 10; }
	if($nor_cur_month == 5) { $chk_cur_month = 11; }
	if($nor_cur_month == 6) { $chk_cur_month = 12; }
	if($nor_cur_month == 7) { $chk_cur_month = 1; }
	if($nor_cur_month == 8) { $chk_cur_month = 2; }
	if($nor_cur_month == 9) { $chk_cur_month = 3; }
	if($nor_cur_month == 10) { $chk_cur_month = 4; }
	if($nor_cur_month == 11) { $chk_cur_month = 5; }
	if($nor_cur_month == 12) { $chk_cur_month = 6; }
	
	
	$chk_cur_month_name	= date("F");
	$chk_cur_year  		= $edu_year;
	?>
	
	if(document.reg_adm_siswa.periode.value == "<?PHP echo $chk_cur_year; ?>")
	{
		if(Number(document.reg_adm_siswa.bulan_terdaftar.value) < Number("<?PHP echo $chk_cur_month; ?>"))
		{
		
			alert('Waktu yang dipilih untuk bulan dan periode terdaftar sudah terlewat. Waktu minimal yang diizinkan adalah <?PHP echo $chk_cur_month_name; ?> / <?PHP echo $chk_cur_year; ?>');
			return false;
		
		}
	}
	if(document.reg_adm_siswa.shift_test.value == "")
	{
		alert('Field "Gelombang tes" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.fase_1_date.value == "")
	{
		alert('Field "Tahap 1 (tanggal)" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.fase_1_month.value == "")
	{
		alert('Field "Tahap 1 (bulan)" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.fase_1_year.value == "")
	{
		alert('Field "Tahap 1 (tahun)" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.fase_2_date.value == "")
	{
		alert('Field "Tahap 2 (tanggal)" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.fase_2_month.value == "")
	{
		alert('Field "Tahap 2 (bulan)" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.fase_3_year.value == "")
	{
		alert('Field "Tahap 2 (tahun)" tidak boleh kosong');
		return false;
	}
	
return true;	
}

</SCRIPT>