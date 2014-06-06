<?php
/**
 * @var \Sohoa\Framework\Environnement $this;
 */
/*

    CREATE TABLE `USER` (
      `idUser` INT(11) NOT NULL AUTO_INCREMENT,
      `UserName` VARCHAR(50) NOT NULL,
      `password` VARCHAR(255) NOT NULL,
      PRIMARY KEY (`idUser`)
    );

    CREATE TABLE `user_group` (
      `idUserGroup` INT(11) NOT NULL AUTO_INCREMENT,
      `UserGroupName` VARCHAR(50) NOT NULL,
      `isUser` INT(11) DEFAULT NULL,
      PRIMARY KEY (`idUserGroup`),
      KEY `FK_USER` (`isUser`),
      CONSTRAINT `FK_USER` FOREIGN KEY (`isUser`) REFERENCES `USER` (`idUser`)
    );

    CREATE TABLE `user_group_acl` (
      `doo` INT(11) NOT NULL AUTO_INCREMENT,
      `idUserGroup` INT(11) DEFAULT NULL,
      PRIMARY KEY (`doo`),
      KEY `fk_USER_gROUP` (`idUserGroup`),
      CONSTRAINT `fk_USER_gROUP` FOREIGN KEY (`idUserGroup`) REFERENCES `user_group` (`idUserGroup`)
    );

    CREATE TABLE `user_group_acl_foo` (
      `ooo` INT(11) NOT NULL AUTO_INCREMENT,
      `doo` INT(11) DEFAULT NULL,
      PRIMARY KEY (`ooo`),
      KEY `FK_GROP_ACL` (`doo`),
      CONSTRAINT `FK_GROP_ACL` FOREIGN KEY (`doo`) REFERENCES `user_group_acl` (`doo`)
    );

*/

/*$structure = '{
    "user" : {
            "#id@" : {},
            "login" : {"type" : "VARCHAR(255)"},
            "password" : {"type" : "VARCHAR(255)"},
            "name" : {"type" : "VARCHAR(255)"},
            "token" : {"type" : "VARCHAR(35)"},
            "activated" : {"type" : "VARCHAR(1)"},
            "registerTime" : {"type" : "VARCHAR(255)"},
            "connectTime" : {"type" : "VARCHAR(255)"},
            "avatarType" : {"type" : "VARCHAR(5)"},
            "avaterData" : {"type" : "VARCHAR(255)"}
        }
}';
$d = new \Mojo\Database\Create(new \Mojo\Database\Interpreter\Json($structure));

echo '<pre>'.$d->sql().'</pre>';
*/

 \Hoa\Database\Dal::initializeParameters(array(
                        'connection.list.default.dal' => \Hoa\Database\Dal::PDO,
                        'connection.list.default.dsn' => 'sqlite:hoa://Application/Database/base.db',
                        'connection.autoload' => 'default'
             )
 );

return array();
