create table customers (
  id int(5) not null auto_incrememnt,
  surname varchar(50) not null,
  firstname varchar(50) not null,
  initial char(1),
  title varchar(10),
  address varchar(200) not null,
  city varchar(20) not null,
  state varchar(20),
  postcode char(4),
  email varchar(50) not null,
  primary key (id),
  key names (surname, firstname)
);
