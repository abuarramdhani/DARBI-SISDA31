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
        	<?PHP // <form method="post" name="reg_adm_siswa" action="engine.php?case=reg_adm_siswa"> ?>
			<form method="post" name="reg_adm_siswa" action="page/page_reg_adm_siswa_redirect.php">             
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
                	<?php $ga = $_POST["nama_siswa"]; ?>
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama Lengkap</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_siswa"  size="35" value="<?PHP echo $ga ; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama ayah / bunda / status</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_ayah"  size="35" value="<?PHP echo $_POST["nama_ayah"]; ?>" readonly="readonly"/> / <input type="text" name="nama_bunda" size="35" value="<?PHP echo $_POST["nama_bunda"]; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Kategori SPP</td>
                    <td width="5"></td>
                    <td><input type="text" name="kat_status_anak" size="35" value="<?PHP echo ucwords($_POST["kat_status_anak"]); ?>" readonly="readonly"/></td>
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
                <?PHP
				$src_tanggal_daftar = (empty($_POST["src_tanggal_daftar"])) ? $_POST["tanggal_daftar"]."-".$_POST["month"]."-".$_POST["year"] : $_POST["src_tanggal_daftar"];
				?>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tanggal Daftar</td>
                    <td width="5"></td>
                    <td><input type="text" name="src_tanggal_daftar" size="35"  value="<?PHP echo $src_tanggal_daftar; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <?PHP	
				$tingkat	= $_POST["tingkat"];		
				if(empty($_POST["jenjang"])) {
				
					if($tingkat == "Toddler") 	{ $jenjang = "Toddler"; }
					if($tingkat == "PG") 		{ $jenjang = "PG"; }
					if($tingkat == "TK A") 		{ $jenjang = "TK A"; }
					if($tingkat == "TK B") 		{ $jenjang = "TK B"; }				
					if($tingkat == "1" || $tingkat  == "2" || $tingkat  == "3" || $tingkat  == "4" || $tingkat  == "5" || $tingkat  == "6") { $jenjang = "SD"; }
					if($tingkat == "7" || $tingkat  == "8" || $tingkat  == "9") { $jenjang = "SMP"; }	
				
				} else {
					$jenjang	= $_POST["jenjang"];
				}			
				?>         
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Jenjang</td>
                    <td width="5"></td>
                    <td><input type="text" name="jenjang" size="35"  value="<?PHP echo $jenjang; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tingkat</td>
                    <td width="5"></td>
                    <td><input type="text" name="tingkat" size="35"  value="<?PHP echo $tingkat; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Periode</td>
                    <td width="5"></td>
                    <td><input type="text" name="periode" size="35"  value="<?PHP echo $_POST["periode"]; ?>" readonly="readonly"/></td>
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
                <?PHP
                $src_fase_1_date = (empty($_POST["src_fase_1_date"])) ? $_POST["fase_1_date"]."-".$_POST["fase_1_month"]."-".$_POST["fase_1_year"] : $_POST["src_fase_1_date"];
				?>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tahap I</td>
                    <td width="5"></td>
                    <td><input type="text" name="src_fase_1_date" size="35"  value="<?PHP echo $src_fase_1_date; ?>" readonly="readonly"/></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <?PHP
				$src_fase_2_date = (empty($_POST["src_fase_2_date"])) ? $_POST["fase_2_date"]."-".$_POST["fase_2_month"]."-".$_POST["fase_2_year"] : $_POST["src_fase_2_date"];
				?>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>
                    <td width="200" bgcolor="#999999" id="text_normal_white">Tahap II</td>
                    <td width="5"></td>
                    <td><input type="text" name="src_fase_2_date" size="35"  value="<?PHP echo $src_fase_2_date; ?>" readonly="readonly"/></td>
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
                    <td width="10" bgcolor="#333333"></td>
                  <td width="200" bgcolor="#333333" id="text_normal_white">Kategori administrasi</td>
                    <td width="5"></td>
                    <td>
                    <?PHP
					//when verification checkbox is checked, disc_cat_adm will be disabled
					//So it won't send enay data to page_reg_adm_siswa_redirect.php. As result variable disc_cat_adm will empty
					//Then, to send the disc_cat_adm value to the proc_reg_adm_siswa.php, we need to make another variable that receive $_POST["disc_cat_adm"]
					$final_disc_cat_adm = (empty($_POST["disc_cat_adm"])) ? '' : $_POST["disc_cat_adm"];										
					?>
                    <input type="hidden" name="final_disc_cat_adm" value="<?PHP echo $final_disc_cat_adm; ?>" />
                    
                    <?PHP //we change the values into integer. We synchronize itu with the ajax's code. it's easier than you have to change the ajax codes ?>
                    <select name="disc_cat_adm" id="but_select" onchange='document.reg_adm_siswa.submit();'>
                    <option value="">pilih</option>
                    <option value="1" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "1") { ?> selected="selected"<?PHP }} ?>>Umum</option>
                    <option value="2" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "2") { ?> selected="selected"<?PHP }} ?>>Bersamaan dengan saudara kandung</option>
                    <option value="3" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "3") { ?> selected="selected"<?PHP }} ?>>Memiliki saudara kandung</option>
                    <option value="4" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "4") { ?> selected="selected"<?PHP }} ?>>Umum grade B</option>
                    <option value="5" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "5") { ?> selected="selected"<?PHP }} ?>>Umum memiliki saudara kandung di SMP + grade B</option>
                    <option value="6" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "6") { ?> selected="selected"<?PHP }} ?>>Asal Darbi</option>
                    <option value="7" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "7") { ?> selected="selected"<?PHP }} ?>>Asal Darbi + Grade A</option>
                    <option value="8" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "8") { ?> selected="selected"<?PHP }} ?>>Asal Darbi + Grade B</option>
                    <option value="9" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "9") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-1</option>
                    <option value="10" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "10") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-2</option>
                    <option value="11" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "11") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-3, dst</option>
                    <option value="12" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "12") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-1 + Grade A</option>
                    <option value="13" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "13") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-1 + Grade B</option>
                    <option value="14" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "14") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-2 + Grade A</option>
                    <option value="15" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "15") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-2 + Grade B</option>
                    <option value="16" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "16") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-3, dst + Grade A</option>
                    <option value="17" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "17") { ?> selected="selected"<?PHP }} ?>>Anak pegawai ke-3, dst + Grade B</option>
                    <option value="18" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "18") { ?> selected="selected"<?PHP }} ?>>Siswa pindahan ke Toddler semester II</option>
                    <option value="19" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "19") { ?> selected="selected"<?PHP }} ?>>Siswa pindahan ke PG/TK A/TK B Semester II</option>
                    <option value="20" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "20") { ?> selected="selected"<?PHP }} ?>>Siswa pindahan ke SD 3-4</option>
                    <option value="21" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "21") { ?> selected="selected"<?PHP }} ?>>Siswa pindahan ke SD 5-6</option>
                    <option value="22" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "22") { ?> selected="selected"<?PHP }} ?>>Siswa pindahan ke SMP 8</option>
                    <option value="23" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "23") { ?> selected="selected"<?PHP }} ?>>Siswa pindahan ke SMP 9</option>
                    </select>                    
                    </td>
                </tr>
                <tr>
                    <td colspan="4" height="5"></td>
                </tr>
            </table>
            <a name="pulang_kampung"></a>          
            <table border="0" cellpadding="0" cellspacing="0">            	
                <tr height="20">
                    <td width="100" id="text_normal_black"><b>Biaya Masuk</b></td>
                    <td width="10"></td>
                    <td><a title="Show Table #1a" href="javascript:toggleDisplay('1')" id="tableHref1"><img border="0" src="images/plus.png" id="imagePM1"></a></td>
                </tr>
            </table>
            <div style="display:none;" id="table1">
            <?PHP 
			//this will include page include/disc_cat_adm_dd_menu.php
			//All needed variables declared by GET method on javascript below this page, getList function
			
			if(empty($_POST["disc_cat_adm"])) {
			?>
			<span id="text_normal_black">Data discount administrasi akan ditampilkan setelah anda memilih kategori administrasi</span>	
            <?PHP
			} else {
			
				$periode		= htmlspecialchars($_POST["periode"]);
				//Actually, tk/sd/smp has to be written in capital from "page_reg_adm_siswa.php".
				//But, i dont know why, in page_cat_adm_bi_ma_setting.php file, those values are set in lower case...hehehhee... inconsitant work.. :D
				//So, now we make it lower, because we will work on set_cat_adm_bi_ma table (owned by page_cat_adm_bi_ma_setting.php)
				//here we go buddy
				if(htmlspecialchars($_POST["jenjang"]) == "Toddler") {
					$level	= "tod";
				} else if (htmlspecialchars($_POST["jenjang"]) == "PG") {
					$level	= "pgx";
				} else if (htmlspecialchars($_POST["jenjang"]) == "TK A") { 
					$level	= "tka";
				} else if (htmlspecialchars($_POST["jenjang"]) == "TK B") {
					$level	= "tkb";
				} else if (htmlspecialchars($_POST["jenjang"]) == "SD") {
					$level	= "sdx";
				} else if (htmlspecialchars($_POST["jenjang"]) == "SMP") {
					//make it lower hahahahhaha
					$level	= "smp";
				}
				
				if($_POST["disc_cat_adm"] == 1) { $q = "umum"; }
				if($_POST["disc_cat_adm"] == 2) { $q = "berdesaukan"; }
				if($_POST["disc_cat_adm"] == 3) { $q = "memsaukan"; }
				if($_POST["disc_cat_adm"] == 4) { $q = "umgrab"; }
				if($_POST["disc_cat_adm"] == 5) { $q = "umsksmpgrab"; }
				if($_POST["disc_cat_adm"] == 6) { $q = "asdar"; } 
				if($_POST["disc_cat_adm"] == 7) { $q = "asdargraa"; }
				if($_POST["disc_cat_adm"] == 8) { $q = "asdargrab"; }
				if($_POST["disc_cat_adm"] == 9) { $q = "anpeg1"; }
				if($_POST["disc_cat_adm"] == 10) { $q = "anpeg2"; }
				if($_POST["disc_cat_adm"] == 11) { $q = "anpeg3"; }
				if($_POST["disc_cat_adm"] == 12) { $q = "anpeg1graa"; }
				if($_POST["disc_cat_adm"] == 13) { $q = "anpeg1grab"; }
				if($_POST["disc_cat_adm"] == 14) { $q = "anpeg2graa"; }
				if($_POST["disc_cat_adm"] == 15) { $q = "anpeg2grab"; }
				if($_POST["disc_cat_adm"] == 16) { $q = "anpeg3graa"; }
				if($_POST["disc_cat_adm"] == 17) { $q = "anpeg3grab"; } 
				if($_POST["disc_cat_adm"] == 18) { $q = "pintodsem2"; }
				if($_POST["disc_cat_adm"] == 19) { $q = "pinpgtksem2"; }
				if($_POST["disc_cat_adm"] == 20) { $q = "pinsd34"; }
				if($_POST["disc_cat_adm"] == 21) { $q = "pinsd56"; } 
				if($_POST["disc_cat_adm"] == 22) { $q = "pinsmp8"; }
				if($_POST["disc_cat_adm"] == 23) { $q = "pinsmp9"; }
				
				$periode_enc		= mysql_real_escape_string($periode);
				$level_enc			= mysql_real_escape_string($level);
				$set_cat_adm_enc	= mysql_real_escape_string($q); //actually this last one is no need to be escaped, right? because u have defined it above
				
				$src_select_disc_adm	= "select * from set_cat_adm_bi_ma where periode = '$periode_enc' and jenjang = '$level_enc' and set_cat_adm = '$set_cat_adm_enc'";
				$query_select_disc_adm	= mysqli_query($mysql_connect, $src_select_disc_adm) or die ("There is an error with mysql: ".mysql_error());
				$num_select_disc_adm	= mysql_num_rows($query_select_disc_adm);
				
				
				if($num_select_disc_adm != 0) { 
				?>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="10"></td>
						<td width="200"></td>
						<td width="5"></td>
						<td></td>
					</tr>
				<?PHP
					while($get_select_disc_adm	= mysql_fetch_array($query_select_disc_adm)) {
					
						if($get_select_disc_adm["cat_adm"] == "penga") {
						?>
							<tr height="20">
								<td bgcolor="#999999" ></td>
								<td align="left" bgcolor="#999999" id="text_normal_white">Pengembangan</td>
								<td></td>
								<td id="text_normal_black"><input type="text" name="pengembangan" size="35" readonly="readonly" value="<?PHP $cur_total_nominal = $get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
							</tr>
						<?PHP
						}
						if($get_select_disc_adm["cat_adm"] == "kegia") {
						?>
							<tr>
								<td colspan="4" height="5"></td>
							</tr>
							<tr height="20">
								<td bgcolor="#999999"></td>
								<td align="left" bgcolor="#999999" id="text_normal_white">Kegiatan</td>
								<td></td>
								<td id="text_normal_black"><input type="text" name="kegiatan" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
							</tr>
						<?PHP
						}
						if($get_select_disc_adm["cat_adm"] == "peral") {
						?>
						<tr>
							<td colspan="4" height="5"></td>
						</tr>
						<tr height="20">
							<td bgcolor="#999999" ></td>
							<td align="left" bgcolor="#999999"  id="text_normal_white">Peralatan</td>
							<td></td>
							<td id="text_normal_black"><input type="text" name="peralatan" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
						</tr>
						<?PHP
						}
						if($get_select_disc_adm["cat_adm"] == "serag") {
						?>
						<tr>
							<td colspan="4" height="5"></td>
						</tr>
						<tr height="20">
							<td bgcolor="#999999" ></td>
							<td align="left" bgcolor="#999999" id="text_normal_white">Seragam</td>
							<td></td>
							<td id="text_normal_black"><input type="text" name="seragam" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
						</tr>
						<?PHP
						}
						if($get_select_disc_adm["cat_adm"] == "paket") {
						?>
						<tr>
							<td colspan="4" height="5"></td>
						</tr>
						<tr height="20">
							<td bgcolor="#999999" ></td>
							<td align="left" bgcolor="#999999" id="text_normal_white">Paket</td>
							<td></td>
							<td id="text_normal_black"><input type="text" name="paket" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
						</tr>
                        <input type="hidden" name="sub_total_bima" value="<?PHP echo $cur_total_nominal; ?>" />
						<tr>
							<td colspan="4" height="5"></td>
						</tr>
						<tr height="20">
							<td bgcolor="#999999" ></td>
							<td align="left" bgcolor="#999999" id="text_normal_white">Sub Total</td>
							<td></td>
							<td id="text_normal_black"><input type="text" size="35" value="Rp. <?PHP echo $cur_total_nominal; ?>" style="font-weight:bold; color:#ff0000;"/></td>
						</tr>
					<?PHP
						}
					}
					?>
              </table>
                    <?PHP
					
				} else {
					$the_lev = (empty($_GET["lev"])) ? '' : $_GET["lev"];

					echo "<span id=\"text_normal_black\"><i>Data discount administrasi untuk level ".$the_lev." tahun ajaran $periode belum dibuat. Silahkan hubungi Administrator Keuangan</span></i>";
				}
			}
			?>		
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
			$periode_enc 	= mysql_real_escape_string($_POST["periode"]); 
			$level_enc		= mysql_real_escape_string($jenjang);
			
			//This  synchronization is base on page "page_reg_adm_siswa.php" and the column names on table "set_spp"
			//For SD and SMP we only need to define with the first character of value of variable "kelas"
			/*if($level_enc == "Toddler") 	{ $jenjang = "1"; }
			else if($level_enc == "PG") 	{ $jenjang = "1"; }
			else if($level_enc == "TK A") 	{ $jenjang = "2"; }
			else if($level_enc == "TK B") 	{ $jenjang = "3"; }
			else if($level_enc == "SD") 	{ $jenjang = substr($kelas_enc,0,1); }
			else if($level_enc == "SMP") 	{ $jenjang = substr($kelas_enc,0,1); } */
			
			//For the explanation of page pengaturan nominal SPP (keterangan discount), decided by two conditions
			//If status_anak is = Anak guru, the discount is anak guru
			//If status_anak is = Anak umum/bukan anak guru, the discount based on the registation year.
			//For the registration year, we only need the 2 lastest character each.
			//For example. 2011-2012, we only use 1112.
			//So here it is
			
			//************************************************************
			
			//About the conversion from 'anak guru' to kategori 1, you can find why it should be like that in page_spp_sd_setting
			if(strtolower($_POST["kat_status_anak"]) == "umum") 		{ $ket_disc = substr($periode_enc,-9,2).substr($periode_enc,-2,2); }
			if(strtolower($_POST["kat_status_anak"]) == "kategori 1")	{ $ket_disc = "angu"; }
			if(strtolower($_POST["kat_status_anak"]) == "kategori 2")	{ $ket_disc = "dis1"; }
			if(strtolower($_POST["kat_status_anak"]) == "kategori 3")	{ $ket_disc = "dis2"; }
			if(strtolower($_POST["kat_status_anak"]) == "kategori 4")	{ $ket_disc = "dis3"; }
			
			//Jenjang in table set_spp writen in lower case and without space, so make it
			if($jenjang	== "Toddler") 	{ $jenjang_lower	= "toddler"; }
			if($jenjang	== "PG") 		{ $jenjang_lower	= "pg"; }
			if($jenjang	== "TK A") 		{ $jenjang_lower	= "tka"; }
			if($jenjang	== "TK B")	 	{ $jenjang_lower	= "tkb"; }
			if($jenjang	== "SD") 		{ $jenjang_lower	= "sd"; }
			if($jenjang	== "SMP") 		{ $jenjang_lower	= "smp"; }
			
			//And so the tingkat
			if($tingkat	== "Toddler") 	{ $tingkat_lower	= "toddler"; }
			if($tingkat	== "PG") 		{ $tingkat_lower	= "pg"; }
			if($tingkat	== "TK A") 		{ $tingkat_lower	= "tka"; }
			if($tingkat	== "TK B") 		{ $tingkat_lower	= "tkb"; }
			if($tingkat	== "1") 		{ $tingkat_lower	= "1"; }
			if($tingkat	== "2") 		{ $tingkat_lower	= "2"; }
			if($tingkat	== "3") 		{ $tingkat_lower	= "3"; }
			if($tingkat	== "4") 		{ $tingkat_lower	= "4"; }
			if($tingkat	== "5") 		{ $tingkat_lower	= "5"; }
			if($tingkat	== "6") 		{ $tingkat_lower	= "6"; }
			if($tingkat	== "7") 		{ $tingkat_lower	= "7"; }
			if($tingkat	== "8") 		{ $tingkat_lower	= "8"; }
			if($tingkat	== "9") 		{ $tingkat_lower	= "9"; }
			
			$src_get_spp	= "select * from set_spp where periode = '$periode_enc' and jenjang = '$jenjang_lower' and tingkat = '$tingkat_lower' and ket_disc = '$ket_disc'";
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
				echo "<span id=\"text_normal_black\"><i>Data discount SPP dan KS untuk level $level_enc tahun ajaran $periode_enc belum dibuat. Silahkan hubungi Administrator Keuangan</i></span>";
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
                    <td align="left" id="text_normal_black"><input type="text" name="zakat_mal" size="35" <?PHP if(!empty($_POST["zakat_mal"])) { echo "value=".$_POST["zakat_mal"].""; }  ?> onkeypress="return checkIt(event)" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Zakat profesi</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="zakat_profesi" size="35" <?PHP if(!empty($_POST["zakat_profesi"])) { echo "value=".$_POST["zakat_profesi"].""; }  ?>  onkeypress="return checkIt(event)" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Infaq/shodaqoh</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="infaq_shodaqoh" size="35" <?PHP if(!empty($_POST["infaq_shodaqoh"])) { echo "value=".$_POST["infaq_shodaqoh"].""; }  ?>   onkeypress="return checkIt(event)" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Wakaf</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="wakaf" size="35" <?PHP if(!empty($_POST["wakaf"])) { echo "value=".$_POST["wakaf"].""; }  ?>   onkeypress="return checkIt(event)" /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
                <tr height="20">
                    <td width="10" bgcolor="#999999"></td>
                    <td width="200" align="left" bgcolor="#999999" id="text_normal_white">Lain-lain</td>
                    <td width="5" align="center"></td>
                    <td align="left" id="text_normal_black"><input type="text" name="lain_lain" size="35" <?PHP if(!empty($_POST["lain_lain"])) { echo "value=".$_POST["lain_lain"].""; }  ?>   onkeypress="return checkIt(event)"  /></td>
                </tr>
                <tr>
                	<td colspan="4" height="5"></td>
                </tr>
            </table>             
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
            <hr noshade="noshade" size="1" color="#666666" />
            <?PHP
			/*user has to define whether he/she has finished to complete the form or still want to update the form by clicking the goprocess checkox */
			?>
            <script type="text/javascript" language="javascript">
			<!--
			
			/*We have to make the submit button disable automatically
			when the page loaded.
			*/
			function happycode(){
			   document.reg_adm_siswa.but_submit.disabled = true;
			   document.reg_adm_siswa.but_select.disabled = false;
			}
			
			window.onload=happycode ;
			
			/*Then the submit button turn to be enabled when the check button checked
			and it turn to be disabled again when the check button unchecked
			*/
			function toggleSelect() {
			
				if (document.getElementById("chk1").checked == false) {
					document.reg_adm_siswa.but_submit.disabled = true;
					document.reg_adm_siswa.but_select.disabled = false;
				} else {
					document.getElementById("but_submit").disabled = false;
					document.getElementById("but_select").disabled = true;
				}			
			}
			-->
			</script>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td id="text_normal_black"><input type="checkbox" name="doprocess" id="chk1" onchange="javascript:toggleSelect();" /> klik, jika anda yakin seluruh data di atas sudah benar</td>
                </tr>
            	<tr>
                	<td height="20"><input type="submit" value="submit" id="but_submit" name="but_submit" style="width:250px;" onClick="return verification()" /></td>
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


