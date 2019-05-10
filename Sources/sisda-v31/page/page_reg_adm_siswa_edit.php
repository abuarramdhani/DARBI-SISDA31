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
        	<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_adm_siswa2">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="45">
                    <td width="200" id="text_normal_black" colspan="4"><b>Data Siswa</b></td>
                </tr>
                <tr>
                    <td width="200" id="text_normal_black" colspan="4"><!-- Go to the edit page --><input style="height:25; font-size:11px;" type="submit" value="mysqli_query($mysql_connect,  Siswa" onClick="return OnButton1()"/></td>
                </tr>                
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            	<tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="name" size="35" value="<?PHP echo $_POST["name"]; ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Orang Tua</td>
                    <td width="5"></td>
                    <td><input type="text" name="parent" size="35" value="<?PHP echo $_POST["parent"]; ?>" disabled="disabled"/> <input type="text" name="status_anak" size="35" value="<?PHP echo ucwords($_POST["status_anak"]); ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Telepon Ayah / Bunda</td>
                    <td width="5"></td>
                    <td><input type="text" name="telp_dad" size="35"  value="<?PHP echo $_POST["telp_dad"]; ?>" disabled="disabled"/> / <input type="text" name="telp_mom" size="35" value="<?PHP echo $_POST["telp_mom"]; ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Asal Sekolah</td>
                    <td width="5"></td>
                    <td><input type="text" name="school_name" size="35"  value="<?PHP echo ucwords($_POST["school_name"]); ?>" disabled="disabled"/> <input type="text" name="school_name" size="35"  value="<?PHP echo $_POST["status_school_from"]; ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tanggal Daftar</td>
                    <td width="5"></td>
                    <td><select name="date"><?PHP include("include/cur_date_opt.php"); ?></select><select name="month"><?PHP include("include/cur_month_opt.php"); ?></select><select name="year"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>         
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Jenjang</td>
                    <td width="5"></td>
                    <td>
                    	<select name="jenjang" id="category" onChange="updatekelas(this.selectedIndex)">
                        <option value="" <?PHP if($_POST["jenjang"] == "") { echo "selected"; } ?>>Pilih</option>
                        <option value="Toddler" <?PHP if($_POST["jenjang"] == "Toddler") { echo "selected"; } ?>>Toddler</option>
                        <option value="PG" <?PHP if($_POST["jenjang"] == "PG") { echo "selected"; } ?>>PG</option>
                        <option value="TK A" <?PHP if($_POST["jenjang"] == "TK A") { echo "selected"; } ?>>TK A</option>
                        <option value="TK B" <?PHP if($_POST["jenjang"] == "TK B") { echo "selected"; } ?>>TK B</option>
                        <option value="SD" <?PHP if($_POST["jenjang"] == "SD") { echo "selected"; } ?>>SD</option>
                        <option value="SMP" <?PHP if($_POST["jenjang"] == "SMP") { echo "selected"; } ?>>SMP</option>
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
                    <td><select name="kelas" size="4" style="width: 150px"></select></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Periode</td>
                    <td width="5"></td>
                    <td>
                    <select name="period">
                    <option value="">Pilih</option>
                    <?PHP
                    for($period = 1; $period < 20; $period++) {	
                        
                        $period_bott 	= 2005+$period;
                        $period_up		= 2006+$period;
						
						$cur_period		= $period_bott." - ".$period_up;
                        
						if($_POST["period"] == $cur_period ) { 
						
							echo "<option value='$period_bott - $period_up' selected>$period_bott - $period_up</option>";
							
						} else {
						
							echo "<option value='$period_bott - $period_up'>$period_bott - $period_up</option>";
							
						}
                        
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
                    <td width="200" bgcolor="#999999" id="text_normal_white">Gelombang Tes</td>
                    <td width="5"></td>
                    <td>
                    	<select name="shift_test">
                        <option value="">Pilih</option>
                        <?PHP
						for($shift = 1; $shift < 11; $shift++) {
							if($_POST["shift_test"] == $shift) {							
								echo "<option value='$shift' selected> $shift</option>";
							} else {
								echo "<option value='$shift'> $shift</option>";
							}
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
                    <td colspan="3"></td>
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
}
?>
<script type="text/javascript">
//this script is for dependent field
var jenjanglist=document.reg_adm_siswa.jenjang
var kelaslist=document.reg_adm_siswa.kelas

var kelas=new Array()
kelas[0]=""
kelas[1]= ["Toddler"]
kelas[2]= ["PG"]
kelas[3]= kelas[4] = 
			["Little Rabbit|Little Rabbit",  
			"Little Black Ant|Little Black Ant", 
			"Little Red Ant|Little Red Ant", 
			"Little Yellow Ant|Little Yellow Ant", 
			"Little Bee|Little Bee",
			"Little Bird|Little Bird",
			"Little Butterfly|Little Butterfly",
			"Little Camel|Little Camel",
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

function updatekelas(selectedcitygroup){
kelaslist.options.length=0
if (selectedcitygroup>0){
for (i=0; i<kelas[selectedcitygroup].length; i++)
kelaslist.options[kelaslist.options.length]=new Option(kelas[selectedcitygroup][i].split("|")[0], kelas[selectedcitygroup][i].split("|")[1])
}
}
</script>