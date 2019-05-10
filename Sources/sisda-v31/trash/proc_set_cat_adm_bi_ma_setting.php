<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	//these data taken from page_seeting_spp.php
	$period		= htmlspecialchars($_POST["period"]);
	
	//You are the lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
	//make sure that period is not empty
		
	if(!empty($period)) {
		//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
		//So here we will make a filter to avoid data duplication.
		//Check if the new data already exist in database.
		//Only one data has to be checked here: period
			
		$src_check_exist	= "select * from set_cat_adm_bi_ma where periode = '$period'";
		$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
		$num_check_exist	= mysql_num_rows($query_check_exist);
			
		//tell admin if the data already exist
		if($num_check_exist != 0) {
				
			$redirect_path	= "";
			$redirect_icon	= "images/icon_false.png";
			$redirect_url	= "mainpage.php?pl=set_cat_adm_bi_ma";
			$redirect_text	= "Mohon maaf, pengaturan Kategori Administrasi Biaya Masuk untuk tahun ajaran $period sudah dilakukan. <br>Silahkan lakukan proses edit untuk melakukan perubahan nilai.";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
			
		} else {
			//if the data hasnt be defined, go ahead.
			///////////////////////////////////////////////////////////////	
			
			
			
			//Please do not laugh about the varible name that i've made
			//I couldnt find the better one
			//check whether the "nominal" variable empty or not
			//it may not be empty
			
			//Umum
			$src_nominal1 = (empty(htmlspecialchars($_POST["tkx_penga_umum"]))) ? '0' : htmlspecialchars($_POST["tkx_penga_umum"]);
			$src_nominal2 = (empty(htmlspecialchars($_POST["tkx_kegia_umum"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_umum"]);
			$src_nominal3 = (empty(htmlspecialchars($_POST["tkx_peral_umum"])) ? '0' : htmlspecialchars($_POST["tkx_peral_umum"]);
			$src_nominal4 = (empty(htmlspecialchars($_POST["tkx_serag_umum"])) ? '0' : htmlspecialchars($_POST["tkx_serag_umum"]);
			$src_nominal5 = (empty(htmlspecialchars($_POST["tkx_paket_umum"])) ? '0' : htmlspecialchars($_POST["tkx_paket_umum"]);
			$src_nominal6 = (empty(htmlspecialchars($_POST["sdx_penga_umum"])) ? '0' : htmlspecialchars($_POST["sdx_penga_umum"]);
			$src_nominal7 = (empty(htmlspecialchars($_POST["sdx_serag_umum"])) ? '0' : htmlspecialchars($_POST["sdx_serag_umum"]);
			$src_nominal8 = (empty(htmlspecialchars($_POST["smp_penga_umum"])) ? '0' : htmlspecialchars($_POST["smp_penga_umum"]);
			$src_nominal9 = (empty(htmlspecialchars($_POST["smp_serag_umum"])) ? '0' : htmlspecialchars($_POST["smp_serag_umum"]);
			
			$_adm1	=	"tkx_penga_umum_"	.$src_nominal1;
			$_adm2	=	"tkx_kegia_umum_"	.$src_nominal2;
			$_adm3	=	"$tkx_peral_umum_"	.$src_nominal3;
			$_adm4	=	"$tkx_serag_umum_"	.$src_nominal4;
			$_adm5	=	"$tkx_paket_umum_"	.$src_nominal5;
			$_adm6	=	"sdx_penga_umum_"	.$src_nominal6;
			$_adm7	=	"$sdx_serag_umum_"	.$src_nominal7;
			$_adm8	=	"smp_penga_umum_"	.$src_nominal8;
			$_adm9	=	"smp_serag_umum_"	.$src_nominal9;			
			
			//Bersamaan dengan saudara kandung
			$src_nominal10 = (empty(htmlspecialchars($_POST["tkx_penga_berdesaukan"])) ? '0' : htmlspecialchars($_POST["tkx_penga_berdesaukan"]);
			$src_nominal11 = (empty(htmlspecialchars($_POST["tkx_kegia_berdesaukan"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_berdesaukan"]);
			$src_nominal12 = (empty(htmlspecialchars($_POST["tkx_peral_berdesaukan"])) ? '0' : htmlspecialchars($_POST["tkx_peral_berdesaukan"]);
			$src_nominal13 = (empty(htmlspecialchars($_POST["tkx_serag_berdesaukan"])) ? '0' : htmlspecialchars($_POST["tkx_serag_berdesaukan"]);
			$src_nominal14 = (empty(htmlspecialchars($_POST["tkx_paket_berdesaukan"])) ? '0' : htmlspecialchars($_POST["tkx_paket_berdesaukan"]);
			$src_nominal15 = (empty(htmlspecialchars($_POST["sdx_penga_berdesaukan"])) ? '0' : htmlspecialchars($_POST["sdx_penga_berdesaukan"]);
			$src_nominal16 = (empty(htmlspecialchars($_POST["sdx_serag_berdesaukan"])) ? '0' : htmlspecialchars($_POST["sdx_serag_berdesaukan"]);
			$src_nominal17 = (empty(htmlspecialchars($_POST["smp_penga_berdesaukan"])) ? '0' : htmlspecialchars($_POST["smp_penga_berdesaukan"]);
			$src_nominal18 = (empty(htmlspecialchars($_POST["smp_serag_berdesaukan"])) ? '0' : htmlspecialchars($_POST["smp_serag_berdesaukan"]);
			
			$_adm10	=	"tkx_penga_berdesaukan_"	.$src_nominal10;
			$_adm11	=	"tkx_kegia_berdesaukan_"	.$src_nominal11;
			$_adm12	=	"tkx_peral_berdesaukan_"	.$src_nominal12;
			$_adm13	=	"tkx_serag_berdesaukan_"	.$src_nominal13;
			$_adm14	=	"tkx_paket_berdesaukan_"	.$src_nominal14;
			$_adm15	=	"sdx_penga_berdesaukan_"	.$src_nominal15;
			$_adm16	=	"sdx_serag_berdesaukan_"	.$src_nominal16;
			$_adm17	=	"smp_penga_berdesaukan_"	.$src_nominal17;
			$_adm18	=	"smp_serag_berdesaukan_"	.$src_nominal18;
			
			//Memiliki Saudara Kandung
			$src_nominal19 = (empty(htmlspecialchars($_POST["tkx_penga_memsaukan"])) ? '0' : htmlspecialchars($_POST["tkx_penga_memsaukan"]);
			$src_nominal20 = (empty(htmlspecialchars($_POST["tkx_kegia_memsaukan"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_memsaukan"]);
			$src_nominal21 = (empty(htmlspecialchars($_POST["tkx_peral_memsaukan"])) ? '0' : htmlspecialchars($_POST["tkx_peral_memsaukan"]);
			$src_nominal22 = (empty(htmlspecialchars($_POST["tkx_serag_memsaukan"])) ? '0' : htmlspecialchars($_POST["tkx_serag_memsaukan"]);
			$src_nominal23 = (empty(htmlspecialchars($_POST["tkx_paket_memsaukan"])) ? '0' : htmlspecialchars($_POST["tkx_paket_memsaukan"]);
			$src_nominal24 = (empty(htmlspecialchars($_POST["sdx_penga_memsaukan"])) ? '0' : htmlspecialchars($_POST["sdx_penga_memsaukan"]);
			$src_nominal25 = (empty(htmlspecialchars($_POST["sdx_serag_memsaukan"])) ? '0' : htmlspecialchars($_POST["sdx_serag_memsaukan"]);
			$src_nominal26 = (empty(htmlspecialchars($_POST["smp_penga_memsaukan"])) ? '0' : htmlspecialchars($_POST["smp_penga_memsaukan"]);
			$src_nominal27 = (empty(htmlspecialchars($_POST["smp_serag_memsaukan"])) ? '0' : htmlspecialchars($_POST["smp_serag_memsaukan"]);
			
			$_adm19	=	"tkx_penga_memsaukan_"	.src_nominal19;
			$_adm20	=	"tkx_kegia_memsaukan_"	.src_nominal20;
			$_adm21	=	"tkx_peral_memsaukan_"	.src_nominal21;
			$_adm22	=	"tkx_serag_memsaukan_"	.src_nominal22;
			$_adm23	=	"tkx_paket_memsaukan_"	.src_nominal23;
			$_adm24	=	"sdx_penga_memsaukan_"	.src_nominal24;
			$_adm25	=	"sdx_serag_memsaukan_"	.src_nominal25;
			$_adm26	=	"smp_penga_memsaukan_"	.src_nominal26;
			$_adm27	=	"smp_serag_memsaukan_"	.src_nominal27;
			
			//Umum Grade B
			$src_nominal28 = (empty(htmlspecialchars($_POST["tkx_penga_umgrab"])) ? '0' : htmlspecialchars($_POST["tkx_penga_umgrab"]);
			$src_nominal29 = (empty(htmlspecialchars($_POST["tkx_kegia_umgrab"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_umgrab"]);
			$src_nominal30 = (empty(htmlspecialchars($_POST["tkx_peral_umgrab"])) ? '0' : htmlspecialchars($_POST["tkx_peral_umgrab"]);
			$src_nominal31 = (empty(htmlspecialchars($_POST["tkx_serag_umgrab"])) ? '0' : htmlspecialchars($_POST["tkx_serag_umgrab"]);
			$src_nominal32 = (empty(htmlspecialchars($_POST["tkx_paket_umgrab"])) ? '0' : htmlspecialchars($_POST["tkx_paket_umgrab"]);
			$src_nominal33 = (empty(htmlspecialchars($_POST["sdx_penga_umgrab"])) ? '0' : htmlspecialchars($_POST["sdx_penga_umgrab"]);
			$src_nominal34 = (empty(htmlspecialchars($_POST["sdx_serag_umgrab"])) ? '0' : htmlspecialchars($_POST["sdx_serag_umgrab"]);
			$src_nominal35 = (empty(htmlspecialchars($_POST["smp_penga_umgrab"])) ? '0' : htmlspecialchars($_POST["smp_penga_umgrab"]);
			$src_nominal36 = (empty(htmlspecialchars($_POST["smp_serag_umgrab"])) ? '0' : htmlspecialchars($_POST["smp_serag_umgrab"]);
			
			$_adm28	=	"tkx_penga_umgrab_"	.$src_nominal28;
			$_adm29	=	"tkx_kegia_umgrab_"	.$src_nominal29;
			$_adm30	=	"tkx_peral_umgrab_"	.$src_nominal30;
			$_adm31	=	"tkx_serag_umgrab_"	.$src_nominal31;
			$_adm32	=	"tkx_paket_umgrab_"	.$src_nominal32;
			$_adm33	=	"sdx_penga_umgrab_"	.$src_nominal33;
			$_adm34	=	"sdx_serag_umgrab_"	.$src_nominal34;
			$_adm35	=	"smp_penga_umgrab_"	.$src_nominal35;
			$_adm36	=	"smp_serag_umgrab_"	.$src_nominal36;
			
			//Umum memiliki Saudara Kandung di SMP + Grade B
			$src_nominal37 = (empty(htmlspecialchars($_POST["tkx_penga_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["tkx_penga_umsksmpgrab"]);
			$src_nominal38 = (empty(htmlspecialchars($_POST["tkx_kegia_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_umsksmpgrab"]);
			$src_nominal39 = (empty(htmlspecialchars($_POST["tkx_peral_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["tkx_peral_umsksmpgrab"]);
			$src_nominal40 = (empty(htmlspecialchars($_POST["tkx_serag_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["tkx_serag_umsksmpgrab"]);
			$src_nominal41 = (empty(htmlspecialchars($_POST["tkx_paket_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["tkx_paket_umsksmpgrab"]);
			$src_nominal42 = (empty(htmlspecialchars($_POST["sdx_penga_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["sdx_penga_umsksmpgrab"]);
			$src_nominal43 = (empty(htmlspecialchars($_POST["sdx_serag_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["sdx_serag_umsksmpgrab"]);
			$src_nominal44 = (empty(htmlspecialchars($_POST["smp_penga_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["smp_penga_umsksmpgrab"]);
			$src_nominal45 = (empty(htmlspecialchars($_POST["smp_serag_umsksmpgrab"])) ? '0' : htmlspecialchars($_POST["smp_serag_umsksmpgrab"]);
			
			$_adm37	=	"tkx_penga_umsksmpgrab_"	.$src_nominal37;
			$_adm38	=	"tkx_kegia_umsksmpgrab_"	.$src_nominal38;
			$_adm39	=	"tkx_peral_umsksmpgrab_"	.$src_nominal39;
			$_adm40	=	"tkx_serag_umsksmpgrab_"	.$src_nominal40;
			$_adm41	=	"tkx_paket_umsksmpgrab_"	.$src_nominal41;
			$_adm42	=	"sdx_penga_umsksmpgrab_"	.$src_nominal42;
			$_adm43	=	"sdx_serag_umsksmpgrab_"	.$src_nominal43;
			$_adm44	=	"smp_penga_umsksmpgrab_"	.$src_nominal44;
			$_adm45	=	"smp_serag_umsksmpgrab_"	.$src_nominal45;
			
			//Asal Darbi
			$src_nominal46 = (empty(htmlspecialchars($_POST["tkx_penga_asdar"])) ? '0' : htmlspecialchars($_POST["tkx_penga_asdar"]);
			$src_nominal47 = (empty(htmlspecialchars($_POST["tkx_kegia_asdar"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_asdar"]);
			$src_nominal48 = (empty(htmlspecialchars($_POST["tkx_peral_asdar"])) ? '0' : htmlspecialchars($_POST["tkx_peral_asdar"]);
			$src_nominal49 = (empty(htmlspecialchars($_POST["tkx_serag_asdar"])) ? '0' : htmlspecialchars($_POST["tkx_serag_asdar"]);
			$src_nominal50 = (empty(htmlspecialchars($_POST["tkx_paket_asdar"])) ? '0' : htmlspecialchars($_POST["tkx_paket_asdar"]);
			$src_nominal51 = (empty(htmlspecialchars($_POST["sdx_penga_asdar"])) ? '0' : htmlspecialchars($_POST["sdx_penga_asdar"]);
			$src_nominal52 = (empty(htmlspecialchars($_POST["sdx_serag_asdar"])) ? '0' : htmlspecialchars($_POST["sdx_serag_asdar"]);
			$src_nominal53 = (empty(htmlspecialchars($_POST["smp_penga_asdar"])) ? '0' : htmlspecialchars($_POST["smp_penga_asdar"]);
			$src_nominal54 = (empty(htmlspecialchars($_POST["smp_serag_asdar"])) ? '0' : htmlspecialchars($_POST["smp_serag_asdar"]);
			
			$_adm46	=	"tkx_penga_asdar_"	.$src_nominal46;
			$_adm47	=	"tkx_kegia_asdar_"	.$src_nominal47;
			$_adm48	=	"tkx_peral_asdar_"	.$src_nominal48;
			$_adm49	=	"tkx_serag_asdar_"	.$src_nominal49;
			$_adm50	=	"tkx_paket_asdar_"	.$src_nominal50;
			$_adm51	=	"sdx_penga_asdar_"	.$src_nominal51;
			$_adm52	=	"sdx_serag_asdar_"	.$src_nominal52;
			$_adm53	=	"smp_penga_asdar_"	.$src_nominal53;
			$_adm54	=	"smp_serag_asdar_"	.$src_nominal54;
			
			//Asal Darbi + Grade A
			$src_nominal55 = (empty(htmlspecialchars($_POST["tkx_penga_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_penga_asdargraa"]);
			$src_nominal56 = (empty(htmlspecialchars($_POST["tkx_kegia_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_asdargraa"]);
			$src_nominal57 = (empty(htmlspecialchars($_POST["tkx_peral_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_peral_asdargraa"]);
			$src_nominal58 = (empty(htmlspecialchars($_POST["tkx_serag_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_serag_asdargraa"]);
			$src_nominal59 = (empty(htmlspecialchars($_POST["tkx_paket_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_paket_asdargraa"]);
			$src_nominal60 = (empty(htmlspecialchars($_POST["sdx_penga_asdargraa"])) ? '0' : htmlspecialchars($_POST["sdx_penga_asdargraa"]);
			$src_nominal61 = (empty(htmlspecialchars($_POST["sdx_serag_asdargraa"])) ? '0' : htmlspecialchars($_POST["sdx_serag_asdargraa"]);
			$src_nominal62 = (empty(htmlspecialchars($_POST["smp_penga_asdargraa"])) ? '0' : htmlspecialchars($_POST["smp_penga_asdargraa"]);
			$src_nominal63 = (empty(htmlspecialchars($_POST["smp_serag_asdargraa"])) ? '0' : htmlspecialchars($_POST["smp_serag_asdargraa"]);
			
			$_adm55	=	"tkx_penga_asdargraa_"	.$src_nominal55;
			$_adm56	=	"tkx_kegia_asdargraa_"	.$src_nominal56;
			$_adm57	=	"tkx_peral_asdargraa_"	.$src_nominal57;
			$_adm58	=	"tkx_serag_asdargraa_"	.$src_nominal58;
			$_adm59	=	"tkx_paket_asdargraa_"	.$src_nominal59;
			$_adm60	=	"sdx_penga_asdargraa_"	.$src_nominal60;
			$_adm61	=	"sdx_serag_asdargraa_"	.$src_nominal61;
			$_adm62	=	"smp_penga_asdargraa_"	.$src_nominal62;
			$_adm63	=	"smp_serag_asdargraa_"	.$src_nominal63;
			
			//Asal Darbi + Grade B
			$src_nominal55 = (empty(htmlspecialchars($_POST["tkx_penga_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_penga_asdargraa"]);
			$src_nominal56 = (empty(htmlspecialchars($_POST["tkx_kegia_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_asdargraa"]);
			$src_nominal57 = (empty(htmlspecialchars($_POST["tkx_peral_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_peral_asdargraa"]);
			$src_nominal58 = (empty(htmlspecialchars($_POST["tkx_serag_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_serag_asdargraa"]);
			$src_nominal59 = (empty(htmlspecialchars($_POST["tkx_paket_asdargraa"])) ? '0' : htmlspecialchars($_POST["tkx_paket_asdargraa"]);
			$src_nominal60 = (empty(htmlspecialchars($_POST["sdx_penga_asdargraa"])) ? '0' : htmlspecialchars($_POST["sdx_penga_asdargraa"]);
			$src_nominal61 = (empty(htmlspecialchars($_POST["sdx_serag_asdargraa"])) ? '0' : htmlspecialchars($_POST["sdx_serag_asdargraa"]);
			$src_nominal62 = (empty(htmlspecialchars($_POST["smp_penga_asdargraa"])) ? '0' : htmlspecialchars($_POST["smp_penga_asdargraa"]);
			$src_nominal63 = (empty(htmlspecialchars($_POST["smp_serag_asdargraa"])) ? '0' : htmlspecialchars($_POST["smp_serag_asdargraa"]);
			
			$_adm64	=	"tkx_penga_asdargrab_"	.htmlspecialchars($_POST["tkx_penga_asdargrab"]);
			$_adm65	=	"tkx_kegia_asdargrab_"	.htmlspecialchars($_POST["tkx_kegia_asdargrab"]);
			$_adm66	=	"tkx_peral_asdargrab_"	.htmlspecialchars($_POST["tkx_peral_asdargrab"]);
			$_adm67	=	"tkx_serag_asdargrab_"	.htmlspecialchars($_POST["tkx_serag_asdargrab"]);
			$_adm68	=	"tkx_paket_asdargrab_"	.htmlspecialchars($_POST["tkx_paket_asdargrab"]);
			$_adm69	=	"sdx_penga_asdargrab_"	.htmlspecialchars($_POST["sdx_penga_asdargrab"]);
			$_adm70	=	"sdx_serag_asdargrab_"	.htmlspecialchars($_POST["sdx_serag_asdargrab"]);
			$_adm71	=	"smp_penga_asdargrab_"	.htmlspecialchars($_POST["smp_penga_asdargrab"]);
			$_adm72	=	"smp_serag_asdargrab_"	.htmlspecialchars($_POST["smp_serag_asdargrab"]);
			
			//Anak Pegawai ke-1
			$src_nominal73 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg1"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg1"]);
			$src_nominal74 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg1"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg1"]);
			$src_nominal75 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg1"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg1"]);
			$src_nominal76 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg1"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg1"]);
			$src_nominal77 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg1"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg1"]);
			$src_nominal78 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg1"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg1"]);
			$src_nominal79 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg1"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg1"]);
			$src_nominal80 = (empty(htmlspecialchars($_POST["smp_penga_anpeg1"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg1"]);
			$src_nominal81 = (empty(htmlspecialchars($_POST["smp_serag_anpeg1"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg1"]);
			
			$_adm73	=	"tkx_penga_anpeg1_"	.$src_nominal73;
			$_adm74	=	"tkx_kegia_anpeg1_"	.$src_nominal74;
			$_adm75	=	"tkx_peral_anpeg1_"	.$src_nominal75;
			$_adm76	=	"tkx_serag_anpeg1_"	.$src_nominal76;
			$_adm77	=	"tkx_paket_anpeg1_"	.$src_nominal77;
			$_adm78	=	"sdx_penga_anpeg1_"	.$src_nominal78;
			$_adm79	=	"sdx_serag_anpeg1_"	.$src_nominal79;
			$_adm70	=	"smp_penga_anpeg1_"	.$src_nominal80;
			$_adm81	=	"smp_serag_anpeg1_"	.$src_nominal81;
			
			//Anak Pegawai ke-2
			$src_nominal82 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg2"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg2"]);
			$src_nominal83 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg2"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg2"]);
			$src_nominal84 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg2"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg2"]);
			$src_nominal85 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg2"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg2"]);
			$src_nominal86 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg2"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg2"]);
			$src_nominal87 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg2"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg2"]);
			$src_nominal88 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg2"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg2"]);
			$src_nominal89 = (empty(htmlspecialchars($_POST["smp_penga_anpeg2"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg2"]);
			$src_nominal90 = (empty(htmlspecialchars($_POST["smp_serag_anpeg2"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg2"]);
			
			$_adm82	=	"tkx_penga_anpeg2_"	.$src_nominal82;
			$_adm83	=	"tkx_kegia_anpeg2_"	.$src_nominal83;
			$_adm84	=	"tkx_peral_anpeg2_"	.$src_nominal84;
			$_adm85	=	"tkx_serag_anpeg2_"	.$src_nominal85;
			$_adm86	=	"tkx_paket_anpeg2_"	.$src_nominal86;
			$_adm87	=	"sdx_penga_anpeg2_"	.$src_nominal87;
			$_adm88	=	"sdx_serag_anpeg2_"	.$src_nominal88;
			$_adm89	=	"smp_penga_anpeg2_"	.$src_nominal89;
			$_adm90	=	"smp_serag_anpeg2_"	.$src_nominal90;
			
			//Anak Pegawai ke-3, dst
			$src_nominal91 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg3"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg3"]);
			$src_nominal92 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg3"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg3"]);
			$src_nominal93 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg3"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg3"]);
			$src_nominal94 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg3"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg3"]);
			$src_nominal95 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg3"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg3"]);
			$src_nominal96 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg3"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg3"]);
			$src_nominal97 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg3"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg3"]);
			$src_nominal98 = (empty(htmlspecialchars($_POST["smp_penga_anpeg3"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg3"]);
			$src_nominal98 = (empty(htmlspecialchars($_POST["smp_serag_anpeg3"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg3"]);
			
			$_adm91	=	"tkx_penga_anpeg3_"	.$src_nominal91;
			$_adm92	=	"tkx_kegia_anpeg3_"	.$src_nominal92;
			$_adm93	=	"tkx_peral_anpeg3_"	.$src_nominal93;
			$_adm94	=	"tkx_serag_anpeg3_"	.$src_nominal94;
			$_adm95	=	"tkx_paket_anpeg3_"	.$src_nominal95;
			$_adm96	=	"sdx_penga_anpeg3_"	.$src_nominal96;
			$_adm97	=	"sdx_serag_anpeg3_"	.$src_nominal97;
			$_adm98	=	"smp_penga_anpeg3_"	.$src_nominal98;
			$_adm99	=	"smp_serag_anpeg3_"	.$src_nominal99;
			
			//Anak Pegawai ke-1 + Grade A
			$src_nominal100 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg1graa"]);
			$src_nominal101 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg1graa"]);
			$src_nominal102 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg1graa"]);
			$src_nominal103 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg1graa"]);
			$src_nominal104 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg1graa"]);
			$src_nominal105 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg1graa"]);
			$src_nominal106 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg1graa"]);
			$src_nominal107 = (empty(htmlspecialchars($_POST["smp_penga_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg1graa"]);
			$src_nominal108 = (empty(htmlspecialchars($_POST["smp_serag_anpeg1graa"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg1graa"]);
			
			$_adm99		=	"$tkx_penga_anpeg1graa_"	.$src_nominal100;
			$_adm101	=	"$tkx_kegia_anpeg1graa_"	.$src_nominal101;
			$_adm102	=	"$tkx_peral_anpeg1graa_"	.$src_nominal102;
			$_adm103	=	"$tkx_serag_anpeg1graa_"	.$src_nominal103;
			$_adm104	=	"$tkx_paket_anpeg1graa_"	.$src_nominal104;
			$_adm105	=	"$sdx_penga_anpeg1graa_"	.$src_nominal105;
			$_adm106	=	"$sdx_serag_anpeg1graa_"	.$src_nominal106;
			$_adm107	=	"$smp_penga_anpeg1graa_"	.$src_nominal107;
			$_adm108	=	"$smp_serag_anpeg1graa_"	.$src_nominal108;
			
			//Anak Pegawai ke-1 + Grade B
			$src_nominal109 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg1grab"]);
			$src_nominal110 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg1grab"]);
			$src_nominal111 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg1grab"]);
			$src_nominal112 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg1grab"]);
			$src_nominal113 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg1grab"]);
			$src_nominal114 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg1grab"]);
			$src_nominal115 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg1grab"]);
			$src_nominal116 = (empty(htmlspecialchars($_POST["smp_penga_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg1grab"]);
			$src_nominal117 = (empty(htmlspecialchars($_POST["smp_serag_anpeg1grab"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg1grab"]);
			
			$_adm109	=	"tkx_penga_anpeg1grab_"	.$src_nominal109;
			$_adm110	=	"tkx_kegia_anpeg1grab_"	.$src_nominal110;
			$_adm111	=	"tkx_peral_anpeg1grab_"	.$src_nominal111;
			$_adm112	=	"tkx_serag_anpeg1grab_"	.$src_nominal112;
			$_adm113	=	"tkx_paket_anpeg1grab_"	.$src_nominal113;
			$_adm114	=	"sdx_penga_anpeg1grab_"	.$src_nominal114;
			$_adm115	=	"sdx_serag_anpeg1grab_"	.$src_nominal115;
			$_adm116	=	"smp_penga_anpeg1grab_"	.$src_nominal116;
			$_adm117	=	"smp_serag_anpeg1grab_"	.$src_nominal117;
			
			//Anak Pegawai ke-2 + Grade A
			$src_nominal118 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg2graa"]);
			$src_nominal119 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg2graa"]);
			$src_nominal120 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg2graa"]);
			$src_nominal121 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg2graa"]);
			$src_nominal122 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg2graa"]);
			$src_nominal123 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg2graa"]);
			$src_nominal124 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg2graa"]);
			$src_nominal125 = (empty(htmlspecialchars($_POST["smp_penga_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg2graa"]);
			$src_nominal126 = (empty(htmlspecialchars($_POST["smp_serag_anpeg2graa"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg2graa"]);
			
			$_adm118	=	"tkx_penga_anpeg2graa_"	.$src_nominal118;
			$_adm119	=	"tkx_kegia_anpeg2graa_"	.$src_nominal119;
			$_adm120	=	"tkx_peral_anpeg2graa_"	.$src_nominal120;
			$_adm121	=	"tkx_serag_anpeg2graa_"	.$src_nominal121;
			$_adm122	=	"tkx_paket_anpeg2graa_"	.$src_nominal122;
			$_adm123	=	"sdx_penga_anpeg2graa_"	.$src_nominal123;
			$_adm124	=	"sdx_serag_anpeg2graa_"	.$src_nominal124;
			$_adm125	=	"smp_penga_anpeg2graa_"	.$src_nominal125;
			$_adm126	=	"smp_serag_anpeg2graa_"	.$src_nominal126;
			
			//Anak Pegawai ke-2 + Grade B
			$src_nominal127 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg2grab"]);
			$src_nominal128 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg2grab"]);
			$src_nominal129 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg2grab"]);
			$src_nominal130 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg2grab"]);
			$src_nominal131 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg2grab"]);
			$src_nominal132 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg2grab"]);
			$src_nominal133 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg2grab"]);
			$src_nominal134 = (empty(htmlspecialchars($_POST["smp_penga_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg2grab"]);
			$src_nominal135 = (empty(htmlspecialchars($_POST["smp_serag_anpeg2grab"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg2grab"]);
			
			$_adm127	=	"tkx_penga_anpeg2grab_"	.$src_nominal127;
			$_adm128	=	"tkx_kegia_anpeg2grab_"	.$src_nominal128;
			$_adm129	=	"tkx_peral_anpeg2grab_"	.$src_nominal129;
			$_adm130	=	"tkx_serag_anpeg2grab_"	.$src_nominal130;
			$_adm131	=	"tkx_paket_anpeg2grab_"	.$src_nominal131;
			$_adm132	=	"sdx_penga_anpeg2grab_"	.$src_nominal132;
			$_adm133	=	"sdx_serag_anpeg2grab_"	.$src_nominal133;
			$_adm134	=	"smp_penga_anpeg2grab_"	.$src_nominal134;
			$_adm135	=	"smp_serag_anpeg2grab_"	.$src_nominal135;
			
			//Anak Pegawai ke-3, dst + Grade A
			$src_nominal136 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg3graa"]);
			$src_nominal137 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg3graa"]);
			$src_nominal138 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg3graa"]);
			$src_nominal139 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg3graa"]);
			$src_nominal140 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg3graa"]);
			$src_nominal141 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg3graa"]);
			$src_nominal142 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg3graa"]);
			$src_nominal143 = (empty(htmlspecialchars($_POST["smp_penga_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg3graa"]);
			$src_nominal144 = (empty(htmlspecialchars($_POST["smp_serag_anpeg3graa"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg3graa"]);
			
			$_adm136	=	"tkx_penga_anpeg3graa_"	.$src_nominal136;
			$_adm137	=	"tkx_kegia_anpeg3graa_"	.$src_nominal137;
			$_adm138	=	"tkx_peral_anpeg3graa_"	.$src_nominal138;
			$_adm139	=	"tkx_serag_anpeg3graa_"	.$src_nominal139;
			$_adm140	=	"tkx_paket_anpeg3graa_"	.$src_nominal140;
			$_adm141	=	"sdx_penga_anpeg3graa_"	.$src_nominal141;
			$_adm142	=	"sdx_serag_anpeg3graa_"	.$src_nominal142;
			$_adm143	=	"smp_penga_anpeg3graa_"	.$src_nominal143);
			$_adm144	=	"smp_serag_anpeg3graa_"	.$src_nominal144;
			
			//Anak Pegawai ke-3, dst + Grade B
			$src_nominal145 = (empty(htmlspecialchars($_POST["tkx_penga_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["tkx_penga_anpeg3grab"]);
			$src_nominal146 = (empty(htmlspecialchars($_POST["tkx_kegia_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_anpeg3grab"]);
			$src_nominal147 = (empty(htmlspecialchars($_POST["tkx_peral_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["tkx_peral_anpeg3grab"]);
			$src_nominal148 = (empty(htmlspecialchars($_POST["tkx_serag_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["tkx_serag_anpeg3grab"]);
			$src_nominal149 = (empty(htmlspecialchars($_POST["tkx_paket_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["tkx_paket_anpeg3grab"]);
			$src_nominal150 = (empty(htmlspecialchars($_POST["sdx_penga_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["sdx_penga_anpeg3grab"]);
			$src_nominal151 = (empty(htmlspecialchars($_POST["sdx_serag_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["sdx_serag_anpeg3grab"]);
			$src_nominal152 = (empty(htmlspecialchars($_POST["smp_penga_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["smp_penga_anpeg3grab"]);
			$src_nominal153 = (empty(htmlspecialchars($_POST["smp_serag_anpeg3grab"])) ? '0' : htmlspecialchars($_POST["smp_serag_anpeg3grab"]);
			
			$_adm145	=	"tkx_penga_anpeg3grab_"	.$src_nominal145;
			$_adm146	=	"tkx_kegia_anpeg3grab_"	.$src_nominal146;
			$_adm147	=	"tkx_peral_anpeg3grab_"	.$src_nominal147;
			$_adm148	=	"tkx_serag_anpeg3grab_"	.$src_nominal148;
			$_adm149	=	"tkx_paket_anpeg3grab_"	.$src_nominal149;
			$_adm150	=	"sdx_penga_anpeg3grab_"	.$src_nominal150;
			$_adm151	=	"sdx_serag_anpeg3grab_"	.$src_nominal151;
			$_adm152	=	"smp_penga_anpeg3grab_"	.$src_nominal152;
			$_adm153	=	"smp_serag_anpeg3grab_"	.$src_nominal153;
			
			//Siswa pindahan ke toddler semester II
			$src_nominal154 = (empty(htmlspecialchars($_POST["tkx_penga_pintodsem2"])) ? '0' : htmlspecialchars($_POST["tkx_penga_pintodsem2"]);
			$src_nominal155 = (empty(htmlspecialchars($_POST["tkx_kegia_pintodsem2"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_pintodsem2"]);
			$src_nominal156 = (empty(htmlspecialchars($_POST["tkx_peral_pintodsem2"])) ? '0' : htmlspecialchars($_POST["tkx_peral_pintodsem2"]);
			$src_nominal157 = (empty(htmlspecialchars($_POST["tkx_serag_pintodsem2"])) ? '0' : htmlspecialchars($_POST["tkx_serag_pintodsem2"]);
			$src_nominal158 = (empty(htmlspecialchars($_POST["tkx_paket_pintodsem2"])) ? '0' : htmlspecialchars($_POST["tkx_paket_pintodsem2"]);
			$src_nominal159 = (empty(htmlspecialchars($_POST["sdx_penga_pintodsem2"])) ? '0' : htmlspecialchars($_POST["sdx_penga_pintodsem2"]);
			$src_nominal160 = (empty(htmlspecialchars($_POST["sdx_serag_pintodsem2"])) ? '0' : htmlspecialchars($_POST["sdx_serag_pintodsem2"]);
			$src_nominal161 = (empty(htmlspecialchars($_POST["smp_penga_pintodsem2"])) ? '0' : htmlspecialchars($_POST["smp_penga_pintodsem2"]);
			$src_nominal162 = (empty(htmlspecialchars($_POST["smp_serag_pintodsem2"])) ? '0' : htmlspecialchars($_POST["smp_serag_pintodsem2"]);
			
			$_adm154	=	"tkx_penga_pintodsem2_"	.$src_nominal154;
			$_adm155	=	"tkx_kegia_pintodsem2_"	.$src_nominal155;
			$_adm156	=	"tkx_peral_pintodsem2_"	.$src_nominal156;
			$_adm157	=	"tkx_serag_pintodsem2_"	.$src_nominal157;
			$_adm158	=	"tkx_paket_pintodsem2_"	.$src_nominal158;
			$_adm159	=	"sdx_penga_pintodsem2_"	.$src_nominal159;
			$_adm160	=	"sdx_serag_pintodsem2_"	.$src_nominal160;
			$_adm161	=	"smp_penga_pintodsem2_"	.$src_nominal161;
			$_adm162	=	"smp_serag_pintodsem2_"	.$src_nominal162;
			
			//Siswa pindahan ke PG/TK A/TK B semester II
			$src_nominal163 = (empty(htmlspecialchars($_POST["tkx_penga_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["tkx_penga_pinpgtksem2"]);
			$src_nominal164 = (empty(htmlspecialchars($_POST["tkx_kegia_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_pinpgtksem2"]);
			$src_nominal165 = (empty(htmlspecialchars($_POST["tkx_peral_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["tkx_peral_pinpgtksem2"]);
			$src_nominal166 = (empty(htmlspecialchars($_POST["tkx_serag_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["tkx_serag_pinpgtksem2"]);
			$src_nominal167 = (empty(htmlspecialchars($_POST["tkx_paket_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["tkx_paket_pinpgtksem2"]);
			$src_nominal168 = (empty(htmlspecialchars($_POST["sdx_penga_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["sdx_penga_pinpgtksem2"]);
			$src_nominal169 = (empty(htmlspecialchars($_POST["sdx_serag_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["sdx_serag_pinpgtksem2"]);
			$src_nominal170 = (empty(htmlspecialchars($_POST["smp_penga_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["smp_penga_pinpgtksem2"]);
			$src_nominal171 = (empty(htmlspecialchars($_POST["smp_serag_pinpgtksem2"])) ? '0' : htmlspecialchars($_POST["smp_serag_pinpgtksem2"]);
			
			$_adm163	=	"tkx_penga_pinpgtksem2_"	.$src_nominal163;
			$_adm164	=	"tkx_kegia_pinpgtksem2_"	.$src_nominal164;
			$_adm165	=	"tkx_peral_pinpgtksem2_"	.$src_nominal165;
			$_adm166	=	"tkx_serag_pinpgtksem2_"	.$src_nominal166;
			$_adm167	=	"tkx_paket_pinpgtksem2_"	.$src_nominal167;
			$_adm168	=	"sdx_penga_pinpgtksem2_"	.$src_nominal168;
			$_adm169	=	"sdx_serag_pinpgtksem2_"	.$src_nominal169;
			$_adm170	=	"smp_penga_pinpgtksem2_"	.$src_nominal170;
			$_adm171	=	"smp_serag_pinpgtksem2_"	.$src_nominal171;
			
			//Siswa pindahan ke SD 3-4
			$src_nominal172 = (empty(htmlspecialchars($_POST["tkx_penga_pinsd34"])) ? '0' : htmlspecialchars($_POST["tkx_penga_pinsd34"]);
			$src_nominal173 = (empty(htmlspecialchars($_POST["tkx_kegia_pinsd34"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_pinsd34"]);
			$src_nominal174 = (empty(htmlspecialchars($_POST["tkx_peral_pinsd34"])) ? '0' : htmlspecialchars($_POST["tkx_peral_pinsd34"]);
			$src_nominal175 = (empty(htmlspecialchars($_POST["tkx_serag_pinsd34"])) ? '0' : htmlspecialchars($_POST["tkx_serag_pinsd34"]);
			$src_nominal176 = (empty(htmlspecialchars($_POST["tkx_paket_pinsd34"])) ? '0' : htmlspecialchars($_POST["tkx_paket_pinsd34"]);
			$src_nominal177 = (empty(htmlspecialchars($_POST["sdx_penga_pinsd34"])) ? '0' : htmlspecialchars($_POST["sdx_penga_pinsd34"]);
			$src_nominal178 = (empty(htmlspecialchars($_POST["sdx_serag_pinsd34"])) ? '0' : htmlspecialchars($_POST["sdx_serag_pinsd34"]);
			$src_nominal179 = (empty(htmlspecialchars($_POST["smp_penga_pinsd34"])) ? '0' : htmlspecialchars($_POST["smp_penga_pinsd34"]);
			$src_nominal180 = (empty(htmlspecialchars($_POST["smp_serag_pinsd34"])) ? '0' : htmlspecialchars($_POST["smp_serag_pinsd34"]);
			
			$_adm172	=	"tkx_penga_pinsd34_"	.$src_nominal172;
			$_adm173	=	"tkx_kegia_pinsd34_"	.$src_nominal173;
			$_adm174	=	"tkx_peral_pinsd34_"	.$src_nominal174;
			$_adm175	=	"tkx_serag_pinsd34_"	.$src_nominal175;
			$_adm176	=	"tkx_paket_pinsd34_"	.$src_nominal176;
			$_adm177	=	"sdx_penga_pinsd34_"	.$src_nominal177;
			$_adm178	=	"sdx_serag_pinsd34_"	.$src_nominal178;
			$_adm179	=	"smp_penga_pinsd34_"	.$src_nominal179;
			$_adm180	=	"smp_serag_pinsd34_"	.$src_nominal180;
			
			//Siswa pindahan ke SD 5-6
			$src_nominal181 = (empty(htmlspecialchars($_POST["tkx_penga_pinsd56"])) ? '0' : htmlspecialchars($_POST["tkx_penga_pinsd56"]);
			$src_nominal182 = (empty(htmlspecialchars($_POST["tkx_kegia_pinsd56"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_pinsd56"]);
			$src_nominal183 = (empty(htmlspecialchars($_POST["tkx_peral_pinsd56"])) ? '0' : htmlspecialchars($_POST["tkx_peral_pinsd56"]);
			$src_nominal184 = (empty(htmlspecialchars($_POST["tkx_serag_pinsd56"])) ? '0' : htmlspecialchars($_POST["tkx_serag_pinsd56"]);
			$src_nominal185 = (empty(htmlspecialchars($_POST["tkx_paket_pinsd56"])) ? '0' : htmlspecialchars($_POST["tkx_paket_pinsd56"]);
			$src_nominal186 = (empty(htmlspecialchars($_POST["sdx_penga_pinsd56"])) ? '0' : htmlspecialchars($_POST["sdx_penga_pinsd56"]);
			$src_nominal187 = (empty(htmlspecialchars($_POST["sdx_serag_pinsd56"])) ? '0' : htmlspecialchars($_POST["sdx_serag_pinsd56"]);
			$src_nominal188 = (empty(htmlspecialchars($_POST["smp_penga_pinsd56"])) ? '0' : htmlspecialchars($_POST["smp_penga_pinsd56"]);
			$src_nominal189 = (empty(htmlspecialchars($_POST["smp_serag_pinsd56"])) ? '0' : htmlspecialchars($_POST["smp_serag_pinsd56"]);
			
			$_adm181	=	"tkx_penga_pinsd56_"	.$src_nominal181;
			$_adm182	=	"tkx_kegia_pinsd56_"	.$src_nominal182;
			$_adm183	=	"tkx_peral_pinsd56_"	.$src_nominal183;
			$_adm184	=	"tkx_serag_pinsd56_"	.$src_nominal184;
			$_adm185	=	"tkx_paket_pinsd56_"	.$src_nominal185;
			$_adm186	=	"sdx_penga_pinsd56_"	.$src_nominal186;
			$_adm187	=	"sdx_serag_pinsd56_"	.$src_nominal187;
			$_adm188	=	"smp_penga_pinsd56_"	.$src_nominal188;
			$_adm189	=	"smp_serag_pinsd56_"	.$src_nominal189;
			
			//Siswa pindahan ke SMP 8
			$src_nominal190 = (empty(htmlspecialchars($_POST["tkx_penga_pinsmp8"])) ? '0' : htmlspecialchars($_POST["tkx_penga_pinsmp8"]);
			$src_nominal191 = (empty(htmlspecialchars($_POST["tkx_kegia_pinsmp8"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_pinsmp8"]);
			$src_nominal192 = (empty(htmlspecialchars($_POST["tkx_peral_pinsmp8"])) ? '0' : htmlspecialchars($_POST["tkx_peral_pinsmp8"]);
			$src_nominal193 = (empty(htmlspecialchars($_POST["tkx_serag_pinsmp8"])) ? '0' : htmlspecialchars($_POST["tkx_serag_pinsmp8"]);
			$src_nominal194 = (empty(htmlspecialchars($_POST["tkx_paket_pinsmp8"])) ? '0' : htmlspecialchars($_POST["tkx_paket_pinsmp8"]);
			$src_nominal195 = (empty(htmlspecialchars($_POST["sdx_penga_pinsmp8"])) ? '0' : htmlspecialchars($_POST["sdx_penga_pinsmp8"]);
			$src_nominal196 = (empty(htmlspecialchars($_POST["sdx_serag_pinsmp8"])) ? '0' : htmlspecialchars($_POST["sdx_serag_pinsmp8"]);
			$src_nominal197 = (empty(htmlspecialchars($_POST["smp_penga_pinsmp8"])) ? '0' : htmlspecialchars($_POST["smp_penga_pinsmp8"]);
			$src_nominal198 = (empty(htmlspecialchars($_POST["smp_serag_pinsmp8"])) ? '0' : htmlspecialchars($_POST["smp_serag_pinsmp8"]);
			
			$_adm190	=	"tkx_penga_pinsmp8_"	.$src_nominal190;
			$_adm191	=	"tkx_kegia_pinsmp8_"	.$src_nominal191;
			$_adm192	=	"tkx_peral_pinsmp8_"	.$src_nominal192;
			$_adm193	=	"tkx_serag_pinsmp8_"	.$src_nominal193;
			$_adm194	=	"tkx_paket_pinsmp8_"	.$src_nominal194;
			$_adm195	=	"sdx_penga_pinsmp8_"	.$src_nominal195;
			$_adm196	=	"sdx_serag_pinsmp8_"	.$src_nominal196;
			$_adm197	=	"smp_penga_pinsmp8_"	.$src_nominal197;
			$_adm198	=	"smp_serag_pinsmp8_"	.$src_nominal198;
			
			//Siswa pindahan ke SMP 9
			$src_nominal199 = (empty(htmlspecialchars($_POST["tkx_penga_pinsmp9"])) ? '0' : htmlspecialchars($_POST["tkx_penga_pinsmp9"]);
			$src_nominal200 = (empty(htmlspecialchars($_POST["tkx_kegia_pinsmp9"])) ? '0' : htmlspecialchars($_POST["tkx_kegia_pinsmp9"]);
			$src_nominal201 = (empty(htmlspecialchars($_POST["tkx_peral_pinsmp9"])) ? '0' : htmlspecialchars($_POST["tkx_peral_pinsmp9"]);
			$src_nominal202 = (empty(htmlspecialchars($_POST["tkx_serag_pinsmp9"])) ? '0' : htmlspecialchars($_POST["tkx_serag_pinsmp9"]);
			$src_nominal203 = (empty(htmlspecialchars($_POST["tkx_paket_pinsmp9"])) ? '0' : htmlspecialchars($_POST["tkx_paket_pinsmp9"]);
			$src_nominal204 = (empty(htmlspecialchars($_POST["sdx_penga_pinsmp9"])) ? '0' : htmlspecialchars($_POST["sdx_penga_pinsmp9"]);
			$src_nominal205 = (empty(htmlspecialchars($_POST["sdx_serag_pinsmp9"])) ? '0' : htmlspecialchars($_POST["sdx_serag_pinsmp9"]);
			$src_nominal206 = (empty(htmlspecialchars($_POST["smp_penga_pinsmp9"])) ? '0' : htmlspecialchars($_POST["smp_penga_pinsmp9"]);
			$src_nominal207 = (empty(htmlspecialchars($_POST["smp_serag_pinsmp9"])) ? '0' : htmlspecialchars($_POST["smp_serag_pinsmp9"]);
			
			$_adm199	=	"tkx_penga_pinsmp9_"	.$src_nominal199;
			$_adm200	=	"tkx_kegia_pinsmp9_"	.$src_nominal200;
			$_adm201	=	"tkx_peral_pinsmp9_"	.$src_nominal201;
			$_adm202	=	"tkx_serag_pinsmp9_"	.$src_nominal202;
			$_adm203	=	"tkx_paket_pinsmp9_"	.$src_nominal203;
			$_adm204	=	"sdx_penga_pinsmp9_"	.$src_nominal204;
			$_adm205	=	"sdx_serag_pinsmp9_"	.$src_nominal205;
			$_adm206	=	"smp_penga_pinsmp9_"	.$src_nominal206;
			$_adm207	=	"smp_serag_pinsmp9_"	.$src_nominal207;
			
			// One more time that i have to use an array to send this variables easily.
			$src_input = array(
								//Umum
								$_adm1,$_adm2,$_adm3,$_adm4,$_adm5,$_adm6,$_adm7,$_adm8,$_adm9,
								//Bersamaan dengan saudara kandung
								$_adm10,$_adm11,$_adm12,$_adm13,$_adm14,$_adm15,$_adm16,$_adm17,$_adm18,
								//Memiliki Saudara Kandung
								$_adm19,$_adm20,$_adm21,$_adm22,$_adm23,$_adm24,$_adm25,$_adm26,$_adm27,
								//Umum Grade B
								$_adm28,$_adm29,$_adm30,$_adm31,$_adm32,$_adm33,$_adm34,$_adm35,$_adm36,
								//Umum memiliki Saudara Kandung di SMP + Grade B
								$_adm37,$_adm38,$_adm39,$_adm40,$_adm41,$_adm42,$_adm43,$_adm44,$_adm45,
								//Asal Darbi
								$_adm46,$_adm47,$_adm48,$_adm49,$_adm50,$_adm51,$_adm52,$_adm53,$_adm54,
								//Asal Darbi + Grade A
								$_adm55,$_adm56,$_adm57,$_adm58,$_adm59,$_adm60,$_adm61,$_adm62,$_adm63,
								//Asal Darbi + Grade B
								$_adm64,$_adm65,$_adm66,$_adm67,$_adm68,$_adm69,$_adm70,$_adm71,$_adm72,
								//Anak Pegawai ke-1
								$_adm73,$_adm74,$_adm75,$_adm76,$_adm77,$_adm78,$_adm79,$_adm80,$_adm81,
								//Anak Pegawai ke-2
								$_adm82,$_adm83,$_adm84,$_adm85,$_adm86,$_adm87,$_adm88,$_adm89,$_adm90,
								//Anak Pegawai ke-3, dst
								$_adm91,$_adm92,$_adm93,$_adm94,$_adm95,$_adm96,$_adm97,$_adm98,$_adm99,
								//Anak Pegawai ke-1 + Grade A
								$_adm100,$_adm101,$_adm102,$_adm103,$_adm104,$_adm105,$_adm106,$_adm107,$_adm108,
								//Anak Pegawai ke-1 + Grade B
								$_adm109,$_adm110,$_adm111,$_adm112,$_adm113,$_adm114,$_adm115,$_adm116,$_adm117,
								//Anak Pegawai ke-2 + Grade A
								$_adm118,$_adm119,$_adm120,$_adm121,$_adm122,$_adm123,$_adm124,$_adm125,$_adm126,
								//Anak Pegawai ke-2 + Grade B
								$_adm127,$_adm128,$_adm129,$_adm130,$_adm131,$_adm132,$_adm133,$_adm134,$_adm135,
								//Anak Pegawai ke-3, dst + Grade A
								$_adm136,$_adm137,$_adm138,$_adm139,$_adm140,$_adm141,$_adm142,$_adm143,$_adm144,
								//Anak Pegawai ke-3, dst + Grade B
								$_adm145,$_adm146,$_adm147,$_adm148,$_adm149,$_adm150,$_adm151,$_adm152,$_adm153,
								//Siswa pindahan ke toddler semester II
								$_adm154,$_adm155,$_adm156,$_adm157,$_adm158,$_adm159,$_adm160,$_adm161,$_adm162,
								//Siswa pindahan ke PG/TK A/TK B semester II
								$_adm163,$_adm164,$_adm165,$_adm166,$_adm167,$_adm168,$_adm169,$_adm170,$_adm171,
								//Siswa pindahan ke SD 3-4
								$_adm172,$_adm173,$_adm174,$_adm175,$_adm176,$_adm177,$_adm178,$_adm179,$_adm180,
								//Siswa pindahan ke SD 5-6
								$_adm181,$_adm182,$_adm183,$_adm184,$_adm185,$_adm186,$_adm187,$_adm188,$_adm189,
								//Siswa pindahan ke SMP 8
								$_adm190,$_adm191,$_adm192,$_adm193,$_adm194,$_adm195,$_adm196,$_adm197,$_adm198,
								//Siswa pindahan ke SMP 9
								$_adm199,$_adm200,$_adm201,$_adm202,$_adm203,$_adm204,$_adm205,$_adm206,$_adm207,
								);
			
			//We have to know how many time the looping has to run.
			//So we have to set it AS MANY as variable we have from the form.					
			$data_size = count($src_input);
			
			//here is the looping 			
			for($i = 0; $i<$data_size; $i++) {
			
				//In the next process, this data will be used depand on each level. So we have to seperate it, between the level and the value before insertion process. Okehhhh???
				//like this i think...
				$cur_data		= $src_input[$i];
				$data_explode	= explode("_",$cur_data);
				
				//we would like to insert the level value in tk,sd and smp format, so let's define it
				$src_level			= $data_explode[0];	
				if($src_level == "tkx")	{ $the_level = "tk"; } else if($src_level == "sdx")	{ $the_level = "sd"; } else if($src_level == "smp")	{ $the_level = "smp"; }
				
				$the_cat_adm 		= $data_explode[1];
				$the_set_cat_adm 	= $data_explode[2];
				$the_nominal	 	= $data_explode[3];
				
				$enc_periode		= mysql_real_escape_string($period);
				$enc_level			= mysql_real_escape_string($src_level);
				$enc_cat_adm		= mysql_real_escape_string($the_cat_adm);
				$enc_set_cat_adm	= mysql_real_escape_string($the_set_cat_adm);
				$enc_nominal		= mysql_real_escape_string($the_nominal);
				
				//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
				//make sure that period and level is not empty
				$src_spp	= "insert into set_cat_adm_bi_ma (periode,level,cat_adm,set_cat_adm,nominal) values ('$enc_periode','$enc_level','$enc_cat_adm','$enc_set_cat_adm','$enc_nominal')";
				$query_spp	= mysqli_query($mysql_connect, $src_spp) or die ("There is an error with mysql: ".mysql_error());
				
				if($query_spp) {
					//---------------------------------------
					//here are variables that used in log.php
					include_once("include/url.php");
					$activity	= "Set SPP value";
					$url		= curPageURL();
					$id			= $_SESSION["id"];
					$need_log	= true;
					include_once("include/log.php");
					//---------------------------------------
					
					$redirect_path	= "";
					$redirect_icon	= "images/icon_true.png";
					$redirect_url	= "mainpage.php?pl=spp_tk_setting";
					$redirect_text	= "Categori administrasi utnuk periode $periode sudah disimpan";
					
					$need_redirect	= true;
					include_once ("include/redirect.php");
				}
			}
		}
	} else {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=spp_tk_setting";
		$redirect_text	= "Periode tidak boleh kosong. silahkan lengkapi kembali";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	}
}
?>