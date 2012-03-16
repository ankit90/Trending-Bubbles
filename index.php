<?php
$country=$_GET['country'];
if($country!='india' && $country!='usa' && $country!='australia')
{
    $country="world";
}
$homepage = file_get_contents('http://baba-job.appspot.com/Trends?country='.$country);
/*$homepage = file_get_contents('tweet'.$country);*/
$homepage = str_replace("'","\'",$homepage);
$homepage = str_replace('"','\"',$homepage);
$homepage = str_replace("\n","",$homepage);
?>
<!DOCTYPE html>
<html>

  <head>
    <title>Yahoo Hack U</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="processing-1.3.5.js"></script>
	 <script type="text/javascript" src="jquery.js"></script>
	  <script type="text/javascript" src="captify.tiny.js"></script>
	  <link rel="stylesheet" type="text/css" href="main.css">
    <!--
        This is a source-file-less sketch, loaded from inline source code in
        the html header. This only works if the script specifies a data-processing-target
    -->


<script type="text/processing" data-processing-target="targetcanvas">
       
	  
	  $('.target').change(function() {
        alert('Handler for .change() called.');
	    });
 int fontsize = 24;

 
int numBalls = 10;
int ballnum = -1;
float spring = 0.05;
float gravity = 0.02;
int pressed =0;
Ball[] balls = new Ball[numBalls];
float prev_vx;
float prev_vy;

float minx =1270;
float maxx=0;
 
//global var for tweet
int numTweets=10; 
String url="Trends.html";
int reload=1;

void setup() 
{
	/*WebRequest req = HttpWebRequest.Create("http://");
	WebResponse webResponse = req.GetResponse();
	webResponse.*/
  size(1270, 630);
  noStroke();
  smooth();
  
  if(reload==1){
  for (int i = numBalls-3; i < numBalls; i++) {
    balls[i] = new Ball(random(width), random(height), 15*sqrt(3), i, balls);
  }
  for (int i = 0; i < numBalls-3; i++) {
	  balls[i] = new Ball(random(width), random(height), 15*sqrt(numBalls-i), i, balls);
  }
    

    /* String beginStr="";
	$.get(url, function(data) {
    String [] res2 = data.split("body>");
	String [] res = res2[1].split("<br>");
	
    for(int j=0;j<numBalls;j++){
	    balls[j].head = res[12*j];
	    for(int k=0; k<numTweets;k++){
		    balls[j].Tweets[k]= res[(12*j)+k+1];
	    }
    }
    });*/
       String tempstr=""; 
       
       tempstr=<?php echo '"'.$homepage.'"'?>;
	/*String [] res2 = tempstr.split("body>");*/
	String [] res = tempstr.split("<br>");
	
    for(int j=0;j<numBalls;j++){
	    balls[j].head = res[12*j];
	    for(int k=0; k<numTweets;k++){
		    balls[j].Tweets[k]= res[(12*j)+k+1];
	    }
    } 

 }
}

void draw() 
{
  
  background(80,89,100);
  for (int i = 0; i < numBalls; i++) {
    balls[i].collide();
    balls[i].move();
    balls[i].display();  
  }
}

