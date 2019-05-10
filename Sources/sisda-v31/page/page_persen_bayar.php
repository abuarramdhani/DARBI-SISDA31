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
        <td id="text_title_page1" align="center">Persen Pembayaran Anak Guru</td>
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
        	<!---====================uhuh uh7h 8uh87 8h8n8hj un7================================-->
            <?PHP
			$sis_fin_cur_year	= date("Y");
			$sis_fin_cur_month	= strtolower(date("F"));
			
			if($sis_fin_cur_month == "january" || $sis_fin_cur_month == "february" || $sis_fin_cur_month == "march" || $sis_fin_cur_month == "april" || $sis_fin_cur_month == "may" || $sis_fin_cur_month == "june") {	
				
				$edu_year_siswa	= ($sis_fin_cur_year-1)." - ".$sis_fin_cur_year;
				
			} else if ($sis_fin_cur_month == "july" || $sis_fin_cur_month == "august" || $sis_fin_cur_month == "september" || $sis_fin_cur_month == "october" || $sis_fin_cur_month == "november" || $sis_fin_cur_month == "december") {	
				
				$edu_year_siswa	= $sis_fin_cur_year." - ".($sis_fin_cur_year+1);
			}
			
			$edu_year_siswa_next1 = (substr($edu_year_siswa,0,4) + 1) . " - " . (substr($edu_year_siswa,7,4) + 1);
			$edu_year_siswa_next2 = (substr($edu_year_siswa,0,4) + 2) . " - " . (substr($edu_year_siswa,7,4) + 2);
			?>
			<form method="post" name="persen_bayar" action="engine.php?case=add_persen_bayar">  
            <table width="1000" border="0" cellpadding="0" cellspacing="0">  
             	<tr>
                	<td bgcolor="#006699" colspan="9" height="10"></td>
                </tr>          	             
                <tr bgcolor="#006699" id="text_normal_white" height="25">
                	<td width="30"></td>
                    <td width="150" align="right">Periode</td>
                    <td width="10"></td>
                    <td width="">
                    <select name="periode">
                    <option value="<?= $edu_year_siswa_next1; ?>"><?= $edu_year_siswa_next1; ?></option>
                    <option value="<?= $edu_year_siswa_next2; ?>"><?= $edu_year_siswa_next2; ?></option>
                    </select>
                    </td>
                    <td width="10"></td>
                    <td width="150" align="right"></td>
                    <td width="10"></td>
                    <td></td>
                    <td width="30"></td>
                </tr>
                <tr bgcolor="#006699">
                	<td width="30"></td>
                	<td colspan="7" height="10"><hr noshade="noshade" size="1" /></td>
                    <td width="30"></td>
                </tr>
                <tr bgcolor="#006699" id="text_normal_white" height="25">
                	<td></td>
                    <td align="right">Komponen pembayaran <span style="color:#FFCC00;"><b>Daftar Ulang TK A</b></span></td>
                    <td></td>
                    <td>
                    <select name="kegiatan_tka" style="width:170px;">
                    <option value="">Kegiatan TK A</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <br />
                    <select name="seragam_tka" style="width:170px;">
                    <option value="">Seragam TK A</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    </td>
                    <td></td>
                    <td align="right" id="text_normal_white">Komponen pembayaran <span style="color:#FFCC00;"><b>Daftar Ulang TK B</b></span></td>
                    <td></td>
                    <td>
                    <select name="kegiatan_tkb" style="width:170px;">
                    <option value="">Kegiatan TK B</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <br />
                    <select name="seragam_tkb" style="width:170px;">
                    <option value="">Seragam TK B</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    </td>
                    <td width="30"></td>
                </tr>
                <tr bgcolor="#006699">
                	<td width="30"></td>
                	<td colspan="7" height="10"><hr noshade="noshade" size="1" /></td>
                    <td width="30"></td>
                </tr>
                <tr bgcolor="#006699" id="text_normal_white" height="25">
                	<td></td>
                    <td align="right">Komponen pembayaran <span style="color:#FFCC00;"><b>SPP TK</b></span></td>
                    <td></td>
                    <td>
                    <select name="spp_tk">
                    <option value="">SPP</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <select name="elearning_tk">
                    <option value="">E-Learning</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <br />
                    <select name="ict_tk">
                    <option value="">ICT</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <select name="ks_tk">
                    <option value="">KS</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    </td>
                    <td></td>
                    <td align="right" id="text_normal_white">Komponen pembayaran <span style="color:#FFCC00;"><b>SPP SD</b></span></td>
                    <td></td>
                    <td>
                    <select name="spp_sd">
                    <option value="">SPP</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <select name="elearning_sd">
                    <option value="">E-Learning</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <br />
                    <select name="ict_sd">
                    <option value="">ICT</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <select name="ks_sd">
                    <option value="">KS</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    </td>
                    <td width="30"></td>
                </tr>
                <tr bgcolor="#006699">
                	<td width="30"></td>
                	<td colspan="7" height="10"><hr noshade="noshade" size="1" /></td>
                    <td width="30"></td>
                </tr>
                <tr bgcolor="#006699">
                	<td></td>
                    <td align="right" id="text_normal_white">Komponen pembayaran <span style="color:#FFCC00;"><b>SPP SMP</b></span></td>
                    <td></td>
                    <td>
                    <select name="spp_smp">
                    <option value="">SPP</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <select name="elearning_smp">
                    <option value="">E-Learning</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <br />
                    <select name="ict_smp">
                    <option value="">ICT</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    <select name="ks_smp">
                    <option value="">KS</option>
                    <?PHP
					for($i_persen = 1; $i_persen <= 100; $i_persen++) {
					?>
					<option value="<?= $i_persen; ?>"><?= $i_persen; ?> %</option>
					<?PHP
					}
                    ?>
                    </select>
                    </td>
                    <td></td>
                    <td align="right" id="text_normal_white"></td>
                    <td></td>
                    <td>
                    
                    </td>
                    <td></td>
                </tr>
                <tr bgcolor="#006699">
                	<td width="30"></td>
                	<td colspan="7" height="10"><hr noshade="noshade" size="1" /></td>
                    <td width="30"></td>
                </tr>
                <tr bgcolor="#006699" id="text_normal_white" height="25">
                	<td></td>
                    <td></td>
                    <td></td>
                    <td colspan="5" align="left"><input type="submit" value="Simpan" style="width:150px; height:35px; background-color:#CC6600; color:#FFFFFF;" onClick="return verification()" /><input type="reset" value="Reset" style="width:150px; height:35px; background-color:#663399; color:#FFFFFF;" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                	<td bgcolor="#006699" colspan="9" height="10"></td>
                </tr>
            </table>   
            </form>    
            <?PHP
			$src_get_persen		= "select * from persen_bayar";
			$query_get_persen	= mysqli_query($mysql_connect, $src_get_persen) or die (mysql_error());
			$num_get_persen		= mysql_num_rows($query_get_persen);
			
			if($num_get_persen != 0 ) {
			?>     
        	<table width="1000" border="0" cellpadding="0" cellspacing="0">            	             
                <tr>
                	<td colspan="37" height="5"></td>
                </tr>
            	<tr height="30" align="center">                	
                	<td width="10" bgcolor="#999999"></td>
                    <td width="30" bgcolor="#999999" id="text_normal_white">No</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="" bgcolor="#999999" id="text_normal_white">Periode</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">Daful kegiatan <br />TK A</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">Daful seragam <br />TK A</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">Daful kegiatan <br />TK B</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">Daful seragam <br />TK B</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">SPP<br />TK</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">ICT<br />TK</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">E-Learning<br />TK</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">KS<br />TK</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">SPP<br />SD</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">ICT<br />SD</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">E-Learning<br />SD</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">KS<br />SD</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">SPP<br />SMP</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">ICT<br />SMP</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">E-Learning<br />SMP</td>
                    <td width="10" bgcolor="#999999"></td>
                    <td width="80" bgcolor="#999999" id="text_normal_white">KS<br />SMP</td>
                    <td width="10" bgcolor="#999999"></td>
                </tr>
                <?PHP
				//$bg used to generate zebra background.
				$bg	="#ffffff";	
				
				//this is for row  number, you know...it starts from 0
				$i = 1;
				
				while($get_persen = mysql_fetch_array($query_get_persen)) {
				?>
                <tr height="30" align="center">                	
                	<td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $i++; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["periode"]; ?></td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["kegiatan_tka"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["seragam_tkb"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["kegiatan_tka"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["seragam_tkb"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["spp_tk"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["ict_tk"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["elearning_tk"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["ks_tk"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["spp_sd"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["ict_sd"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["elearning_sd"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["ks_sd"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["spp_smp"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["ict_smp"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["elearning_smp"]; ?>%</td>
                    <td bgcolor="<?PHP echo $bg; ?>"></td>
                    <td bgcolor="<?PHP echo $bg; ?>" id="text_normal_black"><?= $get_persen["ks_smp"]; ?>%</td>
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
                	<td colspan="37" height="30"></td>
                </tr>
            </table>
            <?PHP
			} 
			?>
         </td>
         <td></td>
     </tr>
</table>
<?PHP
} else {	
	
	header("location:index.php");
		
}
?>
<SCRIPT type="text/javascript" >
function verification() { 

	if(document.persen_bayar.kegiatan_tka.value == "") {
		alert('Nilai persen anak guru untuk kegiatan TK A harus diisi');
		return false;
	}
	if(document.persen_bayar.seragam_tka.value == "") {
		alert('Nilai persen anak guru untuk seragam TK A harus diisi');
		return false;
	}
	
	if(document.persen_bayar.kegiatan_tkb.value == "") {
		alert('Nilai persen anak guru untuk kegiatan TK B harus diisi');
		return false;
	}
	if(document.persen_bayar.seragam_tkb.value == "") {
		alert('Nilai persen anak guru untuk seragam TK B harus diisi');
		return false;
	}
	
	if(document.persen_bayar.spp_tk.value == "") {
		alert('Nilai persen anak guru untuk SPP TK harus diisi');
		return false;
	}
	if(document.persen_bayar.ict_tk.value == "") {
		alert('Nilai persen anak guru untuk ICT TK harus diisi');
		return false;
	}
	if(document.persen_bayar.elearning_tk.value == "") {
		alert('Nilai persen anak guru untuk e-Learning TK harus diisi');
		return false;
	}
	if(document.persen_bayar.ks_tk.value == "") {
		alert('Nilai persen anak guru untuk KS TK harus diisi');
		return false;
	}
	
	if(document.persen_bayar.spp_sd.value == "") {
		alert('Nilai persen anak guru untuk SPP SD harus diisi');
		return false;
	}
	if(document.persen_bayar.ict_sd.value == "") {
		alert('Nilai persen anak guru untuk ICT SD harus diisi');
		return false;
	}
	if(document.persen_bayar.elearning_sd.value == "") {
		alert('Nilai persen anak guru untuk e-Learning SD harus diisi');
		return false;
	}
	if(document.persen_bayar.ks_sd.value == "") {
		alert('Nilai persen anak guru untuk KS SD harus diisi');
		return false;
	}
	
	if(document.persen_bayar.spp_smp.value == "") {
		alert('Nilai persen anak guru untuk SPP SMP harus diisi');
		return false;
	}
	if(document.persen_bayar.ict_smp.value == "") {
		alert('Nilai persen anak guru untuk ICT SMP harus diisi');
		return false;
	}
	if(document.persen_bayar.elearning_smp.value == "") {
		alert('Nilai persen anak guru untuk e-Learning SMP  harus diisi');
		return false;
	}
	if(document.persen_bayar.ks_smp.value == "") {
		alert('Nilai persen anak guru untuk KS SMP harus diisi');
		return false;
	}
	
	return true;	
}
</SCRIPT>