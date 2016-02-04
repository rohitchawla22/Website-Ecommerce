<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Mall - Products</title>
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

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>E-Mall</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | <a href="#">Log In</a> | <a href="#">Sign up</a></p>
          <p>
           	  Shopping Cart: <strong>3 items</strong> ( <a href="shoppingcart.html">Show Cart</a> )
        </p>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.html" class="selected">Home</a></li>
                <li><a href="#">ENTERTAINMENT</a>
                    <ul>
                        <li><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movies">Movies</a></li>
                        
                  </ul><!-- end inner ul -->
                </li>
                <li><a href="#">Hard Goods products</a>
                	<ul>
                    	<li><a href="dynamicproduct.php?type=Laptop">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Games">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Softwares">Softwares</a></li>
                         </ul>
                 </li>
                <li><a href="about.html">About</a>
                    <ul>
                        <li><a href="http://www.templatemo.com/page/1">Sub menu 1</a></li>
                        <li><a href="http://www.templatemo.com/page/2">Sub menu 2</a></li>
                        <li><a href="http://www.templatemo.com/page/3">Sub menu 3</a></li>
                  </ul>
                </li>
                <li></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="#" method="get">
              <input type="text" value=" " name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categories</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first">
                        <a href="#">Music</a></li>
                        <li><a href="#">Movies</a></li>
                        <li><a href="#">Laptops</a></li>
                        <li><a href="#">Games</a></li>
                        <li><a href="#">Pen-Drives</a></li>
                        <li><a href="#">Software</a></li>
                      </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 2</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 3</a></h4>
                        <p class="price">rs0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 5</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="float_r">
        	<h1> Shirts</h1>
            <div class="product_box">
	            <h3>Paulo Bland</h3>
            	<a href="productdetail.html"><img src="images/gallery/wshirt1.jpg"  alt="Women's Shirt 1" /></a>
                <p> read more.</p>
              <p class="product_price">Rs. 100</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>        	
            <div class="product_box">
            	<h3>Tommy Hilfigher</h3>
            	<a href="productdetail.html"><img src="images/gallery/wshirt2.jpg"  alt="women's Shirt 2" /></a>
                <p>data.</p>
            <p class="product_price">rs 800</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>        	
            <div class="product_box no_margin_right">
            	<h3>Reed & Taylor</h3>
            	<a href="productdetail.html"><img src="images/gallery/w-shirt3.jpg"  alt="Shoes 3" /></a>
                <p>data.</p>
              <p class="product_price">Rs 600</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>     
            
            <div class="cleaner"></div>
               	
            <div class="product_box">
            	<h3>Entise Casual</h3>
            	<a href="productdetail.html"><img src="images/gallery/wShirt4.jpg"  alt="Shirt 4" /></a>
                <p>data.</p>
              <p class="product_price">rs 260</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>        	
            <div class="product_box">
	            <h3>Ginny & Johnny</h3>
            	<a href="productdetail.html"><img src="images/gallery/wshirt5.jpg"  alt="Shirt 5" /></a>
                <p>data.</p>
            <p class="product_price">Rs 180</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>        	
            <div class="product_box no_margin_right">
            	<h3>Shirt</h3>
            	<a href="productdetail.html"><img src="images/gallery/wshirt6.jpg" alt="Shirt 6" /></a>
                <p>data.</p>
              <p class="product_price">RS 190</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>   
            
            <div class="cleaner"></div>
                 	
            <div class="product_box">
            	<h3>shirt</h3>
            	<a href="productdetail.html"><img src="images/gallery/wshirt7.jpg"  alt="Shirt 7" /></a>
				<p>data.</p>
              <p class="product_price">Rs 300</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>        	
            <div class="product_box">
            	<h3>shirt</h3>
            	<a href="productdetail.html"><img src="images/gallery/wshirt8.jpg"  alt="Shirt 8" /></a>
                <p>data.</p>
            <p class="product_price">Rs. 220</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>        	
            <div class="product_box no_margin_right">
            	 <h3>shirt</h3>
            	<a href="productdetail.html"><img src="images/gallery/wshirt9.jpg"  alt="Shirt 9" /></a>
               	<p>data.</p>
              <p class="product_price">rs 65</p>
                <a href="shoppingcart.html" class="addtocart"></a>
                <a href="productdetail.html" class="detail"></a>
            </div>  
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="#">Home</a> | <a href="#">Products</a> | <a href="#">About</a> | <a href="#">FAQs</a> | <a href="#">Checkout</a> | <a href="#">Contact Us</a>
		</p>


    	Copyright © 2013 <a href="#">E-Mall</a>
        <div class="pins">
									<a href="#"><img src="images/pin_1.png"></a>
									<a href="#"><img src="images/pin_2.png"></a>
									<a href="#"><img src="images/pin_3.png"></a>
									<a href="#"><img src="images/pin_4.png"></a>
								</div>
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>