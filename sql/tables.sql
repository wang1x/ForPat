create table cookie(cookie varchar(16) not null primary key, user_id varchar(20) not null, lasttime timestamp default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);

CREATE TABLE user (
  id int NOT NULL AUTO_INCREMENT,
  firstname varchar(100) DEFAULT NULL,
  lastname varchar(100) DEFAULT NULL,
  username varchar(30) not null,
  password varchar(40) not null,
  picfile varchar(10000) DEFAULT NULL,
  PRIMARY KEY (id)
); 


CREATE TABLE knowPat (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(100) DEFAULT NULL,
  address varchar(200) default null,
  firsttime varchar(100) default null,
  email varchar(100) default null,
  phone varchar(20) default null,
  description varchar(10000) DEFAULT NULL,
  PRIMARY KEY (id)
);

insert into knowPat (name, email, firsttime, description) values("Yong Xu", "xuyhanghang@gmail.com", "2007", "Got to know such a nice lady in LeLethbridge College Church");


CREATE TABLE post (
  id int NOT NULL AUTO_INCREMENT,
  userID int default null,
  name varchar(100) DEFAULT NULL,
  text varchar(10000) DEFAULT NULL,
  groupID int,
  deep int,
  sibilingRank int,
  postTime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

insert into post(userID, name, text, groupID, sibilingRank,deep) values(1,"yong","test test test0",1,1,1);
insert into post(userID, name, text, groupID, sibilingRank,deep) values(2,"yong1","test test test1",1,1,2);
insert into post(userID, name, text, groupID, sibilingRank,deep) values(2,"yong2","test test test2",1,2,2);




