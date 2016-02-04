<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-mall | The online Shopping Store</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">


</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<script src="jquery.js" type="text/javascript"></script>
<title>Untitled Document</title>

<style>
body {
	background: #e2e2e2;
	margin: 0px;
	padding: 0px;
	color: #fff;
}
.popupInfo {
	display: none;
	padding: 100px;
	background: #000;
	border: 1px solid #1852fd;
	float: centre;
	font-size: 1.2en;
	position: fixed;
	top: 50%;
	left: 50%
	margin: -100px 0 0 -100px;
	z-index: 99999;
	box-shadow: 0px 0px 4px #1852fd;
	-moz-box-shadow: 0px 0px 4px #1852fd;
	-webkit-box-shadow: 0px 0px 4px #1852fd;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
}
#mask {
	display: none;
	background: #000;
	position: fixed;
	left: 0;
	top: 0;
	z-index: 88888;
	width: 100%;
	height: 100%;
	opacity: 0.95;
}

</style>
<script>
$(document).ready(function() {
	$('a.popup-window').click(function(){
		var popupBox = $(this).attr('href');
		$(popupBox).fadeIn(400);
		
		var popMargTop = ($(popupBox).height() +24) / 2;
	    var popMargLeft = ($(popupBox).width() +24) / 2;
		
		$(popupBox).css({
		 'margin-top' : -popMargTop,
		 'margin-left' : -popMargLeft
		});
		
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(400);
		return false;
		
    });
		$('button.close, #mask').live('click', function() {
		$('#mask , .popupInfo').fadeOut(400,function() {
			$('#mask').remove();		
		});
		return false;
	});
});

$(document).keyup(function(e) {
	if(e.keyCode == 27) {
		$('#mask, .popupInfo, #popup-box').fadeout(400);
		return false;
	}

});
</script>
</head>

<body>
<a href="#popup-box" class="popup-window">Click me! </a>

<div id="popup-box" class="popupInfo">
<form>
	<label>anything</label><br>
	<input type="text" name="random" /><br>
	<button type="button" class="close"> Click to close box </button>
</form>
</div>
</body>
</html>










<