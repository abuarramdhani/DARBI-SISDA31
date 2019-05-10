<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
?>
    <!-- i dont think that i should give many comments here, hope you understand the script step by step -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="3" height="10"></td>
        </tr>
        <tr height="25">
            <td width="30"></td>
            <td id="text_title_page1" align="center"><h2 style="padding:0px;">Kategori Administrasi Biaya Masuk</td>
            <td width="30"></td>
        </tr>
        <tr>
            <td></td>
            <td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
            <td></td>
        </tr>
        <tr>        
            <td colspan="3" height="20"></td>
        </tr>
    </table>
    <?PHP
	$the_periode	= htmlspecialchars($_GET["per"]);
	
	$the_periode_enc	= mysql_real_escape_string($the_periode);
	
	$src_get_cat_adm_bi_ma		= "select * from set_cat_adm_bi_ma where periode = '$the_periode_enc'";
	$query_get_cat_adm_bi_ma	= mysqli_query($mysql_connect, $src_get_cat_adm_bi_ma) or die("There is an error with mysql: ".mysql_error());
	?>
    <form method="post" name="set_cat_adm_bi_ma" action="engine.php?case=cat_adm_bi_ma_edit">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td align="center">
                <table width="970" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="10">Tahun pelajaran: <?PHP echo $the_periode; ?><input type="hidden" name="periode" value="<?PHP echo $the_periode_enc; ?>" /></td>
                    </tr>
                    <tr>
                    	<td height="50" bgcolor="#333333">Kategori Administrasi</td>
                        <td rowspan="26" valign="top">
                        <div style="border:0px solid black;width:750px;overflow-y:hidden;overflow-x:scroll; margin:0px;">
                        <p style="width:250%; margin:0px;">
                        <?PHP //<iframe allowtransparency="1" style="overflow-x:scroll;" marginheight="0" marginwidth="0" frameborder="0" width="720" height="102%" src="page/page_cat_adm_bi_ma_setting_getframe.php"></iframe> ?>
                        <?PHP include("page_cat_adm_bi_ma_edit_get_frame.php"); ?>
                        </p>
                        </div>
                        </td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Bersamaan dengan saudara kandung</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Memiliki Saudara Kandung</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum memiliki Saudara Kandung + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum bersamaan dengan Saudara Kandung + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi</td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1 + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1 + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2 + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2 + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke toddler semester II</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                    	<td>Siswa pindahan ke PG/TK A/TK B semester II</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke SD 3-4</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke SD 5-6</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke smp 8</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke smp 9</td>
                    </tr>
                </table>                
                <table width="100%"border="0" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr>
                        <td width="315"></td>
                        <td colspan="20" align="left"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpan Kategori Administrasi" onClick="return verification()"/> <input type="reset" value="Reset" /></td>
                    </tr>
                </table>
            </td>
            <td width="30"></td>
        </tr>
        <tr>
        	<td colspan="3" height="20"></td>
        </tr>
    </table>
    </form> 
<?PHP
}
?>
<!-- sandy said: form verifiation start form here buddy...:)-->
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.set_cat_adm_bi_ma.period.value == "")
	{
		alert('Anda harus memilih Tahun Pelajaran untuk melengkapi form administrasi biaya masuk');
		return false;
	}
	
return true;	
}
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt)
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
        alert ( "Hanya boleh diisi dengan angka." );
        return false
    }
    status = ""
    return true
}
</SCRIPT>