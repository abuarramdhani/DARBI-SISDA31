<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	if(empty($_POST["doprocess"])) {
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
        	<?PHP // <form method="post" name="reg_adm_siswa" action="engine.php?case=reg_adm_siswa"> ?>
			<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_adm_siswa_next">             
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
                    <td width="200" bgcolor="#999999" id="text_normal_white">Nama ayah / bunda / ststus</td>
                    <td width="5"></td>
                    <td><input type="text" name="nama_ayah"  size="35" value="<?PHP echo $_POST["nama_ayah"]; ?>" readonly="readonly"/> / <input type="text" name="nama_bunda" size="35" value="<?PHP echo $_POST["nama_bunda"]; ?>" readonly="readonly"/> / <input type="text" name="kat_status_anak" size="35" value="<?PHP echo ucwords($_POST["kat_status_anak"]); ?>" readonly="readonly"/></td>
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
				$src_tanggal_daftar = (empty($_POST["src_tanggal_daftar"])) ? $_POST["tanggal_daftar"]." - ".$_POST["month"]." - ".$_POST["year"] : $_POST["src_tanggal_daftar"];
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
                <?PHP
                $src_fase_1_date = (empty($_POST["src_fase_1_date"])) ? $_POST["fase_1_date"]." - ".$_POST["fase_1_month"]." - ".$_POST["fase_1_year"] : $_POST["src_fase_1_date"];
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
				$src_fase_2_date = (empty($_POST["src_fase_2_date"])) ? $_POST["fase_2_date"]." - ".$_POST["fase_2_month"]." - ".$_POST["fase_2_year"] : $_POST["src_fase_2_date"];
				?>
                <tr height="20">
                	<td width="10" bgcolor="#999999"></td>.
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
                    <select name="disc_cat_adm" onchange='document.reg_adm_siswa.submit();'>
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
                    <option value="23" <?PHP if(!empty($_POST["disc_cat_adm"])) { if($_POST["disc_cat_adm"] == "22") { ?> selected="selected"<?PHP }} ?>>Siswa pindahan ke SMP 9</option>
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
			
			if(empty($_POST["disc_cat_adm"])) {
			?>
			<span id="text_normal_black">Data discount administrasi akan ditampilkan setelah anda memilih kategori administrasi</span>	
            <?PHP
			} else {
			
				$periode		= htmlspecialchars($_POST["period"]);
				//Actually, tk/sd/smp has to be written in capital from "page_reg_adm_siswa.php".
				//But, i dont know why, in page_cat_adm_bi_ma_setting.php file, those values are set in lower case...hehehhee... inconsitant work.. :D
				//So, now we make it lower, because we will work on set_cat_adm_bi_ma table (owned by page_cat_adm_bi_ma_setting.php)
				//here we go buddy
				if(htmlspecialchars($_POST["jenjang"]) == "Toddler" || htmlspecialchars($_POST["jenjang"]) == "PG" || htmlspecialchars($_POST["jenjang"]) == "TK A" || htmlspecialchars($_POST["jenjang"]) == "TK B") {
					$level	= "tkx";
				} else if(htmlspecialchars($_POST["jenjang"]) == "SD") {
					$level	= "sdx";
				} else if(htmlspecialchars($_POST["jenjang"]) == "SMP") {
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
				
				$src_select_disc_adm	= "select * from set_cat_adm_bi_ma where periode = '$periode_enc' and level = '$level_enc' and set_cat_adm = '$set_cat_adm_enc'";
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
						<tr>
							<td colspan="4" height="5"></td>
						</tr>
						<tr height="20">
							<td bgcolor="#999999" ></td>
							<td align="left" bgcolor="#999999" id="text_normal_white">Sub Total</td>
							<td></td>
							<td id="text_normal_black"><input type="text" readonly="readonly" size="35" value="Rp. <?PHP echo $cur_total_nominal; ?>" style="font-weight:bold; color:#ff0000;"/></td>
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
			
			//For the explanation of page pengaturan nominal SPP (keterangan discount), decided by two conditions
			//If status_anak is = Anak guru, the discount is anak guru
			//If status_anak is = Anak umum/bukan anak guru, the discount based on the registation year.
			//For the registration year, we only need the 2 lastest character each.
			//For example. 2011-2012, we only use 1112.
			//So here it is
			
			if(strtolower($_POST["kat_status_anak"]) == "umum") 		{ $ket_disc = substr($periode_enc,-9,2).substr($periode_enc,-2,2); }
			if(strtolower($_POST["kat_status_anak"]) == "anak pegawai")	{ $ket_disc = "angu"; } 
			 
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
            <script type="text/javascript" language="javascript">
			<!--
			
			/*We have to make the submit button disable automatically
			when the page loaded.
			*/
			function happycode(){
			   document.reg_adm_siswa.but_submit.disabled = true;
			}
			
			window.onload=happycode ;
			
			/*Then the submit button turn to be enabled when the check button checked
			and it turn to be disabled again when the check button unchecked
			*/
			function toggleSelect() {
			
				if (document.getElementById("chk1").checked == false) {
					document.reg_adm_siswa.but_submit.disabled = true;
				} else {
					document.getElementById("but_submit").disabled = false;
				}			
			}
			-->
			</script>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                	<td id="text_normal_black"><input type="checkbox" name="doprocess" id="chk1" onchange="javascript:toggleSelect();" /> klik, jika anda yakin seluruh data di atas sudah benar</td>
                </tr>
            	<tr>
                	<td height="20"><input type="submit" value="submit" id="but_submit" name="but_submit" style="width:250px;" /></td>
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
	} else {	
	
		//here they are the variable
		//========
		//========
		//These are the student's data
		$nama_siswa			= htmlspecialchars($_POST["nama_siswa"]);
		$nama_ayah			= htmlspecialchars($_POST["nama_ayah"]);
		$nama_bunda			= htmlspecialchars($_POST["nama_bunda"]);
		$kat_status_anak	= htmlspecialchars($_POST["kat_status_anak"]);
		$telp_ayah			= htmlspecialchars($_POST["telp_ayah"]);
		$telp_bunda			= htmlspecialchars($_POST["telp_bunda"]);
		$nama_sekolah_asal	= htmlspecialchars($_POST["nama_sekolah_asal"]);
		$stat_sekolah_asal	= htmlspecialchars($_POST["stat_sekolah_asal"]);
		$tanggal_daftar		= htmlspecialchars($_POST["src_tanggal_daftar"]);
		$jenjang			= htmlspecialchars($_POST["jenjang"]);
		$kelas				= htmlspecialchars($_POST["kelas"]);
		$period				= htmlspecialchars($_POST["period"]);
		$shift_test			= htmlspecialchars($_POST["shift_test"]);
		$fase_1_date		= htmlspecialchars($_POST["src_fase_1_date"]);
		$fase_2_date		= htmlspecialchars($_POST["src_fase_2_date"]);
		
		$enc_nama_siswa			= mysql_real_escape_string($nama_siswa);
		$enc_nama_ayah			= mysql_real_escape_string($nama_ayah);
		$enc_nama_bunda			= mysql_real_escape_string($nama_bunda);
		$enc_kat_status_anak	= mysql_real_escape_string($kat_status_anak);
		$enc_telp_ayah			= mysql_real_escape_string($telp_ayah);
		$enc_telp_bunda			= mysql_real_escape_string($telp_bunda);
		$enc_nama_sekolah_asal	= mysql_real_escape_string($nama_sekolah_asal);
		$enc_stat_sekolah_asal	= mysql_real_escape_string($stat_sekolah_asal);
		$enc_tanggal_daftar		= mysql_real_escape_string($tanggal_daftar);
		$enc_jenjang			= mysql_real_escape_string($jenjang);
		$enc_kelas				= mysql_real_escape_string($kelas);
		$enc_period				= mysql_real_escape_string($period);
		$enc_shift_test			= mysql_real_escape_string($shift_test);
		$enc_fase_1_date		= mysql_real_escape_string($fase_1_date);
		$enc_fase_2_date		= mysql_real_escape_string($fase_2_date);
		
		//these are the discount category's data
		$action = (empty($_POST['action'])) ? 'default' : $_POST['action'];

		$disc_cat_adm	= (empty($_POST["disc_cat_adm"])) ? '' : htmlspecialchars($_POST["disc_cat_adm"]);
		$pengembangan	= (empty($_POST["pengembangan"])) ? '' : htmlspecialchars($_POST["pengembangan"]);
		$kegiatan		= (empty($_POST["kegiatan"])) ? '' : htmlspecialchars($_POST["kegiatan"]);
		$peralatan		= (empty($_POST["peralatan"])) ? '' : htmlspecialchars($_POST["peralatan"]);
		$kegiatan		= (empty($_POST["kegiatan"])) ? '' : htmlspecialchars($_POST["kegiatan"]);
		$seragam		= (empty($_POST["seragam"])) ? '' : htmlspecialchars($_POST["seragam"]);
		$paket			= (empty($_POST["paket"])) ? '' : htmlspecialchars($_POST["paket"]);
		
		//These ara the SPP's data
		$spp			= (empty($_POST["spp"])) ? '' : htmlspecialchars($_POST["spp"]);
		$ks				= (empty($_POST["ks"])) ? '' : htmlspecialchars($_POST["ks"]);
		
		//These are the rumah berbagi's data
		$zakat_mal		= htmlspecialchars($_POST["zakat_mal"]);
		$zakat_profesi	= htmlspecialchars($_POST["zakat_profesi"]);
		$infaq_shodaqoh	= htmlspecialchars($_POST["infaq_shodaqoh"]);
		$wakaf			= htmlspecialchars($_POST["wakaf"]);
		$lain_lain		= htmlspecialchars($_POST["lain_lain"]);
		
		//Firstly,...
		//All of this data is depend on NO SISDA, which can be taken from table siswa. Note that the every student will have a unique NO SISDA which is generated automatically 
		//every registration data has been added into database. 
		//we will have two conditions with this registration process, thet are:
		//1. Registration for new student, it means that we have to generate new unique NO SISDA for them. how to do that? get the last NO SISDA from DB, add it with 1, 
		//   that is the new SISDA for new student.
		//2. Reregistration for old student that will get into the next level, we can use the existing NO SISDA, that taken from their data in DB.
		
		/*get current NO SISDA*/
		//look at the + 0 in below query. it's used to convert string data to integer, because the original data type of NO SISDA is string , 
		//but we only can select the max value of NO SISDA serial number(last 5 digits) in integer type. dont porgetgetget about it baby(but when i check in db, is already integer hehehe)....
		//$src_get_no_sisda	= "select no_sisda, MAX(SUBSTRING(no_sisda,5) + 0) from siswa";
		$src_get_no_sisda	= "select MAX(SUBSTRING(no_sisda from 5 for 5)) as cur_no_sisda from siswa"; 
		$query_get_no_sisda	= mysqli_query($mysql_connect, $src_get_no_sisda);
		$no_sisda_row		= mysql_fetch_array($query_get_no_sisda);
		
		//add 1 to the last no_sisda.
		//it's become current no_sisda.
		$last_no_sisda	= $no_sisda_row["cur_no_sisda"]+1;
		
		//we have problem with the 4 zeroes from the serial number, ex: 00001,00012,00356,06478
		//Check how many 'zore' that we have to add next to the last value
		$lenght_no_sisda 	= 5-(strlen($last_no_sisda)); 
		if($lenght_no_sisda == 4) { $add_digit = "0000"; }
		else if($lenght_no_sisda == 3) { $add_digit = "000"; }
		else if($lenght_no_sisda == 2) { $add_digit = "00"; }
		else if($lenght_no_sisda == 1) { $add_digit = "0"; }
		
		//We need current year
		$cur_year	= date("Y");
		
		//And here is the last no_sisda for the last student
		$cur_no_sisda	= $cur_year.$add_digit.$last_no_sisda;
		
		//We have to seperate, between basic student data and finance data
		//why is that? because the table of them is different.
		//The steps are: insert the basic data first, then the finance data
		///////////////////////////////////////////////////////////////////		
		
		//here we go again baby,....
		//lets insert the student data first
		$src_insert_user	= "insert into siswa (
								
								no_sisda,
								nama_murid,
								nama_ayah,
								nama_bunda,
								kat_status_anak,
								telp_ayah,
								telp_bunda,
								asal_sekolah,								
								tanggal_daftar,
								jenjang,
								gelombang_test,
								tahap1,
								tahap2
								
								) values (
								
								'$cur_no_sisda',
								'$enc_nama_siswa',
								'$enc_nama_ayah',
								'$enc_nama_bunda',
								'$enc_kat_status_anak',
								'$enc_telp_ayah',
								'$enc_telp_bunda',
								'$enc_nama_sekolah_asal',
								'$enc_tanggal_daftar',
								'$enc_jenjang',
								'$enc_shift_test',
								'$enc_fase_1_date',
								'$enc_fase_2_date'								
								
								)";
		$query_insert_user	= mysqli_query($mysql_connect, $src_insert_user) or die ("There is an error with mysql: ".mysql_error());
		
		if($query_insert_user) {
			//---------------------------------------
			//here are variables that used in prog_log.php
			include_once("include/url.php");
			$activity	= "Add registrasi administasi siswa";
			$url		= curPageURL();
			$id			= $_SESSION["id"];
			$need_log	= true;
			include_once("include/log.php");
			//---------------------------------------
			
			$redirect_path	= "";
			$redirect_icon	= "images/icon_true.png";
			$redirect_url	= "http://localhost/sisda-v3/mainpage.php?pl=reg_adm_siswa";
			$redirect_text	= "User <b>".ucwords($name)."</b>, sudah didaftarkan";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
			
		}
	}
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
xmlhttp.open("GET","include/disc_cat_adm_dd_menu.php?q="+str+"&per=<?PHP /*echo $_POST["period"]; ?>&lev=<?PHP echo $_POST["jenjang"]; */ ?>",true);
xmlhttp.send();
} */
</script>