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
        <td id="text_title_page1" align="center" height="40">Edit jumlah hari catering & antar jemput per siswa</td>
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
			//Before we start this page, we have to ensure that, period & month has been selected
			//Otherwise push them to do that
			$cur_periode	= (!empty($_POST["cur_periode"]) ? $_POST["cur_periode"] : (!empty($_GET["cur_periode"]) ? $_GET["cur_periode"] : "" ));
			$cur_bulan		= (!empty($_POST["cur_bulan"]) ? $_POST["cur_bulan"] : (!empty($_GET["cur_bulan"]) ? $_GET["cur_bulan"] : "" ));
			
			$cur_periode_enc 	= mysql_real_escape_string($cur_periode);
			$cur_bulan_enc		= mysql_real_escape_string($cur_bulan);
			
			if($cur_periode == "" && $cur_bulan == "" ) {			
			?>
            <form name="get_period" method="post" action="?pl=cataj_num_day_edit">
            <table width="350" border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
            	<tr>
                	<td colspan="5" height="10">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="30"></td>
                	<td height="40" id="text_normal_white" colspan="3">
                   	<strong>Pilih bulan dan periode terlebih dahulu </strong> 
                    </td>
                    <td width="30"></td>
                </tr>
            	<tr>
                	<td width="30"></td>
                    <td align="left" width="30" id="text_normal_white">Bulan</td>
                    <td width="20"></td>
                    <td>
                    <select name="cur_bulan" style="width:150px; height:25px; font-size:14px;">
                    <option value="" style="color:#FF6600;">Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
					</select>
                    </td>
                    <td width="30"></td>
                </tr>
                <tr>
                	<td width="30"></td>
                    <td align="left" id="text_normal_white">Periode</td>
                    <td width="20"></td>
                    <td>
                    <select name="cur_periode" style="width:150px; height:25px; font-size:14px;">
                    <option value="" style="color:#FF6600">Tahun ajaran</option>
					<?PHP include("include/education_year_cataj.php"); ?>
                    </select>
                    </td>
                    <td width="30"></td>
                </tr>
                <tr>
                	<td width="30"></td>
                    <td></td>
                    <td></td>
                	<td height="50"><input type="submit" value="Tampilkan Form"  style="width:150px; height:40px; font-size:14px; color:#FFFFFF; background-color:#336699;" onClick="return verification2()"/></td>
                	<td width="30"></td>
                </tr>
                <tr>
                	<td colspan="5" height="10">&nbsp;</td>
                </tr>
            </table>
            </form>
            <?PHP			
			} else {
				
				$src_get_nominal 	= "select * from cataj_num_day where periode = '$cur_periode' and month = '$cur_bulan'";
				$query_get_nominal	= mysqli_query($mysql_connect, $src_get_nominal) or die(mysql_error());
				$num_get_nominal	= mysql_num_rows($query_get_nominal);
				
				if($cur_bulan == 1){ $bulan_name = "Januari"; $bulan_tung = "jan_cataj"; }
				if($cur_bulan == 2){ $bulan_name = "Februari"; $bulan_tung = "feb_cataj"; }
				if($cur_bulan == 3){ $bulan_name = "Maret"; $bulan_tung = "mar_cataj"; }
				if($cur_bulan == 4){ $bulan_name = "April"; $bulan_tung = "apr_cataj"; }
				if($cur_bulan == 5){ $bulan_name = "Mei"; $bulan_tung = "may_cataj"; }
				if($cur_bulan == 6){ $bulan_name = "Juni"; $bulan_tung = "jun_cataj"; }
				if($cur_bulan == 7){ $bulan_name = "Juli"; $bulan_tung = "jul_cataj"; }
				if($cur_bulan == 8){ $bulan_name = "Agustus"; $bulan_tung = "aug_cataj"; }
				if($cur_bulan == 9){ $bulan_name = "September"; $bulan_tung = "sep_cataj"; }
				if($cur_bulan == 10){ $bulan_name = "Oktober"; $bulan_tung = "oct_cataj"; }
				if($cur_bulan == 11){ $bulan_name = "November"; $bulan_tung = "nov_cataj"; }
				if($cur_bulan == 12){ $bulan_name = "Desember"; $bulan_tung = "des_cataj"; }
				
				$row_get_nominal 		= mysql_fetch_array($query_get_nominal);
				$nominal_catering		= $row_get_nominal["catering"];
				$nominal_antar_jemput	= $row_get_nominal["antar_jemput"];
				
				if($num_get_nominal == 0) {
			?>
            	<table width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
                    <tr>
                        <td colspan="3" height="10">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="30"></td>
                        <td height="40" id="text_normal_white" align="center">
                        <p>Bulan <?= $bulan_name; ?> <?= $cur_periode ?> belum terdaftar di halaman <B>Jumlah hari Catering & Antar Jemput</B></p>
                        <p><button onclick="window.location.href='?pl=cataj_num_day'" style="width:350px; height:40px; font-size:14px; color:#FFFFFF; background-color:#663366;">Jumlah hari Catering dan antar jemput</button></p>
                        <p><button onclick="window.location.href='?pl=cataj_num_day_edit'" style="width:150px; height:40px; font-size:14px; color:#FFFFFF; background-color:#336699;">Kembali</button></p>
                        </td>
                        <td width="30"></td>
                    </tr>
                    <tr>
                        <td colspan="3" height="10">&nbsp;</td>
                    </tr>
                </table>	
			<?PHP					
				} else {
			?>
        	<?PHP
			//Load all user data////////////
			////////////////////////////////
			////////////////////////////////
			$v_get  = (empty($_GET["v"])) ? false : true;
			$v_post = (empty($_POST["v"])) ? false : true; 
			
			if(!empty($v_get)) {
			
			//And is the POST is not empty, send it via GET method
			$srch_no_sisda		= (empty($_GET['s'])) ? '' : $_GET['s'];
			$srch_jenjang		= (empty($_GET['j'])) ? '' : $_GET['j'];
			$srch_tingkat		= (empty($_GET['t'])) ? '' : $_GET['t'];
			$srch_nama_siswa	= (empty($_GET['n'])) ? '' : $_GET['n'];
			$srch_periode		= (empty($_GET['period'])) ? '' : $_GET['period'];
			
			} else if (!empty($v_post)) {
			
			//let's define whether these variables empty or not (in POST method)
			$srch_no_sisda 		= (empty($_POST['s'])) ? '' : $_POST['s'];
			$srch_jenjang 		= (empty($_POST['j'])) ? '' : $_POST['j'];
			$srch_tingkat 		= (empty($_POST['t'])) ? '' : $_POST['t'];
			$srch_nama_siswa 	= (empty($_POST['n'])) ? '' : $_POST['n'];
			$srch_periode 		= (empty($_POST['period'])) ? '' : $_POST['period'];
			
			} else {
				
				$srch_no_sisda 		= "";
				$srch_jenjang		= "";
				$srch_tingkat		= "";
				$srch_nama_siswa	= "";
				$srch_periode		= "";
				
			}
			
			if($v_post == true || $v_get == true) {
			
				$v_show	= "&v=1";
				
			} else {
				
				$v_show	="";
			}
			
			//check whether the expected page empty or not, if it is, give it values as 0
			//variable p defines from which page, the query has to begin			
			//why 0? because we have to start the page from beginning.
			//why minus one --> because we have to count it from previous page + 1 record
			//So, when we put -1, we will get previous page, 
			//and 'the 1' record will be added on $the_limit
			//confuse???? so am i. hahahahahahaha :))			
			$src_limit = (!isset($_GET["p"])) ? "0" : htmlspecialchars($_GET["p"] - 1);
			
			//hey jude, how many record that you wanna show us in this page, buddy?
			$show_per_page = 100;
			
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
			$src_get_siswa		= "select id, no_sisda, jenjang, nama_siswa, periode, catering from siswa_finance where aktif = '1' and no_sisda like '%$srch_no_sisda%' and jenjang like '%$srch_jenjang%' and tingkat like '%$srch_tingkat%' and nama_siswa like '%$srch_nama_siswa%' and periode like '%$srch_periode%' order by no_sisda, periode limit $the_limit,$show_per_page "; 
			
			//but also, we need to select all record. it will be used to define the paging list.
			$src_get_siswa_all	= "select id, no_sisda, jenjang, nama_siswa, periode, catering from siswa_finance where aktif = '1' and no_sisda like '%$srch_no_sisda%' and jenjang like '%$srch_jenjang%' and tingkat like '%$srch_tingkat%' and nama_siswa like '%$srch_nama_siswa%' and periode like '%$srch_periode%' order by no_sisda, periode"; 
			
			
			$query_get_siswa		=  mysqli_query($mysql_connect, $src_get_siswa) or die("There is an error with mysql: ".mysql_error());
			$query_get_siswa_all	=  mysqli_query($mysql_connect, $src_get_siswa_all) or die("There is an error with mysql: ".mysql_error());
			
			//Hey, how many record do we have..?????
			$num_get_siswa_all		= mysql_num_rows($query_get_siswa_all);
			?>
            <!--========================== user registration form =========================-->
            <?PHP
			$p = (!isset($_GET["p"])) ? "1" : htmlspecialchars($_GET["p"]);
			
			$all_page = ceil($num_get_siswa_all/$show_per_page);
			?>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <form name="search" method="post" action="?pl=cataj_num_day_edit">
            	<input type="hidden" name="v" value="1" />
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td align="left" width="100" id="text_normal_black">No Sisda</td>
                    <td width="20"></td>
                    <td><input type="text" name="s" size="25" /></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Nama siswa</td>
                    <td width="20"></td>
                    <td><input type="text" name="n" size="25" /></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Jenjang</td>
                    <td width="20"></td>
                    <td>
                    <select name="j">
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
                    <select name="t">
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
                    <td align="left" id="text_normal_black">Bulan</td>
                    <td width="20"></td>
                    <td><input type="text" name="" value="<?= $bulan_name; ?>" readonly="readonly" /><input type="hidden" name="cur_bulan" value="<?= $cur_bulan; ?>" /></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Periode</td>
                    <td width="20"></td>
                    <td><input type="text" name="cur_periode" value="<?= $cur_periode; ?>" readonly="readonly" /></td>
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
                	<td id="text_normal_black">Ditemukan: <b><?PHP echo $num_get_siswa_all; ?> data</b></td>
                </tr>
            	<tr height="20">
                    <td><span id="text_normal_black">Halaman: </span> 
                    <?PHP 
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
							echo "<span id='paging'><a href=\"?pl=cataj_num_day_edit&p=$i&$v_show&s=$srch_no_sisda&j=$srch_jenjang&n=$srch_nama_siswa&cur_periode=cur_periode&cur_bulan=cur_bulan\" >$i</a></span> ";
						}
					}
					?>
                    </td>
                </tr>
            </table>
			<form method="post" name="num_day_catering_edit" action="engine.php?case=catering_num_day_edit">
            <?PHP
			//Yeaaaa,.... $url will get all of the path in it's url
			//But, we've define it the root of our system in darbi_config.php, in $darbi_url...
			//So we have to delete the first character of $url as many as number of lenght of $darbi_url
			$lenght_url	= strlen($darbi_url);
			$back_url	= substr($url,$lenght_url);
			?>
            <input type="hidden" name="back_url" value="<?= $back_url; ?>" /> 
            <input type="hidden" name="the_month" value="<?= $cur_bulan; ?>" />
            <input type="hidden" name="edu_year" value="<?= $cur_periode; ?>" />
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
            	<tr>
                	<td colspan="7">&nbsp;</td>
                </tr>
            	<tr>
                	<td width="20">&nbsp;</td>
                    <td width="5"></td>
                	<td width="100" align="left" >
                    <select name="catering_num_day" style="width:160px; height:40px; font-size:14px;">
                    <option value="" style="color:#FF6600">Jumlah hari Catering</option>
                    <option value="0">Tidak ada catering</option>
                    <?PHP
					for($i=1; $i<32; $i++) {
					?>
                    <option value="<?= $i; ?>"><?= $i; ?> hari</option>
                    <?PHP
					}
					?>
                    </select>
                    </td>
                    <td width="5">&nbsp;</td>
                    <td align="left" width="150">
                    <input type="submit" name="daftarkan" value="Rubah jumlah hari catering" style="width:190px; height:40px; font-size:14px; color:#FFFFFF; background-color:#336699;" onClick="return verification()" />
                    </td>
                    <td>&nbsp;</td>
                    <td width="20">&nbsp;</td>
                </tr>
                <tr>
                	<td colspan="7">&nbsp;</td>
                </tr>
            </table>           
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="17" height="30" id="text_normal_black"><input type="checkbox" onClick="toggle(this)" /> Pilih semua</td>
                </tr>
            	<tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="40" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Pilih siswa</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No Sisda</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Nama siswa</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jenjang</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Periode</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jumlah hari catering</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                <?PHP
				
				//$bg used to generate zebra background.
				$bg		="#ffffff";	
				$bg2 	= "#FEDEF3";
				
				//next thing is for row  number, you know...it starts from 0
				$row_number	= $the_limit + 1;
				
				while($get_siswa = mysql_fetch_array($query_get_siswa)) {
				
					//Borossssssss query.... amit......
					//
					$src_nominal_tunggakan 		= "select $bulan_tung as nilai from tunggakan where jenis_tunggakan = 'catering' and no_sisda = '".$get_siswa["no_sisda"]."'";
					$query_nominal_tunggakan	= mysqli_query($mysql_connect, $src_nominal_tunggakan) or die(mysql_error());
					$nominal_cataj				= mysql_fetch_array($query_nominal_tunggakan);
					$nilai						= $nominal_cataj["nilai"];
					
					$src_get_nom_cat	= "select nominal from cataj where name = '".$get_siswa["catering"]."'";
					$query_get_nom_cat	= mysqli_query($mysql_connect, $src_get_nom_cat) or die(mysql_error());
					$row_get_nom_cat	= mysql_fetch_array($query_get_nom_cat);
					
					if(substr($nilai,0,1) == 2 || substr($nilai,0,1) == 3 || substr($nilai,0,1) == 5 || substr($nilai,0,1) == 6) {
					
						$status_rubah	= "Jumlah hari tidak boleh dirubah";
						$status_check	= false;
						$status_bg		= false;
						
					} else {
					
						if(substr($nilai,2) == 0) {
						
							$status_rubah	= "Tidak ikut catering";
							$status_check	= false;
							$status_bg		= false;
							
						} else {
						
							$status_rubah	= substr($nilai,2)/$row_get_nom_cat["nominal"]." hari";
							$status_check	= true;
							$status_bg		= true;
						
						}					
					}
					
					
				?>
              <tr height="30" bgcolor="<?PHP if($status_bg == true) echo $bg; else if($status_bg == false) echo $bg2; ?>">                	
                	<td width="10"></td>
                    <td width="40" id="text_normal_black" align="left"><?PHP /*The number of record will be similar with $the_limit*/echo $row_number++; ?></td>
                    <td width="10"></td>
                    <td width="" id="text_normal_black" align="left"><?php if($status_check == true) { ?><input type="checkbox" name="pilih[]" value="<?= $get_siswa["no_sisda"]."-".$row_get_nom_cat["nominal"]; ?>" /><?PHP } ?></td>
                    <td width="10"></td>
                  	<td width="" id="text_normal_black" align="left"><?PHP echo $get_siswa["no_sisda"]; ?></td>
                    <td width="10"></td>
                    <td width="" id="text_normal_black" align="left"><?PHP echo $get_siswa["nama_siswa"]; ?></td>
                    <td width="10"></td>
                    <td width="" id="text_normal_black" align="center"><?PHP echo $get_siswa["jenjang"]; ?></td>
                    <td width="10"></td>
                    <td width="" id="text_normal_black" align="center"><?PHP echo $get_siswa["periode"]; ?></td>
                    <td width="10"></td>
                    <td width="" id="text_normal_black" align="center"><?= $status_rubah; ?> </td>
                    <td width="10"></td>
              </tr>
                <?PHP					
					
					if($bg2 == "#FEEBF0") {
						$bg2 = "#FEDEF3";
					}
					else {
						$bg2 = "#FEEBF0";
					}
					
					if($bg	== "#ffffff") {
						$bg	= "#f1f1f1";
					}
					else {
						$bg	= "#ffffff";
					}
				}
				?>
                <tr>
               	  <td colspan="17" height="30" id="text_normal_black"><input type="checkbox" onClick="toggle(this)" /> Pilih semua</td>
                </tr>
			</table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                    <td><span id="text_normal_black">Halaman: </span> 
                    <?PHP 
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
							echo "<span id='paging'><a href=\"?pl=cataj_num_day_edit&p=$i&$v_show&s=$srch_no_sisda&j=$srch_jenjang&n=$srch_nama_siswa&cur_periode=cur_periode&cur_bulan=cur_bulan\" >$i</a></span> ";
						}
					}
					?>
                    </td>
                </tr>
                <tr>
                	<td height="20">&nbsp;</td>
                </tr>
			</table>
           	</form>
        <?PHP
			}
		}
		?>
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
		
	if(document.num_day_catering_edit.catering_num_day.value == "") {
		alert('Field "Jumlah hari" tidak boleh kosong');
		return false;
	}	
	return true;	
}

function verification1() {

	if(document.add_del_catering.the_month.value == "") {
		alert('Field "Bulan" yang akan dihapus tidak boleh kosong');
		return false;
	}
	if(document.add_del_catering.edu_year.value == "") {
		alert('Field "Tahun ajaran" yang akan dihapus tidak tidak boleh kosong');
		return false;
	}
	return true;
}

function verification2() {

	if(document.get_period.cur_bulan.value == "") {
		alert('Field "Bulan" tidak boleh kosong');
		return false;
	}
	if(document.get_period.cur_periode.value == "") {
		alert('Field "Periode" tidak boleh kosong');
		return false;
	}
	return true;
}
</SCRIPT>