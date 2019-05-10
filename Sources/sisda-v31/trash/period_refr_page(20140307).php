<?PHP
//yes, we have to refresh the page_spp_xxx_setting.php every periode drop down menu selection changed. that why we use this javascript.
?>
<script language="JavaScript">
<!-- Script courtesy of http://www.web-source.net - Your Guide to Professional Web Site Design and Development
function goto(form) { var index=form.periode.selectedIndex
if (form.periode.options[index].value != "0") {
location=form.periode.options[index].value;}}
//-->
</script>

<select name="periode" ONCHANGE="goto(this.form)">
<option value="">Pilih</option>
<?PHP
$cur_year	= date("Y");

$year_1 	= $cur_year." - ".($cur_year+1);
$year_2		= ($cur_year+1)." - ".($cur_year+2);

$the_value_1 = "mainpage.php?pl=spp_setting&periode=".$year_1."&j=".$_GET["j"];
$the_value_2 = "mainpage.php?pl=spp_setting&periode=".$year_2."&j=".$_GET["j"];

if($_GET["periode"] == $year_1) {
?>
	<option value="<?PHP echo $the_value_1; ?>" selected="selected"><?PHP echo $cur_year." - ".($cur_year+1); ?></option>
<?PHP
} else {
?>
	<option value="<?PHP echo $the_value_1; ?>"><?PHP echo $cur_year." - ".($cur_year+1); ?></option>
<?PHP
}

if($_GET["periode"] == $year_2) {
?>
	<option value="<?PHP echo $the_value_2; ?>" selected="selected"><?PHP echo ($cur_year+1)." - ".($cur_year+2); ?></option>
<?PHP
} else {
?>
	<option value="<?PHP echo $the_value_2; ?>"><?PHP echo ($cur_year+1)." - ".($cur_year+2); ?></option>
<?PHP
}
/*
$the_value = "mainpage.php?pl=spp_setting&periode=".$used_periode."&j=".$_GET["j"];

for($periode = 1; $periode < 20; $periode++) {	
    
	$periode_bott 	= 2005+$periode;
	$periode_up		= 2006+$periode;
	
	$used_periode	= $periode_bott." - ".$periode_up;
	//and then, we must know the value of selected periode every time the seletion change. Then we have to pass the variable periode to url, so it can be retrieved by $_GET
	$the_value = "mainpage.php?pl=spp_setting&periode=".$used_periode."&j=".$_GET["j"];
	
	if (substr($_GET['periode'],-13,13) == $used_periode) {
		//and also, we have to keep the selection with current value is selected.	
		echo "<option value='$the_value' selected>$periode_bott - $periode_up</option>";
	} else {
		echo "<option value='$the_value'>$periode_bott - $periode_up</option>";
	}
}
*/
?>
</select>
