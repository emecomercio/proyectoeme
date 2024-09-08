<?php

/**
 * @var array $user
 */

?>

<h1>Welcome <?= $user['name'] ?></h1>
<p>Choose an option</p>
<ul>
    <li><a href="/store/upload">Upload a product!</a></li>
    <li><a href="/store/edit"></a></li>
    <li><a href="/store/settings">Settings</a></li>
</ul>