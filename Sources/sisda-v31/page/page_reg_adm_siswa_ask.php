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
    	<td align="center">
        	<table width="350" border="0" cellpadding="0" cellspacing="0">
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
        		<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_adm_siswa">
        	 	<tr height="20">
                    <td  id="text_normal_black">
                    <select name="stat_sekolah_asal" onchange="javascript:toggleSelect();" style="height:40px; font-size:14px; width:250px;">
                    <option value="">Kategori asal sekolah</option>
                    <option value="umum">Umum</option>
                    <option value="darbi">Darbi</option>
                    </select>
                    <br /><br />
                    <input type="text" name="chk_sekolah_asl" style="height:40px; font-size:14px; width:250px;" placeholder="Nama sekolah asal"/>
                    <br /><br />
                    <input type="text" name="chk_no_sisda" style="height:40px; font-size:14px; width:250px;" placeholder="No Sisda"/>
                    <button name="load_no_sisda" style="height:22px; font-size:11px; width:254px;" onclick="javascript:void window.open('popup.php?pl=chk_no_sisda','','width=700,height=500,toolbar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0'); return false;">Cek No Sisda</button>
                    <br /><br />
                    <input type="submit" name="submit" value="Lanjutkan pendaftaran" style="height:40px; font-size:14px; width:250px;" onClick="return verification();"/>
                    </td>
                </tr>   
            	</form>
            </table>
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
}
?>



<SCRIPT type="text/javascript" >
function verification() { 
	
	if(document.reg_adm_siswa.stat_sekolah_asal.value == "")
	{
		alert('Field "Kategori Asal sekolah" tidak boleh kosong');
		return false;
		
	} else if (document.reg_adm_siswa.stat_sekolah_asal.value == "umum") {
	
		if(document.reg_adm_siswa.chk_sekolah_asl.value == "") {
		
			alert('"Nama sekolah asal" tidak boleh kosong');
			return false;
			
		}
	
	} else if (document.reg_adm_siswa.stat_sekolah_asal.value == "darbi") {
	
		if(document.reg_adm_siswa.chk_no_sisda.value == "") {
		
			alert('"No Sisda" tidak boleh kosong');
			return false;
			
		}
	
	}
	
return true;	
}


/** disable since the page loaded**/
function happycode(){
	document.reg_adm_siswa.chk_sekolah_asl.disabled = true;
	document.reg_adm_siswa.chk_no_sisda.disabled = true;
	document.reg_adm_siswa.load_no_sisda.disabled = true;
}

window.onload = happycode ;

function toggleSelect() {

	if (document.reg_adm_siswa.stat_sekolah_asal.value == "umum") {
		document.reg_adm_siswa.chk_sekolah_asl.disabled = false;
		document.reg_adm_siswa.chk_no_sisda.disabled = true;
		document.reg_adm_siswa.load_no_sisda.disabled = true;
	} else if (document.reg_adm_siswa.stat_sekolah_asal.value == "darbi") {
		document.reg_adm_siswa.chk_sekolah_asl.disabled = true;
		document.reg_adm_siswa.chk_no_sisda.disabled = false;
		document.reg_adm_siswa.load_no_sisda.disabled = false;
	} else {
		document.reg_adm_siswa.chk_sekolah_asl.disabled = true;
		document.reg_adm_siswa.chk_no_sisda.disabled = true;
		document.reg_adm_siswa.load_no_sisda.disabled = true;
	}			
}
</SCRIPT>