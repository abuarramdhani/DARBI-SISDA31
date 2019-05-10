<?PHP
function cur_date() {
	//we have to set the time zone to jakarta, so we will get the current time absolutely the same with the PC's time.
	$timezone = new DateTimeZone("Asia/Jakarta");
	$date = new DateTime();
	$date->setTimezone($timezone);	

	//$cur_date is the date variable that using by other files.
	$cur_date = $date->format("Y-m-d H:i:s");
	
	//return this variable, so this $cur_date can be used from out (other files)
	return $cur_date;
}
?>