<?PHP
if(isset($_SESSION["id"]) && ($_SESSION["privilege"] == "2")) {

	$src_no_sisda  		= empty($_GET["no"]) ? "" : $_GET["no"];
	$no_sisda			= mysql_real_escape_string($src_no_sisda);
	
	$src_get_nama	= "select nama_siswa from siswa where no_sisda = '$no_sisda'";
	$query_get_nama	= mysqli_query($mysql_connect, $src_get_nama) or die(mysql_error());
	$get_nama		= mysql_fetch_array($query_get_nama);
	
	
?>
	 <table width="100%" border="0" cellpadding="0" cellspacing="1">
     	<tr>
            <td id="text_normal_black" colspan="2"><h1>History Pembayaran SPP</h1></td>
        </tr>
        <tr>
        	<td></td>
            <td id="text_normal_black">Nama siswa: <?= $get_nama["nama_siswa"]; ?></td>
        </tr>
        <tr>
        	<td></td>
            <td id="text_normal_black">No Sisda: <?= $no_sisda; ?></td>
        </tr>
        <tr>
        	<td colspan="2" height="20"></td>			
        </tr>        
    </table>
<?PHP
	$bg = "#dfe5e6"; 
    $src_get_data 	= "select * from transaksi where no_sisda = '$no_sisda' and (spp_spp != '0' or ict_spp  != '0' or elearning_spp != '0' or ks_spp != '0')";
    $query_get_data	= mysqli_query($mysql_connect, $src_get_data) or die(mysql_error());
	$num_get_data	= mysql_num_rows($query_get_data);
	
	if($num_get_data == 0) {
?>	
	 <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="1">
        <tr id="text_normal_white" bgcolor="#006699" height="30">
            <td width="30" align="center"><span id='text_normal_white'><h1>Data tidak ditemukan</h1></span></td>
        </tr>
     </table>
		
        	
<?PHP	
	} else {
?>    
    <table width="100%" border="0" cellpadding="0" cellspacing="1">
        <tr id="text_normal_white" bgcolor="#333333" height="30">
            <td width="30" align="center">No</td>
            <td align="center">Periode</td>
            <td align="center">No Transaksi</td>
            <td align="center">Kasir</td>
            <td align="center">Tanggal Transaksi</td>
            <td align="center">Kelas</td>
            <td align="center">Teknik Pembayaran</td>
            <td align="center">Tanggal Transfer</td>
            <td align="center">Bank</td>
            <td align="center">SPP</td>
            <td align="center">ICT</td>
            <td align="center">E-Learning</td>
            <td align="center">KS</td>
        </tr>
        
<?PHP	
	
    
		$i=0;
		while($get_data = mysql_fetch_array($query_get_data)) {
		
			$i++;
?>
        <tr bgcolor="<?= $bg; ?>" id="text_normal_black" height="25">
            <td align="center"><?= $i; ?></td>
            <td align="center"><?= $get_data["periode"]; ?></td>
            <td><?= $get_data["no_trs"]; ?></td>
            <td align="center"><?= $get_data["kasir"]; ?></td>
            <td align="center"><?= $get_data["tanggal_transaksi"]; ?></td>
            <td align="center"><?= $get_data["kelas"]; ?></td>
            <td align="center"><?= $get_data["teknik_pembayaran"]; ?></td>
            <td align="center"><?= $get_data["tanggal_transfer"]; ?></td>
            <td align="center"><?= $get_data["bank_tujuan"]; ?></td>
            <td align="center"><?= $get_data["spp_spp"]; ?></td>
            <td align="center"><?= $get_data["ict_spp"]; ?></td>
            <td align="center"><?= $get_data["elearning_spp"]; ?></td>
            <td align="center"><?= $get_data["ks_spp"]; ?></td>
        </tr>
<?PHP
			if($bg == "#dfe5e6") {
				$bg = "#d7d3c8";
			} else {
				$bg = "#dfe5e6";
			}
		}
	
	}
	
}//session
?>

