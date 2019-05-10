<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	//these data taken from page_seeting_spp.php
	$period		= htmlspecialchars($_POST["src_period"]);
	$j			= htmlspecialchars($_POST["j"]);
	
	if($j == "toddler") 	{ $page_title = "Toddler"; }
	else if($j == "pg") 	{ $page_title = "Play Group"; }
	else if($j == "tka") 	{ $page_title = "TK A"; }
	else if($j == "tkb") 	{ $page_title = "TK B"; }
	else if($j == "sd") 	{ $page_title = "SD"; }
	else if($j == "smd") 	{ $page_title = "SMP"; }	
	
	//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
	//make sure that period and level is not empty
		
	if(!empty($period) and !empty($level)) {
		//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
		//So here we will make a filter to avoid data duplication.
		//Check if the new data already exist in database.
		//2 fields have to be checked are jenjang, ket_disc and period
			
		$src_check_exist	= "select * from set_spp where periode = '$period' and jenjang = '$j'";
		$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
		$num_check_exist	= mysql_num_rows($query_check_exist);
			
		//tell admin if the data already exist
		if($num_check_exist != 0) {
				
			$redirect_path	= "";
			$redirect_icon	= "images/icon_false.png";
			$redirect_url	= "mainpage.php?pl=spp_sd_setting";
			$redirect_text	= "Mohon maaf, pengaturan SPP dan item lainnya untuk jenjang $page_title, <br>tahun ajaran $period sudah dilakukan. <br>Silahkan lakukan proses edit untuk melakukan perubahan nilai.";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
			
		} else {
			//if the data hasnt be defined, go ahead.
			///////////////////////////////////////////////////////////////
		
			//now, we would like to define, discount period for every level
			// here we go
			
			//level 1
			$lev1_1_min_period	= 	substr($period,-9,2);
			$lev1_1_max_period	=	substr($period,-2,2);
			
			//level 2
			$lev2_1_min_period	= 	substr($period,-9,2)-1;
			$lev2_1_max_period	=	substr($period,-2,2)-1;
			
			$lev2_2_min_period	= 	substr($period,-9,2);
			$lev2_2_max_period	=	substr($period,-2,2);
			
			//level 3
			$lev3_1_min_period	= 	substr($period,-9,2)-2;
			$lev3_1_max_period	=	substr($period,-2,2)-2;
			
			$lev3_2_min_period	= 	substr($period,-9,2)-1;
			$lev3_2_max_period	=	substr($period,-2,2)-1;
			
			$lev3_3_min_period	= 	substr($period,-9,2);
			$lev3_3_max_period	=	substr($period,-2,2);
			
			//level 4
			$lev4_1_min_period	= 	substr($period,-9,2)-3;
			$lev4_1_max_period	=	substr($period,-2,2)-3;
			
			$lev4_2_min_period	= 	substr($period,-9,2)-2;
			$lev4_2_max_period	=	substr($period,-2,2)-2;
			
			$lev4_3_min_period	= 	substr($period,-9,2)-1;
			$lev4_3_max_period	=	substr($period,-2,2)-1;
			
			$lev4_4_min_period	= 	substr($period,-9,2);
			$lev4_4_max_period	=	substr($period,-2,2);
			
			//level 5
			$lev5_1_min_period	= 	substr($period,-9,2)-4;
			$lev5_1_max_period	=	substr($period,-2,2)-4;
			
			$lev5_2_min_period	= 	substr($period,-9,2)-3;
			$lev5_2_max_period	=	substr($period,-2,2)-3;
			
			$lev5_3_min_period	= 	substr($period,-9,2)-2;
			$lev5_3_max_period	=	substr($period,-2,2)-2;
			
			$lev5_4_min_period	= 	substr($period,-9,2)-1;
			$lev5_4_max_period	=	substr($period,-2,2)-1;
			
			$lev5_5_min_period	= 	substr($period,-9,2);
			$lev5_5_max_period	=	substr($period,-2,2);
			
			//level 6
			$lev6_1_min_period	= 	substr($period,-9,2)-5;
			$lev6_1_max_period	=	substr($period,-2,2)-5;
			
			$lev6_2_min_period	= 	substr($period,-9,2)-4;
			$lev6_2_max_period	=	substr($period,-2,2)-4;
			
			$lev6_3_min_period	= 	substr($period,-9,2)-3;
			$lev6_3_max_period	=	substr($period,-2,2)-3;
			
			$lev6_4_min_period	= 	substr($period,-9,2)-2;
			$lev6_4_max_period	=	substr($period,-2,2)-2;
			
			$lev6_5_min_period	= 	substr($period,-9,2)-1;
			$lev6_5_max_period	=	substr($period,-2,2)-1;
			
			$lev6_6_min_period	= 	substr($period,-9,2);
			$lev6_6_max_period	=	substr($period,-2,2);
		
			
	
			//This is the largest amount of variables that i ever made,.....
			//Okay, you may say that, this all variables are sucks. But how could i do to make it in another way buddy????? couldn't you???
			//Ask kamal, he must be aggreed with me...:) lol...:))
		
			//kelas 1
			if($j == "toddler") 	{ $src_tingkat1 = "1"; }
			else if($j == "pg") 	{ $src_tingkat1 = "1"; }
			else if($j == "tka") 	{ $src_tingkat1 = "1"; }
			else if($j == "tkb") 	{ $src_tingkat1 = "1"; }
			else if($j == "sd") 	{ $src_tingkat1 = "1"; }
			else if($j == "smd") 	{ $src_tingkat1 = "7"; }	
	
			$_spp0		= $src_tingkat1."-".$lev1_1_min_period.$lev1_1_max_period."-spp-".htmlspecialchars($_POST["1-per1-spp"]);
			$_spp1		= $src_tingkat1."-".$lev1_1_min_period.$lev1_1_max_period."-ict-".htmlspecialchars($_POST["1-per1-ict"]);
			$_spp2		= $src_tingkat1."-".$lev1_1_min_period.$lev1_1_max_period."-add-".htmlspecialchars($_POST["1-per1-add"]);
			
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
			 if($j == "smp" || $j == "sd") {
			 
			 	if($j == "sd") 	{ $src_tingkat2 = "2"; }
				else if($j == "smd") 	{ $src_tingkat2 = "8"; }
			 
				$_spp15		= $src_tingkat2."-".$lev2_1_min_period.$lev2_1_max_period."-spp-".htmlspecialchars($_POST["2-per1-spp"]);
				$_spp16		= $src_tingkat2."-".$lev2_1_min_period.$lev2_1_max_period."-ict-".htmlspecialchars($_POST["2-per1-ict"]);
				$_spp17		= $src_tingkat2."-".$lev2_1_min_period.$lev2_1_max_period."-add-".htmlspecialchars($_POST["2-per1-add"]);
				
				$_spp18		= $src_tingkat2."-".$lev2_2_min_period.$lev2_2_max_period."-spp-".htmlspecialchars($_POST["2-per2-spp"]);
				$_spp19		= $src_tingkat2."-".$lev2_2_min_period.$lev2_2_max_period."-ict-".htmlspecialchars($_POST["2-per2-ict"]);
				$_spp20		= $src_tingkat2."-".$lev2_2_min_period.$lev2_2_max_period."-add-".htmlspecialchars($_POST["2-per2-add"]);
				
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
				
			}
			
			//kelas 3
			if($j == "smp" || $j == "sd") {
			 
			 	if($j == "sd") 	{ $src_tingkat3 = "3"; }
				else if($j == "smd") 	{ $src_tingkat3 = "9"; }
				
				$_spp33		= $src_tingkat3."-".$lev3_1_min_period.$lev3_1_max_period."-spp-".htmlspecialchars($_POST["3-per1-spp"]);
				$_spp34		= $src_tingkat3."-".$lev3_1_min_period.$lev3_1_max_period."-ict-".htmlspecialchars($_POST["3-per1-ict"]);
				$_spp35		= $src_tingkat3."-".$lev3_1_min_period.$lev3_1_max_period."-add-".htmlspecialchars($_POST["3-per1-add"]);
				
				$_spp36		= $src_tingkat3."-".$lev3_2_min_period.$lev3_2_max_period."-spp-".htmlspecialchars($_POST["3-per2-spp"]);
				$_spp37		= $src_tingkat3."-".$lev3_2_min_period.$lev3_2_max_period."-ict-".htmlspecialchars($_POST["3-per2-ict"]);
				$_spp38		= $src_tingkat3."-".$lev3_2_min_period.$lev3_2_max_period."-add-".htmlspecialchars($_POST["3-per2-add"]);
				
				$_spp39		= $src_tingkat3."-".$lev3_3_min_period.$lev3_3_max_period."-spp-".htmlspecialchars($_POST["3-per3-spp"]);
				$_spp40		= $src_tingkat3."-".$lev3_3_min_period.$lev3_3_max_period."-ict-".htmlspecialchars($_POST["3-per3-ict"]);
				$_spp41		= $src_tingkat3."-".$lev3_3_min_period.$lev3_3_max_period."-add-".htmlspecialchars($_POST["3-per3-add"]);
				
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
			if($j == "sd") {
				
				$_spp54		= "4-".$lev4_1_min_period.$lev4_1_max_period."-spp-".htmlspecialchars($_POST["4-per1-spp"]);
				$_spp55		= "4-".$lev4_1_min_period.$lev4_1_max_period."-ict-".htmlspecialchars($_POST["4-per1-ict"]);
				$_spp56		= "4-".$lev4_1_min_period.$lev4_1_max_period."-add-".htmlspecialchars($_POST["4-per1-add"]);
				
				$_spp57		= "4-".$lev4_2_min_period.$lev4_2_max_period."-spp-".htmlspecialchars($_POST["4-per2-spp"]);
				$_spp58		= "4-".$lev4_2_min_period.$lev4_2_max_period."-ict-".htmlspecialchars($_POST["4-per2-ict"]);
				$_spp59		= "4-".$lev4_2_min_period.$lev4_2_max_period."-add-".htmlspecialchars($_POST["4-per2-add"]);
				
				$_spp60		= "4-".$lev4_3_min_period.$lev4_3_max_period."-spp-".htmlspecialchars($_POST["4-per3-spp"]);
				$_spp61		= "4-".$lev4_3_min_period.$lev4_3_max_period."-ict-".htmlspecialchars($_POST["4-per3-ict"]);
				$_spp62		= "4-".$lev4_3_min_period.$lev4_3_max_period."-add-".htmlspecialchars($_POST["4-per3-add"]);
				
				$_spp63		= "4-".$lev4_4_min_period.$lev4_4_max_period."-spp-".htmlspecialchars($_POST["4-per4-spp"]);
				$_spp64		= "4-".$lev4_4_min_period.$lev4_4_max_period."-ict-".htmlspecialchars($_POST["4-per4-ict"]);
				$_spp65		= "4-".$lev4_4_min_period.$lev4_4_max_period."-add-".htmlspecialchars($_POST["4-per4-add"]);
				
				$_spp66		= "4-angu-spp-".htmlspecialchars($_POST["4-angu-spp"]);
				$_spp67		= "4-angu-ict-".htmlspecialchars($_POST["4-angu-ict"]);
				$_spp68		= "4-angu-add-".htmlspecialchars($_POST["4-angu-add"]);
				
				$_spp69		= "4-dis1-spp-".htmlspecialchars($_POST["4-dis1-spp"]);
				$_spp70		= "4-dis1-ict-".htmlspecialchars($_POST["4-dis1-ict"]);
				$_spp71		= "4-dis1-add-".htmlspecialchars($_POST["4-dis1-add"]);
				
				$_spp72		= "4-dis2-spp-".htmlspecialchars($_POST["4-dis2-spp"]);
				$_spp73		= "4-dis2-ict-".htmlspecialchars($_POST["4-dis2-ict"]);
				$_spp74		= "4-dis2-add-".htmlspecialchars($_POST["4-dis2-add"]);
				
				$_spp75		= "4-dis3-spp-".htmlspecialchars($_POST["4-dis3-spp"]);
				$_spp76		= "4-dis3-ict-".htmlspecialchars($_POST["4-dis3-ict"]);
				$_spp77		= "4-dis3-add-".htmlspecialchars($_POST["4-dis3-add"]);
			
			}
			
			//kelas 5
			if($j == "sd") {
				
				$_spp78		= "5-".$lev5_1_min_period.$lev5_1_max_period."-spp-".htmlspecialchars($_POST["5-per1-spp"]);
				$_spp79		= "5-".$lev5_1_min_period.$lev5_1_max_period."-ict-".htmlspecialchars($_POST["5-per1-ict"]);
				$_spp80		= "5-".$lev5_1_min_period.$lev5_1_max_period."-add-".htmlspecialchars($_POST["5-per1-add"]);
				
				$_spp81		= "5-".$lev5_2_min_period.$lev5_2_max_period."-spp-".htmlspecialchars($_POST["5-per2-spp"]);
				$_spp82		= "5-".$lev5_2_min_period.$lev5_2_max_period."-ict-".htmlspecialchars($_POST["5-per2-ict"]);
				$_spp83		= "5-".$lev5_2_min_period.$lev5_2_max_period."-add-".htmlspecialchars($_POST["5-per2-add"]);
				
				$_spp84		= "5-".$lev5_3_min_period.$lev5_3_max_period."-spp-".htmlspecialchars($_POST["5-per3-spp"]);
				$_spp85		= "5-".$lev5_3_min_period.$lev5_3_max_period."-ict-".htmlspecialchars($_POST["5-per3-ict"]);
				$_spp86		= "5-".$lev5_3_min_period.$lev5_3_max_period."-add-".htmlspecialchars($_POST["5-per3-add"]);
				
				$_spp87		= "5-".$lev5_4_min_period.$lev5_4_max_period."-spp-".htmlspecialchars($_POST["5-per4-spp"]);
				$_spp88		= "5-".$lev5_4_min_period.$lev5_4_max_period."-ict-".htmlspecialchars($_POST["5-per4-ict"]);
				$_spp89		= "5-".$lev5_4_min_period.$lev5_4_max_period."-add-".htmlspecialchars($_POST["5-per4-add"]);
				
				$_spp90		= "5-".$lev5_5_min_period.$lev5_5_max_period."-spp-".htmlspecialchars($_POST["5-per5-spp"]);
				$_spp91		= "5-".$lev5_5_min_period.$lev5_5_max_period."-ict-".htmlspecialchars($_POST["5-per5-ict"]);
				$_spp92		= "5-".$lev5_5_min_period.$lev5_5_max_period."-add-".htmlspecialchars($_POST["5-per5-add"]);
				
				$_spp93		= "5-angu-spp-".htmlspecialchars($_POST["5-angu-spp"]);
				$_spp94		= "5-angu-ict-".htmlspecialchars($_POST["5-angu-ict"]);
				$_spp95		= "5-angu-add-".htmlspecialchars($_POST["5-angu-add"]);
				
				$_spp96		= "5-dis1-spp-".htmlspecialchars($_POST["5-dis1-spp"]);
				$_spp97		= "5-dis1-ict-".htmlspecialchars($_POST["5-dis1-ict"]);
				$_spp98		= "5-dis1-add-".htmlspecialchars($_POST["5-dis1-add"]);
				
				$_spp99		= "5-dis2-spp-".htmlspecialchars($_POST["5-dis2-spp"]);
				$_spp100	= "5-dis2-ict-".htmlspecialchars($_POST["5-dis2-ict"]);
				$_spp101	= "5-dis2-add-".htmlspecialchars($_POST["5-dis2-add"]);
				
				$_spp102	= "5-dis3-spp-".htmlspecialchars($_POST["5-dis3-spp"]);
				$_spp103	= "5-dis3-ict-".htmlspecialchars($_POST["5-dis3-ict"]);
				$_spp104	= "5-dis3-add-".htmlspecialchars($_POST["5-dis3-add"]);
			
			}
			
			//kelas 6
			if($j == "sd") {
			
				$_spp105	= "6-".$lev6_1_min_period.$lev6_1_max_period."-spp-".htmlspecialchars($_POST["6-per1-spp"]);
				$_spp106	= "6-".$lev6_1_min_period.$lev6_1_max_period."-ict-".htmlspecialchars($_POST["6-per1-ict"]);
				$_spp107	= "6-".$lev6_1_min_period.$lev6_1_max_period."-add-".htmlspecialchars($_POST["6-per1-add"]);
				
				$_spp108	= "6-".$lev6_2_min_period.$lev6_2_max_period."-spp-".htmlspecialchars($_POST["6-per2-spp"]);
				$_spp109	= "6-".$lev6_2_min_period.$lev6_2_max_period."-ict-".htmlspecialchars($_POST["6-per2-ict"]);
				$_spp110	= "6-".$lev6_2_min_period.$lev6_2_max_period."-add-".htmlspecialchars($_POST["6-per2-add"]);
				
				$_spp111	= "6-".$lev6_3_min_period.$lev6_3_max_period."-spp-".htmlspecialchars($_POST["6-per3-spp"]);
				$_spp112	= "6-".$lev6_3_min_period.$lev6_3_max_period."-ict-".htmlspecialchars($_POST["6-per3-ict"]);
				$_spp113	= "6-".$lev6_3_min_period.$lev6_3_max_period."-add-".htmlspecialchars($_POST["6-per3-add"]);
				
				$_spp114	= "6-".$lev6_4_min_period.$lev6_4_max_period."-spp-".htmlspecialchars($_POST["6-per4-spp"]);
				$_spp115	= "6-".$lev6_4_min_period.$lev6_4_max_period."-ict-".htmlspecialchars($_POST["6-per4-ict"]);
				$_spp116	= "6-".$lev6_4_min_period.$lev6_4_max_period."-add-".htmlspecialchars($_POST["6-per4-add"]);
				
				$_spp117	= "6-".$lev6_5_min_period.$lev6_5_max_period."-spp-".htmlspecialchars($_POST["6-per5-spp"]);
				$_spp118	= "6-".$lev6_5_min_period.$lev6_5_max_period."-ict-".htmlspecialchars($_POST["6-per5-ict"]);
				$_spp119	= "6-".$lev6_5_min_period.$lev6_5_max_period."-add-".htmlspecialchars($_POST["6-per5-add"]);
				
				$_spp120	= "6-".$lev6_6_min_period.$lev6_6_max_period."-spp-".htmlspecialchars($_POST["6-per6-spp"]);
				$_spp121	= "6-".$lev6_6_min_period.$lev6_6_max_period."-ict-".htmlspecialchars($_POST["6-per6-ict"]);
				$_spp122	= "6-".$lev6_6_min_period.$lev6_6_max_period."-add-".htmlspecialchars($_POST["6-per6-add"]);
				
				$_spp123	= "6-angu-spp-".htmlspecialchars($_POST["6-angu-spp"]);
				$_spp124	= "6-angu-ict-".htmlspecialchars($_POST["6-angu-ict"]);
				$_spp125	= "6-angu-add-".htmlspecialchars($_POST["6-angu-add"]);
				
				$_spp126	= "6-dis1-spp-".htmlspecialchars($_POST["6-dis1-spp"]);
				$_spp127	= "6-dis1-ict-".htmlspecialchars($_POST["6-dis1-ict"]);
				$_spp128	= "6-dis1-add-".htmlspecialchars($_POST["6-dis1-add"]);
				
				$_spp129	= "6-dis2-spp-".htmlspecialchars($_POST["6-dis2-spp"]);
				$_spp130	= "6-dis2-ict-".htmlspecialchars($_POST["6-dis2-ict"]);
				$_spp131	= "6-dis2-add-".htmlspecialchars($_POST["6-dis2-add"]);
				
				$_spp132	= "6-dis3-spp-".htmlspecialchars($_POST["6-dis3-spp"]);
				$_spp133	= "6-dis3-ict-".htmlspecialchars($_POST["6-dis3-ict"]);
				$_spp134	= "6-dis3-add-".htmlspecialchars($_POST["6-dis3-add"]);
			
			}
		
			// I agreed with the greatest instantly PHP programmer, Mr Mustofa Malkamal, to split these all variable to be an array. 
			//it makes us easier to send them into database with one instruction.
			$src_input_1 = array(
								//kelas 1
								$_spp0,$_spp1,$_spp2,$_spp3,$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,$_spp12,$_spp13,$_spp14,
								);
								
			$src_input_2 = array(
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
								
			$src_input_3 = array(
								//kelas 1
								$_spp0,$_spp1,$_spp2,$_spp3,$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,$_spp12,$_spp13,$_spp14,
								//kelas 2
								$_spp15,$_spp16,$_spp17,$_spp18,$_spp19,$_spp20,$_spp21,$_spp22,$_spp23,$_spp24,$_spp25,$_spp26,$_spp27,$_spp28,$_spp29,$_spp30,$_spp31,$_spp32,
								//kelas 3
								$_spp33,$_spp34,$_spp35,$_spp36,$_spp37,$_spp38,$_spp39,$_spp40,$_spp41,$_spp42,$_spp43,$_spp44,$_spp45,$_spp46,$_spp47,$_spp48,$_spp49,$_spp50,$_spp51,$_spp52,$_spp53,
								);
			
			
			if($j == "toddler" || $j == "pg" || $j == "tka" || $j == "tkb") { 
				$src_input = $src_input_1; 
			}
			else if($j == "sd") { 
				$src_input = $src_input_2; 
			}
			else if($j == "smd") { 
				$src_input = $src_input_3; 
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
				$jenjang	= $spp_explode[0];
				$ket_disc	= $spp_explode[1];
				$item_byr	= $spp_explode[2];
				
				//we have to check whether the nominal is empty or not. If so, set it to zero (0)
				if(empty($spp_explode[3])) {
					$nominal	= 0;
				} else {
					$nominal	= $spp_explode[3];
				}
			
				//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
				//make sure that period and level is not empty
				$src_spp	= "insert into set_spp (periode,level,jenjang,ket_disc,item_byr,nominal) values ('$period','$level','$jenjang','$ket_disc','$item_byr','$nominal')";
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
					$redirect_url	= "mainpage.php?pl=spp_sd_setting";
					$redirect_text	= "Nilai SPP/ICT/PTA sudah disimpan";
					
					$need_redirect	= true;
					include_once ("include/redirect.php");
				}
			}
		}
	} else {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=spp_sd_setting";
		$redirect_text	= "Periode dan level tidak boleh kosong. silahkan lengkapi kembali";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	}
}
?>