void mouseMoved(){

if(pressed==0){
int x= mouseX;
int y = mouseY;
	
	for(int i=0;i<numBalls;i++){
		float x1=x - balls[i].x;
		float y1=y - balls[i].y;
		if((x1*x1)+(y1*y1)<(balls[i].diameter *balls[i].diameter)/4 )
		{	
			
			ballnum = i;
			//pressed =1;
			prev_vx=balls[ballnum].vx;
			prev_vy=balls[ballnum].vy;
			balls[ballnum].vx=0;
			balls[ballnum].vy=0;
			int angle = Math.floor(((Math.atan(y1/x1)+(Math.PI/2))/(Math.PI))*10); 
			
			document.getElementById("Tweet").innerHTML = "<div id=\"new\"><strong><u style=\"font-family:verdana;\"><i>"+balls[ballnum].head+"</i></u></strong><br></br> "+balls[ballnum].Tweets[angle]+"</div>";
			
			int leng = balls[ballnum].head.length()+balls[ballnum].Tweets[angle].length();
			
			$('#Tweet').css('top',mouseY+30);
			$('#Tweet').css('left',mouseX+30);		
			$('#Tweet').css('height',(((leng/30)+1)*25)+26);
			$('#Tweet').css('display',"block");
			break;
		}
	}
		float x11=x - balls[ballnum].x;
		float y11=y - balls[ballnum].y;
		if((x11*x11)+(y11*y11)>=(balls[ballnum].diameter *balls[ballnum].diameter)/4 )
		{
			$('#Tweet').css('display',"none");
		}
		/*else
		{
			if(ballnum==i)
			{
				
				balls[ballnum].vx=prev_vx;
				balls[ballnum].vy=prev_vy;
				ballnum=-1;
			}
		}*/
		
}
if(pressed==1)
{
				if(minx>mouseX)
				{
					minx=mouseX;
				}
				if(maxx<mouseX)
				{
					maxx=mouseX;
				}
				if(maxx-minx>1200){
                                     String pass = balls[ballnum].head;
                                     String com = ((balls[ballnum].head).charAt(0))+"";
                                     if(com.equals("#")){
                                        pass = pass.substring(1);
                                     }
                window.location = "trend.php?ball="+pass+"&country=<?php echo $country?>";
				}
else{  
  $('#Tweet').css('display',"none");
	balls[ballnum].x=mouseX;
	balls[ballnum].y=mouseY;
	balls[ballnum].vx=0;
	balls[ballnum].vy=0;
  }
 }
}

void mousePressed(){

if(pressed==1)
{
	pressed=0;
	balls[ballnum].vx=Math.random()*7;
			balls[ballnum].vy=Math.random()*7;
	}
	else{
		pressed=1;
		$('#Tweet').css('display',"none");
	}
}



class Ball {
  float x, y;
  float diameter;
  float vx = 0;
  float vy = 0;
  int id;
  float r1;
  float r11;
  float r2;
  float r21;
  float r3;
  float r31;
  float r4;
  float r41;
  Ball[] others;
  int red=-1;
  int green=-1;
  int blue=-1;
  String [] Tweets = new String [numTweets];
  String head;
  
  Ball(float xin, float yin, float din, int idin, Ball[] oin) {
    x = xin;
    y = yin;
int i = Math.floor(Math.random()*4);
switch(i){
case 0 :vx=Math.random()*3;
	vy=Math.random()*3;
        break;
case 1 :vx=0-Math.random()*3;
	vy=0-Math.random()*3;
        break;
case 2 :vx=0-Math.random()*3;
	vy=Math.random()*3;
        break;
case 3 :vx=Math.random()*3;
	vy=0-Math.random()*3;
        break;
}	
    diameter = din*3;
    id = idin;
    others = oin;
  } 
  
  void collide() {
    for (int i = id + 1; i < numBalls; i++) {
      float dx = others[i].x - x;
      float dy = others[i].y - y;
      float distance = sqrt(dx*dx + dy*dy);
      float minDist = others[i].diameter/2 + diameter/2;
      if (distance < minDist) { 
        float angle = atan2(dy, dx);
        float targetX = x + cos(angle) * minDist;
        float targetY = y + sin(angle) * minDist;
        float ax = (targetX - others[i].x) * spring;
        float ay = (targetY - others[i].y) * spring;
        vx -= ax;
        vy -= ay;
        others[i].vx += ax;
        others[i].vy += ay;
      }
    }   
  }
  
