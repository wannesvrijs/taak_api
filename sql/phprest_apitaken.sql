
create schema phprest collate utf8_general_ci;

create table apitaken
(
	taa_id int auto_increment
		primary key,
	taa_title varchar(512) null,
	taa_date date null
);


INSERT INTO phprest.apitaken (taa_id, taa_title, taa_date) VALUES (1, 'test', '2020-03-13');
INSERT INTO phprest.apitaken (taa_id, taa_title, taa_date) VALUES (4, 'corona', '2020-01-10');
INSERT INTO phprest.apitaken (taa_id, taa_title, taa_date) VALUES (5, 'sterf', '2020-03-10');
INSERT INTO phprest.apitaken (taa_id, taa_title, taa_date) VALUES (6, 'boefjes', '2020-02-23');
INSERT INTO phprest.apitaken (taa_id, taa_title, taa_date) VALUES (7, 'loopje doen', '2020-02-23');
INSERT INTO phprest.apitaken (taa_id, taa_title, taa_date) VALUES (8, 'koekje eten', '2020-03-04');