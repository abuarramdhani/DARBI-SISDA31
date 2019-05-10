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
    <form method="post" name="set_spp" action="engine.php?case=set_spp">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="5">Tahun pelajaran: <?PHP include"include/period.php"; ?><input type="hidden" name="level" value="sd" /></td>
                    </tr>
                    <tr height="25" bgcolor="#333333" id="text_normal_white">
                        <td>Jenjang</td>
                        <td>Keterangan</td>
                        <td>SPP</td>
                        <td>ICT</td>
                        <td>Komite sekolah</td>
                    </tr>
                    <!-- |||||| -->
                    <tr height="25" bgcolor="#83736c">
                        <td rowspan="5">Kelas 1</td>
                        <td>11-12</td>
                        <td><input type="text" size="10" name="1-1112-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-1112-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-1112-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>Anak guru</td>
                        <td><input type="text" size="10" name="1-angu-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-angu-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-angu-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>Discount khusus 1</td>
                        <td><input type="text" size="10" name="1-dis1-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis1-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis1-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>Discount khusus 2</td>
                        <td><input type="text" size="10" name="1-dis2-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis2-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis2-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>Discount khusus 3</td>
                        <td><input type="text" size="10" name="1-dis3-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis3-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-dis3-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <!-- |||||| -->
                    <tr height="25" bgcolor="#8a6c66">
                        <td rowspan="5">Kelas 2</td>
                        <td>10-11</td>
                        <td><input type="text" size="10" name="2-1011-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-1011-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-1011-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>Anak guru</td>
                        <td><input type="text" size="10" name="2-angu-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-angu-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-angu-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>Discount khusus 1</td>
                        <td><input type="text" size="10" name="2-dis1-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis1-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis1-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>Discount khusus 2</td>
                        <td><input type="text" size="10" name="2-dis2-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis2-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis2-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8a6c66">
                        <td>Discount khusus 3</td>
                        <td><input type="text" size="10" name="2-dis3-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis3-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="2-dis3-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <!-- |||||| -->
                    <tr height="25" bgcolor="#8d6774">
                        <td rowspan="6">Kelas 3</td>
                        <td>09-10</td>
                        <td><input type="text" size="10" name="3-0910-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-0910-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-0910-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>10-11</td>
                        <td><input type="text" size="10" name="3-1011-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-1011-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-1011-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>Anak guru</td>
                        <td><input type="text" size="10" name="3-angu-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-angu-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-angu-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>Discount khusus 1</td>
                        <td><input type="text" size="10" name="3-dis1-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis1-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis1-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>Discount khusus 2</td>
                        <td><input type="text" size="10" name="3-dis2-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis2-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis2-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#8d6774">
                        <td>Discount khusus 3</td>
                        <td><input type="text" size="10" name="3-dis3-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis3-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="3-dis3-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <!-- |||||| -->
                    <tr height="25" bgcolor="#7f7085">
                        <td rowspan="7">Kelas 4</td>
                        <td>08-09</td>
                        <td><input type="text" size="10" name="4-0809-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-0809-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-0809-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>09-10</td>
                        <td><input type="text" size="10" name="4-0910-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-0910-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-0910-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>10-11</td>
                        <td><input type="text" size="10" name="4-1011-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-1011-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-1011-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>Anak guru</td>
                        <td><input type="text" size="10" name="4-angu-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-angu-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-angu-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>Discount khusus 1</td>
                        <td><input type="text" size="10" name="4-dis1-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis1-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis1-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>Discount khusus 2</td>
                        <td><input type="text" size="10" name="4-dis2-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis2-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis2-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#7f7085">
                        <td>Discount khusus 3</td>
                        <td><input type="text" size="10" name="4-dis3-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis3-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="4-dis3-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <!-- |||||| -->
                    <tr height="25" bgcolor="#58778a">
                        <td rowspan="7">Kelas 5</td>
                        <td>07-08</td>
                        <td><input type="text" size="10" name="5-0708-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-0708-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-0708-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>08-09</td>
                        <td><input type="text" size="10" name="5-0809-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-0809-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-0809-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>09-10</td>
                        <td><input type="text" size="10" name="5-0910-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-0910-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-0910-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>Anak guru</td>
                        <td><input type="text" size="10" name="5-angu-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-angu-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-angu-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>Discount khusus 1</td>
                        <td><input type="text" size="10" name="5-dis1-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis1-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis1-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>Discount khusus 2</td>
                        <td><input type="text" size="10" name="5-dis2-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis2-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis2-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#58778a">
                        <td>Discount khusus 3</td>
                        <td><input type="text" size="10" name="5-dis3-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis3-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="5-dis3-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <!-- |||||| -->
                    <tr height="25" bgcolor="#668285">
                        <td rowspan="8">Kelas 6</td>
                        <td>06-07</td>
                        <td><input type="text" size="10" name="6-0607-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0607-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0607-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>07-08</td>
                        <td><input type="text" size="10" name="6-0708-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0708-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0708-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>08-09</td>
                        <td><input type="text" size="10" name="6-0809-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0809-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0809-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>09-10</td>
                        <td><input type="text" size="10" name="6-0910-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0910-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-0910-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>Anak guru</td>
                        <td><input type="text" size="10" name="6-angu-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-angu-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-angu-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>Discount khusus 1</td>
                        <td><input type="text" size="10" name="6-dis1-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis1-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis1-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>Discount khusus 2</td>
                        <td><input type="text" size="10" name="6-dis2-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis2-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis2-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#668285">
                        <td>Discount khusus 3</td>
                        <td><input type="text" size="10" name="6-dis3-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis3-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="6-dis3-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="60" bgcolor="#333333">
                        <td colspan="5" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpai nilai SPP" onClick="return verification()"/> <input type="reset" value="Reset" /></td>
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
    $show_per_page = 10;
    
    //So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
    //Dont forget that the limit start from 0. 0 is the first record.
    $the_limit 	= ($src_limit * $show_per_page);
    
    //weleh-weleh, take a look at this query.....
    //$the_limit       = defines where should the query begin from
    //$show_per_page   = defines how many record should be shown
    $src_load_spp		= "select * from set_spp order by periode, jenjang, ket_disc limit $the_limit,$show_per_page ";
    
    //but also, we need to select all record. it will be used to define the paging list.
    $src_load_spp_all	= "select * from set_spp";
    
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
            <td>
                
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
                        <td></td>
                        <td>
                        <?PHP 
                        for($i = 1; $i <= $all_page; $i++) {
                            if($i == $p) {
                                echo "<span id='paging'>".$i." </span>";
                            } else {
                                echo "<span id='paging'><a href=\"?pl=setting_spp&p=$i\" >$i</a></span> ";
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
                        <td>No</td>
                        <td width="10"></td>
                        <td>Tahun pelajaran</td>
                        <td width="10"></td>
                        <td>Jenjang</td>
                        <td width="10"></td>
                        <td>Keterangan discount</td>
                        <td width="10"></td>                    
                        <td>SPP</td>
                        <td width="10"></td>
                        <td>ICT</td>
                        <td width="10"></td>
                        <td>PTA</td>
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
                        <td><?PHP echo $row_load_spp["ket_disc"]; ?></td>                    
                        <td></td>
                        <td><?PHP echo $row_load_spp["spp"]; ?></td>
                        <td></td>
                        <td><?PHP echo $row_load_spp["ict"]; ?></td>
                        <td></td>
                        <td><?PHP echo $row_load_spp["pta"]; ?></td>
                        <td></td>
                        <td><a href="mainpage.php?pl=edit_setting_spp&id=<?PHP echo $row_load_spp["id"]; ?>"><img src="images/icon_edit.png" border="0" title="Edit data" /></a>&nbsp;&nbsp;<a href="mainpage.php?pl=delete_setting_spp&id=<?PHP echo $row_load_spp["id"]; ?>"><img src="images/icon_delete.png" border="0" title="Delete data"/></a></td>
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