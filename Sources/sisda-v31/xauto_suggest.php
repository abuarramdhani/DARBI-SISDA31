<link media="screen" type="text/css" rel="stylesheet" href="global_style/auto_suggest_form.css">
<script type="text/javascript" src="global_js/jquery_1.3.2.js"></script>
<script type="text/javascript" src="global_js/auto_suggest_form.js"></script>


<form id="form" action="#" style="padding:0px; ">
    <div id="suggest">Start to type a country: <br />
      <input type="text" size="25" value="" id="sisda_id" onkeyup="suggest(this.value);" onblur="fill();" class="" />
 
      <div class="suggestionsBox" id="suggestions" style="display: none; padding:0px;"> <!--<img src="arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />-->
        <div class="suggestionList" id="suggestionsList" style="padding:0px;"> &nbsp; </div>
      </div>
   </div>
</form>