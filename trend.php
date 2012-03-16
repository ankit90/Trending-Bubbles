<?php
$ball=$_GET['ball'];
$country=$_GET['country'];
$ball= str_replace ("#","",$ball);
$ball_2=urlencode ($ball);
?>
<html>
<head>
<title>Trend Bubble - <?php echo $ball?></title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script src="jqFlick.js"></script>

<link rel="stylesheet" type="text/css" href="jqFlick.css" />
<script type="text/javascript">
var output = null;
function showMyVideos(dat) {
  output = "http://www.youtube.com/embed/"+(dat.data.items[0].id);
  $("#url").attr('src',output);
}
</script>
<script type = "text/javascript">
$(document).ready(function(){

	// Paste your Flickr API key here
	var apiKey = 'f48b8900b772fafb4d6653abc1e2bac4';

	// Creating a flickr slider. This is
	// how you would probably use the plugin.

	$('#flickrSlider').jqFlick({
		photosetID: <?php echo "'".$ball."'"?> ,
		width:345,
		height:320,
		autoAdvance:true,
		apiKey:apiKey
	});
});
</script>

<style type="text/css">

/* search form 
-------------------------------------- */
.searchform {
	display: inline-block;
	zoom: 1; /* ie7 hack for display:inline-block */
	*display: inline;
	border: solid 1px #d2d2d2;
	padding: 3px 5px;
	
	-webkit-border-radius: 2em;
	-moz-border-radius: 2em;
	border-radius: 2em;

	-webkit-box-shadow: 0 1px 0px rgba(0,0,0,.1);
	-moz-box-shadow: 0 1px 0px rgba(0,0,0,.1);
	box-shadow: 0 1px 0px rgba(0,0,0,.1);

	background: #f1f1f1;
	background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));
	background: -moz-linear-gradient(top,  #fff,  #ededed);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed'); /* ie7 */
	-ms-filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed'); /* ie8 */
}
.searchform input {
	font: normal 12px/100% Arial, Helvetica, sans-serif;
}
.searchfield {
	background: #fff;
	padding: 6px 6px 6px 8px;
	width: 202px;
	border: solid 1px #bcbbbb;
	outline: none;
	-webkit-border-radius: 2em;
	-moz-border-radius: 2em;
	border-radius: 2em;
	-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,.2);
	-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.2);
	box-shadow: inset 0 1px 2px rgba(0,0,0,.2);
}
.searchbutton {
      
	color: #fff;
	border: solid 1px #494949;
	font-size: 11px;
	height: 27px;
	width: 27px;
	text-shadow: 0 1px 1px rgba(0,0,0,.6);

	-webkit-border-radius: 2em;
	-moz-border-radius: 2em;
	border-radius: 2em;

	background: #5f5f5f;
	background: -webkit-gradient(linear, left top, left bottom, from(#9e9e9e), to(#454545));
	background: -moz-linear-gradient(top,  #9e9e9e,  #454545);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#9e9e9e', endColorstr='#454545'); /* ie7 */
	-ms-filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#9e9e9e', endColorstr='#454545'); /* ie8 */
}
</style>


</head>
<body bgcolor="#222">
<div id="heading" style="text-align:center;color:#fc6;font-size:55px;padding-top:30px;"> Trending <font style="color:#369;font-size:55;"> Bubbles</font></div>
<img style="position:absolute;margin-top:-370px;margin-left:50px" src="bubble.png"/>
<div style="position:absolute;left:900px;margin-top:-80px;">
<form class="searchform" method="get"  action="trend.php?country=<?php echo $country?>">
	<input class="searchfield" type="text" name="ball" value="Search..." onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}" />
	<input class="searchbutton" type="submit" value="Go" />
</form>
</div>
<div id="search" style="padding-top:20px;padding-left:50px" >
<iframe  src="gooyobi.php?news=<?php echo $ball?>" height="500px" width="770px"  frameborder="0" scrolling="no"></iframe>  
</div>
<div id="wikipedia" style="float:right;margin-top: -477px; padding-right: 60px;">
<div id="strip" style="	font-size:15px;background : #336699;height:23px;padding-top:6px;padding-left:6px;width: 350px;border-radius : 7px;color:white"><strong> Wikipedia</strong></div>
<div style="padding-top:10px;">
<iframe  src="http://baba-job.appspot.com/Wikipedia?name=<?php echo $ball?>&country=<?php echo $country?>" height="800" width="350" frameborder="1" scrolling="no" > </iframe>    
</div>
</div>
<br>
<div id="yotube" style="float:right;padding-top:30px;padding-right:40px;">
<div id="strip" style="	font-size:15px;background : #336699;height:23px;padding-top:6px;padding-left:6px;width: 344px;border-radius : 7px;color:white"><strong> YouTube</strong></div>
<div style="padding-top:10px;">
<iframe id="url" class="youtube-player" type="text/html" width="350" height="280" src="http://www.youtube.com/embed/UF8uR6Z6KLc" frameborder="0"></iframe>	
</div>
<script 
    type="text/javascript" 
    src="https://gdata.youtube.com/feeds/api/videos?q=<?php echo $ball?>&v=2&alt=jsonc&callback=showMyVideos">
</script>
</div>
<br>
<div id="trends" style="float:left;padding-top:10px;padding-left:50px;">
<div id="strip" style="	font-size:15px;background : #336699;height:23px;padding-top:6px;padding-left:6px;width: 344px;border-radius : 7px;color:white"><strong> Google Trends</strong></div>
<div style="padding-top:10px;">
<iframe style="" src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/trends_gadget.xml&amp;source=imag&amp;up_is_init=true&amp;up_cur_term=<?php echo $ball_2?>&amp;up_date=mtd&amp;up_region=all" style="padding:10px;" width="350" height="278" frameborder="0" scrolling="no"></iframe>
</div>
</div>
<br>
<div style="float: left; padding-top:20px;padding-left:47px;" >
<div id="strip8" style ="font-size:15px;height:23px;background : #336699;padding-top:6px;padding-left:6px;width: 1135px;border-radius : 7px;color:white"> <strong> Flickr Photos</strong></div>
<?php
$yql_url = 'http://query.yahooapis.com/v1/public/yql?';
$query = 'SELECT * FROM flickr.photos.search WHERE api_key="f48b8900b772fafb4d6653abc1e2bac4" AND sort="relevance" AND text='.'"'.$ball.'"'.'LIMIT 8';
$query_url = $yql_url . 'q=' . urlencode($query) . '&format=xml';

$photos = simplexml_load_file($query_url);
$result = build_photos($photos->results->photo);
echo $result;

function build_photos($photos){
    $html = '';
    if (count($photos) > 0){
        foreach ($photos as $photo){
            $html .= "<a href='http://www.flickr.com/photos/{$photo['owner']}/{$photo['id']}' target='_blank'><img src='http://farm4.static.flickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}.jpg' style='padding:2px' width='138' height='138' alt='{$photo['title']}' /></a>";
        }
    } else {
        $html .= 'No Photos Found';
    }
    return "<div style='padding-top:8px'>".$html."</div>";
}
?>
</div>
<br>

</body>
</html>
