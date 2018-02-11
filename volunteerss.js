function Validator(){
	var name = document.getElementById("name").value,
		committee = document.getElementById("committee").value,
		image = document.getElementById("image").value,
		facebook = document.getElementById("facebook").value,
		linkedin = document.getElementById("linkedin").value,
		number=0,
		url_validation = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;


		var error_name = document.getElementById("error_name");
		error_name.innerHTML=""
		var error_committee = document.getElementById("error_committee");
		error_committee.innerHTML=""
		var error_image = document.getElementById("error_image");
		error_image.innerHTML=""
		var error_facebook = document.getElementById("error_facebook");
		error_facebook.innerHTML=""
		var error_linkedin = document.getElementById("error_linkedin");
		error_linkedin.innerHTML=""

		text="",
		counter=0;

		if(!name){
			error_name.innerHTML = " Name can't be empty "
			number++
		}else if(!name.match(/^[a-zA-Z_ ]+$/)){
			error_name.innerHTML = " Name must be only letter or space or _ "
			number++
		}

		if(!committee){
			error_committee.innerHTML = " Committee can't be empty "
			number++
		}else if(!committee.match(/^[a-zA-Z_ ]+$/)){
			error_committee.innerHTML = " Committee must be only letter or space or _ "
			number++
		}

		if(!image){
			error_image.innerHTML = " Image can't be empty"
			number++
		}

		if(!facebook.match(url_validation) && facebook){
			if(!facebook=="#"){
				error_facebook.innerHTML = " Not Valid URL "
				number++
			}
		}

		if(!linkedin.match(url_validation) && linkedin){
			if(!facebook=="#"){
			error_linkedin.innerHTML = " Not Valid URL "
			number++
			}
		}

	if (number>0){
		return false;
	}else{
		return true;
	}
	
}


/*



*/
