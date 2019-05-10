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
        <td id="text_title_page1" align="center">Siswa naik kelas</td>
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
        if(!empty($_POST["submit"]) && !empty($_POST["periode"])) { 
        
            $periode		= mysql_real_escape_string($_POST["periode"]);
            $src_tingkat	= mysql_real_escape_string(substr($_POST["submit"],-1,1));
			
			//where are going to get this pattern from field (submit) values
			// Kelas Play Group ke TK A
			// Kelas TK A ke TK B
			// Kelas 1 ke 2
			if(!is_numeric($src_tingkat))  {
				if($src_tingkat == "A") {
				
					$tingkat 		= "Toddler";
					$next_tingkat	= "TK A";
				}
				
				if($src_tingkat == "B") {
					
					$tingkat 		= "TK A";
					$next_tingkat	= "TK B";				
				}
			} else {
			
				$tingkat		= $src_tingkat-1;
				$next_tingkat	= $src_tingkat;
				
			}
			
			
			
			$next_year_edu	= (substr($periode,0,4)+1)." - ".(substr($periode,7,4)+1);
			
			$src_check_done		= "select distinct periode from siswa_finance where periode ='$next_year_edu'  and tingkat = '$next_tingkat'";
			$query_check_done	= mysqli_query($mysql_connect, $src_check_done) or die(mysql_error());
			
			if(mysql_num_rows($query_check_done) != 0) {
		?>
        <table width="" height="400" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td id="text_normal_black" align="center">
                <p style="font-size:14px;">
                Proses setting nominal SPP untuk kelas <b><?= $tingkat; ?></b> ke kelas <b><?= $next_tingkat; ?></b> tahun ajaran <b><?= $periode; ?></b> ke tahun ajaran <b><?= (substr($periode,0,4)+1); ?> - <?= (substr($periode,0,4)+2); ?></b>
                sudah pernah dilakukan.<br /><br />
                <input type="button" value="Kembali" onclick="window.location.href='mainpage.php?pl=nextclass_adm_siswa';" style="width:200px; height:40px; size:18px;" />
                </p>
                </td>
            </tr>
            <tr>
                <td height="35">&nbsp;</td>
            </tr>
        </table>
        <?PHP
			} else {
        
				$get_jumlah_siswa	= "select * from siswa_finance where aktif = '1' and periode = '$periode' and tingkat = '$tingkat'";
				$query_jumlah_siswa	= mysqli_query($mysql_connect, $get_jumlah_siswa) or die("terjadi kesalahan: ".mysql_error());
				
				$num_jumlah_siswa	= mysql_num_rows($query_jumlah_siswa);
        ?>
        
        <table width="" height="400" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td id="text_normal_black" align="center">
                <?PHP
				if($num_jumlah_siswa != 0) {
				?>
                <p style="font-size:14px;">
                Anda akan melakukan proses update data siswa naik kelas<br /> Dari kelas <b><?= $tingkat; ?></b> ke kelas <b><?= $next_tingkat; ?></b> tahun ajaran <b><?= $periode; ?></b> ke tahun ajaran <b><?= (substr($periode,0,4)+1); ?> - <?= (substr($periode,0,4)+2); ?></b>
                <br />Jumlah total <b><?= $num_jumlah_siswa; ?></b> siswa
                </p>                
                <form method="post" action="engine.php?case=reg_nextclass_adm_siswa_group">
                <input type="hidden" name="periode" value="<?= $periode; ?>" />
                <input type="hidden" name="tingkat" value="<?= $tingkat; ?>" />
                <button type="submit" style="width:150px; height:50px; background-color:#006699; color:#FFFFFF; font-size:18px;">Lanjutkan</button>
                </form>
                <?PHP
				} else {
				?>
                <p style="font-size:14px;">
                Anda akan melakukan proses update data siswa naik kelas<br /> Dari kelas <b><?= $tingkat; ?></b> ke kelas <b><?= $next_tingkat; ?></b> tahun ajaran <b><?= $periode; ?></b> ke tahun ajaran <b><?= (substr($periode,0,4)+1); ?> - <?= (substr($periode,0,4)+2); ?></b>
                <br />Jumlah total <b><?= $num_jumlah_siswa; ?></b> siswa
                </p>
                <input type="button" value="Kembali" onclick="window.location.href='mainpage.php?pl=nextclass_adm_siswa';" style="width:200px; height:40px; size:18px;" />
                <?PHP
				}
				?>
                </td>
            </tr>
            <tr>
                <td height="35">&nbsp;</td>
            </tr>
        </table>
         <?PHP
		 	}
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