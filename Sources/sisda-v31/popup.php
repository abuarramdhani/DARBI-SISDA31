<?PHP
session_start();

if(isset($_SESSION["id"])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<title></title>
<link media="screen" type="text/css" rel="stylesheet" href="style.css">
<script type="text/javascript" src="pngFix/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="pngFix/pluginpage.js"></script>

	<script type="text/javascript" src="pngFix/jquery.pngFix.pack.js"></script>
	
<script type="text/javascript">
	$(document).ready(function(){
		$('div.examples').pngFix( );
	});
</script>

<!-- Chili the jQuery code highlighter plugin -->
<script type="text/javascript" src="pngFix/chili/chili.pack.js"></script>
<script id="setup" type="text/javascript">
ChiliBook.recipeFolder     = "pngFix/chili/";
ChiliBook.stylesheetFolder = "pngFix/chili/";
</script>
</head>
<?PHP include ("sisda-config.php"); ?>
<body>
<?PHP
//lp = loading page hahahahahahaha...:))
if(!isset($_GET["pl"])) {
?>
<span id="text_welcome">Assalamualaikum <?PHP echo ucwords($row_name["name"]); ?><br />Selamat datang kembali</span>
<?PHP
} else {
	if($_GET["pl"] != "") {
		if(file_exists("page/page_".$_GET["pl"].".php")) {
			include("page/page_".$_GET["pl"].".php");
		}
	}
}
?>
</body>
</html>
<?PHP
}
?>
