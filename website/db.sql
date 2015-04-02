--remove old data
SET client_encoding = 'LATIN1';
set search_path=public;
drop table if exists users cascade;
drop table if exists project cascade;
drop table if exists tag cascade;
drop table if exists projecttag cascade;
drop table if exists session cascade;
drop table if exists vote cascade;
drop table if exists industry cascade;
drop table if exists projectindustry cascade;
drop sequence if exists project_projid_seq;
drop sequence if exists industry_iid_seq;
drop sequence if exists tag_tagid_seq;
drop sequence if exists vote_vid_seq;

----------------------------------------------------------------------
-------------users table--------------------------------------------
----------------------------------------------------------------------
CREATE TABLE users 
(
    email character varying(40) NOT NULL,
    fname character varying(40) NOT NULL,
    lname character varying(40) NOT NULL,
    password character varying(40) NOT NULL
);
ALTER TABLE ONLY users ADD CONSTRAINT users_pkey PRIMARY KEY (email);

----------------------------------------------------------------------
-------------project table--------------------------------------------
----------------------------------------------------------------------
CREATE TABLE project 
(
    projid integer NOT NULL,
	email character varying(40) NOT NULL,
    title character varying(100) NOT NULL,
	description character varying(1000) NOT NULL,
    likes integer NOT NULL,
    dislikes integer NOT NULL,
    submitdate date NOT NULL
);
CREATE SEQUENCE project_projid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE ONLY project ALTER COLUMN projid SET DEFAULT nextval('project_projid_seq'::regclass);
SELECT pg_catalog.setval('project_projid_seq', 5, false);
ALTER TABLE ONLY project ADD CONSTRAINT project_pkey PRIMARY KEY (projid);
ALTER TABLE ONLY project
    ADD CONSTRAINT project_email_fkey FOREIGN KEY (email) REFERENCES users(email) ON DELETE CASCADE; 

----------------------------------------------------------------------
-----------------industry table---------------------------------------
----------------------------------------------------------------------
CREATE TABLE industry 
(
    iid integer NOT NULL,
    description character varying(100) NOT NULL
);
CREATE SEQUENCE industry_iid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE ONLY industry ALTER COLUMN iid SET DEFAULT nextval('industry_iid_seq'::regclass);
SELECT pg_catalog.setval('industry_iid_seq', 6, false);
ALTER TABLE ONLY industry ADD CONSTRAINT industry_pkey PRIMARY KEY (iid);

----------------------------------------------------------------------
-----------------tag table--------------------------------------------
----------------------------------------------------------------------
CREATE TABLE tag 
(
    tagid integer NOT NULL,
    description character varying(100) NOT NULL
);
CREATE SEQUENCE tag_tagid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE ONLY tag ALTER COLUMN tagid SET DEFAULT nextval('tag_tagid_seq'::regclass);
SELECT pg_catalog.setval('tag_tagid_seq', 3, false);
ALTER TABLE ONLY tag ADD CONSTRAINT tag_pkey PRIMARY KEY (tagid);

----------------------------------------------------------------------
-------------projecttag table--------------------------------------------
----------------------------------------------------------------------
CREATE TABLE projecttag 
(
    tagid integer NOT NULL,
    projid integer NOT NULL
);
ALTER TABLE ONLY projecttag ADD CONSTRAINT projecttag_pkey PRIMARY KEY (projid, tagid);
ALTER TABLE ONLY projecttag
    ADD CONSTRAINT projecttag_tagid_fkey FOREIGN KEY (tagid) REFERENCES tag(tagid) ON DELETE CASCADE; 
ALTER TABLE ONLY projecttag
    ADD CONSTRAINT projecttag_projid_fkey FOREIGN KEY (projid) REFERENCES project(projid) ON DELETE CASCADE; 

