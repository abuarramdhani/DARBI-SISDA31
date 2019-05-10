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
            <td id="text_title_page1" align="center"><h2 style="padding:0px;">--- TODDLER ---</h2>Pengaturan Nominal SPP, ICT dan pembayaran lainnya per periode</td>
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
    <form method="post" name="set_spp" action="engine.php?case=spp_toddler_setting">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td>
                <table width="100%" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="5">Tahun pelajaran: <?PHP include"include/period_refr_page_toddler.php"; ?><input type="hidden" name="level" value="toddler" /><input type="hidden" name="src_period" value="<?PHP echo substr($_GET["period"],-11,11); ?>" /></td>
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
					if(empty($_GET["period"])) {
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
					$lev1_1_min_period	= 	substr($_GET["period"],-9,2);
					$lev1_1_max_period	=	substr($_GET["period"],-2,2);				
					?>                    
                    <tr height="25" bgcolor="#83736c">
                        <td rowspan="5">Kelas 1</td>
                        <td><?PHP echo $lev1_1_min_period." - ".$lev1_1_max_period; ?></td>
                        <td><input type="text" size="10" name="1-per1-spp" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-per1-ict" onkeypress="return checkIt(event)"/></td>
                        <td><input type="text" size="10" name="1-per1-add" onkeypress="return checkIt(event)"/></td>
                    </tr>
                    <tr height="25" bgcolor="#83736c">
                        <td>Kategori 1</td>
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
                    <tr height="60" bgcolor="#333333">
                        <td colspan="5" align="center"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpai nilai SPP" onClick="return verification()"/> <input type="reset" value="Reset" /></td>
                    </tr>
                    <?PHP
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
    $show_per_page = 10;
    
    //So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
    //Dont forget that the limit start from 0. 0 is the first record.
    $the_limit 	= ($src_limit * $show_per_page);
    
    //weleh-weleh, take a look at this query.....
    //$the_limit       = defines where should the query begin from
    //$show_per_page   = defines how many record should be shown
    $src_load_spp		= "select distinct periode,level from set_spp where level = 'toddler' order by periode limit $the_limit,$show_per_page ";
    
    //but also, we need to select all record. it will be used to define the paging list.
    $src_load_spp_all	= "select distinct periode,level from set_spp where level = 'toddler'";
    
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
                    	<td colspan="3" align="left" id="text_title_index1">Daftar Setting SPP untuk level TODDLER</td>
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
                                echo "<span id='paging'><a href=\"?pl=setting_spp_toddler&p=$i\" >$i</a></span> ";
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
                        <td><?PHP echo $row_load_spp["level"]; ?></td>
                        <td></td>
                        <td><a href="mainpage.php?pl=spp_toddler_edit&per=<?PHP echo $row_load_spp["periode"]; ?>&lev=<?PHP echo $row_load_spp["level"]; ?>"><img src="images/icon_edit.png" border="0" title="Edit data" /></a>&nbsp;&nbsp;<a href="mainpage.php?pl=spp_toddler_delete&per=<?PHP echo $row_load_spp["periode"]; ?>&lev=<?PHP echo $row_load_spp["level"]; ?>"><img src="images/icon_delete.png" border="0" title="Delete data"/></a></td>
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