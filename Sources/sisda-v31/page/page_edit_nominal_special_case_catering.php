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
        <td id="text_title_page1" align="center">Edit Nominal Catering (Special case)</td>
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
			$cur_month	= strtolower(date("F"));
			$cur_year	= date("Y");
			
			if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	
				
				$edu_year	= ($cur_year-1)." - ".$cur_year;
				
			} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
				
				$edu_year	= $cur_year." - ".($cur_year+1);
				
			}
			 
			//let's define whether these variables empty or not (in POST method)
			$srch_no_sisda 		= (empty($_POST['no_sisda'])) ? '' : $_POST['no_sisda'];
			$srch_jenjang 		= (empty($_POST['jenjang'])) ? '' : $_POST['jenjang'];
			$srch_tingkat 		= (empty($_POST['tingkat'])) ? '' : $_POST['tingkat'];
			$srch_nama_siswa 	= (empty($_POST['nama_siswa'])) ? '' : $_POST['nama_siswa'];
			$srch_periode 		= (empty($_POST['periode'])) ? $edu_year : $_POST['periode']; //echo "srch_periode: ".$srch_periode."<br>";
			?>
            <form name="search" method="post" action="?pl=edit_nominal_special_case_catering">
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
                    <td align="left" id="text_normal_black"></td>
                    <td width="20"></td>
                    <td><input type="submit" value="Cari siswa" style="width:200px; height:40px;" /></td>
                </tr>
                <tr>
                    <td height="10" colspan="3"><hr noshade="noshade" color="#666666" size="1" /></td>
                </tr>
            </table>
            </form>
            <?PHP
			if($srch_no_sisda != "") { $chk_no_sisda = "tunggakan.no_sisda = '$srch_no_sisda' and "; } else { $chk_no_sisda = ""; }
			if($srch_jenjang != "") { $chk_jenjang = "siswa_finance.jenjang = '$srch_jenjang' and "; } else { $chk_jenjang = ""; }
			if($srch_tingkat != "") { $chk_tingkat = "siswa_finance.tingkat = '$srch_tingkat' and "; } else { $chk_tingkat = ""; }
			if($srch_nama_siswa != "") { $chk_nama_siswa = "siswa_finance.nama_siswa like '%$srch_nama_siswa%' and "; } else { $chk_nama_siswa = ""; }
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
			$src_get_siswa	= 
								"
									select 
									tunggakan.no_sisda,
									tunggakan.jenis_tunggakan,
									tunggakan.status,
									tunggakan.jan_cataj,
									tunggakan.feb_cataj,
									tunggakan.mar_cataj,
									tunggakan.apr_cataj,
									tunggakan.may_cataj,
									tunggakan.jun_cataj,
									tunggakan.jul_cataj,
									tunggakan.aug_cataj,
									tunggakan.sep_cataj,
									tunggakan.oct_cataj,
									tunggakan.nov_cataj,
									tunggakan.dec_cataj,
									tunggakan.jan_provider,
									tunggakan.feb_provider,
									tunggakan.mar_provider,
									tunggakan.apr_provider,
									tunggakan.may_provider,
									tunggakan.jun_provider,
									tunggakan.jul_provider,
									tunggakan.aug_provider,
									tunggakan.sep_provider,
									tunggakan.oct_provider,
									tunggakan.nov_provider,
									tunggakan.dec_provider,
									siswa_finance.nama_siswa,
									siswa_finance.kelas
									from tunggakan,siswa_finance
									where
									tunggakan.no_sisda = siswa_finance.no_sisda and
									tunggakan.jenis_tunggakan = 'catering' and
									tunggakan.periode = '$srch_periode' and
									$chk_no_sisda
									$chk_jenjang
									$chk_tingkat
									$chk_nama_siswa
									siswa_finance.aktif = '1' 
									
									 limit $the_limit,$show_per_page 
									
								"; 
			//tanggal_transaksi between '%$srch_datetra_begin%' and '%$srch_datetra_end%' and
			
			
			//echo	$src_get_siswa;					
			//but also, we need to select all record. it will be used to define the paging list.
			$src_get_siswa_all	= 
								"
									select 
									tunggakan.no_sisda,
									tunggakan.jenis_tunggakan,
									tunggakan.status,
									tunggakan.jan_cataj,
									tunggakan.feb_cataj,
									tunggakan.mar_cataj,
									tunggakan.apr_cataj,
									tunggakan.may_cataj,
									tunggakan.jun_cataj,
									tunggakan.jul_cataj,
									tunggakan.aug_cataj,
									tunggakan.sep_cataj,
									tunggakan.oct_cataj,
									tunggakan.nov_cataj,
									tunggakan.dec_cataj,
									tunggakan.jan_provider,
									tunggakan.feb_provider,
									tunggakan.mar_provider,
									tunggakan.apr_provider,
									tunggakan.may_provider,
									tunggakan.jun_provider,
									tunggakan.jul_provider,
									tunggakan.aug_provider,
									tunggakan.sep_provider,
									tunggakan.oct_provider,
									tunggakan.nov_provider,
									tunggakan.dec_provider,
									siswa_finance.nama_siswa,
									siswa_finance.kelas
									from tunggakan,siswa_finance
									where
									tunggakan.no_sisda = siswa_finance.no_sisda and
									tunggakan.jenis_tunggakan = 'catering' and
									tunggakan.periode = '$srch_periode' and
									$chk_no_sisda
									$chk_jenjang
									$chk_tingkat
									$chk_nama_siswa
									siswa_finance.aktif = '1' 
									
								"; 
			
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
                    <form method="post" action="?pl=edit_nominal_special_case_catering">
                    <input type="hidden" name="no_sisda" value="<?= $srch_no_sisda; ?>" />
                    <input type="hidden" name="nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                    <input type="hidden" name="jenjang" value="<?= $srch_jenjang; ?>" />
                    <input type="hidden" name="tingkat" value="<?= $srch_tingkat; ?>" />
                    <input type="hidden" name="periode" value="<?= $srch_periode; ?>" />
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
        	<form method="post" name="reg_adm_siswa" action="?pl=edit_nominal_special_case_catering_do">
            	<input type="hidden" name="no_sisda" value="<?= $srch_no_sisda; ?>" />
                <input type="hidden" name="nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                <input type="hidden" name="jenjang" value="<?= $srch_jenjang; ?>" />
                <input type="hidden" name="tingkat" value="<?= $srch_tingkat; ?>" />
                <input type="hidden" name="periode" value="<?= $srch_periode; ?>" />             
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="13" height="5"></td>
                </tr>
            	<tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="40" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No Sisda</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">status</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jenis<br />tunggakan</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jul</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Aug</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Sep</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Oct</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Nov</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Dec</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jan</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Feb</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Mar</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Apr</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">May</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">June</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Edit</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                <?PHP
				//$bg used to generate zebra background.
				$bg	="#ffffff";	
				
				function text_color($pref) {
				
					if($pref == 4  || $pref == 5 || $pref == 6 || $pref == 7) { echo "style='color:#cc0000;' title='Sudah dibayar / tidak ada tagihan'"; }
					if($pref == 2  || $pref == 1) { echo "style='color:#33cc99;' title='Belum dilakukan pembayaran'"; }
					if($pref == 0) { echo "style='color:#333333;' title='Belum ditagihkan'"; }
				
				}
				
				function provider($prov) {
				
					if($prov != "") { echo "<br>[".$prov."]"; } else { echo "<br>[ ----- ]"; }
				
				}
				
				//this is for row  number, you know...it starts from 0
				$row_number	= $the_limit + 1;
				
				while($get_siswa = mysql_fetch_array($query_get_siswa)) {
				
					$src_status = $get_siswa["status"];
					if($src_status == 0) { $status = "<img src='images/tunggakan_no.png' title='Tidak ada tunggakan'>"; }
					else if($src_status == 1) { $status = "<img src='images/tunggakan_yes.png' title='Memiliki tunggakan'>"; }
					else { $status = "<img src='images/tunggakan_what.png' title='Belum memiliki tunggakan (siswa baru)'>"; }
				?>
                <tr height="30">                	
                	<td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="40" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP /*The number of record will be similar with $the_limit*/echo $row_number++; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><b><?PHP echo $get_siswa["nama_siswa"]; ?></b><br /><?PHP echo $get_siswa["no_sisda"]; ?> [<?PHP echo $get_siswa["kelas"]; ?>]</td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $status; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["jenis_tunggakan"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["jul_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["jul_cataj"]; $prov = $get_siswa["jul_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["aug_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["aug_cataj"]; $prov = $get_siswa["aug_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["sep_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["sep_cataj"]; $prov = $get_siswa["sep_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["oct_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["oct_cataj"]; $prov = $get_siswa["oct_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["nov_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["nov_cataj"]; $prov = $get_siswa["nov_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP  $pref = substr($get_siswa["dec_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["dec_cataj"]; $prov = $get_siswa["dec_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["jan_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["jan_cataj"]; $prov = $get_siswa["jan_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["feb_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["feb_cataj"]; $prov = $get_siswa["feb_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["mar_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["mar_cataj"]; $prov = $get_siswa["mar_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["apr_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["apr_cataj"]; $prov = $get_siswa["apr_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["may_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["may_cataj"]; $prov = $get_siswa["may_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" <?PHP $pref = substr($get_siswa["jun_cataj"],0,1); text_color($pref); ?>><?PHP echo $get_siswa["jun_cataj"]; $prov = $get_siswa["jun_provider"]; provider($prov); ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <?PHP
					$prefix_jul = substr($get_siswa["jul_cataj"],0,1);
					$prefix_aug = substr($get_siswa["aug_cataj"],0,1);
					$prefix_sep = substr($get_siswa["sep_cataj"],0,1);
					$prefix_oct = substr($get_siswa["oct_cataj"],0,1);
					$prefix_nov = substr($get_siswa["nov_cataj"],0,1);
					$prefix_dec = substr($get_siswa["dec_cataj"],0,1);
					$prefix_jan = substr($get_siswa["jan_cataj"],0,1);
					$prefix_feb = substr($get_siswa["feb_cataj"],0,1);
					$prefix_mar = substr($get_siswa["mar_cataj"],0,1);
					$prefix_apr = substr($get_siswa["apr_cataj"],0,1);
					$prefix_may = substr($get_siswa["may_cataj"],0,1);
					$prefix_jun = substr($get_siswa["jun_cataj"],0,1);
					
					if(
					
						$prefix_jul == 2 || $prefix_jul == 1 ||
						$prefix_aug == 2 || $prefix_aug == 1 ||
						$prefix_sep == 2 || $prefix_sep == 1 ||
						$prefix_oct == 2 || $prefix_oct == 1 ||
						$prefix_nov == 2 || $prefix_nov == 1 ||
						$prefix_dec == 2 || $prefix_dec == 1 ||
						$prefix_jan == 2 || $prefix_jan == 1 ||
						$prefix_feb == 2 || $prefix_feb == 1 ||
						$prefix_mar == 2 || $prefix_mar == 1 ||
						$prefix_apr == 2 || $prefix_apr == 1 ||
						$prefix_may == 2 || $prefix_may == 1 ||
						$prefix_jun == 2 || $prefix_jun == 1
					
					) {
					?>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><button name="nosisdanya" value="<?PHP echo $get_siswa["no_sisda"]; ?>" onclick="submit()">edit</button></td>
                    <?PHP
					} else {
					?>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><input type="button" value="Fix" style="background-color:#990033; color:#ffffff; border:0;"></td>
                    <?PHP
					}
					?>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
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
                <tr>
                	<td colspan="11" height="30"></td>
                </tr>
             </table>
           	</form>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                    <td width="50"><span id="text_normal_black">Halaman: </span><td>
                    <td align="left"> 
                    <form method="post" action="mainpage.php?pl=edit_nominal_special_case_catering">
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