<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="25">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">Data Primer Siswa</td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td></td>
    	<td align="center">
        	<?PHP
			//Load all user data////////////
			////////////////////////////////
			////////////////////////////////
			$v_get  = (empty($_GET["v"])) ? false : true;
			$v_post = (empty($_POST["v"])) ? false : true; 
			
			if(!empty($v_get)) {
			
			//And is the POST is not empty, send it via GET method
			$srch_no_sisda		= (empty($_GET['s'])) ? '' : $_GET['s'];
			$srch_jenjang		= (empty($_GET['j'])) ? '' : $_GET['j'];
			$srch_nama_siswa	= (empty($_GET['n'])) ? '' : $_GET['n'];
			$srch_periode		= (empty($_GET['period'])) ? '' : $_GET['period'];
			
			} else if (!empty($v_post)) {
			
			//let's define whether these variables empty or not (in POST method)
			$srch_no_sisda 		= (empty($_POST['s'])) ? '' : $_POST['s'];
			$srch_jenjang 		= (empty($_POST['j'])) ? '' : $_POST['j'];
			$srch_nama_siswa 	= (empty($_POST['n'])) ? '' : $_POST['n'];
			$srch_periode 		= (empty($_POST['period'])) ? '' : $_POST['period'];
			
			} else {
				
				$srch_no_sisda 		= "";
				$srch_jenjang		= "";
				$srch_nama_siswa	= "";
				$srch_periode		= "";
				
			}
			
			if($v_post == true || $v_get == true) {
			
				$v_show	= "&v=1";
				
			} else {
				
				$v_show	="";
			}
			
			//check whether the expected page empty or not, if it is, give it values as 0
			//variable p defines from which page, the query has to begin			
			//why 0? because we have to start the page from beginning.
			//why minus one --> because we have to count it from previous page + 1 record
			//So, when we put -1, we will get previous page, 
			//and 'the 1' record will be added on $the_limit
			//confuse???? so am i. hahahahahahaha :))			
			$src_limit = (!isset($_GET["p"])) ? "0" : htmlspecialchars($_GET["p"] - 1);
			
			//hey jude, how many record that you wanna show us in this page, buddy?
			$show_per_page = 50;
			
			//So, the record starts from n1 like 1 or 11 or 21 or 31 or or or, depends on $show_per_page 
			//But you have to know, that the "limit" in mysql query is start with 0 not 1, based on MySQL 5.5 Reference manual.. 
			//Hahahahahahahahahahaha kamal doent know about it. He argues me strongly, that it starts from 1...hahahahaha. For this case, dont believe him, just believe me and the manual
			//And so so so, when $the_limit value is 0, the query will return row beginned from first record (number 1)
			//when $the_limit value is 10, the query will return row beginned from eleventh record (number 11)
			//when $the_limit value is 20, the query will return row beginned from eleventh record (number 21)
			$the_limit 	= ($src_limit * $show_per_page);
			
			//weleh-weleh, take a look at this query.....
			//$the_limit       = defines where should the query begin from
			//$show_per_page   = defines how many record should be shown
			$src_get_siswa		= "select no_sisda, jenjang, nama_siswa, periode from siswa_finance where no_sisda like '%$srch_no_sisda%' and jenjang like '%$srch_jenjang%' and nama_siswa like '%$srch_nama_siswa%' and periode like '%$srch_periode%' limit $the_limit,$show_per_page"; 
			
			//but also, we need to select all record. it will be used to define the paging list.
			$src_get_siswa_all	= "select no_sisda, jenjang, nama_siswa, periode from siswa_finance where no_sisda like '%$srch_no_sisda%' and jenjang like '%$srch_jenjang%' and nama_siswa like '%$srch_nama_siswa%' and periode like '%$srch_periode%'"; 
			
			$query_get_siswa		=  mysqli_query($mysql_connect, $src_get_siswa) or die("There is an error with mysql: ".mysql_error());
			$query_get_siswa_all	=  mysqli_query($mysql_connect, $src_get_siswa_all) or die("There is an error with mysql: ".mysql_error());
			
			//Hey, how many record do we have..?????
			$num_get_siswa_all		= mysql_num_rows($query_get_siswa_all);
			?>
            <!--========================== user registration form =========================-->
            <?PHP
			$p = (!isset($_GET["p"])) ? "1" : htmlspecialchars($_GET["p"]);
			
			$all_page = ceil($num_get_siswa_all/$show_per_page);
			?>
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <form name="search" method="post" action="?pl=preview_adm_siswa">
            	<input type="hidden" name="v" value="1" />
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td align="left" width="100" id="text_normal_black">No Sisda</td>
                    <td width="20"></td>
                    <td><input type="text" name="s" size="25" /></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Nama siswa</td>
                    <td width="20"></td>
                    <td><input type="text" name="n" size="25" /></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Jenjang</td>
                    <td width="20"></td>
                    <td>
                    <select name="j">
                    <option value="">Pilih</option>
                    <option value="Toddler">Toddler</option>
                    <option value="PG">PG</option>
                    <option value="TK A">TK A</option>
                    <option value="TK B">TK B</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black">Periode</td>
                    <td width="20"></td>
                    <td><?PHP include("include/periode.php"); ?></td>
                </tr>
                <tr>
                    <td align="left" id="text_normal_black"></td>
                    <td width="20"></td>
                    <td><input type="submit" value="Cari siswa" style="width:200px; height:40px;" /></td>
                </tr>
                <tr>
                    <td height="10" colspan="3"><hr noshade="noshade" color="#666666" size="1" /></td>
                </tr>
            </table>
            </form>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr height="20">
                	<td id="text_normal_black">Ditemukan: <b><?PHP echo $num_get_siswa_all; ?> data</b></td>
                </tr>
            	<tr height="20">
                    <td><span id="text_normal_black">Halaman: </span> 
                    <?PHP 
					for($i = 1; $i <= $all_page; $i++) {
						if($i == $p) {
							echo "<span id='paging'>".$i." </span>";
						} else {
							echo "<span id='paging'><a href=\"?pl=preview_adm_siswa&p=$i$v_show&s=$srch_no_sisda&j=$srch_jenjang&n=$srch_nama_siswa&periode=$srch_periode\" >$i</a></span> ";
						}
					}
					?>
                    </td>
                </tr>
            </table>
			<form method="post" name="reg_adm_siswa" action="mainpage.php?pl=reg_adm_siswa_redirect">             
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="13" height="5"></td>
                </tr>
            	<tr height="30">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="40" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No Sisda</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Nama siswa</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jenjang</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Periode</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Action</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                <?PHP
				//$bg used to generate zebra background.
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$row_number	= $the_limit + 1;
				
				while($get_siswa = mysql_fetch_array($query_get_siswa)) {
				?>
                <tr height="30">                	
                	<td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="40" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP /*The number of record will be similar with $the_limit*/echo $row_number++; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["no_sisda"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP echo $get_siswa["nama_siswa"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["jenjang"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP echo $get_siswa["periode"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><input type="button" value="Lihat / Update data siswa" onclick="window.location.href='?pl=update_adm_siswa&no=<?PHP echo $get_siswa["no_sisda"];  ?>&p=<?PHP echo $p; ?>';" /></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                </tr>
                <?PHP
					if($bg	== "#ffffff") {
						$bg	= "#f1f1f1";
					}
					else {
						$bg	= "#ffffff";
					}
				}
				?>
                <tr>
                	<td colspan="11" height="30"></td>
                </tr>
             </table>
           </form>
         </td>
         <td></td>
     </tr>
</table>
<?PHP
} else {	
	
	header("location:index.php");
		
}
?>