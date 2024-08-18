
            const dialog = document.querySelectorAll(".dialog"); //innecesario
            const showButtons = document.querySelectorAll(".show-dialog-button");
            const closeButtons = document.querySelectorAll(".close-dialog-button");

            showButtons.forEach((showButton) => {
                showButton.addEventListener("click", () => {
                    const dialogId = showButton.getAttribute("data-dialog");
                    const userId = showButton.getAttribute("data-id");
                    const userType = showButton.getAttribute("data-type");
                    const userName = showButton.getAttribute("data-name");
                    const userEmail = showButton.getAttribute("data-email");
                    const userBirthdate = showButton.getAttribute("data-birthdate");
                    // Actualizar todos los input-id/fullname, ya que están en 2 dialog
                    const inputIds = document.getElementsByName("input-id");
                    inputIds.forEach((input) => (input.value = userId));
                    const inputFullNames = document.getElementsByName("input-fullname");
                    inputFullNames.forEach((input) => (input.value = userName));
                    // Selecciona el checkbox default
                    const radioButtons = document.getElementsByName("input-type");
                    radioButtons.forEach((radio) => {
                        if (radio.value === userType) {
                            radio.checked = true;
                        }
                    });
                    document.getElementById("input-email").value = userEmail;
                    document.getElementById("input-birthdate").value = userBirthdate;

                    const dialog = document.getElementById(dialogId);
                    dialog.showModal();
                });
            });