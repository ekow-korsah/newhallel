var xhr = createxmlHttpRequestObject();

function createxmlHttpRequestObject() {
	var xhr;
	
	if(window.XMLHttpRequest){
		xhr = new XMLHttpRequest();
	}else{
		xhr = new ActiveXObject('Microsoft.XMLHTTP');
	}
	
	return xhr;
}

function addToCart(product_id, btn_id) {
	var params, myObj, addToCartBtn;
	params = "product_id="+product_id;
	addToCartBtn = document.getElementById(btn_id);
	
	
	if(xhr) {
		xhr.open('POST', 'ajax/add-to-cart/', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(params);
		
		xhr.onload = function() {
			
			if(this.status == 200) {

				myObj = JSON.parse(this.responseText);
			
				if(myObj != 'error') {
					//addToCartBtn.innerHTML = '<span class="glyphicon glyphicon-ok"></span';
					addToCartBtn.innerHTML = '<span>Added Successfully</span>';
					addToCartBtn.style.backgroundColor = 'lightgreen';
					cartItemIndicator();
				}
				
			}
			
		}
		
	}
}

function removeItem(product_id, btn_id) {
	var params, myObj, addToCartBtn;
	params = "product_id="+product_id;
	addToCartBtn = document.getElementById(btn_id);
	
	if(xhr) {
		xhr.open('POST', 'ajax/remove-from-cart/', true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send(params);
		
		xhr.onload = function() {
			
			if(this.status == 200) {

				myObj = JSON.parse(this.responseText);
			
				//if(myObj != 'error') {
					//alert(myObj)
					//addToCartBtn.innerHTML = '<span class="glyphicon glyphicon-ok"></span';
					addToCartBtn.remove();
					cartItemIndicator();
				//}
				
			}
			
		}

	}
}

cartItemIndicator();
setInterval(cartItemIndicator, 1000);
function cartItemIndicator() {
	var cartIndicator, myObj;
	cartIndicator = document.getElementById('cart_count');
	
	if(xhr) {
		xhr.open('GET', 'ajax/cart-refresh/', true);

		xhr.send();
		
		xhr.onload = function() {
			
			if(this.status == 200) {

				myObj = JSON.parse(this.responseText);
			
				cartIndicator.innerHTML = myObj;
				
			}
			
		}
		
	}
}