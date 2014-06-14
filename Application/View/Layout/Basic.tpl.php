<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Mojo Admin Panel</title>

        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="/css/bootstrap-theme.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/css/jumbotron.css" rel="stylesheet">
      </head>
    <body>
    <?php
       $f = new \Hoa\Session\Flash('notif.box');
          if($f->isLocked() === false && $f['type'] !== null)
            switch ($f['type']) {
              case 'success':
                echo '<div class="alert alert-success"><strong>'.$f['title'].'</strong><br />'.$f['content'].'</div>';
                break;

              case 'error':
              case 'warning':
              case 'alert':
              default:
                echo '<div class="alert alert-danger"><strong>'.$f['title'].'</strong><br />'.$f['content'].'</div>';
                break;
            }

    $this->block('content'); $this->endBlock() ?>
    </body>
</html>
