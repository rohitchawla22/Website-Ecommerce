<?
	function get_product_name($prodid){
		$result=sprintf("select Name from product where prodid=$prodid");
		$r=oci_parse($connect,$result);
		$row=oci_fetch_array($r);
		return $row['Name'];
	}
	function get_price($prodid){
		$result=sprintf("select Price from product where Prodid=$prodid");
		$r=oci_parse($connect,$result);
		$row=oci_fetch_array($r);
		return $row['Price'];
	}
	function remove_product($prodid){
		$prodid=intval($prodid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($prodid==$_SESSION['cart'][$i]['Prodid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$prodid=$_SESSION['cart'][$i]['Prodid'];
			$q=$_SESSION['cart'][$i]['Quantity'];
			$price=get_price($prodid);
			$sum+=$price*$q;
		}
		return $sum;
	}
	function addtocart($prodid,$q){
		if($prodid<1 or $q<1) return;
		
		if(is_array($_SESSION['cart'])){
			if(product_exists($prodid)) return;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['Prodid']=$prodid;
			$_SESSION['cart'][$max]['Quantity']=$q;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['Prodid']=$prodid;
			$_SESSION['cart'][0]['Quantity']=$q; 
		}
	}
	function product_exists($prodid){
		$prodid=intval($prodid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($prodid==$_SESSION['cart'][$i]['Prodid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>