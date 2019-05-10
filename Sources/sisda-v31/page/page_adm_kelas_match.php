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
			
			/*  //// ini malah bukan ngawurrrr, gendenggggg ......
			$src_nama_kelas 	= "select * from kelas where tingkat = '$tingkat'"; 
			$query_nama_kelas	= mysqli_query($mysql_connect, $src_nama_kelas) or die(mysqli_query($mysql_connect, ));
			
			$ix = 0;
			
			while($row_nama_kelas = mysql_fetch_array($query_nama_kelas)) {
			
				$nama_kelas[] = $row_nama_kelas["nama_kelas"];
				$ix++;
			
			}
			*/
			?>
            <form method="post" action="mainpage.php?pl=adm_kelas&kls=<?= $kelas; ?>&th=<?= $periode; ?>">
        	<table width="100%" border="0" cellpadding="0" cellspacing="0">
            	<tr>
                    <td colspan="33" align="center" bgcolor="#666666" height="50"><input type="submit" value="Tambah siswa untuk kelas <?= $kelas; ?>" style="height:40px; width:400px; background-color:#339966; color:#FFFFFF; font-size:14px;" /> <a href="#" onMouseOver="stm(Text[5],Style[12])" onMouseOut="htm()"><img src="images/what_happen_aya_naon.jpg" border="0" /></a></td>
                </tr>     
            	<tr height="40">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="20" bgcolor="#999999" id="text_normal_white" align="left">No</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No Sisda</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="100" bgcolor="#999999" id="text_normal_white" align="left">Nama siswa</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Nama<br />panggilan</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">L/P</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="100" bgcolor="#999999" id="text_normal_white" align="left">Tempat <br /> tanggal lahir</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="120" bgcolor="#999999" id="text_normal_white" align="center">Alamat</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Nama ayah</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No. Telp. ayah</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">Nama ibu</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="left">No. Telp. ibu</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Jenjang</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Tingkat</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Periode</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white" align="center">Kelas</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                
                <?PHP
				//$src_kelas		= "select no_sisda,nama_siswa,tingkat,periode,jenjang,kelas from siswa_finance where kelas = '$kelas' and periode = '$periode' order by nama_siswa"; //echo $src_kelas;
				$src_kelas		= "
									select 
									siswa_finance.no_sisda,
									siswa_finance.nama_siswa,
									siswa_finance.tingkat,
									siswa_finance.periode,
									siswa_finance.jenjang,
									siswa_finance.kelas,
									siswa.nama_panggilan,
									siswa.jenis_kelamin,
									siswa.tempat_lahir,
									siswa.tanggal_lahir,
									siswa.alamat,
									siswa.nama_ayah,
									siswa.telp_ayah,
									siswa.nama_bunda,
									siswa.telp_bunda 
									from siswa_finance inner join siswa
									on siswa_finance.no_sisda = siswa.no_sisda
									where siswa_finance.kelas = '$kelas' and siswa_finance.periode = '$periode' order by nama_siswa"; //echo $src_kelas;
				$query_kelas 	= mysqli_query($mysql_connect, $src_kelas) or die(mysql_error());
				$num_kelas 		= mysql_num_rows($query_kelas);
				//$bg used to generate zebra background.
				//echo $src_kelas;
				//echo mysql_num_rows($query_kelas);
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$i = 1;
				
				while($get_kelas = mysql_fetch_array($query_kelas)) {
				
					if($get_kelas["kelas"] == "") { $kelas_cur = "belum ada"; $kelas_col = "#ff0000"; } else { $kelas_cur = $get_kelas["kelas"]; $kelas_col = "#000000;"; }
				
				?>
                <tr height="30">                	
                	<td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $i++; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?= $get_kelas["no_sisda"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left" style="padding-top:5px; padding-bottom:5px;"><?= $get_kelas["nama_siswa"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP if($get_kelas["nama_panggilan"] != "") { echo $get_kelas["nama_panggilan"]; } else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_kelas["jenis_kelamin"] == "Laki-laki") { echo "L"; } else if($get_kelas["jenis_kelamin"] == "Perempuan") { echo "P"; } else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?PHP if($get_kelas["tempat_lahir"] != "") { echo $get_kelas["tempat_lahir"]."<br>"; } else { echo "<span style='color:#ff0000;'>none<br></span>"; } if($get_kelas["tanggal_lahir"] != "0000-00-00") { echo $get_kelas["tanggal_lahir"]; } else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left" style="padding-top:5px; padding-bottom:5px;"><?PHP if($get_kelas["alamat"] != "") { echo $get_kelas["alamat"]; }  else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP if($get_kelas["nama_ayah"] != "") { echo $get_kelas["nama_ayah"]; } else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP if($get_kelas["telp_ayah"] != "") { echo $get_kelas["telp_ayah"]; }  else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP if($get_kelas["nama_bunda"] != "") { echo $get_kelas["nama_bunda"]; }  else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="left"><?PHP if($get_kelas["telp_bunda"] != "") { echo $get_kelas["telp_bunda"]; } else { echo "<span style='color:#ff0000;'>none</span>"; } ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?= $get_kelas["jenjang"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?= $get_kelas["tingkat"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center"><?= $get_kelas["periode"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black" align="center" style="color:<?= $kelas_col; ?>"><?= $kelas; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
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
                    <td colspan="33" align="center" bgcolor="#666666" height="50"><input type="submit" value="Tambah siswa untuk kelas <?= $kelas; ?>" style="height:40px; width:400px; background-color:#339966; color:#FFFFFF; font-size:14px;" /> <a href="#" onMouseOver="stm(Text[5],Style[12])" onMouseOut="htm()"><img src="images/what_happen_aya_naon.jpg" border="0" /></a></td>
                </tr>  
                <tr>
                    <td colspan="33" align="center" height="10"></td>
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