/* -- 2. Define Roles
CREATE TYPE user_role AS ENUM ('etudiant', 'president', 'admin');

-- 3. Users Table (Base for all actors)
CREATE TABLE users (
    id_user SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, 
    role user_role DEFAULT 'etudiant',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Clubs Table
CREATE TABLE clubs (
    id_club SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE, 
    description TEXT,
    max_membres INT DEFAULT 8 CHECK (max_membres > 0), 
    id_president INT UNIQUE,
    image_url VARCHAR(255) DEFAULT 'default-club.jpg', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_president) REFERENCES users(id_user) ON DELETE SET NULL 
);

-- 5. Membership Table
CREATE TABLE club_members (
    id_user INT PRIMARY KEY, 
    id_club INT NOT NULL,
    date_adhesion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_member FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_club_member FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);

-- 6. Events Table
CREATE TABLE events (
    id_event SERIAL PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    date_event TIMESTAMP NOT NULL,
    lieu VARCHAR(200),
    image_event VARCHAR(255), 
    id_club INT NOT NULL,
    CONSTRAINT fk_club_event FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);

-- 7. Participations Table
CREATE TABLE participations (
    id_user INT NOT NULL,
    id_event INT NOT NULL,
    date_participation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user, id_event),
    CONSTRAINT fk_user_participation FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_event_participation FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE
);

-- 8. Reviews Table 
CREATE TABLE avis (
    id_avis SERIAL PRIMARY KEY,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_user INT NOT NULL,
    id_event INT NOT NULL,
    CONSTRAINT fk_participation_avis FOREIGN KEY (id_user, id_event) REFERENCES participations(id_user, id_event) ON DELETE CASCADE
);

-- 9. Articles Table 
CREATE TABLE articles (
    id_article SERIAL PRIMARY KEY,
    contenu TEXT NOT NULL,
    image_article VARCHAR(255), 
    id_event INT UNIQUE NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_event_article FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE
);

-- 1. USERS
INSERT INTO users (nom, email, password, role) VALUES 
('Admin System', 'admin@ecole.com', 'hash123', 'admin'),
('Alice Presi', 'alice@club.com', 'hash123', 'president'),
('Bob Presi', 'bob@club.com', 'hash123', 'president'),
('Charlie Etud', 'charlie@student.com', 'hash123', 'etudiant'),
('Diane Etud', 'diane@student.com', 'hash123', 'etudiant');

-- 2. CLUBS (max_membres doit être 8 selon votre contrainte CHECK)
INSERT INTO clubs (nom, description, max_membres, id_president) VALUES 
('Club Coding', 'Développement Web et Mobile', 8, 2),
('Club Design', 'Arts visuels et UI/UX', 8, 3);

-- 3. CLUB_MEMBERS
INSERT INTO club_members (id_user, id_club) VALUES 
(4, 1), 
(5, 2);

-- 4. EVENTS
INSERT INTO events (titre, description, date_event, lieu, image_event, id_club) VALUES 
('Hackathon 2026', '24h de code', '2026-05-15 09:00:00', 'Salle 101', 'hack.jpg', 1),
('Expo Art', 'Galerie photo', '2026-06-10 14:00:00', 'Hall', 'art.jpg', 2);

-- 5. PARTICIPATIONS (Requis avant de pouvoir mettre un avis)
INSERT INTO participations (id_user, id_event) VALUES 
(4, 1), 
(5, 1);

-- 6. AVIS (Lié à la participation id_user/id_event)
INSERT INTO avis (note, commentaire, id_user, id_event) VALUES 
(5, 'Super organisation !', 4, 1),
(4, 'Challenge intéressant', 5, 1);

-- 7. ARTICLES (id_event UNIQUE)
INSERT INTO articles (contenu, image_article, id_event) VALUES 
('Le Hackathon 2026 fut un succès total...', 'news_hack.jpg', 1),
('Retour sur les plus belles oeuvres de l''expo...', 'news_art.jpg', 2);
 */
INSERT INTO events (titre, description, date_event, lieu, image_event, id_club) VALUES 
('Hackathon 2026', '24h de code', '2025-05-15 09:00:00', 'Salle 101', 'hack.jpg', 1)
