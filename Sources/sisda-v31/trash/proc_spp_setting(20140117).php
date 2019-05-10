<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	//Sambil coding sambil dengarkan bang haji oma
	//Engkau teman karibku.... lebih dari saudara...tetwewewetwetwetwe..... 
	
	//these data taken from page_seeting_spp.php
	$periode		= htmlspecialchars($_POST["src_periode"]);
	
	//Variable J is needed to define, what 'jenjang' is being sent here
	$src_j			= htmlspecialchars($_POST["j"]);
	$src_jenjang	= mysql_real_escape_string($src_j);
	
	//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
	//make sure that periode and level is not empty
		
	if(!empty($periode) and !empty($src_j)) {
		//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
		//So here we will make a filter to avoid data duplication.
		//Check if the new data already exist in database.
		//2 fields have to be checked are jenjang, ket_disc and periode
			
		$src_check_exist	= "select * from set_spp where periode = '$periode' and jenjang = '$src_jenjang'";
		$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
		$num_check_exist	= mysql_num_rows($query_check_exist);
			
		//tell admin if the data already exist
		if($num_check_exist != 0) {
				
			$redirect_path	= "";
			$redirect_icon	= "images/icon_false.png";
			$redirect_url	= "mainpage.php?pl=spp_sd_setting";
			$redirect_text	= "Mohon maaf, pengaturan SPP dan item lainnya untuk level $level, <br>tahun ajaran $periode sudah dilakukan. <br>Silahkan lakukan proses edit untuk melakukan perubahan nilai.";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
			
		} else {
			//if the data hasnt be defined, go ahead.
			///////////////////////////////////////////////////////////////
		
			//now, we would like to define, discount periode for every level
			// here we go			
			
			//level 1
			$lev1_1_min_periode	= 	substr($periode,-9,2);
			$lev1_1_max_periode	=	substr($periode,-2,2);
			
			//level 2
			$lev2_1_min_periode	= 	substr($periode,-9,2)-1;
			$lev2_1_max_periode	=	substr($periode,-2,2)-1;
			
			$lev2_2_min_periode	= 	substr($periode,-9,2);
			$lev2_2_max_periode	=	substr($periode,-2,2);
			
			//level 3
			$lev3_1_min_periode	= 	substr($periode,-9,2)-2;
			$lev3_1_max_periode	=	substr($periode,-2,2)-2;
			
			$lev3_2_min_periode	= 	substr($periode,-9,2)-1;
			$lev3_2_max_periode	=	substr($periode,-2,2)-1;
			
			$lev3_3_min_periode	= 	substr($periode,-9,2);
			$lev3_3_max_periode	=	substr($periode,-2,2);
			
			//level 4
			$lev4_1_min_periode	= 	substr($periode,-9,2)-3;
			$lev4_1_max_periode	=	substr($periode,-2,2)-3;
			
			$lev4_2_min_periode	= 	substr($periode,-9,2)-2;
			$lev4_2_max_periode	=	substr($periode,-2,2)-2;
			
			$lev4_3_min_periode	= 	substr($periode,-9,2)-1;
			$lev4_3_max_periode	=	substr($periode,-2,2)-1;
			
			$lev4_4_min_periode	= 	substr($periode,-9,2);
			$lev4_4_max_periode	=	substr($periode,-2,2);
			
			//level 5
			$lev5_1_min_periode	= 	substr($periode,-9,2)-4;
			$lev5_1_max_periode	=	substr($periode,-2,2)-4;
			
			$lev5_2_min_periode	= 	substr($periode,-9,2)-3;
			$lev5_2_max_periode	=	substr($periode,-2,2)-3;
			
			$lev5_3_min_periode	= 	substr($periode,-9,2)-2;
			$lev5_3_max_periode	=	substr($periode,-2,2)-2;
			
			$lev5_4_min_periode	= 	substr($periode,-9,2)-1;
			$lev5_4_max_periode	=	substr($periode,-2,2)-1;
			
			$lev5_5_min_periode	= 	substr($periode,-9,2);
			$lev5_5_max_periode	=	substr($periode,-2,2);
			
			//level 6
			$lev6_1_min_periode	= 	substr($periode,-9,2)-5;
			$lev6_1_max_periode	=	substr($periode,-2,2)-5;
			
			$lev6_2_min_periode	= 	substr($periode,-9,2)-4;
			$lev6_2_max_periode	=	substr($periode,-2,2)-4;
			
			$lev6_3_min_periode	= 	substr($periode,-9,2)-3;
			$lev6_3_max_periode	=	substr($periode,-2,2)-3;
			
			$lev6_4_min_periode	= 	substr($periode,-9,2)-2;
			$lev6_4_max_periode	=	substr($periode,-2,2)-2;
			
			$lev6_5_min_periode	= 	substr($periode,-9,2)-1;
			$lev6_5_max_periode	=	substr($periode,-2,2)-1;
			
			$lev6_6_min_periode	= 	substr($periode,-9,2);
			$lev6_6_max_periode	=	substr($periode,-2,2);
		
			
	
			//This is the largest amount of variables that i ever made,.....
			//Okay, you may say that, this all variables are sucks. But how could i do to make it in another way buddy????? couldn't you???
			//Ask kamal, he must be aggreed with me...:) lol...:))
			
			if($_POST["j"] == "toddler") 	{ $src_tingkat1 = "toddler"; }
			else if($_POST["j"] == "pg") 	{ $src_tingkat1 = "pg"; }
			else if($_POST["j"] == "tka") 	{ $src_tingkat1 = "tka"; }
			else if($_POST["j"] == "tkb") 	{ $src_tingkat1 = "tkb"; }
			else if($_POST["j"] == "sd") 	{ $src_tingkat1 = "1"; }
			else if($_POST["j"] == "smp") 	{ $src_tingkat1 = "7"; }	
		
			//kelas 1
			$_spp0		= $src_tingkat1."-".$lev1_1_min_periode.$lev1_1_max_periode."-spp-".htmlspecialchars($_POST["1-per1-spp"]);
			$_spp1		= $src_tingkat1."-".$lev1_1_min_periode.$lev1_1_max_periode."-ict-".htmlspecialchars($_POST["1-per1-ict"]);
			$_spp2		= $src_tingkat1."-".$lev1_1_min_periode.$lev1_1_max_periode."-add-".htmlspecialchars($_POST["1-per1-add"]);
			
			$_spp3		= $src_tingkat1."-angu-spp-".htmlspecialchars($_POST["1-angu-spp"]);
			$_spp4		= $src_tingkat1."-angu-ict-".htmlspecialchars($_POST["1-angu-ict"]);
			$_spp5		= $src_tingkat1."-angu-add-".htmlspecialchars($_POST["1-angu-add"]);
			
			$_spp6		= $src_tingkat1."-dis1-spp-".htmlspecialchars($_POST["1-dis1-spp"]);
			$_spp7		= $src_tingkat1."-dis1-ict-".htmlspecialchars($_POST["1-dis1-ict"]);
			$_spp8		= $src_tingkat1."-dis1-add-".htmlspecialchars($_POST["1-dis1-add"]);
			
			$_spp9		= $src_tingkat1."-dis2-spp-".htmlspecialchars($_POST["1-dis2-spp"]);
			$_spp10		= $src_tingkat1."-dis2-ict-".htmlspecialchars($_POST["1-dis2-ict"]);
			$_spp11		= $src_tingkat1."-dis2-add-".htmlspecialchars($_POST["1-dis2-add"]);
			
			$_spp12		= $src_tingkat1."-dis3-spp-".htmlspecialchars($_POST["1-dis3-spp"]);
			$_spp13		= $src_tingkat1."-dis3-ict-".htmlspecialchars($_POST["1-dis3-ict"]);
			$_spp14		= $src_tingkat1."-dis3-add-".htmlspecialchars($_POST["1-dis3-add"]);
			
			//kelas 2
			if($_POST["j"] == "smp" || $_POST["j"] == "sd") {
			
				if($_POST["j"] == "sd") 		{ $src_tingkat2	= "2"; }
				else if($_POST["j"] == "smp") 	{ $src_tingkat2	= "8"; }
							
				$_spp15		= $src_tingkat2."-".$lev2_1_min_periode.$lev2_1_max_periode."-spp-".htmlspecialchars($_POST["2-per1-spp"]);
				$_spp16		= $src_tingkat2."-".$lev2_1_min_periode.$lev2_1_max_periode."-ict-".htmlspecialchars($_POST["2-per1-ict"]);
				$_spp17		= $src_tingkat2."-".$lev2_1_min_periode.$lev2_1_max_periode."-add-".htmlspecialchars($_POST["2-per1-add"]);
				
				$_spp18		= $src_tingkat2."-".$lev2_2_min_periode.$lev2_2_max_periode."-spp-".htmlspecialchars($_POST["2-per2-spp"]);
				$_spp19		= $src_tingkat2."-".$lev2_2_min_periode.$lev2_2_max_periode."-ict-".htmlspecialchars($_POST["2-per2-ict"]);
				$_spp20		= $src_tingkat2."-".$lev2_2_min_periode.$lev2_2_max_periode."-add-".htmlspecialchars($_POST["2-per2-add"]);
				
				$_spp21		= $src_tingkat2."-angu-spp-".htmlspecialchars($_POST["2-angu-spp"]);
				$_spp22		= $src_tingkat2."-angu-ict-".htmlspecialchars($_POST["2-angu-ict"]);
				$_spp23		= $src_tingkat2."-angu-add-".htmlspecialchars($_POST["2-angu-add"]);
				
				$_spp24		= $src_tingkat2."-dis1-spp-".htmlspecialchars($_POST["2-dis1-spp"]);
				$_spp25		= $src_tingkat2."-dis1-ict-".htmlspecialchars($_POST["2-dis1-ict"]);
				$_spp26		= $src_tingkat2."-dis1-add-".htmlspecialchars($_POST["2-dis1-add"]);
				
				$_spp27		= $src_tingkat2."-dis2-spp-".htmlspecialchars($_POST["2-dis2-spp"]);
				$_spp28		= $src_tingkat2."-dis2-ict-".htmlspecialchars($_POST["2-dis2-ict"]);
				$_spp29		= $src_tingkat2."-dis2-add-".htmlspecialchars($_POST["2-dis2-add"]);
				
				$_spp30		= $src_tingkat2."-dis3-spp-".htmlspecialchars($_POST["2-dis3-spp"]);
				$_spp31		= $src_tingkat2."-dis3-ict-".htmlspecialchars($_POST["2-dis3-ict"]);
				$_spp32		= $src_tingkat2."-dis3-add-".htmlspecialchars($_POST["2-dis3-add"]);
			
			
				//kelas 3
				if($_POST["j"] == "sd") 		{ $src_tingkat3	= "3"; }
				else if($_POST["j"] == "smp") 	{ $src_tingkat3	= "9"; }
				
				$_spp33		= $src_tingkat3."-".$lev3_1_min_periode.$lev3_1_max_periode."-spp-".htmlspecialchars($_POST["3-per1-spp"]);
				$_spp34		= $src_tingkat3."-".$lev3_1_min_periode.$lev3_1_max_periode."-ict-".htmlspecialchars($_POST["3-per1-ict"]);
				$_spp35		= $src_tingkat3."-".$lev3_1_min_periode.$lev3_1_max_periode."-add-".htmlspecialchars($_POST["3-per1-add"]);
				
				$_spp36		= $src_tingkat3."-".$lev3_2_min_periode.$lev3_2_max_periode."-spp-".htmlspecialchars($_POST["3-per2-spp"]);
				$_spp37		= $src_tingkat3."-".$lev3_2_min_periode.$lev3_2_max_periode."-ict-".htmlspecialchars($_POST["3-per2-ict"]);
				$_spp38		= $src_tingkat3."-".$lev3_2_min_periode.$lev3_2_max_periode."-add-".htmlspecialchars($_POST["3-per2-add"]);
				
				$_spp39		= $src_tingkat3."-".$lev3_3_min_periode.$lev3_3_max_periode."-spp-".htmlspecialchars($_POST["3-per3-spp"]);
				$_spp40		= $src_tingkat3."-".$lev3_3_min_periode.$lev3_3_max_periode."-ict-".htmlspecialchars($_POST["3-per3-ict"]);
				$_spp41		= $src_tingkat3."-".$lev3_3_min_periode.$lev3_3_max_periode."-add-".htmlspecialchars($_POST["3-per3-add"]);
				
				$_spp42		= $src_tingkat3."-angu-spp-".htmlspecialchars($_POST["3-angu-spp"]);
				$_spp43		= $src_tingkat3."-angu-ict-".htmlspecialchars($_POST["3-angu-ict"]);
				$_spp44		= $src_tingkat3."-angu-add-".htmlspecialchars($_POST["3-angu-add"]);
				
				$_spp45		= $src_tingkat3."-dis1-spp-".htmlspecialchars($_POST["3-dis1-spp"]);
				$_spp46		= $src_tingkat3."-dis1-ict-".htmlspecialchars($_POST["3-dis1-ict"]);
				$_spp47		= $src_tingkat3."-dis1-add-".htmlspecialchars($_POST["3-dis1-add"]);
				
				$_spp48		= $src_tingkat3."-dis2-spp-".htmlspecialchars($_POST["3-dis2-spp"]);
				$_spp49		= $src_tingkat3."-dis2-ict-".htmlspecialchars($_POST["3-dis2-ict"]);
				$_spp50		= $src_tingkat3."-dis2-add-".htmlspecialchars($_POST["3-dis2-add"]);
				
				$_spp51		= $src_tingkat3."-dis3-spp-".htmlspecialchars($_POST["3-dis3-spp"]);
				$_spp52		= $src_tingkat3."-dis3-ict-".htmlspecialchars($_POST["3-dis3-ict"]);
				$_spp53		= $src_tingkat3."-dis3-add-".htmlspecialchars($_POST["3-dis3-add"]);
			
			}
			
			//kelas 4
			if($_POST["j"] == "sd") {
			
				$_spp54		= "Kelas 4-".$lev4_1_min_periode.$lev4_1_max_periode."-spp-".htmlspecialchars($_POST["4-per1-spp"]);
				$_spp55		= "Kelas 4-".$lev4_1_min_periode.$lev4_1_max_periode."-ict-".htmlspecialchars($_POST["4-per1-ict"]);
				$_spp56		= "Kelas 4-".$lev4_1_min_periode.$lev4_1_max_periode."-add-".htmlspecialchars($_POST["4-per1-add"]);
				
				$_spp57		= "Kelas 4-".$lev4_2_min_periode.$lev4_2_max_periode."-spp-".htmlspecialchars($_POST["4-per2-spp"]);
				$_spp58		= "Kelas 4-".$lev4_2_min_periode.$lev4_2_max_periode."-ict-".htmlspecialchars($_POST["4-per2-ict"]);
				$_spp59		= "Kelas 4-".$lev4_2_min_periode.$lev4_2_max_periode."-add-".htmlspecialchars($_POST["4-per2-add"]);
				
				$_spp60		= "Kelas 4-".$lev4_3_min_periode.$lev4_3_max_periode."-spp-".htmlspecialchars($_POST["4-per3-spp"]);
				$_spp61		= "Kelas 4-".$lev4_3_min_periode.$lev4_3_max_periode."-ict-".htmlspecialchars($_POST["4-per3-ict"]);
				$_spp62		= "Kelas 4-".$lev4_3_min_periode.$lev4_3_max_periode."-add-".htmlspecialchars($_POST["4-per3-add"]);
				
				$_spp63		= "Kelas 4-".$lev4_4_min_periode.$lev4_4_max_periode."-spp-".htmlspecialchars($_POST["4-per4-spp"]);
				$_spp64		= "Kelas 4-".$lev4_4_min_periode.$lev4_4_max_periode."-ict-".htmlspecialchars($_POST["4-per4-ict"]);
				$_spp65		= "Kelas 4-".$lev4_4_min_periode.$lev4_4_max_periode."-add-".htmlspecialchars($_POST["4-per4-add"]);
				
				$_spp66		= "Kelas 4-angu-spp-".htmlspecialchars($_POST["4-angu-spp"]);
				$_spp67		= "Kelas 4-angu-ict-".htmlspecialchars($_POST["4-angu-ict"]);
				$_spp68		= "Kelas 4-angu-add-".htmlspecialchars($_POST["4-angu-add"]);
				
				$_spp69		= "Kelas 4-dis1-spp-".htmlspecialchars($_POST["4-dis1-spp"]);
				$_spp70		= "Kelas 4-dis1-ict-".htmlspecialchars($_POST["4-dis1-ict"]);
				$_spp71		= "Kelas 4-dis1-add-".htmlspecialchars($_POST["4-dis1-add"]);
				
				$_spp72		= "Kelas 4-dis2-spp-".htmlspecialchars($_POST["4-dis2-spp"]);
				$_spp73		= "Kelas 4-dis2-ict-".htmlspecialchars($_POST["4-dis2-ict"]);
				$_spp74		= "Kelas 4-dis2-add-".htmlspecialchars($_POST["4-dis2-add"]);
				
				$_spp75		= "Kelas 4-dis3-spp-".htmlspecialchars($_POST["4-dis3-spp"]);
				$_spp76		= "Kelas 4-dis3-ict-".htmlspecialchars($_POST["4-dis3-ict"]);
				$_spp77		= "Kelas 4-dis3-add-".htmlspecialchars($_POST["4-dis3-add"]);
				
				//kelas 5
				$_spp78		= "Kelas 5-".$lev5_1_min_periode.$lev5_1_max_periode."-spp-".htmlspecialchars($_POST["5-per1-spp"]);
				$_spp79		= "Kelas 5-".$lev5_1_min_periode.$lev5_1_max_periode."-ict-".htmlspecialchars($_POST["5-per1-ict"]);
				$_spp80		= "Kelas 5-".$lev5_1_min_periode.$lev5_1_max_periode."-add-".htmlspecialchars($_POST["5-per1-add"]);
				
				$_spp81		= "Kelas 5-".$lev5_2_min_periode.$lev5_2_max_periode."-spp-".htmlspecialchars($_POST["5-per2-spp"]);
				$_spp82		= "Kelas 5-".$lev5_2_min_periode.$lev5_2_max_periode."-ict-".htmlspecialchars($_POST["5-per2-ict"]);
				$_spp83		= "Kelas 5-".$lev5_2_min_periode.$lev5_2_max_periode."-add-".htmlspecialchars($_POST["5-per2-add"]);
				
				$_spp84		= "Kelas 5-".$lev5_3_min_periode.$lev5_3_max_periode."-spp-".htmlspecialchars($_POST["5-per3-spp"]);
				$_spp85		= "Kelas 5-".$lev5_3_min_periode.$lev5_3_max_periode."-ict-".htmlspecialchars($_POST["5-per3-ict"]);
				$_spp86		= "Kelas 5-".$lev5_3_min_periode.$lev5_3_max_periode."-add-".htmlspecialchars($_POST["5-per3-add"]);
				
				$_spp87		= "Kelas 5-".$lev5_4_min_periode.$lev5_4_max_periode."-spp-".htmlspecialchars($_POST["5-per4-spp"]);
				$_spp88		= "Kelas 5-".$lev5_4_min_periode.$lev5_4_max_periode."-ict-".htmlspecialchars($_POST["5-per4-ict"]);
				$_spp89		= "Kelas 5-".$lev5_4_min_periode.$lev5_4_max_periode."-add-".htmlspecialchars($_POST["5-per4-add"]);
				
				$_spp90		= "Kelas 5-".$lev5_5_min_periode.$lev5_5_max_periode."-spp-".htmlspecialchars($_POST["5-per5-spp"]);
				$_spp91		= "Kelas 5-".$lev5_5_min_periode.$lev5_5_max_periode."-ict-".htmlspecialchars($_POST["5-per5-ict"]);
				$_spp92		= "Kelas 5-".$lev5_5_min_periode.$lev5_5_max_periode."-add-".htmlspecialchars($_POST["5-per5-add"]);
				
				$_spp93		= "Kelas 5-angu-spp-".htmlspecialchars($_POST["5-angu-spp"]);
				$_spp94		= "Kelas 5-angu-ict-".htmlspecialchars($_POST["5-angu-ict"]);
				$_spp95		= "Kelas 5-angu-add-".htmlspecialchars($_POST["5-angu-add"]);
				
				$_spp96		= "Kelas 5-dis1-spp-".htmlspecialchars($_POST["5-dis1-spp"]);
				$_spp97		= "Kelas 5-dis1-ict-".htmlspecialchars($_POST["5-dis1-ict"]);
				$_spp98		= "Kelas 5-dis1-add-".htmlspecialchars($_POST["5-dis1-add"]);
				
				$_spp99		= "Kelas 5-dis2-spp-".htmlspecialchars($_POST["5-dis2-spp"]);
				$_spp100	= "Kelas 5-dis2-ict-".htmlspecialchars($_POST["5-dis2-ict"]);
				$_spp101	= "Kelas 5-dis2-add-".htmlspecialchars($_POST["5-dis2-add"]);
				
				$_spp102	= "Kelas 5-dis3-spp-".htmlspecialchars($_POST["5-dis3-spp"]);
				$_spp103	= "Kelas 5-dis3-ict-".htmlspecialchars($_POST["5-dis3-ict"]);
				$_spp104	= "Kelas 5-dis3-add-".htmlspecialchars($_POST["5-dis3-add"]);
				
				//kelas 6
				$_spp105	= "Kelas 6-".$lev6_1_min_periode.$lev6_1_max_periode."-spp-".htmlspecialchars($_POST["6-per1-spp"]);
				$_spp106	= "Kelas 6-".$lev6_1_min_periode.$lev6_1_max_periode."-ict-".htmlspecialchars($_POST["6-per1-ict"]);
				$_spp107	= "Kelas 6-".$lev6_1_min_periode.$lev6_1_max_periode."-add-".htmlspecialchars($_POST["6-per1-add"]);
				
				$_spp108	= "Kelas 6-".$lev6_2_min_periode.$lev6_2_max_periode."-spp-".htmlspecialchars($_POST["6-per2-spp"]);
				$_spp109	= "Kelas 6-".$lev6_2_min_periode.$lev6_2_max_periode."-ict-".htmlspecialchars($_POST["6-per2-ict"]);
				$_spp110	= "Kelas 6-".$lev6_2_min_periode.$lev6_2_max_periode."-add-".htmlspecialchars($_POST["6-per2-add"]);
				
				$_spp111	= "Kelas 6-".$lev6_3_min_periode.$lev6_3_max_periode."-spp-".htmlspecialchars($_POST["6-per3-spp"]);
				$_spp112	= "Kelas 6-".$lev6_3_min_periode.$lev6_3_max_periode."-ict-".htmlspecialchars($_POST["6-per3-ict"]);
				$_spp113	= "Kelas 6-".$lev6_3_min_periode.$lev6_3_max_periode."-add-".htmlspecialchars($_POST["6-per3-add"]);
				
				$_spp114	= "Kelas 6-".$lev6_4_min_periode.$lev6_4_max_periode."-spp-".htmlspecialchars($_POST["6-per4-spp"]);
				$_spp115	= "Kelas 6-".$lev6_4_min_periode.$lev6_4_max_periode."-ict-".htmlspecialchars($_POST["6-per4-ict"]);
				$_spp116	= "Kelas 6-".$lev6_4_min_periode.$lev6_4_max_periode."-add-".htmlspecialchars($_POST["6-per4-add"]);
				
				$_spp117	= "Kelas 6-".$lev6_5_min_periode.$lev6_5_max_periode."-spp-".htmlspecialchars($_POST["6-per5-spp"]);
				$_spp118	= "Kelas 6-".$lev6_5_min_periode.$lev6_5_max_periode."-ict-".htmlspecialchars($_POST["6-per5-ict"]);
				$_spp119	= "Kelas 6-".$lev6_5_min_periode.$lev6_5_max_periode."-add-".htmlspecialchars($_POST["6-per5-add"]);
				
				$_spp120	= "Kelas 6-".$lev6_6_min_periode.$lev6_6_max_periode."-spp-".htmlspecialchars($_POST["6-per6-spp"]);
				$_spp121	= "Kelas 6-".$lev6_6_min_periode.$lev6_6_max_periode."-ict-".htmlspecialchars($_POST["6-per6-ict"]);
				$_spp122	= "Kelas 6-".$lev6_6_min_periode.$lev6_6_max_periode."-add-".htmlspecialchars($_POST["6-per6-add"]);
				
				$_spp123	= "Kelas 6-angu-spp-".htmlspecialchars($_POST["6-angu-spp"]);
				$_spp124	= "Kelas 6-angu-ict-".htmlspecialchars($_POST["6-angu-ict"]);
				$_spp125	= "Kelas 6-angu-add-".htmlspecialchars($_POST["6-angu-add"]);
				
				$_spp126	= "Kelas 6-dis1-spp-".htmlspecialchars($_POST["6-dis1-spp"]);
				$_spp127	= "Kelas 6-dis1-ict-".htmlspecialchars($_POST["6-dis1-ict"]);
				$_spp128	= "Kelas 6-dis1-add-".htmlspecialchars($_POST["6-dis1-add"]);
				
				$_spp129	= "Kelas 6-dis2-spp-".htmlspecialchars($_POST["6-dis2-spp"]);
				$_spp130	= "Kelas 6-dis2-ict-".htmlspecialchars($_POST["6-dis2-ict"]);
				$_spp131	= "Kelas 6-dis2-add-".htmlspecialchars($_POST["6-dis2-add"]);
				
				$_spp132	= "Kelas 6-dis3-spp-".htmlspecialchars($_POST["6-dis3-spp"]);
				$_spp133	= "Kelas 6-dis3-ict-".htmlspecialchars($_POST["6-dis3-ict"]);
				$_spp134	= "Kelas 6-dis3-add-".htmlspecialchars($_POST["6-dis3-add"]);
				
			}
		
			// I agreed with the greatest instantly PHP programmer, Mr Mustofa Malkamal, to split these all variable to be an array. 
			//it makes us easier to send them into database with one instruction.
			
			if($_POST["j"] == "toddler" || $_POST["j"] == "pg" || $_POST["j"] == "tka" || $_POST["j"] == "tkb") {
				
				$src_input = array(
									//kelas 1
									$_spp0,$_spp1,$_spp2,$_spp3,$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,$_spp12,$_spp13,$_spp14,
									);
			}
			
			if($_POST["j"] == "sd") {
				
				$src_input = array(
									//kelas 1
									$_spp0,$_spp1,$_spp2,$_spp3,$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,$_spp12,$_spp13,$_spp14,
									//kelas 2
									$_spp15,$_spp16,$_spp17,$_spp18,$_spp19,$_spp20,$_spp21,$_spp22,$_spp23,$_spp24,$_spp25,$_spp26,$_spp27,$_spp28,$_spp29,$_spp30,$_spp31,$_spp32,
									//kelas 3
									$_spp33,$_spp34,$_spp35,$_spp36,$_spp37,$_spp38,$_spp39,$_spp40,$_spp41,$_spp42,$_spp43,$_spp44,$_spp45,$_spp46,$_spp47,$_spp48,$_spp49,$_spp50,$_spp51,$_spp52,$_spp53,
									//kelas 4
									$_spp54,$_spp55,$_spp56,$_spp57,$_spp58,$_spp59,$_spp60,$_spp61,$_spp62,$_spp63,$_spp64,$_spp65,$_spp66,$_spp67,$_spp68,$_spp69,$_spp70,$_spp71,$_spp72,$_spp73,$_spp74,$_spp75,$_spp76,$_spp77,
									//kelas 5
									$_spp78,$_spp79,$_spp80,$_spp81,$_spp82,$_spp83,$_spp84,$_spp85,$_spp86,$_spp87,$_spp88,$_spp89,$_spp90,$_spp91,$_spp92,$_spp93,$_spp94,$_spp95,$_spp96,$_spp97,$_spp98,$_spp99,$_spp100,$_spp101,$_spp102,$_spp103,$_spp104,
									//kelas 6
									$_spp105,$_spp106,$_spp107,$_spp108,$_spp109,$_spp110,$_spp111,$_spp112,$_spp113,$_spp114,$_spp115,$_spp116,$_spp117,$_spp118,$_spp119,$_spp120,$_spp121,$_spp122,$_spp123,$_spp124,$_spp125,$_spp126,$_spp127,$_spp128,$_spp129,$_spp130,$_spp131,$_spp132,$_spp133,$_spp134
									);
			}
			
			if($_POST["j"] == "smp") {
				
				$src_input = array(
									//kelas 1
									$_spp0,$_spp1,$_spp2,$_spp3,$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,$_spp12,$_spp13,$_spp14,
									//kelas 2
									$_spp15,$_spp16,$_spp17,$_spp18,$_spp19,$_spp20,$_spp21,$_spp22,$_spp23,$_spp24,$_spp25,$_spp26,$_spp27,$_spp28,$_spp29,$_spp30,$_spp31,$_spp32,
									//kelas 3
									$_spp33,$_spp34,$_spp35,$_spp36,$_spp37,$_spp38,$_spp39,$_spp40,$_spp41,$_spp42,$_spp43,$_spp44,$_spp45,$_spp46,$_spp47,$_spp48,$_spp49,$_spp50,$_spp51,$_spp52,$_spp53,
									);
			}
			
			//We have to know how many time the looping has to run.
			//So we have to set it AS MANY as variable we have from the form.					
			$data_size = count($src_input);
	
			//here is the looping 			
			for($i = 0; $i<$data_size; $i++) {
				//current variable loaded with array
				$cur_data	= $src_input[$i];
				
				//Okay, we need to explode with a dynamid the $_sppxxx variable...hahahahahahahahaahaha.... :)) lol you are mad :)).
				//the value of $_sppxxx is following this pattern...: x-yyyy-zzz 
				//the string that we want to use is x,yyyy and  zzz		
				$spp_explode	= explode("-",$cur_data);
				
				//So we have these variables,.....		
				$tingkat	= $spp_explode[0];
				$ket_disc	= $spp_explode[1];
				$item_byr	= $spp_explode[2];
				
				//we have to check whether the nominal is empty or not. If so, set it to zero (0)
				if(empty($spp_explode[3])) {
					$nominal	= 0;
				} else {
					$nominal	= $spp_explode[3];
				}
			
				//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
				//make sure that periode and level is not empty
				$src_spp	= "insert into set_spp (periode,jenjang,tingkat,ket_disc,item_byr,nominal) values ('$periode','$src_jenjang','$tingkat','$ket_disc','$item_byr','$nominal')";
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
					$redirect_url	= "mainpage.php?pl=spp_setting&j=".$src_j;
					$redirect_text	= "Nilai SPP/ICT/PTA sudah disimpan";
					
					$need_redirect	= true;
					include_once ("include/redirect.php");
				}
			}
		}
	} else {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=spp_setting";
		$redirect_text	= "Periode dan level tidak boleh kosong. silahkan lengkapi kembali";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	}
}
?>