CREATE TABLE user (
    idUser              INTEGER,
    login                 VARCHAR(255),
    password         VARCHAR(255),
    name                VARCHAR(255),
    email                 VARCHAR(255),
    token                 VARCHAR(35),
    activated           VARCHAR(1),
    registerTime     VARCHAR(255),
    connectTime    VARCHAR(255),
    avatarType       VARCHAR(5),
    avatarData       VARCHAR(255),
  PRIMARY KEY (idUser)
);
