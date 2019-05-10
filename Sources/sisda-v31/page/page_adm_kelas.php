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
		
	} else if (!empty($_GET["th"])) {
	
		$kelas		= htmlspecialchars($_GET["kls"]); 
		$periode	= htmlspecialchars($_GET["th"]);
		$ada		= true;
	
	} else {
	
		$kelas		= ""; 
		$periode	= htmlspecialchars($_GET["th"]);;
		$ada		= false;
	
	}
	
	if($ada == true) {
	
		$src_get_tingkat 	= "select tingkat from kelas where nama_kelas = '$kelas'";
		$query_get_tingkat	= mysqli_query($mysql_connect, $src_get_tingkat) or die(mysql_error());
		$get_tingkat		= mysql_fetch_array($query_get_tingkat);
		$tingkat			= $get_tingkat["tingkat"];
	
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
	
	
	if($periode == $edu_year1 || $periode == $edu_year2) {
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
                    <td align="left"><button name="load_no_sisda" style="font-size:16px; height:40px; width:250px; background-color:#006699; color:#FFFFFF;" onclick="window.location.href='<?= $darbi_url; ?>mainpage.php?pl=kelas'">Kembali ke pilihan kelas</button></td>
                </tr>
                <tr>
                	<td colspan="5" height="10"></td>
                </tr>   
            </table>
            <?PHP			
			/* function get_kelas($tingkat,$no_sisda_kls) { /////ngawurrrrrrr
			?>
				<select name="kelas[]">
                <option value="">Pilih</option>
                <?PHP                
				$src_nama_kelas 	= "select * from kelas where tingkat = '$tingkat'";
				$query_nama_kelas	= mysqli_query($mysql_connect, $src_nama_kelas) or die(mysqli_query($mysql_connect, ));
			
                while($row_nama_kelas = mysql_fetch_array($query_nama_kelas)) {
                ?>
                <option value="<?= $row_nama_kelas["nama_kelas"]."-".$no_sisda_kls; ?>"><?= $row_nama_kelas["nama_kelas"]; ?></option>
                <?PHP
                }
                ?>
                </select>
			<?PHP
			} */
			
			/* /// makin ngawurrrrrrrrrrr 
			$src_nama_kelas 	= "select * from kelas where tingkat = '$tingkat'";
			$query_nama_kelas	= mysqli_query($mysql_connect, $src_nama_kelas) or die(mysqli_query($mysql_connect, ));
			
			$ix = 0;
			
			while($row_nama_kelas = mysql_fetch_array($query_nama_kelas)) {
			
				$nama_kelas[] = $row_nama_kelas["nama_kelas"];
				$ix++;
			
			}
			*/
			?>
            <form method="post" action="engine.php?case=add_class">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td colspan="17" align="center" bgcolor="#333333" height="50"><input type="submit" value="Rubah kelas" style="height:30px; width:200px; font-size:14px;" /></td>
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
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Tingkat</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Periode</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Kelas</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Rubah</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                
                <?PHP
				$src_kelas		= "select no_sisda,nama_siswa,tingkat,periode,jenjang,kelas from siswa_finance where tingkat = '$tingkat' and periode = '$periode'";
				$query_kelas 	= mysqli_query($mysql_connect, $src_kelas) or die(mysql_error());
				$num_kelas 		= mysql_num_rows($query_kelas);
				//$bg used to generate zebra background.
				
				//echo mysql_num_rows($query_kelas);
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$i = 1;
				
				while($get_kelas = mysql_fetch_array($query_kelas)) {
				
					if($get_kelas["kelas"] == "") { $kelas_cur = "belum ada"; $kelas_col = "#ff0000"; } else { $kelas_cur = $get_kelas["kelas"]; $kelas_col = "#000000;"; }
				
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
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" style="color:<?= $kelas_col; ?>"><?= $kelas_cur; ?></td>
                    <td width="10" bgcolor="<?PHP echo $bg; ?>"></td>
                    <td width="" bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center">
                    <?PHP
					if($kelas_cur != $kelas) {
					?>
                    <input type="checkbox" name="rubah[]" value="<?= /*$nama_kelas[$i]*/$kelas."-".$get_kelas["no_sisda"]; ?>" /> Rubah ke kelas <?= $kelas; ?> 
                    <?PHP
					}
					?>
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
             	<tr>
                    <td colspan="17" align="center" bgcolor="#333333" height="50"><input type="submit" value="Rubah kelas" style="height:30px; width:200px; font-size:14px;" /></td>
                </tr>  
                <tr>
                    <td colspan="17" align="center" height="10"></td>
                </tr> 
			</table>            
            <input type="hidden" name="tingkat" value="<?= $tingkat; ?>" />
            <input type="hidden" name="periode" value="<?= $periode; ?>" />
            <input type="hidden" name="nama_kelas" value="<?= $kelas; ?>" />
            </form>
            <table border="0" cellpadding="0" cellspacing="0"> 
            	<tr> 
                    <td align="left"><button name="load_no_sisda" style="font-size:16px; height:40px; width:250px; background-color:#006699; color:#FFFFFF;" onclick="window.location.href='<?= $darbi_url; ?>mainpage.php?pl=kelas'">Kembali ke pilihan kelas</button></td>
                </tr>
                <tr>
                	<td colspan="5" height="20"></td>
                </tr>   
            </table>
		</td>
      	<td></td>
	</tr>
</table>
<?PHP
	} else {
	
		echo "<center><p style='font-family:verdana; font-size:36px'>ohuohu</p></center>";
	
	}
	
} else {	
	
	header("location:index.php");
		
}
?>