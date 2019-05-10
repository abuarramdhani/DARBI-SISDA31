<?PHP
//Yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {


	//kenapa ada fle ini/ karena kita ada butuh $edu_year & $cur_month
	include_once("include/check_date_error.php");
	
	/////////////////////
	//tahun ajaran ini penting banget, makanya didefinisikan duluan
	$sis_fin_cur_year	= date("Y");
	$sis_fin_cur_month	= strtolower(date("F"));
	
	if($sis_fin_cur_month == "january" || $sis_fin_cur_month == "february" || $sis_fin_cur_month == "march" || $sis_fin_cur_month == "april" || $sis_fin_cur_month == "may" || $sis_fin_cur_month == "june") {	
		
		$edu_year_siswa	= ($sis_fin_cur_year-1)." - ".$sis_fin_cur_year;
		
	} else if ($sis_fin_cur_month == "july" || $sis_fin_cur_month == "august" || $sis_fin_cur_month == "september" || $sis_fin_cur_month == "october" || $sis_fin_cur_month == "november" || $sis_fin_cur_month == "december") {	
		
		$edu_year_siswa	= $sis_fin_cur_year." - ".($sis_fin_cur_year+1);
	}
	
	$edu_year_siswa_next = (substr($edu_year_siswa,0,4) + 1) . " - " . (substr($edu_year_siswa,7,4) + 1);
	
	/*
	//////////////////////////////////////////////////////////////////////
		 
	Ini lo mas, kita mau cek apakah data finance baik-baik ajah 
	1. siswa_finance dan tunggakan tahun ini
	2. siswa_finance dan tunggakan tahun ajaran depan, klo ternyata setting SPP tahun depan untuk tingkat siswa ini dah dibuat lengkap	
	3. Klo no 1 & 2 di atas belum dibuat, maka akan kita buat sekarang.  
	
	///////////////////////////////////////////////////////////////////////
	*/
	if(!empty($_POST["no_sisda"]) || !empty($_GET["no"])) {
	
		$no_sisda_enc = empty($_POST["no_sisda"]) ? $_GET["no"] : $_POST["no_sisda"];
		
		////// kita check siswa finance tahun ajaran sekarang, sudah ada atau belum
		////// $edu_year_siswa = tahun ajaran sekarang 
		$src_check_cur_siswa_finance 	= "select id from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$edu_year_siswa'";
		$query_check_cur_siswa_finance	= mysqli_query($mysql_connect, $src_check_cur_siswa_finance) or die(mysql_error());
		$row_check_cur_siswa_finance	= mysql_fetch_array($query_check_cur_siswa_finance);
		$num_check_cur_siswa_finance	= mysql_num_rows($query_check_cur_siswa_finance);
		
		if($num_check_cur_siswa_finance != 0  ) {
		
			$do_add_siswa_finance = "gak";
			//echo "<h1>fffffffffff</h1>";
		
			///// kalau ternyata data siswa finance untuk tahun sekarang ada dan baik-baik saja, kita check data tunggakan untuk tahun ajaran sekarang
			$src_check_cur_tunggakan	= "select id from tunggakan where no_sisda = '$no_sisda_enc' and periode = '$edu_year_siswa' and jenis_tunggakan = 'spp'";
			$query_check_cur_tunggakan	= mysqli_query($mysql_connect, $src_check_cur_tunggakan) or die(mysql_error());
			$num_check_cur_tunggakan	= mysql_num_rows($query_check_cur_tunggakan);
			
			if($num_check_cur_tunggakan == 0) {
			
				$do_add_siswa_finance = "iya";
				$what = 1;	
				//echo "<h1>kkkkkkkk</h1>";								
			
			} else {
			
				$do_add_siswa_finance = "gak";
				//echo "<h1>hhhhhhhhh</h1>";
			
			}
			
		} else {
		
			//Ini digunakan untuk kondisi, siswa baru ajaran tahun depan
			//Faktanya darbi open registration di bulan december, yang artinya data_finance siswa baru tersebut sudah ada pada tahun ajaran sekarang
			//Justru dia TIDAK PUNYA DATA_FINANCE TAHUN AJARAN SEKARANG
			//Iya toh? toh iya?
			//pegel euy
			//nah sekarang kita pastikan bahwa siswa ini emang anak baru daftar yang punya data_finance tahun depan
			$src_check_next_siswa_finance 	= "select id from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$edu_year_siswa_next'";
			$query_check_next_siswa_finance = mysqli_query($mysql_connect, $src_check_next_siswa_finance) or die(mysql_error());
			$num_check_next_siswa_finance	= mysql_num_rows($query_check_next_siswa_finance);
			
			if($num_check_next_siswa_finance = 0) {
		
				$do_add_siswa_finance = "iya";
				$what = 2;
				//echo "<h1>jjjjjjjj</h1>";
				
			} else {
			
				$do_add_siswa_finance = "gak";
				//echo "<h1>hhhhhhhhh</h1>";
			
			}
		
		}
		
		if($do_add_siswa_finance == "iya") {
		
			//echo "<h1>sdfdfsdfsdfds</h1>";
			
		?>
		<script type="text/javascript">
		<!-- -->
		window.location = "engine.php?case=add_sisfin_tung&ns=<?= $no_sisda_enc; ?>&p=<?= $edu_year_siswa; ?>&sf=<?= $do_add_siswa_finance; ?>&what=<?= $what; ?>"
		<!-- //-->
		</script>
		<?PHP
		}
	
	}
	
	/////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////

	if(!empty($_POST["no_sisda"]) || !empty($_GET["no"])) {
	
		if(!empty($_POST["no_sisda"])) {
			
			$no_sisda_enc	= htmlspecialchars($_POST["no_sisda"]);
			
		} else if(!empty($_GET["no"])) {
		
			$no_sisda_enc	= htmlspecialchars($_GET["no"]);
			
		}
	
		//$no_sisda_enc	= htmlspecialchars($_POST["no_sisda"]);
		$no_sisda_esc	= mysql_real_escape_string($no_sisda_enc);
		
		
		//aktif = '1' berarti masih ada tunggakan
		$src_select_siswa 	= "select * from siswa_finance where no_sisda = '$no_sisda_esc' and aktif ='1'";
		$query_select_siswa	= mysqli_query($mysql_connect, $src_select_siswa) or die(mysql_error());
		$num_select_siswa	= mysql_num_rows($query_select_siswa);
		$row_select_siswa	= mysql_fetch_array($query_select_siswa);
		
		if($num_select_siswa > 0) {
		
			$select_siswa		= mysql_fetch_array($query_select_siswa);
?>
<!-- i dont think that i should give many comments here, hope you understand the script step by step -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Transaksi</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#003366">            	
                <tr>
                	<td height="10" colspan="5">&nbsp;</td>
                </tr>
                <tr height="20">
                	<td width="20">&nbsp;</td>
                    <td>
                    	<form id="form" name="check_id" method="post" action="mainpage.php?pl=transaction" style="padding:0px; ">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">            	
                            <tr height="20">
                                <td width="10" bgcolor="#000000"></td>
                                <td width="200" bgcolor="#000000" id="text_normal_white">Cari nama siswa lainnya</td>
                                <td width="5"></td>
                                <td width="10" align="left">
                                <link media="screen" type="text/css" rel="stylesheet" href="global_style/auto_suggest_form.css">
								<script type="text/javascript" src="global_js/jquery_1.3.2.js"></script>
                                <script type="text/javascript" src="global_js/auto_suggest_form_id_sisda.js"></script>
                                    
                                <div id="suggest">
                                <input type="text" size="25" name="no_sisda" value="" id="sisda_id" onkeyup="suggest(this.value);" onblur="fill();" class="" placeholder="Nama siswa" style="width:300px; height:35px;" />                         
                                <div class="suggestionsBox" id="suggestions" style="display: none; padding:0px; left:0px;"> <!--<img src="arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />-->
                                    <div class="suggestionList" id="suggestionsList" style="padding:0px;"> &nbsp; </div>
                                </div>
                                </div>                               
                                </td>
                                <td width="10">&nbsp;</td>
                                <td>
                                <!-- the verification function returned here, in submit button, check the whole script below -->
                                <input type="submit" value="Lakukan transaksi" onClick="return verification1()" style="width:208px; height:35px;"/><input type="reset" value="Kosongkan" style="width:208px; height:35px;" />
                                <input type="button" value="Lihat seluruh siswa" onclick="javascript:void window.open('popup.php?pl=chk_no_sisda','','width=700,height=500,toolbar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0'); return false;" />
                                </td>
                            </tr>
                        </table>
                        </form>
                    </td>
                    <td width="10">&nbsp;</td>
               </tr>
               <tr>
                	<td height="10" colspan="5">&nbsp;</td>
               </tr>
            </table>
        </td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td align="center">
        	<form name="transaksi" method="post" action="engine.php?case=add_transaction">
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
        	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f1f1f1">            	
                <tr>
                	<td height="10" colspan="5">&nbsp;</td>
                </tr>
            	<tr height="20">
                	<td width="20">&nbsp;</td>
                    <td colspan="3">
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f1f1f1">            	
                            <tr height="20">
                            	<td width="10" bgcolor="#999999"></td>
                                <td width="200" bgcolor="#999999" id="text_normal_white">No. SISDA</td>
                                <td width="5"></td>
                                <td align="left" style="font-size:18px; color:#FF6600; font-family:verdana;"><input type="hidden" name="no_sisda" value="<?PHP echo $no_sisda_enc; ?>" /><?PHP echo $no_sisda_enc; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="5"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#999999"></td>
                                <td bgcolor="#999999" id="text_normal_white">Nama</td>
                                <td></td>
                                <td align="left" style="font-size:22px; color:#CC3366; font-family:verdana;"><input type="hidden" name="nama_siswa" value="<?PHP echo $row_select_siswa["nama_siswa"]; ?>" /><?PHP echo $row_select_siswa["nama_siswa"]; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="5"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#999999"></td>
                                <td bgcolor="#999999" id="text_normal_white">Kelas</td>
                                <td></td>
                                <td align="left" style="font-size:18px; color:#993366; font-family:verdana;"><input type="hidden" name="kelas" value="<?PHP echo $row_select_siswa["kelas"]; ?>" /><?PHP echo $row_select_siswa["kelas"]; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="5">
                                <input type="hidden" name="jenjang" value="<?PHP echo $row_select_siswa["jenjang"]; ?>" />
                                <input type="hidden" name="tingkat" value="<?PHP echo $row_select_siswa["tingkat"]; ?>" />
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="10">&nbsp;</td>
                </tr>
                <tr>
                	<td height="10" colspan="5">&nbsp;</td>
                </tr>
                <tr>
                	<td></td>
                	<td height="10" colspan="3"><hr noshade="noshade" size="1" color="#CCCCCC" /></td>
                    <td></td>
                </tr>
                <tr height="20">
                	<td width="10">&nbsp;</td>
                    <td>
                    <span id="text_normal_black"><h2>Detail Transaksi</h2></span>
                    <a title="Show Table #1a" href="javascript:toggleDisplay('1')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM1"></a>
                    <span>&nbsp;</span>
                    <div style="display:none;" id="table1">
                    	<?PHP 
						$src_tuk_transaksi		= "select * from transaksi where no_sisda = '$no_sisda_esc'";
						$query_tuk_transaksi	= mysqli_query($mysql_connect, $src_tuk_transaksi) or die(mysql_error());
						$num_tuk_transaksi		= mysql_num_rows($query_tuk_transaksi);
						
						if($num_tuk_transaksi = 0) {
						?>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                            	<td bgcolor="#666633" align="center" id="text_normal_black">&nbsp;</td>
                            </tr>  
                            <tr>
                            	<td bgcolor="#666633" id="text_normal_black">Belum ada transaksi yang dilakukan</td>
                            </tr>
                            <tr>
                            	<td bgcolor="#666633" align="center" id="text_normal_black">&nbsp;</td>
                            </tr>
                       </table> 
                        <?PHP
						$his_pengembangan 	= 0;
						$his_kegistan 		= 0;
						$his_seragam		= 0;
						$his_peralatan		= 0;
						$his_paket			= 0;
						
						$his_spp			= 0;
						$his_ict			= 0;
						$his_elearning		= 0;
						$his_ks				= 0;
						
						
						
						
						} else { 
						
							while($row_tuk_transaksi = mysql_fetch_array($query_tuk_transaksi)) {
							
								$x=0;
							}
						?>
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                            	<td bgcolor="#666633" colspan="5" align="center" id="text_normal_black">&nbsp;</td>
                            </tr>         	
                            <tr height="20">
                            	<td width="10" bgcolor="#666633"></td>
                                <td bgcolor="#ffffff" valign="top">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>Penerimaan Murid baru</b></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>          	
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Total Biaya Masuk</td>
                                            <td width="5"></td>
                                            <td width="10" align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Total yang sudah dibayarkan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td></td>
                                            <td id="text_normal_black">Kekurangan pembayaran</td>
                                            <td></td>
                                            <td align="left"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Pengembangan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Kegiatan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Seragam</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Peralatan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Paket</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">SPP Juli</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Total Tagihan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Follow Up Tagihan</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black">masih bingung disini (inputnya dari mana)</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td></td>
                                            <td colspan="5"><input type="button" value="History PMB" onclick="window.location.href='?pl=reg_nextclass_adm_siswa<?PHP echo $use_get_var; ?>';" style="height:40px; width:150px;" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="10" bgcolor="#666633"></td>
                                <td bgcolor="#ffffff" valign="top">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>Daftar Ulang</b></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>              	
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Total Daftar Ulang</td>
                                            <td width="5"></td>
                                            <td width="10" align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Total yang sudah dibayarkan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td></td>
                                            <td id="text_normal_black">Kekurangan pembayaran</td>
                                            <td></td>
                                            <td align="left"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Kegiatan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Peralatan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Seragam</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Total Tagihan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Follow Up Tagihan</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black">masih bingung disini (inputnya dari mana)</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="70"></td>
                                        </tr>
                                        <tr>
                                        	<td></td>
                                            <td colspan="5"><input type="button" value="History Daftar ulang" onclick="window.location.href='?pl=reg_nextclass_adm_siswa<?PHP echo $use_get_var; ?>';" style="height:40px; width:150px;" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                     </table>
                                </td>
                                <td width="10" bgcolor="#666633"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#666633" colspan="5">&nbsp;</td>
                            </tr>    
                        </table>                     
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr height="20">
                            	<td width="10" bgcolor="#666633"></td>
                                <td bgcolor="#ffffff" valign="top">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>SPP</b></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>          	
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">SPP</td>
                                            <td width="5"></td>
                                            <td width="10" align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">ICT</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">E-Learning</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">KS</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Total</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Terakhir bayar</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Banyaknya</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Total Tagihan</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Follow Up Tagihan</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black">masih bingung disini (inputnya dari mana)</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td></td>
                                            <td colspan="5"><input type="button" value="History SPP" onclick="window.location.href='?pl=reg_nextclass_adm_siswa<?PHP echo $use_get_var; ?>';" style="height:40px; width:150px;" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="10" bgcolor="#666633"></td>
                                <td bgcolor="#ffffff" valign="top">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>Rumah Berbagi dan support school</b></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>              	
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Zakat Mal</td>
                                            <td width="5"></td>
                                            <td width="10" align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Zakat Profesi</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Infaq/Shodaqoh</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Wakaf</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Lain-lain</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Total</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Follow Up Tagihan</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black">masih bingung disini (inputnya dari mana)</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td></td>
                                            <td colspan="5"><input type="button" value="History Rumah berbagi" onclick="window.location.href='?pl=reg_nextclass_adm_siswa<?PHP echo $use_get_var; ?>';" style="height:40px; width:150px;" /><input type="button" value="History School Support" onclick="window.location.href='?pl=reg_nextclass_adm_siswa<?PHP echo $use_get_var; ?>';" style="height:40px; width:150px;" /></td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                     </table>
                                </td>
                                <td width="10" bgcolor="#666633"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#666633" colspan="5">&nbsp;</td>
                            </tr>    
                        </table>
                        <?PHP
						}
						?>
                    </div>    
                    </td>
                    <td width="10">&nbsp;</td>
                </tr>
                <tr>
                	<td height="10" colspan="5">&nbsp;</td>
                </tr>
                <tr height="20">
                	<td width="10">&nbsp;</td>
                    <td>
                    	<?PHP //<form name="transaksi" method="post" action="engine.php?case=add_transaction"> ?>
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#669999">  
                            <tr>
                                <td colspan="6" height="15"></td>
                            </tr>
                            <tr height="20">
                                <td width="10"></td>
                                <td width="10" bgcolor="#999999"></td>
                                <td width="200" bgcolor="#999999" id="text_normal_white">Tanggal Transaksi</td>
                                <td width="5"></td>
                                <td align="left"><select name="tanggal_transaksi"><?PHP include("include/cur_date_opt.php"); ?></select><select name="bulan_transaksi"><?PHP include("include/cur_month_opt.php"); ?></select><select name="tahun_transaksi"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6" height="5"></td>
                            </tr>
                            <tr height="20">
                                <td width="10"></td>
                                <td width="10" bgcolor="#999999"></td>
                                <td width="200" bgcolor="#999999" id="text_normal_white">Cara Pembayaran</td>
                                <td width="5"></td>
                                <td align="left">
                                <select name="teknik_pembayaran" id="chk1" onchange="javascript:toggleSelect();">
                                <option value="">Pilih</option>
                                <option value="tunai">Tunai</option>
                                <option value="transfer">Transfer</option>
                                </select>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6" height="5"></td>
                            </tr>
                            <tr height="20">
                                <td width="10"></td>
                                <td width="10" bgcolor="#999999"></td>
                                <td width="200" bgcolor="#999999" id="text_normal_white">Tanggal transfer</td>
                                <td width="5"></td>
                                <td align="left"><select name="tanggal_transfer"><?PHP include("include/cur_date_opt.php"); ?></select><select name="bulan_transfer"><?PHP include("include/cur_month_opt.php"); ?></select><select name="tahun_transfer"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="6" height="5"></td>
                            </tr>
                            <tr height="20">
                                <td width="10"></td>
                                <td width="10" bgcolor="#999999"></td>
                                <td width="200" bgcolor="#999999" id="text_normal_white">Bank tujuan</td>
                                <td width="5"></td>
                                <td align="left">
                                <?PHP
								$src_get_bank	= "select * from bank";
								$query_get_bank	= mysqli_query($mysql_connect, $src_get_bank) or die("Terjadi kesalahan: ".mysql_error());
								?>
                                <select name="bank_tujuan">
                                <option value="">Pilih</option>
                                <?PHP
								while($get_bank = mysql_fetch_array($query_get_bank)) {								
								
								?>
                                <option value="<?= strtolower($get_bank["bank_name"]); ?>"><?= $get_bank["bank_name"]; ?></option>
                                <?PHP
								}
								?>
                                </select>
                                </td>
                                <td>&nbsp;</td>
                            </tr>                            
                            <tr>
                                <td colspan="6" height="10"></td>
                            </tr>
                        </table>
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                            	<td bgcolor="#b9d4de" colspan="5" align="center" id="text_normal_black">&nbsp;</td>
                            </tr>         	
                            <tr height="20">
                            	<td width="10" bgcolor="#b9d4de"></td>
                                <td bgcolor="" valign="top">
                                	<?PHP 
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									/////////////////////// --DAFTAR ULANG-- //////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									?>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>Daftar Ulang</b></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                        	<td colspan="5" height="10"><a title="Show Table #1a" href="javascript:toggleDisplay('2')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM2"></a></td>
                                        </tr>
                                    </table>
                                    <div style="display:none;" id="table2"> 
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td width="10" ></td>
                                        	<td colspan="4" height="10"><input type="button" value="Data Keuangan" onclick="javascript:void window.open('popup.php?pl=pop_history_daful$no=<?= $no_sisda_enc; ?>','','width=700,height=500,toolbar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0'); return false;" /><input type="button" value="History Pembayaran Daftar Ulang" onclick="javascript:void window.open('popup.php?pl=pop_history_daful&no=<?= $no_sisda_enc; ?>','','width=1000,height=500,toolbar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0'); return false;" /></td>
                                            <td width="10" ></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <?PHP
										$src_check_arrear_daftar_ulang		= "select nominal_tunggakan,periode from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'daftar_ulang' and status = '1'";
										$query_check_arrear_daftar_ulang	= mysqli_query($mysql_connect, $src_check_arrear_daftar_ulang) or die(mysql_error());
										$num_check_arrear_daftar_ulang		= mysql_num_rows($query_check_arrear_daftar_ulang);
										
										if($num_check_arrear_daftar_ulang != 0) {
										?> 
                                        <tr height="20">
                                            <td width="10" ></td>
                                            <td colspan="4">                                            
                                            	<table bgcolor="#999999" border="0" cellpadding="0" cellspacing="0">
                                                	<tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>                                                   
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#1c252f"></td>
                                                        <td width="200" bgcolor="#1c252f" id="text_normal_white">Biaya masuk yang belum dibayarkan <img src="images/what_happen_aya_naon.jpg" border="0" onMouseOver="stm(Text[2],Style[12])" onMouseOut="htm()" /></td>
                                                        <td width="5" bgcolor=""></td>
                                                        <td width="10" bgcolor="#1c252f" align="left">
                                                        	<table width="250" border="0" cellpadding="0" cellspacing="0" id="text_normal_white">
                                                            	<tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr> 
                                                                <?PHP
																$nom_daftar_ulang = 0;
																while($row_check_arrear_daftar_ulang = mysql_fetch_array($query_check_arrear_daftar_ulang)) {
																?>
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td style="color:#88cd3e;" colspan="3"><b><?= $row_check_arrear_daftar_ulang["periode"]; ?></b></td>
                                                                </tr>                                                                
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td colspan="3">[ Rp <?= number_format($row_check_arrear_daftar_ulang["nominal_tunggakan"],0,",",".").",-"; ?> ]</td>
                                                                </tr>                                                                                                                                
                                                                <?PHP
																	$nom_daftar_ulang += $row_check_arrear_daftar_ulang["nominal_tunggakan"];
																}
																?>
                                                                <tr>
                                                                    <td colspan="4" height="10"></td>
                                                                </tr>	
                                                            </table>
                                                        </td>
                                                        <td width="10" bgcolor="#1c252f">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr height="40">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#FFFF99"></td>
                                                        <td width="200" bgcolor="#FFFF99" id="text_normal_black">Tagihan daftar ulang yang belum dibayarkan</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#FFFF99" align="left" id="text_normal_black">&nbsp;<b style="font-size:16px;"><?= "Rp ".number_format($nom_daftar_ulang,0,",",".").",-"; ?></b></td>
                                                        <td width="10" bgcolor="#FFFF99">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                    <tr height="30">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#7b8a74"></td>
                                                        <td width="200" bgcolor="#7b8a74" id="text_normal_white">Tahun ajaran</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#7b8a74" align="left" id="text_normal_black">
                                                        <select name="year_daftar_ulang" size="3" style="width: 150px">
														<?PHP $cur_spp_year = date("Y"); ?>
                                                        <?PHP //<option selected>Pilih tahun ajaran</option> ?>
                                                        <option value="<?PHP echo ($cur_spp_year-2)." - ".($cur_spp_year-1); ?>"><?PHP echo ($cur_spp_year-2)." - ".($cur_spp_year-1); ?></option>
                                                        <option value="<?PHP echo ($cur_spp_year-1)." - ".($cur_spp_year); ?>"><?PHP echo ($cur_spp_year-1)." - ".($cur_spp_year); ?></option>
                                                        <option value="<?PHP echo ($cur_spp_year)." - ".($cur_spp_year+1); ?>"><?PHP echo ($cur_spp_year)." - ".($cur_spp_year+1); ?></option>
                                                        </select>
                                                        </td>
                                                        <td width="10" bgcolor="#7b8a74">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr height="30">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#7b8a74"></td>
                                                        <td width="200" bgcolor="#7b8a74" id="text_normal_white">Daftar ulang</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#7b8a74" align="left" id="text_normal_black"><input type="text" name="nom_daful" onkeypress="return checkIt(event)" onKeyUp="MakeSum();" /></td>
                                                        <td width="10" bgcolor="#7b8a74">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr> 
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <?PHP
													/*
                                                    <tr height="30">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#7b8a74"></td>
                                                        <td width="200" bgcolor="#7b8a74" id="text_normal_white">Lunas/Cicilan ke</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#7b8a74" align="left" id="text_normal_black"><input type="text" name="luncil_daful" onkeypress="return checkIt(event)" /></td>
                                                        <td width="10" bgcolor="#7b8a74">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>  
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
													*/
													?>
                                                    <tr height="50">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#333333"></td>
                                                        <td width="200" bgcolor="#333333" id="text_normal_white">Subtotal Daftar Ulang</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#333333" align="left" id="text_normal_black"><input type="text" name="subtotal_daful" style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                                        <td width="10" bgcolor="#333333">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                 </table>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr> 
                                        <?PHP
										/*
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Kekurangan</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="kekurangan_daful" onkeypress="return checkIt(event)" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Pembayaran berikutnya</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><select name="tanggal_bayar_berikut_daful"><?PHP include("include/cur_date_opt.php"); ?></select><select name="bulan_bayar_berikut_daful"><?PHP include("include/cur_month_opt.php"); ?></select><select name="tahun_bayar_berikut_daful"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        */
										?>
                                        <?PHP
										} else {
										?>
                                        <input type="hidden" name="nom_daful" onkeypress="return checkIt(event)" onKeyUp="MakeSum();" />
                                        <input type="hidden" name="subtotal_daful" style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/>
										<tr height="30">
                                        	<td width="10">
											<td colspan="4" id="text_normal_white" align="left">
                                            	<table width="300" bgcolor="#990000" border="0" cellpadding="0" cellspacing="0">
                                                	<tr>
                                                    	<td width="10"></td>
                                                        <td height="40" align="center">Tidak ada tunggakan Daftar Ulang</td>
                                                        <td width="10"></td>
                                                    </tr>
                                            	</table>
                                            </td>
                                            <td width="10">
										</tr>
										<?PHP
										}
										?>
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                    </div>
									<?PHP 
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									//////////////////////// --BIAYA MASUK-- //////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									?>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"><hr size="1" color="#f9f9f9" noshade="noshade" /></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>Biaya Masuk</b></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                        	<td colspan="5" height="10"><a title="Show Table #1a" href="javascript:toggleDisplay('3')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM3"></a></td>
                                        </tr>
                                    </table>
									<div style="display:none;" id="table3">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>		
                                        <?PHP
										$src_check_arrear_biaya_masuk	= "select nominal_tunggakan,periode from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'biaya_masuk' and status = '1'";
										$query_check_arrear_biaya_masuk	= mysqli_query($mysql_connect, $src_check_arrear_biaya_masuk) or die(mysql_error());
										$num_check_arrear_biaya_masuk	= mysql_num_rows($query_check_arrear_biaya_masuk);
										
										if($num_check_arrear_biaya_masuk != 0) {
										
											$row_check_arrear_biaya_masuk = mysql_fetch_array($query_check_arrear_biaya_masuk);
										?>								
                                        <tr height="20">
                                            <td width="10" ></td>
                                            <td colspan="4">                                            
                                            	<table bgcolor="#999999" border="0" cellpadding="0" cellspacing="0">
                                                	<tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>                                                   
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#1c252f"></td>
                                                        <td width="200" bgcolor="#1c252f" id="text_normal_white">Biaya masuk yang belum dibayarkan <img src="images/what_happen_aya_naon.jpg" border="0" onMouseOver="stm(Text[2],Style[12])" onMouseOut="htm()" /></td>
                                                        <td width="5" bgcolor=""></td>
                                                        <td width="10" bgcolor="#1c252f" align="left">
                                                        	<table width="250" border="0" cellpadding="0" cellspacing="0" id="text_normal_white">
                                                            	<tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr> 
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td style="color:#88cd3e;" colspan="3"><b><?= $row_check_arrear_biaya_masuk["periode"]; ?></b></td>
                                                                </tr>                                                                
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td colspan="3">[ Rp <?= number_format($row_check_arrear_biaya_masuk["nominal_tunggakan"],0,",",".").",-"; ?> ]</td>
                                                                </tr>                                                                                                                                
                                                                
                                                                <tr>
                                                                    <td colspan="4" height="10"></td>
                                                                </tr>	
                                                            </table>
                                                        </td>
                                                        <td width="10" bgcolor="#1c252f">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr height="40">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#FFFF99"></td>
                                                        <td width="200" bgcolor="#FFFF99" id="text_normal_black">Tagihan Biaya masuk yang belum dibayarkan</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#FFFF99" align="left" id="text_normal_black">&nbsp;<b style="font-size:16px;"><?= "Rp ".number_format($row_check_arrear_biaya_masuk["nominal_tunggakan"],0,",",".").",-"; ?></b></td>
                                                        <td width="10" bgcolor="#FFFF99">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                    <tr height="30">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#718b88"></td>
                                                        <td width="200" bgcolor="#718b88" id="text_normal_white">Biaya masuk</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#718b88" align="left" id="text_normal_black"><input type="text" name="nom_bima" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"  /></td>
                                                        <td width="10" bgcolor="#718b88">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr> 
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <?PHP /*
                                                    <tr height="30">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#718b88"></td>
                                                        <td width="200" bgcolor="#718b88" id="text_normal_white">Tahap</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#718b88" align="left" id="text_normal_black">
                                                        <select name="tahap_bima">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        </select>                                                        
                                                        </td>
                                                        <td width="10" bgcolor="#718b88">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>  
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr height="30">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#718b88"></td>
                                                        <td width="200" bgcolor="#718b88" id="text_normal_white">Lunas/Cicilan ke</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#718b88" align="left" id="text_normal_black"><input type="text" name="lucil_bima" onkeypress="return checkIt(event)"/></td>
                                                        <td width="10" bgcolor="#718b88">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>  
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
													*/
													?>
                                                    <tr height="50">
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#333333"></td>
                                                        <td width="200" bgcolor="#333333" id="text_normal_white">Subtotal Biaya Masuk</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#333333" align="left" id="text_normal_black"><input type="text" name="subtotal_bima" style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                                        <td width="10" bgcolor="#333333">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>                                             
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                 </table>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>  
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <?PHP /*										
										//SPP July, i've discussed this thing with mrs fitri, she agreed that we could take this field out.
										//Why is that, because we can use SPP field menu bellow.
										
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">SPP Juli</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="spp_juli_bima" onkeypress="return checkIt(event)" onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
										*/ 
										/*
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Kekurangan</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="kekurangan_bima" onkeypress="return checkIt(event)"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Pembayaran berikutnya</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><select name="tanggal_bayar_berikut_bima"><?PHP include("include/cur_date_opt.php"); ?></select><select name="bulan_bayar_berikut_bima"><?PHP include("include/cur_month_opt.php"); ?></select><select name="tahun_bayar_berikut_bima"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                                            <td>&nbsp;</td>
                                        </tr>
										*/
										?>
                                        <?PHP
										} else {
										?>
                                        <input type="hidden" name="nom_bima" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"  />
                                        <input type="hidden" name="subtotal_bima" style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/>
										<tr height="30">
                                        	<td width="10"></td>
											<td colspan="4" id="text_normal_white" align="left">
                                            	<table width="300" bgcolor="#990000" border="0" cellpadding="0" cellspacing="0">
                                                	<tr>
                                                    	<td width="10"></td>
                                                        <td height="40" align="center">Tidak ada tunggakan Biaya Masuk</td>
                                                        <td width="10"></td>
                                                    </tr>
                                            	</table>
                                            </td>
                                            <td width="10"></td>
										</tr>
										<?PHP
										}
										?>
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                    </div>
                                    <?PHP 
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									////////////////////////////// --SPP-- ////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									?>
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"><hr size="1" color="#f9f9f9" noshade="noshade" /></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>SPP</b></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                        	<td colspan="5" height="10"><a title="Show Table #1a" href="javascript:toggleDisplay('4')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM4"></a></td>
                                        </tr>
                                    </table>
                                    <div style="display:none;" id="table4">                        	
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff"> 
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td width="10" ></td>
                                        	<td colspan="4" height="10"><input type="button" value="History Pembayaran SPP" onclick="javascript:void window.open('popup.php?pl=pop_history_spp&no=<?= $no_sisda_enc; ?>','','width=1360,height=500,toolbar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0'); return false;" /></td>
                                            <td width="10" ></td>
                                        </tr> 
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>                                        <tr height="20">
                                            <td width="10" ></td>
                                            <td colspan="4"> 
                                            	<table bgcolor="#999999" border="0" cellpadding="0" cellspacing="0">
                                                    <?PHP
													//where are going to check whether this student has any arrears or not													
													$src_check_arrear_spp 			= "select * from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'spp' and (status = '1' || status = '2') order by id";
													$query_check_arrear_spp			= mysqli_query($mysql_connect, $src_check_arrear_spp) or die(mysql_error());
													$query_check_arrear_spp_auto	= mysqli_query($mysql_connect, $src_check_arrear_spp) or die(mysql_error());
													$num_check_arrear_spp			= mysql_num_rows($query_check_arrear_spp);
													
													//echo $src_check_arrear;
													//echo "<h1>$num_check_arrear</h1>";
													if($num_check_arrear_spp != 0) {
													?>
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#1c252f"></td>
                                                        <td width="200" bgcolor="#1c252f" id="text_normal_white">Bulan SPP yang belum dibayarkan <img src="images/what_happen_aya_naon.jpg" border="0" onMouseOver="stm(Text[2],Style[12])" onMouseOut="htm()" /></td>
                                                        <td width="5" bgcolor=""></td>
                                                        <td width="10" bgcolor="#1c252f" align="left">
                                                        	<table width="250" border="0" cellpadding="0" cellspacing="0" id="text_normal_white">
                                                            	<tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>                                                           	
																<?PHP
																$nom_spp = 0;
                                                                while($row_check_arrear_spp = mysql_fetch_array($query_check_arrear_spp)) {
                                                                ?>
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td style="color:#88cd3e;" colspan="3"><b><?= $row_check_arrear_spp["periode"]; ?></b></td>
                                                                </tr>                                                                                                                                
                                                                <?PHP	
																////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
																////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
																/////      0: month of transaction have not come               	                                               /////			
																/////      1: month of trancaction have come, but the payment hasnt done    				                   /////
																/////      2: month of transaceton has pass 1 month, and the payment hasn't done (defined as an arrear)	       /////
																/////      3: nominal of payment with special case                     			                               /////
																/////      4: no arrear                       				                                                   /////
																/////      5: have paid on time                           			                                           /////
																/////      6. have paid late 																				   /////
																/////	   7: have paid before the month of payment come                                                       /////
																////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
																//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
																	
																	$arrear_spp_july = substr($row_check_arrear_spp["july"],0,1);
																	if($arrear_spp_july == 1 || $arrear_spp_july == 2 || $arrear_spp_july == 3) {
																		$exp_july = explode("-",$row_check_arrear_spp["july"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- July </td><td width='10'></td><td>[Rp ".number_format($exp_july[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_july[1]; 
																	}
																	
																	$arrear_spp_august = substr($row_check_arrear_spp["august"],0,1);
																	if($arrear_spp_august == 1 || $arrear_spp_august == 2 || $arrear_spp_august == 3) { 
																		$exp_august = explode("-",$row_check_arrear_spp["august"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Agustus </td><td width='10'></td><td>[Rp ".number_format($exp_august[1],0,",",".").",-]</td></tr>";  $nom_spp += $exp_august[1]; 
																	}
																	
																	$arrear_spp_september = substr($row_check_arrear_spp["september"],0,1);
																	if($arrear_spp_september == 1 || $arrear_spp_september == 2 || $arrear_spp_september == 3) {
																		$exp_september	= explode("-",$row_check_arrear_spp["september"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- September </td><td width='10'></td><td>[Rp ".number_format($exp_september[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_september[1]; 
																	}
																	
																	$arrear_spp_october = substr($row_check_arrear_spp["october"],0,1);
																	if($arrear_spp_october == 1 || $arrear_spp_october == 2 || $arrear_spp_october == 3) { 
																		$exp_october = explode("-",$row_check_arrear_spp["october"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Oktober </td><td width='10'></td><td>[Rp ".number_format($exp_october[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_october[1]; 
																	}
																	
																	$arrear_spp_november = substr($row_check_arrear_spp["november"],0,1);
																	if($arrear_spp_november == 1 || $arrear_spp_november == 2 || $arrear_spp_november == 3) { 
																		$exp_november = explode("-",$row_check_arrear_spp["november"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- November </td><td width='10'></td><td>[Rp ".number_format($exp_november[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_november[1]; 
																	}
																	
																	$arrear_spp_december = substr($row_check_arrear_spp["december"],0,1);
																	if($arrear_spp_december == 1 || $arrear_spp_december == 2 || $arrear_spp_december == 3) { 
																		$exp_december = explode("-",$row_check_arrear_spp["december"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Desember </td><td width='10'></td><td>[Rp ".number_format($exp_december[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_december[1]; 
																	
																	}
																	
																	$arrear_spp_january = substr($row_check_arrear_spp["january"],0,1);
																	if($arrear_spp_january == 1 || $arrear_spp_january == 2 || $arrear_spp_january == 3) { 
																		$exp_january = explode("-", $row_check_arrear_spp["january"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Januari </td><td width='10'></td><td>[Rp ".number_format($exp_january[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_january[1]; 
																	}
																	
																	$arrear_spp_february = substr($row_check_arrear_spp["february"],0,1);
																	if($arrear_spp_february == 1 || $arrear_spp_february == 2 || $arrear_spp_february == 3) { 
																		$exp_february = explode("-",$row_check_arrear_spp["february"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Februari </td><td width='10'></td><td>[Rp ".number_format($exp_february[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_february[1]; 
																	}
																	
																	$arrear_spp_march = substr($row_check_arrear_spp["march"],0,1);
																	if($arrear_spp_march == 1 || $arrear_spp_march == 2 || $arrear_spp_march == 3) { 
																		$exp_march = explode("-",$row_check_arrear_spp["march"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Maret </td><td width='10'></td><td>[Rp ".number_format($exp_march[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_march[1]; 
																	} 
																	
																	$arrear_spp_april = substr($row_check_arrear_spp["april"],0,1);
																	if($arrear_spp_april == 1 || $arrear_spp_april == 2 || $arrear_spp_april == 3) { 
																		$exp_april = explode("-",$row_check_arrear_spp["april"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- April </td><td width='10'></td><td>[Rp ".number_format($exp_april[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_april[1]; 
																	}
																	
																	$arrear_spp_may = substr($row_check_arrear_spp["may"],0,1);
																	if($arrear_spp_may == 1 || $arrear_spp_may == 2 || $arrear_spp_may == 3) { 
																		$exp_may = explode("-",$row_check_arrear_spp["may"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Mei </td><td width='10'></td><td>[Rp ".number_format($exp_may[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_may[1]; 
																	}
																	
																	$arrear_spp_june = substr($row_check_arrear_spp["june"],0,1);
																	if($arrear_spp_june == 1 || $arrear_spp_june == 2 || $arrear_spp_june == 3) { 
																		$exp_june = explode("-",$row_check_arrear_spp["june"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Juni </td><td width='10'></td><td>[Rp ".number_format($exp_june[1],0,",",".").",-]</td></tr>"; $nom_spp += $exp_june[1]; 
																	}
                                                                    
                                                                }																	
                                                                ?>	
                                                                <tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>		
                                                            </table>
                                                        </td>
                                                        <td width="10" bgcolor="#1c252f">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr height="40">
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#FFFF99"></td>
                                                        <td width="200" bgcolor="#FFFF99" id="text_normal_black">Tagihan SPP bulan ini</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#FFFF99" align="left" id="text_normal_black">&nbsp;
														<?php
														if($nom_spp == 0) {
															
															echo "<b>Tidak ada tagihan untuk bulan ini</b>";
														
														} else {
														?>
                                                        <b style="font-size:16px;">
                                                        <?PHP 
														 	echo "Rp ".number_format($nom_spp,0,",",".").",-"; 
														?>
                                                        </b>
                                                        <?PHP
                                                        }
														?>
                                                        
                                                        </td>
                                                        <td width="10" bgcolor="#FFFF99">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#617f90"></td>
                                                        <td width="200" bgcolor="#617f90" id="text_normal_white">SPP (bulan)</td>
                                                        <td width="5" bgcolor="#617f90"></td>
                                                        <td width="10" bgcolor="#617f90" align="left">
                                                        <span style="font-size:9px; font-family:verdana; color:#ffcc00;">Gunakan tombol <b style="color:#FFFFFF;">Shift</b> untuk memilih lebih dari 1 bulan</span><br />                                                        
                                                        <select name="bulan_spp[]" id="id_cur_month" size="12" style="width: 200px" multiple="multiple" onchange="update_spp()">
                                                        <option value="---0"></option>
                                                        <?PHP
														while($row_check_arrear_spp_auto = mysql_fetch_array($query_check_arrear_spp_auto)) {
														
															$arrear_spp_jul_auto = explode("-",$row_check_arrear_spp_auto["july"]);
															$arrear_spp_aug_auto = explode("-",$row_check_arrear_spp_auto["august"]);
															$arrear_spp_sep_auto = explode("-",$row_check_arrear_spp_auto["september"]);
															$arrear_spp_oct_auto = explode("-",$row_check_arrear_spp_auto["october"]);
															$arrear_spp_nov_auto = explode("-",$row_check_arrear_spp_auto["november"]);
															$arrear_spp_dec_auto = explode("-",$row_check_arrear_spp_auto["december"]);
															$arrear_spp_jan_auto = explode("-",$row_check_arrear_spp_auto["january"]);
															$arrear_spp_feb_auto = explode("-",$row_check_arrear_spp_auto["february"]);
															$arrear_spp_mar_auto = explode("-",$row_check_arrear_spp_auto["march"]);
															$arrear_spp_apr_auto = explode("-",$row_check_arrear_spp_auto["april"]);
															$arrear_spp_may_auto = explode("-",$row_check_arrear_spp_auto["may"]);
															$arrear_spp_jun_auto = explode("-",$row_check_arrear_spp_auto["june"]);
															
															$src_year_spp_auto	= $row_check_arrear_spp_auto["periode"];
															$year_spp_auto		= substr($src_year_spp_auto,0,4).substr($src_year_spp_auto,7,4);
															
															if($arrear_spp_jul_auto[0] == 0 || $arrear_spp_jul_auto[0] == 1 || $arrear_spp_jul_auto[0] == 2 || $arrear_spp_jul_auto[0] == 3) {
														?>
                                                        	<option value="jul-<?= $year_spp_auto; ?>-<?= $arrear_spp_jul_auto[0]; ?>-<?= $arrear_spp_jul_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] Juli</option>
                                                        <?PHP
															}
															
															if($arrear_spp_aug_auto[0] == 0 || $arrear_spp_aug_auto[0] == 1 || $arrear_spp_aug_auto[0] == 2 || $arrear_spp_aug_auto[0] == 3) {
														?>
                                                        	<option value="aug-<?= $year_spp_auto; ?>-<?= $arrear_spp_aug_auto[0]; ?>-<?= $arrear_spp_aug_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] Agustus</option>
                                                        <?PHP
															
															}
															if($arrear_spp_sep_auto[0] == 0 || $arrear_spp_sep_auto[0] == 1 || $arrear_spp_sep_auto[0] == 2 || $arrear_spp_sep_auto[0] == 3) {
														?>
                                                        	<option value="sep-<?= $year_spp_auto; ?>-<?= $arrear_spp_sep_auto[0]; ?>-<?= $arrear_spp_sep_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] September</option>
                                                        <?PHP
															
															}
															if($arrear_spp_oct_auto[0] == 0 || $arrear_spp_oct_auto[0] == 1 || $arrear_spp_oct_auto[0] == 2 || $arrear_spp_oct_auto[0] == 3) {
														?>
                                                        	<option value="oct-<?= $year_spp_auto; ?>-<?= $arrear_spp_oct_auto[0]; ?>-<?= $arrear_spp_oct_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] Oktober</option>
                                                        <?PHP
															
															}
															if($arrear_spp_nov_auto[0] == 0 || $arrear_spp_nov_auto[0] == 1 || $arrear_spp_nov_auto[0] == 2 || $arrear_spp_nov_auto[0] == 3) {
														?>
                                                        	<option value="nov-<?= $year_spp_auto; ?>-<?= $arrear_spp_nov_auto[0]; ?>-<?= $arrear_spp_nov_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] November</option>
                                                        <?PHP
															
															}
															if($arrear_spp_dec_auto[0] == 0 || $arrear_spp_dec_auto[0] == 1 || $arrear_spp_dec_auto[0] == 2 || $arrear_spp_dec_auto[0] == 3) {
														?>
                                                        	<option value="dec-<?= $year_spp_auto; ?>-<?= $arrear_spp_dec_auto[0]; ?>-<?= $arrear_spp_dec_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] Desember</option>
                                                        <?PHP
															
															}
															if($arrear_spp_jan_auto[0] == 0 ||  $arrear_spp_jan_auto[0] == 1 || $arrear_spp_jan_auto[0] == 2 || $arrear_spp_jan_auto[0] == 3) {
														?>
                                                        	<option value="jan-<?= $year_spp_auto; ?>-<?= $arrear_spp_jan_auto[0]; ?>-<?= $arrear_spp_jan_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] Januari</option>
                                                        <?PHP
															
															}
															if($arrear_spp_feb_auto[0] == 0 || $arrear_spp_feb_auto[0] == 1 || $arrear_spp_feb_auto[0] == 2 || $arrear_spp_feb_auto[0] == 3) {
														?>
                                                        	<option value="feb-<?= $year_spp_auto; ?>-<?= $arrear_spp_feb_auto[0]; ?>-<?= $arrear_spp_feb_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] Februari</option>
                                                        <?PHP
															
															}
															if($arrear_spp_mar_auto[0] == 0 || $arrear_spp_mar_auto[0] == 1 || $arrear_spp_mar_auto[0] == 2 || $arrear_spp_mar_auto[0] == 3) {
														?>
                                                        	<option value="mar-<?= $year_spp_auto; ?>-<?= $arrear_spp_mar_auto[0]; ?>-<?= $arrear_spp_mar_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] Maret</option>
                                                        <?PHP
															
															}
															if($arrear_spp_apr_auto[0] == 0 || $arrear_spp_apr_auto[0] == 1 || $arrear_spp_apr_auto[0] == 2 || $arrear_spp_apr_auto[0] == 3) {
														?>
                                                        	<option value="apr-<?= $year_spp_auto; ?>-<?= $arrear_spp_apr_auto[0]; ?>-<?= $arrear_spp_apr_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] April</option>
                                                        <?PHP
															
															}
															if($arrear_spp_may_auto[0] == 0 || $arrear_spp_may_auto[0] == 1 || $arrear_spp_may_auto[0] == 2 || $arrear_spp_may_auto[0] == 3) {
														?>
                                                        	<option value="may-<?= $year_spp_auto; ?>-<?= $arrear_spp_may_auto[0]; ?>-<?= $arrear_spp_may_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] May</option>
                                                        <?PHP
															
															}
															if($arrear_spp_jun_auto[0] == 0 || $arrear_spp_jun_auto[0] == 1 || $arrear_spp_jun_auto[0] == 2 || $arrear_spp_jun_auto[0] == 3) {
														?>
                                                        	<option value="jun-<?= $year_spp_auto; ?>-<?= $arrear_spp_jun_auto[0]; ?>-<?= $arrear_spp_jun_auto[1]; ?>">[<?= $row_check_arrear_spp_auto["periode"]; ?>] June</option>
                                                        <?PHP
															
															}
														
														}
														?>
                                                        </select>
                                                        <?PHP
														/*
                                                        <span style="font-size:9px; font-family:verdana; color:#ffcc00;">Gunakan tombol <b style="color:#FFFFFF;">Shift</b> untuk memilih lebih dari 1 bulan</span><br />                                                        
                                                        <select name="bulan_catering[]" size="12" style="width: 200px" multiple="multiple">
                                                        <option value="july">Juli	</option>
                                                        <option value="august">Agustus</option>
                                                        <option value="september">September</option>
                                                        <option value="october">Oktober</option>
                                                        <option value="november">Nopember</option>
                                                        <option value="december">Desember</option>
                                                        <option value="january">Januari</option>
                                                        <option value="february">Februari</option>
                                                        <option value="march">Maret</option>
                                                        <option value="april">April</option>
                                                        <option value="may">Mei</option>
                                                        <option value="june">Juni</option>
                                                        </select>
														*/
														?>
                                                        </td>
                                                        <td width="10" bgcolor="#617f90">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr> 
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#617f90"></td>
                                                        <td width="200" bgcolor="#617f90" id="text_normal_white">SPP (nominal)</td>
                                                        <td width="5" bgcolor="#617f90"></td>
                                                        <td width="10" bgcolor="#617f90" align="left"><input type="text" name="nom_spp" onkeypress="return checkIt(event)" onChange="MakeSum();" onFocus="MakeSum();" style="font-weight:bold; color:#33CC00; font-size:14px;"/></td>
                                                        <td width="10" bgcolor="#617f90">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" height="5"></td>
                                                    </tr>
                                                    <tr height="50">
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#333333"></td>
                                                        <td width="200" bgcolor="#333333" id="text_normal_white">Subtotal SPP</td>
                                                        <td width="5" bgcolor="#333333"></td>
                                                        <td width="10" bgcolor="#333333" align="left"><input type="text" name="subtotal_spp"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                                        <td width="10" bgcolor="#333333">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" height="10"></td>
                                                    </tr>
													<?PHP
													//no data found as required above 
													} else {
													?>
                                                    <input type="hidden" name="nom_spp" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" style="font-weight:bold; color:#33CC00; font-size:14px;"/>
                                                    <input type="hidden" name="subtotal_spp"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="5"></td>
                                                        <td colspan="5" id="text_normal_white" align="left">
                                                            <table width="300" height="60" bgcolor="#990000" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="10"></td>
                                                                    <td height="40" align="center">Tidak ada tagihan untuk SPP tahun ajaran ini.  
                                                                    Silakan menunggu untuk tagihan tahun ajaran berikutnya
                                                                    </td>
                                                                    <td width="10"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="5"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <?PHP
													}																
													?>
                                                	
                                                 </table>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <?PHP
										/*
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Kekurangan</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="kekurangan_spp" onkeypress="return checkIt(event)"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Pembayaran berikutnya</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><select name="tanggal_bayar_berikut_spp"><?PHP include("include/cur_date_opt.php"); ?></select><select name="bulan_bayar_berikut_spp"><?PHP include("include/cur_month_opt.php"); ?></select><select name="tahun_bayar_berikut_spp"><?PHP include("include/cur_year_opt.php"); ?></select></td>
                                            <td>&nbsp;</td>
                                        </tr> 
										*/ 
										?>                           
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                    </div>
                            		<?PHP 
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									//////////////////////////// --Cataj-- ////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									?>
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"><hr size="1" color="#f9f9f9" noshade="noshade" /></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>Catering & Antar Jemput</b></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                        	<td colspan="5" height="10"><a title="Show Table #1a" href="javascript:toggleDisplay('6')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM6"></a></td>
                                        </tr>
                                    </table>
                                    <div style="display:none;" id="table6">
                                    <?PHP
									$current_month_is	= date("n");
									$src_check_cataj_num_day	= "select id from cataj_num_day where month = '$current_month_is' and periode = '$edu_year'";
									$query_check_cataj_num_day	= mysqli_query($mysql_connect, $src_check_cataj_num_day) or die(mysql_error($src_check_cataj_num_day));
									
									if(mysql_num_rows($query_check_cataj_num_day) == '0') { 
									?>
                                    <?PHP //echo "<h1>catering</h1>"; ?>
                                    <input type="hidden" name="catering" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" style="font-weight:bold; color:#33CC00; font-size:14px;"/>
                                    <?PHP //echo "<h1>subtotal_catering</h1>"; ?>
                                    <input type="hidden" name="subtotal_catering"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/>
									<?PHP //echo "<h1>antar_jemput</h1>"; ?>
                                    <input type="hidden" name="antar_jemput" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" style="font-weight:bold; color:#33CC00; font-size:14px;"/>
                                    <?PHP //echo "<h1>subtotal antar jemput</h1>"; ?>
                                    <input type="hidden" name="subtotal_antar_jemput"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/>
                                    <table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff"> 
                                     	<tr bgcolor="#990000">
                                        	<td width="30"></td>
                                        	<td height="10">&nbsp;</td>
                                            <td width="30"></td>
                                        </tr>
                                        <tr bgcolor="#990000">
                                        	<td width="30">&nbsp;</td>
                                        	<td id="text_normal_white">
                                            <?PHP
											if($cur_month == 'january') { $cur_month_ind = "Januari"; }
											if($cur_month == 'february') { $cur_month_ind = "Februari"; }
											if($cur_month == 'march') { $cur_month_ind = "Maret"; }
											if($cur_month == 'april') { $cur_month_ind = "april"; }
											if($cur_month == 'may') { $cur_month_ind = "Mei"; }
											if($cur_month == 'june') { $cur_month_ind = "Juni"; }
											if($cur_month == 'july') { $cur_month_ind = "July"; }
											if($cur_month == 'august') { $cur_month_ind = "Agustus"; }
											if($cur_month == 'september') { $cur_month_ind = "September"; }
											if($cur_month == 'october') { $cur_month_ind = "Oktober"; }
											if($cur_month == 'november') { $cur_month_ind = "November"; }
											if($cur_month == 'december') { $cur_month_ind = "December"; }
											?>
											Jumlah hari catering & antar jemput untuk bulan <?= $cur_month_ind; ?> <?= $edu_year; ?> belum di tentukan<br>
											<input type='button' value='Jumlah hari catering dan antar jemput' onclick="window.location.href='?pl=cataj_num_day';" />
                                            </td>
                                            <td width="30"></td>
                                        </tr>
                                        <tr bgcolor="#990000">
                                        	<td width="30"></td>
                                        	<td height="10"></td>
                                            <td width="30"></td>
                                        </tr>
                                    </table>
									<?PHP
									} else {
									
									$src_check_arrear_catering			= "select * from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'catering' and (status = '1' || status = '2')";
									$query_check_arrear_catering		= mysqli_query($mysql_connect, $src_check_arrear_catering) or die(mysql_error());
									$query_check_arrear_catering_auto	= mysqli_query($mysql_connect, $src_check_arrear_catering) or die(mysql_error());
									$num_check_arrear_catering			= mysql_num_rows($query_check_arrear_catering);
									
									if($num_check_arrear_catering == 0) {
									
										$catering_arrear_exist 	= "0";
										
									} else {
									
										$catering_arrear_exist 	= "1";
									
									}
									
									$src_check_arrear_antar_jemput			= "select * from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'antar_jemput' and (status = '1' || status = '2')";
									$query_check_arrear_antar_jemput		= mysqli_query($mysql_connect, $src_check_arrear_antar_jemput) or die(mysql_error());
									$query_check_arrear_antar_jemput_auto	= mysqli_query($mysql_connect, $src_check_arrear_antar_jemput) or die(mysql_error());
									$num_check_arrear_antar_jemput			= mysql_num_rows($query_check_arrear_antar_jemput);
									
									if($num_check_arrear_antar_jemput == 0) {
									
										$antar_jemput_arrear_exist 	= "0";
										
									} else {
									
										$antar_jemput_arrear_exist 	= "1";
									
									}
									?>
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff"> 
                                     	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>
                                        <?PHP
										if($catering_arrear_exist == "1") {
										?>
                                        <tr height="20">
                                            <td width="10" ></td>
                                            <td colspan="4">
                                            	<table bgcolor="#999999" border="0" cellpadding="0" cellspacing="0">
                                                	<tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#1c252f"></td>
                                                        <td width="200" bgcolor="#1c252f" id="text_normal_white">Tagihan catering yang belum dibayarkan <img src="images/what_happen_aya_naon.jpg" border="0" onMouseOver="stm(Text[2],Style[12])" onMouseOut="htm()" /></td>
                                                        <td width="5" bgcolor=""></td>
                                                        <td width="10" bgcolor="#1c252f" align="left">
                                                        	<table width="250" border="0" cellpadding="0" cellspacing="0" id="text_normal_white">
                                                            	<tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>                                                           	
																<?PHP
																//echo "<h1>".$catering_joint."</h1>";
																$nom_catering = 0;
                                                                while($row_check_arrear_catering = mysql_fetch_array($query_check_arrear_catering)) {
                                                                ?>
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td style="color:#88cd3e;" colspan="3"><b><?= $row_check_arrear_catering["periode"]; ?></b></td>
                                                                </tr>                                                                                                                                
                                                                <?PHP	
																	$arrear_catering_july = substr($row_check_arrear_catering["jul_cataj"],0,1);
																	if($arrear_catering_july == 1 || $arrear_catering_july == 2 || $arrear_catering_july == 3) {
																		$exp_july_catering = explode("-",$row_check_arrear_catering["jul_cataj"]);
																		if($exp_july_catering[1] == 'x') { $val_july_catering = '0'; } else { $val_july_catering = $exp_july_catering[1]; }																		
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- July </td><td width='10'></td><td>[Rp ".number_format($val_july_catering,0,",",".").",-]";
																		if($exp_july_catering[1] == 'x') { echo " <input type='button' value='Biaya catering' onclick='window.location.href='?pl=cataj_num_day';' style='height:40px; width:150px;' />"; }
																		echo "</td></tr>"; 
																		$nom_catering += $exp_july_catering[1]; 
																	}
																	
																	$arrear_catering_august = substr($row_check_arrear_catering["aug_cataj"],0,1);
																	if($arrear_catering_august == 1 || $arrear_catering_august == 2 || $arrear_catering_august == 3) { 
																		$exp_august_catering = explode("-",$row_check_arrear_catering["aug_cataj"]);
																		if($exp_august_catering[1] == 'x') { $val_august_catering = '0'; } else { $val_august_catering = $exp_august_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Agustus </td><td width='10'></td><td>[Rp ".number_format($val_august_catering,0,",",".").",-]";
																		if($exp_august_catering[1] == 'x') { echo " <input type='button' value='?' onclick=\"window.location.href='?pl=cataj_num_day';\" title='Jumlah hari untuk bulan Agustus ".$row_check_arrear_catering["periode"]." belum didefinisikan' />"; }
																		echo "</td></tr>";  
																		$nom_catering += $exp_august_catering[1]; 
																	}
																	
																	$arrear_catering_september = substr($row_check_arrear_catering["sep_cataj"],0,1);
																	if($arrear_catering_september == 1 || $arrear_catering_september == 2 || $arrear_catering_september == 3) {
																		$exp_september_catering	= explode("-",$row_check_arrear_catering["sep_cataj"]);
																		if($exp_september_catering[1] == 'x') { $val_september_catering = '0'; } else { $val_september_catering = $exp_september_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- September </td><td width='10'></td><td>[Rp ".number_format($val_september_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_september_catering[1]; 
																	}
																	
																	$arrear_catering_october = substr($row_check_arrear_catering["oct_cataj"],0,1);
																	if($arrear_catering_october == 1 || $arrear_catering_october == 2 || $arrear_catering_october == 3) { 
																		$exp_october_catering = explode("-",$row_check_arrear_catering["oct_cataj"]);
																		if($exp_october_catering[1] == 'x') { $val_october_catering = '0'; } else { $val_october_catering = $exp_october_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Oktober </td><td width='10'></td><td>[Rp ".number_format($val_october_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_october_catering[1]; 
																	}
																	
																	$arrear_catering_november = substr($row_check_arrear_catering["nov_cataj"],0,1);
																	if($arrear_catering_november == 1 || $arrear_catering_november == 2 || $arrear_catering_november == 3) { 
																		$exp_november_catering = explode("-",$row_check_arrear_catering["nov_cataj"]);
																		if($exp_november_catering[1] == 'x') { $val_november_catering = '0'; } else { $val_november_catering = $exp_november_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- November </td><td width='10'></td><td>[Rp ".number_format($val_november_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_november_catering[1]; 
																	}
																	
																	$arrear_catering_december = substr($row_check_arrear_catering["dec_cataj"],0,1);
																	if($arrear_catering_december == 1 || $arrear_catering_december == 2 || $arrear_catering_december == 3) { 
																		$exp_december_catering = explode("-",$row_check_arrear_catering["dec_cataj"]);
																		if($exp_december_catering[1] == 'x') { $val_december_catering = '0'; } else { $val_december_catering = $exp_december_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Desember </td><td width='10'></td><td>[Rp ".number_format($val_december_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_december_catering[1]; 
																	
																	}
																	
																	$arrear_catering_january = substr($row_check_arrear_catering["jan_cataj"],0,1);
																	if($arrear_catering_january == 1 || $arrear_catering_january == 2 || $arrear_catering_january == 3) { 
																		$exp_january_catering = explode("-",$row_check_arrear_catering["jan_cataj"]);
																		if($exp_january_catering[1] == 'x') { $val_january_catering = '0'; } else { $val_january_catering = $exp_january_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Januari </td><td width='10'></td><td>[Rp ".number_format($val_january_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_january_catering[1]; 
																	}
																	
																	$arrear_catering_february = substr($row_check_arrear_catering["feb_cataj"],0,1);
																	if($arrear_catering_february == 1 || $arrear_catering_february == 2 || $arrear_catering_february == 3) { 
																		$exp_february_catering = explode("-",$row_check_arrear_catering["feb_cataj"]);
																		if($exp_february_catering[1] == 'x') { $val_february_catering = '0'; } else { $val_february_catering = $exp_february_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Februari </td><td width='10'></td><td>[Rp ".number_format($val_february_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_february_catering[1]; 
																	}
																	
																	$arrear_catering_march = substr($row_check_arrear_catering["mar_cataj"],0,1);
																	if($arrear_catering_march == 1 || $arrear_catering_march == 2 || $arrear_catering_march == 3) { 
																		$exp_march_catering = explode("-",$row_check_arrear_catering["mar_cataj"]);
																		if($exp_march_catering[1] == 'x') { $val_march_catering = '0'; } else { $val_march_catering = $exp_march_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Maret </td><td width='10'></td><td>[Rp ".number_format($val_march_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_march_catering[1]; 
																	}
																	
																	$arrear_catering_april = substr($row_check_arrear_catering["apr_cataj"],0,1);
																	if($arrear_catering_april == 1 || $arrear_catering_april == 2 || $arrear_catering_april == 3) { 
																		$exp_april_catering = explode("-",$row_check_arrear_catering["apr_cataj"]);
																		if($exp_april_catering[1] == 'x') { $val_april_catering = '0'; } else { $val_april_catering = $exp_april_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- April </td><td width='10'></td><td>[Rp ".number_format($val_april_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_april_catering[1]; 
																	}
																	
																	$arrear_catering_may = substr($row_check_arrear_catering["may_cataj"],0,1);
																	if($arrear_catering_may == 1 || $arrear_catering_may == 2 || $arrear_catering_may == 3) { 
																		$exp_may_catering = explode("-",$row_check_arrear_catering["may_cataj"]);
																		if($exp_may_catering[1] == 'x') { $val_may_catering = '0'; } else { $val_may_catering = $exp_may_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Mei </td><td width='10'></td><td>[Rp ".number_format($val_may_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_may_catering[1]; 
																	}
																	
																	$arrear_catering_june = substr($row_check_arrear_catering["jun_cataj"],0,1);
																	if($arrear_catering_june == 1 || $arrear_catering_june == 2 || $arrear_catering_june == 3) { 
																		$exp_june_catering = explode("-",$row_check_arrear_catering["jun_cataj"]);
																		if($exp_june_catering[1] == 'x') { $val_june_catering = '0'; } else { $val_june_catering = $exp_june_catering[1]; }
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Juni </td><td width='10'></td><td>[Rp ".number_format($val_june_catering,0,",",".").",-]</td></tr>"; $nom_catering += $exp_june_catering[1]; 
																	}
                                                                    
                                                                }																	
                                                                ?>	
                                                                <tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>		
                                                            </table>
                                                        </td>
                                                        <td width="10" bgcolor="#1c252f">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr height="40">
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#FFFF99"></td>
                                                        <td width="200" bgcolor="#FFFF99" id="text_normal_black">Tagihan Catering bulan ini</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#FFFF99" align="left" id="text_normal_black">&nbsp;<b style="font-size:16px;"><?= "Rp ".number_format($nom_catering,0,",",".").",-"; ?></b></td>
                                                        <td width="10" bgcolor="#FFFF99">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#87778a"></td>
                                                        <td width="200" bgcolor="#87778a" id="text_normal_white">Catering (bulan)</td>
                                                        <td width="5" bgcolor="#87778a"></td>
                                                        <td width="10" bgcolor="#87778a" align="left">
                                                        <span style="font-size:9px; font-family:verdana; color:#ffcc00;">Gunakan tombol <b style="color:#FFFFFF;">Shift</b> untuk memilih lebih dari 1 bulan</span><br />  
                                                        <select name="bulan_catering[]" id="id_cur_month_catering" size="12" style="width: 200px" multiple="multiple" onchange="update_catering()">
                                                        <option value="---0"></option>
														<?PHP
														while($row_check_arrear_catering_auto = mysql_fetch_array($query_check_arrear_catering_auto)) {
														
															$arrear_catering_jul_auto = explode("-",$row_check_arrear_catering_auto["jul_cataj"]);
															$arrear_catering_aug_auto = explode("-",$row_check_arrear_catering_auto["aug_cataj"]);
															$arrear_catering_sep_auto = explode("-",$row_check_arrear_catering_auto["sep_cataj"]);
															$arrear_catering_oct_auto = explode("-",$row_check_arrear_catering_auto["oct_cataj"]);
															$arrear_catering_nov_auto = explode("-",$row_check_arrear_catering_auto["nov_cataj"]);
															$arrear_catering_dec_auto = explode("-",$row_check_arrear_catering_auto["dec_cataj"]);
															$arrear_catering_jan_auto = explode("-",$row_check_arrear_catering_auto["jan_cataj"]);
															$arrear_catering_feb_auto = explode("-",$row_check_arrear_catering_auto["feb_cataj"]);
															$arrear_catering_mar_auto = explode("-",$row_check_arrear_catering_auto["mar_cataj"]);
															$arrear_catering_apr_auto = explode("-",$row_check_arrear_catering_auto["apr_cataj"]);
															$arrear_catering_may_auto = explode("-",$row_check_arrear_catering_auto["may_cataj"]);
															$arrear_catering_jun_auto = explode("-",$row_check_arrear_catering_auto["jun_cataj"]);
															
															$src_year_catering_auto	= $row_check_arrear_catering_auto["periode"];
															$year_catering_auto		= substr($src_year_catering_auto,0,4).substr($src_year_catering_auto,7,4);
															
															if($arrear_catering_jul_auto[0] == 1 || $arrear_catering_jul_auto[0] == 2 || $arrear_catering_jul_auto[0] == 3) {
														?>
                                                        	<option value="jul-<?= $year_catering_auto; ?>-<?= $arrear_catering_jul_auto[0]; ?>-<?= $arrear_catering_jul_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] Juli</option>
                                                        <?PHP
															}
															
															if($arrear_catering_aug_auto[0] == 1 || $arrear_catering_aug_auto[0] == 2 || $arrear_catering_aug_auto[0] == 3) {
														?>
                                                        	<option value="aug-<?= $year_catering_auto; ?>-<?= $arrear_catering_aug_auto[0]; ?>-<?= $arrear_catering_aug_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] Agustus</option>
                                                        <?PHP
															
															}
															if($arrear_catering_sep_auto[0] == 1 || $arrear_catering_sep_auto[0] == 2 || $arrear_catering_sep_auto[0] == 3) {
														?>
                                                        	<option value="sep-<?= $year_catering_auto; ?>-<?= $arrear_catering_sep_auto[0]; ?>-<?= $arrear_catering_sep_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] September</option>
                                                        <?PHP
															
															}
															if($arrear_catering_oct_auto[0] == 1 || $arrear_catering_oct_auto[0] == 2 || $arrear_catering_oct_auto[0] == 3) {
														?>
                                                        	<option value="oct-<?= $year_catering_auto; ?>-<?= $arrear_catering_oct_auto[0]; ?>-<?= $arrear_catering_oct_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] Oktober</option>
                                                        <?PHP
															
															}
															if($arrear_catering_nov_auto[0] == 1 || $arrear_catering_nov_auto[0] == 2 || $arrear_catering_nov_auto[0] == 3) {
														?>
                                                        	<option value="nov-<?= $year_catering_auto; ?>-<?= $arrear_catering_nov_auto[0]; ?>-<?= $arrear_catering_nov_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] November</option>
                                                        <?PHP
															
															}
															if($arrear_catering_dec_auto[0] == 1 || $arrear_catering_dec_auto[0] == 2 || $arrear_catering_dec_auto[0] == 3) {
														?>
                                                        	<option value="dec-<?= $year_catering_auto; ?>-<?= $arrear_catering_dec_auto[0]; ?>-<?= $arrear_catering_dec_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] Desember</option>
                                                        <?PHP
															
															}
															if($arrear_catering_jan_auto[0] == 1 || $arrear_catering_jan_auto[0] == 2 || $arrear_catering_jan_auto[0] == 3) {
														?>
                                                        	<option value="jan-<?= $year_catering_auto; ?>-<?= $arrear_catering_jan_auto[0]; ?>-<?= $arrear_catering_jan_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] Januari</option>
                                                        <?PHP
															
															}
															if($arrear_catering_feb_auto[0] == 1 || $arrear_catering_feb_auto[0] == 2 || $arrear_catering_feb_auto[0] == 3) {
														?>
                                                        	<option value="feb-<?= $year_catering_auto; ?>-<?= $arrear_catering_feb_auto[1]; ?>-<?= $arrear_catering_feb_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] Februari</option>
                                                        <?PHP
															
															}
															if($arrear_catering_mar_auto[0] == 1 || $arrear_catering_mar_auto[0] == 2 || $arrear_catering_mar_auto[0] == 3) {
														?>
                                                        	<option value="mar-<?= $year_catering_auto; ?>-<?= $arrear_catering_mar_auto[0]; ?>-<?= $arrear_catering_mar_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] Maret</option>
                                                        <?PHP
															
															}
															if($arrear_catering_apr_auto[0] == 1 || $arrear_catering_apr_auto[0] == 2 || $arrear_catering_apr_auto[0] == 3) {
														?>
                                                        	<option value="apr-<?= $year_catering_auto; ?>-<?= $arrear_catering_apr_auto[0]; ?>-<?= $arrear_catering_apr_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] April</option>
                                                        <?PHP
															
															}
															if($arrear_catering_may_auto[0] == 1 || $arrear_catering_may_auto[0] == 2 || $arrear_catering_may_auto[0] == 3) {
														?>
                                                        	<option value="may-<?= $year_catering_auto; ?>-<?= $arrear_catering_may_auto[0]; ?>-<?= $arrear_catering_may_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] May</option>
                                                        <?PHP
															
															}
															if($arrear_catering_jun_auto[0] == 1 || $arrear_catering_jun_auto[0] == 2 || $arrear_catering_jun_auto[0] == 3) {
														?>
                                                        	<option value="jun-<?= $year_catering_auto; ?>-<?= $arrear_catering_jun_auto[0]; ?>-<?= $arrear_catering_jun_auto[1]; ?>">[<?= $row_check_arrear_catering_auto["periode"]; ?>] June</option>
                                                        <?PHP
															
															}
														
														}
														?>
                                                        </select>
                                                        <?PHP
														/*
                                                        <span style="font-size:9px; font-family:verdana; color:#ffcc00;">Gunakan tombol <b style="color:#FFFFFF;">Shift</b> untuk memilih lebih dari 1 bulan</span><br />                                                        
                                                        <select name="bulan_catering[]" size="12" style="width: 200px" multiple="multiple">
                                                        <option value="july">Juli	</option>
                                                        <option value="august">Agustus</option>
                                                        <option value="september">September</option>
                                                        <option value="october">Oktober</option>
                                                        <option value="november">Nopember</option>
                                                        <option value="december">Desember</option>
                                                        <option value="january">Januari</option>
                                                        <option value="february">Februari</option>
                                                        <option value="march">Maret</option>
                                                        <option value="april">April</option>
                                                        <option value="may">Mei</option>
                                                        <option value="june">Juni</option>
                                                        </select>
														*/
														?>
                                                        </td>
                                                        <td width="10" bgcolor="#87778a">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#87778a"></td>
                                                        <td width="200" bgcolor="#87778a" id="text_normal_white">Catering</td>
                                                        <td width="5" bgcolor="#87778a"></td>
                                                        <td width="10" bgcolor="#87778a" align="left"><?PHP //echo "<h1>catering</h1>"; ?><input type="text" name="catering"  onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                                        <td width="10" bgcolor="#87778a">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#333333"></td>
                                                        <td width="200" bgcolor="#333333" id="text_normal_white">Subtotal catering</td>
                                                        <td width="5" bgcolor="#333333"></td>
                                                        <td width="10" bgcolor="#333333" align="left"><?PHP //echo "<h1>subtotal_catering</h1>"; ?><input type="text" name="subtotal_catering"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly" /></td>
                                                        <td width="10" bgcolor="#333333">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                               </table>
                                        	</td>
                                        </tr>
                                        <?PHP
										} else {
										?>
                                        	<?PHP //echo "<h1>catering</h1>"; ?>
                                            <input type="hidden" name="catering" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" style="font-weight:bold; color:#33CC00; font-size:14px;"/>
                                            <?PHP //echo "<h1>subtotal_catering</h1>"; ?>
                                            <input type="hidden" name="subtotal_catering"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/>
                                            <tr>
                                                <td colspan="7" height="5"></td>
                                            </tr>
                                            <tr>
                                                <td width="5"></td>
                                                <td colspan="5" id="text_normal_white" align="left">
                                                    <table width="300" height="60" bgcolor="#990000" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="10"></td>
                                                            <td height="40" align="center">Tidak ada tagihan untuk Catering 
                                                            </td>
                                                            <td width="10"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="5"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" height="5"></td>
                                            </tr>
										<?PHP
										}																
										?>
                                        <tr>
                                        	<td height="20">&nbsp;</td>
                                        </tr>
                                        <?PHP
										if($antar_jemput_arrear_exist == "1") {
										?>
                                        <tr height="20">
                                            <td width="10" ></td>
                                            <td colspan="4">
                                            	<table bgcolor="#999999" border="0" cellpadding="0" cellspacing="0">
                                                	<tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#1c252f"></td>
                                                        <td width="200" bgcolor="#1c252f" id="text_normal_white">Tagihan antar_jemput yang belum dibayarkan <img src="images/what_happen_aya_naon.jpg" border="0" onMouseOver="stm(Text[2],Style[12])" onMouseOut="htm()" /></td>
                                                        <td width="5" bgcolor=""></td>
                                                        <td width="10" bgcolor="#1c252f" align="left">
                                                        	<table width="250" border="0" cellpadding="0" cellspacing="0" id="text_normal_white">
                                                            	<tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>                                                           	
																<?PHP
																//echo "<h1>".$antar_jemput_joint."</h1>";
																$nom_antar_jemput = 0;
                                                                while($row_check_arrear_antar_jemput = mysql_fetch_array($query_check_arrear_antar_jemput)) {
                                                                ?>
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td style="color:#88cd3e;" colspan="3"><b><?= $row_check_arrear_antar_jemput["periode"]; ?></b></td>
                                                                </tr>                                                                                                                                
                                                                <?PHP	
																	$arrear_antar_jemput_july = substr($row_check_arrear_antar_jemput["jul_cataj"],0,1);
																	if($arrear_antar_jemput_july == 1 || $arrear_antar_jemput_july == 2 || $arrear_antar_jemput_july == 3) {
																		$exp_july_antar_jemput = explode("-",$row_check_arrear_antar_jemput["jul_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- July </td><td width='10'></td><td>[Rp ".number_format($exp_july_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_july_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_august = substr($row_check_arrear_antar_jemput["aug_cataj"],0,1);
																	if($arrear_antar_jemput_august == 1 || $arrear_antar_jemput_august == 2 || $arrear_antar_jemput_august == 3) { 
																		$exp_august_antar_jemput = explode("-",$row_check_arrear_antar_jemput["aug_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Agustus </td><td width='10'></td><td>[Rp ".number_format($exp_august_antar_jemput[1],0,",",".").",-]</td></tr>";  $nom_antar_jemput += $exp_august_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_september = substr($row_check_arrear_antar_jemput["sep_cataj"],0,1);
																	if($arrear_antar_jemput_september == 1 || $arrear_antar_jemput_september == 2 || $arrear_antar_jemput_september == 3) {
																		$exp_september_antar_jemput	= explode("-",$row_check_arrear_antar_jemput["sep_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- September </td><td width='10'></td><td>[Rp ".number_format($exp_september_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_september_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_october = substr($row_check_arrear_antar_jemput["oct_cataj"],0,1);
																	if($arrear_antar_jemput_october == 1 || $arrear_antar_jemput_october == 2 || $arrear_antar_jemput_october == 3) { 
																		$exp_october_antar_jemput = explode("-",$row_check_arrear_antar_jemput["oct_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Oktober </td><td width='10'></td><td>[Rp ".number_format($exp_october_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_october_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_november = substr($row_check_arrear_antar_jemput["nov_cataj"],0,1);
																	if($arrear_antar_jemput_november == 1 || $arrear_antar_jemput_november == 2 || $arrear_antar_jemput_november == 3) { 
																		$exp_november_antar_jemput = explode("-",$row_check_arrear_antar_jemput["nov_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- November </td><td width='10'></td><td>[Rp ".number_format($exp_november_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_november_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_december = substr($row_check_arrear_antar_jemput["dec_cataj"],0,1);
																	if($arrear_antar_jemput_december == 1 || $arrear_antar_jemput_december == 2 || $arrear_antar_jemput_december == 3) { 
																		$exp_december_antar_jemput = explode("-",$row_check_arrear_antar_jemput["dec_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Desember </td><td width='10'></td><td>[Rp ".number_format($exp_december_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_december_antar_jemput[1]; 
																	
																	}
																	
																	$arrear_antar_jemput_january = substr($row_check_arrear_antar_jemput["jan_cataj"],0,1);
																	if($arrear_antar_jemput_january == 1 || $arrear_antar_jemput_january == 2 || $arrear_antar_jemput_january == 3) { 
																		$exp_january_antar_jemput = explode("-",$row_check_arrear_antar_jemput["jan_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Januari </td><td width='10'></td><td>[Rp ".number_format($exp_january_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_january_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_february = substr($row_check_arrear_antar_jemput["feb_cataj"],0,1);
																	if($arrear_antar_jemput_february == 1 || $arrear_antar_jemput_february == 2 || $arrear_antar_jemput_february == 3) { 
																		$exp_february_antar_jemput = explode("-",$row_check_arrear_antar_jemput["feb_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Februari </td><td width='10'></td><td>[Rp ".number_format($exp_february_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_february_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_march = substr($row_check_arrear_antar_jemput["mar_cataj"],0,1);
																	if($arrear_antar_jemput_march == 1 || $arrear_antar_jemput_march == 2 || $arrear_antar_jemput_march == 3) { 
																		$exp_march_antar_jemput = explode("-",$row_check_arrear_antar_jemput["mar_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Maret </td><td width='10'></td><td>[Rp ".number_format($exp_march_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_march_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_april = substr($row_check_arrear_antar_jemput["apr_cataj"],0,1);
																	if($arrear_antar_jemput_april == 1 || $arrear_antar_jemput_april == 2 || $arrear_antar_jemput_april == 3) { 
																		$exp_april_antar_jemput = explode("-",$row_check_arrear_antar_jemput["apr_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- April </td><td width='10'></td><td>[Rp ".number_format($exp_april_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_april_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_may = substr($row_check_arrear_antar_jemput["may_cataj"],0,1);
																	if($arrear_antar_jemput_may == 1 || $arrear_antar_jemput_may == 2 || $arrear_antar_jemput_may == 3) { 
																		$exp_may_antar_jemput = explode("-",$row_check_arrear_antar_jemput["may_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Mei </td><td width='10'></td><td>[Rp ".number_format($exp_may_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_may_antar_jemput[1]; 
																	}
																	
																	$arrear_antar_jemput_june = substr($row_check_arrear_antar_jemput["jun_cataj"],0,1);
																	if($arrear_antar_jemput_june == 1 || $arrear_antar_jemput_june == 2 || $arrear_antar_jemput_june == 3) { 
																		$exp_june_antar_jemput = explode("-",$row_check_arrear_antar_jemput["jun_cataj"]);
																		echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Juni </td><td width='10'></td><td>[Rp ".number_format($exp_june_antar_jemput[1],0,",",".").",-]</td></tr>"; $nom_antar_jemput += $exp_june_antar_jemput[1]; 
																	}
                                                                    
                                                                }																	
                                                                ?>	
                                                                <tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>		
                                                            </table>
                                                        </td>
                                                        <td width="10" bgcolor="#1c252f">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr height="40">
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#FFFF99"></td>
                                                        <td width="200" bgcolor="#FFFF99" id="text_normal_black">Tagihan Antar jemput bulan ini</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#FFFF99" align="left" id="text_normal_black">&nbsp;<b style="font-size:16px;"><?= "Rp ".number_format($nom_antar_jemput,0,",",".").",-"; ?></b></td>
                                                        <td width="10" bgcolor="#FFFF99">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                     <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#87778a"></td>
                                                        <td width="200" bgcolor="#87778a" id="text_normal_white">Antar Jemput (bulan)</td>
                                                        <td width="5" bgcolor="#87778a"></td>
                                                        <td width="10" bgcolor="#87778a" align="left">
                                                        <span style="font-size:9px; font-family:verdana; color:#ffcc00;">Gunakan tombol <b style="color:#FFFFFF;">Shift</b> untuk memilih lebih dari 1 bulan</span><br />  
                                                        <select name="bulan_antar_jemput[]" id="id_cur_month_antar_jemput" size="12" style="width: 200px" multiple="multiple" onchange="update_antar_jemput()">
                                                        <option value="---0"></option>
														<?PHP
														while($row_check_arrear_antar_jemput_auto = mysql_fetch_array($query_check_arrear_antar_jemput_auto)) {
														
															$arrear_antar_jemput_jul_auto = explode("-",$row_check_arrear_antar_jemput_auto["jul_cataj"]);
															$arrear_antar_jemput_aug_auto = explode("-",$row_check_arrear_antar_jemput_auto["aug_cataj"]);
															$arrear_antar_jemput_sep_auto = explode("-",$row_check_arrear_antar_jemput_auto["sep_cataj"]);
															$arrear_antar_jemput_oct_auto = explode("-",$row_check_arrear_antar_jemput_auto["oct_cataj"]);
															$arrear_antar_jemput_nov_auto = explode("-",$row_check_arrear_antar_jemput_auto["nov_cataj"]);
															$arrear_antar_jemput_dec_auto = explode("-",$row_check_arrear_antar_jemput_auto["dec_cataj"]);
															$arrear_antar_jemput_jan_auto = explode("-",$row_check_arrear_antar_jemput_auto["jan_cataj"]);
															$arrear_antar_jemput_feb_auto = explode("-",$row_check_arrear_antar_jemput_auto["feb_cataj"]);
															$arrear_antar_jemput_mar_auto = explode("-",$row_check_arrear_antar_jemput_auto["mar_cataj"]);
															$arrear_antar_jemput_apr_auto = explode("-",$row_check_arrear_antar_jemput_auto["apr_cataj"]);
															$arrear_antar_jemput_may_auto = explode("-",$row_check_arrear_antar_jemput_auto["may_cataj"]);
															$arrear_antar_jemput_jun_auto = explode("-",$row_check_arrear_antar_jemput_auto["jun_cataj"]);
															
															$src_year_antar_jemput_auto	= $row_check_arrear_antar_jemput_auto["periode"];
															$year_antar_jemput_auto		= substr($src_year_antar_jemput_auto,0,4).substr($src_year_antar_jemput_auto,7,4);
															
															if($arrear_antar_jemput_jul_auto[0] == 1 || $arrear_antar_jemput_jul_auto[0] == 2 || $arrear_antar_jemput_jul_auto[0] == 3) {
														?>
                                                        	<option value="jul-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_jul_auto[0]; ?>-<?= $arrear_antar_jemput_jul_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] Juli</option>
                                                        <?PHP
															}
															
															if($arrear_antar_jemput_aug_auto[0] == 1 || $arrear_antar_jemput_aug_auto[0] == 2 || $arrear_antar_jemput_aug_auto[0] == 3) {
														?>
                                                        	<option value="aug-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_aug_auto[0]; ?>-<?= $arrear_antar_jemput_aug_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] Agustus</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_sep_auto[0] == 1 || $arrear_antar_jemput_sep_auto[0] == 2 || $arrear_antar_jemput_sep_auto[0] == 3) {
														?>
                                                        	<option value="sep-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_sep_auto[0]; ?>-<?= $arrear_antar_jemput_sep_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] September</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_oct_auto[0] == 1 || $arrear_antar_jemput_oct_auto[0] == 2 || $arrear_antar_jemput_oct_auto[0] == 3) {
														?>
                                                        	<option value="oct-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_oct_auto[0]; ?>-<?= $arrear_antar_jemput_oct_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] Oktober</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_nov_auto[0] == 1 || $arrear_antar_jemput_nov_auto[0] == 2 || $arrear_antar_jemput_nov_auto[0] == 3) {
														?>
                                                        	<option value="nov-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_nov_auto[0]; ?>-<?= $arrear_antar_jemput_nov_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] November</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_dec_auto[0] == 1 || $arrear_antar_jemput_dec_auto[0] == 2 || $arrear_antar_jemput_dec_auto[0] == 3) {
														?>
                                                        	<option value="dec-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_dec_auto[0]; ?>-<?= $arrear_antar_jemput_dec_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] Desember</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_jan_auto[0] == 1 || $arrear_antar_jemput_jan_auto[0] == 2 || $arrear_antar_jemput_jan_auto[0] == 3) {
														?>
                                                        	<option value="jan-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_jan_auto[0]; ?>-<?= $arrear_antar_jemput_jan_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] Januari</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_feb_auto[0] == 1 || $arrear_antar_jemput_feb_auto[0] == 2 || $arrear_antar_jemput_feb_auto[0] == 3) {
														?>
                                                        	<option value="feb-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_feb_auto[0]; ?>-<?= $arrear_antar_jemput_feb_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] Februari</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_mar_auto[0] == 1 || $arrear_antar_jemput_mar_auto[0] == 2 || $arrear_antar_jemput_mar_auto[0] == 3) {
														?>
                                                        	<option value="mar-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_mar_auto[0]; ?>-<?= $arrear_antar_jemput_mar_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] Maret</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_apr_auto[0] == 1 || $arrear_antar_jemput_apr_auto[0] == 2 || $arrear_antar_jemput_apr_auto[0] == 3) {
														?>
                                                        	<option value="apr-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_apr_auto[0]; ?>-<?= $arrear_antar_jemput_apr_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] April</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_may_auto[0] == 1 || $arrear_antar_jemput_may_auto[0] == 2 || $arrear_antar_jemput_may_auto[0] == 3) {
														?>
                                                        	<option value="may-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_may_auto[0]; ?>-<?= $arrear_antar_jemput_may_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] May</option>
                                                        <?PHP
															
															}
															if($arrear_antar_jemput_jun_auto[0] == 1 || $arrear_antar_jemput_jun_auto[0] == 2 || $arrear_antar_jemput_jun_auto[0] == 3) {
														?>
                                                        	<option value="jun-<?= $year_antar_jemput_auto; ?>-<?= $arrear_antar_jemput_jun_auto[0]; ?>-<?= $arrear_antar_jemput_jun_auto[1]; ?>">[<?= $row_check_arrear_antar_jemput_auto["periode"]; ?>] June</option>
                                                        <?PHP
															
															}
														
														}
														?>
                                                        </select>
                                                        <?PHP
														/*
                                                        <span style="font-size:9px; font-family:verdana; color:#ffcc00;">Gunakan tombol <b style="color:#FFFFFF;">Shift</b> untuk memilih lebih dari 1 bulan</span><br />                                                        
                                                        <select name="bulan_catering[]" size="12" style="width: 200px" multiple="multiple">
                                                        <option value="july">Juli	</option>
                                                        <option value="august">Agustus</option>
                                                        <option value="september">September</option>
                                                        <option value="october">Oktober</option>
                                                        <option value="november">Nopember</option>
                                                        <option value="december">Desember</option>
                                                        <option value="january">Januari</option>
                                                        <option value="february">Februari</option>
                                                        <option value="march">Maret</option>
                                                        <option value="april">April</option>
                                                        <option value="may">Mei</option>
                                                        <option value="june">Juni</option>
                                                        </select>
														*/
														?>
                                                        </td>
                                                        <td width="10" bgcolor="#87778a">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#333333"></td>
                                                        <td width="200" bgcolor="#333333" id="text_normal_white">Total Antar jemput</td>
                                                        <td width="5" bgcolor="#333333"></td>
                                                        <td width="10" bgcolor="#333333" align="left">
                                                        <?PHP //echo "<h1>antar_jemput</h1>"; ?><input type="text" name="antar_jemput" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" />
                                                        </td>
                                                        <td width="10" bgcolor="#333333">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#333333"></td>
                                                        <td width="200" bgcolor="#333333" id="text_normal_white">Total Antar jemput</td>
                                                        <td width="5" bgcolor="#333333"></td>
                                                        <td width="10" bgcolor="#333333" align="left">
                                                        <?PHP //echo "<h1>subtotal_antar_jemput</h1>"; ?><input type="text" name="subtotal_antar_jemput"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly" />
                                                        </td>
                                                        <td width="10" bgcolor="#333333">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr> 
                                               </table>
                                        	</td>
                                        </tr>
                                        <?PHP
										} else {
										?>
                                        	<?PHP //echo "<h1>antar_jemput</h1>"; ?>
                                            <input type="hidden" name="antar_jemput" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" style="font-weight:bold; color:#33CC00; font-size:14px;"/>
                                            <?PHP //echo "<h1>subtotal_antar_jemput</h1>"; ?>
                                            <input type="hidden" name="subtotal_antar_jemput"  style="height:40px; font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/>
                                            <tr>
                                                <td colspan="7" height="5"></td>
                                            </tr>
                                            <tr>
                                                <td width="5"></td>
                                                <td colspan="5" id="text_normal_white" align="left">
                                                    <table width="300" height="60" bgcolor="#990000" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="10"></td>
                                                            <td height="40" align="center">Tidak ada tagihan untuk Antar Jemput 
                                                            </td>
                                                            <td width="10"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="5"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" height="5"></td>
                                            </tr>
										<?PHP
										}	
										?>    
                                   </table>
                                   <?PHP
								   }
								   ?>
                                   </div>
                                   <?PHP 
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									////////////////////// --Rumah Berbagi-- //////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									?>
                                   <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"><hr size="1" color="#f9f9f9" noshade="noshade" /></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>Rumah Berbagi</b></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                        	<td colspan="5" height="10"><a title="Show Table #1a" href="javascript:toggleDisplay('5')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM5"></a></td>
                                        </tr>
                                    </table>
                                    <div style="display:none;" id="table5"> 
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>    	
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Zakat Mal</td>
                                            <td width="5"></td>
                                            <td width="10" align="left"><input type="text" name="zakat_mal_ruba" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Zakat Profesi</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="zakat_profesi_ruba" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Infaq/Shodaqoh</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="infaq_sho_ruba" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Wakaf</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="wakaf_ruba" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Zakat Fitrah</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="zakat_fitrah_ruba"  onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Fidyah</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="fidyah_ruba"  onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Baksos Ramadhan</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="baksos_ramadhan_ruba"  onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Qurban</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="qurban_ruba" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#333333"></td>
                                            <td bgcolor="#333333" id="text_normal_white">Subtotal</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="subtotal_ruba"  style="font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                            <td>&nbsp;</td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>                                        
                                    </table>
                                    </div>  
                                    <?PHP 
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////// --School Suppport-- /////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									///////////////////////////////////////////////////////////////
									?>    
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">  
                                    	<tr>
                                        	<td colspan="6" height="10"><hr size="1" color="#f9f9f9" noshade="noshade" /></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                            <td colspan="5" align="left" id="text_normal_black"><b>School Support</b></td>
                                        </tr>
                                        <tr>
                                        	<td width="10"></td>
                                        	<td colspan="5" height="10"><a title="Show Table #1a" href="javascript:toggleDisplay('7')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM7"></a></td>
                                        </tr>
                                    </table>
                                    <div style="display:none;" id="table7">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff"> 
                                     	<tr>
                                        	<td colspan="6" height="10"></td>
                                        </tr>  
                                        <tr>
                                        	<td width="10"></td>
                                            <td width="10" bgcolor="#003366"></td>
                                            <td width="200" bgcolor="#003366" id="text_normal_white">Keterangan School Support<br />[diisi jika perlu]</td>
                                            <td></td>
                                            <td align="left"><textarea name="ket_schspt" cols="22" rows="3"></textarea></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#003333"></td>
                                            <td width="200" bgcolor="#003333" id="text_normal_white">Lain-lain (nama item / nominal)</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="nama_addition_item_schspt" /> / <input type="text" name="nominal_addition_item_schspt" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                    	<?PHP
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										//Believe me that this really, really, really serious and important
										//Read this carefully.........
										//Once you've created/inserted data in table school_support,
										//You have to keep it. I mean it's about item name and their id.
										//Once you,ve changed the sequence of the item or their id or both of them in the same time, You've broken all of it.
										//You've broken the other use of this table in the future.
										//Because of what?
										//Because the data of this table will be used sequentially....
										//So, you have to keep it as the first time you made this data..
										//And about an addition data for the item, it's okay, no problem at all.
										//The point is, YOU MAY NOT CHANGE TABLE SCHOOL_SUPPORT MANUALLY. 
										//It will impact to other process
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										////////////////////////////////////////////////////////////////
										$src_get_schspt		= "select * from school_support";
										$query_get_schspt1	= mysqli_query($mysql_connect, $src_get_schspt) or die(mysql_error());
										$query_get_schspt2	= mysqli_query($mysql_connect, $src_get_schspt) or die(mysql_error());
										
										$i_sch_sup = 1;
										while($get_schspt1	= mysql_fetch_array($query_get_schspt1)) {
										
										?>                                    	       	
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white"><?PHP echo $get_schspt1["item"];  ?></td>
                                            <td width="5"></td>
                                            <td align="left"><input type="text" name="sch_sup_<?PHP echo $i_sch_sup++; ?>_schspt" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                     	<?PHP										
										}
										?>                                    	
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#333333"></td>
                                            <td width="200" bgcolor="#333333" id="text_normal_white">Subtotal</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="subtotal_schspt"  style="font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                     </table>     
                                     </div>
                                     <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">  
                                    	<tr>
                                        	<td height="10" colspan="6"></td>
                                        </tr>
                                     </table>                                 
                                </td>
                                <td width="10" bgcolor="#b9d4de"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#b9d4de" colspan="5">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0">  
                                    	<tr>
                                        	<td height="10" colspan="6"></td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10">&nbsp;</td>
                                            <td width="10"></td>
                                            <td width="50" id="text_normal_black" align="left"><h2>Total</h2></td>
                                            <td width="10"></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="totalnya" style="font-weight:bold; font-size:18px; color:#FF6600;"  id="totalnya" onhaschange="numberFormat(this,'.','Rp. ',',00-')"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10">&nbsp;</td>
                                            <td width="10"></td>
                                            <td width="50" id="text_normal_black" align="left"><h2>Bayar</h2></td>
                                            <td width="10"></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="bayar" style="font-weight:bold; font-size:18px; color:#FF6600;"  id="bayar" onclick="MakeSum()">  </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10">&nbsp;</td>
                                            <td width="10"></td>
                                            <td width="50" id="text_normal_black" align="left"><h2>Kembali</h2></td>
                                            <td width="10"></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="kembali" style="font-weight:bold; font-size:18px; color:#669933;"  id="kembali" onhaschange="numberFormat(this,'.','Rp. ',',00-')"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr> 
                                     </table> 
                                </td>
                            </tr> 
                            <input type="hidden" name="who_operator" value="<?= ucwords($row_name["name"]); ?>" /> 
                            <tr>
                            	<td colspan="5">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0">  
                                    	<tr>
                                        	<td height="10"></td>
                                        </tr>
                                        <tr>
                                        	<td height="10" id="text_normal_black"><input type="checkbox" name="valid_transaksi" onchange="enable_transaksi(),MakeSum()" /> Klik jika seluruh isian form transaksi sudah valid</td>
                                        </tr>
                                        <tr>
                                        	<td height="10"></td>
                                        </tr>
                                        <tr height="20">
                                            <td align="left" id="text_normal_black"><input type="submit" name="submit_transaksi" value="Proses transaksi" onClick="return verification()" style="height:40px; width:200px;" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr> 
                                     </table> 
                                </td>
                            </tr>  
                            <tr>
                            	<td colspan="5">&nbsp;</td>
                            </tr>  
                        </table>
                        <?PHP //</form> ?>
                    </td>
                    <td width="10">&nbsp;</td>
                </tr>                                
            </table> 
            </form>  
		</td>
        <td></td>
     </tr>
     <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
</table>
<?PHP
		} else {
		
			echo "<br><br><span id='text_normal_black'><b>Siswa dengan No Sisda ".$no_sisda_enc." tidak diketahui</b></span>";
		
		}
		
	} else {	
	
	echo "<br><br>Anda belum memilih No Sisda untuk diproses";
	
	}
	
}
?>

<script type="text/javascript" language="javascript">
function update_spp() {

	/*var src_nom_year = document.transaksi.year_spp.value;id="year_spp"
	var src_nom_year = document.getElementById("year_spp").value;
	var nom_year = src_nom_year.substring(14);
	var num_month = document.getElementById("id_cur_month").selectedOptions.length;
	var cur_payment_spp = nom_year*num_month;
	document.transaksi.nom_spp.value = cur_payment_spp;*/
	
	
	var intNumber = 0;
	var arrListOptions = document.getElementById('id_cur_month').options;
	for(intIterator = 0; intIterator < arrListOptions.length; intIterator ++){
		if (arrListOptions[intIterator].selected == true){
		   intNumber += parseInt(arrListOptions[intIterator].value.split('-')[3]);
		}
	}
	
	document.transaksi.nom_spp.value = intNumber;
	
}

function update_catering() {

	/*var num_month_catering = document.getElementById("id_cur_month_catering").selectedOptions.length;
	var num_month_catering = document.getElementById("id_cur_month_catering").value.length;
	var cur_payment_catering = num_month_catering.substring(13);
	document.transaksi.catering.value = cur_payment_catering;*/
	
	var intNumber = 0;
	var arrListOptions = document.getElementById('id_cur_month_catering').options;
	for(intIterator = 0; intIterator < arrListOptions.length; intIterator ++){
		if (arrListOptions[intIterator].selected == true){
		   intNumber += parseInt(arrListOptions[intIterator].value.split('-')[3]);
		}
	}
	
	document.transaksi.catering.value = intNumber;
	
}

function update_antar_jemput() {

	/*var num_month_antar_jemput = document.getElementById("id_cur_month_antar_jemput").value;
	var cur_payment_antar_jemput = num_month_antar_jemput.substring(13);
	document.transaksi.antar_jemput.value = cur_payment_antar_jemput;
	*/
	
	var intNumber = 0;
	var arrListOptions = document.getElementById('id_cur_month_antar_jemput').options;
	for(intIterator = 0; intIterator < arrListOptions.length; intIterator ++){
		if (arrListOptions[intIterator].selected == true){
		   intNumber += parseInt(arrListOptions[intIterator].value.split('-')[3]);
		}
	}
	
	document.transaksi.antar_jemput.value = intNumber;
	
}
</script>

<SCRIPT type="text/javascript" >
function verification1() 
{ 
	if(document.check_id.no_sisda.value == "")
		{
			alert('No sisda tidak boleh kosong');
			return false;
		}
	if(document.check_id.no_sisda.value == "")
		{
			alert('No sisda tidak boleh kosong');
			return false;
		}
		
return true;	
}
</SCRIPT>

<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.transaksi.teknik_pembayaran.value == "")
		{
			alert('Anda harus menentukan teknik pembayaran');
			return false;
		}
	if(document.transaksi.teknik_pembayaran.value == "transfer")
	{
		if(document.transaksi.tanggal_transfer.value == "")
		{
			alert('Anda memilik metode pembayaran via tranfer, anda harus memilih tanggal transfer');
			return false;
		}
		if(document.transaksi.bulan_transfer.value == "")
		{
			alert('Anda memilik metode pembayaran via tranfer, anda harus memilih bulan transfer');
			return false;
		}
		if(document.transaksi.tahun_transfer.value == "")
		{
			alert('Anda memilik metode pembayaran via tranfer, anda harus memilih tahun transfer');
			return false;
		}
		if(document.transaksi.bank_tujuan.value == "")
		{
			alert('Anda memilik metode pembayaran via tranfer, anda harus memilih bank tujuan');
			return false;
		}
	}
	
	if(document.transaksi.nom_daful.value != "")/*8888888*/
	{	
		if(document.transaksi.year_daftar_ulang.value == "")/*8888888*/
		{
		
			alert('Tahun pembayaran daftar ulang harus dipilih');
			return false;
		}
	}
	
	if(document.transaksi.bulan_spp.value == "")
	{
	
		alert('sfsdfdsfsd');
		return false;
	}
	
	if(document.transaksi.nama_addition_item_schspt.value != "")
	{
		if(document.transaksi.nominal_addition_item_schspt.value == "")
		{
			alert('Jika anda mengisi nama item baru untuk School Support, maka nominal item harus dilengkapi');
			return false;
		}
	}
	if(document.transaksi.nominal_addition_item_schspt.value != "")
	{
		if(document.transaksi.nama_addition_item_schspt.value == "")
		{
			alert('Jika anda mengisi nominal item baru untuk School Support, maka nama item harus dilengkapi');
			return false;
		}
	}
	
	if(document.transaksi.bayar.value == "")
	{
		alert('kolom Bayar harus diisi');
		return false;
	}

return true;	
}
</SCRIPT>

<script language="javascript">
//this script is for show/hidden table function
imageX1='plus';
imageX2='plus';
imageX3='plus';
imageX4='plus';
imageX5='plus';
imageX6='plus';
imageX7='plus';

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

<script type="text/javascript" language="javascript">
<!--

/*We have to make the 4 buttons disable automatically
when the page loaded.
*/
function happycode(){
	document.transaksi.tanggal_transfer.disabled = true;
	document.transaksi.bulan_transfer.disabled = true;
	document.transaksi.tahun_transfer.disabled = true;
	document.transaksi.bank_tujuan.disabled = true;
	document.transaksi.submit_transaksi.disabled = true;
}

window.onload=happycode ;

/*Then the submit button turn to be enabled when the option tranfer on pembayaran selection, chosen
and it turn to be disabled again when the check button unchecked
*/
function toggleSelect() {

	if (document.transaksi.teknik_pembayaran.value == "tunai" || document.transaksi.teknik_pembayaran.value == "") {
		document.transaksi.tanggal_transfer.disabled = true;
		document.transaksi.bulan_transfer.disabled = true;
		document.transaksi.tahun_transfer.disabled = true;
		document.transaksi.bank_tujuan.disabled = true;
	} else {
		document.transaksi.tanggal_transfer.disabled = false;
		document.transaksi.bulan_transfer.disabled = false;
		document.transaksi.tahun_transfer.disabled = false;
		document.transaksi.bank_tujuan.disabled = false;
	}			
}

function enable_transaksi() {

	if(document.transaksi.valid_transaksi.checked == true) {
	
		document.transaksi.submit_transaksi.disabled = false;
	
	} else {
	
		document.transaksi.submit_transaksi.disabled = true;
	
	}

}
-->
</script>

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt)
{
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    {
        alert ( "Hanya boleh diisi dengan angka." );
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<script language="JavaScript"> 
<!-- 

function AddIfValid(field) { 

    if ((field.value.length == 0) || (field.value == null)) { 
        return 0; 
    } else { 
        return eval(field.value); 
    } 

} 

function MakeSum() { 
	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	/*
	You over there, this is really important
	i'm listening to van halen acoustic --> you really got me
	it's cool
	
	
	heheheh no no no, i dont wanna talk about it.
	i just wanna say that you have to be careful with this JS and PHP above that has relation with this JS
	once you have changed, at least 1 dot or comma or letter case between them, you've made this JS absolutely not working anymore
	if you dont believe me, try that!
	and you will take your whole life to find the bug...
	Ngerti ora son...? panjenengan aja meneng bae lahhh......
	
	if the trouble happens (auto count is not working), use / * * / below to trace the bug
	*/
	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	
    // Initialize the total variable to 0 
    var t 		= 0; 
	var t1 		= 0; 
	var t2 		= 0; 
	var t3 		= 0;
	var t4 		= 0; 
	var t5 		= 0; 
	var	t6		= 0;
	var	t7		= 0;
	var bayar 	= 0;
	var kembali	= 0;
	var src_kembali = 0;/**/

    // Add the values 
    // Note that if a value is not numeric, 
    // it is ignored without formally raising an error 
							
	//Daftar ulang						
    t1 += AddIfValid(document.transaksi.nom_daful); 
	
	//Biaya masuk 	
	t2 += AddIfValid(document.transaksi.nom_bima);  
	
	//SPP
	t3 += AddIfValid(document.transaksi.nom_spp); 
	
	/**/
	//Rumah berbagi
	t4 += AddIfValid(document.transaksi.zakat_mal_ruba); 
	t4 += AddIfValid(document.transaksi.zakat_profesi_ruba); 
	t4 += AddIfValid(document.transaksi.infaq_sho_ruba); 
	t4 += AddIfValid(document.transaksi.wakaf_ruba);
	t4 += AddIfValid(document.transaksi.zakat_fitrah_ruba); 
	t4 += AddIfValid(document.transaksi.fidyah_ruba);	
	t4 += AddIfValid(document.transaksi.baksos_ramadhan_ruba);	
	t4 += AddIfValid(document.transaksi.qurban_ruba);	
	
	//School support
	<?PHP 
	$i_sch_sup = 1;
	//you've knew why it should be in a looping
	while($get_schspt2	= mysql_fetch_array($query_get_schspt2)) {
	?>
	t5 += AddIfValid(document.transaksi.<?PHP echo "sch_sup_".$i_sch_sup++."_schspt"; ?>); 
	<?
	} 
	?>
	t5 += AddIfValid(document.transaksi.nominal_addition_item_schspt);
	
	//Cataj
	//Yo-yo-yo, why we use if for cataj. 
	//Because it's optional, student may join cataj or no.
	//We only do the process if the cataj exist
	<?PHP
	$src_catering_arrear_exist 		= empty($catering_arrear_exist) ? "" : $catering_arrear_exist;
	$src_antar_jemput_arrear_exist 	= empty($antar_jemput_arrear_exist) ? "" : $antar_jemput_arrear_exist;
	
	if($src_catering_arrear_exist == "1") {
	?>
	t6 += AddIfValid(document.transaksi.catering); 
	<?PHP
	}
	
	if($src_antar_jemput_arrear_exist == "1") {
	?>
	t7 += AddIfValid(document.transaksi.antar_jemput); 
	<?PHP
	}
	?>
	 /**/
	
	bayar = document.transaksi.bayar.value;
	
	//total 
	t =  t1  + t2 + t3 + t4 + t5 + t6 + t7;
	
	src_kembali = bayar - t;
	
	if(src_kembali < 0) {
		kembali = 0;
	} else {
		kembali = src_kembali;
	}

    //Display the total in the CategoryTotal text box 
    document.transaksi.totalnya.value = t; 
	document.transaksi.subtotal_daful.value = t1;
	document.transaksi.subtotal_bima.value = t2;
	document.transaksi.subtotal_spp.value = t3;
	document.transaksi.subtotal_ruba.value = t4;
	document.transaksi.subtotal_schspt.value = t5;
	document.transaksi.subtotal_catering.value = t6;
	document.transaksi.subtotal_antar_jemput.value = t7;
	/**/
	
	document.transaksi.kembali.value = kembali; 
	
} 

// --> 
</script> 

<SCRIPT type="text/javascript" >
String.prototype.reverse = function() {
var s = "";
var i = this.length;
while (i>0) {
s += this.substring(i-1,i);
i--;
}
return s;
}
function numberFormat(obj,separator,frontsymbol,endsymbol){
//replace frontsymbol and endsymbol
obj.value=obj.value.replace(frontsymbol,"");
obj.value=obj.value.replace(endsymbol,"");
//replace . with ""
var i;
for (i=0;i<obj.value.length;i++){
if (obj.value.charAt(i)==separator){
obj.value=obj.value.replace(separator,"");
}
}

//end
var strvalue=parseFloat(obj.value);
if (isNaN(strvalue)){strvalue=0;}
var s=new String(strvalue);
var p="";
var j=0;
for (i=s.length-1;i>=0;i-=1){
p+=s.substr(i,1);
j++
if (j>2){
p+=separator;
j=0;
}
}
p=p.reverse();
if (p.substr(0,1)==separator){
p=p.substr(1,p.length-1);
}
obj.value=frontsymbol+p+endsymbol;
}
</SCRIPT>