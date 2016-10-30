document.addEventListener('DOMContentLoaded', function() {

	// desplegar menu
	document.querySelector("#nivelPrincipiante").onclick = function() {
		var menuItems = document.querySelectorAll("#nivelPrincipiante ul");
		for (i = 0; i<menuItems.length; i++) {
			menuItems[i].classList.toggle("visible");

		}
	}

}, false);
