<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="temp.css" type="text/css" rel="stylesheet" />
<title>Untitled Document</title>
<script src="jquery.js" type="text/javascript"></script>
<style>
body {
	background: #999;
	margin: 0px;
	padding: 0px;
	color: #fff;
}
.popupInfo {
	display: none;
	padding: 10px;
	background: #000;
	border: 1px solid #1852fd;
	float: left;
	font-size: 1.2en;
	position: fixed;
	top: 50%;
	left: 50%;
	margin: -100px 0 0 -100px;
	z-index: 99999;
	box-shadow: 0px 0px 4px #1852fd;
	-moz-box-shadow: 0px 0px 4px #1852fd;
	-webkit-box-shadow: 0px 0px 4px #1852fd;
	border-radius: 0px;
	-moz-border-radius: 0px;
	-webkit-border-radius: 0px;
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
<div id="popup-box" class="popupInfo">
<h1>Welcome to E-mall! The one click shopping store..</h1>
<div class="column1">
<h4>Login and shop with the best offers</h4>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="150" border="0">
  <tr>
    <th width="70" scope="row">Username</th>
    <td width="90"><form id="form1" name="form1" method="post" action="">
      <label for="textfield"></label>
      <input type="text" name="textfield" id="textfield" />
    </td>
  </tr>
  <tr>
    <th scope="row">Password</th>
    <td><form id="form2" name="form2" method="post" action="">
      <label for="textfield2"></label>
      <input type="text" name="textfield2" id="textfield2" />
    </td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td><form id="form3" name="form3" method="post" action="">
      <input type="submit" name="button" id="button" value="Login" />
    </form></td>
  </tr>
</table>
</div>
<div class="column2" align="centre">
     <h5> Signup and get the experience of a lifetime</h5>
            <form  id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<table width="250" cellspacing="0" cellpadding="10">
  <tr>
    <td width="123">First Name</td>
    <td width="200"><label for="text1"></label>
      <input type="text" name="text1" id="text1" />
      
    </td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><label for="text2"></label>
    <input type="text" name="text2" id="text2" />
    </td>
  </tr>
  <tr>
    <td>E-Mail id</td>
    <td><label for="textfield11"></label>
      <input type="text" name="textfield8" id="textfield" /></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><label for="textfield11"></label>
      <input type="text" name="textfield9" id="textfield" /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><label for="textfield11"></label>
      <input type="text" name="textfield10" id="textfield" /></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Submit" /></td>
  </tr>
</table>
<input type="hidden" name="MM_insert" value="form1" />
        </form>        	
</div>

<div class="footer"><button type="button" class="close"> Click to close box </button></div>
</div>

</body>
</html>