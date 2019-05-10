<?PHP
//The system need to know whether user already login or not.
//And yes you do, if you are the admin, you may access this page. Otherwise, let the page blank
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	//We need to know what page is this (including their GET variable in URL
	//We'll send it to prod page.
	include "include/url.php";
	$url = curPageURL();
	
	if(!empty($_POST["manage_kelas"])) {
	
		$src_kelas	= htmlspecialchars($_POST["manage_kelas"]);
		$kelas		= substr($src_kelas,14);
		$periode	= substr($src_kelas,1,11);
		$ada		= true;
		
	} else if (!empty($_GET["manage_kelas"])) {
	
		$kelas		= htmlspecialchars($_GET["kls"]);
		$periode	= htmlspecialchars($_GET["th"]);
		$ada		= true;
	
	} else {
	
		$kelas		= "";
		$periode	= htmlspecialchars($_GET["th"]);;
		$ada		= false;
	
	}
	
	$cur_month	= strtolower(date("F"));
	$cur_year	= date("Y");
	
	if($cur_month == "january" || $cur_month == "february" || $cur_month == "march" || $cur_month == "april" || $cur_month == "may" || $cur_month == "june") {	

		$edu_year0	= ($cur_year-2)." - ".($cur_year-1);	
		$edu_year1	= ($cur_year-1)." - ".($cur_year);		
		$edu_year2	= ($cur_year)." - ".($cur_year+1);
			
		$show0	= ($cur_year-2)." - ".($cur_year-1)." ke ".($cur_year-1)." - ".($cur_year);	
		$show1	= ($cur_year-1)." - ".($cur_year)." ke ".($cur_year)." - ".($cur_year+1);
		$show2	= ($cur_year)." - ".($cur_year+1)." ke ".($cur_year+1)." - ".($cur_year+2);
		
		$check0	= ($cur_year-1)." - ".($cur_year);
		$check1	= ($cur_year)." - ".($cur_year+1);
		$check2	= ($cur_year+1)." - ".($cur_year+2);
		
	} else if ($cur_month == "july" || $cur_month == "august" || $cur_month == "september" || $cur_month == "october" || $cur_month == "november" || $cur_month == "december") {	
		$edu_year0	= ($cur_year-1)." - ".($cur_year);		
		$edu_year1	= ($cur_year)." - ".($cur_year+1);		
		$edu_year2	= ($cur_year+1)." - ".($cur_year+2);	
		
		$show0	= ($cur_year-1)." - ".($cur_year)." ke ".($cur_year)." - ".($cur_year+1);
		$show1	= ($cur_year)." - ".($cur_year+1)." ke ".($cur_year+1)." - ".($cur_year+2);
		$show2	= ($cur_year+2)." - ".($cur_year+2)." ke ".($cur_year+1)." - ".($cur_year+3);
		
		$check0	= ($cur_year)." - ".($cur_year+1);
		$check1	= ($cur_year+1)." - ".($cur_year+2);
		$check2	= ($cur_year+1)." - ".($cur_year+3);
			
	}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" height="10"></td>
    </tr>
	<tr height="40">
    	<td width="30"></td>
        <td id="text_title_page1" align="center">
        <?PHP if($ada == true) { ?>
        Daftar Kelas <?= $kelas; ?> Tahun Ajaran [<?= $periode; ?>]
        <?PHP } else { ?>
        Daftar siswa yang belum mendapat kelas [<?= $periode; ?>]
        <?PHP
		}
		?>
        </td>
        <td width="30"></td>
    </tr>
    <tr>
    	<td></td>
    	<td height="10"><hr noshade="noshade" color="#666666" size="1" /></td>
        <td></td>
    </tr>
    <tr>
    	<td colspan="3" height="10"></td>
    </tr>
    <tr>
    	<td></td>
    	<td align="left">
        	<table border="0" cellpadding="0" cellspacing="0"> 
            	<tr>
                	<td colspan="5" height="10"></td>
                </tr>    
            	<tr height="30">                	
                	<td width="10"></td>
                    <td id="text_normal_black">No Sisda</td>
                    <td width="10"></td>
                    <td>
                    <form name="input_kelas" method="post" action="engine.php?case=add_class" style="padding:0px;">
                    <input type="hidden" name="kelas" value="<?= $kelas; ?>" />
                    <input type="hidden" name="periode" value="<?= $periode; ?>" />
                    <input type="text" name="no_sisda" width="35" /> <input type="submit" value="Daftarkan siswa ke Kelas <?= $kelas; ?>" style="height:35px; width:300px; background-color:#333333; color:#FFFFFF;"/></form></td>
                    <td align="left"><button name="load_no_sisda" style="font-size:11px;" onclick="javascript:void window.open('popup.php?pl=chk_no_sisda_kelas&th=<?= $periode; ?>','','width=700,height=500,toolbar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0'); return false;">Cek No Sisda</button></td>
                    <td width="10"></td>
                </tr>
                <tr>
                	<td colspan="5" height="10"></td>
                </tr>   
            </table>
            <?PHP
			function get_kelas() {
			?>
				<select name="kelas">
                <option value="">Pilih</option>
                <?PHP                
				$src_nama_kelas 	= "select * from kelas";
				$query_nama_kelas	= mysqli_query($mysql_connect, $src_nama_kelas) or die(mysqli_query($mysql_connect, ));
			
                while($row_nama_kelas = mysql_fetch_array($query_nama_kelas)) {
                ?>
                <option value="<?= $row_nama_kelas["nama_kelas"]; ?>"><?= $row_nama_kelas["nama_kelas"]; ?></option>
                <?PHP
                }
                ?>
                </select>
			<?PHP
			}
			?>
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">     
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
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Tingkat</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Periode</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Kelas</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Action</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                <form method="post" action="engine.php?case=add_class">
                <?PHP
				$src_kelas	= "select no_sisda,nama_siswa,tingkat,periode,jenjang,kelas from siswa_finance where kelas = '$kelas' and periode = '$periode'";
				$query_kelas = mysqli_query($mysql_connect, $src_kelas) or die(mysql_error());
				//$bg used to generate zebra background.
				
				//echo mysql_num_rows($query_kelas);
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$i = 1;
				
				while($get_kelas = mysql_fetch_array($query_kelas)) {
				?>
                <tr height="30">                	
                	<td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="40" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $i++; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_kelas["no_sisda"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_kelas["nama_siswa"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?= $get_kelas["jenjang"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?= $get_kelas["tingkat"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?= $get_kelas["periode"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?= $get_kelas["kelas"]; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center">
                    <?PHP get_kelas(); ?>
                    <select name="periode">
                    <option value="<?= $check0; ?>"><?= $check0; ?></option>
                    <option value="<?= $check1; ?>"><?= $check1; ?></option>
                    </select>
                    <input type="hidden" name="no_sisda" value="<?= $get_kelas["no_sisda"]; ?>" />
                    <input type="submit" value="Rubah kelas" />
                    </td>
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
                </form>
			</table>
		</td>
      	<td></td>
	</tr>
</table>
<?PHP
} else {	
	
	header("location:index.php");
		
}
?>