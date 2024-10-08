const errorBox = document.querySelector(".auth-error");
document
  .querySelector(".auth-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    errorBox.innerHTML = "";
    errorBox.style.display = "none";

    const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
    const passwordPattern = /^[A-Za-z\d@$!%*?&]{6,}$/;

    const data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });

    // Validación
    let isValid = true;
    let msg = "";

    // Validar el correo electrónico
    if (!emailPattern.test(data.email)) {
      console.warn("El correo electrónico no es válido.");
      msg = "El correo electrónico no es válido.";
      isValid = false;
    }

    // Validar la contraseña
    if (!passwordPattern.test(data.password)) {
      console.warn("La contraseña debe tener al menos 6 caracteres.");
      msg = "La contraseña debe tener al menos 6 caracteres.";
      isValid = false;
    }

    // Validar que las contraseñas coincidan
    if (data.password !== data["password-check"]) {
      console.warn("Las contraseñas no coinciden.");
      msg = "Las contraseñas no coinciden.";
      isValid = false;
    }

    if (isValid) {
      fetch("/api/users", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then((result) => {
          //   console.log(result);
          if (result.status == "success") {
            window.location.href = "/login";
          } else {
            console.error(result.message);
          }
        })
        .catch((error) => {
          console.error("API Error:", error);
        });
    } else {
      errorBox.style.display = "block";
      errorBox.textContent = msg;
    }
  });
