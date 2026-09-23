-- database.sql
-- Dump file so the instructor can rebuild the database from scratch.
-- Import via phpMyAdmin's SQL tab, or the "Import" tab.

CREATE DATABASE IF NOT EXISTS book_library
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE book_library;

CREATE TABLE books (
  bookID        INT AUTO_INCREMENT PRIMARY KEY,
  title         VARCHAR(150) NOT NULL,
  author        VARCHAR(100) NOT NULL,
  genre         VARCHAR(50)  NOT NULL,
  isbn          VARCHAR(20)  NOT NULL,
  publishedDate DATE         NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO books (title, author, genre, isbn, publishedDate) VALUES
('Atomic Habits',                            'James Clear',                            'Self-Improvement', '978-0-7352-1129-2', '2018-10-16'),
('The Art of Thinking Clearly',              'Rolf Dobelli',                           'Psychology',       '978-0-06-221968-8', '2013-04-01'),
('Influence: The Psychology of Persuasion',  'Robert Cialdini',                        'Psychology',       '978-0-06-124189-5', '1984-01-01'),
('Mindset: The New Psychology of Success',   'Carol S. Dweck',                         'Psychology',       '978-0-345-47232-8', '2006-02-28'),
('Man\'s Search for Meaning',                'Viktor E. Frankl',                       'Memoir',           '978-0-8070-1429-5', '1946-01-01'),
('The Psychology of Money',                  'Morgan Housel',                          'Finance',          '978-0-85719-769-6', '2020-09-08'),
('Family Fortunes',                          'Bill Bonner & Will Bonner',              'Finance',          '978-0-470-45519-6', '2011-04-05'),
('Hold On to Your Kids',                     'Gordon Neufeld & Gabor Maté',            'Parenting',        '978-0-345-40128-0', '2004-01-01'),
('Girls on the Edge',                        'Leonard Sax',                            'Parenting',        '978-0-465-02031-4', '2010-08-24'),
('The Whole-Brain Child',                    'Daniel J. Siegel & Tina Payne Bryson',   'Parenting',        '978-0-553-38669-1', '2011-10-04');