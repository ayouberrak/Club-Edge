CREATE DATABASE Club_Edge;

\c club_edge;

CREATE TYPE user_role AS ENUM ('etudiant', 'president', 'admin');

CREATE TABLE users (
    id_user SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role user_role DEFAULT 'etudiant',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clubs (
    id_club SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    max_membres INT DEFAULT 8 CHECK (max_membres = 8), 
    id_president INT UNIQUE,
    FOREIGN KEY (id_president) REFERENCES users(id_user) ON DELETE SET NULL 
);

CREATE TABLE club_members (
    id_user INT PRIMARY KEY,
    id_club INT NOT NULL,
    date_adhesion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_member FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_club_member FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);

CREATE TABLE events (
    id_event SERIAL PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    date_event TIMESTAMP NOT NULL,
    lieu VARCHAR(200),
    id_club INT NOT NULL,
    CONSTRAINT fk_club_event FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);

CREATE TABLE participations (
    id_user INT NOT NULL,
    id_event INT NOT NULL,
    date_participation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user, id_event),
    CONSTRAINT fk_user_participation FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_event_participation FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE
);


CREATE TABLE avis (
    id_avis SERIAL PRIMARY KEY,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_user INT NOT NULL,
    id_event INT NOT NULL,
    CONSTRAINT fk_participation_avis FOREIGN KEY (id_user, id_event) REFERENCES participations(id_user, id_event) ON DELETE CASCADE
);


CREATE TABLE articles (
    id_article SERIAL PRIMARY KEY,
    contenu TEXT NOT NULL,
    id_event INT UNIQUE NOT NULL, 
    id_club INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_event_article FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE,
    CONSTRAINT fk_club_article FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);
