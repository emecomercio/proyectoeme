const errorBox = document.querySelector(".auth-error");

document
  .querySelector(".auth-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    errorBox.innerHTML = "";
    errorBox.style.display = "none";

    const data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });

    fetch("/api/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((result) => {
        if (result.status === "success") {
          let user = result.data.user;
          localStorage.setItem("user", JSON.stringify(user));
          user.role == "buyer"
            ? (window.location.href = "/")
            : (window.location.href = "/dashboard");
        } else {
          console.log("Error de autenticación:", result.message);
          errorBox.textContent = result.message;
          errorBox.style.display = "block";
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
