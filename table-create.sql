DROP TABLE IF EXISTS books;
create table books(
    id int AUTO_INCREMENT PRIMARY KEY,
    barcode varchar(25) not null unique,
    book_name varchar(50) not null unique,
    author varchar(50) not null,
    publisher varchar(100) not null,
    book_description text not null,
    summary text not null,
    translator varchar(50) not null,
    created_at TIMESTAMP default CURRENT_TIMESTAMP
);