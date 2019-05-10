<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {
	
	//There are variable that needed in page "reg_nextclass_adm_siswa"
	//$no_sisda has to be defined as $s, when the page will send the data back to 'nextclass_adm_siswa'
	$no_sisda		= empty($_GET["no"]) ? false :  $_GET["no"];
	$id				= empty($_GET["id"]) ? "" : $_GET["id"];	
	$v				= empty($_GET["v"]) ? "" : $_GET["v"];
	$n				= empty($_GET["n"]) ? "" : $_GET["n"];
	$j				= empty($_GET["j"]) ? "" : $_GET["j"];
	$send_periode	= empty($_GET["periode"]) ? "" : $_GET["periode"];
	
	if($no_sisda != "") {
		
		//Be careful with this var :)...........
		$enc_no_sisda	= mysql_real_escape_string($no_sisda);
		
		$src_get_data_siswa_finance		= "select * from siswa_finance where no_sisda = '$enc_no_sisda' and aktif = '1'";
		$query_get_data_siswa_finance	= mysqli_query($mysql_connect, $src_get_data_siswa_finance) or die("There is an error with mysql: ".mysql_error());
		$num_get_data_siswa_finance		= mysql_num_rows($query_get_data_siswa_finance);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Registrasi Administrasi Siswa Naik Kelas</td>
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
            <?PHP
            if($num_get_data_siswa_finance >> 0) {
				
				$row_get_data_siswa_finance		= mysql_fetch_array($query_get_data_siswa_finance);
				$existing_no_sisda				= $row_get_data_siswa_finance["no_sisda"];
				
				$src_get_data_siswa		= "select * from siswa where no_sisda = '$existing_no_sisda'";
				$query_get_data_siswa	= mysqli_query($mysql_connect, $src_get_data_siswa) or die("There is an error with mysql: ".mysql_error());
				$row_get_data_siswa		= mysql_fetch_array($query_get_data_siswa);
			?>
        	<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_nextclass_adm_siswa_next">
            <input type="hidden" name="no_sisda" value="<?PHP echo $no_sisda; ?>" />
            <input type="hidden" name="id" value="<?PHP echo $id; ?>" />
            <input type="hidden" name="v" value="<?PHP echo $v; ?>" />
            <input type="hidden" name="n" value="<?PHP echo $n; ?>" />
            <input type="hidden" name="j" value="<?PHP echo $j; ?>" />
            <input type="hidden" name="send_periode" value="<?PHP echo $send_periode; ?>" />
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="45">
                    <td width="200" id="text_normal_black" colspan="4"><b>Data Siswa</b></td>
                </tr>
            	<tr height="20">
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_siswa" size="35" value="<?PHP echo $row_get_data_siswa_finance["nama_siswa"]; ?>" readonly="readonly" style="background-color:#ebebe4; border:solid 1px #abadb3; padding:1px; color:#545454;"></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#000000"></td>
                    <td width="200" bgcolor="#000000" id="text_normal_white">Nama ayah / bunda / status</td>
                    <td width="5"></td>
                    <td>
                    	<?PHP 
						//Look at the "Kategori status anak (kat_status_anak)", it taken from 'siswa', but current data will be stored in 'data_siswa'    
						//Why is that? it just because, "Kategori status" different with other dynamic data in data_siswa, this data will be needed for another case outside payment/finance case.
						//So we have to keep it in table 'siswa' also. And if user want t change the value of this data, he/she has to do it from menu "Lihat semua data (modifikasi)".						
						?>
                    	<input type="text" name="nama_ayah" size="35" value="<?PHP echo $row_get_data_siswa["nama_ayah"]; ?>" readonly="readonly" style="background-color:#ebebe4; border:solid 1px #abadb3; padding:1px; color:#545454;" /> / <input type="text" name="nama_bunda" size="35" value="<?PHP echo $row_get_data_siswa["nama_bunda"]; ?>" readonly="readonly" style="background-color:#ebebe4; border:solid 1px #abadb3; padding:1px; color:#545454;" /> / <input type="text" name="kat_status_anak" size="35" value="<?PHP echo $row_get_data_siswa["kat_status_anak"]; ?>" readonly="readonly" style="background-color:#ebebe4; border:solid 1px #abadb3; padding:1px; color:#545454;" />
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
                    <td width="200" bgcolor="#999999" id="text_normal_white">Jenjang</td>
                    <td width="5"></td>
                    <td> 
                    	<select name="jenjang" id="category" onChange="upkelas(this.selectedIndex)">
                        <option value="">Pilih</option>
                        <option value="Toddler">Toddler</option>
                        <option value="PG">PG</option>
                        <option value="TK A">TK A</option>
                        <option value="TK B">TK B</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        </select> <span id="text_normal_black">Jenjang saat ini adalah <b><?PHP echo $row_get_data_siswa_finance["jenjang"]; ?></b></span>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tingkat</td>
                    <td width="5"></td>
                    <td><?PHP echo $row_get_data_siswa["tingkat"]; ?>
                    <select name="tingkat">
                    <option value="">Pilih</option>
                    <option value="Toddler" <?PHP if($row_get_data_siswa["tingkat"]=="Toddler") { ?>selected="selected"<?PHP } ?>>Toddler</option>
                    <option value="PG"      <?PHP if($row_get_data_siswa["tingkat"]=="PG") { ?>selected="selected"<?PHP } ?>>PG</option>
                    <option value="TK A"	<?PHP if($row_get_data_siswa["tingkat"]=="TK A") { ?>selected="selected"<?PHP } ?>>TK A</option>
                    <option value="TK B"	<?PHP if($row_get_data_siswa["tingkat"]=="TK B") { ?>selected="selected"<?PHP } ?>>TK B</option>
                    <option value="1"		<?PHP if($row_get_data_siswa["tingkat"]=="1") { ?>selected="selected"<?PHP } ?>>1</option>
                    <option value="2"		<?PHP if($row_get_data_siswa["tingkat"]=="2") { ?>selected="selected"<?PHP } ?>>2</option>
                    <option value="3"		<?PHP if($row_get_data_siswa["tingkat"]=="3") { ?>selected="selected"<?PHP } ?>>3</option>
                    <option value="4"		<?PHP if($row_get_data_siswa["tingkat"]=="4") { ?>selected="selected"<?PHP } ?>>4</option>
                    <option value="5"		<?PHP if($row_get_data_siswa["tingkat"]=="5") { ?>selected="selected"<?PHP } ?>>5</option>
                    <option value="6"		<?PHP if($row_get_data_siswa["tingkat"]=="6") { ?>selected="selected"<?PHP } ?>>6</option>
                    <option value="7"		<?PHP if($row_get_data_siswa["tingkat"]=="7") { ?>selected="selected"<?PHP } ?>>7</option>
                    <option value="8"		<?PHP if($row_get_data_siswa["tingkat"]=="8") { ?>selected="selected"<?PHP } ?>>8</option>
                    <option value="9"		<?PHP if($row_get_data_siswa["tingkat"]=="9") { ?>selected="selected"<?PHP } ?>>9</option>
                    </select>
                    <?PHP
					/*
						<select name="tingkat" size="4" style="width: 150px"></select> <span id="text_normal_black">Kelas saat ini adalah <b><?PHP echo $row_get_data_siswa_finance["kelas"]; ?></b></span>
                    */
					?> 
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Periode</td>
                    <td width="5"></td>
                    <td>
						<?PHP include("include/periode_next_year.php"); ?>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
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
                    Silahkan klik tombol <strong>Lanjutkan</strong></td>
                </tr>
            	<tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10"></td>  
                    <td width="200"></td>
                    <td width="5"></td>                  
                    <td colspan="3"><!-- the verification function returned here, in submit button, check the whole script below --><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Lanjutkan" onClick="return verification()"/></td>
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
	}else {	
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr height="100">
    	<td>&nbsp;</td>
    </tr>
	<tr>
    	<td id="text_redirect" align="center">No Sisda tidak ditemukan. Halaman tidak dapat diproses</td>
    </tr>
	<tr>
    	<td height="10" align="center"><input type="button" value="kembali ke halaman sebelumnya" onclick="history.go(-1)" /></td>
    </tr>
</table>
<?PHP
	}
}
?>
<script type="text/javascript">
//this script is for dependent field
var jenjanglist=document.reg_adm_siswa.jenjang
var tingkatlist=document.reg_adm_siswa.tingkat

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
tingkatlist.options.length=0
if (selectedcitygroup>0){
for (i=0; i<kelas[selectedcitygroup].length; i++)
tingkatlist.options[tingkatlist.options.length]=new Option(kelas[selectedcitygroup][i].split("|")[0], kelas[selectedcitygroup][i].split("|")[1])
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

<SCRIPT type="text/javascript" >
function verification() 
{ 
	
	if(document.reg_adm_siswa.jenjang.value == "")
	{
		alert('Field "Jenjang" tidak boleh kosong');
		return false;
	}
	if(document.reg_adm_siswa.tingkat.value == "")
	{
		alert('Field "Tingkat" tidak boleh kosong');
		return false;
	}
	
return true;	
}
</SCRIPT>