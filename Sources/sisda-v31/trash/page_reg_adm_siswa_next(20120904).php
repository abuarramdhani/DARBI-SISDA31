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
        	<?PHP // <form method="post" name="reg_adm_siswa" action="mainpage.php?pl=coba"> ?>
			<form method="post" name="reg_adm_siswa" action="engine.php?case=reg_adm_siswa">             
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
                    <td><input type="text" name="nama_siswa" size="35" value="<?PHP echo $_POST["nama_siswa"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Orang Tua</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_ortu" size="35" value="<?PHP echo $_POST["nama_ortu"]; ?>" readonly="readonly"/> <input type="text" name="type_ortu" size="35" value="<?PHP echo $_POST["type_ortu"]; ?>" readonly="readonly"/> <input type="text" name="kat_status_anak" size="35" value="<?PHP echo ucwords($_POST["kat_status_anak"]); ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Telepon Ayah / Bunda</td>
                    <td width="5"></td>
                    <td><input type="text" name="telp_ayah" size="35"  value="<?PHP echo $_POST["telp_ayah"]; ?>" readonly="readonly"/> / <input type="text" name="telp_bunda" size="35" value="<?PHP echo $_POST["telp_bunda"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Asal Sekolah</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_sekolah_asal" size="35"  value="<?PHP echo ucwords($_POST["nama_sekolah_asal"]); ?>" readonly="readonly"/> <input type="text" name="stat_sekolah_asal" size="35"  value="<?PHP echo $_POST["stat_sekolah_asal"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tanggal Daftar</td>
                    <td width="5"></td>
                    <td><input type="text" name="tanggal_daftar" size="35"  value="<?PHP echo $_POST["tanggal_daftar"]." - ".$_POST["month"]." - ".$_POST["year"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>         
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Jenjang</td>
                    <td width="5"></td>
                    <td><input type="text" name="jenjang" size="35"  value="<?PHP echo $_POST["jenjang"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Kelas</td>
                    <td width="5"></td>
                    <td><input type="text" name="kelas" size="35"  value="<?PHP echo $_POST["kelas"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Periode</td>
                    <td width="5"></td>
                    <td><input type="text" name="period" size="35"  value="<?PHP echo $_POST["period"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Gelombang Tes</td>
                    <td width="5"></td>
                    <td><input type="text" name="shift_test" size="35"  value="<?PHP echo $_POST["shift_test"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tahap I</td>
                    <td width="5"></td>
                    <td><input type="text" name="fase_1_date" size="35"  value="<?PHP echo $_POST["fase_1_date"]." - ".$_POST["fase_1_month"]." - ".$_POST["fase_1_year"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tahap II</td>
                    <td width="5"></td>
                    <td><input type="text" name="fase_2_date" size="35"  value="<?PHP echo $_POST["fase_2_date"]." - ".$_POST["fase_2_month"]." - ".$_POST["fase_2_year"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="15"></td>
                </tr>
                <tr>
                	<td colspan="4" height="15"><hr color="#999999" noshade="noshade" size="1" /></td>
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
                    <td width="200" colspan="4"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Kategory administrasi</td>
                    <td width="5" align="center"></td>
                    <td align="left">
                    <?PHP //we change the values into integer. We synchronize itu with the ajax's code. it's easier than you have to change the ajax codes ?>
                    <select name="disc_cat_adm" onchange="getList(this.value)">
                    <option value="">pilih</option>
                    <option value="1">Umum</option>
                    <option value="2">Bersamaan dengan saudara kandung</option>
                    <option value="3">Memiliki saudara kandung</option>
                    <option value="4">Umum grade B</option>
                    <option value="5">Umum memiliki saudara kandung di SMP + grade B</option>
                    <option value="6">Asal Darbi</option>
                    <option value="7">Asal Darbi + Grade A</option>
                    <option value="8">Asal Darbi + Grade B</option>
                    <option value="9">Anak pegawai ke-1</option>
                    <option value="10">Anak pegawai ke-2</option>
                    <option value="11">Anak pegawai ke-3, dst</option>
                    <option value="12">Anak pegawai ke-1 + Grade A</option>
                    <option value="13">Anak pegawai ke-1 + Grade B</option>
                    <option value="14">Anak pegawai ke-2 + Grade A</option>
                    <option value="15">Anak pegawai ke-2 + Grade B</option>
                    <option value="16">Anak pegawai ke-3, dst + Grade A</option>
                    <option value="17">Anak pegawai ke-3, dst + Grade B</option>
                    <option value="18">Siswa pindahan ke Toddler semester II</option>
                    <option value="19">Siswa pindahan ke PG/TK A/TK B Semester II</option>
                    <option value="20">Siswa pindahan ke SD 3-4</option>
                    <option value="21">Siswa pindahan ke SD 5-6</option>
                    <option value="22">Siswa pindahan ke SMP 8</option>
                    <option value="23">Siswa pindahan ke SMP 9</option>
                    </select>
                    </td>
				</tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
			</table>
            <?PHP 
			//this will include page include/disc_cat_adm_dd_menu.php
			//All needed variables declared by GET method on javascript below this page, getList function
			?>
			<div id="txtHint"><span id="text_normal_black">Data discount administrasi akan ditampilkan setelah anda memilih kategori administrasi</span></div>			
            <hr noshade="noshade" color="#666666" size="1" />  
            </div>
            <table border="0" cellpadding="0" cellspacing="0">            	
                <tr height="20">
                    <td width="100" id="text_normal_black"><b>SPP</b></td>
                    <td width="10"></td>
                    <td><a title="Show Table #1a" href="javascript:toggleDisplay('2')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM2"></a></td>
                </tr>
            </table>
            <div style="display:none;" id="table2">
            <?PHP
			//Level = toddler,pg,tka,tkb,sd,smp
			//Jenjang = toddler,pg,tk-a,tkab, 1,2,3,4,5,6,7,8,9
			//Kelas = little cow, 1 makkah, 2 cordova			
			//in this case, the word that appear as "Jenjang" is level. Remember it.<br />
			//Why is that, it just because, "jenjang" is better to be expressed than "level"
			$periode_enc 	= mysql_real_escape_string($_POST["period"]); 
			$level_enc		= mysql_real_escape_string($_POST["jenjang"]);
			$kelas_enc		= mysql_real_escape_string($_POST["kelas"]); 
			
			//This  synchronization is base on page "page_reg_adm_siswa.php" and the column names on table "set_spp"
			//For SD and SMP we only need to define with the first character of value of variable "kelas"
			if($level_enc == "Toddler") 	{ $jenjang = "1"; }
			else if($level_enc == "PG") 	{ $jenjang = "1"; }
			else if($level_enc == "TK A") 	{ $jenjang = "2"; }
			else if($level_enc == "TK B") 	{ $jenjang = "3"; }
			else if($level_enc == "SD") 	{ $jenjang = substr($kelas_enc,0,1); }
			else if($level_enc == "SMP") 	{ $jenjang = substr($kelas_enc,0,1); } 
			
			//For the explanation of page pengaturan nominal SPP (keterangan discount), decidec by two conditions
			//If status_anak is = Anak guru, the discount is anak guru
			//If status_anak is = Anak umum/bukan anak guru, the discount based on the registation year.
			//For the registration year, we only need the 2 lastest character each.
			//For example. 2011-2012, we only use 1112.
			//So here it is
			if($_POST["status_anak"] == "umum") 		{ $ket_disc = substr($periode_enc,-9,2).substr($periode_enc,-2,2); }
			if($_POST["status_anak"] == "anak pegawai")	{ $ket_disc = "angu"; } 
			
			$src_get_spp	= "select * from set_spp where periode = '$periode_enc' and level = '$level_enc' and jenjang = '$jenjang' and ket_disc = '$ket_disc'";
			$query_get_spp	= mysqli_query($mysql_connect, $src_get_spp) or die ("There is an error with mysql: ".mysql_error());
			$num_row		= mysql_num_rows($query_get_spp); 
			
			while($row_get_spp = mysql_fetch_array($query_get_spp)) {
				if($row_get_spp["item_byr"] == "spp") { $nominal_spp = $row_get_spp["nominal"]; }
				if($row_get_spp["item_byr"] == "add") { $nominal_add = $row_get_spp["nominal"]; }
			}
			
			if($num_row != 0 ) {
			?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="15">
                    <td width="200" colspan="4"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">SPP</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="spp" size="35"  value="<?PHP echo $nominal_spp; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">KS</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="ks" size="35"  value="<?PHP echo $nominal_add; ?>" readonly="readonly" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Sub Total</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="subtotal_spp" size="35"  value="Rp. <?PHP echo $nominal_add+$nominal_spp; ?>" readonly="readonly" style="font-weight:bold; color:#ff0000;" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>
            <?PHP
			} else {
				echo "<b>Data discount SPP dan KS untuk level $level_enc tahun ajaran $periode_enc belum dibuat. Silahkan hubungi Administrator Keuangan</b>";
			}
			?>
            <hr noshade="noshade" color="#666666" size="1" />                  
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
                    <td width="200" colspan="4"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Zakat mal</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="zakat_mal" size="35"  /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Zakat profesi</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="zakat_profesi" size="35"  /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Infaq/shodaqoh</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="infaq_shodaqoh" size="35"  /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Wakaf</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="wakaf" size="35"  /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Lain-lain</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="lain_lain" size="35"  /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>
            <hr noshade="noshade" color="#666666" size="1" />              
            </div>
            <?PHP /*
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
                    <td width="200" colspan="4"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Kegiatan</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="" style="font-weight:bold; color:#333333;"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Peralatan</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="" style="font-weight:bold; color:#333333;"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Seragam</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" size="35" name="" style="font-weight:bold; color:#333333;"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>
            <hr noshade="noshade" color="#666666" size="1" />    
            </div>
            */ ?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td height="20"><input type="submit" value="submit" /></td>
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


<script type="text/javascript">
function getList(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","include/disc_cat_adm_dd_menu.php?q="+str+"&per=<?PHP echo $_POST["period"]; ?>&lev=<?PHP echo $_POST["jenjang"]; ?>",true);
xmlhttp.send();
}
</script>