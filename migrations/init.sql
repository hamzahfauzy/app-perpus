CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE role_routes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    route_path VARCHAR(100) NOT NULL,
    CONSTRAINT fk_role_routes_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    barcode VARCHAR(100) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    amount VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    publisher VARCHAR(100) NOT NULL,
    publish_year VARCHAR(100) NOT NULL,
    pic VARCHAR(100) NOT NULL,
    CONSTRAINT fk_books_category_id FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE book_takes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    visitor_id VARCHAR(100) NOT NULL,
    taken_date DATE,
    return_date DATE NULL,
    must_return_date DATE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_book_takes_book_id FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id VARCHAR(100) NOT NULL,
    visitor_role VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE application (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

INSERT INTO roles (id, name) VALUES (1,'OP Perpustakaan');
INSERT INTO roles (id, name) VALUES (2, 'Dosen');
INSERT INTO roles (id, name) VALUES (3, 'Mahasiswa');
INSERT INTO roles (id, name) VALUES (4, 'Back Office');
INSERT INTO roles (id, name) VALUES (5, 'Master');

INSERT INTO role_routes (role_id,route_path) VALUE (1,'default/index');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'categories/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'books/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'visitors/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'book-takes/*');
INSERT INTO role_routes (role_id,route_path) VALUE (1,'report/*');

INSERT INTO role_routes (role_id,route_path) VALUE (2,'default/index');
INSERT INTO role_routes (role_id,route_path) VALUE (3,'default/index');
INSERT INTO role_routes (role_id,route_path) VALUE (4,'*');
INSERT INTO role_routes (role_id,route_path) VALUE (5,'*');

INSERT INTO application (name, address, phone, email) VALUES ('Perpustakaan','STIKES Assyifa','0','0');