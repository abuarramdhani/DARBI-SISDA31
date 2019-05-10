<?PHP
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	$no_sisda  		= empty($_POST["no_sisda"]) ? "" : $_POST["no_sisda"];
	$nama_siswa		= empty($_POST["nama_siswa"]) ? "" : $_POST["nama_siswa"];
	$tingkat		= empty($_POST["tingkat"]) ? "" : $_POST["tingkat"];
	$kelas			= empty($_POST["kelas"]) ? "" : $_POST["kelas"];
	$src_periode	= empty($_POST["periode"]) ? "" : $_POST["periode"]; 
?>
    <form name="search" method="post" action="">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f1f1f1">
        <tr>
            <td align="right" width="150" id="text_normal_black">No Sisda</td>
            <td width="20"></td>
            <td><input type="text" name="no_sisda" size="25" /></td>
        </tr>
        <tr>
            <td align="right" id="text_normal_black">Nama siswa</td>
            <td width="20"></td>
            <td><input type="text" name="nama_siswa" size="25" /></td>
        </tr>
        <tr>
            <td align="right" id="text_normal_black">Tingkat</td>
            <td width="20"></td>
            <td>
            <select name="tingkat">
            <option value="">Pilih</option>
            <option value="Toddler">Toddler</option>
            <option value="PG">PG</option>
            <option value="TK A">TK A</option>
            <option value="TK B">TK B</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right" id="text_normal_black">Kelas</td>
            <td width="20"></td>
            <td>
            <?PHP
            $src_nama_kelas 	= "select * from kelas";
            $query_nama_kelas	= mysqli_query($mysql_connect, $src_nama_kelas) or die(mysqli_query($mysql_connect, ));
            ?>
            <select name="kelas">
            <option value="">Pilih</option>
            <?PHP
            while($row_nama_kelas = mysqli_fetch_array($query_nama_kelas, MYSQLI_ASSOC)) {
            ?>
            <option value="<?= $row_nama_kelas["nama_kelas"]; ?>"><?= $row_nama_kelas["nama_kelas"]; ?></option>
            <?PHP
            }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td align="right" id="text_normal_black">Periode</td>
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
    <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr id="text_normal_white" bgcolor="#333333" height="30">
            <td width="30" align="center">No</td>
            <td align="center">No Sisda</td>
            <td align="center">Nama siswa</td>
            <td align="center">Tingkat</td>
            <td align="center">Kelas</td>
            <td align="center">Periode</td>
        </tr>
<?PHP
	$bg = "#dfe5e6"; 
    $src_get_no_sisda = "select no_sisda,nama_siswa,kelas,tingkat,periode from siswa where no_sisda like '%$no_sisda%' and nama_siswa like '%$nama_siswa%' and kelas like '%$kelas%' and tingkat like '%$tingkat%' and periode like '%$src_periode%' and aktif = '1'";
    $query_get_no_sisda	= mysqli_query($mysql_connect, $src_get_no_sisda) or die(mysql_error());
    
    $i=0;
    while($get_no_sisda = mysqli_fetch_array($query_get_no_sisda, MYSQLI_ASSOC)) {
    
        $i++;
?>
        <tr bgcolor="<?= $bg; ?>" id="text_normal_black" height="25">
            <td align="center"><?= $i; ?></td>
            <td align="center"><?= $get_no_sisda["no_sisda"]; ?></td>
            <td><?= $get_no_sisda["nama_siswa"]; ?></td>
            <td align="center"><?= $get_no_sisda["tingkat"]; ?></td>
            <td align="center"><?= $get_no_sisda["kelas"]; ?></td>
            <td align="center"><?= $get_no_sisda["periode"]; ?></td>
        </tr>
<?PHP
        if($bg == "#dfe5e6") {
            $bg = "#d7d3c8";
        } else {
            $bg = "#dfe5e6";
        }
    }
	
}//session
?>

