/* calculates the total price of elements added to cart dynamically and outputs total*/


/* this function increments the price when the plus button is clicked */
function incrementValue(inputId, priceId, originalPrice) {
	var inputElem, priceElem, x, originalPrice;
		inputElem = document.getElementById(inputId, priceId);
		priceElem = document.getElementById(priceId);
		x = +inputElem.value;
	
	if(!isNaN(x)) {
	
		if(x < 1) {
			x = 1;
		}
		
		x++;
		inputElem.value = x;
		priceElem.innerText = (+originalPrice * x).toFixed(2);
		
	}else{
		inputElem.value = 1;
		priceElem.innerText = originalPrice;
	}
	
	totalPrice();
}


/* this function increments the price when the plus button is clicked */

function decrementValue(inputId, priceId, originalPrice) {
	var inputElem, priceElem, x, originalPrice;
		inputElem = document.getElementById(inputId, priceId);
		priceElem = document.getElementById(priceId);
		x = +inputElem.value;
		
	if(!isNaN(x)) {
		x--;
	
		if(x < 1) {
			x = 1;
		}
		
		inputElem.value = x;
		priceElem.innerText = (+originalPrice * x).toFixed(2);
		
	}else{
		inputElem.value = 1;
		priceElem.innerText = originalPrice;
	}
	
	totalPrice();
}


/* this function calculates the price when the minus button is clicked */
function totalPrice() {
	var priceContainers, total, amountPayable, flatRate;
		amountPayable = document.getElementById('amount-payable');
		flatRate = document.getElementById('flat-rate');
		priceContainers = document.getElementsByClassName('price-container');
		total = 0;
	
	for(var i = 0; i < priceContainers.length; i++) {
		total += +priceContainers[i].innerText
	}
	
	amountPayable.innerHTML = '₵' + total.toFixed(2);
	flatRate.innerHTML = '₵' + (total + 10).toFixed(2);
}


/* validates for m input using regex (Javascript regular expresiions) */

function validateForm(){
	const Form = document.forms['Form'];
	const Fname = Form['fname']['value'];
	const Lname = Form['lname']['value'];
	const Pnum = Form['number']['value'];
	const Email = Form['email']['value'];
	const Hadd = Form['house-address']['value'];

	const fver =  /^[-\sa-zA-Z]+$/;
	if(!fver.test(Fname)){
		alert('Invalid firrst name! Only letters and hyphens allowed here!');
		document.Form.fname.focus();
		return false;
	}

	const lver = /^[-\sa-zA-Z]+$/;
	if(!lver.test(Lname)){
		alert('Invalid last name! Only letters and hyphens allowed here!');
		document.Form.lname.focus() ;
		return false;
	}

	const pver = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
	if(!pver.test(Pnum)){
		alert('Invalid Ghanian phone number. Use your Ghanaian phone number');
		document.Form.number.focus() ;
		return false;
	}

	const emver = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!emver.test(Email)){
		alert('Invalid email! Use this format: hi@example.com');
		document.Form.email.focus() ;
		return false;
	}

	const hver = /^\s*\S+(?:\s+\S+){2}/;
	if(!hver.test(Hadd)){
		alert('Invalid address! Use this format: Street name, House no.');
		document.Form.house-address.focus() ;
		return false;
	}
	else{
		return true;
	}
}

//  /^[a-zA-Z0-9\s]+$/