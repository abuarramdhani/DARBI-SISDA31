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
        <td id="text_title_page1" align="center">Pengaturan Nominal Discount Biaya Administrasi</td>
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
        	<form method="post" name="set_disc_adm" action="engine.php?case=set_disc_adm">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Jenjang</td>
                    <td width="5"></td>
                    <td>
                    	<select name="jenjang">
                        <option value="">pilih</option>
                        <option value="tk">TK</option>
                        <option value="sd">SD</option>
                        <option value="smp">SMP</option>
                    	</select>
                    </td>
                </tr>
            	<tr>
                	<td colspan="4" height="5"></td>
                </tr>
            	<tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Kategory administrasi</td>
                    <td width="5"></td>
                    <td>
                    	<select name="cat_adm">
                        <option value="">pilih</option>
                        <option value="Pengembangan">Pengembangan</option>
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Peralatan">Peralatan</option>
                        <option value="Seragam">Seragam</option>
                    	</select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            	<tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Discount Kategory administrasi</td>
                    <td width="5"></td>
                    <td>
                    	<select name="disc_cat_adm">
                        <option value="">pilih</option>
                        <option value="u">Umum</option>
                        <option value="bdsk">Bersamaan dengan saudara kandung</option>
                        <option value="msk">Memiliki saudara kandung</option>
                        <option value="ugb">Umum grade B</option>
                        <option value="umsksmpgb">Umum memiliki saudara kandung di SMP + grade B</option>
                        <option value="ad">Asal Darbi</option>
                        <option value="adga">Asal Darbi + Grade A</option>
                        <option value="adgb">Asal Darbi + Grade B</option>
                        <option value="ap1">Anak pegawai ke-1</option>
                        <option value="ap2">Anak pegawai ke-2</option>
                        <option value="ap3">Anak pegawai ke-3, dst</option>
                        <option value="ap1ga">Anak pegawai ke-1 + Grade A</option>
                        <option value="ap1gb">Anak pegawai ke-1 + Grade B</option>
                        <option value="ap2ga">Anak pegawai ke-2 + Grade A</option>
                        <option value="ap2gb">Anak pegawai ke-2 + Grade B</option>
                        <option value="ap3ga">Anak pegawai ke-3, dst + Grade A</option>
                        <option value="ap3gb">Anak pegawai ke-3, dst + Grade B</option>
                        <option value="spts2">Siswa pindahan ke Toddler semester II</option>
                        <option value="sppgtkatkbs2">Siswa pindahan ke PG/TK A/TK B Semester II</option>
                        <option value="spsd34">Siswa pindahan ke SD 3-4</option>
                        <option value="spsd56">Siswa pindahan ke SD 5-6</option>
                        <option value="spsmp8">Siswa pindahan ke SMP 8</option>
                        <option value="spsmp9">Siswa pindahan ke SMP 9</option>
                    	</select>
                    </td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Tahun pelajaran</td>
                    <td width="5"></td>
                    <td><?PHP include"include/period.php"; ?></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#cccccc"></td>
                    <td width="200" bgcolor="#cccccc" id="text_normal_black">Nominal</td>
                    <td width="5"></td>
                    <td><input type="text" name="nominal" width="25" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10"></td>
                    <td width="200"></td>
                    <td width="5"></td>
                    <td><input type="submit" value="Submit" onClick="return verification()"/><input type="reset" value="Reset" /></td>
                </tr>
          	</table>
         	 </form>
             
             <?PHP
			//Load all spp data////////////
			////////////////////////////////
			////////////////////////////////
			
			//check whether the expected page empty or not, if it is, give it values as 0
			//variable p defines from which page, the query has to begin			
			//why 0? because we have to start the page from beginning.
			//why minus one --> because we have to count it from previous page + 1 record
			//So, when we put -1, we will get previous page, 
			//and 'the 1' record will be added on $the_limit
			//confuse???? so am i. hahahahahahaha :))			
			$src_limit = (!isset($_GET["p"])) ? 0 : htmlspecialchars($_GET["p"] - 1);
			
			//hey jude, how many record that you wanna show us in this page, buddy?
			$show_per_page = 10;
			
			//So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page
			//Dont forget that the limit start from 0. 0 is the first record. 
			$the_limit 	= ($src_limit * $show_per_page);
			
			//weleh-weleh, take a look at this query.....
			//$the_limit       = defines where should the query begin from
			//$show_per_page   = defines how many record should be shown
			$src_disc_adm		= "select * from set_disc_adm order by periode, jenjang, cat_adm, disc_cat_adm limit $the_limit,$show_per_page ";
			
			//but also, we need to select all record. it will be used to define the paging list.
			$src_disc_adm_all	= "select * from set_disc_adm";
			
			$query_disc_adm		=  mysqli_query($mysql_connect, $src_disc_adm) or die("There is an error with mysql: ".mysql_error());
			$query_disc_adm_all	=  mysqli_query($mysql_connect, $src_disc_adm_all) or die("There is an error with mysql: ".mysql_error());
			
			//Hey, how many record do we have..?????
			$num_disc_adm_all		= mysql_num_rows($query_disc_adm_all);
			?>
            <!--========================== user registration form =========================-->
            <?PHP
			$p = (!isset($_GET["p"])) ? 1 : htmlspecialchars($_GET["p"]);
			
			$all_page = ceil($num_disc_adm_all/$show_per_page);
			?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">            	
            	<tr height="40">
                	<td colspan="3"><hr noshade="noshade" size="1" color="#999999" /></td>
                </tr>
            	<tr>
                	<td></td>
                    <td>
                    <?PHP 
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
							echo "<span id='paging'><a href=\"?pl=setting_disc_adm&p=$i\" >$i</a></span> ";
						}
					}
					?>
                    </td>
                    <td></td>
                </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr id="text_normal_white_bold" bgcolor="#666666" height="30">
                	<td width="10"></td>
                	<td>No</td>
                    <td width="10"></td>
                    <td>Tahun pelajaran</td>
                    <td width="10"></td>
                    <td>Jenjang</td>
                    <td width="10"></td>
                    <td>Kategori administrasi</td>
                    <td width="10"></td>
                    <td>Discount kategori administrasi</td>
                    <td width="10"></td>
                    <td>Nominal</td>
                    <td width="10"></td>
                    <td>Modifikasi</td>
                    <td width="10"></td>
                </tr>
            <?PHP
			//$bg used to generate zebra background.
			$bg	="#beb8a9";			
			//this is for number, you know...
			$no	= $the_limit + 1;
			while($row_disc_adm = mysql_fetch_array($query_disc_adm)) {			
			?>
            	<tr height="30" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black">
                	<td></td>
                	<td><?PHP echo $no++; ?></td>
                    <td></td>
                    <td><?PHP echo $row_disc_adm["periode"]; ?></td>
                    <td></td>
                    <td><?PHP echo $row_disc_adm["jenjang"]; ?></td>
                    <td></td>
                    <td><?PHP echo $row_disc_adm["cat_adm"]; ?></td>
                    <td></td>                    
                    <td><?PHP echo $row_disc_adm["disc_cat_adm"]; ?></td>
                    <td></td>
                    <td><?PHP echo $row_disc_adm["nominal"]; ?></td>
                    <td></td>
                    <td><a href="mainpage.php?pl=edit_setting_disc_adm&id=<?PHP echo $row_disc_adm["id"]; ?>"><img src="images/icon_edit.png" border="0" title="Edit data" /></a>&nbsp;&nbsp;<a href="mainpage.php?pl=delete_setting_disc_adm&id=<?PHP echo $row_disc_adm["id"]; ?>"><img src="images/icon_delete.png" border="0" title="Delete data"/></a></td>
                    <td></td>
                </tr>	
            <?PHP
				//this is the other part of zebra background generator
				//if background of the first row is xxxxxx, so you have to change it to #yyyyyy in the next row 
				if($bg	== "#beb8a9") {
					$bg	= "#ffffff";
				}
				else {
					$bg	= "#beb8a9";
				}
            }	
			?>
            </table>            
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="35">
                    <td width="200" id="text_normal_black" colspan="4"></td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
	<tr>        
        <td colspan="3"></td>
    </tr>
</table>
<?PHP
}
?>
<!-- sandy said: form verifiation start form here buddy...:)-->
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.set_disc_adm.jenjang.value == "")
	{
		alert('Field Jenjang tidak boleh kosong');
		return false;
	}
	if(document.set_disc_adm.cat_adm.value == "")
	{
		alert('Field Kategory administrasi tidak boleh kosong');
		return false;
	}
	if(document.set_disc_adm.disc_cat_adm.value == "")
	{
		alert('Field Discount Kategory administrasi tidak boleh kosong');
		return false;
	}
	if(document.set_disc_adm.disc_cat_adm.value == "")
	{
		alert('Field Discount Kategory administrasi tidak boleh kosong');
		return false;
	}
	if(document.set_disc_adm.period.value == "")
	{
		alert('Field tahun ajaran tidak boleh kosong');
		return false;
	}
	if(document.set_disc_adm.nominal.value == "")
	{
		alert('Field nominal tidak boleh kosong');
		return false;
	}
	if(isNaN(document.set_disc_adm.nominal.value))
	{
		alert('Field nominal hanya boleh diisi dengan angka');
		return false;
	}
	
return true;	
}
</SCRIPT>