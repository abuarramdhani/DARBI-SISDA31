<?PHP
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {

	//these data taken from page_seeting_spp.php
	$period		= htmlspecialchars($_POST["period"]);
	$level		= "tk";
	
	//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
	//make sure that period and level is not empty
		
	if(!empty($period) and !empty($level)) {
		//in this section, it is important for finance adminitrator to avoid data duplication when they insert new data. 
		//So here we will make a filter to avoid data duplication.
		//Check if the new data already exist in database.
		//2 fields have to be checked are jenjang, ket_disc and period
			
		$src_check_exist	= "select * from set_spp where periode = '$period' and level = '$level'";
		$query_check_exist	= mysqli_query($mysql_connect, $src_check_exist) or die("There is an error with mysql: ".mysql_error());
		$num_check_exist	= mysql_num_rows($query_check_exist);
			
		//tell admin if the data already exist
		if($num_check_exist != 0) {
			
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
			
		
			//Okay, we will going to the updating process if the data already exist only.
		
			//kelas 1
			$_spp0		= "1-".$lev1_1_min_period.$lev1_1_max_period."-spp-".htmlspecialchars($_POST["1-per1-spp"]);
			$_spp1		= "1-".$lev1_1_min_period.$lev1_1_max_period."-ict-".htmlspecialchars($_POST["1-per1-ict"]);
			$_spp2		= "1-".$lev1_1_min_period.$lev1_1_max_period."-add-".htmlspecialchars($_POST["1-per1-add"]);
			
			$_spp3		= "1-angu-spp-".htmlspecialchars($_POST["1-angu-spp"]);
			$_spp4		= "1-angu-ict-".htmlspecialchars($_POST["1-angu-ict"]);
			$_spp5		= "1-angu-add-".htmlspecialchars($_POST["1-angu-add"]);
			
			$_spp6		= "1-dis1-spp-".htmlspecialchars($_POST["1-dis1-spp"]);
			$_spp7		= "1-dis1-ict-".htmlspecialchars($_POST["1-dis1-ict"]);
			$_spp8		= "1-dis1-add-".htmlspecialchars($_POST["1-dis1-add"]);
			
			$_spp9		= "1-dis2-spp-".htmlspecialchars($_POST["1-dis2-spp"]);
			$_spp10		= "1-dis2-ict-".htmlspecialchars($_POST["1-dis2-ict"]);
			$_spp11		= "1-dis2-add-".htmlspecialchars($_POST["1-dis2-add"]);
			
			$_spp12		= "1-dis3-spp-".htmlspecialchars($_POST["1-dis3-spp"]);
			$_spp13		= "1-dis3-ict-".htmlspecialchars($_POST["1-dis3-ict"]);
			$_spp14		= "1-dis3-add-".htmlspecialchars($_POST["1-dis3-add"]);
			
			//kelas 2
			$_spp15		= "2-".$lev2_1_min_period.$lev2_1_max_period."-spp-".htmlspecialchars($_POST["2-per1-spp"]);
			$_spp16		= "2-".$lev2_1_min_period.$lev2_1_max_period."-ict-".htmlspecialchars($_POST["2-per1-ict"]);
			$_spp17		= "2-".$lev2_1_min_period.$lev2_1_max_period."-add-".htmlspecialchars($_POST["2-per1-add"]);
			
			$_spp18		= "2-".$lev2_2_min_period.$lev2_2_max_period."-spp-".htmlspecialchars($_POST["2-per2-spp"]);
			$_spp19		= "2-".$lev2_2_min_period.$lev2_2_max_period."-ict-".htmlspecialchars($_POST["2-per2-ict"]);
			$_spp20		= "2-".$lev2_2_min_period.$lev2_2_max_period."-add-".htmlspecialchars($_POST["2-per2-add"]);
			
			$_spp21		= "2-angu-spp-".htmlspecialchars($_POST["2-angu-spp"]);
			$_spp22		= "2-angu-ict-".htmlspecialchars($_POST["2-angu-ict"]);
			$_spp23		= "2-angu-add-".htmlspecialchars($_POST["2-angu-add"]);
			
			$_spp24		= "2-dis1-spp-".htmlspecialchars($_POST["2-dis1-spp"]);
			$_spp25		= "2-dis1-ict-".htmlspecialchars($_POST["2-dis1-ict"]);
			$_spp26		= "2-dis1-add-".htmlspecialchars($_POST["2-dis1-add"]);
			
			$_spp27		= "2-dis2-spp-".htmlspecialchars($_POST["2-dis2-spp"]);
			$_spp28		= "2-dis2-ict-".htmlspecialchars($_POST["2-dis2-ict"]);
			$_spp29		= "2-dis2-add-".htmlspecialchars($_POST["2-dis2-add"]);
			
			$_spp30		= "2-dis3-spp-".htmlspecialchars($_POST["2-dis3-spp"]);
			$_spp31		= "2-dis3-ict-".htmlspecialchars($_POST["2-dis3-ict"]);
			$_spp32		= "2-dis3-add-".htmlspecialchars($_POST["2-dis3-add"]);
			
			//kelas 3
			$_spp33		= "3-".$lev3_1_min_period.$lev3_1_max_period."-spp-".htmlspecialchars($_POST["3-per1-spp"]);
			$_spp34		= "3-".$lev3_1_min_period.$lev3_1_max_period."-ict-".htmlspecialchars($_POST["3-per1-ict"]);
			$_spp35		= "3-".$lev3_1_min_period.$lev3_1_max_period."-add-".htmlspecialchars($_POST["3-per1-add"]);
			
			$_spp36		= "3-".$lev3_2_min_period.$lev3_2_max_period."-spp-".htmlspecialchars($_POST["3-per2-spp"]);
			$_spp37		= "3-".$lev3_2_min_period.$lev3_2_max_period."-ict-".htmlspecialchars($_POST["3-per2-ict"]);
			$_spp38		= "3-".$lev3_2_min_period.$lev3_2_max_period."-add-".htmlspecialchars($_POST["3-per2-add"]);
			
			$_spp39		= "3-".$lev3_3_min_period.$lev3_3_max_period."-spp-".htmlspecialchars($_POST["3-per3-spp"]);
			$_spp40		= "3-".$lev3_3_min_period.$lev3_3_max_period."-ict-".htmlspecialchars($_POST["3-per3-ict"]);
			$_spp41		= "3-".$lev3_3_min_period.$lev3_3_max_period."-add-".htmlspecialchars($_POST["3-per3-add"]);
			
			$_spp42		= "3-angu-spp-".htmlspecialchars($_POST["3-angu-spp"]);
			$_spp43		= "3-angu-ict-".htmlspecialchars($_POST["3-angu-ict"]);
			$_spp44		= "3-angu-add-".htmlspecialchars($_POST["3-angu-add"]);
			
			$_spp45		= "3-dis1-spp-".htmlspecialchars($_POST["3-dis1-spp"]);
			$_spp46		= "3-dis1-ict-".htmlspecialchars($_POST["3-dis1-ict"]);
			$_spp47		= "3-dis1-add-".htmlspecialchars($_POST["3-dis1-add"]);
			
			$_spp48		= "3-dis2-spp-".htmlspecialchars($_POST["3-dis2-spp"]);
			$_spp49		= "3-dis2-ict-".htmlspecialchars($_POST["3-dis2-ict"]);
			$_spp50		= "3-dis2-add-".htmlspecialchars($_POST["3-dis2-add"]);
			
			$_spp51		= "3-dis3-spp-".htmlspecialchars($_POST["3-dis3-spp"]);
			$_spp52		= "3-dis3-ict-".htmlspecialchars($_POST["3-dis3-ict"]);
			$_spp53		= "3-dis3-add-".htmlspecialchars($_POST["3-dis3-add"]);
		
			// I agreed with the greatest instantly PHP programmer, Mr Mustofa Malkamal, to split these all variable to be an array. 
			//it makes us easier to send them into database with one instruction.
			$src_input = array(
								//kelas 1
								$_spp0,$_spp1,$_spp2,$_spp3,$_spp4,$_spp5,$_spp6,$_spp7,$_spp8,$_spp9,$_spp10,$_spp11,$_spp12,$_spp13,$_spp14,
								//kelas 2
								$_spp15,$_spp16,$_spp17,$_spp18,$_spp19,$_spp20,$_spp21,$_spp22,$_spp23,$_spp24,$_spp25,$_spp26,$_spp27,$_spp28,$_spp29,$_spp30,$_spp31,$_spp32,
								//kelas 3
								$_spp33,$_spp34,$_spp35,$_spp36,$_spp37,$_spp38,$_spp39,$_spp40,$_spp41,$_spp42,$_spp43,$_spp44,$_spp45,$_spp46,$_spp47,$_spp48,$_spp49,$_spp50,$_spp51,$_spp52,$_spp53
								);
			
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
				$nominal	= $spp_explode[3];
			
				//You are a lucky person, because you find the query for inserting our sucks values here. here we go buddy... :)
				//make sure that period and level is not empty
				$src_spp	= "update set_spp set nominal = '$nominal' where periode = '$period' and level = '$level' and jenjang = '$jenjang' and ket_disc = '$ket_disc' and item_byr = '$item_byr'";
				$query_spp	= mysqli_query($mysql_connect, $src_spp) or die ("There is an error with mysql: ".mysql_error());
				
				if($query_spp) {
					//---------------------------------------
					//here are variables that used in log.php
					include_once("include/url.php");
					$activity	= "Edit SPP TK value";
					$url		= curPageURL();
					$id			= $_SESSION["id"];
					$need_log	= true;
					include_once("include/log.php");
					//---------------------------------------
					
					$redirect_path	= "";
					$redirect_icon	= "images/icon_true.png";
					$redirect_url	= "mainpage.php?pl=spp_tk_setting";
					$redirect_text	= "Perubahan nilai SPP Play Group/TK A/TK B sudah disimpan";
					
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
			$redirect_url	= "mainpage.php?pl=spp_tk_setting";
			$redirect_text	= "Pengaturan nilai SPP untuk tahun $period dan level $level, belum dilalukan. Anda akan diarahkan kehalaman pembuatan nilai SPP untuk Play Group/TK A/TK B";
			
			$need_redirect	= true;
			include_once ("include/redirect.php");
		}
	} else {
	
		$redirect_path	= "";
		$redirect_icon	= "images/icon_false.png";
		$redirect_url	= "mainpage.php?pl=spp_tk_edit";
		$redirect_text	= "Periode dan level tidak boleh kosong. silahkan lengkapi kembali";
		
		$need_redirect	= true;
		include_once ("include/redirect.php");
	}
}
?>