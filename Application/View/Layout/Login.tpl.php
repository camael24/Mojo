<ul class="nav navbar-nav pull-right">
    <li><a href="/logout">Logout</a></li>
    <li><a href="/user/">Membres</a></li>
    <?php if ($id !== '') {?>
        <li><a href="/user/<?php echo $id; ?>">Profil (<i><?php echo $name; ?></i>)</a></li>
    <?php } ?>
</ul>
