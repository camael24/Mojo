<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
    if ($this->acl->need('admin.user.show')) {
    ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Register from</th>
            <th>Avatar</th>
        </tr>
    </thead>
    <?php
        $avatar = function ($type , $data) {
            return '<img src="http://placehold.it/50x50" />';
        };
     foreach ($all as $value) { ?>
    <tbody>
        <tr>
            <td><?php echo $value['idUser']; ?></td>
            <td><a href="/user/<?php echo $value['idUser']; ?>"><?php echo $value['name']; ?></a></td>
            <td><?php echo date('d/m/Y H:i:s' , $value['registerTime']); ?></td>
            <td><?php echo $avatar('' , ''); ?></td>
        </tr>
    </tbody>
    <?php } ?>

</table>
<a href="/user/new" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></a>
    <?php }
/*<ul class="pagination">
//  <li><a href="?page=<?php echo $prev + 1; ?>">&laquo;</a></li>
  <?php
    for ($i=0; $i < $total ; $i++) {
        if($i === $page )
            echo '<li class="active"><a href="#">'.($i +1).'</a></li>';
        else
            echo '<li><a href="?page='.($i +1).'">'.($i +1).'</a></li>';
    }
  ?>
  <li><a href="?page=<?php echo $next + 1; ?>">&raquo;</a></li>
</ul>*/
    $this->endBlock();
