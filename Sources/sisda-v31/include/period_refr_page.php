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

$year_1 	= ($cur_year-1)." - ".($cur_year);
$year_2 	= $cur_year." - ".($cur_year+1);
$year_3		= ($cur_year+1)." - ".($cur_year+2);

$the_value_1 = "mainpage.php?pl=spp_setting&periode=".$year_1."&j=".$_GET["j"];
$the_value_2 = "mainpage.php?pl=spp_setting&periode=".$year_2."&j=".$_GET["j"];
$the_value_3 = "mainpage.php?pl=spp_setting&periode=".$year_3."&j=".$_GET["j"];

$the_period	= !empty($_GET["periode"]) ? htmlspecialchars($_GET["periode"]) : "";
?>
<option value="<?PHP echo $the_value_1; ?>" <?PHP if($the_period == $year_1) { ?>selected="selected"<?PHP } ?>><?PHP echo $year_1; ?></option>
<option value="<?PHP echo $the_value_2; ?>" <?PHP if($the_period == $year_2) { ?>selected="selected"<?PHP } ?>><?PHP echo $year_2; ?></option>
<option value="<?PHP echo $the_value_3; ?>" <?PHP if($the_period == $year_3) { ?>selected="selected"<?PHP } ?>><?PHP echo $year_3; ?></option>
</select>
