function suggest(inputString1){
	if(inputString1.length == 0) {
		$('#suggestions1').fadeOut();
	} else {
	$('#nama_siswa').addClass('load1');
		$.post("include/auto_suggest_nama_siswa.php", {queryString1: ""+inputString1+""}, function(data){
			if(data.length >0) {
				$('#suggestions1').fadeIn();
				$('#suggestionsList1').html(data);
				$('#nama_siswa').removeClass('load1');
			}
		});
	}
}

function fill1(thisValue) {
	$('#nama_siswa').val(thisValue);
	setTimeout("$('#suggestions1').fadeOut();", 0);
}