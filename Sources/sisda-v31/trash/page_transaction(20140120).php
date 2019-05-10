<?PHP
//Yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	if(!empty($_POST["no_sisda"]) || !empty($_GET["no"])) {
	
		if(!empty($_POST["no_sisda"])) {
			
			$no_sisda_enc	= htmlspecialchars($_POST["no_sisda"]);
			
		} else if(!empty($_GET["no"])) {
		
			$no_sisda_enc	= htmlspecialchars($_GET["no"]);
			
		}
	
		//$no_sisda_enc	= htmlspecialchars($_POST["no_sisda"]);
		$no_sisda_esc	= mysql_real_escape_string($no_sisda_enc);
		
		$src_select_siswa 	= "select * from siswa_finance where no_sisda = '$no_sisda_esc' and aktif = '1'";
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
                                <td><!-- the verification function returned here, in submit button, check the whole script below --><input type="submit" value="Lakukan transaksi" onClick="return verification1()" style="width:208px; height:35px;"/><input type="reset" value="Kosongkan" style="width:208px; height:35px;" /></td>
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
                                <td align="left" style="font-size:18px; color:#FF6600; font-family:verdana;"><?PHP echo $no_sisda_enc; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="5"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#999999"></td>
                                <td bgcolor="#999999" id="text_normal_white">Nama</td>
                                <td></td>
                                <td align="left" style="font-size:22px; color:#CC3366; font-family:verdana;"><?PHP echo $row_select_siswa["nama_siswa"]; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="5"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#999999"></td>
                                <td bgcolor="#999999" id="text_normal_white">Jenjang</td>
                                <td></td>
                                <td align="left" style="font-size:18px; color:#993366; font-family:verdana;"><?PHP echo $row_select_siswa["jenjang"]; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="5"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#999999"></td>
                                <td bgcolor="#999999" id="text_normal_white">Tingkat</td>
                                <td></td>
                                <td align="left" style="font-size:18px; color:#006699; font-family:verdana;"><?PHP echo $row_select_siswa["tingkat"]; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" height="5"></td>
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
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                            	<td bgcolor="#666633" colspan="5" align="center" id="text_normal_black">&nbsp;</td>
                            </tr>         	
                            <tr height="20">
                            	<td width="10" bgcolor="#666633"></td>
                                <td bgcolor="#ffffff" valign="top">
                                	<?PHP 
									$src_tuk_transaksi		= "select * from transaksi where no_sisda = '$no_sisda_esc' and bima = '1'";
									$query_tuk_transaksi	= mysqli_query($mysql_connect, $src_tuk_transaksi) or die(mysql_error());
									$num_tuk_transaksi		= mysql_num_rows($query_tuk_transaksi);
									
									if($num_tuk_transaksi == "0") {
										$total_biaya_masuk	= "0";
									} else {
										$row_tuk_transaksi	=  "";
									}
									?>
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
                                            <td bgcolor="#999999" id="text_normal_white">Kegiatann</td>
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
                                <td width="200" bgcolor="#999999" id="text_normal_white">Teknik Pembayaran</td>
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
                                <td align="left"><select name="bank_tujuan">
                                <option value="">Pilih</option>
                                <option value="bca">BCA</option>
                                <option value="bsm">BSM</option>
                                <option value="bmi">BMI</option>
                                </select></td>
                                <td>&nbsp;</td>
                            </tr>                            
                            <tr>
                                <td colspan="6" height="10"></td>
                            </tr>
                        </table>
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                            	<td bgcolor="#3399cc" colspan="5" align="center" id="text_normal_black">&nbsp;</td>
                            </tr>         	
                            <tr height="20">
                            	<td width="10" bgcolor="#3399cc"></td>
                                <td bgcolor="" valign="top">
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
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Tahun ajaran</td>
                                            <td width="5"></td>
                                            <td width="10" align="left">
                                            <select name="year_kegiatan" size="3" style="width: 150px">
                                            <?PHP $cur_spp_year = date("Y"); ?>
                                            <?PHP //<option selected>Pilih tahun ajaran</option> ?>
                                            <option value="<?PHP echo ($cur_spp_year-2)." - ".($cur_spp_year-1); ?>"><?PHP echo ($cur_spp_year-2)." - ".($cur_spp_year-1); ?></option>
                                            <option value="<?PHP echo ($cur_spp_year-1)." - ".($cur_spp_year); ?>"><?PHP echo ($cur_spp_year-1)." - ".($cur_spp_year); ?></option>
                                            <option value="<?PHP echo ($cur_spp_year)." - ".($cur_spp_year+1); ?>"><?PHP echo ($cur_spp_year)." - ".($cur_spp_year+1); ?></option>
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
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Kegiatan</td>
                                            <td width="5"></td>
                                            <td width="10" align="left"><input type="text" name="kegiatan_daful" onkeypress="return checkIt(event)" onKeyUp="MakeSum();" /></td>
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
                                            <td align="left"><input type="text" name="peralatan_daful" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
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
                                            <td align="left"><input type="text" name="seragam_daful" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Lunas/Cicilan ke</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="luncil_daful" onkeypress="return checkIt(event)" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Sub Total</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="subtotal_daful" style="font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
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
                                        
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                    </div>
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
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Pengembangan</td>
                                            <td width="5"></td>
                                            <td width="10" align="left"><input type="text" name="pengembangan_bima" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"  /></td>
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
                                            <td align="left"><input type="text" name="kegiatan_bima" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"  /></td>
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
                                            <td align="left"><input type="text" name="peralatan_bima" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
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
                                            <td align="left"><input type="text" name="seragam_bima" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
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
                                            <td align="left"><input type="text" name="paket_bima" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();" /></td>
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
                                            <td align="left"><input type="text" name="spp_juli_bima" onkeypress="return checkIt(event)" onKeyUp="MakeSum();" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Tahap</td>
                                            <td></td>
                                            <td align="left">
                                            <select name="tahap_bima">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            </select>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Lunas/Cicilan ke</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="lucil_bima" onkeypress="return checkIt(event)"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Sub Total</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="subtotal_bima" style="font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
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
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                    </div>
                                <?PHP /*
                                </td>
                                <td width="10" bgcolor="#3399cc"></td>
                                <td bgcolor="#ffffff" valign="top">
								*/ ?>   
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
                                        <tr height="20">
                                            <td width="10" ></td>
                                            <td colspan="4">
                                            	<table bgcolor="#999999" border="0" cellpadding="0" cellspacing="0">
                                                	<tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
                                                    <?PHP
													//where are going to check whether this student has any arrears or not
													
													$src_check_arrear 	= "select * from tunggakan where no_sisda = '$no_sisda_enc' and jenis_tunggakan = 'spp' and jumlah_item_tunggakan = 1";
													$query_check_arrear	= mysqli_query($mysql_connect, $src_check_arrear) or die(mysql_error());
													$num_check_arrear	= mysql_num_rows($query_check_arrear);
													
													//echo $src_check_arrear;
													//echo "<h1>$num_check_arrear</h1>";
													if($num_check_arrear != 0) {
													?>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#990000"></td>
                                                        <td width="200" bgcolor="#990000" id="text_normal_white">Bulan SPP yang belum dibayarkan <img src="images/what_happen_aya_naon.jpg" border="0" onMouseOver="stm(Text[2],Style[12])" onMouseOut="htm()" /></td>
                                                        <td width="5" bgcolor=""></td>
                                                        <td width="10" bgcolor="#990000" align="left">
                                                        	<table width="250" border="0" cellpadding="0" cellspacing="0" id="text_normal_white">
                                                            	<tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>                                                           	
																<?PHP
																$nom_spp = 0;
                                                                while($row_education_year = mysql_fetch_array($query_check_arrear)) {
                                                                ?>
                                                                <tr>
                                                                	<td width="5"></td>
                                                                    <td style="color:#FF9900;" colspan="3"><b><?= $row_education_year["periode"]; ?></b></td>
                                                                </tr>                                                                                                                                
                                                                <?PHP	
                                                                if($row_education_year["july"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- July </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["august"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Agustus </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>";  $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["september"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- September </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["october"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Oktober </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["november"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- November </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["december"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Desember </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["january"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Januari </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["february"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Februari </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["march"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Maret </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["april"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- April </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["may"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Mei </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                if($row_education_year["june"] == 1) { echo "<tr><td width='5'></td><td style='color:#99CCFF;'>- Juni </td><td width='10'></td><td>[Rp ".number_format($row_education_year["nominal_tunggakan"],0,",",".").",-]</td></tr>"; $nom_spp += $row_education_year["nominal_tunggakan"]; }
                                                                    
                                                                }																	
                                                                ?>	
                                                                <tr>
                                                                	<td colspan="4">&nbsp;</td>
                                                                </tr>		
                                                            </table>
                                                        </td>
                                                        <td width="10" bgcolor="#990000">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr height="30">
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#FFFF99"></td>
                                                        <td width="200" bgcolor="#FFFF99" id="text_normal_black">Tagihan SPP bulan ini</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#FFFF99" align="left" id="text_normal_black">&nbsp;<b style="font-size:16px;"><?= "Rp ".number_format($nom_spp,0,",",".").",-"; ?></b></td>
                                                        <td width="10" bgcolor="#FFFF99">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="10"></td>
                                                    </tr>
													<?PHP
													} else {
														
														include_once("include/define_month_spp.php");
														$src_select_cur_spp		= "select spp from siswa_finance where no_sisda = '$no_sisda_enc' and periode = '$edu_year'";
														$query_select_cur_spp	= mysqli_query($mysql_connect, $src_select_cur_spp) or die("Terjadi kesalahan: ".mysql_error());
														$row_select_cur_spp		= mysql_fetch_array($query_select_cur_spp);
													?>
                                                    <tr height="30">
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#FFFF99"></td>
                                                        <td width="200" bgcolor="#FFFF99" id="text_normal_black">Tagihan SPP bulan ini</td>
                                                        <td width="5"></td>
                                                        <td width="10" bgcolor="#FFFF99" align="left" id="text_normal_black">&nbsp;<b style="font-size:16px;"><?= "Rp ". number_format($row_select_cur_spp["spp"],0,",",".").",-"; ?></b></td>
                                                        <td width="10" bgcolor="#FFFF99">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <?PHP
													}																
													?>
                                                	<tr>
                                                        <td width="10"></td>
                                                        <td width="10" bgcolor="#336699"></td>
                                                        <td width="200" bgcolor="#336699" id="text_normal_white">SPP (tahun ajaran)</td>
                                                        <td width="5" bgcolor="#336699"></td>
                                                        <td width="10" bgcolor="#336699" align="left">
                                                        <select name="year_spp" size="3" style="width: 150px">
                                                        <?PHP $cur_spp_year = date("Y"); ?>
                                                        <?PHP //<option selected>Pilih tahun ajaran</option> ?>
                                                        <option value="<?PHP echo ($cur_spp_year-2)." - ".($cur_spp_year-1); ?>"><?PHP echo ($cur_spp_year-2)." - ".($cur_spp_year-1); ?></option>
                                                        <option value="<?PHP echo ($cur_spp_year-1)." - ".($cur_spp_year); ?>"><?PHP echo ($cur_spp_year-1)." - ".($cur_spp_year); ?></option>
                                                        <option value="<?PHP echo ($cur_spp_year)." - ".($cur_spp_year+1); ?>"><?PHP echo ($cur_spp_year)." - ".($cur_spp_year+1); ?></option>
                                                        </select>
                                                        
                                                    	</td>
                                                        <td width="10" bgcolor="#336699">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#336699"></td>
                                                        <td width="200" bgcolor="#336699" id="text_normal_white">SPP (bulan)</td>
                                                        <td width="5" bgcolor="#336699"></td>
                                                        <td width="10" bgcolor="#336699" align="left">
                                                        <span style="font-size:9px; font-family:verdana; color:#ffcc00;">Gunakan tombol <b style="color:#FFFFFF;">Shift</b> untuk memilih lebih dari 1 bulan</span><br />                                                        <select name="bulan_spp[]" size="12" style="width: 200px" multiple="multiple">
                                                        <option value="july">Juli</option>
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
                                                        </td>
                                                        <td width="10" bgcolor="#336699">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" height="5"></td>
                                                    </tr> 
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#336699"></td>
                                                        <td width="200" bgcolor="#336699" id="text_normal_white">SPP (nominal)</td>
                                                        <td width="5" bgcolor="#336699"></td>
                                                        <td width="10" bgcolor="#336699" align="left"><input type="text" name="spp_spp" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"/></td>
                                                        <td width="10" bgcolor="#336699">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" height="5"></td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="10"></td>
                                                        <td width="10" bgcolor="#336699"></td>
                                                        <td width="200" bgcolor="#336699" id="text_normal_white">Komite Sekolah</td>
                                                        <td width="5" bgcolor="#336699"></td>
                                                        <td width="10" bgcolor="#336699" align="left"><input type="text" name="ks_spp" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"/></td>
                                                        <td width="10" bgcolor="#336699">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" height="10"></td>
                                                    </tr>
                                                 </table>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10"></td>
                                            <td width="10" bgcolor="#999999"></td>
                                            <td width="200" bgcolor="#999999" id="text_normal_white">Sub Total</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="subtotal_spp"  style="font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
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
                                        <tr>
                                            <td colspan="6" height="10"></td>
                                        </tr>
                                    </table>
                                    </div>
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
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Sub Total</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="subtotal_ruba"  style="font-weight:bold; color:#FF6600; font-size:14px;" readonly="readonly"/></td>
                                            <td>&nbsp;</td>
                                        </tr>                                        
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>                                        
                                    </table>
                                    </div>
                                <?PHP /*
                                </td>
                                <td width="10" bgcolor="#3399cc"></td>
                                <td bgcolor="#ffffff" valign="top">
								*/ ?>
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
                                        	<td colspan="5" height="10"><a title="Show Table #1a" href="javascript:toggleDisplay('6')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM6"></a></td>
                                        </tr>
                                    </table>
                                    <div style="display:none;" id="table6">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff"> 
                                     	<tr>
                                        	<td colspan="6" height="10"></td>
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
										//It will impact other process
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
										/*
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Catering</td>
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
                                            <td bgcolor="#999999" id="text_normal_white">Antar jemput</td>
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
                                            <td bgcolor="#999999" id="text_normal_white">Cheperone</td>
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
                                            <td bgcolor="#999999" id="text_normal_white">Buku paket</td>
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
                                            <td bgcolor="#999999" id="text_normal_white">PTA</td>
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
                                            <td bgcolor="#999999" id="text_normal_white">Kas kelas</td>
                                            <td></td>
                                            <td align="left"><input name="lain_lain_kas_kelas"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#003333"></td>
                                            <td bgcolor="#003333" id="text_normal_white">Lain-lain (nama item / nominal)</td>
                                            <td></td>
                                            <td align="left"><input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /> / <input type="text" readonly="readonly" value="<?PHP echo $no_sisda_enc; ?>" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Subtotal</td>
                                            <td></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="subtotal_lain_lain" /></td>
                                            <td>&nbsp;</td>
                                        </tr>
									*/ 
									}
									?>
                                    	<tr height="20">
                                            <td></td>
                                            <td bgcolor="#003333"></td>
                                            <td bgcolor="#003333" id="text_normal_white">Lain-lain (nama item / nominal)</td>
                                            <td></td>
                                            <td align="left"><input type="text" name="nama_item_schspt" /> / <input type="text" name="nominal_item_schspt" onkeypress="return checkIt(event)"  onKeyUp="MakeSum();"/></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="5"></td>
                                        </tr>
                                        <tr height="20">
                                            <td></td>
                                            <td bgcolor="#999999"></td>
                                            <td bgcolor="#999999" id="text_normal_white">Subtotal</td>
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
                                <td width="10" bgcolor="#3399cc"></td>
                            </tr>
                            <tr>
                            	<td bgcolor="#3399cc" colspan="5">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0">  
                                    	<tr>
                                        	<td height="10" colspan="6"></td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10">&nbsp;</td>
                                            <td width="10"></td>
                                            <td width="50" id="text_normal_white" align="left"><h2>Total</h2></td>
                                            <td width="10"></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="totalnya" style="font-weight:bold; font-size:18px; color:#FF6600;"  id="totalnya" onhaschange="numberFormat(this,'.','Rp. ',',00-')"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10">&nbsp;</td>
                                            <td width="10"></td>
                                            <td width="50" id="text_normal_white" align="left"><h2>Bayar</h2></td>
                                            <td width="10"></td>
                                            <td align="left" id="text_normal_black"><input type="text" name="bayar" style="font-weight:bold; font-size:18px; color:#FF6600;"  id="bayar" onKeyUp="MakeSum();">  </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr height="20">
                                            <td width="10">&nbsp;</td>
                                            <td width="10"></td>
                                            <td width="50" id="text_normal_white" align="left"><h2>Kembali</h2></td>
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
                            <tr>
                            	<td colspan="5">
                                	<table width="100%" border="0" cellpadding="0" cellspacing="0">  
                                    	<tr>
                                        	<td height="10"></td>
                                        </tr>
                                        <tr height="20">
                                            <td align="left" id="text_normal_black"><input type="submit" value="Proses transaksi" onClick="return verification()" style="height:40px; width:200px;" /></td>
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
			echo "<br><br>siswa dengan No Sisda".$no_sisda_enc." tidak diketahui";
		}
	} else {	
	echo "<br><br>Anda belum memilih No Sisda untuk diproses";
	}
}
?>
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
	
	if(document.transaksi.bulan_spp.value == "")
		{
		
			alert('sfsdfdsfsd');
			return false;
		}
	
	if(document.transaksi.nama_item_schspt.value != "")
	{
		if(document.transaksi.nominal_item_schspt.value == "")
		{
			alert('Jika anda mengisi nama item baru untuk School Support, maka nominal item harus dilengkapi');
			return false;
		}
	}
	if(document.transaksi.nominal_item_schspt.value != "")
	{
		if(document.transaksi.nama_item_schspt.value == "")
		{
			alert('Jika anda mengisi nominal item baru untuk School Support, maka nama item harus dilengkapi');
			return false;
		}
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
	you what i'm listening to van halen acoustic --> you really got me
	it's cool
	
	
	heheheh no no no, i dont wanna talk about it.
	i just wanna say that you have to be careful with this JS and PHP above that has relation with this JS
	once you have changed, at least 1 dot or comma or letter case between them, you've made this JS absolutely not working anymore
	if you dont believe me, try that!
	and you will take you whole life to find the bug...
	Ngerti ora son...? panjenengan aja meneng bae lahhh......
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
	var bayar 	= 0;
	var kembali	= 0;
	var src_kembali = 0;

    // Add the values 
    // Note that if a value is not numeric, 
    // it is ignored without formally raising an error 
							
	//Daftar ulang						
    t1 += AddIfValid(document.transaksi.kegiatan_daful); 
    t1 += AddIfValid(document.transaksi.peralatan_daful); 
    t1 += AddIfValid(document.transaksi.seragam_daful); 
	
	//Biaya masuk
	t2 += AddIfValid(document.transaksi.pengembangan_bima); 
	t2 += AddIfValid(document.transaksi.kegiatan_bima); 
	t2 += AddIfValid(document.transaksi.peralatan_bima); 
	t2 += AddIfValid(document.transaksi.seragam_bima); 
	t2 += AddIfValid(document.transaksi.paket_bima); 
	t2 += AddIfValid(document.transaksi.spp_juli_bima); 
	
	//Biaya masuk
	t3 += AddIfValid(document.transaksi.spp_spp); 
	t3 += AddIfValid(document.transaksi.ks_spp);
	
	//Rumah berbagi
	t4 += AddIfValid(document.transaksi.zakat_mal_ruba); 
	t4 += AddIfValid(document.transaksi.zakat_profesi_ruba); 
	t4 += AddIfValid(document.transaksi.infaq_sho_ruba); 
	t4 += AddIfValid(document.transaksi.wakaf_ruba);
	t4 += AddIfValid(document.transaksi.zakat_fitrah_ruba); 
	t4 += AddIfValid(document.transaksi.fidyah_ruba);	
	t4 += AddIfValid(document.transaksi.baksos_ramadhan_ruba);	
	t4 += AddIfValid(document.transaksi.qurban_ruba);	
	/**/
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
	t5 += AddIfValid(document.transaksi.nominal_item_schspt);
	
	bayar = document.transaksi.bayar.value;
	
	//total 
	t = t1 + t2 + t3 + t4 + t5/**/;
	
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