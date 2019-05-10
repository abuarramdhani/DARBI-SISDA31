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
        <td id="text_title_page1" align="center">Siswa naik kelas</td>
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
        	<table width="" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td id="text_normal_black" align="center">
                    <span style="color:#FF0000;"><b>Catatan</b></span>: Proses penentuan siswa naik kelas <b>hanya</b> dapat dilakukan pada bulan juni (bulan terakhir pada bulan ajaran), yaitu pertanggal 30 juni<br />
                    Mengapa? karena system akan memberlakukan nominal pembayaran SPP untuk seluruh siswa dengan nominal tahun ajaran baru yang ditentukan oleh proses di halaman ini. <br /><br />
                    <small style="color:#FF0000">
                    Tahun ajaran baru tidak akan ditampilkan, jika:<br />
                    - Setting SPP untuk jenjang tersebut belum dilakukan<br />
                    - Proses penentuan siswa naik kelas untuk tahun baru tersebut sudah dilakukan 
                    </small>
                    </td>
                </tr>
                <tr>
                	<td height="40"></td>
                </tr>         	
                <tr>
                	<td align="center">
                        <table cellpadding="0" cellspacing="0" border="0">
                        	<tr bgcolor="#006666">
                            	<td width="10"></td>
                                <td id="text_normal_white" align="center"><h3>TK</h3></td>
                                <td width="10"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <?PHP
							/*
							=========================================================================
							=========================================================================
							=== Watch out, do not change all of the value for each field bellow 
							=== (value="Kelas Play Group ke TK A")
							=== They are written with a pattern
							=== Or you are in a big trouble, because those values 
							=== will be checked in the next page (page_nextcalss_adm_siswa_conf)
							=========================================================================
							=========================================================================
							*/
							?>
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas Play Group ke TK A" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "tka";  include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas TK A ke TK B" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "tkb";  include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#006666">
                            	<td width="10"></td>
                                <td id="text_normal_white" align="center"><h3>SD</h3></td>
                                <td width="10"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas 1 ke 2" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "sd-2";  include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas 2 ke 3" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "sd-3"; include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas 3 ke 4" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "sd-4"; include("include/education_year_next_class.php"); ?></td>
                                <td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas 4 ke 5" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "sd-5"; include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas 5 ke 6" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "sd-6"; include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#006666">
                            	<td width="10"></td>
                                <td id="text_normal_white" align="center"><h3>SMP</h3></td>
                             	<td width="10"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                             <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas 7 ke 8" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "smp-8"; include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="1" colspan="3"></td>
                            </tr>
                            <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <form method="post" action="mainpage.php?pl=nextclass_adm_siswa_conf" >
                            <tr bgcolor="#666666">
                            	<td width="10"></td>
                                <td align="center" id="text_normal_white"><input type="submit" name="submit" value="Kelas 8 ke 9" style=" height:35px; width:250px; font-size:20px;" /> <?PHP $check_tahun_jenjang = "smp-9"; include("include/education_year_next_class.php"); ?></td>
                            	<td width="10"></td>
                            </tr>
                            </form>
                             <tr bgcolor="#666666">
                                <td height="10" colspan="3"></td>
                            </tr>
                            <tr>
                                <td height="10" colspan="3"></td>
                            </tr>
                         </table>
                     </td>
                </tr>
                <tr>
                	<td height="35">&nbsp;</td>
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