<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error | EME Comercio</title>
</head>

<body>
    <main>
        <!-- Este mensaje podria ser dinamico -->
        <h1>An error occured</h1>
        <p> Sorry, an error occurred while processing your request. Contact: <?= $_ENV["ADMIN_EMAIL"] ?></p>
    </main>
    <style>

    </style>
</body>

</html>