<script type="text/javascript"> /*
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
xmlhttp.open("GET","include/disc_cat_adm_dd_menu.php?q="+str+"&per=<?PHP /*echo $_POST["periode"]; ?>&lev=<?PHP echo $_POST["jenjang"]; */ ?>",true);
xmlhttp.send();
} */
</script>

<?PHP
} else {	
	
	header("location:index.php");
		
}
?>

<SCRIPT type="text/javascript">
function verification() 
{ 
	if(document.reg_adm_siswa.disc_cat_adm.value == "") {
		alert('Silahkan pilih salah satu tipe kategori administrasi');
		return false;
	} 
		
	/*-----*/
	
	if(isNaN(document.reg_adm_siswa.zakat_mal.value) == true) {
		alert('Field "Zakat mal" hanya dapat diisi dengan angka');
		return false;
	}
	
	if(isNaN(document.reg_adm_siswa.zakat_profesi.value) == true) {
		alert('Field "Zakat profesi" hanya boleh diisi dengan angka');
		return false;
	}
	
	if(isNaN(document.reg_adm_siswa.infaq_shodaqoh.value) == true) {
		alert('Field "Infaq shodaqoh" hanya boleh diisi dengan angka');
		return false;
	}
	
	if(isNaN(document.reg_adm_siswa.wakaf.value) == true) {
		alert('Field "Wakaf" hanya boleh diisi dengan angka');
		return false;
	}
	
	if(isNaN(document.reg_adm_siswa.lain_lain.value) == true) {
		alert('Field "Lain-lain" hanya boleh diisi dengan angka');
		return false;
	}
return true;	
}
</SCRIPT>

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