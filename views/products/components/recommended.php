<article>
    <img src="<?= $image["src"] ?? "https://picsum.photos/200/300?random=874" ?>" alt="<?= $image["alt"] ?? "Alter text" ?>">
    <p><?= $name ?? 'Nombre' ?></p>
    <p><?= '$' . $price ?? 'Precio' ?></p>
</article>