<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {
	
	
	//We need the 'current page number' to redirect the page back to where they are coming from
	$p = (!isset($_GET["p"])) ? 1 : htmlspecialchars($_GET["p"]);
	
	//We have to guarantee variable no_sisda of every data that want to be updated is not empty
	$no_sisda = (!isset($_GET["no"])) ? "" : htmlspecialchars($_GET["no"]);
	
	if($no_sisda == "") {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=preview_adm_siswa&p=".$p;
		$redirect_text	= "Data siswa yang akan anda update tidak diketahui";
		
		$need_redirect	= true;
		include_once ("include/redirect_noheader.php");
		
	} else {
	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Update Data Primer Siswa</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
</table>
    <?PHP 
	$src_select_data_siswa		= "select * from siswa where no_sisda = '$no_sisda'";
	$query_select_data_siswa	= mysqli_query($mysql_connect, $src_select_data_siswa) or die("There is an error with mysql: ".mysql_error());
	$num_select_data_siswa		= mysql_num_rows($query_select_data_siswa);
	
	if($num_select_data_siswa != 0) {
	
	$row_select_data_siswa		= mysql_fetch_array($query_select_data_siswa);
	?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td width="30"></td>
    	<td colspan="3" align="left"><input type="button" value="Kembali" onclick="history.go(-1)" style="width:208px; height:35px;"/></td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td height="10">&nbsp;</td>
    </tr>
    <tr>
    	<td width="30"></td>
        <td width="200" align="center" valign="top" id="text_normal_black">
        <?PHP
		$img_user = empty($row_select_data_siswa["photo"]) ? "no_photo.png" : $row_select_data_siswa["photo"];
		?>
		<?PHP if($img_user != "no_photo.png") { ?><a href="photo/<?= $img_user; ?>" target="_blank"><img src="photo/<?= $img_user; ?>" width="200"></a>
        <?PHP } else { ?><img src="photo/<?= $img_user; ?>" width="200"><?PHP } ?>
        <br />
        <b>Klik photo untuk men-download</b>
        </td>
        <td width="10"></td>
    	<td align="center">        	
			<form method="post" name="reg_adm_siswa" enctype="multipart/form-data" action="engine.php?case=reg_adm_siswa_update">             
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <input type="hidden" name="no_sisda" value="<?PHP echo $row_select_data_siswa["no_sisda"]; ?>" />
            	<tr height="30">                	
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white" align="left">No Sisda</td>
                    <td width="10"></td>
                    <td align="left" style="font-size:16px; color:#990000; font-family:verdana;"><b><?PHP echo $row_select_data_siswa["no_sisda"]; ?></b></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white" align="left">Tahun Pendidikan</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" value="<?PHP echo $row_select_data_siswa["periode"]; ?>" disabled="disabled"/></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white" align="left">Jenjang</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" value="<?PHP echo $row_select_data_siswa["jenjang"]; ?>" disabled="disabled"/></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white" align="left">Tingkat</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" value="<?PHP echo $row_select_data_siswa["tingkat"]; ?>" disabled="disabled"/></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white" align="left">Gelombang test</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" value="<?PHP echo $row_select_data_siswa["gelombang_test"]; ?>" disabled="disabled" /></td>
                    <td width="10"></td>
                </tr>  
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white" align="left">Tahap 1</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" value="<?PHP echo $row_select_data_siswa["tahap1"]; ?>" disabled="disabled" /></td>
                    <td width="10"></td>
                </tr> 
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white" align="left">Tahap 2</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" value="<?PHP echo $row_select_data_siswa["tahap2"]; ?>" disabled="disabled" /></td>
                    <td width="10"></td>
                </tr> 
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white" align="left">NISN</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="nisn" value="<?PHP echo $row_select_data_siswa["nisn"]; ?>" /></td>
                    <td width="10"></td>
                </tr>  
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"><hr noshade="noshade" color="#666666" size="1" /></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Photo siswa</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="file" name="gambar"/></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Nama siswa</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="nama_siswa" value="<?PHP echo $row_select_data_siswa["nama_siswa"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Nama panggilan</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="nama_panggilan" value="<?PHP echo $row_select_data_siswa["nama_panggilan"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Tempat lahir</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="tempat_lahir" value="<?PHP echo $row_select_data_siswa["tempat_lahir"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <?PHP
				//this variable is used to define that we dont want to use <option> current date: selected
				//If the $src_not_cur is defined (true), so all of the <option> is not selected
				$src_not_cur = true;
				
				//defined date for being used on (selected option)
				$defined_date = substr($row_select_data_siswa["tanggal_lahir"],8,2);
				$defined_month = substr($row_select_data_siswa["tanggal_lahir"],5,2);
				$defined_year = substr($row_select_data_siswa["tanggal_lahir"],0,4);
				?>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Tanggal lahir</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black">
                    <select name="tanggal_lahir">
                    <option value="">tanggal</option>
                    <?PHP 
					$i_tgl = 0;
					
					while($i_tgl < 31) {
					
						$i_tgl++;
						
					?>                    
                    <option value="<?= $i_tgl; ?>"<?PHP if($defined_date == $i_tgl) { ?>selected="selected"<?PHP } ?>><?= $i_tgl; ?></option>
                    <?PHP
					}
					?>
					</select>
                    <select name="bulan_lahir">
                    <option value="">bulan</option>
                    <?PHP 
					$i_bln = 0;
					
					while($i_bln < 12) {
					
						$i_bln++;
						
					?>                    
                    <option value="<?= $i_bln; ?>"<?PHP if($defined_month == $i_bln) { ?>selected="selected"<?PHP } ?>><?= $i_bln; ?></option>
                    <?PHP
					}
					?>
                    </select>
                    <select name="tahun_lahir">
                     <option value="">Tahun</option>
                    <?PHP 
					$i_thn = 1989;
					
					while($i_thn < 2025) {
					
						$i_thn++;
						
					?>                    
                    <option value="<?= $i_thn; ?>"<?PHP if($defined_year == $i_thn) { ?>selected="selected"<?PHP } ?>><?= $i_thn; ?></option>
                    <?PHP
					}
					?>
                    </select></td>
                    <td width="10"></td>
                </tr>  
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Jenis_kelamin</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black">
                    <select name="jenis_kelamin">
                    <option value="">Pilih</option>
                    <option value="laki-laki" <?PHP if($row_select_data_siswa["jenis_kelamin"] == "laki-laki") { echo "selected"; } ?>>Laki-laki</option>
                    <option value="perempuan" <?PHP if($row_select_data_siswa["jenis_kelamin"] == "perempuan") { echo "selected"; } ?>>perempuan</option>
                    </select>
                    </td>
                    <td width="10"></td>
                </tr>  
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Nama ayah</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="nama_ayah" value="<?PHP echo $row_select_data_siswa["nama_ayah"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Nama bunda</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="nama_bunda" value="<?PHP echo $row_select_data_siswa["nama_bunda"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Kategory status anak</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black">
                    <select name="kat_status_anak">
                    <option value="">Pilih</option>
                    <option value="Umum" <?PHP if($row_select_data_siswa["kat_status_anak"] == "Umum") { echo "selected"; } ?>>Umum</option>
                    <option value="Anak pegawai" <?PHP if($row_select_data_siswa["kat_status_anak"] == "Anak pegawai") { echo "selected"; } ?>>Anak pegawai</option>
                    </select>
                    </td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Telepon ayah</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="telp_ayah" value="<?PHP echo $row_select_data_siswa["telp_ayah"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Telepon bunda</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="telp_bunda" value="<?PHP echo $row_select_data_siswa["telp_bunda"]; ?>" /></td>
                    <td width="10"></td>
                </tr> 
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Email orang tua</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="email_ortu" value="<?PHP echo $row_select_data_siswa["email_ortu"]; ?>" /></td>
                    <td width="10"></td>
                </tr> 
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Hubungi saya melalui</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black">
                    <select name="hub_saya_melalui">
                    <option value="">pilih</option>
                    <option value="Semua" <?PHP if($row_select_data_siswa["hub_saya_melalui"] == "Semua") { echo "selected";} ?>>Semua</option>
                    <option value="Surat" <?PHP if($row_select_data_siswa["hub_saya_melalui"] == "Surat") { echo "selected";} ?>>Surat</option>
                    <option value="Telepon rumah" <?PHP if($row_select_data_siswa["hub_saya_melalui"] == "Telepon rumah") { echo "selected";} ?>>Telepon rumah</option>
                    <option value="Handphone" <?PHP if($row_select_data_siswa["hub_saya_melalui"] == "Handphone") { echo "selected";} ?>>Handphone</option>
                    <option value="Email" <?PHP if($row_select_data_siswa["hub_saya_melalui"] == "Email") { echo "selected";} ?>>Email</option>
                    </select>
                    </td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Alamat</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><textarea name="alamat" rows="5" cols="40"><?PHP echo $row_select_data_siswa["alamat"]; ?></textarea></td>
                    <td width="10"></td>
                </tr>  
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">kota</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="kota" value="<?PHP echo $row_select_data_siswa["kota"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Kode pos</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="kodepos" value="<?PHP echo $row_select_data_siswa["kodepos"]; ?>" /></td>
                    <td width="10"></td>
                </tr> 
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Provinsi</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="provinsi" value="<?PHP echo $row_select_data_siswa["provinsi"]; ?>" /></td>
                    <td width="10"></td>
                </tr>  
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Negara</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="negara" value="<?PHP echo $row_select_data_siswa["negara"]; ?>" /></td>
                    <td width="10"></td>
                </tr> 
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Asal sekolah</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="asal_sekolah" value="<?PHP echo $row_select_data_siswa["asal_sekolah"]; ?>" /></td>
                    <td width="10"></td>
                </tr> 
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Status sekolah asal</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black">
                    <select name="stat_sekolah_asal">
                    <option value="">Pilih</option>
                    <option value="Umum" <?PHP if($row_select_data_siswa["stat_sekolah_asal"] == "Umum") { echo "selected"; } ?>>Umum</option>
                    <option value="Darbi" <?PHP if($row_select_data_siswa["stat_sekolah_asal"] == "Darbi") { echo "selected"; } ?>>Darbi</option>
                    </select>
                    </td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white" align="left">Nama saudara</td>
                    <td width="10"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="nama_saudara" value="<?PHP echo $row_select_data_siswa["nama_saudara"]; ?>" /></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>                
                <tr>
                	<td colspan="5" height="5"></td>
                </tr>
                <tr height="30">                	
                	<td width="10"></td>
                    <td width="200" id="text_normal_white" align="left"></td>
                    <td width="10"></td>
                    <td align="left"><input type="submit" value="Perbaharui data" style="width:200px;"/><input type="button" value="Batal" onclick="history.go(-1)"/></td>
                    <td width="10"></td>
                </tr>            
                <tr>
                	<td colspan="5" height="30"></td>
                </tr>
			</table>
			</form>           
		</td>
		<td width="30"></td>
	</tr>
	<?PHP
	}
	?>
</table>
<?PHP
	}
} else {	
	
	header("location:index.php");
		
}
?>