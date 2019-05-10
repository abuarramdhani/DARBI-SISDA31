<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	//these data taken from page_seeting_spp.php
	$periode		= htmlspecialchars($_POST["periode"]);
	
	//You are the lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
	//make sure that period is not empty
		
	if(!empty($periode)) {
		//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
		//So here we will make a filter to avoid data duplication.
		//Check if the new data already exist in database.
		//Only one data has to be checked here: period
			
		$src_check_exist	= "select * from set_cat_adm_bi_ma where periode = '$periode'";
		$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
		$num_check_exist	= mysql_num_rows($query_check_exist);
			
		//tell admin if the data already exist
		if($num_check_exist != 0) {
				
			$redirect_path	= "";
			$redirect_icon	= "images/icon_false.png";
			$redirect_url	= "mainpage.php?pl=cat_adm_bi_ma_setting";
			$redirect_text	= "Mohon maaf, pengaturan Kategori Administrasi Biaya Masuk untuk tahun ajaran $periode sudah dilakukan. <br>Silahkan lakukan proses edit untuk melakukan perubahan nilai.";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
			
		} else {
			//if the data hasnt be defined, go ahead.
			///////////////////////////////////////////////////////////////	
			
			
			
			//Please do not laugh about the varible name that i've made
			//I couldnt find the better one
			//check whether the "nominal" variable empty or not
			//it may not be empty
			
			//I really wanna kill my self facing this crazy variableeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeessssssssssssssssssssssssss
			
			//Umum (umum)
			$src_nominal1 	= htmlspecialchars($_POST["tod_penga_umum"]);			
			$src_nominal2 	= htmlspecialchars($_POST["pgx_penga_umum"]);
			$src_nominal3 	= htmlspecialchars($_POST["pgx_kegia_umum"]);
			$src_nominal4 	= htmlspecialchars($_POST["pgx_peral_umum"]);
			$src_nominal5 	= htmlspecialchars($_POST["pgx_serag_umum"]);
			$src_nominal6 	= htmlspecialchars($_POST["pgx_paket_umum"]);			
			$src_nominal7 	= htmlspecialchars($_POST["tka_penga_umum"]);
			$src_nominal8 	= htmlspecialchars($_POST["tka_kegia_umum"]);
			$src_nominal9 	= htmlspecialchars($_POST["tka_peral_umum"]);
			$src_nominal10 	= htmlspecialchars($_POST["tka_serag_umum"]);
			$src_nominal11 	= htmlspecialchars($_POST["tka_paket_umum"]);			
			$src_nominal12 	= htmlspecialchars($_POST["tkb_penga_umum"]);
			$src_nominal13 	= htmlspecialchars($_POST["tkb_kegia_umum"]);
			$src_nominal14 	= htmlspecialchars($_POST["tkb_peral_umum"]);
			$src_nominal15 	= htmlspecialchars($_POST["tkb_serag_umum"]);
			$src_nominal16 	= htmlspecialchars($_POST["tkb_paket_umum"]);			
			$src_nominal17 	= htmlspecialchars($_POST["sdx_penga_umum"]);
			$src_nominal18 	= htmlspecialchars($_POST["sdx_serag_umum"]);			
			$src_nominal19	= htmlspecialchars($_POST["smp_penga_umum"]);
			$src_nominal20 	= htmlspecialchars($_POST["smp_serag_umum"]);
			
			$_adm1	=	"tod_penga_umum_"	.$src_nominal1;			
			$_adm2	=	"pgx_penga_umum_"	.$src_nominal2;
			$_adm3	=	"pgx_kegia_umum_"	.$src_nominal3;
			$_adm4	=	"pgx_peral_umum_"	.$src_nominal4;
			$_adm5	=	"pgx_serag_umum_"	.$src_nominal5;
			$_adm6	=	"pgx_paket_umum_"	.$src_nominal6;			
			$_adm7	=	"tka_penga_umum_"	.$src_nominal7;
			$_adm8	=	"tka_kegia_umum_"	.$src_nominal8;
			$_adm9	=	"tka_peral_umum_"	.$src_nominal9;
			$_adm10	=	"tka_serag_umum_"	.$src_nominal10;
			$_adm11	=	"tka_paket_umum_"	.$src_nominal11;			
			$_adm12	=	"tkb_penga_umum_"	.$src_nominal12;
			$_adm13	=	"tkb_kegia_umum_"	.$src_nominal13;
			$_adm14	=	"tkb_peral_umum_"	.$src_nominal14;
			$_adm15	=	"tkb_serag_umum_"	.$src_nominal15;
			$_adm16	=	"tkb_paket_umum_"	.$src_nominal16;			
			$_adm17	=	"sdx_penga_umum_"	.$src_nominal17;
			$_adm18	=	"sdx_serag_umum_"	.$src_nominal18;			
			$_adm19	=	"smp_penga_umum_"	.$src_nominal19;
			$_adm20	=	"smp_serag_umum_"	.$src_nominal20;			
			
			//Bersamaan dengan saudara kandung (berdesaukan)
			$src_nominal21 	= htmlspecialchars($_POST["tod_penga_berdesaukan"]);			
			$src_nominal22 	= htmlspecialchars($_POST["pgx_penga_berdesaukan"]);
			$src_nominal23 	= htmlspecialchars($_POST["pgx_kegia_berdesaukan"]);
			$src_nominal24 	= htmlspecialchars($_POST["pgx_peral_berdesaukan"]);
			$src_nominal25 	= htmlspecialchars($_POST["pgx_serag_berdesaukan"]);
			$src_nominal26 	= htmlspecialchars($_POST["pgx_paket_berdesaukan"]);			
			$src_nominal27 	= htmlspecialchars($_POST["tka_penga_berdesaukan"]);
			$src_nominal28 	= htmlspecialchars($_POST["tka_kegia_berdesaukan"]);
			$src_nominal29 	= htmlspecialchars($_POST["tka_peral_berdesaukan"]);
			$src_nominal30 	= htmlspecialchars($_POST["tka_serag_berdesaukan"]);
			$src_nominal31 	= htmlspecialchars($_POST["tka_paket_berdesaukan"]);			
			$src_nominal32 	= htmlspecialchars($_POST["tkb_penga_berdesaukan"]);
			$src_nominal33 	= htmlspecialchars($_POST["tkb_kegia_berdesaukan"]);
			$src_nominal34 	= htmlspecialchars($_POST["tkb_peral_berdesaukan"]);
			$src_nominal35 	= htmlspecialchars($_POST["tkb_serag_berdesaukan"]);
			$src_nominal36 	= htmlspecialchars($_POST["tkb_paket_berdesaukan"]);			
			$src_nominal37 	= htmlspecialchars($_POST["sdx_penga_berdesaukan"]);
			$src_nominal38 	= htmlspecialchars($_POST["sdx_serag_berdesaukan"]);			
			$src_nominal39	= htmlspecialchars($_POST["smp_penga_berdesaukan"]);
			$src_nominal40 	= htmlspecialchars($_POST["smp_serag_berdesaukan"]);
			
			$_adm21	=	"tod_penga_berdesaukan_"	.$src_nominal21;			
			$_adm22	=	"pgx_penga_berdesaukan_"	.$src_nominal22;
			$_adm23	=	"pgx_kegia_berdesaukan_"	.$src_nominal23;
			$_adm24	=	"pgx_peral_berdesaukan_"	.$src_nominal24;
			$_adm25	=	"pgx_serag_berdesaukan_"	.$src_nominal25;
			$_adm26	=	"pgx_paket_berdesaukan_"	.$src_nominal26;			
			$_adm27	=	"tka_penga_berdesaukan_"	.$src_nominal27;
			$_adm28	=	"tka_kegia_berdesaukan_"	.$src_nominal28;
			$_adm29	=	"tka_peral_berdesaukan_"	.$src_nominal29;
			$_adm30	=	"tka_serag_berdesaukan_"	.$src_nominal30;
			$_adm31	=	"tka_paket_berdesaukan_"	.$src_nominal31;			
			$_adm32	=	"tkb_penga_berdesaukan_"	.$src_nominal32;
			$_adm33	=	"tkb_kegia_berdesaukan_"	.$src_nominal33;
			$_adm34	=	"tkb_peral_berdesaukan_"	.$src_nominal34;
			$_adm35	=	"tkb_serag_berdesaukan_"	.$src_nominal35;
			$_adm36	=	"tkb_paket_berdesaukan_"	.$src_nominal36;			
			$_adm37	=	"sdx_penga_berdesaukan_"	.$src_nominal37;
			$_adm38	=	"sdx_serag_berdesaukan_"	.$src_nominal38;			
			$_adm39	=	"smp_penga_berdesaukan_"	.$src_nominal39;
			$_adm40	=	"smp_serag_berdesaukan_"	.$src_nominal40;
			
			//Memiliki Saudara Kandung (memsaukan)
			$src_nominal41 	= htmlspecialchars($_POST["tod_penga_memsaukan"]);			
			$src_nominal42 	= htmlspecialchars($_POST["pgx_penga_memsaukan"]);
			$src_nominal43 	= htmlspecialchars($_POST["pgx_kegia_memsaukan"]);
			$src_nominal44 	= htmlspecialchars($_POST["pgx_peral_memsaukan"]);
			$src_nominal45 	= htmlspecialchars($_POST["pgx_serag_memsaukan"]);
			$src_nominal46 	= htmlspecialchars($_POST["pgx_paket_memsaukan"]);			
			$src_nominal47 	= htmlspecialchars($_POST["tka_penga_memsaukan"]);
			$src_nominal48 	= htmlspecialchars($_POST["tka_kegia_memsaukan"]);
			$src_nominal49 	= htmlspecialchars($_POST["tka_peral_memsaukan"]);
			$src_nominal50 	= htmlspecialchars($_POST["tka_serag_memsaukan"]);
			$src_nominal51 	= htmlspecialchars($_POST["tka_paket_memsaukan"]);			
			$src_nominal52 	= htmlspecialchars($_POST["tkb_penga_memsaukan"]);
			$src_nominal53 	= htmlspecialchars($_POST["tkb_kegia_memsaukan"]);
			$src_nominal54 	= htmlspecialchars($_POST["tkb_peral_memsaukan"]);
			$src_nominal55 	= htmlspecialchars($_POST["tkb_serag_memsaukan"]);
			$src_nominal56 	= htmlspecialchars($_POST["tkb_paket_memsaukan"]);			
			$src_nominal57 	= htmlspecialchars($_POST["sdx_penga_memsaukan"]);
			$src_nominal58 	= htmlspecialchars($_POST["sdx_serag_memsaukan"]);			
			$src_nominal59	= htmlspecialchars($_POST["smp_penga_memsaukan"]);
			$src_nominal60 	= htmlspecialchars($_POST["smp_serag_memsaukan"]);
			
			$_adm41	=	"tod_penga_memsaukan_"	.$src_nominal41;			
			$_adm42	=	"pgx_penga_memsaukan_"	.$src_nominal42;
			$_adm43	=	"pgx_kegia_memsaukan_"	.$src_nominal43;
			$_adm44	=	"pgx_peral_memsaukan_"	.$src_nominal44;
			$_adm45	=	"pgx_serag_memsaukan_"	.$src_nominal45;
			$_adm46	=	"pgx_paket_memsaukan_"	.$src_nominal46;			
			$_adm47	=	"tka_penga_memsaukan_"	.$src_nominal47;
			$_adm48	=	"tka_kegia_memsaukan_"	.$src_nominal48;
			$_adm49	=	"tka_peral_memsaukan_"	.$src_nominal49;
			$_adm50	=	"tka_serag_memsaukan_"	.$src_nominal50;
			$_adm51	=	"tka_paket_memsaukan_"	.$src_nominal51;			
			$_adm52	=	"tkb_penga_memsaukan_"	.$src_nominal52;
			$_adm53	=	"tkb_kegia_memsaukan_"	.$src_nominal53;
			$_adm54	=	"tkb_peral_memsaukan_"	.$src_nominal54;
			$_adm55	=	"tkb_serag_memsaukan_"	.$src_nominal55;
			$_adm56	=	"tkb_paket_memsaukan_"	.$src_nominal56;			
			$_adm57	=	"sdx_penga_memsaukan_"	.$src_nominal57;
			$_adm58	=	"sdx_serag_memsaukan_"	.$src_nominal58;			
			$_adm59	=	"smp_penga_memsaukan_"	.$src_nominal59;
			$_adm60	=	"smp_serag_memsaukan_"	.$src_nominal60;
			
			//Umum Grade B (umgrab)
			$src_nominal61 	= htmlspecialchars($_POST["tod_penga_umgrab"]);			
			$src_nominal62 	= htmlspecialchars($_POST["pgx_penga_umgrab"]);
			$src_nominal63 	= htmlspecialchars($_POST["pgx_kegia_umgrab"]);
			$src_nominal64 	= htmlspecialchars($_POST["pgx_peral_umgrab"]);
			$src_nominal65 	= htmlspecialchars($_POST["pgx_serag_umgrab"]);
			$src_nominal66 	= htmlspecialchars($_POST["pgx_paket_umgrab"]);			
			$src_nominal67 	= htmlspecialchars($_POST["tka_penga_umgrab"]);
			$src_nominal68 	= htmlspecialchars($_POST["tka_kegia_umgrab"]);
			$src_nominal69 	= htmlspecialchars($_POST["tka_peral_umgrab"]);
			$src_nominal70 	= htmlspecialchars($_POST["tka_serag_umgrab"]);
			$src_nominal71 	= htmlspecialchars($_POST["tka_paket_umgrab"]);			
			$src_nominal72 	= htmlspecialchars($_POST["tkb_penga_umgrab"]);
			$src_nominal73 	= htmlspecialchars($_POST["tkb_kegia_umgrab"]);
			$src_nominal74 	= htmlspecialchars($_POST["tkb_peral_umgrab"]);
			$src_nominal75 	= htmlspecialchars($_POST["tkb_serag_umgrab"]);
			$src_nominal76 	= htmlspecialchars($_POST["tkb_paket_umgrab"]);			
			$src_nominal77 	= htmlspecialchars($_POST["sdx_penga_umgrab"]);
			$src_nominal78 	= htmlspecialchars($_POST["sdx_serag_umgrab"]);			
			$src_nominal79	= htmlspecialchars($_POST["smp_penga_umgrab"]);
			$src_nominal80 	= htmlspecialchars($_POST["smp_serag_umgrab"]);
			
			$_adm61	=	"tod_penga_umgrab_"	.$src_nominal61;			
			$_adm62	=	"pgx_penga_umgrab_"	.$src_nominal62;
			$_adm63	=	"pgx_kegia_umgrab_"	.$src_nominal63;
			$_adm64	=	"pgx_peral_umgrab_"	.$src_nominal64;
			$_adm65	=	"pgx_serag_umgrab_"	.$src_nominal65;
			$_adm66	=	"pgx_paket_umgrab_"	.$src_nominal66;			
			$_adm67	=	"tka_penga_umgrab_"	.$src_nominal67;
			$_adm68	=	"tka_kegia_umgrab_"	.$src_nominal68;
			$_adm69	=	"tka_peral_umgrab_"	.$src_nominal69;
			$_adm70	=	"tka_serag_umgrab_"	.$src_nominal70;
			$_adm71	=	"tka_paket_umgrab_"	.$src_nominal71;			
			$_adm72	=	"tkb_penga_umgrab_"	.$src_nominal72;
			$_adm73	=	"tkb_kegia_umgrab_"	.$src_nominal73;
			$_adm74	=	"tkb_peral_umgrab_"	.$src_nominal74;
			$_adm75	=	"tkb_serag_umgrab_"	.$src_nominal75;
			$_adm76	=	"tkb_paket_umgrab_"	.$src_nominal76;			
			$_adm77	=	"sdx_penga_umgrab_"	.$src_nominal77;
			$_adm78	=	"sdx_serag_umgrab_"	.$src_nominal78;			
			$_adm79	=	"smp_penga_umgrab_"	.$src_nominal79;
			$_adm80	=	"smp_serag_umgrab_"	.$src_nominal80;
			
			//Umum memiliki Saudara Kandung + Grade B (umskgrab)
			$src_nominal81 		= htmlspecialchars($_POST["tod_penga_umskgrab"]);			
			$src_nominal82 		= htmlspecialchars($_POST["pgx_penga_umskgrab"]);
			$src_nominal83 		= htmlspecialchars($_POST["pgx_kegia_umskgrab"]);
			$src_nominal84 		= htmlspecialchars($_POST["pgx_peral_umskgrab"]);
			$src_nominal85 		= htmlspecialchars($_POST["pgx_serag_umskgrab"]);
			$src_nominal86 		= htmlspecialchars($_POST["pgx_paket_umskgrab"]);			
			$src_nominal87 		= htmlspecialchars($_POST["tka_penga_umskgrab"]);
			$src_nominal88 		= htmlspecialchars($_POST["tka_kegia_umskgrab"]);
			$src_nominal89 		= htmlspecialchars($_POST["tka_peral_umskgrab"]);
			$src_nominal90 		= htmlspecialchars($_POST["tka_serag_umskgrab"]);
			$src_nominal91 		= htmlspecialchars($_POST["tka_paket_umskgrab"]);			
			$src_nominal92 		= htmlspecialchars($_POST["tkb_penga_umskgrab"]);
			$src_nominal93 		= htmlspecialchars($_POST["tkb_kegia_umskgrab"]);
			$src_nominal94 		= htmlspecialchars($_POST["tkb_peral_umskgrab"]);
			$src_nominal95 		= htmlspecialchars($_POST["tkb_serag_umskgrab"]);
			$src_nominal96 		= htmlspecialchars($_POST["tkb_paket_umskgrab"]);			
			$src_nominal97 		= htmlspecialchars($_POST["sdx_penga_umskgrab"]);
			$src_nominal98 		= htmlspecialchars($_POST["sdx_serag_umskgrab"]);			
			$src_nominal99		= htmlspecialchars($_POST["smp_penga_umskgrab"]);
			$src_nominal100 	= htmlspecialchars($_POST["smp_serag_umskgrab"]);
			
			$_adm81		=	"tod_penga_umskgrab_"	.$src_nominal81;			
			$_adm82		=	"pgx_penga_umskgrab_"	.$src_nominal82;
			$_adm83		=	"pgx_kegia_umskgrab_"	.$src_nominal83;
			$_adm84		=	"pgx_peral_umskgrab_"	.$src_nominal84;
			$_adm85		=	"pgx_serag_umskgrab_"	.$src_nominal85;
			$_adm86		=	"pgx_paket_umskgrab_"	.$src_nominal86;			
			$_adm87		=	"tka_penga_umskgrab_"	.$src_nominal87;
			$_adm88		=	"tka_kegia_umskgrab_"	.$src_nominal88;
			$_adm89		=	"tka_peral_umskgrab_"	.$src_nominal89;
			$_adm90		=	"tka_serag_umskgrab_"	.$src_nominal90;
			$_adm91		=	"tka_paket_umskgrab_"	.$src_nominal91;			
			$_adm92		=	"tkb_penga_umskgrab_"	.$src_nominal92;
			$_adm93		=	"tkb_kegia_umskgrab_"	.$src_nominal93;
			$_adm94		=	"tkb_peral_umskgrab_"	.$src_nominal94;
			$_adm95		=	"tkb_serag_umskgrab_"	.$src_nominal95;
			$_adm96		=	"tkb_paket_umskgrab_"	.$src_nominal96;			
			$_adm97		=	"sdx_penga_umskgrab_"	.$src_nominal97;
			$_adm98		=	"sdx_serag_umskgrab_"	.$src_nominal98;			
			$_adm99		=	"smp_penga_umskgrab_"	.$src_nominal99;
			$_adm100	=	"smp_serag_umskgrab_"	.$src_nominal100;
			
			//Umum bersamaan dengan saudara kandung + Grade B (ubdsgrab)
			$src_nominal101 	= htmlspecialchars($_POST["tod_penga_ubdskgrab"]);			
			$src_nominal102 	= htmlspecialchars($_POST["pgx_penga_ubdskgrab"]);
			$src_nominal103 	= htmlspecialchars($_POST["pgx_kegia_ubdskgrab"]);
			$src_nominal104 	= htmlspecialchars($_POST["pgx_peral_ubdskgrab"]);
			$src_nominal105 	= htmlspecialchars($_POST["pgx_serag_ubdskgrab"]);
			$src_nominal106 	= htmlspecialchars($_POST["pgx_paket_ubdskgrab"]);			
			$src_nominal107 	= htmlspecialchars($_POST["tka_penga_ubdskgrab"]);
			$src_nominal108 	= htmlspecialchars($_POST["tka_kegia_ubdskgrab"]);
			$src_nominal109 	= htmlspecialchars($_POST["tka_peral_ubdskgrab"]);
			$src_nominal110 	= htmlspecialchars($_POST["tka_serag_ubdskgrab"]);
			$src_nominal111		= htmlspecialchars($_POST["tka_paket_ubdskgrab"]);			
			$src_nominal112 	= htmlspecialchars($_POST["tkb_penga_ubdskgrab"]);
			$src_nominal113 	= htmlspecialchars($_POST["tkb_kegia_ubdskgrab"]);
			$src_nominal114 	= htmlspecialchars($_POST["tkb_peral_ubdskgrab"]);
			$src_nominal115 	= htmlspecialchars($_POST["tkb_serag_ubdskgrab"]);
			$src_nominal116 	= htmlspecialchars($_POST["tkb_paket_ubdskgrab"]);			
			$src_nominal117 	= htmlspecialchars($_POST["sdx_penga_ubdskgrab"]);
			$src_nominal118 	= htmlspecialchars($_POST["sdx_serag_ubdskgrab"]);			
			$src_nominal119		= htmlspecialchars($_POST["smp_penga_ubdskgrab"]);
			$src_nominal120 	= htmlspecialchars($_POST["smp_serag_ubdskgrab"]);
			
			$_adm101	=	"tod_penga_ubdskgrab_"	.$src_nominal101;			
			$_adm102	=	"pgx_penga_ubdskgrab_"	.$src_nominal102;
			$_adm103	=	"pgx_kegia_ubdskgrab_"	.$src_nominal103;
			$_adm104	=	"pgx_peral_ubdskgrab_"	.$src_nominal104;
			$_adm105	=	"pgx_serag_ubdskgrab_"	.$src_nominal105;
			$_adm106	=	"pgx_paket_ubdskgrab_"	.$src_nominal106;			
			$_adm107	=	"tka_penga_ubdskgrab_"	.$src_nominal107;
			$_adm108	=	"tka_kegia_ubdskgrab_"	.$src_nominal108;
			$_adm109	=	"tka_peral_ubdskgrab_"	.$src_nominal109;
			$_adm110	=	"tka_serag_ubdskgrab_"	.$src_nominal110;
			$_adm111	=	"tka_paket_ubdskgrab_"	.$src_nominal111;			
			$_adm112	=	"tkb_penga_ubdskgrab_"	.$src_nominal112;
			$_adm113	=	"tkb_kegia_ubdskgrab_"	.$src_nominal113;
			$_adm114	=	"tkb_peral_ubdskgrab_"	.$src_nominal114;
			$_adm115	=	"tkb_serag_ubdskgrab_"	.$src_nominal115;
			$_adm116	=	"tkb_paket_ubdskgrab_"	.$src_nominal116;			
			$_adm117	=	"sdx_penga_ubdskgrab_"	.$src_nominal117;
			$_adm118	=	"sdx_serag_ubdskgrab_"	.$src_nominal118;			
			$_adm119	=	"smp_penga_ubdskgrab_"	.$src_nominal119;
			$_adm120	=	"smp_serag_ubdskgrab_"	.$src_nominal120;
			
			//Asal Darbi (asdar)
			$src_nominal121 	= htmlspecialchars($_POST["tod_penga_asdar"]);			
			$src_nominal122 	= htmlspecialchars($_POST["pgx_penga_asdar"]);
			$src_nominal123 	= htmlspecialchars($_POST["pgx_kegia_asdar"]);
			$src_nominal124 	= htmlspecialchars($_POST["pgx_peral_asdar"]);
			$src_nominal125 	= htmlspecialchars($_POST["pgx_serag_asdar"]);
			$src_nominal126		= htmlspecialchars($_POST["pgx_paket_asdar"]);			
			$src_nominal127 	= htmlspecialchars($_POST["tka_penga_asdar"]);
			$src_nominal128 	= htmlspecialchars($_POST["tka_kegia_asdar"]);
			$src_nominal129		= htmlspecialchars($_POST["tka_peral_asdar"]);
			$src_nominal130 	= htmlspecialchars($_POST["tka_serag_asdar"]);
			$src_nominal131		= htmlspecialchars($_POST["tka_paket_asdar"]);			
			$src_nominal132 	= htmlspecialchars($_POST["tkb_penga_asdar"]);
			$src_nominal133		= htmlspecialchars($_POST["tkb_kegia_asdar"]);
			$src_nominal134 	= htmlspecialchars($_POST["tkb_peral_asdar"]);
			$src_nominal135		= htmlspecialchars($_POST["tkb_serag_asdar"]);
			$src_nominal136 	= htmlspecialchars($_POST["tkb_paket_asdar"]);			
			$src_nominal137		= htmlspecialchars($_POST["sdx_penga_asdar"]);
			$src_nominal138		= htmlspecialchars($_POST["sdx_serag_asdar"]);			
			$src_nominal139		= htmlspecialchars($_POST["smp_penga_asdar"]);
			$src_nominal140 	= htmlspecialchars($_POST["smp_serag_asdar"]);
			
			$_adm121	=	"tod_penga_asdar_"	.$src_nominal121;			
			$_adm122	=	"pgx_penga_asdar_"	.$src_nominal122;
			$_adm123	=	"pgx_kegia_asdar_"	.$src_nominal123;
			$_adm124	=	"pgx_peral_asdar_"	.$src_nominal124;
			$_adm125	=	"pgx_serag_asdar_"	.$src_nominal125;
			$_adm126	=	"pgx_paket_asdar_"	.$src_nominal126;			
			$_adm127	=	"tka_penga_asdar_"	.$src_nominal127;
			$_adm128	=	"tka_kegia_asdar_"	.$src_nominal128;
			$_adm129	=	"tka_peral_asdar_"	.$src_nominal129;
			$_adm130	=	"tka_serag_asdar_"	.$src_nominal130;
			$_adm131	=	"tka_paket_asdar_"	.$src_nominal131;			
			$_adm132	=	"tkb_penga_asdar_"	.$src_nominal132;
			$_adm133	=	"tkb_kegia_asdar_"	.$src_nominal133;
			$_adm134	=	"tkb_peral_asdar_"	.$src_nominal134;
			$_adm135	=	"tkb_serag_asdar_"	.$src_nominal135;
			$_adm136	=	"tkb_paket_asdar_"	.$src_nominal136;			
			$_adm137	=	"sdx_penga_asdar_"	.$src_nominal137;
			$_adm138	=	"sdx_serag_asdar_"	.$src_nominal138;			
			$_adm139	=	"smp_penga_asdar_"	.$src_nominal139;
			$_adm140	=	"smp_serag_asdar_"	.$src_nominal140;
			
			//Asal Darbi + Grade A (asdargraa)
			$src_nominal141 	= htmlspecialchars($_POST["tod_penga_asdargraa"]);			
			$src_nominal142 	= htmlspecialchars($_POST["pgx_penga_asdargraa"]);
			$src_nominal143 	= htmlspecialchars($_POST["pgx_kegia_asdargraa"]);
			$src_nominal144 	= htmlspecialchars($_POST["pgx_peral_asdargraa"]);
			$src_nominal145 	= htmlspecialchars($_POST["pgx_serag_asdargraa"]);
			$src_nominal146		= htmlspecialchars($_POST["pgx_paket_asdargraa"]);			
			$src_nominal147 	= htmlspecialchars($_POST["tka_penga_asdargraa"]);
			$src_nominal148 	= htmlspecialchars($_POST["tka_kegia_asdargraa"]);
			$src_nominal149		= htmlspecialchars($_POST["tka_peral_asdargraa"]);
			$src_nominal150 	= htmlspecialchars($_POST["tka_serag_asdargraa"]);
			$src_nominal151		= htmlspecialchars($_POST["tka_paket_asdargraa"]);			
			$src_nominal152 	= htmlspecialchars($_POST["tkb_penga_asdargraa"]);
			$src_nominal153		= htmlspecialchars($_POST["tkb_kegia_asdargraa"]);
			$src_nominal154 	= htmlspecialchars($_POST["tkb_peral_asdargraa"]);
			$src_nominal155		= htmlspecialchars($_POST["tkb_serag_asdargraa"]);
			$src_nominal156 	= htmlspecialchars($_POST["tkb_paket_asdargraa"]);			
			$src_nominal157		= htmlspecialchars($_POST["sdx_penga_asdargraa"]);
			$src_nominal158		= htmlspecialchars($_POST["sdx_serag_asdargraa"]);			
			$src_nominal159		= htmlspecialchars($_POST["smp_penga_asdargraa"]);
			$src_nominal160 	= htmlspecialchars($_POST["smp_serag_asdargraa"]);
			
			$_adm141	=	"tod_penga_asdargraa_"	.$src_nominal141;			
			$_adm142	=	"pgx_penga_asdargraa_"	.$src_nominal142;
			$_adm143	=	"pgx_kegia_asdargraa_"	.$src_nominal143;
			$_adm144	=	"pgx_peral_asdargraa_"	.$src_nominal144;
			$_adm145	=	"pgx_serag_asdargraa_"	.$src_nominal145;
			$_adm146	=	"pgx_paket_asdargraa_"	.$src_nominal146;			
			$_adm147	=	"tka_penga_asdargraa_"	.$src_nominal147;
			$_adm148	=	"tka_kegia_asdargraa_"	.$src_nominal148;
			$_adm149	=	"tka_peral_asdargraa_"	.$src_nominal149;
			$_adm150	=	"tka_serag_asdargraa_"	.$src_nominal150;
			$_adm151	=	"tka_paket_asdargraa_"	.$src_nominal151;			
			$_adm152	=	"tkb_penga_asdargraa_"	.$src_nominal152;
			$_adm153	=	"tkb_kegia_asdargraa_"	.$src_nominal153;
			$_adm154	=	"tkb_peral_asdargraa_"	.$src_nominal154;
			$_adm155	=	"tkb_serag_asdargraa_"	.$src_nominal155;
			$_adm156	=	"tkb_paket_asdargraa_"	.$src_nominal156;			
			$_adm157	=	"sdx_penga_asdargraa_"	.$src_nominal157;
			$_adm158	=	"sdx_serag_asdargraa_"	.$src_nominal158;			
			$_adm159	=	"smp_penga_asdargraa_"	.$src_nominal159;
			$_adm160	=	"smp_serag_asdargraa_"	.$src_nominal160;
			
			//Asal Darbi + Grade B (asdargrab)
			$src_nominal161 	= htmlspecialchars($_POST["tod_penga_asdargrab"]);			
			$src_nominal162 	= htmlspecialchars($_POST["pgx_penga_asdargrab"]);
			$src_nominal163 	= htmlspecialchars($_POST["pgx_kegia_asdargrab"]);
			$src_nominal164 	= htmlspecialchars($_POST["pgx_peral_asdargrab"]);
			$src_nominal165 	= htmlspecialchars($_POST["pgx_serag_asdargrab"]);
			$src_nominal166		= htmlspecialchars($_POST["pgx_paket_asdargrab"]);			
			$src_nominal167 	= htmlspecialchars($_POST["tka_penga_asdargrab"]);
			$src_nominal168 	= htmlspecialchars($_POST["tka_kegia_asdargrab"]);
			$src_nominal169		= htmlspecialchars($_POST["tka_peral_asdargrab"]);
			$src_nominal170 	= htmlspecialchars($_POST["tka_serag_asdargrab"]);
			$src_nominal171		= htmlspecialchars($_POST["tka_paket_asdargrab"]);			
			$src_nominal172 	= htmlspecialchars($_POST["tkb_penga_asdargrab"]);
			$src_nominal173		= htmlspecialchars($_POST["tkb_kegia_asdargrab"]);
			$src_nominal174 	= htmlspecialchars($_POST["tkb_peral_asdargrab"]);
			$src_nominal175		= htmlspecialchars($_POST["tkb_serag_asdargrab"]);
			$src_nominal176 	= htmlspecialchars($_POST["tkb_paket_asdargrab"]);			
			$src_nominal177		= htmlspecialchars($_POST["sdx_penga_asdargrab"]);
			$src_nominal178		= htmlspecialchars($_POST["sdx_serag_asdargrab"]);			
			$src_nominal179		= htmlspecialchars($_POST["smp_penga_asdargrab"]);
			$src_nominal180 	= htmlspecialchars($_POST["smp_serag_asdargrab"]);
			
			$_adm161	=	"tod_penga_asdargrab_"	.$src_nominal161;			
			$_adm162	=	"pgx_penga_asdargrab_"	.$src_nominal162;
			$_adm163	=	"pgx_kegia_asdargrab_"	.$src_nominal163;
			$_adm164	=	"pgx_peral_asdargrab_"	.$src_nominal164;
			$_adm165	=	"pgx_serag_asdargrab_"	.$src_nominal165;
			$_adm166	=	"pgx_paket_asdargrab_"	.$src_nominal166;			
			$_adm167	=	"tka_penga_asdargrab_"	.$src_nominal167;
			$_adm168	=	"tka_kegia_asdargrab_"	.$src_nominal168;
			$_adm169	=	"tka_peral_asdargrab_"	.$src_nominal169;
			$_adm170	=	"tka_serag_asdargrab_"	.$src_nominal170;
			$_adm171	=	"tka_paket_asdargrab_"	.$src_nominal171;			
			$_adm172	=	"tkb_penga_asdargrab_"	.$src_nominal172;
			$_adm173	=	"tkb_kegia_asdargrab_"	.$src_nominal173;
			$_adm174	=	"tkb_peral_asdargrab_"	.$src_nominal174;
			$_adm175	=	"tkb_serag_asdargrab_"	.$src_nominal175;
			$_adm176	=	"tkb_paket_asdargrab_"	.$src_nominal176;			
			$_adm177	=	"sdx_penga_asdargrab_"	.$src_nominal177;
			$_adm178	=	"sdx_serag_asdargrab_"	.$src_nominal178;			
			$_adm179	=	"smp_penga_asdargrab_"	.$src_nominal179;
			$_adm180	=	"smp_serag_asdargrab_"	.$src_nominal180;
			
			//Anak Pegawai ke-1 (anpeg1)
			$src_nominal181 	= htmlspecialchars($_POST["tod_penga_anpeg1"]);			
			$src_nominal182 	= htmlspecialchars($_POST["pgx_penga_anpeg1"]);
			$src_nominal183 	= htmlspecialchars($_POST["pgx_kegia_anpeg1"]);
			$src_nominal184 	= htmlspecialchars($_POST["pgx_peral_anpeg1"]);
			$src_nominal185 	= htmlspecialchars($_POST["pgx_serag_anpeg1"]);
			$src_nominal186		= htmlspecialchars($_POST["pgx_paket_anpeg1"]);			
			$src_nominal187 	= htmlspecialchars($_POST["tka_penga_anpeg1"]);
			$src_nominal188 	= htmlspecialchars($_POST["tka_kegia_anpeg1"]);
			$src_nominal189		= htmlspecialchars($_POST["tka_peral_anpeg1"]);
			$src_nominal190 	= htmlspecialchars($_POST["tka_serag_anpeg1"]);
			$src_nominal191		= htmlspecialchars($_POST["tka_paket_anpeg1"]);			
			$src_nominal192 	= htmlspecialchars($_POST["tkb_penga_anpeg1"]);
			$src_nominal193		= htmlspecialchars($_POST["tkb_kegia_anpeg1"]);
			$src_nominal194 	= htmlspecialchars($_POST["tkb_peral_anpeg1"]);
			$src_nominal195		= htmlspecialchars($_POST["tkb_serag_anpeg1"]);
			$src_nominal196 	= htmlspecialchars($_POST["tkb_paket_anpeg1"]);			
			$src_nominal197		= htmlspecialchars($_POST["sdx_penga_anpeg1"]);
			$src_nominal198		= htmlspecialchars($_POST["sdx_serag_anpeg1"]);			
			$src_nominal199		= htmlspecialchars($_POST["smp_penga_anpeg1"]);
			$src_nominal200 	= htmlspecialchars($_POST["smp_serag_anpeg1"]);
			
			$_adm181	=	"tod_penga_anpeg1_"	.$src_nominal181;			
			$_adm182	=	"pgx_penga_anpeg1_"	.$src_nominal182;
			$_adm183	=	"pgx_kegia_anpeg1_"	.$src_nominal183;
			$_adm184	=	"pgx_peral_anpeg1_"	.$src_nominal184;
			$_adm185	=	"pgx_serag_anpeg1_"	.$src_nominal185;
			$_adm186	=	"pgx_paket_anpeg1_"	.$src_nominal186;			
			$_adm187	=	"tka_penga_anpeg1_"	.$src_nominal187;
			$_adm188	=	"tka_kegia_anpeg1_"	.$src_nominal188;
			$_adm189	=	"tka_peral_anpeg1_"	.$src_nominal189;
			$_adm190	=	"tka_serag_anpeg1_"	.$src_nominal190;
			$_adm191	=	"tka_paket_anpeg1_"	.$src_nominal191;			
			$_adm192	=	"tkb_penga_anpeg1_"	.$src_nominal192;
			$_adm193	=	"tkb_kegia_anpeg1_"	.$src_nominal193;
			$_adm194	=	"tkb_peral_anpeg1_"	.$src_nominal194;
			$_adm195	=	"tkb_serag_anpeg1_"	.$src_nominal195;
			$_adm196	=	"tkb_paket_anpeg1_"	.$src_nominal196;			
			$_adm197	=	"sdx_penga_anpeg1_"	.$src_nominal197;
			$_adm198	=	"sdx_serag_anpeg1_"	.$src_nominal198;			
			$_adm199	=	"smp_penga_anpeg1_"	.$src_nominal199;
			$_adm200	=	"smp_serag_anpeg1_"	.$src_nominal200;
			
			//Anak Pegawai ke-2 (anpeg2)
			$src_nominal201 	= htmlspecialchars($_POST["tod_penga_anpeg2"]);			
			$src_nominal202 	= htmlspecialchars($_POST["pgx_penga_anpeg2"]);
			$src_nominal203 	= htmlspecialchars($_POST["pgx_kegia_anpeg2"]);
			$src_nominal204 	= htmlspecialchars($_POST["pgx_peral_anpeg2"]);
			$src_nominal205 	= htmlspecialchars($_POST["pgx_serag_anpeg2"]);
			$src_nominal206		= htmlspecialchars($_POST["pgx_paket_anpeg2"]);			
			$src_nominal207 	= htmlspecialchars($_POST["tka_penga_anpeg2"]);
			$src_nominal208 	= htmlspecialchars($_POST["tka_kegia_anpeg2"]);
			$src_nominal209		= htmlspecialchars($_POST["tka_peral_anpeg2"]);
			$src_nominal210 	= htmlspecialchars($_POST["tka_serag_anpeg2"]);
			$src_nominal211		= htmlspecialchars($_POST["tka_paket_anpeg2"]);			
			$src_nominal212 	= htmlspecialchars($_POST["tkb_penga_anpeg2"]);
			$src_nominal213		= htmlspecialchars($_POST["tkb_kegia_anpeg2"]);
			$src_nominal214 	= htmlspecialchars($_POST["tkb_peral_anpeg2"]);
			$src_nominal215		= htmlspecialchars($_POST["tkb_serag_anpeg2"]);
			$src_nominal216 	= htmlspecialchars($_POST["tkb_paket_anpeg2"]);			
			$src_nominal217		= htmlspecialchars($_POST["sdx_penga_anpeg2"]);
			$src_nominal218		= htmlspecialchars($_POST["sdx_serag_anpeg2"]);			
			$src_nominal219		= htmlspecialchars($_POST["smp_penga_anpeg2"]);
			$src_nominal220 	= htmlspecialchars($_POST["smp_serag_anpeg2"]);
			
			$_adm201	=	"tod_penga_anpeg2_"	.$src_nominal201;			
			$_adm202	=	"pgx_penga_anpeg2_"	.$src_nominal202;
			$_adm203	=	"pgx_kegia_anpeg2_"	.$src_nominal203;
			$_adm204	=	"pgx_peral_anpeg2_"	.$src_nominal204;
			$_adm205	=	"pgx_serag_anpeg2_"	.$src_nominal205;
			$_adm206	=	"pgx_paket_anpeg2_"	.$src_nominal206;			
			$_adm207	=	"tka_penga_anpeg2_"	.$src_nominal207;
			$_adm208	=	"tka_kegia_anpeg2_"	.$src_nominal208;
			$_adm209	=	"tka_peral_anpeg2_"	.$src_nominal209;
			$_adm210	=	"tka_serag_anpeg2_"	.$src_nominal210;
			$_adm211	=	"tka_paket_anpeg2_"	.$src_nominal211;			
			$_adm212	=	"tkb_penga_anpeg2_"	.$src_nominal212;
			$_adm213	=	"tkb_kegia_anpeg2_"	.$src_nominal213;
			$_adm214	=	"tkb_peral_anpeg2_"	.$src_nominal214;
			$_adm215	=	"tkb_serag_anpeg2_"	.$src_nominal215;
			$_adm216	=	"tkb_paket_anpeg2_"	.$src_nominal216;			
			$_adm217	=	"sdx_penga_anpeg2_"	.$src_nominal217;
			$_adm218	=	"sdx_serag_anpeg2_"	.$src_nominal218;			
			$_adm219	=	"smp_penga_anpeg2_"	.$src_nominal219;
			$_adm220	=	"smp_serag_anpeg2_"	.$src_nominal220;
			
			//Anak Pegawai ke-3, dst (anpeg3)
			$src_nominal221 	= htmlspecialchars($_POST["tod_penga_anpeg3"]);			
			$src_nominal222 	= htmlspecialchars($_POST["pgx_penga_anpeg3"]);
			$src_nominal223 	= htmlspecialchars($_POST["pgx_kegia_anpeg3"]);
			$src_nominal224 	= htmlspecialchars($_POST["pgx_peral_anpeg3"]);
			$src_nominal225 	= htmlspecialchars($_POST["pgx_serag_anpeg3"]);
			$src_nominal226		= htmlspecialchars($_POST["pgx_paket_anpeg3"]);			
			$src_nominal227 	= htmlspecialchars($_POST["tka_penga_anpeg3"]);
			$src_nominal228 	= htmlspecialchars($_POST["tka_kegia_anpeg3"]);
			$src_nominal229		= htmlspecialchars($_POST["tka_peral_anpeg3"]);
			$src_nominal230 	= htmlspecialchars($_POST["tka_serag_anpeg3"]);
			$src_nominal231		= htmlspecialchars($_POST["tka_paket_anpeg3"]);			
			$src_nominal232 	= htmlspecialchars($_POST["tkb_penga_anpeg3"]);
			$src_nominal233		= htmlspecialchars($_POST["tkb_kegia_anpeg3"]);
			$src_nominal234 	= htmlspecialchars($_POST["tkb_peral_anpeg3"]);
			$src_nominal235		= htmlspecialchars($_POST["tkb_serag_anpeg3"]);
			$src_nominal236 	= htmlspecialchars($_POST["tkb_paket_anpeg3"]);			
			$src_nominal237		= htmlspecialchars($_POST["sdx_penga_anpeg3"]);
			$src_nominal238		= htmlspecialchars($_POST["sdx_serag_anpeg3"]);			
			$src_nominal239		= htmlspecialchars($_POST["smp_penga_anpeg3"]);
			$src_nominal240 	= htmlspecialchars($_POST["smp_serag_anpeg3"]);
			
			$_adm221	=	"tod_penga_anpeg3_"	.$src_nominal221;			
			$_adm222	=	"pgx_penga_anpeg3_"	.$src_nominal222;
			$_adm223	=	"pgx_kegia_anpeg3_"	.$src_nominal223;
			$_adm224	=	"pgx_peral_anpeg3_"	.$src_nominal224;
			$_adm225	=	"pgx_serag_anpeg3_"	.$src_nominal225;
			$_adm226	=	"pgx_paket_anpeg3_"	.$src_nominal226;			
			$_adm227	=	"tka_penga_anpeg3_"	.$src_nominal227;
			$_adm228	=	"tka_kegia_anpeg3_"	.$src_nominal228;
			$_adm229	=	"tka_peral_anpeg3_"	.$src_nominal229;
			$_adm230	=	"tka_serag_anpeg3_"	.$src_nominal230;
			$_adm231	=	"tka_paket_anpeg3_"	.$src_nominal231;			
			$_adm232	=	"tkb_penga_anpeg3_"	.$src_nominal232;
			$_adm233	=	"tkb_kegia_anpeg3_"	.$src_nominal233;
			$_adm234	=	"tkb_peral_anpeg3_"	.$src_nominal234;
			$_adm235	=	"tkb_serag_anpeg3_"	.$src_nominal235;
			$_adm236	=	"tkb_paket_anpeg3_"	.$src_nominal236;			
			$_adm237	=	"sdx_penga_anpeg3_"	.$src_nominal237;
			$_adm238	=	"sdx_serag_anpeg3_"	.$src_nominal238;			
			$_adm239	=	"smp_penga_anpeg3_"	.$src_nominal239;
			$_adm240	=	"smp_serag_anpeg3_"	.$src_nominal240;
			
			//Anak Pegawai ke-1 + Grade A (anpeg1graa)
			$src_nominal241 	= htmlspecialchars($_POST["tod_penga_anpeg1graa"]);			
			$src_nominal242 	= htmlspecialchars($_POST["pgx_penga_anpeg1graa"]);
			$src_nominal243 	= htmlspecialchars($_POST["pgx_kegia_anpeg1graa"]);
			$src_nominal244 	= htmlspecialchars($_POST["pgx_peral_anpeg1graa"]);
			$src_nominal245 	= htmlspecialchars($_POST["pgx_serag_anpeg1graa"]);
			$src_nominal246		= htmlspecialchars($_POST["pgx_paket_anpeg1graa"]);			
			$src_nominal247 	= htmlspecialchars($_POST["tka_penga_anpeg1graa"]);
			$src_nominal248 	= htmlspecialchars($_POST["tka_kegia_anpeg1graa"]);
			$src_nominal249		= htmlspecialchars($_POST["tka_peral_anpeg1graa"]);
			$src_nominal250 	= htmlspecialchars($_POST["tka_serag_anpeg1graa"]);
			$src_nominal251		= htmlspecialchars($_POST["tka_paket_anpeg1graa"]);			
			$src_nominal252 	= htmlspecialchars($_POST["tkb_penga_anpeg1graa"]);
			$src_nominal253		= htmlspecialchars($_POST["tkb_kegia_anpeg1graa"]);
			$src_nominal254 	= htmlspecialchars($_POST["tkb_peral_anpeg1graa"]);
			$src_nominal255		= htmlspecialchars($_POST["tkb_serag_anpeg1graa"]);
			$src_nominal256 	= htmlspecialchars($_POST["tkb_paket_anpeg1graa"]);			
			$src_nominal257		= htmlspecialchars($_POST["sdx_penga_anpeg1graa"]);
			$src_nominal258		= htmlspecialchars($_POST["sdx_serag_anpeg1graa"]);			
			$src_nominal259		= htmlspecialchars($_POST["smp_penga_anpeg1graa"]);
			$src_nominal260 	= htmlspecialchars($_POST["smp_serag_anpeg1graa"]);
			
			$_adm241	=	"tod_penga_anpeg1graa_"	.$src_nominal241;			
			$_adm242	=	"pgx_penga_anpeg1graa_"	.$src_nominal242;
			$_adm243	=	"pgx_kegia_anpeg1graa_"	.$src_nominal243;
			$_adm244	=	"pgx_peral_anpeg1graa_"	.$src_nominal244;
			$_adm245	=	"pgx_serag_anpeg1graa_"	.$src_nominal245;
			$_adm246	=	"pgx_paket_anpeg1graa_"	.$src_nominal246;			
			$_adm247	=	"tka_penga_anpeg1graa_"	.$src_nominal247;
			$_adm248	=	"tka_kegia_anpeg1graa_"	.$src_nominal248;
			$_adm249	=	"tka_peral_anpeg1graa_"	.$src_nominal249;
			$_adm250	=	"tka_serag_anpeg1graa_"	.$src_nominal250;
			$_adm251	=	"tka_paket_anpeg1graa_"	.$src_nominal251;			
			$_adm252	=	"tkb_penga_anpeg1graa_"	.$src_nominal252;
			$_adm253	=	"tkb_kegia_anpeg1graa_"	.$src_nominal253;
			$_adm254	=	"tkb_peral_anpeg1graa_"	.$src_nominal254;
			$_adm255	=	"tkb_serag_anpeg1graa_"	.$src_nominal255;
			$_adm256	=	"tkb_paket_anpeg1graa_"	.$src_nominal256;			
			$_adm257	=	"sdx_penga_anpeg1graa_"	.$src_nominal257;
			$_adm258	=	"sdx_serag_anpeg1graa_"	.$src_nominal258;			
			$_adm259	=	"smp_penga_anpeg1graa_"	.$src_nominal259;
			$_adm260	=	"smp_serag_anpeg1graa_"	.$src_nominal260;
			
			//Anak Pegawai ke-1 + Grade B (anpeg1grab)
			$src_nominal261 	= htmlspecialchars($_POST["tod_penga_anpeg1grab"]);			
			$src_nominal262 	= htmlspecialchars($_POST["pgx_penga_anpeg1grab"]);
			$src_nominal263 	= htmlspecialchars($_POST["pgx_kegia_anpeg1grab"]);
			$src_nominal264 	= htmlspecialchars($_POST["pgx_peral_anpeg1grab"]);
			$src_nominal265 	= htmlspecialchars($_POST["pgx_serag_anpeg1grab"]);
			$src_nominal266		= htmlspecialchars($_POST["pgx_paket_anpeg1grab"]);			
			$src_nominal267 	= htmlspecialchars($_POST["tka_penga_anpeg1grab"]);
			$src_nominal268 	= htmlspecialchars($_POST["tka_kegia_anpeg1grab"]);
			$src_nominal269		= htmlspecialchars($_POST["tka_peral_anpeg1grab"]);
			$src_nominal270 	= htmlspecialchars($_POST["tka_serag_anpeg1grab"]);
			$src_nominal271		= htmlspecialchars($_POST["tka_paket_anpeg1grab"]);			
			$src_nominal272 	= htmlspecialchars($_POST["tkb_penga_anpeg1grab"]);
			$src_nominal273		= htmlspecialchars($_POST["tkb_kegia_anpeg1grab"]);
			$src_nominal274 	= htmlspecialchars($_POST["tkb_peral_anpeg1grab"]);
			$src_nominal275		= htmlspecialchars($_POST["tkb_serag_anpeg1grab"]);
			$src_nominal276 	= htmlspecialchars($_POST["tkb_paket_anpeg1grab"]);			
			$src_nominal277		= htmlspecialchars($_POST["sdx_penga_anpeg1grab"]);
			$src_nominal278		= htmlspecialchars($_POST["sdx_serag_anpeg1grab"]);			
			$src_nominal279		= htmlspecialchars($_POST["smp_penga_anpeg1grab"]);
			$src_nominal280 	= htmlspecialchars($_POST["smp_serag_anpeg1grab"]);
			
			$_adm261	=	"tod_penga_anpeg1grab_"	.$src_nominal261;			
			$_adm262	=	"pgx_penga_anpeg1grab_"	.$src_nominal262;
			$_adm263	=	"pgx_kegia_anpeg1grab_"	.$src_nominal263;
			$_adm264	=	"pgx_peral_anpeg1grab_"	.$src_nominal264;
			$_adm265	=	"pgx_serag_anpeg1grab_"	.$src_nominal265;
			$_adm266	=	"pgx_paket_anpeg1grab_"	.$src_nominal266;			
			$_adm267	=	"tka_penga_anpeg1grab_"	.$src_nominal267;
			$_adm268	=	"tka_kegia_anpeg1grab_"	.$src_nominal268;
			$_adm269	=	"tka_peral_anpeg1grab_"	.$src_nominal269;
			$_adm270	=	"tka_serag_anpeg1grab_"	.$src_nominal270;
			$_adm271	=	"tka_paket_anpeg1grab_"	.$src_nominal271;			
			$_adm272	=	"tkb_penga_anpeg1grab_"	.$src_nominal272;
			$_adm273	=	"tkb_kegia_anpeg1grab_"	.$src_nominal273;
			$_adm274	=	"tkb_peral_anpeg1grab_"	.$src_nominal274;
			$_adm275	=	"tkb_serag_anpeg1grab_"	.$src_nominal275;
			$_adm276	=	"tkb_paket_anpeg1grab_"	.$src_nominal276;			
			$_adm277	=	"sdx_penga_anpeg1grab_"	.$src_nominal277;
			$_adm278	=	"sdx_serag_anpeg1grab_"	.$src_nominal278;			
			$_adm279	=	"smp_penga_anpeg1grab_"	.$src_nominal279;
			$_adm280	=	"smp_serag_anpeg1grab_"	.$src_nominal280;
			
			//Anak Pegawai ke-2 + Grade A (anpeg2graa)
			$src_nominal281 	= htmlspecialchars($_POST["tod_penga_anpeg2graa"]);			
			$src_nominal282 	= htmlspecialchars($_POST["pgx_penga_anpeg2graa"]);
			$src_nominal283 	= htmlspecialchars($_POST["pgx_kegia_anpeg2graa"]);
			$src_nominal284 	= htmlspecialchars($_POST["pgx_peral_anpeg2graa"]);
			$src_nominal285 	= htmlspecialchars($_POST["pgx_serag_anpeg2graa"]);
			$src_nominal286		= htmlspecialchars($_POST["pgx_paket_anpeg2graa"]);			
			$src_nominal287 	= htmlspecialchars($_POST["tka_penga_anpeg2graa"]);
			$src_nominal288 	= htmlspecialchars($_POST["tka_kegia_anpeg2graa"]);
			$src_nominal289		= htmlspecialchars($_POST["tka_peral_anpeg2graa"]);
			$src_nominal290 	= htmlspecialchars($_POST["tka_serag_anpeg2graa"]);
			$src_nominal291		= htmlspecialchars($_POST["tka_paket_anpeg2graa"]);			
			$src_nominal292 	= htmlspecialchars($_POST["tkb_penga_anpeg2graa"]);
			$src_nominal293		= htmlspecialchars($_POST["tkb_kegia_anpeg2graa"]);
			$src_nominal294 	= htmlspecialchars($_POST["tkb_peral_anpeg2graa"]);
			$src_nominal295		= htmlspecialchars($_POST["tkb_serag_anpeg2graa"]);
			$src_nominal296 	= htmlspecialchars($_POST["tkb_paket_anpeg2graa"]);			
			$src_nominal297		= htmlspecialchars($_POST["sdx_penga_anpeg2graa"]);
			$src_nominal298		= htmlspecialchars($_POST["sdx_serag_anpeg2graa"]);			
			$src_nominal299		= htmlspecialchars($_POST["smp_penga_anpeg2graa"]);
			$src_nominal300 	= htmlspecialchars($_POST["smp_serag_anpeg2graa"]);
			
			$_adm281	=	"tod_penga_anpeg2graa_"	.$src_nominal281;			
			$_adm282	=	"pgx_penga_anpeg2graa_"	.$src_nominal282;
			$_adm283	=	"pgx_kegia_anpeg2graa_"	.$src_nominal283;
			$_adm284	=	"pgx_peral_anpeg2graa_"	.$src_nominal284;
			$_adm285	=	"pgx_serag_anpeg2graa_"	.$src_nominal285;
			$_adm286	=	"pgx_paket_anpeg2graa_"	.$src_nominal286;			
			$_adm287	=	"tka_penga_anpeg2graa_"	.$src_nominal287;
			$_adm288	=	"tka_kegia_anpeg2graa_"	.$src_nominal288;
			$_adm289	=	"tka_peral_anpeg2graa_"	.$src_nominal289;
			$_adm290	=	"tka_serag_anpeg2graa_"	.$src_nominal290;
			$_adm291	=	"tka_paket_anpeg2graa_"	.$src_nominal291;			
			$_adm292	=	"tkb_penga_anpeg2graa_"	.$src_nominal292;
			$_adm293	=	"tkb_kegia_anpeg2graa_"	.$src_nominal293;
			$_adm294	=	"tkb_peral_anpeg2graa_"	.$src_nominal294;
			$_adm295	=	"tkb_serag_anpeg2graa_"	.$src_nominal295;
			$_adm296	=	"tkb_paket_anpeg2graa_"	.$src_nominal296;			
			$_adm297	=	"sdx_penga_anpeg2graa_"	.$src_nominal297;
			$_adm298	=	"sdx_serag_anpeg2graa_"	.$src_nominal298;			
			$_adm299	=	"smp_penga_anpeg2graa_"	.$src_nominal299;
			$_adm300	=	"smp_serag_anpeg2graa_"	.$src_nominal300;
			
			//Anak Pegawai ke-2 + Grade B (anpeg2grab)
			$src_nominal301 	= htmlspecialchars($_POST["tod_penga_anpeg2grab"]);			
			$src_nominal302 	= htmlspecialchars($_POST["pgx_penga_anpeg2grab"]);
			$src_nominal303 	= htmlspecialchars($_POST["pgx_kegia_anpeg2grab"]);
			$src_nominal304 	= htmlspecialchars($_POST["pgx_peral_anpeg2grab"]);
			$src_nominal305 	= htmlspecialchars($_POST["pgx_serag_anpeg2grab"]);
			$src_nominal306		= htmlspecialchars($_POST["pgx_paket_anpeg2grab"]);			
			$src_nominal307 	= htmlspecialchars($_POST["tka_penga_anpeg2grab"]);
			$src_nominal308 	= htmlspecialchars($_POST["tka_kegia_anpeg2grab"]);
			$src_nominal309		= htmlspecialchars($_POST["tka_peral_anpeg2grab"]);
			$src_nominal310 	= htmlspecialchars($_POST["tka_serag_anpeg2grab"]);
			$src_nominal311		= htmlspecialchars($_POST["tka_paket_anpeg2grab"]);			
			$src_nominal312 	= htmlspecialchars($_POST["tkb_penga_anpeg2grab"]);
			$src_nominal313		= htmlspecialchars($_POST["tkb_kegia_anpeg2grab"]);
			$src_nominal314 	= htmlspecialchars($_POST["tkb_peral_anpeg2grab"]);
			$src_nominal315		= htmlspecialchars($_POST["tkb_serag_anpeg2grab"]);
			$src_nominal316 	= htmlspecialchars($_POST["tkb_paket_anpeg2grab"]);			
			$src_nominal317		= htmlspecialchars($_POST["sdx_penga_anpeg2grab"]);
			$src_nominal318		= htmlspecialchars($_POST["sdx_serag_anpeg2grab"]);			
			$src_nominal319		= htmlspecialchars($_POST["smp_penga_anpeg2grab"]);
			$src_nominal320 	= htmlspecialchars($_POST["smp_serag_anpeg2grab"]);
			
			$_adm301	=	"tod_penga_anpeg2grab_"	.$src_nominal301;			
			$_adm302	=	"pgx_penga_anpeg2grab_"	.$src_nominal302;
			$_adm303	=	"pgx_kegia_anpeg2grab_"	.$src_nominal303;
			$_adm304	=	"pgx_peral_anpeg2grab_"	.$src_nominal304;
			$_adm305	=	"pgx_serag_anpeg2grab_"	.$src_nominal305;
			$_adm306	=	"pgx_paket_anpeg2grab_"	.$src_nominal306;			
			$_adm307	=	"tka_penga_anpeg2grab_"	.$src_nominal307;
			$_adm308	=	"tka_kegia_anpeg2grab_"	.$src_nominal308;
			$_adm309	=	"tka_peral_anpeg2grab_"	.$src_nominal309;
			$_adm310	=	"tka_serag_anpeg2grab_"	.$src_nominal310;
			$_adm311	=	"tka_paket_anpeg2grab_"	.$src_nominal311;			
			$_adm312	=	"tkb_penga_anpeg2grab_"	.$src_nominal312;
			$_adm313	=	"tkb_kegia_anpeg2grab_"	.$src_nominal313;
			$_adm314	=	"tkb_peral_anpeg2grab_"	.$src_nominal314;
			$_adm315	=	"tkb_serag_anpeg2grab_"	.$src_nominal315;
			$_adm316	=	"tkb_paket_anpeg2grab_"	.$src_nominal316;			
			$_adm317	=	"sdx_penga_anpeg2grab_"	.$src_nominal317;
			$_adm318	=	"sdx_serag_anpeg2grab_"	.$src_nominal318;			
			$_adm319	=	"smp_penga_anpeg2grab_"	.$src_nominal319;
			$_adm320	=	"smp_serag_anpeg2grab_"	.$src_nominal320;
			
			//Anak Pegawai ke-3, dst + Grade A (anpeg3graa)
			$src_nominal321 	= htmlspecialchars($_POST["tod_penga_anpeg3graa"]);			
			$src_nominal322 	= htmlspecialchars($_POST["pgx_penga_anpeg3graa"]);
			$src_nominal323 	= htmlspecialchars($_POST["pgx_kegia_anpeg3graa"]);
			$src_nominal324 	= htmlspecialchars($_POST["pgx_peral_anpeg3graa"]);
			$src_nominal325 	= htmlspecialchars($_POST["pgx_serag_anpeg3graa"]);
			$src_nominal326		= htmlspecialchars($_POST["pgx_paket_anpeg3graa"]);			
			$src_nominal327 	= htmlspecialchars($_POST["tka_penga_anpeg3graa"]);
			$src_nominal328 	= htmlspecialchars($_POST["tka_kegia_anpeg3graa"]);
			$src_nominal329		= htmlspecialchars($_POST["tka_peral_anpeg3graa"]);
			$src_nominal330 	= htmlspecialchars($_POST["tka_serag_anpeg3graa"]);
			$src_nominal331		= htmlspecialchars($_POST["tka_paket_anpeg3graa"]);			
			$src_nominal332 	= htmlspecialchars($_POST["tkb_penga_anpeg3graa"]);
			$src_nominal333		= htmlspecialchars($_POST["tkb_kegia_anpeg3graa"]);
			$src_nominal334 	= htmlspecialchars($_POST["tkb_peral_anpeg3graa"]);
			$src_nominal335		= htmlspecialchars($_POST["tkb_serag_anpeg3graa"]);
			$src_nominal336 	= htmlspecialchars($_POST["tkb_paket_anpeg3graa"]);			
			$src_nominal337		= htmlspecialchars($_POST["sdx_penga_anpeg3graa"]);
			$src_nominal338		= htmlspecialchars($_POST["sdx_serag_anpeg3graa"]);			
			$src_nominal339		= htmlspecialchars($_POST["smp_penga_anpeg3graa"]);
			$src_nominal340 	= htmlspecialchars($_POST["smp_serag_anpeg3graa"]);
			
			$_adm321	=	"tod_penga_anpeg3graa_"	.$src_nominal321;			
			$_adm322	=	"pgx_penga_anpeg3graa_"	.$src_nominal322;
			$_adm323	=	"pgx_kegia_anpeg3graa_"	.$src_nominal323;
			$_adm324	=	"pgx_peral_anpeg3graa_"	.$src_nominal324;
			$_adm325	=	"pgx_serag_anpeg3graa_"	.$src_nominal325;
			$_adm326	=	"pgx_paket_anpeg3graa_"	.$src_nominal326;			
			$_adm327	=	"tka_penga_anpeg3graa_"	.$src_nominal327;
			$_adm328	=	"tka_kegia_anpeg3graa_"	.$src_nominal328;
			$_adm329	=	"tka_peral_anpeg3graa_"	.$src_nominal329;
			$_adm330	=	"tka_serag_anpeg3graa_"	.$src_nominal330;
			$_adm331	=	"tka_paket_anpeg3graa_"	.$src_nominal331;			
			$_adm332	=	"tkb_penga_anpeg3graa_"	.$src_nominal332;
			$_adm333	=	"tkb_kegia_anpeg3graa_"	.$src_nominal333;
			$_adm334	=	"tkb_peral_anpeg3graa_"	.$src_nominal334;
			$_adm335	=	"tkb_serag_anpeg3graa_"	.$src_nominal335;
			$_adm336	=	"tkb_paket_anpeg3graa_"	.$src_nominal336;			
			$_adm337	=	"sdx_penga_anpeg3graa_"	.$src_nominal337;
			$_adm338	=	"sdx_serag_anpeg3graa_"	.$src_nominal338;			
			$_adm339	=	"smp_penga_anpeg3graa_"	.$src_nominal339;
			$_adm340	=	"smp_serag_anpeg3graa_"	.$src_nominal340;
			
			//Anak Pegawai ke-3, dst + Grade B (anpeg3grab)
			$src_nominal341 	= htmlspecialchars($_POST["tod_penga_anpeg3grab"]);			
			$src_nominal342 	= htmlspecialchars($_POST["pgx_penga_anpeg3grab"]);
			$src_nominal343 	= htmlspecialchars($_POST["pgx_kegia_anpeg3grab"]);
			$src_nominal344 	= htmlspecialchars($_POST["pgx_peral_anpeg3grab"]);
			$src_nominal345 	= htmlspecialchars($_POST["pgx_serag_anpeg3grab"]);
			$src_nominal346		= htmlspecialchars($_POST["pgx_paket_anpeg3grab"]);			
			$src_nominal347 	= htmlspecialchars($_POST["tka_penga_anpeg3grab"]);
			$src_nominal348 	= htmlspecialchars($_POST["tka_kegia_anpeg3grab"]);
			$src_nominal349		= htmlspecialchars($_POST["tka_peral_anpeg3grab"]);
			$src_nominal350 	= htmlspecialchars($_POST["tka_serag_anpeg3grab"]);
			$src_nominal351		= htmlspecialchars($_POST["tka_paket_anpeg3grab"]);			
			$src_nominal352 	= htmlspecialchars($_POST["tkb_penga_anpeg3grab"]);
			$src_nominal353		= htmlspecialchars($_POST["tkb_kegia_anpeg3grab"]);
			$src_nominal354 	= htmlspecialchars($_POST["tkb_peral_anpeg3grab"]);
			$src_nominal355		= htmlspecialchars($_POST["tkb_serag_anpeg3grab"]);
			$src_nominal356 	= htmlspecialchars($_POST["tkb_paket_anpeg3grab"]);			
			$src_nominal357		= htmlspecialchars($_POST["sdx_penga_anpeg3grab"]);
			$src_nominal358		= htmlspecialchars($_POST["sdx_serag_anpeg3grab"]);			
			$src_nominal359		= htmlspecialchars($_POST["smp_penga_anpeg3grab"]);
			$src_nominal360 	= htmlspecialchars($_POST["smp_serag_anpeg3grab"]);
			
			$_adm341	=	"tod_penga_anpeg3grab_"	.$src_nominal341;			
			$_adm342	=	"pgx_penga_anpeg3grab_"	.$src_nominal342;
			$_adm343	=	"pgx_kegia_anpeg3grab_"	.$src_nominal343;
			$_adm344	=	"pgx_peral_anpeg3grab_"	.$src_nominal344;
			$_adm345	=	"pgx_serag_anpeg3grab_"	.$src_nominal345;
			$_adm346	=	"pgx_paket_anpeg3grab_"	.$src_nominal346;			
			$_adm347	=	"tka_penga_anpeg3grab_"	.$src_nominal347;
			$_adm348	=	"tka_kegia_anpeg3grab_"	.$src_nominal348;
			$_adm349	=	"tka_peral_anpeg3grab_"	.$src_nominal349;
			$_adm350	=	"tka_serag_anpeg3grab_"	.$src_nominal350;
			$_adm351	=	"tka_paket_anpeg3grab_"	.$src_nominal351;			
			$_adm352	=	"tkb_penga_anpeg3grab_"	.$src_nominal352;
			$_adm353	=	"tkb_kegia_anpeg3grab_"	.$src_nominal353;
			$_adm354	=	"tkb_peral_anpeg3grab_"	.$src_nominal354;
			$_adm355	=	"tkb_serag_anpeg3grab_"	.$src_nominal355;
			$_adm356	=	"tkb_paket_anpeg3grab_"	.$src_nominal356;			
			$_adm357	=	"sdx_penga_anpeg3grab_"	.$src_nominal357;
			$_adm358	=	"sdx_serag_anpeg3grab_"	.$src_nominal358;			
			$_adm359	=	"smp_penga_anpeg3grab_"	.$src_nominal359;
			$_adm360	=	"smp_serag_anpeg3grab_"	.$src_nominal360;
			
			//Siswa pindahan ke toddler semester II (pintodsem2)
			$src_nominal361 	= htmlspecialchars($_POST["tod_penga_pintodsem2"]);			
			$src_nominal362 	= htmlspecialchars($_POST["pgx_penga_pintodsem2"]);
			$src_nominal363 	= htmlspecialchars($_POST["pgx_kegia_pintodsem2"]);
			$src_nominal364 	= htmlspecialchars($_POST["pgx_peral_pintodsem2"]);
			$src_nominal365 	= htmlspecialchars($_POST["pgx_serag_pintodsem2"]);
			$src_nominal366		= htmlspecialchars($_POST["pgx_paket_pintodsem2"]);			
			$src_nominal367 	= htmlspecialchars($_POST["tka_penga_pintodsem2"]);
			$src_nominal368 	= htmlspecialchars($_POST["tka_kegia_pintodsem2"]);
			$src_nominal369		= htmlspecialchars($_POST["tka_peral_pintodsem2"]);
			$src_nominal370 	= htmlspecialchars($_POST["tka_serag_pintodsem2"]);
			$src_nominal371		= htmlspecialchars($_POST["tka_paket_pintodsem2"]);			
			$src_nominal372 	= htmlspecialchars($_POST["tkb_penga_pintodsem2"]);
			$src_nominal373		= htmlspecialchars($_POST["tkb_kegia_pintodsem2"]);
			$src_nominal374 	= htmlspecialchars($_POST["tkb_peral_pintodsem2"]);
			$src_nominal375		= htmlspecialchars($_POST["tkb_serag_pintodsem2"]);
			$src_nominal376 	= htmlspecialchars($_POST["tkb_paket_pintodsem2"]);			
			$src_nominal377		= htmlspecialchars($_POST["sdx_penga_pintodsem2"]);
			$src_nominal378		= htmlspecialchars($_POST["sdx_serag_pintodsem2"]);			
			$src_nominal379		= htmlspecialchars($_POST["smp_penga_pintodsem2"]);
			$src_nominal380 	= htmlspecialchars($_POST["smp_serag_pintodsem2"]);
			
			$_adm361	=	"tod_penga_pintodsem2_"	.$src_nominal361;			
			$_adm362	=	"pgx_penga_pintodsem2_"	.$src_nominal362;
			$_adm363	=	"pgx_kegia_pintodsem2_"	.$src_nominal363;
			$_adm364	=	"pgx_peral_pintodsem2_"	.$src_nominal364;
			$_adm365	=	"pgx_serag_pintodsem2_"	.$src_nominal365;
			$_adm366	=	"pgx_paket_pintodsem2_"	.$src_nominal366;			
			$_adm367	=	"tka_penga_pintodsem2_"	.$src_nominal367;
			$_adm368	=	"tka_kegia_pintodsem2_"	.$src_nominal368;
			$_adm369	=	"tka_peral_pintodsem2_"	.$src_nominal369;
			$_adm370	=	"tka_serag_pintodsem2_"	.$src_nominal370;
			$_adm371	=	"tka_paket_pintodsem2_"	.$src_nominal371;			
			$_adm372	=	"tkb_penga_pintodsem2_"	.$src_nominal372;
			$_adm373	=	"tkb_kegia_pintodsem2_"	.$src_nominal373;
			$_adm374	=	"tkb_peral_pintodsem2_"	.$src_nominal374;
			$_adm375	=	"tkb_serag_pintodsem2_"	.$src_nominal375;
			$_adm376	=	"tkb_paket_pintodsem2_"	.$src_nominal376;			
			$_adm377	=	"sdx_penga_pintodsem2_"	.$src_nominal377;
			$_adm378	=	"sdx_serag_pintodsem2_"	.$src_nominal378;			
			$_adm379	=	"smp_penga_pintodsem2_"	.$src_nominal379;
			$_adm380	=	"smp_serag_pintodsem2_"	.$src_nominal380;
			
			//Siswa pindahan ke PG/TK A/TK B semester II (pinpgtksem2)
			$src_nominal381 	= htmlspecialchars($_POST["tod_penga_pinpgtksem2"]);			
			$src_nominal382 	= htmlspecialchars($_POST["pgx_penga_pinpgtksem2"]);
			$src_nominal383 	= htmlspecialchars($_POST["pgx_kegia_pinpgtksem2"]);
			$src_nominal384 	= htmlspecialchars($_POST["pgx_peral_pinpgtksem2"]);
			$src_nominal385 	= htmlspecialchars($_POST["pgx_serag_pinpgtksem2"]);
			$src_nominal386		= htmlspecialchars($_POST["pgx_paket_pinpgtksem2"]);			
			$src_nominal387 	= htmlspecialchars($_POST["tka_penga_pinpgtksem2"]);
			$src_nominal388 	= htmlspecialchars($_POST["tka_kegia_pinpgtksem2"]);
			$src_nominal389		= htmlspecialchars($_POST["tka_peral_pinpgtksem2"]);
			$src_nominal390 	= htmlspecialchars($_POST["tka_serag_pinpgtksem2"]);
			$src_nominal391		= htmlspecialchars($_POST["tka_paket_pinpgtksem2"]);			
			$src_nominal392 	= htmlspecialchars($_POST["tkb_penga_pinpgtksem2"]);
			$src_nominal393		= htmlspecialchars($_POST["tkb_kegia_pinpgtksem2"]);
			$src_nominal394 	= htmlspecialchars($_POST["tkb_peral_pinpgtksem2"]);
			$src_nominal395		= htmlspecialchars($_POST["tkb_serag_pinpgtksem2"]);
			$src_nominal396 	= htmlspecialchars($_POST["tkb_paket_pinpgtksem2"]);			
			$src_nominal397		= htmlspecialchars($_POST["sdx_penga_pinpgtksem2"]);
			$src_nominal398		= htmlspecialchars($_POST["sdx_serag_pinpgtksem2"]);			
			$src_nominal399		= htmlspecialchars($_POST["smp_penga_pinpgtksem2"]);
			$src_nominal400 	= htmlspecialchars($_POST["smp_serag_pinpgtksem2"]);
			
			$_adm381	=	"tod_penga_pinpgtksem2_"	.$src_nominal381;			
			$_adm382	=	"pgx_penga_pinpgtksem2_"	.$src_nominal382;
			$_adm383	=	"pgx_kegia_pinpgtksem2_"	.$src_nominal383;
			$_adm384	=	"pgx_peral_pinpgtksem2_"	.$src_nominal384;
			$_adm385	=	"pgx_serag_pinpgtksem2_"	.$src_nominal385;
			$_adm386	=	"pgx_paket_pinpgtksem2_"	.$src_nominal386;			
			$_adm387	=	"tka_penga_pinpgtksem2_"	.$src_nominal387;
			$_adm388	=	"tka_kegia_pinpgtksem2_"	.$src_nominal388;
			$_adm389	=	"tka_peral_pinpgtksem2_"	.$src_nominal389;
			$_adm390	=	"tka_serag_pinpgtksem2_"	.$src_nominal390;
			$_adm391	=	"tka_paket_pinpgtksem2_"	.$src_nominal391;			
			$_adm392	=	"tkb_penga_pinpgtksem2_"	.$src_nominal392;
			$_adm393	=	"tkb_kegia_pinpgtksem2_"	.$src_nominal393;
			$_adm394	=	"tkb_peral_pinpgtksem2_"	.$src_nominal394;
			$_adm395	=	"tkb_serag_pinpgtksem2_"	.$src_nominal395;
			$_adm396	=	"tkb_paket_pinpgtksem2_"	.$src_nominal396;			
			$_adm397	=	"sdx_penga_pinpgtksem2_"	.$src_nominal397;
			$_adm398	=	"sdx_serag_pinpgtksem2_"	.$src_nominal398;			
			$_adm399	=	"smp_penga_pinpgtksem2_"	.$src_nominal399;
			$_adm400	=	"smp_serag_pinpgtksem2_"	.$src_nominal400;
			
			//Siswa pindahan ke SD 3-4 (pinsd34)
			$src_nominal401 	= htmlspecialchars($_POST["tod_penga_pinsd34"]);			
			$src_nominal402 	= htmlspecialchars($_POST["pgx_penga_pinsd34"]);
			$src_nominal403 	= htmlspecialchars($_POST["pgx_kegia_pinsd34"]);
			$src_nominal404 	= htmlspecialchars($_POST["pgx_peral_pinsd34"]);
			$src_nominal405 	= htmlspecialchars($_POST["pgx_serag_pinsd34"]);
			$src_nominal406		= htmlspecialchars($_POST["pgx_paket_pinsd34"]);			
			$src_nominal407 	= htmlspecialchars($_POST["tka_penga_pinsd34"]);
			$src_nominal408 	= htmlspecialchars($_POST["tka_kegia_pinsd34"]);
			$src_nominal409		= htmlspecialchars($_POST["tka_peral_pinsd34"]);
			$src_nominal410 	= htmlspecialchars($_POST["tka_serag_pinsd34"]);
			$src_nominal411		= htmlspecialchars($_POST["tka_paket_pinsd34"]);			
			$src_nominal412 	= htmlspecialchars($_POST["tkb_penga_pinsd34"]);
			$src_nominal413		= htmlspecialchars($_POST["tkb_kegia_pinsd34"]);
			$src_nominal414 	= htmlspecialchars($_POST["tkb_peral_pinsd34"]);
			$src_nominal415		= htmlspecialchars($_POST["tkb_serag_pinsd34"]);
			$src_nominal416 	= htmlspecialchars($_POST["tkb_paket_pinsd34"]);			
			$src_nominal417		= htmlspecialchars($_POST["sdx_penga_pinsd34"]);
			$src_nominal418		= htmlspecialchars($_POST["sdx_serag_pinsd34"]);			
			$src_nominal419		= htmlspecialchars($_POST["smp_penga_pinsd34"]);
			$src_nominal420 	= htmlspecialchars($_POST["smp_serag_pinsd34"]);
			
			$_adm401	=	"tod_penga_pinsd34_"	.$src_nominal401;			
			$_adm402	=	"pgx_penga_pinsd34_"	.$src_nominal402;
			$_adm403	=	"pgx_kegia_pinsd34_"	.$src_nominal403;
			$_adm404	=	"pgx_peral_pinsd34_"	.$src_nominal404;
			$_adm405	=	"pgx_serag_pinsd34_"	.$src_nominal405;
			$_adm406	=	"pgx_paket_pinsd34_"	.$src_nominal406;			
			$_adm407	=	"tka_penga_pinsd34_"	.$src_nominal407;
			$_adm408	=	"tka_kegia_pinsd34_"	.$src_nominal408;
			$_adm409	=	"tka_peral_pinsd34_"	.$src_nominal409;
			$_adm410	=	"tka_serag_pinsd34_"	.$src_nominal410;
			$_adm411	=	"tka_paket_pinsd34_"	.$src_nominal411;			
			$_adm412	=	"tkb_penga_pinsd34_"	.$src_nominal412;
			$_adm413	=	"tkb_kegia_pinsd34_"	.$src_nominal413;
			$_adm414	=	"tkb_peral_pinsd34_"	.$src_nominal414;
			$_adm415	=	"tkb_serag_pinsd34_"	.$src_nominal415;
			$_adm416	=	"tkb_paket_pinsd34_"	.$src_nominal416;			
			$_adm417	=	"sdx_penga_pinsd34_"	.$src_nominal417;
			$_adm418	=	"sdx_serag_pinsd34_"	.$src_nominal418;			
			$_adm419	=	"smp_penga_pinsd34_"	.$src_nominal419;
			$_adm420	=	"smp_serag_pinsd34_"	.$src_nominal420;
			
			//Siswa pindahan ke SD 5-6 (pinsd56)
			$src_nominal421 	= htmlspecialchars($_POST["tod_penga_pinsd56"]);			
			$src_nominal422 	= htmlspecialchars($_POST["pgx_penga_pinsd56"]);
			$src_nominal423 	= htmlspecialchars($_POST["pgx_kegia_pinsd56"]);
			$src_nominal424 	= htmlspecialchars($_POST["pgx_peral_pinsd56"]);
			$src_nominal425 	= htmlspecialchars($_POST["pgx_serag_pinsd56"]);
			$src_nominal426		= htmlspecialchars($_POST["pgx_paket_pinsd56"]);			
			$src_nominal427 	= htmlspecialchars($_POST["tka_penga_pinsd56"]);
			$src_nominal428 	= htmlspecialchars($_POST["tka_kegia_pinsd56"]);
			$src_nominal429		= htmlspecialchars($_POST["tka_peral_pinsd56"]);
			$src_nominal430 	= htmlspecialchars($_POST["tka_serag_pinsd56"]);
			$src_nominal431		= htmlspecialchars($_POST["tka_paket_pinsd56"]);			
			$src_nominal432 	= htmlspecialchars($_POST["tkb_penga_pinsd56"]);
			$src_nominal433		= htmlspecialchars($_POST["tkb_kegia_pinsd56"]);
			$src_nominal434 	= htmlspecialchars($_POST["tkb_peral_pinsd56"]);
			$src_nominal435		= htmlspecialchars($_POST["tkb_serag_pinsd56"]);
			$src_nominal436 	= htmlspecialchars($_POST["tkb_paket_pinsd56"]);			
			$src_nominal437		= htmlspecialchars($_POST["sdx_penga_pinsd56"]);
			$src_nominal438		= htmlspecialchars($_POST["sdx_serag_pinsd56"]);			
			$src_nominal439		= htmlspecialchars($_POST["smp_penga_pinsd56"]);
			$src_nominal440 	= htmlspecialchars($_POST["smp_serag_pinsd56"]);
			
			$_adm421	=	"tod_penga_pinsd56_"	.$src_nominal421;			
			$_adm422	=	"pgx_penga_pinsd56_"	.$src_nominal422;
			$_adm423	=	"pgx_kegia_pinsd56_"	.$src_nominal423;
			$_adm424	=	"pgx_peral_pinsd56_"	.$src_nominal424;
			$_adm425	=	"pgx_serag_pinsd56_"	.$src_nominal425;
			$_adm426	=	"pgx_paket_pinsd56_"	.$src_nominal426;			
			$_adm427	=	"tka_penga_pinsd56_"	.$src_nominal427;
			$_adm428	=	"tka_kegia_pinsd56_"	.$src_nominal428;
			$_adm429	=	"tka_peral_pinsd56_"	.$src_nominal429;
			$_adm430	=	"tka_serag_pinsd56_"	.$src_nominal430;
			$_adm431	=	"tka_paket_pinsd56_"	.$src_nominal431;			
			$_adm432	=	"tkb_penga_pinsd56_"	.$src_nominal432;
			$_adm433	=	"tkb_kegia_pinsd56_"	.$src_nominal433;
			$_adm434	=	"tkb_peral_pinsd56_"	.$src_nominal434;
			$_adm435	=	"tkb_serag_pinsd56_"	.$src_nominal435;
			$_adm436	=	"tkb_paket_pinsd56_"	.$src_nominal436;			
			$_adm437	=	"sdx_penga_pinsd56_"	.$src_nominal437;
			$_adm438	=	"sdx_serag_pinsd56_"	.$src_nominal438;			
			$_adm439	=	"smp_penga_pinsd56_"	.$src_nominal439;
			$_adm440	=	"smp_serag_pinsd56_"	.$src_nominal440;
			
			//Siswa pindahan ke SMP 8 (pinsmp8)
			$src_nominal441 	= htmlspecialchars($_POST["tod_penga_pinsmp8"]);			
			$src_nominal442 	= htmlspecialchars($_POST["pgx_penga_pinsmp8"]);
			$src_nominal443 	= htmlspecialchars($_POST["pgx_kegia_pinsmp8"]);
			$src_nominal444 	= htmlspecialchars($_POST["pgx_peral_pinsmp8"]);
			$src_nominal445 	= htmlspecialchars($_POST["pgx_serag_pinsmp8"]);
			$src_nominal446		= htmlspecialchars($_POST["pgx_paket_pinsmp8"]);			
			$src_nominal447 	= htmlspecialchars($_POST["tka_penga_pinsmp8"]);
			$src_nominal448 	= htmlspecialchars($_POST["tka_kegia_pinsmp8"]);
			$src_nominal449		= htmlspecialchars($_POST["tka_peral_pinsmp8"]);
			$src_nominal450 	= htmlspecialchars($_POST["tka_serag_pinsmp8"]);
			$src_nominal451		= htmlspecialchars($_POST["tka_paket_pinsmp8"]);			
			$src_nominal452 	= htmlspecialchars($_POST["tkb_penga_pinsmp8"]);
			$src_nominal453		= htmlspecialchars($_POST["tkb_kegia_pinsmp8"]);
			$src_nominal454 	= htmlspecialchars($_POST["tkb_peral_pinsmp8"]);
			$src_nominal455		= htmlspecialchars($_POST["tkb_serag_pinsmp8"]);
			$src_nominal456 	= htmlspecialchars($_POST["tkb_paket_pinsmp8"]);			
			$src_nominal457		= htmlspecialchars($_POST["sdx_penga_pinsmp8"]);
			$src_nominal458		= htmlspecialchars($_POST["sdx_serag_pinsmp8"]);			
			$src_nominal459		= htmlspecialchars($_POST["smp_penga_pinsmp8"]);
			$src_nominal460 	= htmlspecialchars($_POST["smp_serag_pinsmp8"]);
			
			$_adm441	=	"tod_penga_pinsmp8_"	.$src_nominal441;			
			$_adm442	=	"pgx_penga_pinsmp8_"	.$src_nominal442;
			$_adm443	=	"pgx_kegia_pinsmp8_"	.$src_nominal443;
			$_adm444	=	"pgx_peral_pinsmp8_"	.$src_nominal444;
			$_adm445	=	"pgx_serag_pinsmp8_"	.$src_nominal445;
			$_adm446	=	"pgx_paket_pinsmp8_"	.$src_nominal446;			
			$_adm447	=	"tka_penga_pinsmp8_"	.$src_nominal447;
			$_adm448	=	"tka_kegia_pinsmp8_"	.$src_nominal448;
			$_adm449	=	"tka_peral_pinsmp8_"	.$src_nominal449;
			$_adm450	=	"tka_serag_pinsmp8_"	.$src_nominal450;
			$_adm451	=	"tka_paket_pinsmp8_"	.$src_nominal451;			
			$_adm452	=	"tkb_penga_pinsmp8_"	.$src_nominal452;
			$_adm453	=	"tkb_kegia_pinsmp8_"	.$src_nominal453;
			$_adm454	=	"tkb_peral_pinsmp8_"	.$src_nominal454;
			$_adm455	=	"tkb_serag_pinsmp8_"	.$src_nominal455;
			$_adm456	=	"tkb_paket_pinsmp8_"	.$src_nominal456;			
			$_adm457	=	"sdx_penga_pinsmp8_"	.$src_nominal457;
			$_adm458	=	"sdx_serag_pinsmp8_"	.$src_nominal458;			
			$_adm459	=	"smp_penga_pinsmp8_"	.$src_nominal459;
			$_adm460	=	"smp_serag_pinsmp8_"	.$src_nominal460;
			
			//Siswa pindahan ke SMP 9 (pinsmp9)
			$src_nominal461 	= htmlspecialchars($_POST["tod_penga_pinsmp9"]);			
			$src_nominal462 	= htmlspecialchars($_POST["pgx_penga_pinsmp9"]);
			$src_nominal463 	= htmlspecialchars($_POST["pgx_kegia_pinsmp9"]);
			$src_nominal464 	= htmlspecialchars($_POST["pgx_peral_pinsmp9"]);
			$src_nominal465 	= htmlspecialchars($_POST["pgx_serag_pinsmp9"]);
			$src_nominal466		= htmlspecialchars($_POST["pgx_paket_pinsmp9"]);			
			$src_nominal467 	= htmlspecialchars($_POST["tka_penga_pinsmp9"]);
			$src_nominal468 	= htmlspecialchars($_POST["tka_kegia_pinsmp9"]);
			$src_nominal469		= htmlspecialchars($_POST["tka_peral_pinsmp9"]);
			$src_nominal470 	= htmlspecialchars($_POST["tka_serag_pinsmp9"]);
			$src_nominal471		= htmlspecialchars($_POST["tka_paket_pinsmp9"]);			
			$src_nominal472 	= htmlspecialchars($_POST["tkb_penga_pinsmp9"]);
			$src_nominal473		= htmlspecialchars($_POST["tkb_kegia_pinsmp9"]);
			$src_nominal474 	= htmlspecialchars($_POST["tkb_peral_pinsmp9"]);
			$src_nominal475		= htmlspecialchars($_POST["tkb_serag_pinsmp9"]);
			$src_nominal476 	= htmlspecialchars($_POST["tkb_paket_pinsmp9"]);			
			$src_nominal477		= htmlspecialchars($_POST["sdx_penga_pinsmp9"]);
			$src_nominal478		= htmlspecialchars($_POST["sdx_serag_pinsmp9"]);			
			$src_nominal479		= htmlspecialchars($_POST["smp_penga_pinsmp9"]);
			$src_nominal480 	= htmlspecialchars($_POST["smp_serag_pinsmp9"]);
			
			$_adm461	=	"tod_penga_pinsmp9_"	.$src_nominal461;			
			$_adm462	=	"pgx_penga_pinsmp9_"	.$src_nominal462;
			$_adm463	=	"pgx_kegia_pinsmp9_"	.$src_nominal463;
			$_adm464	=	"pgx_peral_pinsmp9_"	.$src_nominal464;
			$_adm465	=	"pgx_serag_pinsmp9_"	.$src_nominal465;
			$_adm466	=	"pgx_paket_pinsmp9_"	.$src_nominal466;			
			$_adm467	=	"tka_penga_pinsmp9_"	.$src_nominal467;
			$_adm468	=	"tka_kegia_pinsmp9_"	.$src_nominal468;
			$_adm469	=	"tka_peral_pinsmp9_"	.$src_nominal469;
			$_adm470	=	"tka_serag_pinsmp9_"	.$src_nominal470;
			$_adm471	=	"tka_paket_pinsmp9_"	.$src_nominal471;			
			$_adm472	=	"tkb_penga_pinsmp9_"	.$src_nominal472;
			$_adm473	=	"tkb_kegia_pinsmp9_"	.$src_nominal473;
			$_adm474	=	"tkb_peral_pinsmp9_"	.$src_nominal474;
			$_adm475	=	"tkb_serag_pinsmp9_"	.$src_nominal475;
			$_adm476	=	"tkb_paket_pinsmp9_"	.$src_nominal476;			
			$_adm477	=	"sdx_penga_pinsmp9_"	.$src_nominal477;
			$_adm478	=	"sdx_serag_pinsmp9_"	.$src_nominal478;			
			$_adm479	=	"smp_penga_pinsmp9_"	.$src_nominal479;
			$_adm480	=	"smp_serag_pinsmp9_"	.$src_nominal480;
			
			// One more time that i have to use an array to send this variables easily.
			$src_input = array(
								//Umum
								$_adm1,$_adm2,$_adm3,$_adm4,$_adm5,$_adm6,$_adm7,$_adm8,$_adm9,$_adm10,$_adm11,$_adm12,$_adm13,$_adm14,$_adm15,$_adm16,$_adm17,$_adm18,$_adm19,$_adm20,
								//Bersamaan dengan saudara kandung
								$_adm21,$_adm22,$_adm23,$_adm24,$_adm25,$_adm26,$_adm27,$_adm28,$_adm29,$_adm30,$_adm31,$_adm32,$_adm33,$_adm34,$_adm35,$_adm36,$_adm37,$_adm38,$_adm39,$_adm40,
								//Memiliki Saudara Kandung
								$_adm41,$_adm42,$_adm43,$_adm44,$_adm45,$_adm46,$_adm47,$_adm48,$_adm49,$_adm50,$_adm51,$_adm52,$_adm53,$_adm54,$_adm55,$_adm56,$_adm57,$_adm58,$_adm59,$_adm60,
								//Umum Grade B
								$_adm61,$_adm62,$_adm63,$_adm64,$_adm65,$_adm66,$_adm67,$_adm68,$_adm69,$_adm70,$_adm71,$_adm72,$_adm73,$_adm74,$_adm75,$_adm76,$_adm77,$_adm78,$_adm79,$_adm80,
								//Umum memiliki Saudara Kandung + Grade B
								$_adm81,$_adm82,$_adm83,$_adm84,$_adm85,$_adm86,$_adm87,$_adm88,$_adm89,$_adm90,$_adm91,$_adm92,$_adm93,$_adm94,$_adm95,$_adm96,$_adm97,$_adm98,$_adm99,$_adm100,
								//Umum bersamaan dengan saudara kandung + Grade B
								$_adm101,$_adm102,$_adm103,$_adm104,$_adm105,$_adm106,$_adm107,$_adm108,$_adm109,$_adm110,$_adm111,$_adm112,$_adm113,$_adm114,$_adm115,$_adm116,$_adm117,$_adm118,$_adm119,$_adm120,
								//Asal Darbi
								$_adm121,$_adm122,$_adm123,$_adm124,$_adm125,$_adm126,$_adm127,$_adm128,$_adm129,$_adm130,$_adm131,$_adm132,$_adm133,$_adm134,$_adm135,$_adm136,$_adm137,$_adm138,$_adm139,$_adm140,
								//Asal Darbi + Grade A
								$_adm141,$_adm142,$_adm143,$_adm144,$_adm145,$_adm146,$_adm147,$_adm148,$_adm149,$_adm150,$_adm151,$_adm152,$_adm153,$_adm154,$_adm155,$_adm156,$_adm157,$_adm158,$_adm159,$_adm160,
								//Asal Darbi + Grade B
								$_adm161,$_adm162,$_adm163,$_adm164,$_adm165,$_adm166,$_adm167,$_adm168,$_adm169,$_adm170,$_adm171,$_adm172,$_adm173,$_adm174,$_adm175,$_adm176,$_adm177,$_adm178,$_adm179,$_adm180,
								//Anak Pegawai ke-1
								$_adm181,$_adm182,$_adm183,$_adm184,$_adm185,$_adm186,$_adm187,$_adm188,$_adm189,$_adm190,$_adm191,$_adm192,$_adm193,$_adm194,$_adm195,$_adm196,$_adm197,$_adm198,$_adm199,$_adm200,
								//Anak Pegawai ke-2
								$_adm201,$_adm202,$_adm203,$_adm204,$_adm205,$_adm206,$_adm207,$_adm208,$_adm209,$_adm210,$_adm211,$_adm212,$_adm213,$_adm214,$_adm215,$_adm216,$_adm217,$_adm218,$_adm219,$_adm220,
								//Anak Pegawai ke-3, dst
								$_adm221,$_adm222,$_adm223,$_adm224,$_adm225,$_adm226,$_adm227,$_adm228,$_adm229,$_adm230,$_adm231,$_adm232,$_adm233,$_adm234,$_adm235,$_adm236,$_adm237,$_adm238,$_adm239,$_adm240,
								//Anak Pegawai ke-1 + Grade A
								$_adm241,$_adm242,$_adm243,$_adm244,$_adm245,$_adm246,$_adm247,$_adm248,$_adm249,$_adm250,$_adm251,$_adm252,$_adm253,$_adm254,$_adm255,$_adm256,$_adm257,$_adm258,$_adm259,$_adm260,
								//Anak Pegawai ke-1 + Grade B
								$_adm261,$_adm262,$_adm263,$_adm264,$_adm265,$_adm266,$_adm267,$_adm268,$_adm269,$_adm270,$_adm271,$_adm272,$_adm273,$_adm274,$_adm275,$_adm276,$_adm277,$_adm278,$_adm279,$_adm280,
								//Anak Pegawai ke-2 + Grade A
								$_adm281,$_adm282,$_adm283,$_adm284,$_adm285,$_adm286,$_adm287,$_adm288,$_adm289,$_adm290,$_adm291,$_adm292,$_adm293,$_adm294,$_adm295,$_adm296,$_adm297,$_adm298,$_adm299,$_adm300,
								//Anak Pegawai ke-2 + Grade B
								$_adm301,$_adm302,$_adm303,$_adm304,$_adm305,$_adm306,$_adm307,$_adm308,$_adm309,$_adm310,$_adm311,$_adm312,$_adm313,$_adm314,$_adm315,$_adm316,$_adm317,$_adm318,$_adm319,$_adm320,
								//Anak Pegawai ke-3, dst + Grade A
								$_adm321,$_adm322,$_adm323,$_adm324,$_adm325,$_adm326,$_adm327,$_adm328,$_adm329,$_adm330,$_adm331,$_adm332,$_adm333,$_adm334,$_adm335,$_adm336,$_adm337,$_adm338,$_adm339,$_adm340,
								//Anak Pegawai ke-3, dst + Grade B
								$_adm341,$_adm342,$_adm343,$_adm344,$_adm345,$_adm346,$_adm347,$_adm348,$_adm349,$_adm350,$_adm351,$_adm352,$_adm353,$_adm354,$_adm355,$_adm356,$_adm357,$_adm358,$_adm359,$_adm360,
								//Siswa pindahan ke toddler semester II
								$_adm361,$_adm362,$_adm363,$_adm364,$_adm365,$_adm366,$_adm367,$_adm368,$_adm369,$_adm370,$_adm371,$_adm372,$_adm373,$_adm374,$_adm375,$_adm376,$_adm377,$_adm378,$_adm379,$_adm380,
								//Siswa pindahan ke PG/TK A/TK B semester II
								$_adm381,$_adm382,$_adm383,$_adm384,$_adm385,$_adm386,$_adm387,$_adm388,$_adm389,$_adm390,$_adm391,$_adm392,$_adm393,$_adm394,$_adm395,$_adm396,$_adm397,$_adm398,$_adm399,$_adm400,
								//Siswa pindahan ke SD 3-4
								$_adm401,$_adm402,$_adm403,$_adm404,$_adm405,$_adm406,$_adm407,$_adm408,$_adm409,$_adm410,$_adm411,$_adm412,$_adm413,$_adm414,$_adm415,$_adm416,$_adm417,$_adm418,$_adm419,$_adm420,
								//Siswa pindahan ke SD 5-6
								$_adm421,$_adm422,$_adm423,$_adm424,$_adm425,$_adm426,$_adm427,$_adm428,$_adm429,$_adm430,$_adm431,$_adm432,$_adm433,$_adm434,$_adm435,$_adm436,$_adm437,$_adm438,$_adm439,$_adm440,
								//Siswa pindahan ke SMP 8
								$_adm441,$_adm442,$_adm443,$_adm444,$_adm445,$_adm446,$_adm447,$_adm448,$_adm449,$_adm450,$_adm451,$_adm452,$_adm453,$_adm454,$_adm455,$_adm456,$_adm457,$_adm458,$_adm459,$_adm460,
								//Siswa pindahan ke SMP 9
								$_adm461,$_adm462,$_adm463,$_adm464,$_adm465,$_adm466,$_adm467,$_adm468,$_adm469,$_adm470,$_adm471,$_adm472,$_adm473,$_adm474,$_adm475,$_adm476,$_adm477,$_adm478,$_adm479,$_adm480
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
				//$the_nominal	 	= $data_explode[3];
				
				/*if(empty($data_explode[3])) {
					$the_nominal	= 0;
				} else {
					$the_nominal	= $spp_explode[3];
				}*/
				
				$the_nominal = (empty($data_explode[3])) ? '0' : $data_explode[3];
				
				
				$enc_periode		= mysql_real_escape_string($periode);
				$enc_level			= mysql_real_escape_string($src_level);
				$enc_cat_adm		= mysql_real_escape_string($the_cat_adm);
				$enc_set_cat_adm	= mysql_real_escape_string($the_set_cat_adm);
				$enc_nominal		= mysql_real_escape_string($the_nominal);
				
				//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
				//make sure that period and level is not empty
				$src_spp	= "insert into set_cat_adm_bi_ma (periode,jenjang,cat_adm,set_cat_adm,nominal) values ('$enc_periode','$enc_level','$enc_cat_adm','$enc_set_cat_adm','$enc_nominal')";
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
					$redirect_url	= "mainpage.php?pl=cat_adm_bi_ma_setting_frame";
					$redirect_text	= "Categori administrasi untuk periode $periode sudah disimpan";
					
					$need_redirect	= true;
					include_once ("include/redirect.php");
				}
			}
		}
	} else {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=cat_adm_bi_ma_setting_frame";
		$redirect_text	= "Periode tidak boleh kosong. silahkan lengkapi kembali";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	}
}
?>