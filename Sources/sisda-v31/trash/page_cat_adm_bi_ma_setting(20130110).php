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
    <form method="post" name="set_cat_adm_bi_ma" action="engine.php?case=cat_adm_bi_ma_setting">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="10">Tahun pelajaran: <?PHP include"include/periode.php"; ?></td>
                    </tr>
                    <?PHP
					//you may say that these are the craziest variable names that you ever found in this earth.
					//What should i say,.... i cant make it easier to write down.
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
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum</td>
                        <td><input type="text" name="tkx_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Bersamaan dengan saudara kandung</td>
                        <td><input type="text" name="tkx_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Memiliki Saudara Kandung</td>
                        <td><input type="text" name="tkx_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum Grade B</td>
                        <td><input type="text" name="tkx_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum memiliki Saudara Kandung di smp_ + Grade B</td>
                        <td><input type="text" name="tkx_penga_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_umsksmpgrab" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi</td>
                        <td><input type="text" name="tkx_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi + Grade A</td>
                        <td><input type="text" name="tkx_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi + Grade B</td>
                        <td><input type="text" name="tkx_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1</td>
                        <td><input type="text" name="tkx_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2</td>
                        <td><input type="text" name="tkx_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst</td>
                        <td><input type="text" name="tkx_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1 + Grade A</td>
                        <td><input type="text" name="tkx_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1 + Grade B</td>
                        <td><input type="text" name="tkx_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2 + Grade A</td>
                        <td><input type="text" name="tkx_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2 + Grade B</td>
                        <td><input type="text" name="tkx_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst + Grade A</td>
                        <td><input type="text" name="tkx_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst + Grade B</td>
                        <td><input type="text" name="tkx_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke toddler semester II</td>
                        <td><input type="text" name="tkx_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                    	<td>Siswa pindahan ke PG/TK A/TK B semester II</td>
                        <td><input type="text" name="tkx_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke SD 3-4</td>
                        <td><input type="text" name="tkx_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke SD 5-6</td>
                        <td><input type="text" name="tkx_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke smp 8</td>
                        <td><input type="text" name="tkx_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke smp 9</td>
                        <td><input type="text" name="tkx_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_kegia_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_peral_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="tkx_paket_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="sdx_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                        <td><input type="text" name="smp_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
                    </tr>
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
    <!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
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
    $src_limit = (!isset($_GET["p"])) ? "0" : htmlspecialchars($_GET["p"] - 1);
    
    //hey jude, how many record that you wanna show us in this page, buddy?
    $show_per_page = 5;
    
    //So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
    //Dont forget that the limit start from 0. 0 is the first record.
    $the_limit 	= ($src_limit * $show_per_page);
    
    //weleh-weleh, take a look at this query.....
    //$the_limit       = defines where should the query begin from
    //$show_per_page   = defines how many record should be shown
    $src_load_spp		= "select distinct periode from set_cat_adm_bi_ma order by periode limit $the_limit,$show_per_page";
    
    //but also, we need to select all record. it will be used to define the paging list.
    $src_load_spp_all	= "select distinct periode from set_cat_adm_bi_ma";
    
    $query_load_spp		=  mysqli_query($mysql_connect, $src_load_spp) or die("There is an error with mysql: ".mysql_error());
    $query_load_spp_all	=  mysqli_query($mysql_connect, $src_load_spp_all) or die("There is an error with mysql: ".mysql_error());
    
    //Hey, how many record do we have..?????
    $num_load_spp_all		= mysql_num_rows($query_load_spp_all);
    
    if($num_load_spp_all != 0) {
    ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="30"></td>
            <td height="10"></td>
            <td width="30"></td>
        </tr>
        <tr>
            <td></td>
            <td align="left">
                
                <!--========================== user registration form =========================-->
                <?PHP
                $p = (!isset($_GET["p"])) ? "1" : htmlspecialchars($_GET["p"]);
                
                $all_page = ceil($num_load_spp_all/$show_per_page);
                ?>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">            	
                    <tr height="40">
                        <td colspan="3"><hr noshade="noshade" size="1" color="#999999" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3" align="left" id="text_title_index1">Daftar Setting Kategori Administrasi Biaya Masuk</td>
                    </tr>
                    <tr>
                    	<td colspan="3" height="15"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td id="text_normal_black">halaman: 
                        <?PHP 
                        for($i = 1; $i <= $all_page; $i++) {
                            if($i == $p) {
                                echo "<span id='paging'>".$i." </span>";
                            } else {
                                echo "<span id='paging'><a href=\"?pl=cat_adm_bi_ma_setting&p=$i\" >$i</a></span> ";
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
                        <td width="40">No</td>
                        <td width="10"></td>
                        <td width="150">Tahun pelajaran</td>
                        <td width="10"></td>
                        <td>Modifikasi</td>
                        <td width="10"></td>
                    </tr>
                <?PHP
                //$bg used to generate zebra background.
                $bg	="#beb8a9";			
                //this is for number, you know...
                $no	= $the_limit + 1;
                while($row_load_spp = mysql_fetch_array($query_load_spp)) {			
                ?>
                    <tr height="30" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black">
                        <td></td>
                        <td><?PHP echo $no++; ?></td>
                        <td></td>
                        <td><?PHP echo $row_load_spp["periode"]; ?></td>
                        <td></td>
                        <td><a href="mainpage.php?pl=cat_adm_bi_ma_edit&per=<?PHP echo $row_load_spp["periode"]; ?>"><img src="images/icon_edit.png" border="0" title="Edit data" /></a>&nbsp;&nbsp;<a href="mainpage.php?pl=cat_adm_bi_ma_delete&per=<?PHP echo $row_load_spp["periode"]; ?>"><img src="images/icon_delete.png" border="0" title="Delete data"/></a></td>
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