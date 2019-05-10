<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	//these data taken from page_seeting_spp.php
	$periode		= htmlspecialchars($_POST["src_periode"]);
	
	//Variable J is needed to define, what 'jenjang' is being sent here
	$src_j			= htmlspecialchars($_POST["j"]);
	$src_jenjang	= mysql_real_escape_string($src_j);
	
	//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
	//make sure that period and level is not empty
		
	if(!empty($periode) and !empty($src_j)) {
		//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
		//So here we will make a filter to avoid data duplication.
		//Check if the new data already exist in database.
		//2 fields have to be checked are jenjang, ket_disc and period
			
		$src_check_exist	= "select * from set_spp where periode = '$periode' and jenjang = '$src_jenjang'";
		$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
		$num_check_exist	= mysql_num_rows($query_check_exist);
			
		//tell admin if the data already exist
		if($num_check_exist != 0) {
			
			//now, we would like to define, discount period for every level
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
			
		
			//Okay, we will going to the updating process if the data already exist only.
			
			if($_POST["j"] == "toddler") 	{ $src_tingkat1 = "toddler"; }
			else if($_POST["j"] == "pg") 	{ $src_tingkat1 = "pg"; }
			else if($_POST["j"] == "tka") 	{ $src_tingkat1 = "tka"; }
			else if($_POST["j"] == "tkb") 	{ $src_tingkat1 = "tkb"; }
			else if($_POST["j"] == "sd") 	{ $src_tingkat1 = "1"; }
			else if($_POST["j"] == "smp") 	{ $src_tingkat1 = "7"; }	
		
			//kelas 1
			$_spp0		= $src_tingkat1."-".$lev1_1_min_periode.$lev1_1_max_periode."-spp-".htmlspecialchars($_POST["1-per1-spp"]);
			$_spp1		= $src_tingkat1."-".$lev1_1_min_periode.$lev1_1_max_periode."-ict-".htmlspecialchars($_POST["1-per1-ict"]);
			$_spp2		= $src_tingkat1."-".$lev1_1_min_periode.$lev1_1_max_periode."-kts-".htmlspecialchars($_POST["1-per1-kts"]);
			$_spp3		= $src_tingkat1."-".$lev1_1_min_periode.$lev1_1_max_periode."-ler-".htmlspecialchars($_POST["1-per1-ler"]);
			
			//kelas 2
			if($_POST["j"] == "smp" || $_POST["j"] == "sd") {
			
				if($_POST["j"] == "sd") 		{ $src_tingkat2	= "2"; }
				else if($_POST["j"] == "smp") 	{ $src_tingkat2	= "8"; }
				
				$_spp4		= $src_tingkat2."-".$lev2_1_min_periode.$lev2_1_max_periode."-spp-".htmlspecialchars($_POST["2-per1-spp"]);
				$_spp5		= $src_tingkat2."-".$lev2_1_min_periode.$lev2_1_max_periode."-ict-".htmlspecialchars($_POST["2-per1-ict"]);
				$_spp6		= $src_tingkat2."-".$lev2_1_min_periode.$lev2_1_max_periode."-kts-".htmlspecialchars($_POST["2-per1-kts"]);
				$_spp7		= $src_tingkat2."-".$lev2_1_min_periode.$lev2_1_max_periode."-ler-".htmlspecialchars($_POST["2-per1-ler"]);
				
				$_spp8		= $src_tingkat2."-".$lev2_2_min_periode.$lev2_2_max_periode."-spp-".htmlspecialchars($_POST["2-per2-spp"]);
				$_spp9		= $src_tingkat2."-".$lev2_2_min_periode.$lev2_2_max_periode."-ict-".htmlspecialchars($_POST["2-per2-ict"]);
				$_spp10		= $src_tingkat2."-".$lev2_2_min_periode.$lev2_2_max_periode."-kts-".htmlspecialchars($_POST["2-per2-kts"]);
				$_spp11		= $src_tingkat2."-".$lev2_2_min_periode.$lev2_2_max_periode."-ler-".htmlspecialchars($_POST["2-per2-ler"]);				
							
				//kelas 3
				if($_POST["j"] == "sd") 		{ $src_tingkat3	= "3"; }
				else if($_POST["j"] == "smp") 	{ $src_tingkat3	= "9"; }
				
				$_spp12		= $src_tingkat3."-".$lev3_1_min_periode.$lev3_1_max_periode."-spp-".htmlspecialchars($_POST["3-per1-spp"]);
				$_spp13		= $src_tingkat3."-".$lev3_1_min_periode.$lev3_1_max_periode."-ict-".htmlspecialchars($_POST["3-per1-ict"]);
				$_spp14		= $src_tingkat3."-".$lev3_1_min_periode.$lev3_1_max_periode."-kts-".htmlspecialchars($_POST["3-per1-kts"]);
				$_spp15		= $src_tingkat3."-".$lev3_1_min_periode.$lev3_1_max_periode."-ler-".htmlspecialchars($_POST["3-per1-ler"]);
				
				$_spp16		= $src_tingkat3."-".$lev3_2_min_periode.$lev3_2_max_periode."-spp-".htmlspecialchars($_POST["3-per2-spp"]);
				$_spp17		= $src_tingkat3."-".$lev3_2_min_periode.$lev3_2_max_periode."-ict-".htmlspecialchars($_POST["3-per2-ict"]);
				$_spp18		= $src_tingkat3."-".$lev3_2_min_periode.$lev3_2_max_periode."-kts-".htmlspecialchars($_POST["3-per2-kts"]);
				$_spp19		= $src_tingkat3."-".$lev3_2_min_periode.$lev3_2_max_periode."-ler-".htmlspecialchars($_POST["3-per2-ler"]);
				
				$_spp20		= $src_tingkat3."-".$lev3_3_min_periode.$lev3_3_max_periode."-spp-".htmlspecialchars($_POST["3-per3-spp"]);
				$_spp21		= $src_tingkat3."-".$lev3_3_min_periode.$lev3_3_max_periode."-ict-".htmlspecialchars($_POST["3-per3-ict"]);
				$_spp22		= $src_tingkat3."-".$lev3_3_min_periode.$lev3_3_max_periode."-kts-".htmlspecialchars($_POST["3-per3-kts"]);
				$_spp23		= $src_tingkat3."-".$lev3_3_min_periode.$lev3_3_max_periode."-ler-".htmlspecialchars($_POST["3-per3-ler"]);
				
			}
			//kelas 4
			if($_POST["j"] == "sd") {
			
				$_spp24		= "4-".$lev4_1_min_periode.$lev4_1_max_periode."-spp-".htmlspecialchars($_POST["4-per1-spp"]);
				$_spp25		= "4-".$lev4_1_min_periode.$lev4_1_max_periode."-ict-".htmlspecialchars($_POST["4-per1-ict"]);
				$_spp26		= "4-".$lev4_1_min_periode.$lev4_1_max_periode."-kts-".htmlspecialchars($_POST["4-per1-kts"]);
				$_spp27		= "4-".$lev4_1_min_periode.$lev4_1_max_periode."-ler-".htmlspecialchars($_POST["4-per1-ler"]);
				
				$_spp28		= "4-".$lev4_2_min_periode.$lev4_2_max_periode."-spp-".htmlspecialchars($_POST["4-per2-spp"]);
				$_spp29		= "4-".$lev4_2_min_periode.$lev4_2_max_periode."-ict-".htmlspecialchars($_POST["4-per2-ict"]);
				$_spp30		= "4-".$lev4_2_min_periode.$lev4_2_max_periode."-kts-".htmlspecialchars($_POST["4-per2-kts"]);
				$_spp31		= "4-".$lev4_2_min_periode.$lev4_2_max_periode."-ler-".htmlspecialchars($_POST["4-per2-ler"]);
				
				$_spp32		= "4-".$lev4_3_min_periode.$lev4_3_max_periode."-spp-".htmlspecialchars($_POST["4-per3-spp"]);
				$_spp33		= "4-".$lev4_3_min_periode.$lev4_3_max_periode."-ict-".htmlspecialchars($_POST["4-per3-ict"]);
				$_spp34		= "4-".$lev4_3_min_periode.$lev4_3_max_periode."-kts-".htmlspecialchars($_POST["4-per3-kts"]);
				$_spp35		= "4-".$lev4_3_min_periode.$lev4_3_max_periode."-ler-".htmlspecialchars($_POST["4-per3-ler"]);
				
				$_spp36		= "4-".$lev4_4_min_periode.$lev4_4_max_periode."-spp-".htmlspecialchars($_POST["4-per4-spp"]);
				$_spp37		= "4-".$lev4_4_min_periode.$lev4_4_max_periode."-ict-".htmlspecialchars($_POST["4-per4-ict"]);
				$_spp38		= "4-".$lev4_4_min_periode.$lev4_4_max_periode."-kts-".htmlspecialchars($_POST["4-per4-kts"]);
				$_spp39		= "4-".$lev4_4_min_periode.$lev4_4_max_periode."-ler-".htmlspecialchars($_POST["4-per4-ler"]);
				
				//kelas 5
				$_spp40		= "5-".$lev5_1_min_periode.$lev5_1_max_periode."-spp-".htmlspecialchars($_POST["5-per1-spp"]);
				$_spp41		= "5-".$lev5_1_min_periode.$lev5_1_max_periode."-ict-".htmlspecialchars($_POST["5-per1-ict"]);
				$_spp42		= "5-".$lev5_1_min_periode.$lev5_1_max_periode."-kts-".htmlspecialchars($_POST["5-per1-kts"]);
				$_spp43		= "5-".$lev5_1_min_periode.$lev5_1_max_periode."-ler-".htmlspecialchars($_POST["5-per1-ler"]);
				
				$_spp44		= "5-".$lev5_2_min_periode.$lev5_2_max_periode."-spp-".htmlspecialchars($_POST["5-per2-spp"]);
				$_spp45		= "5-".$lev5_2_min_periode.$lev5_2_max_periode."-ict-".htmlspecialchars($_POST["5-per2-ict"]);
				$_spp46		= "5-".$lev5_2_min_periode.$lev5_2_max_periode."-kts-".htmlspecialchars($_POST["5-per2-kts"]);
				$_spp47		= "5-".$lev5_2_min_periode.$lev5_2_max_periode."-ler-".htmlspecialchars($_POST["5-per2-ler"]);
				
				$_spp48		= "5-".$lev5_3_min_periode.$lev5_3_max_periode."-spp-".htmlspecialchars($_POST["5-per3-spp"]);
				$_spp49		= "5-".$lev5_3_min_periode.$lev5_3_max_periode."-ict-".htmlspecialchars($_POST["5-per3-ict"]);
				$_spp50		= "5-".$lev5_3_min_periode.$lev5_3_max_periode."-kts-".htmlspecialchars($_POST["5-per3-kts"]);
				$_spp51		= "5-".$lev5_3_min_periode.$lev5_3_max_periode."-ler-".htmlspecialchars($_POST["5-per3-ler"]);
				
				$_spp52		= "5-".$lev5_4_min_periode.$lev5_4_max_periode."-spp-".htmlspecialchars($_POST["5-per4-spp"]);
				$_spp53		= "5-".$lev5_4_min_periode.$lev5_4_max_periode."-ict-".htmlspecialchars($_POST["5-per4-ict"]);
				$_spp54		= "5-".$lev5_4_min_periode.$lev5_4_max_periode."-kts-".htmlspecialchars($_POST["5-per4-kts"]);
				$_spp55		= "5-".$lev5_4_min_periode.$lev5_4_max_periode."-ler-".htmlspecialchars($_POST["5-per4-ler"]);
				
				$_spp56		= "5-".$lev5_5_min_periode.$lev5_5_max_periode."-spp-".htmlspecialchars($_POST["5-per5-spp"]);
				$_spp57		= "5-".$lev5_5_min_periode.$lev5_5_max_periode."-ict-".htmlspecialchars($_POST["5-per5-ict"]);
				$_spp58		= "5-".$lev5_5_min_periode.$lev5_5_max_periode."-kts-".htmlspecialchars($_POST["5-per5-kts"]);
				$_spp59		= "5-".$lev5_5_min_periode.$lev5_5_max_periode."-ler-".htmlspecialchars($_POST["5-per5-ler"]);				
				
				//kelas 6
				$_spp60	= "6-".$lev6_1_min_periode.$lev6_1_max_periode."-spp-".htmlspecialchars($_POST["6-per1-spp"]);
				$_spp61	= "6-".$lev6_1_min_periode.$lev6_1_max_periode."-ict-".htmlspecialchars($_POST["6-per1-ict"]);
				$_spp62	= "6-".$lev6_1_min_periode.$lev6_1_max_periode."-kts-".htmlspecialchars($_POST["6-per1-kts"]);
				$_spp63	= "6-".$lev6_1_min_periode.$lev6_1_max_periode."-ler-".htmlspecialchars($_POST["6-per1-ler"]);
				
				$_spp64	= "6-".$lev6_2_min_periode.$lev6_2_max_periode."-spp-".htmlspecialchars($_POST["6-per2-spp"]);
				$_spp65	= "6-".$lev6_2_min_periode.$lev6_2_max_periode."-ict-".htmlspecialchars($_POST["6-per2-ict"]);
				$_spp66	= "6-".$lev6_2_min_periode.$lev6_2_max_periode."-kts-".htmlspecialchars($_POST["6-per2-kts"]);
				$_spp67	= "6-".$lev6_2_min_periode.$lev6_2_max_periode."-ler-".htmlspecialchars($_POST["6-per2-ler"]);
				
				$_spp68	= "6-".$lev6_3_min_periode.$lev6_3_max_periode."-spp-".htmlspecialchars($_POST["6-per3-spp"]);
				$_spp69	= "6-".$lev6_3_min_periode.$lev6_3_max_periode."-ict-".htmlspecialchars($_POST["6-per3-ict"]);
				$_spp70	= "6-".$lev6_3_min_periode.$lev6_3_max_periode."-kts-".htmlspecialchars($_POST["6-per3-kts"]);
				$_spp71	= "6-".$lev6_3_min_periode.$lev6_3_max_periode."-ler-".htmlspecialchars($_POST["6-per3-ler"]);
				
				$_spp72	= "6-".$lev6_4_min_periode.$lev6_4_max_periode."-spp-".htmlspecialchars($_POST["6-per4-spp"]);
				$_spp73	= "6-".$lev6_4_min_periode.$lev6_4_max_periode."-ict-".htmlspecialchars($_POST["6-per4-ict"]);
				$_spp74	= "6-".$lev6_4_min_periode.$lev6_4_max_periode."-kts-".htmlspecialchars($_POST["6-per4-kts"]);
				$_spp75	= "6-".$lev6_4_min_periode.$lev6_4_max_periode."-ler-".htmlspecialchars($_POST["6-per4-ler"]);
				
				$_spp76	= "6-".$lev6_5_min_periode.$lev6_5_max_periode."-spp-".htmlspecialchars($_POST["6-per5-spp"]);
				$_spp77	= "6-".$lev6_5_min_periode.$lev6_5_max_periode."-ict-".htmlspecialchars($_POST["6-per5-ict"]);
				$_spp78	= "6-".$lev6_5_min_periode.$lev6_5_max_periode."-kts-".htmlspecialchars($_POST["6-per5-kts"]);
				$_spp79	= "6-".$lev6_5_min_periode.$lev6_5_max_periode."-ler-".htmlspecialchars($_POST["6-per5-ler"]);
				
				$_spp80	= "6-".$lev6_6_min_periode.$lev6_6_max_periode."-spp-".htmlspecialchars($_POST["6-per6-spp"]);
				$_spp81	= "6-".$lev6_6_min_periode.$lev6_6_max_periode."-ict-".htmlspecialchars($_POST["6-per6-ict"]);
				$_spp82	= "6-".$lev6_6_min_periode.$lev6_6_max_periode."-kts-".htmlspecialchars($_POST["6-per6-kts"]);
				$_spp83	= "6-".$lev6_6_min_periode.$lev6_6_max_periode."-ler-".htmlspecialchars($_POST["6-per6-ler"]);
				
			}
		
			// I agreed with the greatest instantly PHP programmer, Mr Mustofa Malkamal, to split these all variable to be an array. 
			//it makes us easier to send them into database with one instruction.
			if($_POST["j"] == "toddler" || $_POST["j"] == "pg" || $_POST["j"] == "tka" || $_POST["j"] == "tkb") {
				
				$src_input = array(
									//kelas 1
									$_spp0,$_spp1,$_spp2,$_spp3
									);
			}
			
			if($_POST["j"] == "sd") {
				
				$src_input = array(
									//kelas 1
									$_spp0,$_spp1,$_spp2,$_spp3,
									//kelas 2
									$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,
									//kelas 3
									$_spp12,$_spp13,$_spp14,$_spp15,$_spp16,$_spp17,$_spp18,$_spp19,$_spp20,$_spp21,$_spp22,$_spp23,
									//kelas 4
									$_spp24,$_spp25,$_spp26,$_spp27,$_spp28,$_spp29,$_spp30,$_spp31,$_spp32,$_spp33,$_spp34,$_spp35,$_spp36,$_spp37,$_spp38,$_spp39,
									//kelas 5
									$_spp40,$_spp41,$_spp42,$_spp43,$_spp44,$_spp45,$_spp46,$_spp47,$_spp48,$_spp49,$_spp50,$_spp51,$_spp52,$_spp53,$_spp54,$_spp55,$_spp56,$_spp57,$_spp58,$_spp59,
									//kelas 6
									$_spp60,$_spp61,$_spp62,$_spp63,$_spp64,$_spp65,$_spp66,$_spp67,$_spp68,$_spp69,$_spp70,$_spp71,$_spp72,$_spp73,$_spp74,$_spp75,$_spp76,$_spp77,$_spp78,$_spp79,$_spp80,$_spp81,$_spp82,$_spp83
									);
			}
			
			if($_POST["j"] == "smp") {
				
				$src_input = array(
									//kelas 1
									$_spp0,$_spp1,$_spp2,$_spp3,
									//kelas 2
									$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,
									//kelas 3
									$_spp12,$_spp13,$_spp14,$_spp15,$_spp16,$_spp17,$_spp18,$_spp19,$_spp20,$_spp21,$_spp22,$_spp23
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
				$src_spp	= "update set_spp set nominal = '$nominal' where periode = '$periode' and jenjang = '$src_jenjang' and tingkat = '$tingkat' and ket_disc = '$ket_disc' and item_byr = '$item_byr'";
				$query_spp	= mysqli_query($mysql_connect, $src_spp) or die ("There is an error with mysql: ".mysql_error());
				
				if($query_spp) {
					//---------------------------------------
					//here are variables that used in log.php
					include_once("include/url.php");
					$activity	= "Edit SPP $src_j value";
					$url		= curPageURL();
					$id			= $_SESSION["id"];
					$need_log	= true;
					include_once("include/log.php");
					//---------------------------------------
					
					$redirect_path	= "";
					$redirect_icon	= "images/icon_true.png";
					$redirect_url	= "mainpage.php?pl=spp_setting&j=$src_j";
					$redirect_text	= "Perubahan nilai SPP $src_j sudah disimpan";
					
					$need_redirect	= true;
					include_once ("include/redirect.php");
				}
			}
		} else {
			//??????????????????????????
			//??????????????????????????
			//??????????????????????????	
			$redirect_path	= "";
			$redirect_icon	= "images/icon_false.png";
			$redirect_url	= "mainpage.php?pl=spp_sd_setting&j=$src_j";
			$redirect_text	= "Pengaturan nilai SPP untuk tahun $periode dan jenjang $src_j, belum dilalukan. Anda akan diarahkan ke halaman pembuatan nilai SPP untuk jenjang $src_j";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
		}
	} else {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=spp_edit";
		$redirect_text	= "Periode dan level tidak boleh kosong. silahkan lengkapi kembali";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	}
}
?>