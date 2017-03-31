drop table internship;
drop table admin_team;
drop table finance_team;
drop table industryJobSalary;
drop table start_end_date;
drop table industry_company;
drop table student_assign;
drop table advisor_work;
drop table students; 
drop table university;
drop table address_postalcode;

create table address_postalcode
	(address varchar(40) not null,
		postalCode char(6) null,
		primary key(address));
grant select on address_postalcode to public;

create table university
	(name varchar(40) not null,
		address varchar(40) null,
		primary key(name),
		foreign key(address) references address_postalcode); 
grant select on university to public;

create table students 
	(sid char(4) not null,
		name varchar(40) not null,
		major char(4) null,
		year number(1) null,
		gpa number(2) null,
		email varchar(20) null,
		phone varchar(12) null,
		university_name varchar(40) null,
		primary key (sid),
		foreign key (university_name) references university,
		CONSTRAINT check_student_year
		CHECK (year BETWEEN 1 and 4));
grant select on students to public;

ALTER TABLE students
ENABLE CONSTRAINT check_student_year;


create table advisor_work
	(aid char(4) not null,
		name varchar(40) not null,
		email varchar(20) null,
		phone varchar(12) null,
		major char(4) null,
		university_name varchar(40) null,
		primary key(aid),
		foreign key (university_name) references university);
grant select on advisor_work to public;

create table student_assign
	(sid char(4) not null,
		aid char(4) not null,
		primary key(sid,aid),
		CONSTRAINT student_column_assign
		foreign key(sid) references students
		ON DELETE CASCADE,
		foreign key(aid) references advisor_work);
grant select on student_assign to public;

ALTER TABLE student_assign
ENABLE CONSTRAINT student_column_assign;


create table industry_company
	(name varchar(20) not null,
		address varchar(40) null,
		phone varchar(12) null,
		contactPerson varchar(20) null,
		primary key (name),
		foreign key(address) references address_postalcode);
grant select on industry_company to public; 

create table start_end_date
	(startdate varchar(20) not null,
		enddate varchar(20) null,
		primary key (startdate));
grant select on start_end_date to public;

create table industryJobSalary
	(industry_name varchar(20) not null,
		jobtitle varchar(40) not null,
		salary number(10) null,
		primary key (industry_name, jobtitle),
		foreign key (industry_name) references industry_company);
grant select on industryJobSalary to public;

create table finance_team
	(name varchar(20) not null,
		address varchar(40) null,
		phone varchar(12) null,
		budget number(10) null,
		contactPerson varchar(20) not null,
		primary key(name),
		foreign key (address) references address_postalcode);
grant select on finance_team to public;

create table admin_team
	(name varchar(20) not null,
		address varchar(40) null,
		phone varchar(12) null,
		NoOfInternship number(3) null,
		contactPerson varchar(20) not null,
		primary key(name),
		foreign key(address) references address_postalcode);
grant select on admin_team to public;

create table internship
	(sid char(4) not null,
		startdate varchar(20) not null,
		jobtitle varchar(40) null,
		status varchar(15) null,
		termpaper varchar(40) null,
		finance_team_name varchar(20) not null, 
		admin_team_name varchar(20) not null,
		industry_name varchar(20) not null,
		primary key(sid, startdate),
		foreign key(startdate) references start_end_date,
		foreign key(industry_name, jobtitle) references industryJobSalary,
		foreign key(finance_team_name) references finance_team,
		foreign key(admin_team_name) references admin_team,
		foreign key(industry_name) references industry_company,
		CONSTRAINT student_column 
		foreign key(sid) references students
		ON DELETE CASCADE);
grant select on internship to public; 


ALTER TABLE internship
ENABLE CONSTRAINT student_column;

insert into address_postalcode
	values('2329 West Mall', 'V6T1Z4');
insert into address_postalcode
	values('116 Ave', 'T6G2R3');
insert into address_postalcode
	values('8888 University Dr', 'V5A1S6');
insert into address_postalcode
	values('3800 Finnerty Rd', 'V8P5C2');
insert into address_postalcode
	values('3700 Willingdon Ave', 'V5G3H2');
insert into address_postalcode
	values('1234 West Mall', 'V6T2Z9');
insert into address_postalcode
	values('2345 East Mall', 'V6T1Z7');
insert into address_postalcode
	values('4864 Main Mall', 'V6T2Z7');
insert into address_postalcode
	values('4687 East Mall', 'V6T1Z4');
insert into address_postalcode
	values('2345 West Mall', 'V6T1Z4');
insert into address_postalcode
	values('7891 West Mall', 'V6T4Z6');
insert into address_postalcode
	values('2648 West Mall', 'V6T3Z5');
insert into address_postalcode
	values('1324 West Mall', 'V6T2Z9');

insert into university 
	values('UBC', '2329 West Mall');
insert into university 
	values('UOA', '116 Ave');
insert into university 
	values('SFU', '8888 University Dr');
insert into university 
	values('UOV', '3800 Finnerty Rd');
