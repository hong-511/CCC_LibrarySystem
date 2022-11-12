# CCC_librarySystem
a library system devoloped by three person who's family name start with C

## How to use
1. put all files under the xampp/htdocs (xampp folder is automatically created by xampp after installing xampp)
2. open xampp application and turn on Apache and MySQL
3. open browser and enter http://localhost/
You should see the main page of the system

### How to login as Administrator (might need to set your phpmyadmin to no password)
1. upload the sql file in database folder to phpmyadmin
2. in phpmyadmin, add a database called final_project (db_connect.php line 5 dbname=final_project)
3. in final_project, add a relation called administer (adminIn.php line 12)
4. in administer, set Administer_ID and Password two attribute (adminIn.php line 12)
5. in administer, set your own Administer_ID and Password
6. go back to [adminpage](http://localhost/admin/adminSignIn.php) to test if the administer login works
