		function validate() {
			var fname, valid;
			fname = document.getElementById("fname").value;
			if (fname === "") {
				document.getElementById("fname").style.backgroundColor = "#ffcccc";
				document.getElementById("fname_validate").innerHTML = "Please provide a first name.";
				valid = false;
			}
			var lname, valid;
			lname = document.getElementById("lname").value;
			if (lname === "") {
				document.getElementById("lname").style.backgroundColor = "#ffcccc";
				document.getElementById("lname_validate").innerHTML = "Please provide a last name.";
				valid = false;
			}
			var email, valid;
			email = document.getElementById("email").value;
			if (email === "") {
				document.getElementById("email").style.backgroundColor = "#ffcccc";
				document.getElementById("emaile_validate").innerHTML = "Please provide an email.";
				valid = false;
			}
			return valid;
		}