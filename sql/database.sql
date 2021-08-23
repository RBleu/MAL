CREATE TABLE users
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    role VARCHAR(255) NOT NULL DEFAULT 'Normal',
    signup_date DATE NOT NULL
);

CREATE TABLE types
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    type VARCHAR(255) NOT NULL
);

CREATE TABLE animes
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    episodes INT,
    airing TINYINT NOT NULL DEFAULT 0,
    status VARCHAR(255) NOT NULL,
    aired_from DATE,
    aired_to DATE,
    aired VARCHAR(255),
    duration VARCHAR(255),
    type_id INT NOT NULL,
    score FLOAT,
    scored_by INT,
    rank INT,
    synopsis TEXT,
    premiered VARCHAR(11),
    cover VARCHAR(255),
    members INT,
    FOREIGN KEY (type_id) REFERENCES types(id)
);

CREATE TABLE genres
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    genre VARCHAR(255) NOT NULL
);

CREATE TABLE animes_genres
(
    anime_id INT NOT NULL,
    genre_id INT NOT NULL,
    FOREIGN KEY (anime_id) REFERENCES animes(id),
    FOREIGN KEY (genre_id) REFERENCES genres(id)
);

CREATE TABLE lists
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    list VARCHAR(255) NOT NULL
);

CREATE TABLE priorities
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    priority VARCHAR(255)
);

CREATE TABLE users_lists
(
    user_id INT NOT NULL,
    anime_id INT NOT NULL,
    list_id INT NOT NULL,
    score INT,
    comment TEXT,
    modification_date DATETIME NOT NULL DEFAULT NOW(),
    priority_id INT NOT NULL,
    progress_episodes INT NOT NULL DEFAULT 0,
    CONSTRAINT PK_Users_Lists PRIMARY KEY (user_id, anime_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (anime_id) REFERENCES animes(id),
    FOREIGN KEY (list_id) REFERENCES lists(id),
    FOREIGN KEY (priority_id) REFERENCES priorities(id)
);

CREATE TABLE reviews
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    anime_id INT NOT NULL,
    review TEXT,
    likes INT NOT NULL DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (anime_id) REFERENCES animes(id)
);

CREATE TABLE themes
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    anime_id INT NOT NULL,
    theme VARCHAR(255),
    theme_type TINYINT,
    FOREIGN KEY (anime_id) REFERENCES animes(id)
);

CREATE TABLE animes_relations
(
    sequel_id INT NOT NULL,
    prequel_id INT NOT NULL,
    CONSTRAINT PK_Animes_Relations PRIMARY KEY (sequel_id, prequel_id),
    FOREIGN KEY (sequel_id) REFERENCES animes(id),
    FOREIGN KEY (prequel_id) REFERENCES animes(id)
);