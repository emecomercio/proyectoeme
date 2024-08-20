<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users table</title>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">
</head>
<?php loadCSS() ?>
<?php loadCSS("pages/usersTable") ?>

<body>
    <main>
        <?php view('layout/top-header-nobar'); ?>
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
                <?php /** @var array $users */
                ?>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <?php foreach ($user as $col) { ?>
                            <td>
                                <?= $col; ?>
                            </td>

                        <?php } ?>
                        <td style="display: flex;">
                            <button class="show-dialog-button" data-dialog="modify-dialog" data-id="<?= $user['id'] ?>" data-type="<?= $user['user_type'] ?>" data-name="<?= $user['fullname'] ?>" data-email="<?= $user['email'] ?>" data-birthdate="<?= $user['birthdate'] ?>">Modificar</button>
                            <button class="show-dialog-button" data-dialog="delete-dialog" data-id="<?= $user['id'] ?>" data-type="<?= $user['user_type'] ?>" data-name="<?= $user['fullname'] ?>" data-email="<?= $user['email'] ?>" data-birthdate="<?= $user['birthdate'] ?>">Borrar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <!-- htmlspecialchars  en col y user-->
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

    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadjs("components/user-button");
    loadJS("components/usersTable");
    ?>
</body>

</html>