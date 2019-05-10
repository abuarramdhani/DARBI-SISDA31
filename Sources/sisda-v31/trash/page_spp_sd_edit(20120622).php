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
	?>
	<form method="post" name="set_spp" action="engine.php?case=spp_sd_edit">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    	<tr>
            <td width="30"></td>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="5">Tahun pelajaran: <input type="text" size="10" readonly="readonly" name="period" value="<?PHP echo $the_periode; ?>" /><input type="hidden" name="level" value="sd" /></td>
                    </tr>
                    <tr height="25" bgcolor="#333333" id="text_normal_white">
                        <td>Jenjang</td>
                        <td>Keterangan</td>
                        <td>SPP</td>
                        <td>ICT</td>
                        <td>Komite sekolah</td>
                    </tr>
					<?PHP
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
						if($row_get_spp["jenjang"] == 1) {
							if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>
                                <tr height="25" bgcolor="#83736c">
                                    <td rowspan="5">Kelas 1</td>
                                    <td><?PHP echo $lev1_1_min_period."-".$lev1_1_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-per1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-per1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == ($lev1_1_min_period.$lev1_1_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-per1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#83736c">
                                    <td>Anak guru</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-angu-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
					?>								               
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-angu-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
					?>
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-angu-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
					?>
                                <tr height="25" bgcolor="#83736c">
                                    <td>Discount khusus 1</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-dis1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-dis1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
					?>
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-dis1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#83736c">
                                    <td>Discount khusus 2</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-dis2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-dis2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-dis2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#83736c">
                                    <td>Discount khusus 3</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="1-dis3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="1-dis3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
					?>               
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="1-dis3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP		
							}
						}
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						if($row_get_spp["jenjang"] == 2) {
							if($row_get_spp["ket_disc"] == ($lev2_1_min_period.$lev2_1_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>
                    			 <tr height="25" bgcolor="#8a6c66">
                                    <td rowspan="6">Kelas 2</td>
                                    <td><?PHP echo $lev2_1_min_period."-".$lev2_1_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="2-per1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev2_1_min_period.$lev2_1_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>       
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="2-per1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev2_1_min_period.$lev2_1_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="2-per1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev2_2_min_period.$lev2_2_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8a6c66">
                                    <td><?PHP echo $lev2_2_min_period."-".$lev2_2_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="2-per2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev2_2_min_period.$lev2_2_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="2-per2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev2_2_min_period.$lev2_2_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="2-per2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>Anak guru</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="2-angu-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="2-angu-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="2-angu-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>Discount khusus 1</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="2-dis1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="2-dis1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="2-dis1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
					?>            	
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>Discount khusus 2</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="2-dis2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="2-dis2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="2-dis2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
					?>             	
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>Discount khusus 3</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="2-dis3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="2-dis3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="2-dis3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>	
                    <?PHP
							}
						}
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						if($row_get_spp["jenjang"] == 3) {
							if($row_get_spp["ket_disc"] == ($lev3_1_min_period.$lev3_1_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#8d6774">
                                    <td rowspan="7">Kelas 3</td>
                                    <td><?PHP echo $lev3_1_min_period."-".$lev3_1_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="3-per1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_1_min_period.$lev3_1_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                   
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="3-per1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_1_min_period.$lev3_1_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="3-per1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_2_min_period.$lev3_2_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8d6774">
                                    <td><?PHP echo $lev3_2_min_period."-".$lev3_2_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="3-per2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_2_min_period.$lev3_2_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="3-per2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_2_min_period.$lev3_2_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="3-per2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_3_min_period.$lev3_3_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8d6774">
                                    <td><?PHP echo $lev3_3_min_period."-".$lev3_3_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="3-per3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_3_min_period.$lev3_3_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="3-per3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev3_3_min_period.$lev3_3_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="3-per3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#8d6774">
                                    <td>Anak guru</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="3-angu-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="3-angu-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="3-angu-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8d6774">
                                    <td>Discount khusus 1</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="3-dis1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="3-dis1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="3-dis1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8d6774">
                                    <td>Discount khusus 2</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="3-dis2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="3-dis2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="3-dis2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#8d6774">
                                    <td>Discount khusus 3</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="3-dis3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="3-dis3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="3-dis3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                                		
                    <?PHP
							}
						}
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						if($row_get_spp["jenjang"] == 4) {
							if($row_get_spp["ket_disc"] == ($lev4_1_min_period.$lev4_1_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#7f7085">
                                    <td rowspan="8">Kelas 4</td>
                                    <td><?PHP echo $lev4_1_min_period."-".$lev4_1_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-per1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_1_min_period.$lev4_1_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-per1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_1_min_period.$lev4_1_max_period) && $row_get_spp["item_byr"] == "add") {
					?>               
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-per1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_2_min_period.$lev4_2_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#7f7085">
                                    <td><?PHP echo $lev4_2_min_period."-".$lev4_2_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-per2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_2_min_period.$lev4_2_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-per2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_2_min_period.$lev4_2_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-per2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_3_min_period.$lev4_3_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#7f7085">
                                    <td><?PHP echo $lev4_3_min_period."-".$lev4_3_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-per3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_3_min_period.$lev4_3_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-per3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_3_min_period.$lev4_3_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-per3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_4_min_period.$lev4_4_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#7f7085">
                                    <td><?PHP echo $lev4_4_min_period."-".$lev4_4_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-per4-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_4_min_period.$lev4_4_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-per4-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev4_4_min_period.$lev4_4_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-per4-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#7f7085">
                                    <td>Anak guru</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-angu-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-angu-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-angu-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#7f7085">
                                    <td>Discount khusus 1</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-dis1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-dis1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-dis1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#7f7085">
                                    <td>Discount khusus 2</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-dis2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-dis2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-dis2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#7f7085">
                                    <td>Discount khusus 3</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="4-dis3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="4-dis3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="4-dis3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP
							}
						}
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						if($row_get_spp["jenjang"] == 5) {
							if($row_get_spp["ket_disc"] == ($lev5_1_min_period.$lev5_1_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>
                    			 <tr height="25" bgcolor="#58778a">
                                    <td rowspan="9">Kelas 5</td>
                                    <td><?PHP echo $lev5_1_min_period."-".$lev5_1_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-per1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_1_min_period.$lev5_1_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-per1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_1_min_period.$lev5_1_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-per1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_2_min_period.$lev5_2_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_2_min_period."-".$lev5_2_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-per2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_2_min_period.$lev5_2_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-per2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_2_min_period.$lev5_2_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-per2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_3_min_period.$lev5_3_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>              
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_3_min_period."-".$lev5_3_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-per3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_3_min_period.$lev5_3_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-per3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_3_min_period.$lev5_3_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-per3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_4_min_period.$lev5_4_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>              
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_4_min_period."-".$lev5_4_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-per4-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_4_min_period.$lev5_4_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-per4-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_4_min_period.$lev5_4_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-per4-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
						}
							if($row_get_spp["ket_disc"] == ($lev5_5_min_period.$lev5_5_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>              
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_5_min_period."-".$lev5_5_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-per5-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_5_min_period.$lev5_5_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-per5-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev5_5_min_period.$lev5_5_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-per5-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#58778a">
                                    <td>Anak guru</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-angu-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                   	<?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-angu-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-angu-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#58778a">
                                    <td>Discount khusus 1</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-dis1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-dis1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-dis1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#58778a">
                                    <td>Discount khusus 2</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-dis2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-dis2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
					?>               
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-dis2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#58778a">
                                    <td>Discount khusus 3</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="5-dis3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="5-dis3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="5-dis3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP
							}	
						}
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						if($row_get_spp["jenjang"] == 6) {
							if($row_get_spp["ket_disc"] == ($lev6_1_min_period.$lev6_1_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>
                    			<tr height="25" bgcolor="#668285">
                                    <td rowspan="10">Kelas 6</td>
                                    <td><?PHP echo $lev6_1_min_period."-".$lev6_1_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-per1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_1_min_period.$lev6_1_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                  
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-per1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_1_min_period.$lev6_1_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-per1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_2_min_period.$lev6_2_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_2_min_period."-".$lev6_2_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-per2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_2_min_period.$lev6_2_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-per2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_2_min_period.$lev6_2_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-per2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_3_min_period.$lev6_3_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_3_min_period."-".$lev6_3_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-per3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_3_min_period.$lev6_3_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-per3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_3_min_period.$lev6_3_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-per3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_4_min_period.$lev6_4_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_4_min_period."-".$lev6_4_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-per4-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_4_min_period.$lev6_4_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-per4-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_4_min_period.$lev6_4_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-per4-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == ($lev6_5_min_period.$lev6_5_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_5_min_period."-".$lev6_5_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-per5-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_5_min_period.$lev6_5_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-per5-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_5_min_period.$lev6_5_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-per5-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_6_min_period.$lev6_6_max_period) && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_6_min_period."-".$lev6_6_max_period; ?></td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-per6-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_6_min_period.$lev6_6_max_period) && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-per6-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == ($lev6_6_min_period.$lev6_6_max_period) && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-per6-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#668285">
                                    <td>Anak guru</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-angu-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-angu-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "angu" && $row_get_spp["item_byr"] == "add") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-angu-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "spp") {
					?>            
                                <tr height="25" bgcolor="#668285">
                                    <td>Discount khusus 1</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-dis1-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-dis1-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis1" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-dis1-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "spp") {
					?>             
                                <tr height="25" bgcolor="#668285">
                                    <td>Discount khusus 2</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-dis2-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "ict") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-dis2-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis2" && $row_get_spp["item_byr"] == "add") {
					?>                
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-dis2-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "spp") {
					?>              
                                <tr height="25" bgcolor="#668285">
                                    <td>Discount khusus 3</td>
                                    <td><?PHP if($row_get_spp["item_byr"] == "spp") { ?><input type="text" size="10" name="6-dis3-spp" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "ict") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "ict") { ?><input type="text" size="10" name="6-dis3-ict" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                    <?PHP	
							}
							if($row_get_spp["ket_disc"] == "dis3" && $row_get_spp["item_byr"] == "add") {
					?>                 
                                    <td><?PHP if($row_get_spp["item_byr"] == "add") { ?><input type="text" size="10" name="6-dis3-add" value="<?PHP echo $row_get_spp["nominal"]; ?>" onkeypress="return checkIt(event)"/><?PHP } ?></td>
                                </tr>
                    <?PHP
							}
						}
                    }
                    ?>
                    <tr height="60" bgcolor="#333333">
                        <td colspan="5" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpai nilai SPP" onClick="return verification()"/> <input type="button" value="Batal dan kembali" onClick="document.location='mainpage.php?pl=spp_sd_setting'" /></td>
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