insert into university 
	values('BCIT', '3700 Willingdon Ave');

insert into students
	values('0001', 'John', 'MATH', 3, 32, 'john@email.com', '123-456-7891', 'UBC');
insert into students
	values('0002', 'Jessica', 'STAT', 3, 31, 'jessica@email.com', '123-789-4561', 'UOA');
insert into students
	values('0003', 'Jim', 'CPSC', 2, 35, 'jim@email.com', '123-465-7889', 'SFU');
insert into students
	values('0004', 'Janice', 'CPSC', 4, 35, 'janice@email.com', '123-478-9846', 'UOV');
insert into students
	values('0005', 'Juno', 'CPEN', 1, 30, 'juno@email.com', '123-465-7894', 'BCIT');


insert into advisor_work
	values('1000', 'Bob', 'bob@UBC.com', '123-468-5413', 'MATH', 'UBC');
insert into advisor_work
	values('2000', 'Bruce', 'Bruce@UOA.com', '123-125-7489', 'STAT', 'UOA');
insert into advisor_work
	values('3000', 'Benny', 'Benny@SFU.com', '123-467-5494', 'CPSC', 'SFU');
insert into advisor_work
	values('4000', 'Bailey', 'Bailey@UOV.com', '123-325-4685', 'CPSC', 'UOV');
insert into advisor_work
	values('5000', 'Barbie', 'Barbie@BCIT.com', '123-457-7484', 'CPEN', 'BCIT');

insert into student_assign
	values('0001', '1000');
insert into student_assign
	values('0002', '1000');
insert into student_assign
	values('0003', '1000');
insert into student_assign
	values('0004', '1000');
insert into student_assign
	values('0005', '1000');

insert into student_assign
	values('0001', '2000');
insert into student_assign
	values('0002', '2000');
insert into student_assign
	values('0003', '2000');
insert into student_assign
	values('0004', '2000');
insert into student_assign
	values('0005', '2000');

insert into industry_company
	values('Hooli', '1234 West Mall', '123-786-4531', 'Alex');
insert into industry_company
	values('Pied Piper', '2345 East Mall', '123-467-8474', 'Andrew');
insert into industry_company
	values('EndFrame', '4864 Main Mall', '123-475-4589', 'Andy');
insert into industry_company
	values('Poogle', '4687 East Mall', '123-125-4684', 'Abbey');
insert into industry_company
	values('Picrosoft', '2345 West Mall', '123-467-1354', 'Aaron');

insert into start_end_date
	values('01/01/2016', '01/04/2016');
insert into start_end_date
	values('01/04/2016', '01/08/2016');
insert into start_end_date
	values('01/08/2016', '01/12/2016');
insert into start_end_date
	values('01/01/2015', '01/04/2015');
insert into start_end_date
	values('01/04/2015', '01/08/2015');

insert into industryJobSalary
	values('Hooli', 'SDE', 15000);
insert into industryJobSalary
	values('Pied Piper', 'QA', 15500);
insert into industryJobSalary
	values('EndFrame' , 'SDET', 14000);
insert into industryJobSalary
	values('Poogle', 'PM', 16000);
insert into industryJobSalary
	values('Picrosoft', 'QA', 14000);

insert into finance_team
	values('teamFA', '7891 West Mall', '123-129-7843', 100000, 'Chris');
insert into finance_team
	values('teamFB', '7891 West Mall', '123-784-5648', 100000, 'Connie');
insert into finance_team
	values('teamFC', '2648 West Mall', '123-794-4152', 200000, 'Cindy');
insert into finance_team
	values('teamFD', '1324 West Mall', '123-416-7785', 150000, 'Candace');
insert into finance_team
	values('teamFE', '1324 West Mall', '123-123-4458', 135000, 'Caden');

insert into admin_team
	values('teamAA', '7891 West Mall', '123-129-7843', 3, 'Dilion');
insert into admin_team
	values('teamAB', '7891 West Mall', '123-784-5638', 5, 'Don');
insert into admin_team
	values('teamAC', '2648 West Mall', '123-794-4152', 0, 'Dennis');
insert into admin_team
	values('teamAD', '1324 West Mall', '123-416-7785', 2, 'Derek');
insert into admin_team
	values('teamAE', '1324 West Mall', '123-123-4458', 4, 'Donna');

insert into internship
	values('0001', '01/01/2016', 'SDE', 'done', 'finish', 'teamFA', 'teamAA', 'Hooli');
insert into internship
	values('0002', '01/01/2016', 'QA', 'missing', 'finish', 'teamFB', 'teamAB', 'Pied Piper');
insert into internship
	values('0003', '01/04/2016', 'SDET', 'in-progress', 'pending', 'teamFC', 'teamAC', 'EndFrame');
insert into internship
	values('0004', '01/08/2016', 'PM', 'pending start', 'pending', 'teamFD', 'teamAD', 'Poogle');
insert into internship
	values('0005', '01/08/2016', 'QA', 'pending-start', 'pending', 'teamFE', 'teamAE', 'Picrosoft');
