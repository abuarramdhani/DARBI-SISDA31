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
            <td id="text_title_page1" align="center"><h2 style="padding:0px;">--- SD ---</h2>Pengaturan Nominal SPP, ICT dan pembayaran lainnya per periode</td>
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
	$the_level		= "sd";
	
	$the_periode_enc	= mysql_real_escape_string($the_periode);
	$the_level_enc		= mysql_real_escape_string($the_level);
	
	$src_get_spp	= "select * from set_spp where periode = '$the_periode_enc' and level = '$the_level_enc'";
	$query_get_spp	= mysqli_query($mysql_connect, $src_get_spp) or die("There is an error with mysql: ".mysql_error());
	
	//let's check the discount period for every level
	// here we go
	
	//level 1
	$lev1_1_min_period	= 	substr($the_periode,-9,2);
	$lev1_1_max_period	=	substr($the_periode,-2,2);
	
	//level 2
	$lev2_1_min_period	= 	substr($the_periode,-9,2)-1;
	$lev2_1_max_period	=	substr($the_periode,-2,2)-1;
	
	$lev2_2_min_period	= 	substr($the_periode,-9,2);
	$lev2_2_max_period	=	substr($the_periode,-2,2);
	
	//level 3
	$lev3_1_min_period	= 	substr($the_periode,-9,2)-2;
	$lev3_1_max_period	=	substr($the_periode,-2,2)-2;
	
	$lev3_2_min_period	= 	substr($the_periode,-9,2)-1;
	$lev3_2_max_period	=	substr($the_periode,-2,2)-1;
	
	$lev3_3_min_period	= 	substr($the_periode,-9,2);
	$lev3_3_max_period	=	substr($the_periode,-2,2);
	
	//level 4
	$lev4_1_min_period	= 	substr($the_periode,-9,2)-3;
	$lev4_1_max_period	=	substr($the_periode,-2,2)-3;
	
	$lev4_2_min_period	= 	substr($the_periode,-9,2)-2;
	$lev4_2_max_period	=	substr($the_periode,-2,2)-2;
	
	$lev4_3_min_period	= 	substr($the_periode,-9,2)-1;
	$lev4_3_max_period	=	substr($the_periode,-2,2)-1;
	
	$lev4_4_min_period	= 	substr($the_periode,-9,2);
	$lev4_4_max_period	=	substr($the_periode,-2,2);
	
	//level 5
	$lev5_1_min_period	= 	substr($the_periode,-9,2)-4;
	$lev5_1_max_period	=	substr($the_periode,-2,2)-4;
	
	$lev5_2_min_period	= 	substr($the_periode,-9,2)-3;
	$lev5_2_max_period	=	substr($the_periode,-2,2)-3;
	
	$lev5_3_min_period	= 	substr($the_periode,-9,2)-2;
	$lev5_3_max_period	=	substr($the_periode,-2,2)-2;
	
	$lev5_4_min_period	= 	substr($the_periode,-9,2)-1;
	$lev5_4_max_period	=	substr($the_periode,-2,2)-1;
	
	$lev5_5_min_period	= 	substr($the_periode,-9,2);
	$lev5_5_max_period	=	substr($the_periode,-2,2);
	
	//level 6
	$lev6_1_min_period	= 	substr($the_periode,-9,2)-5;
	$lev6_1_max_period	=	substr($the_periode,-2,2)-5;
	
	$lev6_2_min_period	= 	substr($the_periode,-9,2)-4;
	$lev6_2_max_period	=	substr($the_periode,-2,2)-4;
	
	$lev6_3_min_period	= 	substr($the_periode,-9,2)-3;
	$lev6_3_max_period	=	substr($the_periode,-2,2)-3;
	
	$lev6_4_min_period	= 	substr($the_periode,-9,2)-2;
	$lev6_4_max_period	=	substr($the_periode,-2,2)-2;
	
	$lev6_5_min_period	= 	substr($the_periode,-9,2)-1;
	$lev6_5_max_period	=	substr($the_periode,-2,2)-1;
	
	$lev6_6_min_period	= 	substr($the_periode,-9,2);
	$lev6_6_max_period	=	substr($the_periode,-2,2);
					
	//here is the form fields going
	$i = 1;
	while($row_get_spp	= mysql_fetch_array($query_get_spp)) {
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 1
		if($row_get_spp["jenjang"] == 1) {						
			//Current year
			if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_1_per1_spp = $row_get_spp["nominal"]; } 								
			}
			if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_1_per1_ict = $row_get_spp["nominal"]; }                    
			}
			if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_1_per1_add = $row_get_spp["nominal"]; }
			}
			
			//Anak guru
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_1_angu_spp = $row_get_spp["nominal"]; }                     
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_1_angu_ict = $row_get_spp["nominal"]; }                    
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_1_angu_add = $row_get_spp["nominal"]; }                                 
			}
			
			//Discount khusus 1
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_1_dis1_spp = $row_get_spp["nominal"]; }                    
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_1_dis1_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_1_dis1_add = $row_get_spp["nominal"]; } 
			}
			
			//Discount khusus 2
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_1_dis2_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_1_dis2_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_1_dis2_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 3
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_1_dis3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_1_dis3_ict = $row_get_spp["nominal"]; } 	
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_1_dis3_add = $row_get_spp["nominal"]; }	
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas - 2
		if($row_get_spp["jenjang"] == 2) {
		
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev2_1_min_period.$lev2_1_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_2_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev2_1_min_period.$lev2_1_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_2_per1_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev2_1_min_period.$lev2_1_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_2_per1_add = $row_get_spp["nominal"]; }                                
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev2_2_min_period.$lev2_2_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_2_per2_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev2_2_min_period.$lev2_2_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_2_per2_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev2_2_min_period.$lev2_2_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_2_per2_add = $row_get_spp["nominal"]; } 
			}
			
			//Anak guru
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_2_angu_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_2_angu_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_2_angu_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 1
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_2_dis1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_2_dis1_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_2_dis1_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 2
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_2_dis2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_2_dis2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_2_dis2_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 3
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_2_dis3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_2_dis3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_2_dis3_add = $row_get_spp["nominal"]; } 
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 3
		if($row_get_spp["jenjang"] == 3) {
			
			//Current year - 2
			if($row_get_spp["ket_disc"] == ($lev3_1_min_period.$lev3_1_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_3_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev3_1_min_period.$lev3_1_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_3_per1_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev3_1_min_period.$lev3_1_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_3_per1_add = $row_get_spp["nominal"]; }
			}
			
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev3_2_min_period.$lev3_2_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_3_per2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev3_2_min_period.$lev3_2_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_3_per2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev3_2_min_period.$lev3_2_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_3_per2_add = $row_get_spp["nominal"]; } 
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev3_3_min_period.$lev3_3_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_3_per3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev3_3_min_period.$lev3_3_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_3_per3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev3_3_min_period.$lev3_3_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_3_per3_add = $row_get_spp["nominal"]; }                                
			}
			
			//Anak guru
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_3_angu_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_3_angu_ict = $row_get_spp["nominal"]; }	
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_3_angu_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 1
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_3_dis1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_3_dis1_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_3_dis1_add = $row_get_spp["nominal"]; }                                
			}
			
			//Discount khusus 2
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_3_dis2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_3_dis2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_3_dis2_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 3
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_3_dis3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_3_dis3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_3_dis3_add = $row_get_spp["nominal"]; }
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 4
		if($row_get_spp["jenjang"] == 4) {
		
			//Current year - 3
			if($row_get_spp["ket_disc"] == ($lev4_1_min_period.$lev4_1_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_1_min_period.$lev4_1_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per1_ict = $row_get_spp["nominal"]; }	
			}
			if($row_get_spp["ket_disc"] == ($lev4_1_min_period.$lev4_1_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_per1_add = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 2
			if($row_get_spp["ket_disc"] == ($lev4_2_min_period.$lev4_2_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per2_spp = $row_get_spp["nominal"]; } 	
			}
			if($row_get_spp["ket_disc"] == ($lev4_2_min_period.$lev4_2_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_2_min_period.$lev4_2_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_per2_add = $row_get_spp["nominal"]; }
			}
			
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev4_3_min_period.$lev4_3_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_3_min_period.$lev4_3_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_3_min_period.$lev4_3_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_per3_add = $row_get_spp["nominal"]; }
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev4_4_min_period.$lev4_4_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per4_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_4_min_period.$lev4_4_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per4_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_4_min_period.$lev4_4_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_per4_add = $row_get_spp["nominal"]; }
			}
			
			//Anak guru
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_angu_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_angu_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_angu_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 1
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_dis1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_dis1_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_dis1_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 2
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_dis2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_dis2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_dis2_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 3
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_dis3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_dis3_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_4_dis3_add = $row_get_spp["nominal"]; }
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 5
		if($row_get_spp["jenjang"] == 5) {
		
			//Current year - 4
			if($row_get_spp["ket_disc"] == ($lev5_1_min_period.$lev5_1_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_1_min_period.$lev5_1_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per1_ict = $row_get_spp["nominal"]; } 	
			}
			if($row_get_spp["ket_disc"] == ($lev5_1_min_period.$lev5_1_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_per1_add = $row_get_spp["nominal"]; }
			}
			
			//Current year - 3
			if($row_get_spp["ket_disc"] == ($lev5_2_min_period.$lev5_2_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_2_min_period.$lev5_2_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per2_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev5_2_min_period.$lev5_2_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_per2_add = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 2
			if($row_get_spp["ket_disc"] == ($lev5_3_min_period.$lev5_3_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_3_min_period.$lev5_3_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_3_min_period.$lev5_3_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_per3_add = $row_get_spp["nominal"]; }	
			}
			
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev5_4_min_period.$lev5_4_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per4_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev5_4_min_period.$lev5_4_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per4_ict = $row_get_spp["nominal"]; }	
			}
			if($row_get_spp["ket_disc"] == ($lev5_4_min_period.$lev5_4_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_per4_add = $row_get_spp["nominal"]; } 
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev5_5_min_period.$lev5_5_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per5_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_5_min_period.$lev5_5_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per5_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_5_min_period.$lev5_5_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_per5_add = $row_get_spp["nominal"]; }
			}
			
			//Anak guru
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_angu_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_angu_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_angu_add = $row_get_spp["nominal"]; } 
			}
			
			//Discount khusus 1
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_dis1_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_dis1_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_dis1_add = $row_get_spp["nominal"]; } 
			}
			
			//Discount khusus 2
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_dis2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_dis2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_dis2_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 3
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_dis3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_dis3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_5_dis3_add = $row_get_spp["nominal"]; }
			}	
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 6
		if($row_get_spp["jenjang"] == 6) {
			
			//Current year - 5
			if($row_get_spp["ket_disc"] == ($lev6_1_min_period.$lev6_1_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_1_min_period.$lev6_1_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per1_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_1_min_period.$lev6_1_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_per1_add = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 4
			if($row_get_spp["ket_disc"] == ($lev6_2_min_period.$lev6_2_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per2_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_2_min_period.$lev6_2_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_2_min_period.$lev6_2_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_per2_add = $row_get_spp["nominal"]; }
			}
			
			//Current year - 3
			if($row_get_spp["ket_disc"] == ($lev6_3_min_period.$lev6_3_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_3_min_period.$lev6_3_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_3_min_period.$lev6_3_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_per3_add = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 2
			if($row_get_spp["ket_disc"] == ($lev6_4_min_period.$lev6_4_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per4_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_4_min_period.$lev6_4_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per4_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_4_min_period.$lev6_4_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_per4_add = $row_get_spp["nominal"]; }
			}
			
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev6_5_min_period.$lev6_5_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per5_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_5_min_period.$lev6_5_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per5_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_5_min_period.$lev6_5_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_per5_add = $row_get_spp["nominal"]; }
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev6_6_min_period.$lev6_6_max_period) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per6_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_6_min_period.$lev6_6_max_period) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per6_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_6_min_period.$lev6_6_max_period) && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_per6_add = $row_get_spp["nominal"]; }
			}
			
			//Anak guru
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_angu_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_angu_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_angu_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 1
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_dis1_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_dis1_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_dis1_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 2
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_dis2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_dis2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_dis2_add = $row_get_spp["nominal"]; }
			}
			
			//Discount khusus 3
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_dis3_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_dis3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
				if($row_get_spp["item_byr"] == "add") { $var_6_dis3_add = $row_get_spp["nominal"]; }
			}
		}
	}
	/////////////////////////////////////////////////////////////////////////////////// 
	?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td>
                <form method="post" name="set_spp" action="engine.php?case=spp_sd_edit">
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="5">Tahun pelajaran: <input type="text" size="10" readonly="readonly" name="period" value="<?PHP echo $the_periode; ?>" /><input type="hidden" name="level" value="sd" /></td>
                    </tr>
                    <?PHP
					//what is the idea with this "period case"..?
					//Here it is... 
					//Mrs Fitri wanna separate the discount for every class depand on when the student joint/register to a class (we are talking about new student that not joint from the beginning of a class: maksute siswa pindahan hehehe)
					//You'll find that every level has different type of discount. and the discount type will be named with the selected period.
					
					//OK i wanna sing a song for cha....
					//dududududuuuuuuuu...
					//Kita mesti telanjang dan benar-benar bersih
					//Suci dan di dalam bathinnnnnnnnnnnnn....dudududududuuu.....
					if(empty($_GET["per"])) {
					?>
                    <tr height="150">
                    	<td colspan="5" align="center" id="text_normal_black"><b>Untuk menentukan nilai nominal SPP yang baru, silahkan pilih tahun pelajaran di atas.</b></td>
                    </tr>
                    <?PHP
					} else {
					?>
                    <tr height="25" bgcolor="#333333" id="text_normal_white">
                        <td>Jenjang</td>
                        <td>Keterangan</td>
                        <td>SPP</td>
                        <td>ICT</td>
                        <td>Komite sekolah</td>
                    </tr>
                    <?PHP
					/////////////////////////////////////////
					///////////////kelas 1///////////////////
					/////////////////////////////////////////
					
					
					//wiphiiiiiiiiiiiiiii.....
					//we need the last 2 digits from every year in period only.
					//so you gonna get the last 2 digits... :)
					$lev1_1_min_period	= 	substr($_GET["per"],-9,2);
					$lev1_1_max_period	=	substr($_GET["per"],-2,2);				
					?>                    
                    <tr height="25" bgcolor="#83736c">
                        <td rowspan="5">Kelas 1</td>
                        <td><?PHP echo $lev1_1_min_period." - ".$lev1_1_max_period; ?></td>
                        <td><input type="text" size="10" name="1-per1-spp" value="<?PHP echo $var_1_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-per1-ict" value="<?PHP echo $var_1_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-per1-add" value="<?PHP echo $var_1_per1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>kategori 1</td>
                        <td><input type="text" size="10" name="1-angu-spp" value="<?PHP echo $var_1_angu_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-angu-ict" value="<?PHP echo $var_1_angu_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-angu-add" value="<?PHP echo $var_1_angu_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>kategori 2</td>
                        <td><input type="text" size="10" name="1-dis1-spp" value="<?PHP echo $var_1_dis1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis1-ict" value="<?PHP echo $var_1_dis1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis1-add" value="<?PHP echo $var_1_dis1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>kategori 3</td>
                        <td><input type="text" size="10" name="1-dis2-spp" value="<?PHP echo $var_1_dis2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis2-ict" value="<?PHP echo $var_1_dis2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis2-add" value="<?PHP echo $var_1_dis2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>kategori 4</td>
                        <td><input type="text" size="10" name="1-dis3-spp" value="<?PHP echo $var_1_dis3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis3-ict" value="<?PHP echo $var_1_dis3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis3-add" value="<?PHP echo $var_1_dis3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>                    
                    <?PHP
					/////////////////////////////////////////
					///////////////kelas 2///////////////////
					/////////////////////////////////////////
					
					
					//why plus 1,2,3,4 and 5??????
					//because for every level/class, the chance for a student to joint a class separated into:
					//1. level 1 -> 1 chance of period
					//2. level 2 -> 2 chances of period
					//3. level 3 -> 3 chances of period
					//4. level 4 -> 4 chances of period
					//5. level 5 -> 5 chances of period
					//6. level 6 -> 6 chances of period
					
					// and you know that we are not talking about discount for teacher's children and special discount.
					// this the period based discount only.... okehhhhhhhhhhhh
					if((substr($_GET["per"],-9,2)+1) < 10) {
						$lev2_1_min_period	= 	"0".(substr($_GET["per"],-9,2)-1);
					} else {
						$lev2_1_min_period	= 	substr($_GET["per"],-9,2)-1;
					}
					
					if((substr($_GET["per"],-2,2)+1) < 10) {
						$lev2_1_max_period	=	"0".(substr($_GET["per"],-2,2)-1);
					} else {
						$lev2_1_max_period	=	substr($_GET["per"],-2,2)-1;
					}
					?>
                    <tr height="25" bgcolor="#8a6c66">
                        <td rowspan="6">Kelas 2</td>
                        <td><?PHP echo $lev2_1_min_period." - ".$lev2_1_max_period; ?></td>
                        <td><input type="text" size="10" name="2-per1-spp" value="<?PHP echo $var_2_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-per1-ict" value="<?PHP echo $var_2_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-per1-add" value="<?PHP echo $var_2_per1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					$lev2_2_min_period	= 	substr($_GET["per"],-9,2);
					$lev2_2_max_period	=	substr($_GET["per"],-2,2);
					?>
                    <tr height="25" bgcolor="#8a6c66">
                        <td><?PHP echo $lev2_2_min_period." - ".$lev2_2_max_period; ?></td>
                        <td><input type="text" size="10" name="2-per2-spp" value="<?PHP echo $var_2_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-per2-ict" value="<?PHP echo $var_2_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-per2-add" value="<?PHP echo $var_2_per2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					//Because one or many things, we have change:
					//Anak guru         -> kategori 1
					//Discount khusus 1 -> kategori 2
					//Discount khusus 2 -> kategori 3
					//Discount khusus 3 -> kategory 4 
					
					//But we have to keep the variable just like before
					//kategori 1 -> angu
					//kategori 2 -> dis1
					//kategori 3 -> dis2
					//kategory 4 -> dis3
					?>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>kategori 1</td>
                        <td><input type="text" size="10" name="2-angu-spp" value="<?PHP echo $var_2_angu_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-angu-ict" value="<?PHP echo $var_2_angu_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-angu-add" value="<?PHP echo $var_2_angu_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>kategori 2</td>
                        <td><input type="text" size="10" name="2-dis1-spp" value="<?PHP echo $var_2_dis1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis1-ict" value="<?PHP echo $var_2_dis1_ict; ?>"onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis1-add" value="<?PHP echo $var_2_dis1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>kategori 3</td>
                        <td><input type="text" size="10" name="2-dis2-spp" value="<?PHP echo $var_2_dis2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis2-ict" value="<?PHP echo $var_2_dis2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis2-add" value="<?PHP echo $var_2_dis2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>kategori 4</td>
                        <td><input type="text" size="10" name="2-dis3-spp" value="<?PHP echo $var_2_dis3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis3-ict" value="<?PHP echo $var_2_dis3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis3-add" value="<?PHP echo $var_2_dis3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					/////////////////////////////////////////
					///////////////kelas 3///////////////////
					/////////////////////////////////////////
					
					
					if((substr($_GET["per"],-9,2)+2) < 10) {
						$lev3_1_min_period	= 	"0".(substr($_GET["per"],-9,2)-2);
					} else {
						$lev3_1_min_period	= 	substr($_GET["per"],-9,2)-2;
					}
					
					if((substr($_GET["per"],-2,2)+2) < 10) {
						$lev3_1_max_period	=	"0".(substr($_GET["per"],-2,2)-2);
					} else {
						$lev3_1_max_period	=	substr($_GET["per"],-2,2)-2;
					}
					?>
                    <tr height="25" bgcolor="#8d6774">
                        <td rowspan="7">Kelas 3</td>
                        <td><?PHP echo $lev3_1_min_period." - ".$lev3_1_max_period; ?></td>
                        <td><input type="text" size="10" name="3-per1-spp" value="<?PHP echo $var_3_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-per1-ict" value="<?PHP echo $var_3_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-per1-add" value="<?PHP echo $var_3_per1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+1) < 10) {
						$lev3_2_min_period	= 	"0".(substr($_GET["per"],-9,2)-1);
					} else {
						$lev3_2_min_period	= 	substr($_GET["per"],-9,2)-1;
					}
					
					if((substr($_GET["per"],-2,2)+1) < 10) {
						$lev3_2_max_period	=	"0".(substr($_GET["per"],-2,2)-1);
					} else {
						$lev3_2_max_period	=	substr($_GET["per"],-2,2)-1;
					}
					?>
                    <tr height="25" bgcolor="#8d6774">
                        <td><?PHP echo $lev3_2_min_period." - ".$lev3_2_max_period; ?></td>
                        <td><input type="text" size="10" name="3-per2-spp" value="<?PHP echo $var_3_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-per2-ict" value="<?PHP echo $var_3_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-per2-add" value="<?PHP echo $var_3_per2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					$lev3_3_min_period	= 	substr($_GET["per"],-9,2);
					$lev3_3_max_period	=	substr($_GET["per"],-2,2);
					?>
                    <tr height="25" bgcolor="#8d6774">
                        <td><?PHP echo $lev3_3_min_period." - ".$lev3_3_max_period; ?></td>
                        <td><input type="text" size="10" name="3-per3-spp" value="<?PHP echo $var_3_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-per3-ict" value="<?PHP echo $var_3_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-per3-add" value="<?PHP echo $var_3_per3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>kategori 1</td>
                        <td><input type="text" size="10" name="3-angu-spp" value="<?PHP echo $var_3_angu_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-angu-ict" value="<?PHP echo $var_3_angu_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-angu-add" value="<?PHP echo $var_3_angu_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>kategori 2</td>
                        <td><input type="text" size="10" name="3-dis1-spp" value="<?PHP echo $var_3_dis1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis1-ict" value="<?PHP echo $var_3_dis1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis1-add" value="<?PHP echo $var_3_dis1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>kategori 3</td>
                        <td><input type="text" size="10" name="3-dis2-spp" value="<?PHP echo $var_3_dis2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis2-ict" value="<?PHP echo $var_3_dis2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis2-add" value="<?PHP echo $var_3_dis2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>kategori 4</td>
                        <td><input type="text" size="10" name="3-dis3-spp" value="<?PHP echo $var_3_dis3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis3-ict" value="<?PHP echo $var_3_dis3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis3-add" value="<?PHP echo $var_3_dis3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					/////////////////////////////////////////
					///////////////kelas 4///////////////////
					/////////////////////////////////////////
					
					
					if((substr($_GET["per"],-9,2)+3) < 10) {
						$lev4_1_min_period	= 	"0".(substr($_GET["per"],-9,2)-3);
					} else {
						$lev4_1_min_period	= 	substr($_GET["per"],-9,2)-3;
					}
					
					if((substr($_GET["per"],-2,2)+3) < 10) {
						$lev4_1_max_period	=	"0".(substr($_GET["per"],-2,2)-3);
					} else {
						$lev4_1_max_period	=	substr($_GET["per"],-2,2)-3;
					}
					?>
                    <tr height="25" bgcolor="#7f7085">
                        <td rowspan="8">Kelas 4</td>
                        <td><?PHP echo $lev4_1_min_period." - ".$lev4_1_max_period; ?></td>
                        <td><input type="text" size="10" name="4-per1-spp" value="<?PHP echo $var_4_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per1-ict" value="<?PHP echo $var_4_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per1-add" value="<?PHP echo $var_4_per1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+2) < 10) {
						$lev4_2_min_period	= 	"0".(substr($_GET["per"],-9,2)-2);
					} else {
						$lev4_2_min_period	= 	substr($_GET["per"],-9,2)-2;
					}
					
					if((substr($_GET["per"],-2,2)+2) < 10) {
						$lev4_2_max_period	=	"0".(substr($_GET["per"],-2,2)-2);
					} else {
						$lev4_2_max_period	=	substr($_GET["per"],-2,2)-2;
					}
					?>
                    <tr height="25" bgcolor="#7f7085">
                        <td><?PHP echo $lev4_2_min_period." - ".$lev4_2_max_period; ?></td>
                        <td><input type="text" size="10" name="4-per2-spp" value="<?PHP echo $var_4_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per2-ict" value="<?PHP echo $var_4_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per2-add" value="<?PHP echo $var_4_per2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+1) < 10) {
						$lev4_3_min_period	= 	"0".(substr($_GET["per"],-9,2)-1);
					} else {
						$lev4_3_min_period	= 	substr($_GET["per"],-9,2)-1;
					}
					
					if((substr($_GET["per"],-2,2)+1) < 10) {
						$lev4_3_max_period	=	"0".(substr($_GET["per"],-2,2)-1);
					} else {
						$lev4_3_max_period	=	substr($_GET["per"],-2,2)-1;
					}
					?>
                    <tr height="25" bgcolor="#7f7085">
                        <td><?PHP echo $lev4_3_min_period." - ".$lev4_3_max_period; ?></td>
                        <td><input type="text" size="10" name="4-per3-spp" value="<?PHP echo $var_4_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per3-ict" value="<?PHP echo $var_4_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per3-add" value="<?PHP echo $var_4_per3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					$lev4_4_min_period	= 	substr($_GET["per"],-9,2);
					$lev4_4_max_period	=	substr($_GET["per"],-2,2);
					?>
                    <tr height="25" bgcolor="#7f7085">
                        <td><?PHP echo $lev4_4_min_period." - ".$lev4_4_max_period; ?></td>
                        <td><input type="text" size="10" name="4-per4-spp" value="<?PHP echo $var_4_per4_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per4-ict" value="<?PHP echo $var_4_per4_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-per4-add" value="<?PHP echo $var_4_per4_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>kategori 1</td>
                        <td><input type="text" size="10" name="4-angu-spp" value="<?PHP echo $var_4_angu_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-angu-ict" value="<?PHP echo $var_4_angu_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-angu-add" value="<?PHP echo $var_4_angu_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>kategori 2</td>
                        <td><input type="text" size="10" name="4-dis1-spp" value="<?PHP echo $var_4_dis1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis1-ict" value="<?PHP echo $var_4_dis1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis1-add" value="<?PHP echo $var_4_dis1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>kategori 3</td>
                        <td><input type="text" size="10" name="4-dis2-spp" value="<?PHP echo $var_4_dis2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis2-ict" value="<?PHP echo $var_4_dis2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis2-add" value="<?PHP echo $var_4_dis2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>kategori 4</td>
                        <td><input type="text" size="10" name="4-dis3-spp" value="<?PHP echo $var_4_dis3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis3-ict" value="<?PHP echo $var_4_dis3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis3-add" value="<?PHP echo $var_4_dis3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					/////////////////////////////////////////
					///////////////kelas 5///////////////////
					/////////////////////////////////////////
					
					
					if((substr($_GET["per"],-9,2)+4) < 10) {
						$lev5_1_min_period	= 	"0".(substr($_GET["per"],-9,2)-4);
					} else {
						$lev5_1_min_period	= 	substr($_GET["per"],-9,2)-4;
					}
					
					if((substr($_GET["per"],-2,2)+4) < 10) {
						$lev5_1_max_period	=	"0".(substr($_GET["per"],-2,2)-4);
					} else {
						$lev5_1_max_period	=	substr($_GET["per"],-2,2)-4;
					}
					?>
                    <tr height="25" bgcolor="#58778a">
                        <td rowspan="9">Kelas 5</td>
                        <td><?PHP echo $lev5_1_min_period." - ".$lev5_1_max_period; ?></td>
                        <td><input type="text" size="10" name="5-per1-spp" value="<?PHP echo $var_5_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per1-ict" value="<?PHP echo $var_5_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per1-add" value="<?PHP echo $var_5_per1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+3) < 10) {
						$lev5_2_min_period	= 	"0".(substr($_GET["per"],-9,2)-3);
					} else {
						$lev5_2_min_period	= 	substr($_GET["per"],-9,2)-3;
					}
					
					if((substr($_GET["per"],-2,2)+3) < 10) {
						$lev5_2_max_period	=	"0".(substr($_GET["per"],-2,2)-3);
					} else {
						$lev5_2_max_period	=	substr($_GET["per"],-2,2)-3;
					}
					?>
                    <tr height="25" bgcolor="#58778a">
                        <td><?PHP echo $lev5_2_min_period." - ".$lev5_2_max_period; ?></td>
                        <td><input type="text" size="10" name="5-per2-spp" value="<?PHP echo $var_5_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per2-ict" value="<?PHP echo $var_5_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per2-add" value="<?PHP echo $var_5_per2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+2) < 10) {
						$lev5_3_min_period	= 	"0".(substr($_GET["per"],-9,2)-2);
					} else {
						$lev5_3_min_period	= 	substr($_GET["per"],-9,2)-2;
					}
					
					if((substr($_GET["per"],-2,2)+2) < 10) {
						$lev5_3_max_period	=	"0".(substr($_GET["per"],-2,2)-2);
					} else {
						$lev5_3_max_period	=	substr($_GET["per"],-2,2)-2;
					}
					?>
                    <tr height="25" bgcolor="#58778a">
                        <td><?PHP echo $lev5_3_min_period." - ".$lev5_3_max_period; ?></td>
                        <td><input type="text" size="10" name="5-per3-spp" value="<?PHP echo $var_5_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per3-ict" value="<?PHP echo $var_5_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per3-add" value="<?PHP echo $var_5_per3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+1) < 10) {
						$lev5_2_min_period	= 	"0".(substr($_GET["per"],-9,2)-1);
					} else {
						$lev5_2_min_period	= 	substr($_GET["per"],-9,2)-1;
					}
					
					if((substr($_GET["per"],-2,2)+1) < 10) {
						$lev5_2_max_period	=	"0".(substr($_GET["per"],-2,2)-1);
					} else {
						$lev5_2_max_period	=	substr($_GET["per"],-2,2)-1;
					}
					?>
                    <tr height="25" bgcolor="#58778a">
                        <td><?PHP echo $lev5_2_min_period." - ".$lev5_2_max_period; ?></td>
                        <td><input type="text" size="10" name="5-per4-spp" value="<?PHP echo $var_5_per4_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per4-ict" value="<?PHP echo $var_5_per4_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per4-add" value="<?PHP echo $var_5_per4_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					$lev5_5_min_period	= 	substr($_GET["per"],-9,2);
					$lev5_5_max_period	=	substr($_GET["per"],-2,2);
					?>
                    <tr height="25" bgcolor="#58778a">
                        <td><?PHP echo $lev5_5_min_period." - ".$lev5_5_max_period; ?></td>
                        <td><input type="text" size="10" name="5-per5-spp" value="<?PHP echo $var_5_per5_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per5-ict" value="<?PHP echo $var_5_per5_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-per5-add" value="<?PHP echo $var_5_per5_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>kategori 1</td>
                        <td><input type="text" size="10" name="5-angu-spp" value="<?PHP echo $var_5_angu_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-angu-ict" value="<?PHP echo $var_5_angu_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-angu-add" value="<?PHP echo $var_5_angu_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>kategori 2</td>
                        <td><input type="text" size="10" name="5-dis1-spp" value="<?PHP echo $var_5_dis1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis1-ict" value="<?PHP echo $var_5_dis1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis1-add" value="<?PHP echo $var_5_dis1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>kategori 3</td>
                        <td><input type="text" size="10" name="5-dis2-spp" value="<?PHP echo $var_5_dis2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis2-ict" value="<?PHP echo $var_5_dis2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis2-add" value="<?PHP echo $var_5_dis2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>kategori 4</td>
                        <td><input type="text" size="10" name="5-dis3-spp" value="<?PHP echo $var_5_dis3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis3-ict" value="<?PHP echo $var_5_dis3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis3-add" value="<?PHP echo $var_5_dis3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					/////////////////////////////////////////
					///////////////kelas 6///////////////////
					/////////////////////////////////////////
					
					
					if((substr($_GET["per"],-9,2)+5) < 10) {
						$lev6_1_min_period	= 	"0".(substr($_GET["per"],-9,2)-5);
					} else {
						$lev6_1_min_period	= 	substr($_GET["per"],-9,2)-5;
					}
					
					if((substr($_GET["per"],-2,2)+5) < 10) {
						$lev6_1_max_period	=	"0".(substr($_GET["per"],-2,2)-5);
					} else {
						$lev6_1_max_period	=	substr($_GET["per"],-2,2)-5;
					}
					?>
                    <tr height="25" bgcolor="#668285">
                        <td rowspan="10">Kelas 6</td>
                        <td><?PHP echo $lev6_1_min_period." - ".$lev6_1_max_period; ?></td>
                        <td><input type="text" size="10" name="6-per1-spp" value="<?PHP echo $var_6_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per1-ict" value="<?PHP echo $var_6_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per1-add" value="<?PHP echo $var_6_per1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+4) < 10) {
						$lev6_2_min_period	= 	"0".(substr($_GET["per"],-9,2)-4);
					} else {
						$lev6_2_min_period	= 	substr($_GET["per"],-9,2)-4;
					}
					
					if((substr($_GET["per"],-2,2)+4) < 10) {
						$lev6_2_max_period	=	"0".(substr($_GET["per"],-2,2)-4);
					} else {
						$lev6_2_max_period	=	substr($_GET["per"],-2,2)-4;
					}
					?>
                    <tr height="25" bgcolor="#668285">
                        <td><?PHP echo $lev6_2_min_period." - ".$lev6_2_max_period; ?></td>
                        <td><input type="text" size="10" name="6-per2-spp" value="<?PHP echo $var_6_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per2-ict" value="<?PHP echo $var_6_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per2-add" value="<?PHP echo $var_6_per2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+3) < 10) {
						$lev6_3_min_period	= 	"0".(substr($_GET["per"],-9,2)-3);
					} else {
						$lev6_3_min_period	= 	substr($_GET["per"],-9,2)-3;
					}
					
					if((substr($_GET["per"],-2,2)+3) < 10) {
						$lev6_3_max_period	=	"0".(substr($_GET["per"],-2,2)-3);
					} else {
						$lev6_3_max_period	=	substr($_GET["per"],-2,2)-3;
					}
					?>
                    <tr height="25" bgcolor="#668285">
                        <td><?PHP echo $lev6_3_min_period." - ".$lev6_3_max_period; ?></td>
                        <td><input type="text" size="10" name="6-per3-spp" value="<?PHP echo $var_6_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per3-ict" value="<?PHP echo $var_6_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per3-add" value="<?PHP echo $var_6_per3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+2) < 10) {
						$lev6_4_min_period	= 	"0".(substr($_GET["per"],-9,2)-2);
					} else {
						$lev6_4_min_period	= 	substr($_GET["per"],-9,2)-2;
					}
					
					if((substr($_GET["per"],-2,2)+2) < 10) {
						$lev6_4_max_period	=	"0".(substr($_GET["per"],-2,2)-2);
					} else {
						$lev6_4_max_period	=	substr($_GET["per"],-2,2)-2;
					}
					?>
                    <tr height="25" bgcolor="#668285">
                        <td><?PHP echo $lev6_4_min_period." - ".$lev6_4_max_period; ?></td>
                        <td><input type="text" size="10" name="6-per4-spp" value="<?PHP echo $var_6_per4_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per4-ict" value="<?PHP echo $var_6_per4_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per4-add" value="<?PHP echo $var_6_per4_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					if((substr($_GET["per"],-9,2)+1) < 10) {
						$lev6_5_min_period	= 	"0".(substr($_GET["per"],-9,2)-1);
					} else {
						$lev6_5_min_period	= 	substr($_GET["per"],-9,2)-1;
					}
					
					if((substr($_GET["per"],-2,2)+1) < 10) {
						$lev6_5_max_period	=	"0".(substr($_GET["per"],-2,2)-1);
					} else {
						$lev6_5_max_period	=	substr($_GET["per"],-2,2)-1;
					}
					?>
                    <tr height="25" bgcolor="#668285">
                        <td><?PHP echo $lev6_5_min_period." - ".$lev6_5_max_period; ?></td>
                        <td><input type="text" size="10" name="6-per5-spp" value="<?PHP echo $var_6_per5_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per5-ict" value="<?PHP echo $var_6_per5_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per5-add" value="<?PHP echo $var_6_per5_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <?PHP
					$lev6_6_min_period	= 	substr($_GET["per"],-9,2);
					$lev6_6_max_period	=	substr($_GET["per"],-2,2);
					?>
                    <tr height="25" bgcolor="#668285">
                        <td><?PHP echo $lev6_6_min_period." - ".$lev6_6_max_period; ?></td>
                        <td><input type="text" size="10" name="6-per6-spp" value="<?PHP echo $var_6_per6_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per6-ict" value="<?PHP echo $var_6_per6_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-per6-add" value="<?PHP echo $var_6_per6_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>kategori 1</td>
                        <td><input type="text" size="10" name="6-angu-spp" value="<?PHP echo $var_6_angu_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-angu-ict" value="<?PHP echo $var_6_angu_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-angu-add" value="<?PHP echo $var_6_angu_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>kategori 2</td>
                        <td><input type="text" size="10" name="6-dis1-spp" value="<?PHP echo $var_6_dis1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis1-ict" value="<?PHP echo $var_6_dis1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis1-add" value="<?PHP echo $var_6_dis1_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>kategori 3</td>
                        <td><input type="text" size="10" name="6-dis2-spp" value="<?PHP echo $var_6_dis2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis2-ict" value="<?PHP echo $var_6_dis2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis2-add" value="<?PHP echo $var_6_dis2_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>kategori 4</td>
                        <td><input type="text" size="10" name="6-dis3-spp" value="<?PHP echo $var_6_dis3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis3-ict" value="<?PHP echo $var_6_dis3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis3-add" value="<?PHP echo $var_6_dis3_add; ?>" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="60" bgcolor="#333333">
                        <td colspan="5" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpan nilai SPP" onClick="return verification()"/></td>
                    </tr>
                    <?PHP
					}
					?>
                </table>
                </form>
            </td>
            <td width="30"></td>
        </tr>
        <tr>
        	<td colspan="3" height="20"></td>
        </tr>
    </table>
<?PHP
}
?>
<!-- sandy said: form verifiation start form here buddy...:)-->
<SCRIPT type="text/javascript" >
function verification() 
{ 
	if(document.set_spp.period.value == "")
	{
		alert('Anda harus memilih Tahun Pelajaran untuk melengkapi form isian SPP');
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