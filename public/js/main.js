import { searchbar } from "./components/main/searchbar.js";
import { userButton } from "./components/main/user_button.js";

searchbar();
userButton();

var dropdown = document.getElementById("categoriesDropdown");
var dropdownContent = document.getElementById("categoriesMenu");

dropdown.addEventListener("click", function (e) {
  e.preventDefault();
  dropdownContent.classList.toggle("show");
});

window.addEventListener("click", function (e) {
  if (!dropdown.contains(e.target)) {
    dropdownContent.classList.remove("show");
  }
});
// LOGOUT FORM
let logout = document.getElementById("logout-btn");
if (logout) {
  logout.addEventListener("click", () => {
    fetch("/api/logout", {
      method: "GET",
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        if (data.status === "success") {
          window.location.href = "/login";
        } else {
          alert("Error logging out");
        }
      });
  });
}
