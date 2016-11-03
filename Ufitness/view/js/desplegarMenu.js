document.addEventListener('DOMContentLoaded', function() {

	// desplegar menu
	document.querySelector("#activador_1").onclick = function() {
		var menuItems = document.querySelectorAll("#nivel1 ul");
		for (i = 0; i<menuItems.length; i++) {
			menuItems[i].classList.toggle("visible");

		}
	}

	document.querySelector("#activador_2").onclick = function() {
		var menuItems = document.querySelectorAll("#nivel2 ul");
		for (i = 0; i<menuItems.length; i++) {
			menuItems[i].classList.toggle("visible");

		}
	}

	document.querySelector("#activador_3").onclick = function() {
		var menuItems = document.querySelectorAll("#nivel3 ul");
		for (i = 0; i<menuItems.length; i++) {
			menuItems[i].classList.toggle("visible");

		}
	}

}, false);