----------------------------------------------------------------------
-------------projectindustry table--------------------------------------------
----------------------------------------------------------------------
CREATE TABLE projectindustry 
(
    iid integer NOT NULL,
    projid integer NOT NULL
);
ALTER TABLE ONLY projectindustry ADD CONSTRAINT projectindustry_pkey PRIMARY KEY (projid, iid);
ALTER TABLE ONLY projectindustry
    ADD CONSTRAINT projectindustry_iid_fkey FOREIGN KEY (iid) REFERENCES industry(iid) ON DELETE CASCADE; 
ALTER TABLE ONLY projectindustry
    ADD CONSTRAINT projectindustry_projid_fkey FOREIGN KEY (projid) REFERENCES project(projid) ON DELETE CASCADE; 

----------------------------------------------------------------------
----------------vote table--------------------------------------------
----------------------------------------------------------------------
CREATE TABLE vote (
    vid integer NOT NULL,
    projid integer NOT NULL,
    email character varying(40),
    rating integer NOT NULL
);
CREATE SEQUENCE vote_vid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
ALTER TABLE ONLY vote ALTER COLUMN vid SET DEFAULT nextval('vote_vid_seq'::regclass);
SELECT pg_catalog.setval('vote_vid_seq', 3, false);
ALTER TABLE ONLY vote
    ADD CONSTRAINT vote_pkey PRIMARY KEY (vid);
ALTER TABLE ONLY vote
    ADD CONSTRAINT vote_email_fkey FOREIGN KEY (email) REFERENCES users(email) ON DELETE CASCADE; 
ALTER TABLE ONLY vote
    ADD CONSTRAINT vote_projid_fkey FOREIGN KEY (projid) REFERENCES project(projid) ON DELETE CASCADE; 

----------------------------------------------------------------------
-------------session information table--------------------------------
----------------------------------------------------------------------
CREATE TABLE session (
    email character varying(40) NOT NULL,
    sessionid character varying(13) DEFAULT NULL,
    expiration timestamp without time zone DEFAULT NULL
);
ALTER TABLE ONLY session
    ADD CONSTRAINT session_pkey PRIMARY KEY (email);
ALTER TABLE ONLY session
    ADD CONSTRAINT session_email_fkey FOREIGN KEY (email) REFERENCES users(email) ON DELETE CASCADE; 

-----------------------------------------------------------------
-----------------------sample data--------------   ------------

COPY users (email, fname, lname, password) FROM stdin;
eric@eric.com	Eric	Feng	123
test@test.com	Test	HAHA	123
john@john.com	John	Man	123
123@123.com	123	123	123
vk@vk.com	vk	go	123
\.

COPY project (projid, email, title, likes, dislikes, description, submitdate) FROM stdin;
1	eric@eric.com	The New Facebook	0	0	A life changing website that will make every believe that the old facebook is old and people should change.	2015-3-18
2	test@test.com	Vitamin Z	0	0	A new type of drug that allows people to stay up for 72 hours without needing to rest. It is the best solution for soldiers or underpaid workers that need some extra boost of energy.	2015-1-1
3	john@john.com	Johnny Walking	0	0	description of this project is here	2015-03-29
4	123@123.com	i have a dream	0	0	i have a dream that one day people will like me	2015-03-29
\.

COPY industry (iid, description) FROM stdin;
1	Health
2	Technology
3	Education
4	Finance
5	Travel
\.

COPY tag (tagid, description) FROM stdin;
1	Social Network
2	Game
3	Vitamin
4	Drug
5	Safety
\.

COPY projecttag (projid, tagid) FROM stdin;
1	1
2	3
3	2
4	5
\.

COPY projectindustry (projid, iid) FROM stdin;
1	2
2	1
3	5
4	3
\.

COPY vote(vid, projid, email, rating) FROM stdin;
1	1	eric@eric.com	1
2	2	test@test.com	1
3	3	john@john.com	1
4	4	123@123.com	1
\.

COPY session (email) FROM stdin;
eric@eric.com
test@test.com
john@john.com
123@123.com
vk@vk.com
