<?php
    $this->inherits('hoa://Application/View/Layout/Admin.tpl.php');
    $this->block('content');
    ?>
    <br />
    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4><?php echo $user['idUser']; ?># <?php echo $user['name']; ?></h4>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?php echo $user['email']; ?>
                            <br />
                            <i class="glyphicon glyphicon-user"></i>Registrer : <?php echo date('d/m/Y' , $user['registerTime']); ?>
                            <br />
                            <i class="glyphicon glyphicon-time"></i>Last connection : <?php echo date('d/m/Y H:i:s' , $user['connectTime']); ?>
                            </p>
                        <!-- Split button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">
                                Action</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Action</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Contact</a></li>
                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Mail</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    $this->endBlock();
