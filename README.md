## To connect to database  ###
* php user_upload.php -u username -p password -h hostname
* Example: php user_upload.php -u root -p password -h 127.0.0.1:3306

The database "Catalyst" will be created.

## To create table  ###
* php user_upload.php -u username -p password -h hostname --create_table

## To import file  ###
* File validation has been done. Make sure to upload testing file inside the project folder. As example, the file named as users.csv has been uploaded.
* php user_upload.php -u username -p password -h hostname --file filepath

## To parse file / No import  ###
* php user_upload.php -u username -p password -h hostname --file filepath --dry_run