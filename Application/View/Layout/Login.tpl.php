<ul class="nav navbar-nav pull-right">
    <?php if ($id !== '') {?>
        <li><a href="/group/">Group</a></li>
    <?php } ?>
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Permission <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#">Permission</a></li>
            <li><a href="#">New Group/Permission</a></li>
            <!--li class="divider"></li>
            <li><a href="#">Groupe/Permission</a></li>
            <li><a href="#">N</a></li-->
        </ul>
    </li>
    <li>
        <div class="pull-right navbar-btn btn-group">
          <a href="/user/<?php echo $id; ?>" class="btn btn-default">Profil (<i><?php echo $name; ?>)</i></a>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/user/">Membres</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Logout</a></li>
          </ul>
        </div>
    </li>
</ul>
