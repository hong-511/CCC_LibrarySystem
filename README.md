# CCC_librarySystem
a library system devoloped by three person who's family name start with C

## How to use
1. put all files under the xampp/htdocs (xampp folder is automatically created by xampp after installing xampp)
2. open xampp application and turn on Apache and MySQL
3. open browser and enter http://localhost/
You should see the main page of the system

### How to login as Administrator (might need to set your phpmyadmin to no password)
1. In db_connect.php, $user and $password should be set to your phpmyadmin user and password
2. in phpmyadmin, add a database called final_project (db_connect.php line 5 dbname=final_project)
3. upload the sql file (located under database folder) into final_project database in phpmyadmin
4. Under final_project database, in administer relation, set your own Administer_ID and Password
7. go back to [adminpage](http://localhost/admin/adminSignIn.php) to test if the administer login works

## System functionalities
This system provides basic functionalities for a library system.
There are three identities with different functionalities described as follows
### Passerby
Passersby can register to become a reader(the password will be hashed, however it is undone)
### Reader
After login with ID and password, readers can search for books, return borrowed books and view their borrow/return history
### Administrator
After login with ID and password(notice: you can't login with reader ID and password), administrators can add book to database, delete books and edit books information

## E-R Diagram
![image](https://user-images.githubusercontent.com/92793837/212813619-cb984134-dc2c-4edd-aaab-806fc92d7a26.png)

## Normalization
### administer schema 
```
CREATE TABLE `administer` (
`Administer_ID` varchar(13) NOT NULL,
`name` varchar(10) DEFAULT NULL,
`Password` varchar(8) DEFAULT NULL,
`email` varchar(12) DEFAULT NULL,
`phone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `administer`
ADD PRIMARY KEY (`Administer_ID`);
```
Functional dependency: {Administer_ID → name, Password, email, phone}

Administer_ID is a primary key. Therefore, administer schema is in BCNF

### book schema
```
CREATE TABLE `book` (
`Book_ID` varchar(100) NOT NULL,
`BookName` varchar(122) DEFAULT NULL,
`Author` varchar(34) DEFAULT NULL,
`Status` varchar(9) DEFAULT NULL
`Year` varchar(10) DEFAULT NULL,
`Price` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `book`
ADD PRIMARY KEY (`Book_ID`);
```
Functional dependency: {Book_ID  →BookName, Author, Status, Year, Price}

Book_ID is a primary key. Therefore, book schema is in BCNF

### reader schema
```
CREATE TABLE `reader` (
`Reader_ID` varchar(9) NOT NULL,
`Name` varchar(7) DEFAULT NULL,
`Password` varchar(8) DEFAULT NULL,
`email` varchar(100) NOT NULL,
`phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `reader`
ADD PRIMARY KEY (`Reader_ID`);
```
Functional dependency: {Reader_ID →Name, Password, email, phone}

Reader_ID is a primary key. Therefore, reader schema is in BCNF

### process schema
```
CREATE TABLE `process` (
`Process_ID` varchar(10) NOT NULL,
`Reader_ID` varchar(9) DEFAULT NULL,
`Book_ID` varchar(10) DEFAULT NULL,
`Administer_ID` varchar(100) NOT NULL,
`Date` varchar(10) DEFAULT NULL,
`Type` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `process`
ADD PRIMARY KEY (`Process_ID`),
ADD KEY `Reader_ID` (`Reader_ID`) USING BTREE,
ADD KEY `Book_ID` (`Book_ID`) USING BTREE,
ADD KEY `Administer_ID` (`Administer_ID`);

ALTER TABLE `process`
	ADD CONSTRAINT `process_ibfk_1` FOREIGN KEY (`Reader_ID`) REFERENCES `reader` (`Reader_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `process_ibfk_2` FOREIGN KEY (`Book_ID`) REFERENCES `book` (`Book_ID`),
	ADD CONSTRAINT `process_ibfk_3` FOREIGN KEY (`Administer_ID`) REFERENCES `administer` (`Administer_ID`);
COMMIT;
```
Functional dependency: {Process_ID →Reader_ID, Book_ID, Administer_ID, Date, Type}

Process_ID is a primary key. Therefore, process schema is in BCNF

### Conclusion
administer, book, reader, process are all in BCNF. Therefore, we remain the origin definition


## Database source
Our database is originated from https://www.kaggle.com/code/ivannatarov/amazon-s-books-eda-plotly-hypothesis-test/data - bestsellers with categories.csv

## Contributors
<a href="https://github.com/Argentum11/CCC_LibrarySystem/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Argentum11/CCC_LibrarySystem" />
</a>
