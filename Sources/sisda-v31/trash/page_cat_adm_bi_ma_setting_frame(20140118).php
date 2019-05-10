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
            <td id="text_title_page1" align="center"><h2 style="padding:0px;">Kategori Administrasi Biaya Masuk</td>
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
    <form method="post" name="set_cat_adm_bi_ma" action="engine.php?case=cat_adm_bi_ma_setting">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" >
        <tr>
            <td width="30"></td>
            <td align="center">
                <table width="970" border="1" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr height="25" bgcolor="#333333">
                        <td colspan="10">Tahun pelajaran: <?PHP include"include/periode_next_year.php"; ?></td>
                    </tr>
                    <tr>
                    	<td height="50" bgcolor="#333333">Kategori Administrasi</td>
                        <td rowspan="29" valign="top">
                        <div style="border:0px solid black;width:750px;overflow-y:hidden;overflow-x:scroll; margin:0px;">
                        <p style="width:250%; margin:0px;">
                        <?PHP //<iframe allowtransparency="1" style="overflow-x:scroll;" marginheight="0" marginwidth="0" frameborder="0" width="720" height="102%" src="page/page_cat_adm_bi_ma_setting_getframe.php"></iframe> ?>
                        <?PHP include("page_cat_adm_bi_ma_setting_getframe.php"); ?>
                        </p>
                        </div>
                        </td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Bersamaan dengan saudara kandung</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Memiliki Saudara Kandung</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum memiliki Saudara Kandung + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#7b8a74" id="text_normal_white">
                        <td>Umum bersamaan dengan Saudara Kandung + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi</td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#718b88" id="text_normal_white">
                        <td>Asal Darbi + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1 + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-1 + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2 + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-2 + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst + Grade A</td>
                    </tr>
                    <tr height="45" bgcolor="#617f90" id="text_normal_white">
                        <td>Anak Pegawai ke-3, dst + Grade B</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke toddler semester II</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                    	<td>Siswa pindahan ke PG/TK A/TK B semester II</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke SD 3-4</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke SD 5-6</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke smp 8</td>
                    </tr>
                    <tr height="45" bgcolor="#87778a" id="text_normal_white">
                        <td>Siswa pindahan ke smp 9</td>
                    </tr>
                    <tr height="45" bgcolor="#8a6c66" id="text_normal_white">
                        <td>Daftar ulang siswa TK A</td>
                    </tr>
                    <tr height="45" bgcolor="#8a6c66" id="text_normal_white">
                        <td>Daftar ulang siswa TK B</td>
                    </tr>
                    <tr>
                    	<td height="45">&nbsp;</td>
                    </tr>
                </table>                
                <table width="100%"border="0" cellpadding="0" cellspacing="0" id="text_normal_white" style="text-align:center;">
                    <tr>
                        <td width="315"></td>
                        <td colspan="20" align="left"><input style="background:#006699; color:#FFFFFF; width:200px; height:45px;" type="submit" value="Simpan Kategori Administrasi" onClick="return verification()"/> <input type="reset" value="Reset" /></td>
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
    $show_per_page = 5;
    
    //So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
    //Dont forget that the limit start from 0. 0 is the first record.
    $the_limit 	= ($src_limit * $show_per_page);
    
    //weleh-weleh, take a look at this query.....
    //$the_limit       = defines where should the query begin from
    //$show_per_page   = defines how many record should be shown
    $src_load_spp		= "select distinct periode from set_cat_adm_bi_ma order by periode limit $the_limit,$show_per_page";
    
    //but also, we need to select all record. it will be used to define the paging list.
    $src_load_spp_all	= "select distinct periode from set_cat_adm_bi_ma";
    
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
                    	<td colspan="3" align="left" id="text_title_index1">Daftar Setting Kategori Administrasi Biaya Masuk</td>
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
                                echo "<span id='paging'><a href=\"?pl=cat_adm_bi_ma_setting&p=$i\" >$i</a></span> ";
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
                        <td><a href="mainpage.php?pl=cat_adm_bi_ma_edit&per=<?PHP echo $row_load_spp["periode"]; ?>"><img src="images/icon_edit.png" border="0" title="Edit data" /></a>&nbsp;&nbsp;<a href="mainpage.php?pl=cat_adm_bi_ma_delete&per=<?PHP echo $row_load_spp["periode"]; ?>"><img src="images/icon_delete.png" border="0" title="Delete data"/></a></td>
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
	if(document.set_cat_adm_bi_ma.periode.value == "")
	{
		alert('Anda harus memilih Tahun Pelajaran untuk melengkapi form administrasi biaya masuk');
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