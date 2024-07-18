<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/pages/login.css" />
    <title>Registrarse EME</title>
</head>

<body>
    <form action="register" method="post">
        <fieldset>
            <legend>Ingresa tus datos de registro</legend>

            <label for="input-fullname"> Ingresa tu completo nombre: </label>
            <input type="text" name="input-name" id="input-name" required />

            <label for="input-email"> Ingresa un correo: </label>
            <input type="email" name="input-email" id="input-email" required />

            <label for="input-password"> Ingresa una contraseña: </label>
            <input type="password" name="input-password" id="input-password" required />

            <button type="submit">Log-In</button>
            <div>
                <p>
                    Ya tienes cuenta?
                </p>
                <p><a href="login">Inicia sesión</a></p>
            </div>
        </fieldset>
    </form>
</body>

</html>