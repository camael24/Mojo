<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
    ?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Label</th>
            <th>Inherit</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $in = function ($data) {
            $out = '';
            foreach ($data as $value) {
                $out .= '<span class="label label-primary">'.$value.'</span>&nbsp;';
            }

            return $out;

        };

    ?>
        <?php foreach ($acl as $group) { ?>
        <tr>
            <td><?php echo $group['id']; ?></td>
            <td><?php echo $group['label']; ?></td>
            <td><?php echo $in($group['inherit']); ?></td>
            <td></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<a href="/group/new" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></a>
    <?php
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
