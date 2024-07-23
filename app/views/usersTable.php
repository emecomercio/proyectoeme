<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo Usuario</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Hash Contraseña</th>
            <th>Fecha Nacimiento</th>
            <th>Modificadores</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sqlTable as $row) { ?>
            <tr>
                <?php foreach ($row as $col) { ?>
                    <td>
                        <?= $col; ?>
                    </td>

                <?php } ?>
                <td style="display: flex;">
                    <button class="show-dialog-button" data-dialog="modify-dialog" data-id="<?= $row['id'] ?>" data-type="<?= $row['user_type'] ?>" data-name="<?= $row['fullname'] ?>" data-email="<?= $row['email'] ?>" data-birthdate="<?= $row['birthdate'] ?>">Modificar</button>
                    <button class="show-dialog-button" data-dialog="delete-dialog" data-id="<?= $row['id'] ?>" data-type="<?= $row['user_type'] ?>" data-name="<?= $row['fullname'] ?>" data-email="<?= $row['email'] ?>" data-birthdate="<?= $row['birthdate'] ?>">Borrar</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    <!-- htmlspecialchars  en col y row-->
</table>
<dialog class="dialog" id="modify-dialog">
    <form action="./index.php?action=saveUserUpdate" method="post">
        <fieldset>
            <legend>Sobreescribe los datos que deseas modificar</legend>
            <p>Tipo de Usuario</p><br />
            <label>Admin <input type="radio" name="input-type" value="admin" required /></label>
            <label>Buyer <input type="radio" name="input-type" value="buyer" required /></label>
            <label>Seller <input type="radio" name="input-type" value="seller" required /></label>
            <br /><br />


            <label for="input-fullname">Nombre Completo:</label><br />
            <input type="text" id="input-fullname" name="input-fullname" required /><br /><br />
            <label for="input-password">Contraseña:</label><br />
            <input type="password" id="input-password" name="input-password" placeholder="*********" /><br /><br />

            <label for="input-email">Correo Electrónico:</label><br />
            <input type="email" id="input-email" name="input-email" required /><br /><br />

            <label for="input-birthdate">Fecha de Nacimiento:</label><br />
            <input type="date" id="input-birthdate" name="input-birthdate" required />
            <input type="hidden" id="input-id" name="input-id" />
            <br />
            <br />
            <button type="submit">Registrar Usaurio</button>
        </fieldset>
    </form>
</dialog>

<dialog class="dialog" id="delete-dialog">
    <p>Estas seguro?</p>
    <form action="./index.php?action=deleteUser" method="post">
        <button type="submit">Aceptar</button>
        <input type="hidden" name="input-id" />
        <label for="input-fullname">Nombre Completo:</label><br />
        <input type="text" name="input-fullname" /><br /><br />
    </form>
    <button type="submit">Cancelar</button>
</dialog>
<script>
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
</script>