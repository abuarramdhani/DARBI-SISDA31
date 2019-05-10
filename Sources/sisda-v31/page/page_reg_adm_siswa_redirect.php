<?PHP
//Why this file should be exist..??
//Because we have to work with two conditions (in page_reg_adm_siswa_next.php) which is every condition needs different page to proccess.
//1st condition if doprocess field exist, the page should go to the engine page, and sends the data to database, it means all data in form have been completed by user
//2nd condition if doprocess field is not exist, the page should be sent back to page_reg_adm_siswa_next.php, it means user still want to update the form
session_start();

if(isset($_SESSION["id"]) && $_SESSION["privilege"] == "2") {
	
	if(empty($_POST["doprocess"])) {
	
		$action = "../mainpage.php?pl=reg_adm_siswa_next#pulang_kampung";
		
	} else {
	
		$action = "../engine.php?case=reg_adm_siswa";
		
	}	
?>
    <form name="backto" action="<?PHP echo $action; ?>" method="post">
    <input type="hidden" name="nama_siswa" value="<?PHP echo $_POST["nama_siswa"]; ?>" />
    <input type="hidden" name="nama_ayah" value="<?PHP echo $_POST["nama_ayah"]; ?>" />
    <input type="hidden" name="nama_bunda" value="<?PHP echo $_POST["nama_bunda"]; ?>" />
    
    <input type="hidden" name="kat_status_anak" value="<?PHP echo $_POST["kat_status_anak"]; ?>" />
    <?PHP
	$cur_kat_stat_anak = $_POST["kat_status_anak"];
	
	if($cur_kat_stat_anak == "khusus") {
	?>
		<input type="hidden" name="value_khusus" size="35" value="<?PHP echo $_POST["value_khusus"]; ?>"/>
	<?PHP
	}
	
	$no_sisda = empty($_POST["no_sisda"]) ? "" : $_POST["no_sisda"];
	
	if($no_sisda != "") {
	?>
    <input type="hidden" name="no_sisda" value="<?= $no_sisda; ?>" />
    <?PHP
	}
	?>
    
    <input type="hidden" name="telp_ayah" value="<?PHP echo $_POST["telp_ayah"]; ?>" />
    <input type="hidden" name="telp_bunda" value="<?PHP echo $_POST["telp_bunda"]; ?>" />
    <input type="hidden" name="nama_sekolah_asal" value="<?PHP echo $_POST["nama_sekolah_asal"]; ?>" />
    <input type="hidden" name="stat_sekolah_asal" value="<?PHP echo $_POST["stat_sekolah_asal"]; ?>" />
    <input type="hidden" name="src_tanggal_daftar" value="<?PHP echo $_POST["src_tanggal_daftar"]; ?>" />
    <input type="hidden" name="jenjang" value="<?PHP echo $_POST["jenjang"]; ?>" />
    <input type="hidden" name="tingkat" value="<?PHP echo $_POST["tingkat"]; ?>" />
    <input type="hidden" name="bulan_terdaftar" value="<?PHP echo $_POST["bulan_terdaftar"]; ?>" />
    <input type="hidden" name="periode" value="<?PHP echo $_POST["periode"]; ?>" />
    <input type="hidden" name="shift_test" value="<?PHP echo $_POST["shift_test"]; ?>" />
    <input type="hidden" name="src_fase_1_date" value="<?PHP echo $_POST["src_fase_1_date"]; ?>" />
    <input type="hidden" name="src_fase_2_date" value="<?PHP echo $_POST["src_fase_2_date"]; ?>" />
    
    <?PHP
	//We have 2 conditions related to variable disc_cat_adm on page_reg_adm_siswa_next.php.
	//1. When the verification checkbox checked --> final_disc_cat_adm
	//2. When the verification checkbox unchecked --> disc_cat_adm
	$disc_cat_adm	= (empty($_POST["disc_cat_adm"])) ?  $_POST["final_disc_cat_adm"] : $_POST["disc_cat_adm"]; 
	?> 
    
	
    <input type="hidden" name="disc_cat_adm" value="<?PHP echo $disc_cat_adm; ?>" /> 
	<input type="hidden" name="pengembangan" value="<?PHP echo $_POST["pengembangan"]; ?>" />
    <input type="hidden" name="kegiatan" value="<?PHP echo $_POST["kegiatan"]; ?>" />
    <input type="hidden" name="peralatan" value="<?PHP echo $_POST["peralatan"]; ?>" />
    <input type="hidden" name="seragam" value="<?PHP echo $_POST["seragam"]; ?>" />
    <input type="hidden" name="paket" value="<?PHP echo $_POST["paket"]; ?>" />
    <input type="hidden" name="sub_total_bima" value="<?PHP echo $_POST["sub_total_bima"]; ?>" />
    
    <input type="hidden" name="spp" value="<?PHP echo $_POST["spp"]; ?>" />
    <input type="hidden" name="ict" value="<?PHP echo $_POST["ict"]; ?>" />
    <input type="hidden" name="ler" value="<?PHP echo $_POST["ler"]; ?>" />
    <input type="hidden" name="ks" value="<?PHP echo $_POST["ks"]; ?>" />
    <input type="hidden" name="sub_total_spp" value="<?PHP echo $_POST["sub_total_spp"]; ?>" />
    
    <input type="hidden" name="zakat_mal" value="<?PHP echo $_POST["zakat_mal"]; ?>" />
    <input type="hidden" name="zakat_profesi" value="<?PHP echo $_POST["zakat_profesi"]; ?>" />
    <input type="hidden" name="infaq_shodaqoh" value="<?PHP echo $_POST["infaq_shodaqoh"]; ?>" />
    <input type="hidden" name="wakaf" value="<?PHP echo $_POST["wakaf"]; ?>" />
    <input type="hidden" name="lain_lain" value="<?PHP echo $_POST["lain_lain"]; ?>" />
    </form>
    
    <script type="text/javascript" language="javascript">
	document.backto.submit();
	</script>
<?PHP	
} else {
	header("location:../index.php");
}
?>