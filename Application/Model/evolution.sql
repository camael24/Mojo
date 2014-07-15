CREATE TABLE IF NOT EXISTS user (
    idUser              INTEGER,
    login               VARCHAR(255),
    password            VARCHAR(255),
    name                VARCHAR(255),
    email               VARCHAR(255),
    token               VARCHAR(35),
    activated           VARCHAR(1),
    registerTime        VARCHAR(255),
    connectTime         VARCHAR(255),
    avatarType          VARCHAR(5),
    avatarData          VARCHAR(255),
  PRIMARY KEY (idUser)
);

CREATE TABLE IF NOT EXISTS user_group (
    idUserGroup         INTEGER,
    refUser             VARCHAR(25),
    refGroup            VARCHAR(25),
  PRIMARY KEY (idUserGroup)
);

CREATE TABLE IF NOT EXISTS `group` (
    idGroup             INTEGER,
    name                VARCHAR(255),
    label               VARCHAR(255),
    inherit             VARCHAR(255),
  PRIMARY KEY (idGroup)
);

CREATE TABLE IF NOT EXISTS permission (
    idPermission        INTEGER,
    label               VARCHAR(255),
  PRIMARY KEY (idPermission)
);

CREATE TABLE IF NOT EXISTS group_permission (
    idGroupePermission  INTEGER,
    refGroup            VARCHAR(25),
    refPermission       VARCHAR(25),
  PRIMARY KEY (idGroupePermission)
);