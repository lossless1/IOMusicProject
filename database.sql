create table users
(
 user_id integer not null auto_increment primary key,
 user_login varchar(20),
 user_password varchar(40),
 user_email varchar(35),
 user_name varchar(60),
 user_city varchar(30),
 user_phone varchar(11),
 user_hash varchar(20),
 user_status boolean
);