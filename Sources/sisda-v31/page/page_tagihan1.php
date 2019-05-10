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
        <td id="text_title_page1" align="center">Tagihan</td>
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
			$srch_kelas 		= (empty($_POST['kelas'])) ? '' : $_POST['kelas'];
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
			$show_per_page = 5;
			
			//So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
			//But you have to know, that the "limit" in mysql query is start with 0 not 1, based on MySQL 5.5 Reference manual.. 
			//Hahahahahahahahahahaha kamal doent know about it. He argues me strongly, that it starts from 1...hahahahaha. For this case, dont believe him, just believe me and the manual
			//And so so so, when $the_limit value is 0, the query will return row beginned from first record (number 1)
			//when $the_limit value is 10, the query will return row beginned from eleventh record (number 11)
			//when $the_limit value is 20, the query will return row beginned from eleventh record (number 21)
			$the_limit 	= ($src_limit * $show_per_page);
			
			$src_no_sisda_disct	= "select distinct no_sisda as no_sisda_chk from tunggakan where status = '1'";
			$query_no_sisda_disct	= mysqli_query($mysql_connect, $src_no_sisda_disct) or die(mysql_error());
			
			$src_buf_nom_biaya_masuk = "";
			$src_buf_nom_daftar_ulang = "";
			$src_buf_nom_spp = "";
			$src_buf_month_spp = "";
			$src_buf_nom_catering = "";
			$src_buf_month_catering = "";
			$src_buf_nom_antar_jemput = "";
			$src_buf_month_antar_jemput = "";
			
			$src_clear_buf_tung		= "delete from tunggakan_buf";
			$query_clear_buf_tung	= mysqli_query($mysql_connect, $src_clear_buf_tung) or die(mysql_error());
			
			if($query_clear_buf_tung) {
			
				while($row_no_sisda_distc = mysql_fetch_array($query_no_sisda_disct)) {
				
					$src_no_sisda_chk	= $row_no_sisda_distc['no_sisda_chk'];
					//echo $src_no_sisda_chk;
					
					
					$src_grab_tunggakan		= "select * from tunggakan left join siswa on siswa.no_sisda = tunggakan.no_sisda where tunggakan.no_sisda = '$src_no_sisda_chk' and  status = '1'"; 
					$query_grab_tunggakan	= mysqli_query($mysql_connect, $src_grab_tunggakan) or die(mysql_error());
					
					while($row_grab_tunggakan = mysql_fetch_array($query_grab_tunggakan)) {
						
						$src_buf_nama_siswa	= $row_grab_tunggakan['nama_siswa'];
						$src_buf_name 		= $row_grab_tunggakan["jenis_tunggakan"];
						$src_buf_kelas 		= $row_grab_tunggakan["kelas"];
						$src_buf_tingkat 	= $row_grab_tunggakan["tingkat"];
						$src_buf_periode	= $row_grab_tunggakan['periode'];
						
						if($row_grab_tunggakan["jenis_tunggakan"] == "biaya_masuk") {
						
							$src_buf_nom_biaya_masuk = $row_grab_tunggakan["nominal_tunggakan"];
						
						} else if($row_grab_tunggakan["jenis_tunggakan"] == "daftar_ulang") {
						
							$src_buf_nom_daftar_ulang = $row_grab_tunggakan["nominal_tunggakan"];
						
						} else if($row_grab_tunggakan["jenis_tunggakan"] == "spp") {
						
							$src_buf_tung_july		= $row_grab_tunggakan["july"];	$src_sts_tung_july = substr($src_buf_tung_july,0,1); $src_nom_tung_july = substr($src_buf_tung_july,2);
							$src_buf_tung_august 	= $row_grab_tunggakan["august"]; $src_sts_tung_august = substr($src_buf_tung_august,0,1); $src_nom_tung_august = substr($src_buf_tung_august,2);
							$src_buf_tung_september	= $row_grab_tunggakan["september"]; $src_sts_tung_september = substr($src_buf_tung_september,0,1); $src_nom_tung_september = substr($src_buf_tung_september,2);
							$src_buf_tung_october 	= $row_grab_tunggakan["october"]; $src_sts_tung_october = substr($src_buf_tung_october,0,1); $src_nom_tung_october = substr($src_buf_tung_october,2);
							$src_buf_tung_november 	= $row_grab_tunggakan["november"]; $src_sts_tung_november = substr($src_buf_tung_november,0,1); $src_nom_tung_november = substr($src_buf_tung_november,2);
							$src_buf_tung_december	= $row_grab_tunggakan["december"]; $src_sts_tung_december = substr($src_buf_tung_december,0,1); $src_nom_tung_december = substr($src_buf_tung_december,2);
							$src_buf_tung_january 	= $row_grab_tunggakan["january"]; $src_sts_tung_january = substr($src_buf_tung_january,0,1); $src_nom_tung_january = substr($src_buf_tung_january,2);
							$src_buf_tung_february 	= $row_grab_tunggakan["february"]; $src_sts_tung_february = substr($src_buf_tung_february,0,1); $src_nom_tung_february = substr($src_buf_tung_february,2);
							$src_buf_tung_march 	= $row_grab_tunggakan["march"]; $src_sts_tung_march = substr($src_buf_tung_march,0,1); $src_nom_tung_march = substr($src_buf_tung_march,2);
							$src_buf_tung_april		= $row_grab_tunggakan["april"]; $src_sts_tung_april = substr($src_buf_tung_april,0,1); $src_nom_tung_april = substr($src_buf_tung_april,2);
							$src_buf_tung_may 		= $row_grab_tunggakan["may"]; $src_sts_tung_may = substr($src_buf_tung_may,0,1); $src_nom_tung_may = substr($src_buf_tung_may,2);
							$src_buf_tung_june		= $row_grab_tunggakan["june"];	$src_sts_tung_june = substr($src_buf_tung_june,0,1); $src_nom_tung_june = substr($src_buf_tung_june,2);
						
							if($src_sts_tung_july == 2) { $src_buf_nom_spp = $src_nom_tung_august; $src_buf_month_spp = "July"; }
							if($src_sts_tung_august == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_august; $src_buf_month_spp = $src_buf_month_spp." August"; }
							if($src_sts_tung_september == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_september; $src_buf_month_spp = $src_buf_month_spp." September"; }
							if($src_sts_tung_october == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_october; $src_buf_month_spp = $src_buf_month_spp." October"; }
							if($src_sts_tung_november == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_november; $src_buf_month_spp = $src_buf_month_spp." November"; }
							if($src_sts_tung_december == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_december; $src_buf_month_spp = $src_buf_month_spp." December"; }
							if($src_sts_tung_january == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_january; $src_buf_month_spp = $src_buf_month_spp." January"; }
							if($src_sts_tung_february == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_february; $src_buf_month_spp = $src_buf_month_spp." February"; }
							if($src_sts_tung_march == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_march; $src_buf_month_spp = $src_buf_month_spp." March"; }
							if($src_sts_tung_april == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_april; $src_buf_month_spp = $src_buf_month_spp." April"; }
							if($src_sts_tung_may == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_may; $src_buf_month_spp = $src_buf_month_spp." May"; }
							if($src_sts_tung_june == 2) { $src_buf_nom_spp = $src_buf_nom_spp + $src_nom_tung_jun; $src_buf_month_spp = $src_buf_month_spp.	" June"; }
						
						} else if($row_grab_tunggakan["jenis_tunggakan"] == "catering") {
						
							$src_buf_tung_july_catering			= $row_grab_tunggakan["jul_cataj"]; $src_sts_tung_july_catering = substr($src_buf_tung_july_catering,0,1); $src_nom_tung_july_catering = substr($src_buf_tung_july_catering,2);
							$src_buf_tung_august_catering 		= $row_grab_tunggakan["aug_cataj"]; $src_sts_tung_august_catering = substr($src_buf_tung_august_catering,0,1); $src_nom_tung_august_catering = substr($src_buf_tung_august_catering,2);
							$src_buf_tung_september_catering	= $row_grab_tunggakan["sep_cataj"]; $src_sts_tung_september_catering = substr($src_buf_tung_september_catering,0,1); $src_nom_tung_september_catering = substr($src_buf_tung_september_catering,2);
							$src_buf_tung_october_catering 		= $row_grab_tunggakan["oct_cataj"]; $src_sts_tung_october_catering = substr($src_buf_tung_october_catering,0,1); $src_nom_tung_october_catering = substr($src_buf_tung_october_catering,2);
							$src_buf_tung_november_catering 	= $row_grab_tunggakan["nov_cataj"]; $src_sts_tung_november_catering = substr($src_buf_tung_november_catering,0,1); $src_nom_tung_november_catering = substr($src_buf_tung_november_catering,2);
							$src_buf_tung_december_catering		= $row_grab_tunggakan["dec_cataj"]; $src_sts_tung_december_catering = substr($src_buf_tung_december_catering,0,1); $src_nom_tung_december_catering = substr($src_buf_tung_december_catering,2);
							$src_buf_tung_january_catering 		= $row_grab_tunggakan["jan_cataj"]; $src_sts_tung_january_catering = substr($src_buf_tung_january_catering,0,1); $src_nom_tung_january_catering = substr($src_buf_tung_january_catering,2);
							$src_buf_tung_february_catering 	= $row_grab_tunggakan["feb_cataj"]; $src_sts_tung_february_catering = substr($src_buf_tung_february_catering,0,1); $src_nom_tung_february_catering = substr($src_buf_tung_february_catering,2);
							$src_buf_tung_march_catering 		= $row_grab_tunggakan["mar_cataj"]; $src_sts_tung_march_catering = substr($src_buf_tung_march_catering,0,1); $src_nom_tung_march_catering = substr($src_buf_tung_march_catering,2);
							$src_buf_tung_april_catering		= $row_grab_tunggakan["apr_cataj"]; $src_sts_tung_april_catering = substr($src_buf_tung_april_catering,0,1); $src_nom_tung_april_catering = substr($src_buf_tung_april_catering,2);
							$src_buf_tung_may_catering 			= $row_grab_tunggakan["may_cataj"]; $src_sts_tung_may_catering = substr($src_buf_tung_may_catering,0,1); $src_nom_tung_may_catering = substr($src_buf_tung_may_catering,2);
							$src_buf_tung_june_catering			= $row_grab_tunggakan["jun_cataj"]; $src_sts_tung_june_catering = substr($src_buf_tung_june_catering,0,1); $src_nom_tung_june_catering = substr($src_buf_tung_june_catering,2);
						
							if($src_sts_tung_july_catering == 2) { $src_buf_nom_catering = $src_nom_tung_august_catering; $src_buf_month_catering = "July"; }
							if($src_sts_tung_august_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_august_catering; $src_buf_month_catering = $src_buf_month_catering." August"; }
							if($src_sts_tung_september_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_september_catering; $src_buf_month_catering = $src_buf_month_catering." September"; }
							if($src_sts_tung_october_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_october_catering; $src_buf_month_catering = $src_buf_month_catering." October"; }
							if($src_sts_tung_november_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_november_catering; $src_buf_month_catering = $src_buf_month_catering." November"; }
							if($src_sts_tung_december_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_december_catering; $src_buf_month_catering = $src_buf_month_catering." December"; }
							if($src_sts_tung_january_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_january_catering; $src_buf_month_catering = $src_buf_month_catering." January"; }
							if($src_sts_tung_february_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_february_catering; $src_buf_month_catering = $src_buf_month_catering." February"; }
							if($src_sts_tung_march_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_march_catering; $src_buf_month_catering = $src_buf_month_catering." March"; }
							if($src_sts_tung_april_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_april_catering; $src_buf_month_catering = $src_buf_month_catering." April"; }
							if($src_sts_tung_may_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_may_catering; $src_buf_month_catering = $src_buf_month_catering." May"; }
							if($src_sts_tung_june_catering == 2) { $src_buf_nom_catering = $src_buf_nom_catering + $src_nom_tung_jun_catering; $src_buf_month_catering = $src_buf_month_catering." June"; }
						
						} else if($row_grab_tunggakan["jenis_tunggakan"] == "antar_jemput") {
						
							$src_buf_tung_july_antar_jemput			= $row_grab_tunggakan["jul_cataj"]; $src_sts_tung_july_antar_jemput = substr($src_buf_tung_july_antar_jemput,0,1); $src_nom_tung_july_antar_jemput = substr($src_buf_tung_july_antar_jemput,2);
							$src_buf_tung_august_antar_jemput 		= $row_grab_tunggakan["aug_cataj"]; $src_sts_tung_august_antar_jemput = substr($src_buf_tung_august_antar_jemput,0,1); $src_nom_tung_august_antar_jemput = substr($src_buf_tung_august_antar_jemput,2);
							$src_buf_tung_september_antar_jemput	= $row_grab_tunggakan["sep_cataj"]; $src_sts_tung_september_antar_jemput = substr($src_buf_tung_september_antar_jemput,0,1); $src_nom_tung_september_antar_jemput = substr($src_buf_tung_september_antar_jemput,2);
							$src_buf_tung_october_antar_jemput 		= $row_grab_tunggakan["oct_cataj"]; $src_sts_tung_october_antar_jemput = substr($src_buf_tung_october_antar_jemput,0,1); $src_nom_tung_october_antar_jemput = substr($src_buf_tung_october_antar_jemput,2);
							$src_buf_tung_november_antar_jemput 	= $row_grab_tunggakan["nov_cataj"]; $src_sts_tung_november_antar_jemput = substr($src_buf_tung_november_antar_jemput,0,1); $src_nom_tung_november_antar_jemput = substr($src_buf_tung_november_antar_jemput,2);
							$src_buf_tung_december_antar_jemput		= $row_grab_tunggakan["dec_cataj"]; $src_sts_tung_december_antar_jemput = substr($src_buf_tung_december_antar_jemput,0,1); $src_nom_tung_december_antar_jemput = substr($src_buf_tung_december_antar_jemput,2);
							$src_buf_tung_january_antar_jemput 		= $row_grab_tunggakan["jan_cataj"]; $src_sts_tung_january_antar_jemput = substr($src_buf_tung_january_antar_jemput,0,1); $src_nom_tung_january_antar_jemput = substr($src_buf_tung_january_antar_jemput,2);
							$src_buf_tung_february_antar_jemput 	= $row_grab_tunggakan["feb_cataj"]; $src_sts_tung_february_antar_jemput = substr($src_buf_tung_february_antar_jemput,0,1); $src_nom_tung_february_antar_jemput = substr($src_buf_tung_february_antar_jemput,2);
							$src_buf_tung_march_antar_jemput 		= $row_grab_tunggakan["mar_cataj"]; $src_sts_tung_march_antar_jemput = substr($src_buf_tung_march_antar_jemput,0,1); $src_nom_tung_march_antar_jemput = substr($src_buf_tung_march_antar_jemput,2);
							$src_buf_tung_april_antar_jemput		= $row_grab_tunggakan["apr_cataj"]; $src_sts_tung_april_antar_jemput = substr($src_buf_tung_april_antar_jemput,0,1); $src_nom_tung_april_antar_jemput = substr($src_buf_tung_april_antar_jemput,2);
							$src_buf_tung_may_antar_jemput 			= $row_grab_tunggakan["may_cataj"]; $src_sts_tung_may_antar_jemput = substr($src_buf_tung_may_antar_jemput,0,1); $src_nom_tung_may_antar_jemput = substr($src_buf_tung_may_antar_jemput,2);
							$src_buf_tung_june_antar_jemput			= $row_grab_tunggakan["jun_cataj"]; $src_sts_tung_june_antar_jemput = substr($src_buf_tung_june_antar_jemput,0,1); $src_nom_tung_june_antar_jemput = substr($src_buf_tung_june_antar_jemput,2);
						
							if($src_sts_tung_july_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_nom_tung_august_antar_jemput; $src_buf_month_antar_jemput = "July"; }
							if($src_sts_tung_august_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_august_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." August"; }
							if($src_sts_tung_september_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_september_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." September"; }
							if($src_sts_tung_october_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_october_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." October"; }
							if($src_sts_tung_november_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_november_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." November"; }
							if($src_sts_tung_december_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_december_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." December"; }
							if($src_sts_tung_january_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_january_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." January"; }
							if($src_sts_tung_february_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_february_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." February"; }
							if($src_sts_tung_march_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_march_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." March"; }
							if($src_sts_tung_april_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_april_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." April"; }
							if($src_sts_tung_may_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_may_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." May"; }
							if($src_sts_tung_june_antar_jemput == 2) { $src_buf_nom_antar_jemput = $src_buf_nom_antar_jemput + $src_nom_tung_jun_antar_jemput; $src_buf_month_antar_jemput = $src_buf_month_antar_jemput." June"; }
						
						}
					
					}
					
					$buf_nom_total = $src_buf_nom_biaya_masuk + $src_buf_nom_daftar_ulang + $src_buf_nom_spp + $src_buf_nom_catering + $src_buf_nom_antar_jemput;
						
					$src_input_buffer = "insert into tunggakan_buf
											(
												no_sisda,
												periode,
												nama_siswa,
												tingkat,
												kelas,
												biaya_masuk,
												daftar_ulang,
												spp,
												bulan_spp,
												catering,
												bulan_catering,
												antar_jemput,
												bulan_antar_jemput,
												nominal_total
											) values (
												'$src_no_sisda_chk',
												'$src_buf_periode',
												'$src_buf_nama_siswa',
												'$src_buf_tingkat',
												'$src_buf_kelas',
												'$src_buf_nom_biaya_masuk',
												'$src_buf_nom_daftar_ulang',
												'$src_buf_nom_spp',
												'$src_buf_month_spp',
												'$src_buf_nom_catering',
												'$src_buf_month_catering',
												'$src_buf_nom_antar_jemput',
												'$src_buf_month_antar_jemput',
												'$buf_nom_total'
											)
											"; 
						$query_input_buffer	= mysqli_query($mysql_connect, $src_input_buffer) or die(mysql_error());	
					
				}
			
			}
			
			//weleh-weleh, take a look at this query.....
			//$the_limit       = defines where should the query begin from
			//$show_per_page   = defines how many record should be shown
			$src_get_siswa		= "select 
									no_sisda,
									periode,
									nama_siswa,
									tingkat,
									kelas,
									biaya_masuk,
									daftar_ulang,
									spp,
									bulan_spp,
									catering,
									bulan_catering,
									antar_jemput,
									bulan_antar_jemput,
									nominal_total
									
									from tunggakan_buf
									
									where 
																	
									no_sisda like '%$srch_no_sisda%' and
									nama_siswa like '%$srch_nama_siswa%' and
									tingkat like '%$srch_tingkat%' and
									kelas like '%$srch_kelas%' and 	
									periode like '%$srch_periode%' 
									$where_tangtran
									
									order by no_sisda, periode limit $the_limit,$show_per_page "; 
			//tanggal_transaksi between '%$srch_datetra_begin%' and '%$srch_datetra_end%' and
			
			
			//echo	$src_get_siswa;					
			//but also, we need to select all record. it will be used to define the paging list.
			$src_get_siswa_all	= "select 
			
									no_sisda,
									periode,
									nama_siswa,
									tingkat,
									kelas,
									biaya_masuk,
									daftar_ulang,
									spp,
									bulan_spp,
									catering,
									bulan_catering,
									antar_jemput,
									bulan_antar_jemput,
									nominal_total
									
									from tunggakan_buf
									
									where 
																	
									no_sisda like '%$srch_no_sisda%' and
									nama_siswa like '%$srch_nama_siswa%' and
									tingkat like '%$srch_tingkat%' and
									kelas like '%$srch_kelas%' and 	
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
            <form name="search" method="post" action="?pl=tagihan">
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
                    <td align="left" id="text_normal_black">Kelas</td>
                    <td width="20"></td>
                    <td>
                    <?PHP
					$src_nama_kelas 	= "select * from kelas";
					$query_nama_kelas	= mysqli_query($mysql_connect, $src_nama_kelas) or die(mysqli_query($mysql_connect, ));
					?>
                    <select name="kelas">
                    <option value="">Pilih</option>
                    <?PHP
					while($row_nama_kelas = mysql_fetch_array($query_nama_kelas)) {
					?>
                    <option value="<?= $row_nama_kelas["nama_kelas"]; ?>"><?= $row_nama_kelas["nama_kelas"]; ?></option>
                    <?PHP
					}
					?>
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
                    <form method="post" action="mainpage.php?pl=tagihan">
                    <input type="hidden" name="no_sisda" value="<?= $srch_no_sisda; ?>" />
                    <input type="hidden" name="nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                    <input type="hidden" name="kelas" value="<?= $srch_kelas; ?>" />
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
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">No</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">No Sisda</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Periode</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Nama siswa</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Tingkat</td>
                  	<td width="" bgcolor="#999999" id="text_normal_white" align="center">kelas</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Biaya Masuk</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Daftar Ulang</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Bulan SPP</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">SPP</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Bulan Catering</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Catering</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Bulan A-J</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Antar Jemput</td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Total Tagihan</td>
            	</tr>
                <?PHP
				//$bg used to generate zebra background.
				$bg	="#ffffff";	
				//This is for row  number, you know...it starts from 0
				$row_number	= $the_limit + 1;
				
				while($get_siswa = mysql_fetch_array($query_get_siswa)) {
				?>
                <tr height="30">                
                    <td width="40" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP /*The number of record will be similar with $the_limit*/echo $row_number++; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["no_sisda"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["periode"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["nama_siswa"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["tingkat"]; ?></td>
                  	<td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["kelas"]; ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["biaya_masuk"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["biaya_masuk"],0,",",".").",-"; } ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["daftar_ulang"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["daftar_ulang"],0,",",".").",-"; } ?></td>
					<td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["bulan_spp"] == '') { echo "-"; } else { echo $get_siswa["bulan_spp"]; } ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["spp"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["spp"],0,",",".").",-"; } ?></td>
                	<td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["bulan_catering"] == '') { echo "-"; } else { echo $get_siswa["bulan_catering"]; } ?></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["catering"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["catering"],0,",",".").",-"; } ?></td>
                	<td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["bulan_antar_jemput"] == 0){ echo "-"; } else { echo $get_siswa["bulan_antar_jemput"]; } ?></td>
      				<td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["antar_jemput"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["antar_jemput"],0,",",".").",-"; } ?></td>
                	<td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_siswa["nominal_total"] == 0) { echo "0"; } else { echo "Rp".number_format($get_siswa["nominal_total"],0,",",".").",-"; } ?></td>
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
                    <form method="post" action="mainpage.php?pl=tagihan">
                    <input type="hidden" name="no_sisda" value="<?= $srch_no_sisda; ?>" />
                    <input type="hidden" name="nama_siswa" value="<?= $srch_nama_siswa; ?>" />
                    <input type="hidden" name="kelas" value="<?= $srch_kelas; ?>" />
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