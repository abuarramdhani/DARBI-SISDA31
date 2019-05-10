<?PHP
function user_priv($priv_no) {
	if($priv_no == 2) { $priv_expl = "Admin Finance"; }
	else if($priv_no == 3) { $priv_expl = "Finance"; }
	else if($priv_no == 4) { $priv_expl = "Admin Kepegawaian"; }
	else if($priv_no == 5) { $priv_expl = "Kepegawaian"; }
	else if($priv_no == 6) { $priv_expl = "TK"; }
	else if($priv_no == 7) { $priv_expl = "SD"; }
	else if($priv_no == 8) { $priv_expl = "SMP"; }
	else if($priv_no == 9) { $priv_expl = "ICT"; }
	else if($priv_no == 10) { $priv_expl = "Yayasan"; }
	
	return $priv_expl;
}
?>

