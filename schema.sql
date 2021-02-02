CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title CHAR(128)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(128),
    avatar CHAR(128),
    email CHAR (255),
    password CHAR(64)
);

CREATE UNIQUE INDEX x_title ON categories(title);
CREATE UNIQUE INDEX x_email ON users(email);

CREATE TABLE ads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title CHAR(128),
    category_id INT,
    price INT,
    price_start INT,
    rates_count INT,
    img CHAR(255),
    is_active INT,
    CONSTRAINT ads_user_id FOREIGN KEY (user_id)  REFERENCES users(id),
    CONSTRAINT ads_category FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE UNIQUE INDEX x_title ON ads(title);
CREATE INDEX x_name ON users(name);
CREATE INDEX x_price ON ads(price);

CREATE TABLE rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    ad_id INT,
    price INT,
    rates_date DATETIME  NOT NULL,
    CONSTRAINT rates_user_id FOREIGN KEY (user_id)  REFERENCES users(id),
    CONSTRAINT rates_ad_title FOREIGN KEY (ad_id)  REFERENCES ads(id)
);



