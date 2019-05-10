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
        <td id="text_title_page1" align="center">Registrasi Administrasi Siswa</td>
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
        	<form method="post" name="add_user" action="engine.php?case=dddddd">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="45">
                    <td width="200" id="text_normal_black" colspan="4"><b>Data Siswa</b></td>
                </tr>
            	<tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="name" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Orang Tua</td>
                    <td width="5"></td>
                    <td><input type="text" name="parent" size="35" /> 
                    	<select name="">
                        <option value="">Kategori status anak</option>
                        <option value="umum">Umum</option>
                        <option value="anak pegawai">Anak Pegawai</option>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Telepon Ayah / Bunda</td>
                    <td width="5"></td>
                    <td><input type="text" name="telp_dad" size="35" /> / <input type="text" name="telp_mom" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Asal Sekolah</td>
                    <td width="5"></td>
                    <td><input type="text" name="school_name" size="35" /> 
                    	<select name="">
                        <option value="">Kategori asal sekolah</option>
                        <option value="umum">Umum</option>
                        <option value="darbi">Darbi</option>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tanggal Daftar</td>
                    <td width="5"></td>
                    <td><select name="date"><?PHP include("include/cur_date_opt.php"); ?></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                             
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Jenjang</td>
                    <td width="5"></td>
                    <td>
                    	<select name="level" id="category" onChange="updateclass(this.selectedIndex)">
                        <option value="">Pilih</option>
                        <option value="2">Toddler</option>
                        <option value="3">PG</option>
                        <option value="4">TK A</option>
                        <option value="5">TK B</option>
                        <option value="6">SD</option>
                        <option value="SMP">SMP</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Kelas</td>
                    <td width="5"></td>
                    <td>
						<select name="class" size="4" style="width: 150px"></select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Periode</td>
                    <td width="5"></td>
                    <td><?PHP include("include/period.php"); ?></td>
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
						for($shift = 1; $shift < 11; $shift++) {
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
                    <td><select name="fase_1"><?PHP include("include/cur_date_opt.php"); ?></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tahap II</td>
                    <td width="5"></td>
                    <td><select name="fase_2"><?PHP include("include/cur_date_opt.php"); ?></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="15"></td>
                </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0">            	
                <tr height="20">
                    <td width="100" id="text_normal_black"><b>Biaya Masuk</b></td>
                    <td width="10"></td>
                    <td><a title="Show Table #1a" href="javascript:toggleDisplay('1')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM1"></a></td>
                </tr>
            </table>
            <div style="display:none;" id="table1">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="15">
                    <td width="200" id="text_normal_black" colspan="4"></td>
                </tr>
            	<tr height="25">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Pengembangan<br />(Non Biaya Seragam)</td>
                    <td width="5"></td>
                    <td>
                    	<table border="0" cellpadding="0" cellspacing="0" id="text_normal_black">
                        	<tr>
                            	<td colspan="5" height="10" id="text_normal_red_bold">Kategori diskon</td>
                            </tr>
                            <tr>
                            	<td colspan="5" height="20">Umum</td>
                            </tr>
                             <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" checked="checked" /></td>
                                <td width="10" align="left"></td>
                                <td width="140" align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td width="5" align="left"></td>
                                <td align="left">&nbsp;Tidak ada diskon</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td width="10" align="left"></td>
                                <td width="140" align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td width="5" align="left"></td>
                                <td align="left">&nbsp;Lulusan TK ke SD</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 1.000.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Lulusan SD ke SMP Grade A</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Lulusan SD ke SMP</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Masuk bersamaan dengan saudara kandung 1 unit di bawah/sama/di atasnya</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 500.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Ada saudara kandung di 1 unit</td>
                            </tr>
                        </table>
                        <table border="0" cellpadding="0" cellspacing="0" id="text_normal_black">
                            <tr>
                            	<td colspan="5" height="20">Anak pegawai</td>
                            </tr>
                             <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" checked="checked" /></td>
                                <td width="10" align="left"></td>
                                <td width="140" align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td width="5" align="left"></td>
                                <td align="left">&nbsp;Tidak ada diskon</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td width="10" align="left"></td>
                                <td width="140" align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td width="5" align="left"></td>
                                <td align="left">&nbsp;Anak ke-1 (50%)</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 1.000.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Anak ke-2 (35%)</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Anak ke-3 (25%)</td>
                            </tr>
                        </table>
                        <table border="0" cellpadding="0" cellspacing="0" id="text_normal_black">
                            <tr>
                            	<td colspan="5" height="20">Pindahan</td>
                            </tr>
                             <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" checked="checked" /></td>
                                <td width="10" align="left"></td>
                                <td width="140" align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td width="5" align="left"></td>
                                <td align="left">&nbsp;Tidak ada diskon</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td width="10" align="left"></td>
                                <td width="140" align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td width="5" align="left"></td>
                                <td align="left">&nbsp;Anak ke-1 (50%)</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 1.000.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Anak ke-2 (35%)</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Anak ke-3 (25%)</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>   
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="15">
                    <td width="200" id="text_normal_black" colspan="4"></td>
                </tr>
            	<tr height="25">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Kegiatan</td>
                    <td width="5"></td>
                    <td>
                    	<table border="0" cellpadding="0" cellspacing="0" id="text_normal_black">
                        	<tr>
                            	<td colspan="5" height="10" id="text_normal_red_bold">Kategori diskon</td>
                            </tr>
                            <tr>
                            	<td colspan="5" height="20">Umum</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td width="10" align="left"></td>
                                <td width="140" align="left">  <input type="text" value="Rp 750.000,-" disabled="disabled" /></td>
                                <td width="5" align="left"></td>
                                <td align="left">&nbsp;Lulusan TK ke SD</td>
                            </tr>
                            <tr>
                            	<td align="center"><input type="radio" name="nbs_umum" /></td>
                                <td align="left"></td>
                                <td align="left">  <input type="text" value="Rp 1.000.000,-" disabled="disabled" /></td>
                                <td align="left"></td>
                                <td align="left">&nbsp;Lulusan SD ke SMP Grade A</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>   
            </div>
            <table border="0" cellpadding="0" cellspacing="0">            	
                <tr height="20">
                    <td width="100" id="text_normal_black"><b>SPP</b></td>
                    <td width="10"></td>
                    <td><a title="Show Table #1a" href="javascript:toggleDisplay('2')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM2"></a></td>
                </tr>
            </table>
            <div style="display:none;" id="table2">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="15">
                    <td width="200" id="text_normal_black" colspan="4"></td>
                </tr>
            	<tr height="25">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="name" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>   
            </div>  
            <table border="0" cellpadding="0" cellspacing="0">            	
                <tr height="20">
                    <td width="100" id="text_normal_black"><b>Rumah Berbagi</b></td>
                    <td width="10"></td>
                    <td><a title="Show Table #1a" href="javascript:toggleDisplay('3')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM3"></a></td>
                </tr>
            </table>
            <div style="display:none;" id="table3">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="15">
                    <td width="200" id="text_normal_black" colspan="4"></td>
                </tr>
            	<tr height="25">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="name" size="35" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>   
            </div>
            <table border="0" cellpadding="0" cellspacing="0">            	
                <tr height="20">
                    <td width="100" id="text_normal_black"><b>Daftar Ulang</b></td>
                    <td width="10"></td>
                    <td><a title="Show Table #1a" href="javascript:toggleDisplay('4')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM4"></a></td>
                </tr>
            </table>
            <div style="display:none;" id="table4">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="15">
                    <td width="200" id="text_normal_black" colspan="4"></td>
                </tr>
            	<tr height="25">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Pengembangan<br />(Non Biaya Seragam)</td>
                    <td width="5"></td>
                    <td>
                    	xcvxc
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>   
            </div>  
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10"></td>  
                    <td width="200"></td>
                    <td width="5"></td>                  
                    <td colspan="3"><!-- the verification function returned here, in submit button, check the whole script below --><input type="submit" value="Daftarkan user" onClick="return verification()"/><input type="reset" value="Kosongkan" /></td>
                </tr>
            </table>     
            </form>
            <!--================================ end here =================================-->
        </td>
        <td></td>
    </tr>
</table>
<?PHP
}
?>
<script type="text/javascript">
//this script is for dependent field
var levellist=document.add_user.level
var classlist=document.add_user.class

var class=new Array()
class[0]=""
class[1]= ["Toddler"]
class[2]= ["PG"]
class[3]= class[4] = 
			["Little Rabbi|tLittle Rabbit",  
			"Little Black Ant|Little Black Ant", 
			"Little Red Ant|Little Red Ant", 
			"Little Yellow Ant|Little Yellow Ant", 
			"Little Bee|Little Bee",
			"Little Bird|Little Bird",
			"Little Butterfly|Little Butterfly",
			"Little Camel|Little Camel",
			"Little Cat|Little Cat",
			"Little Cow|Little Cow"]
class[5]=
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
class[6]=
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

function updateclass(selectedcitygroup){
classlist.options.length=0
if (selectedcitygroup>0){
for (i=0; i<class[selectedcitygroup].length; i++)
classlist.options[classlist.options.length]=new Option(class[selectedcitygroup][i].split("|")[0], class[selectedcitygroup][i].split("|")[1])
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