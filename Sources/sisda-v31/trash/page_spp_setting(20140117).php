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
        <?PHP
		$src_j	= $_GET["j"];		
		
		if($src_j == "toddler") 	{ $title_page	= "Toddler"; }
		else if($src_j == "pg") 	{ $title_page	= "Play Group"; }
		else if($src_j == "tka") 	{ $title_page	= "TK A"; }
		else if($src_j == "tkb") 	{ $title_page	= "TK B"; }
		else if($src_j == "sd") 	{ $title_page	= "SD"; }
		else if($src_j == "smp") 	{ $title_page	= "SMP"; }	
		?>
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
    <form method="post" name="set_spp" action="engine.php?case=spp_setting">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="5">Tahun pelajaran: <?PHP include"include/period_refr_page.php"; ?><input type="hidden" name="src_periode" value="<?PHP echo substr($_GET["periode"],-11,11); ?>" /></td>
                    </tr>
                    <?PHP
					//what is the idea with this "periode case"..?
					//Here it is... 
					//Mrs Fitri wanna separate the discount for every class depand on when the student joint/register to a class (we are talking about new student that not joint from the beginning of a class: maksute siswa pindahan hehehe)
					//You'll find that every level has different type of discount. and the discount type will be named with the selected periode.
					
					//OK i wanna sing a song for cha....
					//dududududuuuuuuuu...
					//Kita mesti telanjang dan benar-benar bersih
					//Suci dan di dalam bathinnnnnnnnnnnnn....dudududududuuu.....
					if(empty($_GET["periode"])) {
					?>
                    <tr height="150">
                    	<td colspan="5" align="center" id="text_normal_black"><b>Untuk menentukan nilai nominal SPP yang baru, silahkan pilih tahun pelajaran di atas.</b></td>
                    </tr>
                    <?PHP
					} else {
					
						//check whether the periode already setup or not, if so, dont let the admin make the other one. it's only may make 1 setting for one periode
						$src_j_enc	= mysql_real_escape_string($src_j);
						$periode_enc	= mysql_real_escape_string($_GET["periode"]);
						
						
						$src_check_periode	= "select id from set_spp where periode = '$periode_enc' and jenjang = '$src_j_enc'";
						$query_check_periode	= mysqli_query($mysql_connect, $src_check_periode) or die (mysql_error($src_check_periode));
						$num_check_periode	= mysql_num_rows($query_check_periode);
						
						if($num_check_periode != 0) {
						?>
                        <tr height="150">
                    		<td colspan="5" align="center" id="text_normal_black"><b>Nilai nominal SPP untuk Jenjang <?PHP echo  $title_page; ?> tahun pelajaran <?PHP echo $periode_enc; ?>, sudah dilakukan.<br /> Untuk merubahnya silahkan lakukan proses editing pada daftar nominal SPP yang ada di bawah form ini.</b></td>
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
                            /*
                            Look at this: this page will be used in 6 condition, which is based on the value of $_GET["j"] -> toddler, pg, tka, tkb sd, smp
                            the problem is each value has different state os class.
                            toddler = 1
                            pg		= 1
                            tka		= 1
                            tkb		= 1
                            sd		= 6
                            smp		= 3
                            
                            so here we go, let's break this page into 6 conditions.
                            */
                        
                            if($src_j == "toddler") 	{ $class1_title	= "Toddler"; }
                            else if($src_j == "pg") 	{ $class1_title	= "Play Group"; }
                            else if($src_j == "tka") 	{ $class1_title	= "TK A"; }
                            else if($src_j == "tkb") 	{ $class1_title	= "TK B"; }
                            else if($src_j == "sd") 	{ $class1_title	= "Kelas 1"; }
                            else if($src_j == "smp") 	{ $class1_title	= "Kelas 7"; }	
                            
                            $j = $src_j;			
                            
                            /////////////////////////////////////////
                            ///////////////kelas 1///////////////////
                            /////////////////////////////////////////
                            
                            
                            //wiphiiiiiiiiiiiiiii.....
                            //we need the last 2 digits from every year in periode only.
                            //so you gonna get the last 2 digits... :)
                            $lev1_1_min_periode	= 	substr($_GET["periode"],-9,2);
                            $lev1_1_max_periode	=	substr($_GET["periode"],-2,2);				
                            ?>  
                            <input type="hidden" name="j" value="<?PHP echo $j; ?>" />                  
                            <tr height="25" bgcolor="#83736c">
                                <td rowspan="5"><?PHP echo $class1_title; ?></td>
                                <td><?PHP echo $lev1_1_min_periode." - ".$lev1_1_max_periode; ?></td>
                                <td><input type="text" size="10" name="1-per1-spp" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-per1-ict" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-per1-add" onkeypress="return checkIt(event)"/></td>
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
                            <tr height="25" bgcolor="#83736c">
                                <td>kategori 1</td>
                                <td><input type="text" size="10" name="1-angu-spp" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-angu-ict" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-angu-add" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <tr height="25" bgcolor="#83736c">
                                <td>Kategori 2</td>
                                <td><input type="text" size="10" name="1-dis1-spp" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-dis1-ict" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-dis1-add" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <tr height="25" bgcolor="#83736c">
                                <td>Kategori 3</td>
                                <td><input type="text" size="10" name="1-dis2-spp" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-dis2-ict" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-dis2-add" onkeypress="return checkIt(event)"/></td>
                            </tr>
                            <tr height="25" bgcolor="#83736c">
                                <td>Kategori 4</td>
                                <td><input type="text" size="10" name="1-dis3-spp" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-dis3-ict" onkeypress="return checkIt(event)"/></td>
                                <td><input type="text" size="10" name="1-dis3-add" onkeypress="return checkIt(event)"/></td>
                            </tr>                    
							<?PHP
                            if($src_j == "smp" || $src_j == "sd") {
                                
                                if($src_j == "sd") 			{ $class2_title	= "Kelas 2"; }
                                else if($src_j == "smp") 	{ $class2_title	= "Kelas 8"; }
                                /////////////////////////////////////////
                                ///////////////kelas 2///////////////////
                                /////////////////////////////////////////
                                
                                
                                //why plus 1,2,3,4 and 5??????
                                //because for every level/class, the chance for a student to joint a class separated into:
                                //1. level 1 -> 1 chance of periode
                                //2. level 2 -> 2 chances of periode
                                //3. level 3 -> 3 chances of periode
                                //4. level 4 -> 4 chances of periode
                                //5. level 5 -> 5 chances of periode
                                //6. level 6 -> 6 chances of periode
                                
                                // and you know that we are not talking about discount for teacher's children and special discount.
                                // this the periode based discount only.... okehhhhhhhhhhhh
                                if((substr($_GET["periode"],-9,2)-1) < 10) {
                                    $lev2_1_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-1);
                                } else {
                                    $lev2_1_min_periode	= 	substr($_GET["periode"],-9,2)-1;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-1) < 10) {
                                    $lev2_1_max_periode	=	"0".(substr($_GET["periode"],-2,2)-1);
                                } else {
                                    $lev2_1_max_periode	=	substr($_GET["periode"],-2,2)-1;
                                }
                                ?>
                                <tr height="25" bgcolor="#8a6c66">
                                    <td rowspan="6"><?PHP echo $class2_title; ?></td>
                                    <td><?PHP echo $lev2_1_min_periode." - ".$lev2_1_max_periode; ?></td>
                                    <td><input type="text" size="10" name="2-per1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-per1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-per1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                $lev2_2_min_periode	= 	substr($_GET["periode"],-9,2);
                                $lev2_2_max_periode	=	substr($_GET["periode"],-2,2);
                                ?>
                                <tr height="25" bgcolor="#8a6c66">
                                    <td><?PHP echo $lev2_2_min_periode." - ".$lev2_2_max_periode; ?></td>
                                    <td><input type="text" size="10" name="2-per2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-per2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-per2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>kategori 1</td>
                                    <td><input type="text" size="10" name="2-angu-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-angu-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-angu-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>Kategori 2</td>
                                    <td><input type="text" size="10" name="2-dis1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-dis1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-dis1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>Kategori 3</td>
                                    <td><input type="text" size="10" name="2-dis2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-dis2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-dis2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8a6c66">
                                    <td>Kategori 4</td>
                                    <td><input type="text" size="10" name="2-dis3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-dis3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="2-dis3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if($src_j == "sd") 			{ $class3_title	= "Kelas 3"; }
                                else if($src_j == "smp") 	{ $class3_title	= "Kelas 9"; }
                                /////////////////////////////////////////
                                ///////////////kelas 3///////////////////
                                /////////////////////////////////////////
                                
                                
                                if((substr($_GET["periode"],-9,2)-2) < 10) {
                                    $lev3_1_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-2);
                                } else {
                                    $lev3_1_min_periode	= 	substr($_GET["periode"],-9,2)-2;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-2) < 10) {
                                    $lev3_1_max_periode	=	"0".(substr($_GET["periode"],-2,2)-2);
                                } else {
                                    $lev3_1_max_periode	=	substr($_GET["periode"],-2,2)-2;
                                }
                                ?>
                                <tr height="25" bgcolor="#8d6774">
                                    <td rowspan="7"><?PHP echo $class3_title; ?></td>
                                    <td><?PHP echo $lev3_1_min_periode." - ".$lev3_1_max_periode; ?></td>
                                    <td><input type="text" size="10" name="3-per1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-per1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-per1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-1) < 10) {
                                    $lev3_2_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-1);
                                } else {
                                    $lev3_2_min_periode	= 	substr($_GET["periode"],-9,2)-1;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-1) < 10) {
                                    $lev3_2_max_periode	=	"0".(substr($_GET["periode"],-2,2)-1);
                                } else {
                                    $lev3_2_max_periode	=	substr($_GET["periode"],-2,2)-1;
                                }
                                ?>
                                <tr height="25" bgcolor="#8d6774">
                                    <td><?PHP echo $lev3_2_min_periode." - ".$lev3_2_max_periode; ?></td>
                                    <td><input type="text" size="10" name="3-per2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-per2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-per2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                $lev3_3_min_periode	= 	substr($_GET["periode"],-9,2);
                                $lev3_3_max_periode	=	substr($_GET["periode"],-2,2);
                                ?>
                                <tr height="25" bgcolor="#8d6774">
                                    <td><?PHP echo $lev3_3_min_periode." - ".$lev3_3_max_periode; ?></td>
                                    <td><input type="text" size="10" name="3-per3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-per3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-per3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8d6774">
                                    <td>kategori 1</td>
                                    <td><input type="text" size="10" name="3-angu-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-angu-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-angu-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8d6774">
                                    <td>Kategori 2</td>
                                    <td><input type="text" size="10" name="3-dis1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-dis1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-dis1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8d6774">
                                    <td>Kategori 3</td>
                                    <td><input type="text" size="10" name="3-dis2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-dis2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-dis2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#8d6774">
                                    <td>Kategori 4</td>
                                    <td><input type="text" size="10" name="3-dis3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-dis3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="3-dis3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
							<?PHP
                            }
                            
                            if($src_j == "sd") {
                                /////////////////////////////////////////
                                ///////////////kelas 4///////////////////
                                /////////////////////////////////////////
                                
                        
                                if((substr($_GET["periode"],-9,2)-3) < 10) {
                                    $lev4_1_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-3);
                                } else {
                                    $lev4_1_min_periode	= 	substr($_GET["periode"],-9,2)-3;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-3) < 10) {
                                    $lev4_1_max_periode	=	"0".(substr($_GET["periode"],-2,2)-3);
                                } else {
                                    $lev4_1_max_periode	=	substr($_GET["periode"],-2,2)-3;
                                }
                                ?>
                                <tr height="25" bgcolor="#7f7085">
                                    <td rowspan="8">Kelas 4</td>
                                    <td><?PHP echo $lev4_1_min_periode." - ".$lev4_1_max_periode; ?></td>
                                    <td><input type="text" size="10" name="4-per1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-2) < 10) {
                                    $lev4_2_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-2);
                                } else {
                                    $lev4_2_min_periode	= 	substr($_GET["periode"],-9,2)-2;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-2) < 10) {
                                    $lev4_2_max_periode	=	"0".(substr($_GET["periode"],-2,2)-2);
                                } else {
                                    $lev4_2_max_periode	=	substr($_GET["periode"],-2,2)-2;
                                }
                                ?>
                                <tr height="25" bgcolor="#7f7085">
                                    <td><?PHP echo $lev4_2_min_periode." - ".$lev4_2_max_periode; ?></td>
                                    <td><input type="text" size="10" name="4-per2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-1) < 10) {
                                    $lev4_3_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-1);
                                } else {
                                    $lev4_3_min_periode	= 	substr($_GET["periode"],-9,2)-1;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-1) < 10) {
                                    $lev4_3_max_periode	=	"0".(substr($_GET["periode"],-2,2)-1);
                                } else {
                                    $lev4_3_max_periode	=	substr($_GET["periode"],-2,2)-1;
                                }
                                ?>
                                <tr height="25" bgcolor="#7f7085">
                                    <td><?PHP echo $lev4_3_min_periode." - ".$lev4_3_max_periode; ?></td>
                                    <td><input type="text" size="10" name="4-per3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                $lev4_4_min_periode	= 	substr($_GET["periode"],-9,2);
                                $lev4_4_max_periode	=	substr($_GET["periode"],-2,2);
                                ?>
                                <tr height="25" bgcolor="#7f7085">
                                    <td><?PHP echo $lev4_4_min_periode." - ".$lev4_4_max_periode; ?></td>
                                    <td><input type="text" size="10" name="4-per4-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per4-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-per4-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#7f7085">
                                    <td>kategori 1</td>
                                    <td><input type="text" size="10" name="4-angu-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-angu-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-angu-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#7f7085">
                                    <td>Kategori 2</td>
                                    <td><input type="text" size="10" name="4-dis1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-dis1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-dis1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#7f7085">
                                    <td>Kategori 3</td>
                                    <td><input type="text" size="10" name="4-dis2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-dis2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-dis2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#7f7085">
                                    <td>Kategori 4</td>
                                    <td><input type="text" size="10" name="4-dis3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-dis3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="4-dis3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                /////////////////////////////////////////
                                ///////////////kelas 5///////////////////
                                /////////////////////////////////////////
                                
                                
                                if((substr($_GET["periode"],-9,2)-4) < 10) {
                                    $lev5_1_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-4);
                                } else {
                                    $lev5_1_min_periode	= 	substr($_GET["periode"],-9,2)-4;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-4) < 10) {
                                    $lev5_1_max_periode	=	"0".(substr($_GET["periode"],-2,2)-4);
                                } else {
                                    $lev5_1_max_periode	=	substr($_GET["periode"],-2,2)-4;
                                }
                                ?>
                                <tr height="25" bgcolor="#58778a">
                                    <td rowspan="9">Kelas 5</td>
                                    <td><?PHP echo $lev5_1_min_periode." - ".$lev5_1_max_periode; ?></td>
                                    <td><input type="text" size="10" name="5-per1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-3) < 10) {
                                    $lev5_2_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-3);
                                } else {
                                    $lev5_2_min_periode	= 	substr($_GET["periode"],-9,2)-3;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-3) < 10) {
                                    $lev5_2_max_periode	=	"0".(substr($_GET["periode"],-2,2)-3);
                                } else {
                                    $lev5_2_max_periode	=	substr($_GET["periode"],-2,2)-3;
                                }
                                ?>
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_2_min_periode." - ".$lev5_2_max_periode; ?></td>
                                    <td><input type="text" size="10" name="5-per2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-2) < 10) {
                                    $lev5_3_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-2);
                                } else {
                                    $lev5_3_min_periode	= 	substr($_GET["periode"],-9,2)-2;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-2) < 10) {
                                    $lev5_3_max_periode	=	"0".(substr($_GET["periode"],-2,2)-2);
                                } else {
                                    $lev5_3_max_periode	=	substr($_GET["periode"],-2,2)-2;
                                }
                                ?>
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_3_min_periode." - ".$lev5_3_max_periode; ?></td>
                                    <td><input type="text" size="10" name="5-per3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-1) < 10) {
                                    $lev5_2_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-1);
                                } else {
                                    $lev5_2_min_periode	= 	substr($_GET["periode"],-9,2)-1;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-1) < 10) {
                                    $lev5_2_max_periode	=	"0".(substr($_GET["periode"],-2,2)-1);
                                } else {
                                    $lev5_2_max_periode	=	substr($_GET["periode"],-2,2)-1;
                                }
                                ?>
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_2_min_periode." - ".$lev5_2_max_periode; ?></td>
                                    <td><input type="text" size="10" name="5-per4-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per4-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per4-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                $lev5_5_min_periode	= 	substr($_GET["periode"],-9,2);
                                $lev5_5_max_periode	=	substr($_GET["periode"],-2,2);
                                ?>
                                <tr height="25" bgcolor="#58778a">
                                    <td><?PHP echo $lev5_5_min_periode." - ".$lev5_5_max_periode; ?></td>
                                    <td><input type="text" size="10" name="5-per5-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per5-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-per5-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#58778a">
                                    <td>kategori 1</td>
                                    <td><input type="text" size="10" name="5-angu-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-angu-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-angu-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#58778a">
                                    <td>Kategori 2</td>
                                    <td><input type="text" size="10" name="5-dis1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-dis1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-dis1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#58778a">
                                    <td>Kategori 3</td>
                                    <td><input type="text" size="10" name="5-dis2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-dis2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-dis2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#58778a">
                                    <td>Kategori 4</td>
                                    <td><input type="text" size="10" name="5-dis3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-dis3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="5-dis3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                /////////////////////////////////////////
                                ///////////////kelas 6///////////////////
                                /////////////////////////////////////////
                                
                                
                                if((substr($_GET["periode"],-9,2)-5) < 10) {
                                    $lev6_1_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-5);
                                } else {
                                    $lev6_1_min_periode	= 	substr($_GET["periode"],-9,2)-5;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-5) < 10) {
                                    $lev6_1_max_periode	=	"0".(substr($_GET["periode"],-2,2)-5);
                                } else {
                                    $lev6_1_max_periode	=	substr($_GET["periode"],-2,2)-5;
                                }
                                ?>
                                <tr height="25" bgcolor="#668285">
                                    <td rowspan="10">Kelas 6</td>
                                    <td><?PHP echo $lev6_1_min_periode." - ".$lev6_1_max_periode; ?></td>
                                    <td><input type="text" size="10" name="6-per1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-4) < 10) {
                                    $lev6_2_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-4);
                                } else {
                                    $lev6_2_min_periode	= 	substr($_GET["periode"],-9,2)-4;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-4) < 10) {
                                    $lev6_2_max_periode	=	"0".(substr($_GET["periode"],-2,2)-4);
                                } else {
                                    $lev6_2_max_periode	=	substr($_GET["periode"],-2,2)-4;
                                }
                                ?>
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_2_min_periode." - ".$lev6_2_max_periode; ?></td>
                                    <td><input type="text" size="10" name="6-per2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-3) < 10) {
                                    $lev6_3_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-3);
                                } else {
                                    $lev6_3_min_periode	= 	substr($_GET["periode"],-9,2)-3;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-3) < 10) {
                                    $lev6_3_max_periode	=	"0".(substr($_GET["periode"],-2,2)-3);
                                } else {
                                    $lev6_3_max_periode	=	substr($_GET["periode"],-2,2)-3;
                                }
                                ?>
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_3_min_periode." - ".$lev6_3_max_periode; ?></td>
                                    <td><input type="text" size="10" name="6-per3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-2) < 10) {
                                    $lev6_4_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-2);
                                } else {
                                    $lev6_4_min_periode	= 	substr($_GET["periode"],-9,2)-2;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-2) < 10) {
                                    $lev6_4_max_periode	=	"0".(substr($_GET["periode"],-2,2)-2);
                                } else {
                                    $lev6_4_max_periode	=	substr($_GET["periode"],-2,2)-2;
                                }
                                ?>
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_4_min_periode." - ".$lev6_4_max_periode; ?></td>
                                    <td><input type="text" size="10" name="6-per4-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per4-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per4-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                if((substr($_GET["periode"],-9,2)-1) < 10) {
                                    $lev6_5_min_periode	= 	"0".(substr($_GET["periode"],-9,2)-1);
                                } else {
                                    $lev6_5_min_periode	= 	substr($_GET["periode"],-9,2)-1;
                                }
                                
                                if((substr($_GET["periode"],-2,2)-1) < 10) {
                                    $lev6_5_max_periode	=	"0".(substr($_GET["periode"],-2,2)-1);
                                } else {
                                    $lev6_5_max_periode	=	substr($_GET["periode"],-2,2)-1;
                                }
                                ?>
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_5_min_periode." - ".$lev6_5_max_periode; ?></td>
                                    <td><input type="text" size="10" name="6-per5-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per5-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per5-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <?PHP
                                $lev6_6_min_periode	= 	substr($_GET["periode"],-9,2);
                                $lev6_6_max_periode	=	substr($_GET["periode"],-2,2);
                                ?>
                                <tr height="25" bgcolor="#668285">
                                    <td><?PHP echo $lev6_6_min_periode." - ".$lev6_6_max_periode; ?></td>
                                    <td><input type="text" size="10" name="6-per6-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per6-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-per6-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#668285">
                                    <td>kategori 1</td>
                                    <td><input type="text" size="10" name="6-angu-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-angu-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-angu-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#668285">
                                    <td>Kategori 2</td>
                                    <td><input type="text" size="10" name="6-dis1-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-dis1-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-dis1-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#668285">
                                    <td>Kategori 3</td>
                                    <td><input type="text" size="10" name="6-dis2-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-dis2-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-dis2-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                <tr height="25" bgcolor="#668285">
                                    <td>Kategori 4</td>
                                    <td><input type="text" size="10" name="6-dis3-spp" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-dis3-ict" onkeypress="return checkIt(event)"/></td>
                                    <td><input type="text" size="10" name="6-dis3-add" onkeypress="return checkIt(event)"/></td>
                                </tr>
                                
						<?PHP
                            }						
                        ?>
                                <tr height="60" bgcolor="#333333">
                                    <td colspan="5" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpan nilai SPP" onClick="return verification()"/> <input type="reset" value="Reset" /></td>
                                </tr>
                    <?PHP
                    	}						
                	}
                    ?>
                </table>
            </td>
            <td width="30"></td>
        </tr>
        <tr>
        	<td colspan="3" height="20"></td>
        </tr>
    </table>
    </form>
    <!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
    <?PHP
    //Load all spp data////////////
    ////////////////////////////////
    ////////////////////////////////
    
    //check whether the expected page empty or not, if it is, give it values as 0
    //variable p defines from which page, the query has to begin			
    //why 0? because we have to start the page from beginning.
    //why minus one --> because we have to count it from previous page + 1 record
    //So, when we put -1, we will get previous page, 
    //and 'the 1' record will be added on $the_limit
    //confuse???? so am i. hahahahahahaha :))			
    $src_limit = (!isset($_GET["p"])) ? "0" : htmlspecialchars($_GET["p"] - 1);
    
    //hey jude, how many record that you wanna show us in this page, buddy?
    $show_per_page = 5;
    
    //So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
    //Dont forget that the limit start from 0. 0 is the first record.
    $the_limit 	= ($src_limit * $show_per_page);
    
    //weleh-weleh, take a look at this query.....
    //$the_limit       = defines where should the query begin from
    //$show_per_page   = defines how many record should be shown
	$src_j	= mysql_real_escape_string($src_j);
    $src_load_spp		= "select distinct periode,jenjang from set_spp where jenjang = '$src_j' order by periode limit $the_limit,$show_per_page ";
    
    //but also, we need to select all record. it will be used to define the paging list.	
    $src_load_spp_all	= "select distinct periode from set_spp where jenjang = '$src_j'";
    
    $query_load_spp		=  mysqli_query($mysql_connect, $src_load_spp) or die("There is an error with mysql: ".mysql_error());
    $query_load_spp_all	=  mysqli_query($mysql_connect, $src_load_spp_all) or die("There is an error with mysql: ".mysql_error());
    
    //Hey, how many record do we have..?????
    $num_load_spp_all		= mysql_num_rows($query_load_spp_all);
    
    if($num_load_spp_all != 0) {
    ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="30"></td>
            <td height="10"></td>
            <td width="30"></td>
        </tr>
        <tr>
            <td></td>
            <td align="left">
                
                <!--========================== user registration form =========================-->
                <?PHP
                $p = (!isset($_GET["p"])) ? "1" : htmlspecialchars($_GET["p"]);
                
                $all_page = ceil($num_load_spp_all/$show_per_page);				
                ?>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">            	
                    <tr height="40">
                        <td colspan="3"><hr noshade="noshade" size="1" color="#999999" /></td>
                    </tr>
                    <tr>
                    	<td colspan="3" align="left" id="text_title_index1">Daftar Setting SPP untuk Jenjang <?PHP echo $title_page; ?></td>
                    </tr>
                    <tr>
                    	<td colspan="3" height="15"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td id="text_normal_black">halaman: 
                        <?PHP 
                        for($i = 1; $i <= $all_page; $i++) {
                            if($i == $p) {
                                echo "<span id='paging'>".$i." </span>";
                            } else {
                                echo "<span id='paging'><a href=\"?pl=spp_sd_setting&p=$i\" >$i</a></span> ";
                            }
                        }
                        ?>
                        </td>
                        <td></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr id="text_normal_white_bold" bgcolor="#666666" height="30">
                        <td width="10"></td>
                        <td width="40">No</td>
                        <td width="10"></td>
                        <td width="150">Tahun pelajaran</td>
                        <td width="10"></td>
                        <td width="100">Jenjang</td>
                        <td width="10"></td>
                        <td>Modifikasi</td>
                        <td width="10"></td>
                    </tr>
                <?PHP
                //$bg used to generate zebra background.
                $bg	="#beb8a9";			
                //this is for number, you know...
                $no	= $the_limit + 1;
                while($row_load_spp = mysql_fetch_array($query_load_spp)) {			
                ?>
                    <tr height="30" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black">
                        <td></td>
                        <td><?PHP echo $no++; ?></td>
                        <td></td>
                        <td><?PHP echo $row_load_spp["periode"]; ?></td>
                        <td></td>
                        <td><?PHP echo $row_load_spp["jenjang"]; ?></td>
                        <td></td>
                        <td><a href="mainpage.php?pl=spp_edit&per=<?PHP echo $row_load_spp["periode"]; ?>&j=<?PHP echo $row_load_spp["jenjang"]; ?>"><img src="images/icon_edit.png" border="0" title="Edit data" /></a>&nbsp;&nbsp;<a href="mainpage.php?pl=spp_sd_delete&per=<?PHP echo $row_load_spp["periode"]; ?>&lev=<?PHP echo $row_load_spp["jenjang"]; ?>"><img src="images/icon_delete.png" border="0" title="Delete data"/></a></td>
                        <td></td>
                    </tr>	
                <?PHP
                    //this is the other part of zebra background generator
                    //if background of the first row is xxxxxx, so you have to change it to #yyyyyy in the next row 
                    if($bg	== "#beb8a9") {
                        $bg	= "#ffffff";
                    }
                    else {
                        $bg	= "#beb8a9";
                    }
                }	
                ?>
                </table>            
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr height="35">
                        <td width="200" id="text_normal_black" colspan="4"></td>
                    </tr>
                </table>
            </td>
            <td></td>
        </tr>
        <tr>        
            <td colspan="3"></td>
        </tr>
    </table>

<?PHP
	}
}
?>
<!-- sandy said: form verification start form here buddy...:)-->
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