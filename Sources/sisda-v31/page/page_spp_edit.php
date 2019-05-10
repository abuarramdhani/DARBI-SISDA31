<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	$the_periode	= htmlspecialchars($_GET["per"]);
	$src_j			= htmlspecialchars($_GET["j"]);
	
	if($src_j == "toddler") 	{ $title_page	= "Toddler"; }
	else if($src_j == "pg") 	{ $title_page	= "Play Group"; }
	else if($src_j == "tka") 	{ $title_page	= "TK A"; }
	else if($src_j == "tkb") 	{ $title_page	= "TK B"; }
	else if($src_j == "sd") 	{ $title_page	= "SD"; }
	else if($src_j == "smp") 	{ $title_page	= "SMP"; }
	
?>
    <!-- i dont think that i should give many comments here, hope you understand the script step by step -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="3" height="10"></td>
        </tr>
        <tr height="25">
            <td width="30"></td>
            <td id="text_title_page1" align="center"><h2 style="padding:0px;">--- <?PHP echo $title_page; ?> ---</h2>Pengaturan Nominal SPP, ICT dan pembayaran lainnya per periode</td>
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
	$the_periode_enc	= mysqli_real_escape_string($mysql_connect, $the_periode);
	$the_j_enc			= mysqli_real_escape_string($mysql_connect, $src_j);
	
	$src_get_spp	= "select * from set_spp where periode = '$the_periode_enc' and jenjang = '$the_j_enc'";
	$query_get_spp	= mysqli_query($mysql_connect, $src_get_spp) or die("There is an error with mysql: ".mysql_error());
	$num_get_spp	= mysqli_num_rows($query_get_spp);
	
	
	//let's check the discount period for every level
	// here we go
	
	//level 1
	$lev1_1_min_periode	= 	substr($the_periode,-9,2);
	$lev1_1_max_periode	=	substr($the_periode,-2,2);
	
	//level 2
	$lev2_1_min_periode	= 	substr($the_periode,-9,2)-1;
	$lev2_1_max_periode	=	substr($the_periode,-2,2)-1;
	
	$lev2_2_min_periode	= 	substr($the_periode,-9,2);
	$lev2_2_max_periode	=	substr($the_periode,-2,2);
	
	//level 3
	$lev3_1_min_periode	= 	substr($the_periode,-9,2)-2;
	$lev3_1_max_periode	=	substr($the_periode,-2,2)-2;
	
	$lev3_2_min_periode	= 	substr($the_periode,-9,2)-1;
	$lev3_2_max_periode	=	substr($the_periode,-2,2)-1;
	
	$lev3_3_min_periode	= 	substr($the_periode,-9,2);
	$lev3_3_max_periode	=	substr($the_periode,-2,2);
	
	//level 4
	$lev4_1_min_periode	= 	substr($the_periode,-9,2)-3;
	$lev4_1_max_periode	=	substr($the_periode,-2,2)-3;
	
	$lev4_2_min_periode	= 	substr($the_periode,-9,2)-2;
	$lev4_2_max_periode	=	substr($the_periode,-2,2)-2;
	
	$lev4_3_min_periode	= 	substr($the_periode,-9,2)-1;
	$lev4_3_max_periode	=	substr($the_periode,-2,2)-1;
	
	$lev4_4_min_periode	= 	substr($the_periode,-9,2);
	$lev4_4_max_periode	=	substr($the_periode,-2,2);
	
	//level 5
	$lev5_1_min_periode	= 	substr($the_periode,-9,2)-4;
	$lev5_1_max_periode	=	substr($the_periode,-2,2)-4;
	
	$lev5_2_min_periode	= 	substr($the_periode,-9,2)-3;
	$lev5_2_max_periode	=	substr($the_periode,-2,2)-3;
	
	$lev5_3_min_periode	= 	substr($the_periode,-9,2)-2;
	$lev5_3_max_periode	=	substr($the_periode,-2,2)-2;
	
	$lev5_4_min_periode	= 	substr($the_periode,-9,2)-1;
	$lev5_4_max_periode	=	substr($the_periode,-2,2)-1;
	
	$lev5_5_min_periode	= 	substr($the_periode,-9,2);
	$lev5_5_max_periode	=	substr($the_periode,-2,2);
	
	//level 6
	$lev6_1_min_periode	= 	substr($the_periode,-9,2)-5;
	$lev6_1_max_periode	=	substr($the_periode,-2,2)-5;
	
	$lev6_2_min_periode	= 	substr($the_periode,-9,2)-4;
	$lev6_2_max_periode	=	substr($the_periode,-2,2)-4;
	
	$lev6_3_min_periode	= 	substr($the_periode,-9,2)-3;
	$lev6_3_max_periode	=	substr($the_periode,-2,2)-3;
	
	$lev6_4_min_periode	= 	substr($the_periode,-9,2)-2;
	$lev6_4_max_periode	=	substr($the_periode,-2,2)-2;
	
	$lev6_5_min_periode	= 	substr($the_periode,-9,2)-1;
	$lev6_5_max_periode	=	substr($the_periode,-2,2)-1;
	
	$lev6_6_min_periode	= 	substr($the_periode,-9,2);
	$lev6_6_max_periode	=	substr($the_periode,-2,2);
					
	//here is the form fields going
	while($row_get_spp	= mysqli_fetch_array($query_get_spp, MYSQLI_ASSOC)) {
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 1		
		
		if($row_get_spp["tingkat"] == "toddler" || $row_get_spp["tingkat"] == "pg" || $row_get_spp["tingkat"] == "tka" || $row_get_spp["tingkat"] == "tkb" || $row_get_spp["tingkat"] == "1" || $row_get_spp["tingkat"] == "7") {						
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev1_1_min_periode.$lev1_1_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_1_per1_spp = $row_get_spp["nominal"]; } 								
			}
			if($row_get_spp["ket_disc"] == ($lev1_1_min_periode.$lev1_1_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_1_per1_ict = $row_get_spp["nominal"]; }                    
			}
			if($row_get_spp["ket_disc"] == ($lev1_1_min_periode.$lev1_1_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_1_per1_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev1_1_min_periode.$lev1_1_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_1_per1_ler = $row_get_spp["nominal"]; }
			}			
			
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas - 2
		if($src_j == "smp" || $src_j == "sd") {
		
			if($row_get_spp["tingkat"] == "2" || $row_get_spp["tingkat"] == "8") {
			
				//Current year - 1
				if($row_get_spp["ket_disc"] == ($lev2_1_min_periode.$lev2_1_max_periode) && $row_get_spp["item_byr"] == "spp") {
					if($row_get_spp["item_byr"] == "spp") { $var_2_per1_spp = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev2_1_min_periode.$lev2_1_max_periode) && $row_get_spp["item_byr"] == "ict") {
					if($row_get_spp["item_byr"] == "ict") { $var_2_per1_ict = $row_get_spp["nominal"]; } 
				}
				if($row_get_spp["ket_disc"] == ($lev2_1_min_periode.$lev2_1_max_periode) && $row_get_spp["item_byr"] == "kts") {
					if($row_get_spp["item_byr"] == "kts") { $var_2_per1_kts = $row_get_spp["nominal"]; }                                
				}
				if($row_get_spp["ket_disc"] == ($lev2_1_min_periode.$lev2_1_max_periode) && $row_get_spp["item_byr"] == "ler") {
					if($row_get_spp["item_byr"] == "ler") { $var_2_per1_ler = $row_get_spp["nominal"]; }                                
				}
				
				//Current year
				if($row_get_spp["ket_disc"] == ($lev2_2_min_periode.$lev2_2_max_periode) && $row_get_spp["item_byr"] == "spp") {
					if($row_get_spp["item_byr"] == "spp") { $var_2_per2_spp = $row_get_spp["nominal"]; } 
				}
				if($row_get_spp["ket_disc"] == ($lev2_2_min_periode.$lev2_2_max_periode) && $row_get_spp["item_byr"] == "ict") {
					if($row_get_spp["item_byr"] == "ict") { $var_2_per2_ict = $row_get_spp["nominal"]; } 
				}
				if($row_get_spp["ket_disc"] == ($lev2_2_min_periode.$lev2_2_max_periode) && $row_get_spp["item_byr"] == "kts") {
					if($row_get_spp["item_byr"] == "kts") { $var_2_per2_kts = $row_get_spp["nominal"]; } 
				}
				if($row_get_spp["ket_disc"] == ($lev2_2_min_periode.$lev2_2_max_periode) && $row_get_spp["item_byr"] == "ler") {
					if($row_get_spp["item_byr"] == "ler") { $var_2_per2_ler = $row_get_spp["nominal"]; } 
				}
			}
		
			////////////////////////////////////////////////////////////////////////////////////////////////////////
			//Kelas 3
			if($row_get_spp["tingkat"] == "3" || $row_get_spp["tingkat"] == "9") {
				
				//Current year - 2
				if($row_get_spp["ket_disc"] == ($lev3_1_min_periode.$lev3_1_max_periode) && $row_get_spp["item_byr"] == "spp") {
					if($row_get_spp["item_byr"] == "spp") { $var_3_per1_spp = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev3_1_min_periode.$lev3_1_max_periode) && $row_get_spp["item_byr"] == "ict") {
					if($row_get_spp["item_byr"] == "ict") { $var_3_per1_ict = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev3_1_min_periode.$lev3_1_max_periode) && $row_get_spp["item_byr"] == "kts") {
					if($row_get_spp["item_byr"] == "kts") { $var_3_per1_kts = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev3_1_min_periode.$lev3_1_max_periode) && $row_get_spp["item_byr"] == "ler") {
					if($row_get_spp["item_byr"] == "ler") { $var_3_per1_ler = $row_get_spp["nominal"]; }
				}
				
				//Current year - 1
				if($row_get_spp["ket_disc"] == ($lev3_2_min_periode.$lev3_2_max_periode) && $row_get_spp["item_byr"] == "spp") {
					if($row_get_spp["item_byr"] == "spp") { $var_3_per2_spp = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev3_2_min_periode.$lev3_2_max_periode) && $row_get_spp["item_byr"] == "ict") {
					if($row_get_spp["item_byr"] == "ict") { $var_3_per2_ict = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev3_2_min_periode.$lev3_2_max_periode) && $row_get_spp["item_byr"] == "kts") {
					if($row_get_spp["item_byr"] == "kts") { $var_3_per2_kts = $row_get_spp["nominal"]; } 
				}
				if($row_get_spp["ket_disc"] == ($lev3_2_min_periode.$lev3_2_max_periode) && $row_get_spp["item_byr"] == "ler") {
					if($row_get_spp["item_byr"] == "ler") { $var_3_per2_ler = $row_get_spp["nominal"]; } 
				}
				
				//Current year
				if($row_get_spp["ket_disc"] == ($lev3_3_min_periode.$lev3_3_max_periode) && $row_get_spp["item_byr"] == "spp") {
					if($row_get_spp["item_byr"] == "spp") { $var_3_per3_spp = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev3_3_min_periode.$lev3_3_max_periode) && $row_get_spp["item_byr"] == "ict") {
					if($row_get_spp["item_byr"] == "ict") { $var_3_per3_ict = $row_get_spp["nominal"]; }
				}
				if($row_get_spp["ket_disc"] == ($lev3_3_min_periode.$lev3_3_max_periode) && $row_get_spp["item_byr"] == "kts") {
					if($row_get_spp["item_byr"] == "kts") { $var_3_per3_kts = $row_get_spp["nominal"]; }                                
				}
				if($row_get_spp["ket_disc"] == ($lev3_3_min_periode.$lev3_3_max_periode) && $row_get_spp["item_byr"] == "ler") {
					if($row_get_spp["item_byr"] == "ler") { $var_3_per3_ler = $row_get_spp["nominal"]; }                                
				}				
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 4
		if($row_get_spp["tingkat"] == "4") {
		
			//Current year - 3
			if($row_get_spp["ket_disc"] == ($lev4_1_min_periode.$lev4_1_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_1_min_periode.$lev4_1_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per1_ict = $row_get_spp["nominal"]; }	
			}
			if($row_get_spp["ket_disc"] == ($lev4_1_min_periode.$lev4_1_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_4_per1_kts = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev4_1_min_periode.$lev4_1_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_4_per1_ler = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 2
			if($row_get_spp["ket_disc"] == ($lev4_2_min_periode.$lev4_2_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per2_spp = $row_get_spp["nominal"]; } 	
			}
			if($row_get_spp["ket_disc"] == ($lev4_2_min_periode.$lev4_2_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_2_min_periode.$lev4_2_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_4_per2_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_2_min_periode.$lev4_2_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_4_per2_ler = $row_get_spp["nominal"]; }
			}
			
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev4_3_min_periode.$lev4_3_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_3_min_periode.$lev4_3_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_3_min_periode.$lev4_3_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_4_per3_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_3_min_periode.$lev4_3_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_4_per3_ler = $row_get_spp["nominal"]; }
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev4_4_min_periode.$lev4_4_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_4_per4_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_4_min_periode.$lev4_4_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_4_per4_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_4_min_periode.$lev4_4_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_4_per4_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev4_4_min_periode.$lev4_4_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_4_per4_ler = $row_get_spp["nominal"]; }
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 5
		if($row_get_spp["tingkat"] == "5") {
		
			//Current year - 4
			if($row_get_spp["ket_disc"] == ($lev5_1_min_periode.$lev5_1_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_1_min_periode.$lev5_1_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per1_ict = $row_get_spp["nominal"]; } 	
			}
			if($row_get_spp["ket_disc"] == ($lev5_1_min_periode.$lev5_1_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_5_per1_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_1_min_periode.$lev5_1_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_5_per1_ler = $row_get_spp["nominal"]; }
			}
			
			//Current year - 3
			if($row_get_spp["ket_disc"] == ($lev5_2_min_periode.$lev5_2_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per2_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_2_min_periode.$lev5_2_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per2_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev5_2_min_periode.$lev5_2_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_5_per2_kts = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev5_2_min_periode.$lev5_2_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_5_per2_ler = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 2
			if($row_get_spp["ket_disc"] == ($lev5_3_min_periode.$lev5_3_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_3_min_periode.$lev5_3_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_3_min_periode.$lev5_3_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_5_per3_kts = $row_get_spp["nominal"]; }	
			}
			if($row_get_spp["ket_disc"] == ($lev5_3_min_periode.$lev5_3_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_5_per3_ler = $row_get_spp["nominal"]; }	
			}
			
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev5_4_min_periode.$lev5_4_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per4_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev5_4_min_periode.$lev5_4_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per4_ict = $row_get_spp["nominal"]; }	
			}
			if($row_get_spp["ket_disc"] == ($lev5_4_min_periode.$lev5_4_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_5_per4_kts = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev5_4_min_periode.$lev5_4_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_5_per4_ler = $row_get_spp["nominal"]; } 
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev5_5_min_periode.$lev5_5_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_5_per5_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_5_min_periode.$lev5_5_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_5_per5_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_5_min_periode.$lev5_5_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_5_per5_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev5_5_min_periode.$lev5_5_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_5_per5_ler = $row_get_spp["nominal"]; }
			}
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////
		//Kelas 6
		if($row_get_spp["tingkat"] == "6") {
			
			//Current year - 5
			if($row_get_spp["ket_disc"] == ($lev6_1_min_periode.$lev6_1_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per1_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_1_min_periode.$lev6_1_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per1_ict = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_1_min_periode.$lev6_1_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_6_per1_kts = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_1_min_periode.$lev6_1_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_6_per1_ler = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 4
			if($row_get_spp["ket_disc"] == ($lev6_2_min_periode.$lev6_2_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per2_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_2_min_periode.$lev6_2_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per2_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_2_min_periode.$lev6_2_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_6_per2_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_2_min_periode.$lev6_2_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_6_per2_ler = $row_get_spp["nominal"]; }
			}
			
			//Current year - 3
			if($row_get_spp["ket_disc"] == ($lev6_3_min_periode.$lev6_3_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per3_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_3_min_periode.$lev6_3_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per3_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_3_min_periode.$lev6_3_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_6_per3_kts = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_3_min_periode.$lev6_3_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_6_per3_ler = $row_get_spp["nominal"]; } 
			}
			
			//Current year - 2
			if($row_get_spp["ket_disc"] == ($lev6_4_min_periode.$lev6_4_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per4_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_4_min_periode.$lev6_4_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per4_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_4_min_periode.$lev6_4_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_6_per4_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_4_min_periode.$lev6_4_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_6_per4_ler = $row_get_spp["nominal"]; }
			}
			
			//Current year - 1
			if($row_get_spp["ket_disc"] == ($lev6_5_min_periode.$lev6_5_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per5_spp = $row_get_spp["nominal"]; } 
			}
			if($row_get_spp["ket_disc"] == ($lev6_5_min_periode.$lev6_5_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per5_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_5_min_periode.$lev6_5_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_6_per5_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_5_min_periode.$lev6_5_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_6_per5_ler = $row_get_spp["nominal"]; }
			}
			
			//Current year
			if($row_get_spp["ket_disc"] == ($lev6_6_min_periode.$lev6_6_max_periode) && $row_get_spp["item_byr"] == "spp") {
				if($row_get_spp["item_byr"] == "spp") { $var_6_per6_spp = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_6_min_periode.$lev6_6_max_periode) && $row_get_spp["item_byr"] == "ict") {
				if($row_get_spp["item_byr"] == "ict") { $var_6_per6_ict = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_6_min_periode.$lev6_6_max_periode) && $row_get_spp["item_byr"] == "kts") {
				if($row_get_spp["item_byr"] == "kts") { $var_6_per6_kts = $row_get_spp["nominal"]; }
			}
			if($row_get_spp["ket_disc"] == ($lev6_6_min_periode.$lev6_6_max_periode) && $row_get_spp["item_byr"] == "ler") {
				if($row_get_spp["item_byr"] == "ler") { $var_6_per6_ler = $row_get_spp["nominal"]; }
			}
		}
	}
	/////////////////////////////////////////////////////////////////////////////////// 
	?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td>
                <form method="post" name="set_spp" action="engine.php?case=spp_edit">
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="6">Tahun pelajaran: <input type="text" size="10" readonly="readonly" name="periode" value="<?PHP echo $the_periode; ?>" /><input type="hidden" name="src_periode" value="<?PHP echo $the_periode; ?>" /></td>
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
                            <td>E-Learning</td>
						</tr>
						<?PHP
						/////////////////////////////////////////
						///////////////kelas 1///////////////////
						/////////////////////////////////////////
						
						if($src_j == "toddler") 	{ $class1_title	= "Toddler"; }
						else if($src_j == "pg") 	{ $class1_title	= "Play Group"; }
						else if($src_j == "tka") 	{ $class1_title	= "TK A"; }
						else if($src_j == "tkb") 	{ $class1_title	= "TK B"; }
						else if($src_j == "sd") 	{ $class1_title	= "Kelas 1"; }
						else if($src_j == "smp") 	{ $class1_title	= "Kelas 7"; }	
					
						//wiphiiiiiiiiiiiiiii.....
						//we need the last 2 digits from every year in period only.
						//so you gonna get the last 2 digits... :)
						$lev1_1_min_periode	= 	substr($_GET["per"],-9,2);
						$lev1_1_max_periode	=	substr($_GET["per"],-2,2);				
						?>  
                        <input type="hidden" name="j" value="<?PHP echo $src_j; ?>" />                  
						<tr height="25" bgcolor="#83736c">
							<td rowspan="1"><?PHP echo $class1_title; ?></td>
							<td><?PHP echo $lev1_1_min_periode." - ".$lev1_1_max_periode; ?></td>
							<td><input type="text" size="10" name="1-per1-spp" value="<?PHP echo $var_1_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
							<td><input type="text" size="10" name="1-per1-ict" value="<?PHP echo $var_1_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
							<td><input type="text" size="10" name="1-per1-kts" value="<?PHP echo $var_1_per1_kts; ?>" onkeypress="return checkIt(event)"/></td>
                            <td><input type="text" size="10" name="1-per1-ler" value="<?PHP echo $var_1_per1_ler; ?>" onkeypress="return checkIt(event)"/></td>
						</tr>                   
						<?PHP
						/////////////////////////////////////////
						///////////////kelas 2///////////////////
						/////////////////////////////////////////
						if($src_j == "smp" || $src_j == "sd") {
						
							if($src_j == "sd") 			{ $class2_title	= "Kelas 2"; }
							else if($src_j == "smp") 	{ $class2_title	= "Kelas 8"; }
							
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
								$lev2_1_min_periode	= 	"0".(substr($_GET["per"],-9,2)-1);
							} else {
								$lev2_1_min_periode	= 	substr($_GET["per"],-9,2)-1;
							}
							
							if((substr($_GET["per"],-2,2)+1) < 10) {
								$lev2_1_max_periode	=	"0".(substr($_GET["per"],-2,2)-1);
							} else {
								$lev2_1_max_periode	=	substr($_GET["per"],-2,2)-1;
							}
							?>
							<tr height="25" bgcolor="#8a6c66">
								<td rowspan="2"><?PHP echo $class2_title; ?></td>
								<td><?PHP echo $lev2_1_min_periode." - ".$lev2_1_max_periode; ?></td>
								<td><input type="text" size="10" name="2-per1-spp" value="<?PHP echo $var_2_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
								<td><input type="text" size="10" name="2-per1-ict" value="<?PHP echo $var_2_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
								<td><input type="text" size="10" name="2-per1-kts" value="<?PHP echo $var_2_per1_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="2-per1-ler" value="<?PHP echo $var_2_per1_ler; ?>" onkeypress="return checkIt(event)"/></td>
							</tr>
							<?PHP
							$lev2_2_min_periode	= 	substr($_GET["per"],-9,2);
							$lev2_2_max_periode	=	substr($_GET["per"],-2,2);
							?>
							<tr height="25" bgcolor="#8a6c66">
								<td><?PHP echo $lev2_2_min_periode." - ".$lev2_2_max_periode; ?></td>
								<td><input type="text" size="10" name="2-per2-spp" value="<?PHP echo $var_2_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
								<td><input type="text" size="10" name="2-per2-ict" value="<?PHP echo $var_2_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
								<td><input type="text" size="10" name="2-per2-kts" value="<?PHP echo $var_2_per2_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="2-per2-ler" value="<?PHP echo $var_2_per2_ler; ?>" onkeypress="return checkIt(event)"/></td>
							</tr>           
                            <?PHP
							/////////////////////////////////////////
							///////////////kelas 3///////////////////
							/////////////////////////////////////////
							if($src_j == "sd") 			{ $class3_title	= "Kelas 3"; }
							else if($src_j == "smp") 	{ $class3_title	= "Kelas 9"; }
							
							if((substr($_GET["per"],-9,2)+2) < 10) {
								$lev3_1_min_periode	= 	"0".(substr($_GET["per"],-9,2)-2);
							} else {
								$lev3_1_min_periode	= 	substr($_GET["per"],-9,2)-2;
							}
							
							if((substr($_GET["per"],-2,2)+2) < 10) {
								$lev3_1_max_periode	=	"0".(substr($_GET["per"],-2,2)-2);
							} else {
								$lev3_1_max_periode	=	substr($_GET["per"],-2,2)-2;
							}
							?>
							<tr height="25" bgcolor="#8d6774">
								<td rowspan="3"><?PHP echo $class3_title; ?></td>
								<td><?PHP echo $lev3_1_min_periode." - ".$lev3_1_max_periode; ?></td>
								<td><input type="text" size="10" name="3-per1-spp" value="<?PHP echo $var_3_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
								<td><input type="text" size="10" name="3-per1-ict" value="<?PHP echo $var_3_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
								<td><input type="text" size="10" name="3-per1-kts" value="<?PHP echo $var_3_per1_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="3-per1-ler" value="<?PHP echo $var_3_per1_ler; ?>" onkeypress="return checkIt(event)"/></td>
							</tr>
							<?PHP
							if((substr($_GET["per"],-9,2)+1) < 10) {
								$lev3_2_min_periode	= 	"0".(substr($_GET["per"],-9,2)-1);
							} else {
								$lev3_2_min_periode	= 	substr($_GET["per"],-9,2)-1;
							}
							
							if((substr($_GET["per"],-2,2)+1) < 10) {
								$lev3_2_max_periode	=	"0".(substr($_GET["per"],-2,2)-1);
							} else {
								$lev3_2_max_periode	=	substr($_GET["per"],-2,2)-1;
							}
							?>
                            <tr height="25" bgcolor="#8d6774">
                                <td><?PHP echo $lev3_2_min_periode." - ".$lev3_2_max_periode; ?></td>
                                <td><input type="text" size="10" name="3-per2-spp" value="<?PHP echo $var_3_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="3-per2-ict" value="<?PHP echo $var_3_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="3-per2-kts" value="<?PHP echo $var_3_per2_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="3-per2-ler" value="<?PHP echo $var_3_per2_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            $lev3_3_min_periode	= 	substr($_GET["per"],-9,2);
                            $lev3_3_max_periode	=	substr($_GET["per"],-2,2);
                            ?>
                            <tr height="25" bgcolor="#8d6774">
                                <td><?PHP echo $lev3_3_min_periode." - ".$lev3_3_max_periode; ?></td>
                                <td><input type="text" size="10" name="3-per3-spp" value="<?PHP echo $var_3_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="3-per3-ict" value="<?PHP echo $var_3_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="3-per3-kts" value="<?PHP echo $var_3_per3_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="3-per3-ler" value="<?PHP echo $var_3_per3_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>                                                   
                        <?PHP
                        }
                        /////////////////////////////////////////
                        ///////////////kelas 4///////////////////
                        /////////////////////////////////////////
						
                        if($src_j == "sd") {
                        
                            if((substr($_GET["per"],-9,2)+3) < 10) {
                                $lev4_1_min_periode	= 	"0".(substr($_GET["per"],-9,2)-3);
                            } else {
                                $lev4_1_min_periode	= 	substr($_GET["per"],-9,2)-3;
                            }
                            
                            if((substr($_GET["per"],-2,2)+3) < 10) {
                                $lev4_1_max_periode	=	"0".(substr($_GET["per"],-2,2)-3);
                            } else {
                                $lev4_1_max_periode	=	substr($_GET["per"],-2,2)-3;
                            }
                            ?>
                            <tr height="25" bgcolor="#7f7085">
                                <td rowspan="4">Kelas 4</td>
                                <td><?PHP echo $lev4_1_min_periode." - ".$lev4_1_max_periode; ?></td>
                                <td><input type="text" size="10" name="4-per1-spp" value="<?PHP echo $var_4_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per1-ict" value="<?PHP echo $var_4_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per1-kts" value="<?PHP echo $var_4_per1_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per1-ler" value="<?PHP echo $var_4_per1_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+2) < 10) {
                                $lev4_2_min_periode	= 	"0".(substr($_GET["per"],-9,2)-2);
                            } else {
                                $lev4_2_min_periode	= 	substr($_GET["per"],-9,2)-2;
                            }
                            
                            if((substr($_GET["per"],-2,2)+2) < 10) {
                                $lev4_2_max_periode	=	"0".(substr($_GET["per"],-2,2)-2);
                            } else {
                                $lev4_2_max_periode	=	substr($_GET["per"],-2,2)-2;
                            }
                            ?>
                            <tr height="25" bgcolor="#7f7085">
                                <td><?PHP echo $lev4_2_min_periode." - ".$lev4_2_max_periode; ?></td>
                                <td><input type="text" size="10" name="4-per2-spp" value="<?PHP echo $var_4_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per2-ict" value="<?PHP echo $var_4_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per2-kts" value="<?PHP echo $var_4_per2_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per2-ler" value="<?PHP echo $var_4_per2_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+1) < 10) {
                                $lev4_3_min_periode	= 	"0".(substr($_GET["per"],-9,2)-1);
                            } else {
                                $lev4_3_min_periode	= 	substr($_GET["per"],-9,2)-1;
                            }
                            
                            if((substr($_GET["per"],-2,2)+1) < 10) {
                                $lev4_3_max_periode	=	"0".(substr($_GET["per"],-2,2)-1);
                            } else {
                                $lev4_3_max_periode	=	substr($_GET["per"],-2,2)-1;
                            }
                            ?>
                            <tr height="25" bgcolor="#7f7085">
                                <td><?PHP echo $lev4_3_min_periode." - ".$lev4_3_max_periode; ?></td>
                                <td><input type="text" size="10" name="4-per3-spp" value="<?PHP echo $var_4_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per3-ict" value="<?PHP echo $var_4_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per3-kts" value="<?PHP echo $var_4_per3_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per3-ler" value="<?PHP echo $var_4_per3_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            $lev4_4_min_periode	= 	substr($_GET["per"],-9,2);
                            $lev4_4_max_periode	=	substr($_GET["per"],-2,2);
                            ?>
                            <tr height="25" bgcolor="#7f7085">
                                <td><?PHP echo $lev4_4_min_periode." - ".$lev4_4_max_periode; ?></td>
                                <td><input type="text" size="10" name="4-per4-spp" value="<?PHP echo $var_4_per4_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per4-ict" value="<?PHP echo $var_4_per4_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per4-kts" value="<?PHP echo $var_4_per4_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="4-per4-ler" value="<?PHP echo $var_4_per4_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            /////////////////////////////////////////
                            ///////////////kelas 5///////////////////
                            /////////////////////////////////////////
                            
                            
                            if((substr($_GET["per"],-9,2)+4) < 10) {
                                $lev5_1_min_periode	= 	"0".(substr($_GET["per"],-9,2)-4);
                            } else {
                                $lev5_1_min_periode	= 	substr($_GET["per"],-9,2)-4;
                            }
                            
                            if((substr($_GET["per"],-2,2)+4) < 10) {
                                $lev5_1_max_periode	=	"0".(substr($_GET["per"],-2,2)-4);
                            } else {
                                $lev5_1_max_periode	=	substr($_GET["per"],-2,2)-4;
                            }
                            ?>
                            <tr height="25" bgcolor="#58778a">
                                <td rowspan="5">Kelas 5</td>
                                <td><?PHP echo $lev5_1_min_periode." - ".$lev5_1_max_periode; ?></td>
                                <td><input type="text" size="10" name="5-per1-spp" value="<?PHP echo $var_5_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per1-ict" value="<?PHP echo $var_5_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per1-kts" value="<?PHP echo $var_5_per1_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per1-ler" value="<?PHP echo $var_5_per1_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+3) < 10) {
                                $lev5_2_min_periode	= 	"0".(substr($_GET["per"],-9,2)-3);
                            } else {
                                $lev5_2_min_periode	= 	substr($_GET["per"],-9,2)-3;
                            }
                            
                            if((substr($_GET["per"],-2,2)+3) < 10) {
                                $lev5_2_max_periode	=	"0".(substr($_GET["per"],-2,2)-3);
                            } else {
                                $lev5_2_max_periode	=	substr($_GET["per"],-2,2)-3;
                            }
                            ?>
                            <tr height="25" bgcolor="#58778a">
                                <td><?PHP echo $lev5_2_min_periode." - ".$lev5_2_max_periode; ?></td>
                                <td><input type="text" size="10" name="5-per2-spp" value="<?PHP echo $var_5_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per2-ict" value="<?PHP echo $var_5_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per2-kts" value="<?PHP echo $var_5_per2_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per2-ler" value="<?PHP echo $var_5_per2_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+2) < 10) {
                                $lev5_3_min_periode	= 	"0".(substr($_GET["per"],-9,2)-2);
                            } else {
                                $lev5_3_min_periode	= 	substr($_GET["per"],-9,2)-2;
                            }
                            
                            if((substr($_GET["per"],-2,2)+2) < 10) {
                                $lev5_3_max_periode	=	"0".(substr($_GET["per"],-2,2)-2);
                            } else {
                                $lev5_3_max_periode	=	substr($_GET["per"],-2,2)-2;
                            }
                            ?>
                            <tr height="25" bgcolor="#58778a">
                                <td><?PHP echo $lev5_3_min_periode." - ".$lev5_3_max_periode; ?></td>
                                <td><input type="text" size="10" name="5-per3-spp" value="<?PHP echo $var_5_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per3-ict" value="<?PHP echo $var_5_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per3-kts" value="<?PHP echo $var_5_per3_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per3-ler" value="<?PHP echo $var_5_per3_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+1) < 10) {
                                $lev5_2_min_periode	= 	"0".(substr($_GET["per"],-9,2)-1);
                            } else {
                                $lev5_2_min_periode	= 	substr($_GET["per"],-9,2)-1;
                            }
                            
                            if((substr($_GET["per"],-2,2)+1) < 10) {
                                $lev5_2_max_periode	=	"0".(substr($_GET["per"],-2,2)-1);
                            } else {
                                $lev5_2_max_periode	=	substr($_GET["per"],-2,2)-1;
                            }
                            ?>
                            <tr height="25" bgcolor="#58778a">
                                <td><?PHP echo $lev5_2_min_periode." - ".$lev5_2_max_periode; ?></td>
                                <td><input type="text" size="10" name="5-per4-spp" value="<?PHP echo $var_5_per4_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per4-ict" value="<?PHP echo $var_5_per4_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per4-kts" value="<?PHP echo $var_5_per4_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per4-ler" value="<?PHP echo $var_5_per4_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            $lev5_5_min_periode	= 	substr($_GET["per"],-9,2);
                            $lev5_5_max_periode	=	substr($_GET["per"],-2,2);
                            ?>
                            <tr height="25" bgcolor="#58778a">
                                <td><?PHP echo $lev5_5_min_periode." - ".$lev5_5_max_periode; ?></td>
                                <td><input type="text" size="10" name="5-per5-spp" value="<?PHP echo $var_5_per5_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per5-ict" value="<?PHP echo $var_5_per5_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per5-kts" value="<?PHP echo $var_5_per5_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="5-per5-ler" value="<?PHP echo $var_5_per5_ler ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            /////////////////////////////////////////
                            ///////////////kelas 6///////////////////
                            /////////////////////////////////////////
                            
                            
                            if((substr($_GET["per"],-9,2)+5) < 10) {
                                $lev6_1_min_periode	= 	"0".(substr($_GET["per"],-9,2)-5);
                            } else {
                                $lev6_1_min_periode	= 	substr($_GET["per"],-9,2)-5;
                            }
                            
                            if((substr($_GET["per"],-2,2)+5) < 10) {
                                $lev6_1_max_periode	=	"0".(substr($_GET["per"],-2,2)-5);
                            } else {
                                $lev6_1_max_periode	=	substr($_GET["per"],-2,2)-5;
                            }
                            ?>
                            <tr height="25" bgcolor="#668285">
                                <td rowspan="6">Kelas 6</td>
                                <td><?PHP echo $lev6_1_min_periode." - ".$lev6_1_max_periode; ?></td>
                                <td><input type="text" size="10" name="6-per1-spp" value="<?PHP echo $var_6_per1_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per1-ict" value="<?PHP echo $var_6_per1_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per1-kts" value="<?PHP echo $var_6_per1_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per1-ler" value="<?PHP echo $var_6_per1_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+4) < 10) {
                                $lev6_2_min_periode	= 	"0".(substr($_GET["per"],-9,2)-4);
                            } else {
                                $lev6_2_min_periode	= 	substr($_GET["per"],-9,2)-4;
                            }
                            
                            if((substr($_GET["per"],-2,2)+4) < 10) {
                                $lev6_2_max_periode	=	"0".(substr($_GET["per"],-2,2)-4);
                            } else {
                                $lev6_2_max_periode	=	substr($_GET["per"],-2,2)-4;
                            }
                            ?>
                            <tr height="25" bgcolor="#668285">
                                <td><?PHP echo $lev6_2_min_periode." - ".$lev6_2_max_periode; ?></td>
                                <td><input type="text" size="10" name="6-per2-spp" value="<?PHP echo $var_6_per2_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per2-ict" value="<?PHP echo $var_6_per2_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per2-kts" value="<?PHP echo $var_6_per2_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per2-ler" value="<?PHP echo $var_6_per2_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+3) < 10) {
                                $lev6_3_min_periode	= 	"0".(substr($_GET["per"],-9,2)-3);
                            } else {
                                $lev6_3_min_periode	= 	substr($_GET["per"],-9,2)-3;
                            }
                            
                            if((substr($_GET["per"],-2,2)+3) < 10) {
                                $lev6_3_max_periode	=	"0".(substr($_GET["per"],-2,2)-3);
                            } else {
                                $lev6_3_max_periode	=	substr($_GET["per"],-2,2)-3;
                            }
                            ?>
                            <tr height="25" bgcolor="#668285">
                                <td><?PHP echo $lev6_3_min_periode." - ".$lev6_3_max_periode; ?></td>
                                <td><input type="text" size="10" name="6-per3-spp" value="<?PHP echo $var_6_per3_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per3-ict" value="<?PHP echo $var_6_per3_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per3-kts" value="<?PHP echo $var_6_per3_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per3-ler" value="<?PHP echo $var_6_per3_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+2) < 10) {
                                $lev6_4_min_periode	= 	"0".(substr($_GET["per"],-9,2)-2);
                            } else {
                                $lev6_4_min_periode	= 	substr($_GET["per"],-9,2)-2;
                            }
                            
                            if((substr($_GET["per"],-2,2)+2) < 10) {
                                $lev6_4_max_periode	=	"0".(substr($_GET["per"],-2,2)-2);
                            } else {
                                $lev6_4_max_periode	=	substr($_GET["per"],-2,2)-2;
                            }
                            ?>
                            <tr height="25" bgcolor="#668285">
                                <td><?PHP echo $lev6_4_min_periode." - ".$lev6_4_max_periode; ?></td>
                                <td><input type="text" size="10" name="6-per4-spp" value="<?PHP echo $var_6_per4_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per4-ict" value="<?PHP echo $var_6_per4_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per4-kts" value="<?PHP echo $var_6_per4_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per4-ler" value="<?PHP echo $var_6_per4_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            if((substr($_GET["per"],-9,2)+1) < 10) {
                                $lev6_5_min_periode	= 	"0".(substr($_GET["per"],-9,2)-1);
                            } else {
                                $lev6_5_min_periode	= 	substr($_GET["per"],-9,2)-1;
                            }
                            
                            if((substr($_GET["per"],-2,2)+1) < 10) {
                                $lev6_5_max_periode	=	"0".(substr($_GET["per"],-2,2)-1);
                            } else {
                                $lev6_5_max_periode	=	substr($_GET["per"],-2,2)-1;
                            }
                            ?>
                            <tr height="25" bgcolor="#668285">
                                <td><?PHP echo $lev6_5_min_periode." - ".$lev6_5_max_periode; ?></td>
                                <td><input type="text" size="10" name="6-per5-spp" value="<?PHP echo $var_6_per5_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per5-ict" value="<?PHP echo $var_6_per5_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per5-kts" value="<?PHP echo $var_6_per5_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per5-ler" value="<?PHP echo $var_6_per5_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <?PHP
                            $lev6_6_min_periode	= 	substr($_GET["per"],-9,2);
                            $lev6_6_max_periode	=	substr($_GET["per"],-2,2);
                            ?>
                            <tr height="25" bgcolor="#668285">
                                <td><?PHP echo $lev6_6_min_periode." - ".$lev6_6_max_periode; ?></td>
                                <td><input type="text" size="10" name="6-per6-spp" value="<?PHP echo $var_6_per6_spp; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per6-ict" value="<?PHP echo $var_6_per6_ict; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per6-kts" value="<?PHP echo $var_6_per6_kts; ?>" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="6-per6-ler" value="<?PHP echo $var_6_per6_ler; ?>" onkeypress="return checkIt(event)"/></td>
                            </tr>
							<?PHP
                            }
                            ?>
                            <tr height="60" bgcolor="#333333">
                                <td colspan="6" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpan nilai SPP" onClick="return verification()"/></td>
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
	if(document.set_spp.periode.value == "")
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