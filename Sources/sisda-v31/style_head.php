
<!-- sandy said: this is the style that makes any changes in backgroung image. why i seperated it with the main style file (css), it just because 
i need the file to be runnned in PHP, i have to generate the theme dynamically. okeh beibehhhhhh -->
<style type="text/css">
body		{ background:url(images/bg<?PHP echo $theme; ?>.png) repeat-x; background-color:#<?php echo $get_hexa["hexa"]; ?>; margin:0px; }
</style>