<?PHP
//$srch_nama_siswa 	= mysql_real_escape_string($_GET['nama_siswa']);
$srch_jenjang 		= mysql_real_escape_string($_GET['jenjang']);
$srch_tingkat 		= mysql_real_escape_string($_GET['tingkat']);			  
$srch_no_sisda 		= mysql_real_escape_string($_GET['no_sisda']);
$srch_periode 		= mysql_real_escape_string($_GET['periode']);
$type				= mysql_real_escape_string($_GET['t']);
?>

<form method="post" name="edit_nominal" action="../mainpage.php?pl=edit_nominal_special_case_<?= $type; ?>">

<input type="hidden" value="<?= $srch_jenjang; ?>" name="jenjang" />
<input type="hidden" value="<?= $srch_tingkat; ?>" name="tingkat" />
<input type="hidden" value="<?= $srch_periode; ?>" name="periode" />
</form>

<script type="text/javascript" language="javascript">
document.edit_nominal.submit();
</script>