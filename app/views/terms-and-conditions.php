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

    <title>Homepage</title>
</head>

<body>
    <?php view('components/top-header'); ?>
    <main>
        <p>


            Términos y Condiciones de Eme Commerce**

            1. Introducción
            Bienvenido a Eme Commerce. Estos términos y condiciones describen las reglas y regulaciones para el uso del sitio web de Eme Commerce, ubicado en ####. Al acceder a este sitio web, aceptas estos términos y condiciones. Si no estás de acuerdo con alguno de estos términos, no debes utilizar nuestro sitio web.

            2. Uso del Sitio Web
            - El contenido de las páginas de este sitio web es solo para tu información general y uso personal. Está sujeto a cambios sin previo aviso.
            - Eme Commerce se reserva el derecho de modificar o descontinuar, temporal o permanentemente, el sitio web o cualquier parte del mismo con o sin previo aviso.

            3. Cuentas de Usuario
            - Para acceder a ciertas funciones de nuestro sitio, es posible que necesites registrarte y crear una cuenta. Eres responsable de mantener la confidencialidad de tu cuenta y contraseña y de todas las actividades que ocurran bajo tu cuenta.
            - Eme Commerce no será responsable de ningún daño o pérdida que surja del incumplimiento de esta obligación de seguridad.

            4. Productos y Servicios
            - Todos los productos y servicios que se ofrecen a través de Eme Commerce están sujetos a disponibilidad. Nos reservamos el derecho de limitar las cantidades de cualquier producto o servicio que ofrecemos.
            - Los precios de nuestros productos están sujetos a cambios sin previo aviso. Nos reservamos el derecho de modificar o descontinuar un producto en cualquier momento.

            5. Proceso de Compra
            - Al realizar un pedido en nuestro sitio web, estás ofreciendo comprar un producto sujeto a estos términos y condiciones. Todos los pedidos están sujetos a la disponibilidad de los productos y a la confirmación del precio del pedido.
            - Eme Commerce se reserva el derecho de rechazar o cancelar cualquier pedido por cualquier razón, incluso después de que el pedido haya sido confirmado.

            6. Entrega
            - Eme Commerce realiza entregas a través de proveedores de servicios de mensajería. Los tiempos de entrega varían según la ubicación del cliente y la disponibilidad del producto.
            - No somos responsables de los retrasos en la entrega que estén fuera de nuestro control.

            7. Devoluciones y Reembolsos
            - Las devoluciones y los reembolsos se manejan de acuerdo con nuestra política de devoluciones, disponible en [enlace a la política de devoluciones].
            - Eme Commerce se reserva el derecho de rechazar devoluciones si el producto no cumple con las condiciones de nuestra política de devoluciones.

            8. Propiedad Intelectual
            - Todo el contenido incluido en este sitio web, como texto, gráficos, logotipos, imágenes, clips de audio y software, es propiedad de Eme Commerce o de sus proveedores de contenido y está protegido por las leyes de derechos de autor internacionales.

            9. Limitación de Responsabilidad
            - Eme Commerce no será responsable de ningún daño directo, indirecto, incidental, especial, consecuente o ejemplar que resulte del uso o de la incapacidad de usar los productos o servicios en nuestro sitio web.

            10. Modificaciones de los Términos
            - Eme Commerce se reserva el derecho de modificar estos términos y condiciones en cualquier momento. Cualquier cambio entrará en vigor inmediatamente después de ser publicado en esta página.

            11. Ley Aplicable
            - Estos términos y condiciones se rigen e interpretan de acuerdo con las leyes del país donde se encuentra registrado Eme Commerce, y cualquier disputa relacionada con estos términos estará sujeta a la jurisdicción exclusiva de los tribunales de dicha jurisdicción.

            12. Contacto
            - Si tienes alguna pregunta sobre estos términos y condiciones, por favor contáctanos a través de emecommerceoficial@gmail.com.

            ---

            Asegúrate de que estos términos y condiciones reflejen la política real de tu negocio y consulta con un abogado si es necesario.</p>
        <?php view('components/footer'); ?>
    </main>
    <?php
    loadJS("searchbar");
    loadjs("user-button");
    ?>

</body>

</html>