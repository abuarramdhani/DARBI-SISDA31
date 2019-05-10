<?PHP
include("../sisda-config.php");

$periode		= htmlspecialchars($_GET["per"]);
//Actually, tk/sd/smp has to be written in capital from "page_reg_adm_siswa.php".
//But, i dont know why, in page_cat_adm_bi_ma_setting.php file, those values are set in lower case...hehehhee... inconsitant work.. :D
//So, now we make it lower, because we will work on set_cat_adm_bi_ma table (owned by page_cat_adm_bi_ma_setting.php)
//here we go buddy
if(htmlspecialchars($_GET["lev"]) == "Toddler" || htmlspecialchars($_GET["lev"]) == "PG" || htmlspecialchars($_GET["lev"]) == "TK A" || htmlspecialchars($_GET["lev"]) == "TK B") {
	$level	= "tkx";
} else if(htmlspecialchars($_GET["lev"]) == "SD") {
	$level	= "sdx";
} else if(htmlspecialchars($_GET["lev"]) == "SMP") {
    //make it lower hahahahhaha
	$level	= "smp";
}

if($_GET["q"] == 1) { $q = "umum"; }
if($_GET["q"] == 2) { $q = "berdesaukan"; }
if($_GET["q"] == 3) { $q = "memsaukan"; }
if($_GET["q"] == 4) { $q = "umgrab"; }
if($_GET["q"] == 5) { $q = "umsksmpgrab"; }
if($_GET["q"] == 6) { $q = "asdar"; } 
if($_GET["q"] == 7) { $q = "asdargraa"; }
if($_GET["q"] == 8) { $q = "asdargrab"; }
if($_GET["q"] == 9) { $q = "anpeg1"; }
if($_GET["q"] == 10) { $q = "anpeg2"; }
if($_GET["q"] == 11) { $q = "anpeg3"; }
if($_GET["q"] == 12) { $q = "anpeg1graa"; }
if($_GET["q"] == 13) { $q = "anpeg1grab"; }
if($_GET["q"] == 14) { $q = "anpeg2graa"; }
if($_GET["q"] == 15) { $q = "anpeg2grab"; }
if($_GET["q"] == 16) { $q = "anpeg3graa"; }
if($_GET["q"] == 17) { $q = "anpeg3grab"; } 
if($_GET["q"] == 18) { $q = "pintodsem2"; }
if($_GET["q"] == 19) { $q = "pinpgtksem2"; }
if($_GET["q"] == 20) { $q = "pinsd34"; }
if($_GET["q"] == 21) { $q = "pinsd56"; } 
if($_GET["q"] == 22) { $q = "pinsmp8"; }
if($_GET["q"] == 23) { $q = "pinsmp9"; }

$periode_enc		= mysql_real_escape_string($periode);
$level_enc			= mysql_real_escape_string($level);
$set_cat_adm_enc	= mysql_real_escape_string($q); //actually this last one is no need to be escaped, right? because u have defined it above

$src_select_disc_adm	= "select * from set_cat_adm_bi_ma where periode = '$periode_enc' and level = '$level_enc' and set_cat_adm = '$set_cat_adm_enc'";
$query_select_disc_adm	= mysqli_query($mysql_connect, $src_select_disc_adm) or die ("There is an error with mysql: ".mysql_error());
$num_select_disc_adm	= mysql_num_rows($query_select_disc_adm);

if($num_select_disc_adm != 0) {
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
        <td width="10"></td>
        <td width="200"></td>
        <td width="5"></td>
        <td></td>
    </tr>
<?PHP
	while($get_select_disc_adm	= mysql_fetch_array($query_select_disc_adm)) {
		if($get_select_disc_adm["cat_adm"] == "penga") {
		?>
			<tr height="20">
				<td bgcolor="#999999" ></td>
				<td align="left" bgcolor="#999999" id="text_normal_white">Pengembangan</td>
				<td></td>
				<td id="text_normal_black"><input type="text" name="pengembangan" size="35" readonly="readonly" value="<?PHP $cur_total_nominal = $get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
			</tr>
		<?PHP
		}
		if($get_select_disc_adm["cat_adm"] == "kegia") {
		?>
			<tr>
				<td colspan="4" height="5"></td>
			</tr>
			<tr height="20">
				<td bgcolor="#999999"></td>
				<td align="left" bgcolor="#999999" id="text_normal_white">Kegiatan</td>
				<td></td>
				<td id="text_normal_black"><input type="text" name="kegiatan" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
			</tr>
		<?PHP
		}
		if($get_select_disc_adm["cat_adm"] == "peral") {
		?>
		<tr>
			<td colspan="4" height="5"></td>
		</tr>
		<tr height="20">
			<td bgcolor="#999999" ></td>
			<td align="left" bgcolor="#999999"  id="text_normal_white">Peralatan</td>
			<td></td>
			<td id="text_normal_black"><input type="text" name="peralatan" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
		</tr>
		<?PHP
		}
		if($get_select_disc_adm["cat_adm"] == "serag") {
		?>
		<tr>
			<td colspan="4" height="5"></td>
		</tr>
		<tr height="20">
			<td bgcolor="#999999" ></td>
			<td align="left" bgcolor="#999999" id="text_normal_white">Seragam</td>
			<td></td>
			<td id="text_normal_black"><input type="text" name="seragam" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
		</tr>
		<?PHP
		}
		if($get_select_disc_adm["cat_adm"] == "paket") {
		?>
		<tr>
			<td colspan="4" height="5"></td>
		</tr>
		<tr height="20">
			<td bgcolor="#999999" ></td>
			<td align="left" bgcolor="#999999" id="text_normal_white">Paket</td>
			<td></td>
			<td id="text_normal_black"><input type="text" name="paket" readonly="readonly" size="35" value="<?PHP $cur_total_nominal =  $cur_total_nominal+$get_select_disc_adm["nominal"]; echo $get_select_disc_adm["nominal"]; ?>" /></td>
		</tr>
        <tr>
			<td colspan="4" height="5"></td>
		</tr>
		<tr height="20">
			<td bgcolor="#999999" ></td>
			<td align="left" bgcolor="#999999" id="text_normal_white">Sub Total</td>
			<td></td>
			<td id="text_normal_black"><input type="text" readonly="readonly" size="35" value="Rp. <?PHP echo $cur_total_nominal; ?>" style="font-weight:bold; color:#ff0000;"/></td>
		</tr>
	<?PHP
		}
	}
} else {
    echo "<span id=\"text_normal_black\"><b>Data discount administrasi untuk level ".$_GET["lev"]." tahun ajaran $periode belum dibuat. Silahkan hubungi Administrator Keuangan</span></b>";
}
?>
</table>