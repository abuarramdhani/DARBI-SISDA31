<?PHP
echo "<option value=''>Bulan</option>";

$opt_cur_month = date("m");

for($opt_month = 1; $opt_month < 13; $opt_month++) {
			
	echo "<option value='$opt_month'>$opt_month</option>";
}
?>