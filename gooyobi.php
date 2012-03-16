<?php
$news=$_GET['news'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>GooHooBi - search Google, Yahoo and Bing in one go!</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
  <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/base/base.css" type="text/css">
<style type="text/css" media="screen">
html,body{color:#fff;background:#222;font-family:calibri,verdana,arial,sans-serif;}
h2{background:#369;padding:5px;color:#fff;font-weight:bold;-moz-box-shadow: 0px 4px 2px -2px #000;-moz-border-radius:5px;-webkit-border-radius:5px;text-shadow: #000 1px 1px;}
h3 a{color:#69c;text-decoration:none;}
form{font-size:150%;margin-top:-1.8em;}
h1{font-size:300%;margin:0;text-align:right;color:#3c3}
ul,ul li{margin:0;padding:0;list-style:none;}
p span{display:block;text-align:right;margin-top:.5em;font-size:90%;color:#999;}
input[type=text]{-moz-border-radius:5px;-webkit-border-radius:5px;border:1px solid #fff;padding:3px;}
input[type=submit]{-moz-border-radius:5px;-webkit-border-radius:5px;border:2px solid #3c3;background:#3c3}
.info{font-size:200%;color:#999;margin:1em 0;}
#ft p{color:#666;text-align:right;}
#ft a{color:#ccc;}
#yahoo a{color:#c6c;}
#yahoo h2{background:#c6c;}
#bing h2{background:#fc6;}
#bing a{color:#fc6;}
h3{margin:0 0 .2em 0}
</style>
</head>
<body>
<br>
<br>
<div id="doc" class="yui-t7">
  <div id="hd" role="banner"><h1></h1></div>
  <div id="bd" role="main">
    <form action="" method="post" id="mainform">
      <div>
        <label for="search"></label>
        <input type="hidden" id="search" name="search">
        
      </div>
    </form>
       <div class="yui-gb">
         <div class="yui-u first" id="google"></div>
         <div class="yui-u" id="yahoo"></div>
         <div class="yui-u" id="bing"></div>
       </div>
  </div>
  
</div>
<script type="text/javascript" charset="utf-8">
goohoobi = function(){
  var bing = document.getElementById('bing');
  var google = document.getElementById('google');
  var yahoo = document.getElementById('yahoo');
  function seed(o){
  
    if(o.query.results.results[0]){
    var res = o.query.results.results[0].NewsResult;
    var all = res.length;
    var out = '<h2>Bing</h2><ul>';
    for(var i=0;i<all;i++){
      out += '<li><h3><a href="'+res[i].Url+'">'+res[i].Title+'</a></h3><p>'+
              res[i].Snippet+'</p></li>';
    }
    out += '</ul>';
    bing.innerHTML = out;
  } else {
    bing.innerHTML = '<h2>Bing</h2><ul><li>\
<h3>No results found. </h3></li></ul>';
  };
  
  if(o.query.results.results[1]){
  
    var res = o.query.results.results[1].results;
    var all = res.length;
    var out = '<h2>Google</h2><ul>';
    for(var i=0;i<all;i++){
      out += '<li><h3><a href="'+res[i].url+'">'+res[i].titleNoFormatting+
             '</a></h3><p>'+res[i].content+'</p></li>';
    }
    out += '</ul>';
    google.innerHTML = out;
  }else{
    google.innerHTML = '<h2>Google</h2><ul><li>\
<h3>No results found. </h3></li></ul>';
  }


  if(o.query.results.results[2]){
  
    var boss = o.query.results.results[2].bossresponse;
    var all = boss.web.count;
    var res = boss.web.results.result;
    var out = '<h2>Yahoo</h2><ul>';
    for(var i=0;i<all;i++){
      out += '<li><h3><a href="'+res[i].url+'">'+res[i].title.content+
             '</a></h3><p>'+res[i].abstract.content+'</p></li>';
    }
    out += '</ul>';
    yahoo.innerHTML = out;
  }else{
    yahoo.innerHTML = '<h2>Yahoo</h2><ul><li>\
<h3>No results found. </h3></li></ul>';
  }

  }
  function doSearch(){
    google.innerHTML = '<h2>Google loading...</h2>';
    bing.innerHTML = '<h2>Bing loading...</h2>';
	yahoo.innerHTML = '<h2>Yahoo loading...</h2>';
    var query = document.getElementById('search').value;
  
              
    var url2 = 'select * from query.multi where queries=\'select '+
' * from microsoft.bing.news where query="Steve Jobs"  | truncate(count=4); SELECT * FROM google.news  WHERE q="steve jobs"; \'';
  var q=<?php echo '"'.$news.'"'?>;
  var url = 'select * from query.multi where queries=\'select  * from microsoft.bing.news where query="'+q+'"  | truncate(count=4); SELECT * FROM google.news  WHERE q="'+q+'"; SELECT * FROM boss.search WHERE ck="dj0yJmk9YWF3ODdGNWZPYjg2JmQ9WVdrOWVsWlZNRk5KTldFbWNHbzlNVEEyTURFNU1qWXkmcz1jb25zdW1lcnNlY3JldCZ4PTUz" and secret="a3d93853ba3bad8a99a175e8ffa90a702cd08cfa" and q="'+q+'" and count = 5; \'';
  
    var api ='http://query.yahooapis.com/v1/public/yql?q='+
             encodeURIComponent(url)+'&format=json&env=store'+
             '%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback='+
             'goohoobi.se&diagnostics=false';
    var s = document.createElement('script');
    s.setAttribute('src',api);
    document.getElementsByTagName('head')[0].appendChild(s);
  }
  
    doSearch();
  
  
  return {
    se:seed
  }
}();
</script>
</body>
</html>
