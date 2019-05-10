<table border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">                
    <?PHP
    //you may say that these are the craziest variable names that you ever found in this earth.
    //What should i say,.... i cant make it easier to write down.
    //I bet that kamal, is making a LOL now.......
    /*
    umum			= Umum
    berdesaukan		= Bersamaan dengan saudara kandung
    memsaukan		= Memiliki Saudara Kandung
    umgrab			= Umum Grade B
    umskgrab		= Umum memiliki Saudara Kandung + Grade B
	ubdskgrab		= Umum bersamaan dengan saudara kandung + Grade B
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
    pinsmp-8		= Siswa pindahan ke smp- 8
    pinsmp-9		= Siswa pindahan ke smp- 9
    
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
        <td>Toddler</td>
        <td colspan="5">PG</td>
        <td colspan="5">TKA</td>
        <td colspan="5">TKB</td>
        <td colspan="2">SD</td>
        <td colspan="2">SMP</td>
    </tr>
    <tr height="25" bgcolor="#333333" id="text_normal_white">
        <td width="350">Pengembangan</td>
        <td width="350">Pengembangan</td>
        <td width="250">Kegiatan</td>
        <td width="250">Peralatan</td>
        <td width="250">Seragam</td>
        <td width="250">Paket</td>
        <td width="250">Pengembangan</td>
        <td width="250">Kegiatan</td>
        <td width="250">Peralatan</td>
        <td width="250">Seragam</td>
        <td width="250">Paket</td>
        <td width="250">Pengembangan</td>
        <td width="250">Kegiatan</td>
        <td width="250">Peralatan</td>
        <td width="250">Seragam</td>
        <td width="250">Paket</td>
        <td width="250">Pengembangan</td>
        <td width="250">Seragam</td>
        <td width="250">Pengembangan</td>
        <td width="250">Seragam</td>
    </tr>
    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
        <td><input type="text" name="tod_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_umum" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_umum" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    
    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
        <td><input type="text" name="tod_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_berdesaukan" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
        <td><input type="text" name="tod_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_memsaukan" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
        <td><input type="text" name="tod_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_umgrab" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
        <td><input type="text" name="tod_penga_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_umskgrab" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
        <td><input type="text" name="tod_penga_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_ubdskgrab" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#718b88" id="text_normal_white">
        <td><input type="text" name="tod_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_asdar" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_asdar" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#718b88" id="text_normal_white">
        <td><input type="text" name="tod_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_asdargraa" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#718b88" id="text_normal_white">
        <td><input type="text" name="tod_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_asdargrab" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg1" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg2" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg3" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg1graa" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg1grab" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg2graa" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg2grab" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg3graa" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#617f90" id="text_normal_white">
        <td><input type="text" name="tod_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_anpeg3grab" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#87778a" id="text_normal_white">
        <td><input type="text" name="tod_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_pintodsem2" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#87778a" id="text_normal_white">
        <td><input type="text" name="tod_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_pinpgtksem2" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#87778a" id="text_normal_white">
        <td><input type="text" name="tod_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_pinsd34" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#87778a" id="text_normal_white">
        <td><input type="text" name="tod_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_pinsd56" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#87778a" id="text_normal_white">
        <td><input type="text" name="tod_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_pinsmp8" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#87778a" id="text_normal_white">
        <td><input type="text" name="tod_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_pinsmp9" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#8a6c66" id="text_normal_white">
        <td><input type="text" name="tod_penga_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_dafultka" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
    <tr height="45" bgcolor="#8a6c66" id="text_normal_white">
        <td><input type="text" name="tod_penga_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_penga_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_kegia_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_peral_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_serag_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="pgx_paket_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_penga_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_kegia_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_peral_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_serag_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tka_paket_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_penga_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_kegia_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_peral_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_serag_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="tkb_paket_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_penga_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="sdx_serag_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_penga_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
        <td><input type="text" name="smp_serag_dafultkb" size="8" onkeypress="return checkIt(event)" /></td>
    </tr>
</table>