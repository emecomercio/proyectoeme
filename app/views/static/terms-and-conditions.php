<?php

/** @var array $products
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php loadCSS() ?>
    <?php loadCSS("pages/terms-and-conditions") ?>
    <link rel="icon" type="image/x-icon" href="<?= loadIMG("icons/favicon.png"); ?>">

    <title>Terms and Conditions</title>
</head>

<body>
    <?php view('layout/top-header-nobar'); ?>
    <main>
        <ul>
            <style>
                ul {
                    text-align: center;
                }
            </style>
            <details>
                <summary>1. Introducción</summary>
                <p>-Estos términos y condiciones describen las reglas y regulaciones para el uso del sitio web de Eme Comercio, ubicado en Montevideo. Al acceder a este sitio web, aceptas estos términos y condiciones. Si no estás de acuerdo con alguno de estos términos, no debes utilizar nuestro sitio web.</p>
            </details>

            <details>
                <summary>2. Uso del Sitio Web</summary>
                <p>-El contenido de las páginas de este sitio web es solo para tu información general y uso personal. Está sujeto a cambios sin previo aviso.</p>
                <p>-Eme Comercio se reserva el derecho de modificar o descontinuar, temporal o permanentemente, el sitio web o cualquier parte del mismo con o sin previo aviso.</p>
            </details>

            <details>
                <summary>3. Cuentas de Usuario</summary>
                <p>-Para acceder a ciertas funciones de nuestro sitio, es posible que necesites registrarte y crear una cuenta. Eres responsable de mantener la confidencialidad de tu cuenta y contraseña y de todas las actividades que ocurran bajo tu cuenta.</p>
                <p>-Eme Comercio no será responsable de ningún daño o pérdida que surja del incumplimiento de esta obligación de seguridad.</p>
            </details>

            <details>
                <summary>4. Productos y Servicios</summary>
                <p>-Todos los productos y servicios que se ofrecen a través de Eme Comercio están sujetos a disponibilidad. Nos reservamos el derecho de limitar las cantidades de cualquier producto o servicio que ofrecemos.</p>
                <p>-Los precios de nuestros productos están sujetos a cambios sin previo aviso. Nos reservamos el derecho de modificar o descontinuar un producto en cualquier momento.</p>
            </details>

            <details>
                <summary>5. Proceso de Compra</summary>
                <p>-Al realizar un pedido en nuestro sitio web, estás ofreciendo comprar un producto sujeto a estos términos y condiciones. Todos los pedidos están sujetos a la disponibilidad de los productos y a la confirmación del precio del pedido.</p>
                <p>-Eme Comercio se reserva el derecho de rechazar o cancelar cualquier pedido por cualquier razón, incluso después de que el pedido haya sido confirmado.</p>
            </details>

            <details>
                <summary>6. Entrega</summary>
                <p>-Eme Comercio realiza entregas a través de proveedores de servicios de mensajería. Los tiempos de entrega varían según la ubicación del cliente y la disponibilidad del producto.</p>
                <p>-No somos responsables de los retrasos en la entrega que estén fuera de nuestro control.</p>
            </details>

            <details>
                <summary>7. Devoluciones y Reembolsos</summary>
                <p>-Las devoluciones y los reembolsos se manejan de acuerdo con nuestra política de devoluciones, disponible en [enlace a la política de devoluciones].</p>
                <p>-Eme Comercio se reserva el derecho de rechazar devoluciones si el producto no cumple con las condiciones de nuestra política de devoluciones.</p>
            </details>

            <details>
                <summary>8. Propiedad Intelectual</summary>
                <p>-Todo el contenido incluido en este sitio web, como texto, gráficos, logotipos, imágenes, clips de audio y software, es propiedad de Eme Comercio o de sus proveedores de contenido y está protegido por las leyes de derechos de autor internacionales.</p>
            </details>

            <details>
                <summary>9. Limitación de Responsabilidad</summary>
                <p>-Eme Comercio no será responsable de ningún daño directo, indirecto, incidental, especial, consecuente o ejemplar que resulte del uso o de la incapacidad de usar los productos o servicios en nuestro sitio web.</p>
            </details>

            <details>
                <summary>10. Modificaciones de los Términos</summary>
                <p>-Eme Comercio se reserva el derecho de modificar estos términos y condiciones en cualquier momento. Cualquier cambio entrará en vigor inmediatamente después de ser publicado en esta página.</p>
            </details>

            <details>
                <summary>11. Ley Aplicable</summary>
                <p>-Estos términos y condiciones se rigen e interpretan de acuerdo con las leyes del país donde se encuentra registrado Eme Comercio, y cualquier disputa relacionada con estos términos estará sujeta a la jurisdicción exclusiva de los tribunales de dicha jurisdicción.</p>
            </details>

            <details>
                <summary>12. Contacto</summary>
                <p>-Si tienes alguna pregunta sobre estos términos y condiciones, por favor contáctanos a través de emecomerciooficial@gmail.com.</p>
            </details>

    </main>
    <?php view('layout/footer'); ?>
    <script type="module" src="<?= asset("/js/main.js") ?>"></script>

</body>

</html>