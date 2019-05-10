<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	//We need to know what page is this (including their GET variable in URL
	//We'll send it to prod page.
	include "include/url.php";
	$url = curPageURL();
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Rekapitulasi Daftar Ulang</td>
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
			//let's define whether these variables empty or not (in POST method)
			$srch_no_sisda 		= (empty($_POST['no_sisda'])) ? '' : $_POST['no_sisda'];
			$srch_jenjang 		= (empty($_POST['jenjang'])) ? '' : $_POST['jenjang'];
			$srch_tingkat 		= (empty($_POST['tingkat'])) ? '' : $_POST['tingkat'];
			$srch_nama_siswa 	= (empty($_POST['nama_siswa'])) ? '' : $_POST['nama_siswa'];
			$srch_periode 		= (empty($_POST['periode'])) ? '' : $_POST['periode'];
			
			$srch_teknik_pembayaran	= empty($_POST['teknik_pembayaran']) ? '' : $_POST['teknik_pembayaran'];
			
			$srch_date_begin 	= empty($_POST['date_begin']) ? '' : $_POST['date_begin'];
			$srch_month_begin 	= empty($_POST['month_begin']) ? '' : $_POST['month_begin'];
			$srch_year_begin 	= empty($_POST['year_begin']) ? '' : $_POST['year_begin'];
			$srch_datetra_begin	= $srch_year_begin."-".$srch_month_begin."-".$srch_date_begin;
			
			$srch_date_end 		= empty($_POST['date_end']) ? '' : $_POST['date_end'];
			$srch_month_end 	= empty($_POST['month_end']) ? '' : $_POST['month_end'];
			$srch_year_end 		= empty($_POST['year_end']) ? '' : $_POST['year_end'];
			$srch_datetra_end	= $srch_year_end."-".$srch_month_end."-".$srch_date_end;
			
			//echo $srch_year_begin."-".$srch_month_begin."-".$srch_date_begin."<br>";
			//echo $srch_year_end."-".$srch_month_end."-".$srch_date_end."<br>";
			
			//Ternyata kira harus merubah-rubah querynya tergantung dari transaksi pembayaran nih... duh
			//OK catat baik-baik... acuannya cukup date,month dan year begin saja.. kan udah di counter, di form mereka harus berpasangan.  yoa
			
			//kondisi 1(semua kosong):
			if($srch_date_begin == "" && $srch_month_begin == "" && $srch_year_begin == "") {
			
				$where_tangtran	= "";
			
			//kondisi 2(tahun isi, bulan dan tanggal kosong):
			}else if($srch_date_begin == "" && $srch_month_begin == "" && $srch_year_begin != "") {
			
				$where_tangtran	= " and year(tanggal_transaksi) between '$srch_year_begin' and '$srch_year_end'";
			
			//Kondisi 3(tahun isi, bulan isi dan tanggal kosong):
			}else if($srch_date_begin == "" && $srch_month_begin != "" && $srch_year_begin != "") {

				$where_tangtran	= "and (year(tanggal_transaksi) between '$srch_year_begin' and '$srch_year_end') and (month(tanggal_transaksi) between '$srch_month_begin' and '$srch_month_end')";
			
			//Kondisi 3(semua isi):
			}else if($srch_date_begin != "" && $srch_month_begin != "" && $srch_year_begin != "") {
			
				$where_tangtran	= "and tanggal_transaksi between '$srch_datetra_begin' and '$srch_datetra_end'";
			
			} else { $where_tangtran	= ""; }
			
			//echo "<h1>t".$where_tangtran."t</h1>";
			
			//check whether the expected page empty or not, if it is, give it values as 0
			//variable p defines from which page, the query has to begin			
			//why 0? because we have to start the page from beginning.
			//why minus one --> because we have to count it from previous page + 1 record
			//So, when we put -1, we will get previous page, 
			//and 'the 1' record will be added on $the_limit
			//confuse???? so am i. hahahahahahaha :))			
			$src_limit = (!isset($_POST["page_num"])) ? "0" : htmlspecialchars($_POST["page_num"] - 1);
			
			//hey jude, how many record that you wanna show us in this page, buddy?
			$show_per_page = 50;
			
			//So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
			//But you have to know, that the "limit" in mysql query is start with 0 not 1, based on MySQL 5.5 Reference manual.. 
			//Hahahahahahahahahahaha kamal doent know about it. He argues me strongly, that it starts from 1...hahahahaha. For this case, dont believe him, just believe me and the manual
			//And so so so, when $the_limit value is 0, the query will return row beginned from first record (number 1)
			//when $the_limit value is 10, the query will return row beginned from eleventh record (number 11)
			//when $the_limit value is 20, the query will return row beginned from eleventh record (number 21)
			$the_limit 	= ($src_limit * $show_per_page);
			
			//weleh-weleh, take a look at this query.....
			//$the_limit       = defines where should the query begin from
			//$show_per_page   = defines how many record should be shown
			$src_get_siswa		= "select 
									id,	
									periode,
									tanggal_transaksi,								
									no_sisda, 
									nama_siswa,
									jenjang, 
									tingkat,
									teknik_pembayaran,
									tanggal_transfer,
									bank_tujuan,
									kegiatan_daful,
									peralatan_daful,
									seragam_daful
									
									from transaksi where 
									
									jenis_transaksi = 'daftar_ulang' and									
									no_sisda like '%$srch_no_sisda%' and
									nama_siswa like '%$srch_nama_siswa%' and
									jenjang like '%$srch_jenjang%' and 
									teknik_pembayaran like '%$srch_teknik_pembayaran%' and									
									tingkat like '%$srch_tingkat%' and 
									periode like '%$srch_periode%' 
									$where_tangtran
									
									order by no_sisda, periode limit $the_limit,$show_per_page "; 
			//tanggal_transaksi between '%$srch_datetra_begin%' and '%$srch_datetra_end%' and
			
			
			//echo	$src_get_siswa;					
			//but also, we need to select all record. it will be used to define the paging list.
			$src_get_siswa_all	= "select 
			
									id,	
									periode,
									tanggal_transaksi,								
									no_sisda, 
									nama_siswa,
									jenjang, 
									tingkat,
									teknik_pembayaran,
									tanggal_transfer,
									bank_tujuan,
									kegiatan_daful,
									peralatan_daful,
									seragam_daful
									
									from transaksi where 
									
									jenis_transaksi = 'daftar_ulang' and									
									no_sisda like '%$srch_no_sisda%' and
									nama_siswa like '%$srch_nama_siswa%' and
									jenjang like '%$srch_jenjang%' and 
									teknik_pembayaran like '%$srch_teknik_pembayaran%' and									
									tingkat like '%$srch_tingkat%' and 
									periode like '%$srch_periode%' 
									$where_tangtran
									 
									order by no_sisda, periode"; 
			
			//$src_get_siswa_all	= "select id from siswa_finance where nama_siswa like 'bima' order by no_sisda, periode"; 
			
			//echo $src_get_siswa_all;
			$query_get_siswa		=  mysqli_query($mysql_connect, $src_get_siswa) or die("There is an error with mysql: ".mysql_error());
			$query_get_siswa_all	=  mysqli_query($mysql_connect, $src_get_siswa_all) or die("There is an error with mysql: ".mysql_error());
			
			//Hey, how many record do we have..?????
			$num_get_siswa_all		= mysql_num_rows($query_get_siswa_all);
			//echo $num_get_siswa_all;
			?>
            <!--========================== user registration form =========================-->
            <?PHP
			$p = (!isset($_POST["page_num"])) ? "1" : htmlspecialchars($_POST["page_num"]);
			
			$all_page = ceil($num_get_siswa_all/$show_per_page);
			?>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <form name="search" method="post" action="?pl=rekap_daftar_ulang">
            	<input type="hidden" name="v" value="1" />
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td align="left" width="150" id="text_normal_black">No Sisda</td>
                    <td width="20"></td>
                    <td><input type="text" name="no_sisda" size="25" /></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Nama siswa</td>
                    <td width="20"></td>
                    <td><input type="text" name="nama_siswa" size="25" /></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Jenjang</td>
                    <td width="20"></td>
                    <td>
                    <select name="jenjang">
                    <option value="">Pilih</option>
                    <option value="Toddler">Toddler</option>
                    <option value="PG">PG</option>
                    <option value="TK A">TK A</option>
                    <option value="TK B">TK B</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Tingkat</td>
                    <td width="20"></td>
                    <td>
                    <select name="tingkat">
                    <option value="">Pilih</option>
                    <option value="Toddler">Toddler</option>
                    <option value="PG">PG</option>
                    <option value="TK A">TK A</option>
                    <option value="TK B">TK B</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Periode</td>
                    <td width="20"></td>
                    <td><?PHP include("include/periode.php"); ?></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Tanggal transaksi</td>
                    <td width="20"></td>
                    <td>
                    <select name="date_begin">
                    <option value="">Tanggal awal</option>
                    <?PHP for($idb=1; $idb<32; $idb++) { ?>
                    <option value="<?= $idb ?>"><?= $idb ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="month_begin">
                    <option value="">Bulan awal</option>
                    <?PHP for($imb=1; $imb<13; $imb++) { ?>
                    <option value="<?= $imb ?>"><?= $imb ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="year_begin">
                    <option value="">Tahun awal</option>
                    <?PHP for($iyb=1; $iyb<4; $iyb++) { ?>
                    <option value="<?= (2012+$iyb);?>"><?= (2012+$iyb);?></option>
                    <?PHP } ?>
                    </select>
                    <br />
                    <select name="date_end">
                    <option value="">Tanggal akhir</option>
                    <?PHP for($ide=1; $ide<32; $ide++) { ?>
                    <option value="<?= $ide ?>"><?= $ide ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="month_end">
                    <option value="">Bulan akhir</option>
                    <?PHP for($ime=1; $ime<13; $ime++) { ?>
                    <option value="<?= $ime ?>"><?= $ime ?></option>
                    <?PHP } ?>
                    </select>
                    <select name="year_end">
                    <option value="">Tahun akhir</option>
                    <?PHP for($iye=1; $iye<4; $iye++) { ?>
                    <option value="<?= (2012+$iye);?>"><?= (2012+$iye);?></option>
                    <?PHP } ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black"></td>
                    <td width="20"></td>
                    <td><input type="submit" value="Cari siswa" style="width:200px; height:40px;" /></td>
                </tr>
                <tr>
                    <td height="10" colspan="3"><hr noshade="noshade" color="#666666" size="1" /></td>
                </tr>
            </table>
            </form>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                	<td id="text_normal_black" colspan="3">Ditemukan: <b><?PHP echo $num_get_siswa_all; ?> data</b></td>
                </tr>
            	<tr height="20">
                    <td width="50"><span id="text_normal_black">Halaman: </span></td>
                    <td align="left"> 
                    <?PHP 
					/*
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
							echo "<span id='paging'><a href=\"?pl=antar_jemput&p=$i&$v_show&s=$srch_no_sisda&j=$srch_jenjang&n=$srch_nama_siswa&periode=$srch_periode\" >$i</a></span> ";
						}
					}
					*/
					?>
                    <form method="post" action="mainpage.php?pl=rekap_daftar_ulang">
                    <input type="hidden" name="no_sisda" value="<?= $srch_no_sisda; ?>" />
                    <input type="hidden" name="nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                    <input type="hidden" name="jenjang" value="<?= $srch_jenjang; ?>" />
                    <input type="hidden" name="tingkat" value="<?= $srch_tingkat; ?>" />
                    <input type="hidden" name="periode" value="<?= $srch_periode; ?>" />
                    <input type="hidden" name="date_begin" value="<?= $srch_date_begin; ?>" />
                    <input type="hidden" name="month_begin" value="<?= $srch_month_begin; ?>" />
                    <input type="hidden" name="year_begin" value="<?= $srch_year_begin; ?>" />
                    <input type="hidden" name="date_end" value="<?= $srch_date_end; ?>" />
                    <input type="hidden" name="month_end" value="<?= $srch_month_end; ?>" />
                    <input type="hidden" name="year_end" value="<?= $srch_year_end; ?>" />
                    <?PHP
					
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
					?>
                    	
                        <input type="submit" name="page_num" value="<?= $i; ?>" />
                        
                    <?PHP
						}
					} 
					?>
                    </form>
                    </td>
                </tr>
            </table> 
        	<table width="100%" border="0" cellpadding="5" cellspacing="1" style="border: 1px blue dotted;">  
            	<tr height="30">  
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Tanggal transaksi</td>
                     <td width="" bgcolor="#999999" id="text_normal_white" align="center">Teknik Pembayaran</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No Sisda</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Nama siswa</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jenjang</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">kelas</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Periode</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Kegiatan</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Peralatan</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Seragam</td>
                </tr>
                <?PHP
				//$bg used to generate zebra background.
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$row_number	= $the_limit + 1;
				
				while($get_siswa = mysql_fetch_array($query_get_siswa)) {
				?>
                <tr height="30">                
                    <td width="40" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP /*The number of record will be similar with $the_limit*/echo $row_number++; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["tanggal_transaksi"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["teknik_pembayaran"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["no_sisda"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["nama_siswa"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["tingkat"]." ".$get_siswa["jenjang"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["kelas"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["periode"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["kegiatan_daful"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["kegiatan_daful"],0,",",".").",-"; } ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["peralatan_daful"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["peralatan_daful"],0,",",".").",-"; } ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["seragam_daful"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["seragam_daful"],0,",",".").",-"; } ?></td>
                </tr>
                <?PHP
					if($bg	== "#ffffff") {
						$bg	= "#f1f1f1";
					}
					else {
						$bg	= "#ffffff";
					}
				}
				?>
			</table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                    <td width="50"><span id="text_normal_black">Halaman: </span><td>
                    <td align="left"> 
                    <form method="post" action="mainpage.php?pl=rekap_daftar_ulang">
                    <input type="hidden" name="no_sisda" value="<?= $srch_no_sisda; ?>" />
                    <input type="hidden" name="nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                    <input type="hidden" name="jenjang" value="<?= $srch_jenjang; ?>" />
                    <input type="hidden" name="tingkat" value="<?= $srch_tingkat; ?>" />
                    <?PHP
					
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
					?>
                    	
                        <input type="submit" name="page_num" value="<?= $i; ?>" />
                        
                    <?PHP
						}
					} 
					?>
                    </form>
                    </td>
                </tr>
                <tr>
                	<td height="20" colspan="2">&nbsp;</td>
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

<script language="javascript">
function toggle(source) {
  checkboxes = document.getElementsByName('pilih[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

<SCRIPT type="text/javascript" >
function verification() { 
	
	if(document.add_del_antar_jemput.the_month.value == "") {
		alert('Field "Bulan" tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.edu_year.value == "") {
		alert('Field "Tahun ajaran" tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.antar_jemput_name.value == "") {
		alert('Field "Penyedia layanan antar-jemput" tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.day_antar_jemput.value == "") {
		alert('Field "Jumlah hari" tidak boleh kosong');
		return false;
	}	
	return true;	
}

function verification1() {

	if(document.add_del_antar_jemput.the_month.value == "") {
		alert('Field "Bulan" yang akan dihapus tidak boleh kosong');
		return false;
	}
	if(document.add_del_antar_jemput.edu_year.value == "") {
		alert('Field "Tahun ajaran" yang akan dihapus tidak tidak boleh kosong');
		return false;
	}
	return true;
}
</SCRIPT>