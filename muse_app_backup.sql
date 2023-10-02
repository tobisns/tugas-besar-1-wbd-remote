--
-- PostgreSQL database dump
--

-- Dumped from database version 15.1 (Ubuntu 15.1-1.pgdg20.04+1)
-- Dumped by pg_dump version 15.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: album; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.album (
    name character varying(255) NOT NULL,
    upload_date date NOT NULL,
    cover_file character varying(255),
    album_id integer NOT NULL
);


ALTER TABLE public.album OWNER TO postgres;

--
-- Name: album_album_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.album_album_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.album_album_id_seq OWNER TO postgres;

--
-- Name: album_album_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.album_album_id_seq OWNED BY public.album.album_id;


--
-- Name: album_music; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.album_music (
    album_id integer NOT NULL,
    music_id integer NOT NULL
);


ALTER TABLE public.album_music OWNER TO postgres;

--
-- Name: artist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.artist (
    artist_id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.artist OWNER TO postgres;

--
-- Name: artist_artist_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.artist_artist_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.artist_artist_id_seq OWNER TO postgres;

--
-- Name: artist_artist_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.artist_artist_id_seq OWNED BY public.artist.artist_id;


--
-- Name: music; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.music (
    music_id integer NOT NULL,
    title character varying(255) NOT NULL,
    artist_id integer NOT NULL,
    genre character varying(255) NOT NULL,
    duration interval NOT NULL,
    upload_date date NOT NULL,
    audio_file character varying(255) NOT NULL
);


ALTER TABLE public.music OWNER TO postgres;

--
-- Name: music_music_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.music_music_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.music_music_id_seq OWNER TO postgres;

--
-- Name: music_music_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.music_music_id_seq OWNED BY public.music.music_id;


--
-- Name: user_likes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_likes (
    username character varying(255) NOT NULL,
    music_id integer NOT NULL
);


ALTER TABLE public.user_likes OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    username character varying(255) NOT NULL,
    display_name character varying(255),
    profile_picture_file character varying(255),
    phone character varying(15),
    password_hash character(128) NOT NULL,
    admin boolean NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: album album_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album ALTER COLUMN album_id SET DEFAULT nextval('public.album_album_id_seq'::regclass);


--
-- Name: artist artist_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artist ALTER COLUMN artist_id SET DEFAULT nextval('public.artist_artist_id_seq'::regclass);


--
-- Name: music music_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.music ALTER COLUMN music_id SET DEFAULT nextval('public.music_music_id_seq'::regclass);


--
-- Data for Name: album; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.album (name, upload_date, cover_file, album_id) FROM stdin;
\.


--
-- Data for Name: album_music; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.album_music (album_id, music_id) FROM stdin;
\.


--
-- Data for Name: artist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.artist (artist_id, name) FROM stdin;
1	young nigg
2	mister niggle
\.


--
-- Data for Name: music; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.music (music_id, title, artist_id, genre, duration, upload_date, audio_file) FROM stdin;
\.


--
-- Data for Name: user_likes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_likes (username, music_id) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (username, display_name, profile_picture_file, phone, password_hash, admin) FROM stdin;
\.


--
-- Name: album_album_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.album_album_id_seq', 1, false);


--
-- Name: artist_artist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.artist_artist_id_seq', 2, true);


--
-- Name: music_music_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.music_music_id_seq', 1, false);


--
-- Name: album album_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album
    ADD CONSTRAINT album_pkey PRIMARY KEY (album_id);


--
-- Name: artist artist_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.artist
    ADD CONSTRAINT artist_pkey PRIMARY KEY (artist_id);


--
-- Name: album_music music_album_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album_music
    ADD CONSTRAINT music_album_pkey PRIMARY KEY (music_id, album_id);


--
-- Name: music music_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.music
    ADD CONSTRAINT music_pkey PRIMARY KEY (music_id);


--
-- Name: user_likes user_music_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_likes
    ADD CONSTRAINT user_music_pkey PRIMARY KEY (username, music_id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (username);


--
-- Name: album_music album_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album_music
    ADD CONSTRAINT album_fkey FOREIGN KEY (album_id) REFERENCES public.album(album_id);


--
-- Name: music artist_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.music
    ADD CONSTRAINT artist_fkey FOREIGN KEY (artist_id) REFERENCES public.artist(artist_id);


--
-- Name: album_music music_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.album_music
    ADD CONSTRAINT music_fkey FOREIGN KEY (music_id) REFERENCES public.music(music_id);


--
-- Name: user_likes music_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_likes
    ADD CONSTRAINT music_fkey FOREIGN KEY (music_id) REFERENCES public.music(music_id);


--
-- Name: user_likes user_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_likes
    ADD CONSTRAINT user_fkey FOREIGN KEY (username) REFERENCES public.users(username);


--
-- PostgreSQL database dump complete
--