  void move() {
if((635-x)!=0)
{
    vx += ((635-x)/Math.abs(635-x))*gravity;
}
else{
    vx = 0;
}
if((315-y)!=0)
{
    vy += ((315-y)/Math.abs(315-y))*gravity;
}
else{
    vy=0;
}
    x += vx;
    y += vy;
    if (x + diameter/2 > width) {
      x = width - diameter/2;
      vx += -0.9; 
    }
    else if (x - diameter/2 < 0) {
      x = diameter/2;
      vx *= -0.9;
    }
    if (y + diameter/2 > height) {
      y = height - diameter/2;
      vy *= -0.9; 
    } 
    else if (y - diameter/2 < 0) {
      y = diameter/2;
      vy *= -0.9;
    }
  }
  

  
  void display() {
   
  fill(55,65,66);  
    ellipse(x, y, diameter, diameter);
	if(red==-1)
	{
	switch(id%4)
	{
	case 0 : red=138;
		green=43;
		blue=226;
		break;
	case 1 : red=123;
		green=104;
		blue=238;
		break;
	case 2 : red=218;
		green=165;
		blue=32;
		break;
	case 3 : red=124;
		green=252;
		blue=0;
		break;
	}
		
		r1 = (Math.random()/10 +0.7 )* diameter/2;
		r11 = ((Math.random()/20)+0.95) * ((diameter/2)-r1);
		r2 = (Math.random()/10 +0.45 ) * diameter/2;
		r21 = ((Math.random()/20)+0.95)* ((diameter/2)-r2);
		r3 = (Math.random()/10 +0.5 )* diameter/2;
		r31 = ((Math.random()/20)+0.95)* ((diameter/2)-r3);
		r4 = (Math.random()/10 +0.3 )* diameter/2;
		r41 = ((Math.random()/20)+0.95)* ((diameter/2)-r4);
		r42 = (Math.random()/10 +0.2 )* diameter/2;
		r412 = ((Math.random()/20)+0.95)* ((diameter/2)-r42);
		
	}
	
	int corX=x,corY=y;
	int dia=diameter/3;
	
	//for(int i=0;i<10;i++)
	//{
		
		fill(red,green,blue);
		//ellipse(corX,corY,dia, dia);
		
		ellipse(corX+(r11*0.2),corY+(r11*0.2),r1, r1);
		fill(red+50,green,blue);
		ellipse(corX-(r21*0.9),corY+(r21*0.9),r2, r2);
		fill(red,green+50,blue);
		ellipse(corX-(r31*0.99),corY-(r31*0.99),r3, r3);
		fill(red,green,blue+50);
		ellipse(corX+(r41),corY-(r41*0.1),r4, r4);
		fill(red+50,green+50,blue+50);
		ellipse(corX+(r41*0.85),corY-(r41*0.85),r4, r4);
		fill(red,green+50,blue+50);
		ellipse(corX-(r41),corY+(r41*0.05),r4, r4);
		fill(red+50,green,blue+50);
		ellipse(corX,corY+(r41),r4, r4);
		fill(red+50,green,blue+50);
		ellipse(corX,corY-(r41),r4, r4);
		fill(red+30,green,blue+100);
		ellipse(corX+(r41*0.9),corY+(r41*0.9),r4, r4);
		//int a=(3*diameter/8) * Math.random();
		//corY = corY+(a+(diameter/8));
		//corX = corX;
		//dia=a*2;
		//ellipse(corX,corY,dia, dia);
	//}
  }
}

    </script>
  </head>

  <body style="background:#505964">
 <div id = "list-full"style="color:white;font-size:10px;font-family:verdana">
<ul id="list-nav">
<?php if($country=="world")
{?>
<li ><a style="background:#a2b3a1;color:#000" href="index.php?country=world">World</a></li>
<?php }else {?>
<li ><a href="index.php?country=world">World</a></li>
<?php } if($country=="india")
{?>
<li ><a style="background:#a2b3a1;color:#000" href="index.php?country=india">India</a></li>
<?php }else {?>
<li ><a href="index.php?country=india">India</a></li>
<?php }if($country=="australia")
{?>
<li ><a style="background:#a2b3a1;color:#000" href="index.php?country=australia">Australia</a></li>

<?php } else {?>
<li><a href="index.php?country=australia">Australia</a></li>
<?php }if($country=="usa")
{?>
<li ><a style="background:#a2b3a1;color:#000" href="index.php?country=usa">USA</a></li>
<?php } else { ?>
<li><a href="index.php?country=usa">USA</a></li>
<?php } ?>
</ul>
</div>
    <canvas  id="targetcanvas" style="outline: none;" ></canvas>
	<div id="Tweet"><div id="new"> This is not a big Tweet </div></div>
	<div id="footer" style="color:white;font-size:10px;font-family:verdana"> Designed By : <strong  ><i>Ankit Tomar, Anuj Chauhan, Saurav Mahajan, Swapnil Jain</i></strong> </div>
	<div id="swipe" style="color:white;font-size:13px;font-family:verdana">Click On A Bubble And Take It From Left To Right To Go To Its Info Page </div>
  </body>
</html>
