<?PHP
/*<form name="classic">
<select name="countries" size="4" onChange="updatecities(this.selectedIndex)" style="width: 150px">
<option selected>Select A City</option>
<option value="usa">USA</option>
<option value="canada">Canada</option>
<option value="uk">United Kingdom</option>
</select>

<select name="cities" size="4" style="width: 150px" onClick="alert(this.options[this.options.selectedIndex].value)">
</select>
</form>

<script type="text/javascript">

var countrieslist=document.classic.countries
var citieslist=document.classic.cities

var cities=new Array()
cities[0]=""
cities[1]=["New York|newyorkvalue", "Los Angeles|loangelesvalue", "Chicago|chicagovalue", "Houston|houstonvalue", "Austin|austinvalue"]
cities[2]=["Vancouver|vancouvervalue", "Tonronto|torontovalue", "Montreal|montrealvalue", "Calgary|calgaryvalue"]
cities[3]=["London|londonvalue", "Glasgow|glasgowsvalue", "Manchester|manchestervalue", "Edinburgh|edinburghvalue", "Birmingham|birminghamvalue"]

function updatecities(selectedcitygroup){
citieslist.options.length=0
if (selectedcitygroup>0){
for (i=0; i<cities[selectedcitygroup].length; i++)
citieslist.options[citieslist.options.length]=new Option(cities[selectedcitygroup][i].split("|")[0], cities[selectedcitygroup][i].split("|")[1])
}
}

</script>
*/?>

<form name="classic">
    <select name="countries" size="4" onChange="updatecities(this.selectedIndex)" style="width: 150px">
        <option selected>Select A City</option>
        <option value="usa">USA</option>
        <option value="canada">Canada</option>
        <option value="uk">United Kingdom</option>
    </select>

    <select multiple name="cities[]" size="4" style="width: 150px">
    </select>
</form>

<script type="text/javascript">

    var countrieslist=document.classic.countries;
    var citieslist=document.classic['cities[]'];

    var cities=new Array()
    cities[0]=""
    cities[1]=["New York|newyorkvalue", "Los Angeles|loangelesvalue", "Chicago|chicagovalue", "Houston|houstonvalue", "Austin|austinvalue"]
    cities[2]=["Vancouver|vancouvervalue", "Tonronto|torontovalue", "Montreal|montrealvalue", "Calgary|calgaryvalue"]
    cities[3]=["London|londonvalue", "Glasgow|glasgowsvalue", "Manchester|manchestervalue", "Edinburgh|edinburghvalue", "Birmingham|birminghamvalue"]

    function updatecities(selectedcitygroup){
        citieslist.options.length=0
        if (selectedcitygroup>0){
            for (i=0; i<cities[selectedcitygroup].length; i++) {
                citieslist.options[citieslist.options.length]=new Option(cities[selectedcitygroup][i].split("|")[0], cities[selectedcitygroup][i].split("|")[1])
            }
        }
    }

</script>