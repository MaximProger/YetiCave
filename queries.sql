# Заполнение категорий
INSERT INTO categories SET title = 'Доски и лыжи';
INSERT INTO categories SET title = 'Крепления';
INSERT INTO categories SET title = 'Ботинки';
INSERT INTO categories SET title = 'Одежда';
INSERT INTO categories SET title = 'Инструменты';
INSERT INTO categories SET title = 'Разное';

# Заполнение пользователей
INSERT INTO users SET name = 'Игнат', avatar = '', email = 'ignat.v@gmail.com', password = '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka';
INSERT INTO users SET name = 'Леночка', avatar = '', email = 'kitty_93@li.ru', password = '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa';
INSERT INTO users SET name = 'Руслан', avatar = '', email = 'warrior07@mail.ru', password = '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW';
INSERT INTO users SET name = 'Максим', avatar = '', email = 'max@mail.ru', password = '123456';

# Заполнение объявлений
INSERT INTO ads SET
                    title = '014 Rossignol District Snowboard',
                    user_id = 3,
                    category_id = 1,
                    price = 10999,
                    price_start = 10999,
                    rates_count = 20,
                    img = 'img/lot-1.jpg',
                    date  = NOW(),
                    is_active = 1;
INSERT INTO ads SET
                    title = 'DC Ply Mens 2016/2017 Snowboard',
                    user_id = 2,
                    category_id = 1,
                    price = 15999,
                    price_start = 15999,
                    rates_count = 11,
                    img = 'img/lot-2.jpg',
                    date  = NOW(),
                    is_active = 1;
INSERT INTO ads SET
                    title = 'Крепления Union Contact Pro 2015 года размер L/XL',
                    user_id = 1,
                    category_id = 2,
                    price = 8000,
                    price_start = 8000,
                    rates_count = 5,
                    img = 'img/lot-3.jpg',
                    date  = NOW(),
                    is_active = 1;
INSERT INTO ads SET
                    title = 'Ботинки для сноуборда DC Mutiny Charocal',
                    user_id = 2,
                    category_id = 3,
                    price = 10999,
                    price_start = 10999,
                    rates_count = 0,
                    img = 'img/lot-4.jpg',
                    date  = NOW(),
                    is_active = 1;
INSERT INTO ads SET
                    title = 'Куртка для сноуборда DC Mutiny Charocal',
                    user_id = 1,
                    category_id = 4,
                    price = 10999,
                    price_start = 10999,
                    rates_count = 1,
                    img = 'img/lot-5.jpg',
                    date  = NOW(),
                    is_active = 1;
INSERT INTO ads SET
                    title = 'Маска Oakley Canopy',
                    user_id = 3,
                    category_id = 6,
                    price = 5500,
                    price_start = 5500,
                    rates_count = 4,
                    img = 'img/lot-6.jpg',
                    date  = NOW(),
                    is_active = 1;

# Заполнение ставок
INSERT INTO rates SET user_id = 1, ad_id = 1, price = 12000, rates_date = NOW();
INSERT INTO rates SET user_id = 2, ad_id = 5, price = 7000, rates_date = NOW();
INSERT INTO rates SET user_id = 3, ad_id = 3, price = 10500, rates_date = NOW();
