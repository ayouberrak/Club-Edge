--- 1. Types ENUM
---
CREATE TYPE user_role AS ENUM ('etudiant', 'president', 'admin');

---
--- 2. Table Utilisateurs (Héritage de la classe abstraite)
---
CREATE TABLE users (
    id_user SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role user_role DEFAULT 'etudiant',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

---
--- 3. Table Clubs
---
CREATE TABLE clubs (
    id_club SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    max_membres INT DEFAULT 8 CHECK (max_membres = 8), -- Contrainte métier
    id_president INT UNIQUE, -- Relation 1:1 avec le Président
    FOREIGN KEY (id_president) REFERENCES users(id_user) ON DELETE SET NULL 
    -- Ila tmsa7 l'user, l'club kiy b9a o admin kiy tkhsar president jdid
);

---
--- 4. Table Club_Members (Relation N:1 entre Etudiant et Club)
---
CREATE TABLE club_members (
    id_user INT PRIMARY KEY, -- PRIMARY KEY hna t'assurer bli étudiant 3ndou club wa7ed max (User Story)
    id_club INT NOT NULL,
    date_adhesion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_member FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_club_member FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);

---
--- 5. Table Events
---
CREATE TABLE events (
    id_event SERIAL PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    date_event TIMESTAMP NOT NULL,
    lieu VARCHAR(200),
    id_club INT NOT NULL,
    CONSTRAINT fk_club_event FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);

---
--- 6. Table Participations (Etudiant <-> Event)
---
CREATE TABLE participations (
    id_user INT NOT NULL,
    id_event INT NOT NULL,
    date_participation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user, id_event),
    CONSTRAINT fk_user_participation FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    CONSTRAINT fk_event_participation FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE
);

---
--- 7. Table Avis (L'étudiant khasso ykoun déjà participant)
---
CREATE TABLE avis (
    id_avis SERIAL PRIMARY KEY,
    note INT CHECK (note BETWEEN 1 AND 5), -- Note en étoiles (User Story)
    commentaire TEXT,
    date_avis TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_user INT NOT NULL,
    id_event INT NOT NULL,
    -- Liaison m3a participation bach n'assurerou bli ssi l'étudiant 7dar l'event
    CONSTRAINT fk_participation_avis FOREIGN KEY (id_user, id_event) REFERENCES participations(id_user, id_event) ON DELETE CASCADE
);

---
--- 8. Table Articles (Post-Event)
---
CREATE TABLE articles (
    id_article SERIAL PRIMARY KEY,
    contenu TEXT NOT NULL,
    id_event INT UNIQUE NOT NULL, -- Relation 1:1 m3a l'event (un article par event)
    id_club INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_event_article FOREIGN KEY (id_event) REFERENCES events(id_event) ON DELETE CASCADE,
    CONSTRAINT fk_club_article FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);
