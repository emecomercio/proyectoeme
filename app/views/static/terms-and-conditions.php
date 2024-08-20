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
    <?php loadCSS("pages/homepage") ?>
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
            <h3>1. Introducción</h3>
            <li>-Estos términos y condiciones describen las reglas y regulaciones para el uso del sitio web de Eme Commerce, ubicado en Montevideo. Al acceder a este sitio web, aceptas estos términos y condiciones. Si no estás de acuerdo con alguno de estos términos, no debes utilizar nuestro sitio web.</li>

            <h3>2. Uso del Sitio Web</h3>
            <li>-El contenido de las páginas de este sitio web es solo para tu información general y uso personal. Está sujeto a cambios sin previo aviso.</li>
            <li>-Eme Commerce se reserva el derecho de modificar o descontinuar, temporal o permanentemente, el sitio web o cualquier parte del mismo con o sin previo aviso.</li>

            <h3>3. Cuentas de Usuario</h3>
            <li>-Para acceder a ciertas funciones de nuestro sitio, es posible que necesites registrarte y crear una cuenta. Eres responsable de mantener la confidencialidad de tu cuenta y contraseña y de todas las actividades que ocurran bajo tu cuenta.</li>
            <li>-Eme Commerce no será responsable de ningún daño o pérdida que surja del incumplimiento de esta obligación de seguridad.</li>

            <h3>4. Productos y Servicios</h3>
            <li>-Todos los productos y servicios que se ofrecen a través de Eme Commerce están sujetos a disponibilidad. Nos reservamos el derecho de limitar las cantidades de cualquier producto o servicio que ofrecemos.</li>
            <li>-Los precios de nuestros productos están sujetos a cambios sin previo aviso. Nos reservamos el derecho de modificar o descontinuar un producto en cualquier momento.</li>

            <h3>5. Proceso de Compra</h3>
            <li>-Al realizar un pedido en nuestro sitio web, estás ofreciendo comprar un producto sujeto a estos términos y condiciones. Todos los pedidos están sujetos a la disponibilidad de los productos y a la confirmación del precio del pedido.</li>
            <li>-Eme Commerce se reserva el derecho de rechazar o cancelar cualquier pedido por cualquier razón, incluso después de que el pedido haya sido confirmado.</li>

            <h3>6. Entrega</h3>
            <li>-Eme Commerce realiza entregas a través de proveedores de servicios de mensajería. Los tiempos de entrega varían según la ubicación del cliente y la disponibilidad del producto.</li>
            <li>-No somos responsables de los retrasos en la entrega que estén fuera de nuestro control.</li>

            <h3>7. Devoluciones y Reembolsos</h3>
            <li>-Las devoluciones y los reembolsos se manejan de acuerdo con nuestra política de devoluciones, disponible en [enlace a la política de devoluciones].</li>
            <li>-Eme Commerce se reserva el derecho de rechazar devoluciones si el producto no cumple con las condiciones de nuestra política de devoluciones.</li>

            <h3>8. Propiedad Intelectual</h3>
            <li>-Todo el contenido incluido en este sitio web, como texto, gráficos, logotipos, imágenes, clips de audio y software, es propiedad de Eme Commerce o de sus proveedores de contenido y está protegido por las leyes de derechos de autor internacionales.</li>

            <h3>9. Limitación de Responsabilidad</h3>
            <li>-Eme Commerce no será responsable de ningún daño directo, indirecto, incidental, especial, consecuente o ejemplar que resulte del uso o de la incapacidad de usar los productos o servicios en nuestro sitio web.</li>

            <h3>10. Modificaciones de los Términos</h3>
            <li>-Eme Commerce se reserva el derecho de modificar estos términos y condiciones en cualquier momento. Cualquier cambio entrará en vigor inmediatamente después de ser publicado en esta página.</li>

            <h3>11. Ley Aplicable</h3>
            <li>-Estos términos y condiciones se rigen e interpretan de acuerdo con las leyes del país donde se encuentra registrado Eme Commerce, y cualquier disputa relacionada con estos términos estará sujeta a la jurisdicción exclusiva de los tribunales de dicha jurisdicción.</li>

            <h3>12. Contacto</h3>
            <li>-Si tienes alguna pregunta sobre estos términos y condiciones, por favor contáctanos a través de emecommerceoficial@gmail.com.</li>
        </ul>


    </main>
    <?php view('layout/footer'); ?>
    <?php
    loadJS("components/searchbar");
    loadjs("components/user-button");
    ?>

</body>

</html>