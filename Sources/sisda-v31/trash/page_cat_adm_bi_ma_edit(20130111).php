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
            <td id="text_title_page1" align="center"><h2 style="padding:0px;">Kategori Administrasi Biaya Masuk</td>
            <td width="30"></td>
        </tr>
        <tr>
            <td></td>
            <td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
            <td></td>
        </tr>
        <tr>        
            <td colspan="3" height="20"></td>
        </tr>
    </table>
    <?PHP
	$the_periode	= htmlspecialchars($_GET["per"]);
	
	$the_periode_enc	= mysql_real_escape_string($the_periode);
	
	$src_get_cat_adm_bi_ma		= "select * from set_cat_adm_bi_ma where periode = '$the_periode_enc'";
	$query_get_cat_adm_bi_ma	= mysqli_query($mysql_connect, $src_get_cat_adm_bi_ma) or die("There is an error with mysql: ".mysql_error());
	?>
    <form method="post" name="set_cat_adm_bi_ma" action="engine.php?case=cat_adm_bi_ma_edit">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="10">Tahun pelajaran: <input type="text" size="10" readonly="readonly" name="period" value="<?PHP echo $the_periode; ?>" /><input type="hidden" name="level" value="sd" /></td>
                    </tr>
                    <?PHP
					//you may say that these are the craziest variable names that you ever found in this earth.
					//What sould i say,.... i cant make it easier to write down.
					//I bet that kamal, is making a LOL now.......
					/*
					umum			= Umum
					berdesaukan		= Bersamaan dengan saudara kandung
					memsaukan		= Memiliki Saudara Kandung
					umgrab			= Umum Grade B
					umsksmp-grab		= Umum memiliki Saudara Kandung di smp- + Grade B
					asdar			= Asal Darbi
					asdargraa		= Asal Darbi + Grade A
					asdargrab		= Asal Darbi + Grade B
					anpeg1			= Anak Pegawai ke-1
					anpeg2			= Anak Pegawai ke-2
					anpeg3			= Anak Pegawai ke-3, dst
					anpeg1graa		= Anak Pegawai ke-1 + Grade A 	
					anpeg1grab		= Anak Pegawai ke-1 + Grade B 	
					anpeg2graa		= Anak Pegawai ke-2 + Grade A
					anpeg2grab		= Anak Pegawai ke-2 + Grade B
					anpeg3graa		= Anak Pegawai ke-3, dst + Grade A
					anpeg3grab		= Anak Pegawai ke-3, dst + Grade B
					pintodsem2		= Siswa pindahan ke toddler semester II
					pinpgtksem2		= Siswa pindahan ke PG/TK A/TK B semester II
					pinsd34			= Siswa pindahan ke SD 3-4
					pinsd56			= Siswa pindahan ke SD 5-6
					pinsmp-8			= Siswa pindahan ke smp- 8
					pinsmp-9			= Siswa pindahan ke smp- 9
					
					tkx--penge		= TK Pengembangan
					tkx--kegia		= TK Kegiatan
					tkx--peral		= TK Peralatan
					tkx--serag		= TK Seragam
					tkx--paket		= TK Paket
					sdx--penga		= SD Pengembangan
					sdx--serag		= SD Seragam
					smp--penga		= smp- Pengembangan
					smp--serag		= smp- Seragam
					*/
					?>
                    <tr height="25" bgcolor="#333333" id="text_normal_white">
                        <td rowspan="2">Kategori Administrasi</td>
                        <td colspan="5">TK</td>
                        <td colspan="2">SD</td>
                        <td colspan="2">smp-</td>
                    </tr>
                    <tr height="25" bgcolor="#333333" id="text_normal_white">
                        <td width="9%">Pengembangan</td>
                        <td width="9%">Kegiatan</td>
                        <td width="9%">Peralatan</td>
                        <td width="9%">Seragam</td>
                        <td width="9%">Paket</td>
                        <td width="9%">Pengembangan</td>
                        <td width="9%">Seragam</td>
                        <td width="9%">Pengembangan</td>
                        <td width="9%">Seragam</td>
                    </tr>
                    <?PHP
                    while($row_get_cat_adm_bi_ma	= mysql_fetch_array($query_get_cat_adm_bi_ma)) {
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "umum") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                            <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                                <td>Umum</td>
                        		<td><input type="text" name="tod_penga_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                           	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="smp_serag_umum" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
							</tr>
							<?PHP
                            }
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "berdesaukan") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                            <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                                <td>Bersamaan dengan saudara kandung</td>
                        		<td><input type="text" name="tod_penga_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="smp_serag_berdesaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "memsaukan") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                            <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                            	<td>Memiliki Saudara Kandung</td>
                        		<td><input type="text" name="tod_penga_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="smp_serag_memsaukan" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "umgrab") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                            <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                            	<td>Umum Grade B</td>
                        		<td><input type="text" name="tod_penga_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="smp_serag_umgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "umsksmpgrab") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        	<tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                            	<td>Umum memiliki Saudara Kandung di smp_ + Grade B</td>	
                                <td><input type="text" name="tod_penga_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}						
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="smp_serag_umsksmpgrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "asdar") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                            <tr height="45" bgcolor="#718b88" id="text_normal_white">
                            <td>Asal Darbi</td>
                        		<td><input type="text" name="tod_penga_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="smp_serag_asdar" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr> 
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "asdargraa") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        	<tr height="45" bgcolor="#718b88" id="text_normal_white">                    	
                        		<td>Asal Darbi + Grade A</td>	
                                <td><input type="text" name="tod_penga_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="smp_serag_asdargraa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "asdargrab") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        	<tr height="45" bgcolor="#718b88" id="text_normal_white">
                        		<td>Asal Darbi + Grade B</td>	
                                <td><input type="text" name="tod_penga_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="pgx_penga_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="pgx_kegia_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="pgx_peral_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="pgx_serag_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="pgx_paket_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tka_penga_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tka_kegia_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tka_peral_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tka_serag_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tka_paket_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="tkb_penga_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>
                        		<td><input type="text" name="tkb_kegia_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>
                        		<td><input type="text" name="tkb_peral_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="tkb_serag_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>
                        		<td><input type="text" name="tkb_paket_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>    
                        		<td><input type="text" name="sdx_penga_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>    
                        		<td><input type="text" name="sdx_serag_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?> 
                        		<td><input type="text" name="smp_penga_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>   
                        		<td><input type="text" name="smp_serag_asdargrab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg1") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        	<tr height="45" bgcolor="#617f90" id="text_normal_white">
                        		<td>Anak Pegawai ke-1</td>	
                                <td><input type="text" name="tod_penga_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?> 
                        		<td><input type="text" name="pgx_penga_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?> 
                        		<td><input type="text" name="pgx_kegia_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                        		<td><input type="text" name="pgx_serag_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>		
                                <td><input type="text" name="pgx_paket_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?> 
                        		<td><input type="text" name="tka_penga_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?> 
                        		<td><input type="text" name="tka_kegia_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                        		<td><input type="text" name="tka_serag_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>		
                                <td><input type="text" name="tka_paket_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?> 
                        		<td><input type="text" name="tkb_penga_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?> 
                        		<td><input type="text" name="tkb_kegia_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                        		<td><input type="text" name="tkb_serag_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>		
                                <td><input type="text" name="tkb_paket_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>
                        		<td><input type="text" name="sdx_serag_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg1" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg2") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?> 
                        	<tr height="45" bgcolor="#617f90" id="text_normal_white">
                            	<td>Anak Pegawai ke-2</td>	
                                <td><input type="text" name="tod_penga_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>    
                        		<td><input type="text" name="pgx_penga_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>    
                        		<td><input type="text" name="pgx_kegia_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>    
                        		<td><input type="text" name="tka_penga_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>    
                        		<td><input type="text" name="tka_kegia_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>    
                        		<td><input type="text" name="tkb_penga_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>    
                        		<td><input type="text" name="tkb_kegia_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg3") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#617f90" id="text_normal_white">
                                <td>Anak Pegawai ke-3, dst</td>    
                                <td><input type="text" name="tod_penga_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="smp_penga_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg3" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg1graa") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                            <tr height="45" bgcolor="#617f90" id="text_normal_white">
                                <td>Anak Pegawai ke-1 + Grade A</td>	
                                <td><input type="text" name="tod_penga_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg1graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg1grab") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                            <tr height="45" bgcolor="#617f90" id="text_normal_white">
                                <td>Anak Pegawai ke-1 + Grade B</td>    
                                <td><input type="text" name="tod_penga_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
														
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg1grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg2graa") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#617f90" id="text_normal_white">
                                <td>Anak Pegawai ke-2 + Grade A</td>    
                                <td><input type="text" name="tod_penga_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}						
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg2graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg2grab") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        	<tr height="45" bgcolor="#617f90" id="text_normal_white">
                                <td>Anak Pegawai ke-2 + Grade B</td>	
                                <td><input type="text" name="tod_penga_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}														
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg2grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg3graa") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#617f90" id="text_normal_white">
                                <td>Anak Pegawai ke-3, dst + Grade A</td>    
                                <td><input type="text" name="tod_penga_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg3graa" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "anpeg3grab") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#617f90" id="text_normal_white">
                                <td>Anak Pegawai ke-3, dst + Grade B</td>    
                                <td><input type="text" name="tod_penga_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}						
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_anpeg3grab" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "pintodsem2") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#87778a" id="text_normal_white">
                                <td>Siswa pindahan ke toddler semester II</td>    
                                <td><input type="text" name="tod_penga_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>
                        		<td><input type="text" name="sdx_penga_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_pintodsem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "pinpgtksem2") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#87778a" id="text_normal_white">
                                <td>Siswa pindahan ke PG/TK A/TK B semester II</td>    
                                <td><input type="text" name="tod_penga_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            <?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_pinpgtksem2" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "pinsd34") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#87778a" id="text_normal_white">
                                <td>Siswa pindahan ke SD 3-4</td>    
                                <td><input type="text" name="tod_penga_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_pinsd34" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "pinsd56") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#87778a" id="text_normal_white">
                                <td>Siswa pindahan ke SD 5-6</td>    
                                <td><input type="text" name="tod_penga_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_pinsd56" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "pinsmp8") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#87778a" id="text_normal_white">
                                <td>Siswa pindahan ke smp 8</td>    
                                <td><input type="text" name="tod_penga_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}						
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_pinsmp8" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                            </tr>
							<?PHP
							}
						}	
						if($row_get_cat_adm_bi_ma["set_cat_adm"] == "pinsmp9") {
							if($row_get_cat_adm_bi_ma["level"] == "tod" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                            <tr height="45" bgcolor="#87778a" id="text_normal_white">
                                <td>Siswa pindahan ke smp 9</td>    
                                <td><input type="text" name="tod_penga_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="pgx_penga_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="pgx_kegia_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="pgx_peral_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="pgx_serag_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "pgx" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="pgx_paket_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}							
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tka_penga_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tka_kegia_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tka_peral_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tka_serag_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tka" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tka_paket_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}						
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="tkb_penga_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "kegia") {
							?>	
                                <td><input type="text" name="tkb_kegia_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "peral") {
							?>	
                                <td><input type="text" name="tkb_peral_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="tkb_serag_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "tkb" && $row_get_cat_adm_bi_ma["cat_adm"] == "paket") {
							?>	
                                <td><input type="text" name="tkb_paket_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="sdx_penga_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "sdx" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="sdx_serag_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "penga") {
							?>	
                                <td><input type="text" name="smp_penga_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                        	<?PHP
							}
							if($row_get_cat_adm_bi_ma["level"] == "smp" && $row_get_cat_adm_bi_ma["cat_adm"] == "serag") {
							?>	
                                <td><input type="text" name="smp_serag_pinsmp9" size="8" value="<?PHP echo $row_get_cat_adm_bi_ma["nominal"]; ?>" onkeypress="return checkIt(event)" /></td>
                    		</tr>
							<?PHP
							}
						}
					}
					?>
                    <tr height="60" bgcolor="#333333">
                        <td colspan="10" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpan Kategori Administrasi" onClick="return verification()"/> <input type="reset" value="Reset" /></td>
                    </tr>
                </table>
            </td>
            <td width="30"></td>
        </tr>
        <tr>
        	<td colspan="3" height="20"></td>
        </tr>
    </table>
    </form> 
<?PHP
}
?>
<!-- sandy said: form verifiation start form here buddy...:)-->
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.set_cat_adm_bi_ma.period.value == "")
	{
		alert('Anda harus memilih Tahun Pelajaran untuk melengkapi form administrasi biaya masuk');
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