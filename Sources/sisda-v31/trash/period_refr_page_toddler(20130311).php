<?PHP
//yes, we have to refresh the page_spp_xxx_setting.php every period drop down menu selection changed. that why we use this javascript.


?>
<script language="JavaScript">
<!-- Script courtesy of http://www.web-source.net - Your Guide to Professional Web Site Design and Development
function goto(form) { var index=form.period.selectedIndex
if (form.period.options[index].value != "0") {
location=form.period.options[index].value;}}
//-->
</script>

<select name="period" ONCHANGE="goto(this.form)">
<option value="">Pilih</option>
<?PHP
for($period = 1; $period < 20; $period++) {	
    
	$period_bott 	= 2005+$period;
	$period_up		= 2006+$period;
	
	$used_period	= $period_bott." - ".$period_up;
	//and then, we must know the value of selected period every time the seletion change. Then we have to pass the variable period to url, so it can be retrieved by $_GET
	$the_value = "mainpage.php?pl=spp_toddler_setting&period=".$used_period;
	
	if (substr($_GET['period'],-13,13) == $used_period) {
		//and also, we have to keep the selection with current value is selected.	
		echo "<option value='$the_value' selected>$period_bott - $period_up</option>";
	} else {
		echo "<option value='$the_value'>$period_bott - $period_up</option>";
	}
}
?>
</select>
