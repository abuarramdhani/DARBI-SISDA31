<?PHP
//you have to put the <select name="date"> and </select> before and after the include tag, in the page that call this page.
//why it should be like this, because you have to define var name="xxxxx" uniquely, in every field that use this cur_date_opt.php

//We have 3 conditions in using this function:
//1. No date are selected
//2. A date is selected as current date
//3. A date is selected as defined

//Define the condition by checking whether $src_not_cur true or false
//If it's 'false', it means the chance are between condition 2 or 3
//If it's 'True', it's number one
$not_cur = (!isset($src_not_cur) ? false : true);

//If it's true, we have to put no valued option at the first options list
if($not_cur == true) {
	echo "<option value=''>tanggal</option>";
}

//Check whether $defined_date exist or not
//If $defined_date exist, it is meaning the function goes to condition 3
//If it does not exist, ......... condition 2 :)
$opt_cur_date = (!isset($defined_date)) ? date("d") : $defined_date;
	
//So here we go, babe.......		
for($opt_date = 1; $opt_date < 32; $opt_date++) {
	if($not_cur == true) {
		if(!isset($defined_date)) {
			echo "<option value='$opt_date'>$opt_date</option>";
		} else {
			if($opt_date == $opt_cur_date) {
				echo "<option value='$opt_date' selected>$opt_date</option>";
			} else {
				echo "<option value='$opt_date'>$opt_date</option>";
			}
		}
	} else {
		if($opt_date == $opt_cur_date) {
			echo "<option value='$opt_date' selected>$opt_date</option>";
		} else {
			echo "<option value='$opt_date'>$opt_date</option>";
		}
	}
}


//Now we do not need these variables anymore, even, if we keep it "true", it will make any confuse for another "date function".
//Let's make it "false" now
if(isset($src_not_cur)) {
	$src_not_cur = false;
	
	if(isset($defined_date)) {
		$defined_date = false;
	}
}

//i Know that you want to say if this logic is strange, weird, contradiction or something like that.
//you right, it is. Because at the beginning, this page have 1 function only, that is 'option selected as current date'.
//But by the time being, we need the other conditions. I can't modify this page 100%, because the old function in this page has been used by other pages.
//What i have to do is make it into 3 conditions like above.   
?>