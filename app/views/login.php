<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/pages/login.css" />
    <title>Log-in eMe</title>
</head>

<body>
    <form action="login" method="post">
        <fieldset>
            <legend>Ingresa tus credenciales</legend>

            <label for="input-email"> Ingresa correo: </label>
            <input type="email" name="input-email" id="input-email" required />

            <label for="input-password"> Ingresa contraseña: </label>
            <input type="password" name="input-password" id="input-password" required />

            <button type="submit">Log-In</button>

            <div>
                <p>
                    Todavia no tienes cuenta?
                </p>
                <p><a href="register">Iniciar Sesión</a></p>
            </div>
        </fieldset>
    </form>
</body>

</html>