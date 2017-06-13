function checkLogin() {
	// Check the mail and password correctness
	let retValue = true;
	const pass = document.forms["loginForm"]['pass'];
	const mail = document.forms['loginForm']['mail'];
	const submit = document.getElementById('loginSubmit');
	
	if (mail.value === "") {
		mail.style.border = "2px solid #f0ad4e";
		retValue = false;
	} else {
		mail.style.border = "2px solid #5cb85c";
	}

	if (pass.value === "") {
		pass.style.border = "2px solid #f0ad4e";
		retValue = false
	} else {
		pass.style.border = "2px solid #5cb85c";
	}

	if (retValue == true) {
		if (submit.classList.contains('disabled')) {
			submit.classList.remove('disabled');
			submit.removeAttribute('disabled');
		}
	} else {
		if (!submit.classList.contains('disabled')) {
			submit.classList.add('disabled');
			submit.setAttribute('disabled', 'disabled');
		}
	}
}

function checkSignup() {
	let retValue = true;

	const pass = document.forms['signupForm']['pass'];
	const pass2 = document.forms['signupForm']['pass2'];
	const mail = document.forms['signupForm']['mail'];
	const name = document.forms['signupForm']['name'];
	const surname = document.forms['signupForm']['surname'];
	const submit = document.getElementById('signupSubmit');
	const regMail = new RegExp('[a-zA-Z0-9\.-]+@[a-zA-Z]+\.[a-zA-Z]+');
	const regPass = new RegExp('([a-zA-Z][0-9])|([0-9][a-zA-Z])');

	if (pass.value !== pass2.value) {
		pass2.style.border = "2px solid #d9534f";
		retValue = false
	} else {
		pass2.style.border = "2px solid #5cb85c";
	}

	if (pass.value === "") {
		pass.style.border = "2px solid #f0ad4e";
		retValue = false;
	} else {
		if (!regPass.test(pass.value)) {
			pass.style.border = "2px solid #d9534f";
			retValue = false;
		} else {
			pass.style.border = "2px solid #5cb85c";
		}
	}

	if (pass2.value === "") {
		pass2.style.border = "2px solid #f0ad4e";
		retValue = false
	} else {
		if (pass.value !== pass2.value) {
			pass2.style.border = "2px solid #d9534f";
			retValue = false
		} else {
			pass2.style.border = "2px solid #5cb85c";
		}
	}

	if (mail.value === "") {
		mail.style.border = "2px solid #f0ad4e";
		retValue = false;
	} else {
		if (!regMail.test(mail.value)) {
			mail.style.border = "2px solid #d9534f";
			retValue = false;
		} else {
			mail.style.border = "2px solid #5cb85c";
		}
	}

	if (name.value === "") {
		name.style.border = "2px solid #f0ad4e";
	} else {
		name.style.border = "2px solid #5cb85c";
	}

	if (surname.value === "") {
		surname.style.border = "2px solid #f0ad4e";
	} else {
		surname.style.border = "2px solid #5cb85c";
	}

	if (retValue == true) {
		if (submit.classList.contains('disabled')) {
			submit.classList.remove('disabled');
			submit.removeAttribute('disabled');
		}
	} else {
		if (!submit.classList.contains('disabled')) {
			submit.classList.add('disabled');
			submit.setAttribute('disabled', 'disabled');
		}
	}
}

function checkBid() {
	let retValue = true;
	const submit = document.getElementById('bidSubmit');
	const bid = document.forms['bidForm']['value'];
	
	if (bid.value === "") {
		bid.style.border = "2px solid #f0ad4e";
		retValue = false;
	} else {
		if (isNaN(Number(bid.value))) {
			bid.style.border = "2px solid #d9534f";
			retValue = false;
		} else {
			bid.style.border = "2px solid #5cb85c";
		}
	}
	
	if (retValue == true) {
		if (submit.classList.contains('disabled')) {
			submit.classList.remove('disabled');
			submit.removeAttribute('disabled');
		}
	} else {
		if (!submit.classList.contains('disabled')) {
			submit.classList.add('disabled');
			submit.setAttribute('disabled', 'disabled');
		}
	}
}
