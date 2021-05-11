/*INF653_VC_Back-End Web Development I - Quotes Final Project*/
/*May 1, 2021*/
/*Creates the 3 tables for the quotesb database.*/

/*Create a database named “quotesdb” with 3 tables and these specific column names:*/
/*a) quotes (id, quote, authorId, categoryId) - the last two are foreign keys*/
/*b) authors (id, author)*/
/*c) categories (id, category)*/

-- create and select the database
CREATE DATABASE IF NOT EXISTS quotesdb
    COLLATE utf8mb4_general_ci;
USE quotesdb;

-- create the tables for the database
-- Create quotes table
CREATE TABLE IF NOT EXISTS quotes(
                                       id               INT              NOT NULL AUTO_INCREMENT,
                                       quote            VARCHAR (1024)   NOT NULL,
                                       authorId         INT              NOT NULL,
                                       categoryId       INT              NOT NULL,
                                       PRIMARY KEY (id),
                                       UNIQUE (quote)
);

-- Create authors table
CREATE TABLE IF NOT EXISTS authors(
                                     id                 INT              NOT NULL AUTO_INCREMENT,
                                     author             VARCHAR (256)    NOT NULL,
                                     PRIMARY KEY (id),
                                     UNIQUE (author)
);

-- Create categories table
CREATE TABLE IF NOT EXISTS categories(
                                    id                  INT             NOT NULL AUTO_INCREMENT,
                                    category            VARCHAR (256)   NOT NULL,
                                    PRIMARY KEY (id),
                                    UNIQUE (category)
);

-- Add foreign key constraint to quotes table
ALTER TABLE quotes
    ADD FOREIGN KEY (authorId) REFERENCES authors(id);

ALTER TABLE quotes
    ADD FOREIGN KEY (categoryId) REFERENCES categories(id);

-- Fill authors table
INSERT INTO authors(id,author) VALUES (1,'Ralph Waldo Emerson');
INSERT INTO authors(id,author) VALUES (2,'Mark Twain');
INSERT INTO authors(id,author) VALUES (3,'Thomas Jefferson');
INSERT INTO authors(id,author) VALUES (4,'Barack Obama');
INSERT INTO authors(id,author) VALUES (5,'John Greenleaf Whittier');
INSERT INTO authors(id,author) VALUES (6,'Rory Vaden');
INSERT INTO authors(id,author) VALUES (7,'Grant Cardone');
INSERT INTO authors(id,author) VALUES (8,'Jiddu Krishnamurti');
INSERT INTO authors(id,author) VALUES (9,'Richard Branson');
INSERT INTO authors(id,author) VALUES (10,'Socrates');
INSERT INTO authors(id,author) VALUES (11,'Friedrich Nietzsche');
INSERT INTO authors(id,author) VALUES (12,'Joseph Addison');
INSERT INTO authors(id,author) VALUES (13,'Anonymous');

-- Fill categories table
INSERT INTO categories(id,category) VALUES (1,'Life');
INSERT INTO categories(id,category) VALUES (2,'Politics');
INSERT INTO categories(id,category) VALUES (3,'Business');
INSERT INTO categories(id,category) VALUES (4,'Perseverance');
INSERT INTO categories(id,category) VALUES (5,'Education');

-- Fill quotes table
-- Life Quotes
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (1, 'Honesty is the first chapter in the book of wisdom.',3,1);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (2, 'I like the dreams of the future better than the history of the past.',3,1);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (3, 'Whenever you do a thing, act as if all the world were watching.',3,1);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (4, 'For all sad words of tongue and pen, The saddest are these - It might have been',5,1);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (5, 'Quit sharing bad news and gossip, you are not a garbage truck.',7,1);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (6, 'It is no measure of health to be well adjusted to a profoundly sick society.',8,1);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (7, 'I am a great believer in luck, and I find the harder I work the more I have of it.',13,1);

-- Politics Quotes
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (8, 'Change will not come if we wait for some other person or some other time. We are the ones we have been waiting for. We are the change that we seek.',4,2);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (9, 'My job is not to represent Washington to you, but to represent you to Washington.',4,2);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (10, 'I am the president of the United States. I am not the emperor of the United States.',4,2);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (11, 'All Congresses and Parliaments have a kindly feeling for idiots, and a compassion for them, on account of personal experience and heredity.',2,2);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (12, 'I had rather be shut up in a very modest cottage with my books, my family and a few old friends, dining on simple bacon, and letting the world roll on as it liked, than to occupy the most splendid post, which any human power can give.',3,2);

-- Business Quotes
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (13, 'As a small businessperson, you have no greater leverage than the truth.',5,3);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (14, 'But most of the world is seeking comfort and familiarity, which are traps that cause you to settle for the mediocre. If you want to get to the next level of your business, you have got to be comfortable being uncomfortable.',7,3);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (15, 'Business opportunities are like buses, there is always another one coming.',9,3);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (16, 'The secret of change is to focus all your energy not on fighting the old but on building the new.',10,3);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (17, 'Do not go to work to work, go to work to prosper.',7,3);

-- Perseverance
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (18,'Success is never owned; it is only rented, and the rent is due every day!',6,4);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (19,'Stay hungry. Its the only thing that will ensure you dont go hungry.',7,4);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (20,'If the people around you are giving you advice to slow down or to take it easy - you are surrounded by the wrong people',7,4);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (21, 'Making your mark on the world is hard.  If it were easy, everybody would do it. But it is not.  It takes patience, it takes commitment, and it comes with plenty of failure along the way.  The real test is not whether you avoid this failure, because you will not.  It is whether you let it harden or shame you into inaction, or whether you learn from it; whether you choose to persevere.',4,4);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (22, 'If you wish to succeed in life, make perseverance your bosom friend, experience your wise counselor, caution your elder brother, and hope your guardian genius.',12,4);

-- Education Quotes
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (23, 'Education consists mainly of what we have unlearned.',2,5);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (24, 'I never let my schooling interfere with my education.',2,5);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (25, 'In a global economy where the most valuable skill you can sell is your knowledge, a good education is no longer just a pathway to opportunity it is a prerequisite.',4,5);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (26, 'The countries who out-educate us today will out-compete us tomorrow.',4,5);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (27, 'The secret of education lies in respecting the pupil. It is not for you to choose what he shall know, what he shall do. It is chosen and foreordained and he only holds the key to his own secret.',1,5);
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (28, '"What is the task of all higher education?” To turn men into machines. What are the means? Man must learn to be bored. How is that accomplished? By means of the concept of duty.',11,5);

-- Extra quote
INSERT INTO quotes(id, quote, authorId, categoryId) VALUES (29, 'To succeed in life, you need two things ignorance and confidence.',2,1);

-- create user named root without a password
CREATE USER IF NOT EXISTS 'root'@'localhost';

-- grant user access to todolist database
GRANT SELECT, INSERT, UPDATE, DELETE
    ON quotesdb.*
    TO root@localhost;