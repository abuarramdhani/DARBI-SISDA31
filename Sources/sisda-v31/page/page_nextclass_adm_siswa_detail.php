<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Detail data Kelas dan Finansial Siswa</td>
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
			//Load all user data////////////
			////////////////////////////////
			////////////////////////////////		
			$srch_id			= (empty($_GET['id'])) ? '' : $_GET['id'];
			
			$src_get_detail 	= "select * from siswa_finance where id = '$srch_id'";
			$query_get_detail	= mysqli_query($mysql_connect, $src_get_detail) or die("There is an error with mysql: ".mysql_error());
			$row_get_detail		= mysql_fetch_array($query_get_detail);
			?>
			<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_adm_siswa_redirect">             
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">No sisda</td>
                    <td width="5"></td>
                    <td><input type="text" name="no_sisda" size="25" value="<?PHP echo $row_get_detail["no_sisda"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Status aktif data</td>
                    <td width="5"></td>
                    <td><input type="text" name="aktif" size="25" value="<?PHP echo $row_get_detail["aktif"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama siswa</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_siswa" size="25" value="<?PHP echo $row_get_detail["nama_siswa"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Periode</td>
                    <td width="5"></td>
                    <td><input type="text" name="periode" size="25" value="<?PHP echo $row_get_detail["periode"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Jenjang</td>
                    <td width="5"></td>
                    <td><input type="text" name="jenjang" size="25" value="<?PHP echo $row_get_detail["jenjang"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tingkat</td>
                    <td width="5"></td>
                    <td><input type="text" name="tingkat" size="25" value="<?PHP echo $row_get_detail["tingkat"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Kelas</td>
                    <td width="5"></td>
                    <td><input type="text" name="kelas" size="25" value="<?PHP echo $row_get_detail["kelas"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Kategori status anak</td>
                    <td width="5"></td>
                    <td><input type="text" name="kat_status_anak" size="25" value="<?PHP echo $row_get_detail["kat_status_anak"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">No discount</td>
                    <td width="5"></td>
                    <td><input type="text" name="discount_payment" size="25" value="<?PHP echo $row_get_detail["discount_payment"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Pengembangan</td>
                    <td width="5"></td>
                    <td><input type="text" name="pengembangan" size="25" value="<?PHP echo $row_get_detail["pengembangan"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Kegiatan</td>
                    <td width="5"></td>
                    <td><input type="text" name="kegiatan" size="25" value="<?PHP echo $row_get_detail["kegiatan"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Peralatan</td>
                    <td width="5"></td>
                    <td><input type="text" name="peralatan" size="25" value="<?PHP echo $row_get_detail["peralatan"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Seragam</td>
                    <td width="5"></td>
                    <td><input type="text" name="seragam" size="25" value="<?PHP echo $row_get_detail["seragam"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Paket</td>
                    <td width="5"></td>
                    <td><input type="text" name="paket" size="25" value="<?PHP echo $row_get_detail["paket"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">SPP</td>
                    <td width="5"></td>
                    <td><input type="text" name="spp" size="25" value="<?PHP echo $row_get_detail["spp"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">KS</td>
                    <td width="5"></td>
                    <td><input type="text" name="ks" size="25" value="<?PHP echo $row_get_detail["ks"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Zakat mal</td>
                    <td width="5"></td>
                    <td><input type="text" name="zakat_mal" size="25" value="<?PHP echo $row_get_detail["zakat_mal"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Zakat profesi</td>
                    <td width="5"></td>
                    <td><input type="text" name="zakat_profesi" size="25" value="<?PHP echo $row_get_detail["zakat_profesi"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Infaq shodaqoh</td>
                    <td width="5"></td>
                    <td><input type="text" name="infaq_shodaqoh" size="25" value="<?PHP echo $row_get_detail["infaq_shodaqoh"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Wakaf</td>
                    <td width="5"></td>
                    <td><input type="text" name="wakaf" size="25" value="<?PHP echo $row_get_detail["wakaf"]; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr>
                    <td width="10" bgcolor="#333333"></td>
                    <td width="200" bgcolor="#333333" id="text_normal_white">Lain-lain</td>
                    <td width="5"></td>
                    <td><input type="text" name="lainlain" size="25" value="<?PHP echo $row_get_detail["lainlain"]; ?>" readonly="readonly" /></td>
                </tr>
            </table>
           	</form>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
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