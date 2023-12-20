CREATE DATABASE BookiDB;
USE BookiDB;

-- SQL code to create the 'Book' table
CREATE TABLE Book (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      title VARCHAR(255),
                      author VARCHAR(255),
                      genre VARCHAR(255),
                      description TEXT,
                      publication_year DATE,
                      total_copies INT,
                      available_copies INT
);

-- SQL code to create the 'User' table
CREATE TABLE User (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      fullname VARCHAR(255),
                      last_name VARCHAR(255),
                      email VARCHAR(255),
                      password VARCHAR(255),
                      phone VARCHAR(255)
);

-- SQL code to create the 'Role' table
CREATE TABLE Role (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      name VARCHAR(255)
);

-- SQL code to create the 'Reservation' table with 'book_id' and 'user_id' as foreign keys
CREATE TABLE Reservation (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             book_id INT,
                             user_id INT,
                             description TEXT,
                             reservation_date DATE,
                             return_date DATE,
                             is_returned INT,
                             FOREIGN KEY(book_id) REFERENCES Book(id),
                             FOREIGN KEY(user_id) REFERENCES User(id)
);

-- SQL code to create the 'UserRole' junction table for the many-to-many relationship between 'User' and 'Role'
CREATE TABLE UserRole (
                          user_id INT,
                          role_id INT,
                          PRIMARY KEY(user_id, role_id),
                          FOREIGN KEY(user_id) REFERENCES User(id),
                          FOREIGN KEY(role_id) REFERENCES Role(id)
);

INSERT INTO Book (title, author, genre, description, publication_year, total_copies, available_copies) VALUES
                                                                                                           ('The Great Gatsby', 'F. Scott Fitzgerald', 'Classic', 'A novel set in the Jazz Age...', '1925-01-01', 5, 3),
                                                                                                           ('1984', 'George Orwell', 'Dystopian', 'A novel about a dystopian future...', '1949-01-01', 4, 4),
                                                                                                           ('To Kill a Mockingbird', 'Harper Lee', 'Drama', 'A novel about racism and injustice...', '1960-01-01', 6, 4),
                                                                                                           ('The Catcher in the Rye', 'J.D. Salinger', 'Classic', 'A story about teenage angst and alienation...', '1951-01-01', 7, 7),
                                                                                                           ('The Hobbit', 'J.R.R. Tolkien', 'Fantasy', 'A fantasy novel about a hobbit’s adventure...', '1937-01-01', 3, 2),
                                                                                                           ('Pride and Prejudice', 'Jane Austen', 'Romance', 'A novel about manners and marriage...', '1813-01-01', 6, 5),
                                                                                                           ('Beloved', 'Toni Morrison', 'Historical', 'A novel about the aftermath of slavery...', '1987-01-01', 5, 3),
                                                                                                           ('Frankenstein', 'Mary Shelley', 'Horror', 'A novel about man creating monster...', '1818-01-01', 4, 4),
                                                                                                           ('Moby Dick', 'Herman Melville', 'Adventure', 'A novel about obsession and revenge...', '1851-01-01', 6, 4),
                                                                                                           ('War and Peace', 'Leo Tolstoy', 'Historical', 'A novel about the French invasion of Russia...', '1869-01-01', 2, 1);

INSERT INTO User (fullname, last_name, email, password, phone) VALUES
                                                                   ('Alice Brown', 'Brown', 'alicebrown@example.com', '$2y$10$ROg8GomtpMF34pEVK6/UOutNagwikC6RRHIHHkyucbpDfqkWejtry', '123-456-7890'),
                                                                   ('Bob Smith', 'Smith', 'bobsmith@example.com', 'pass123', '123-456-7891'),
                                                                   ('Carol Jones', 'Jones', 'caroljones@example.com', 'pass123', '123-456-7892'),
                                                                   ('David Lee', 'Lee', 'davidlee@example.com', 'pass123', '123-456-7893'),
                                                                   ('Eva White', 'White', 'evawhite@example.com', 'pass123', '123-456-7894'),
                                                                   ('Frank Harris', 'Harris', 'frankharris@example.com', 'pass123', '123-456-7895'),
                                                                   ('Grace Clark', 'Clark', 'graceclark@example.com', 'pass123', '123-456-7896'),
                                                                   ('Henry Davis', 'Davis', 'henrydavis@example.com', 'pass123', '123-456-7897'),
                                                                   ('Isabel Martinez', 'Martinez', 'isabelmartinez@example.com', 'pass123', '123-456-7898'),
                                                                   ('Jack Taylor', 'Taylor', 'jacktaylor@example.com', 'pass123', '123-456-7899');
INSERT INTO Role (name) VALUES
                            ('Administrator'),
                            ('Member');
INSERT INTO Reservation (book_id, user_id, description, reservation_date, return_date, is_returned) VALUES
                                                                                                        (1, 1, 'Reserved for study', '2023-01-01', '2023-01-08', 0),
                                                                                                        (2, 2, 'Reserved for research', '2023-02-01', '2023-02-08', 1),
                                                                                                        (3, 3, 'Reserved for leisure reading', '2023-03-01', '2023-03-08', 0),
                                                                                                        (4, 4, 'Reserved for assignment', '2023-04-01', '2023-04-08', 1),
                                                                                                        (5, 5, 'Reserved for project', '2023-05-01', '2023-05-08', 0),
                                                                                                        (6, 6, 'Reserved for class', '2023-06-01', '2023-06-08', 1),
                                                                                                        (7, 7, 'Reserved for presentation', '2023-07-01', '2023-07-08', 0),
                                                                                                        (8, 8, 'Reserved for thesis', '2023-08-01', '2023-08-08', 1),
                                                                                                        (9, 9, 'Reserved for book club', '2023-09-01', '2023-09-08', 0),
                                                                                                        (10, 10, 'Reserved for vacation reading', '2023-10-01', '2023-10-08', 1);
INSERT INTO UserRole (user_id, role_id) VALUES
                                            (1, 1), -- User 1 is an Administrator
                                            (2, 2), -- User 2 is a Member
                                            (3, 2), -- User 3 is a Member
                                            (4, 2), -- User 4 is a Member
                                            (5, 2), -- User 5 is a Member
                                            (6, 2), -- User 6 is a Member
                                            (7, 2), -- User 7 is a Member
                                            (8, 2), -- User 8 is a Member
                                            (9, 2), -- User 9 is a Member
                                            (10, 2); -- User 10 is a Member
