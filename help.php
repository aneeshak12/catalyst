<?php

return 
"Use following options to run the script:
• --file [csv file name] – this is the name of the CSV to be parsed
• --create_table – this will cause the MySQL users table to be built (and no further action will be taken)
• --dry_run – this will be used with the --file directive in case we want to run the script but not insert
into the DB. All other functions will be executed, but the database won't be altered
• -u – MySQL username
• -p – MySQL password
• -h – MySQL host

Example: 
php user_upload.php -u root -p my-secret-pw -h 127.0.0.1:3306 --create_table,
php user_upload.php -u root -p my-secret-pw -h 127.0.0.1:3306 --file users.csv --dry_run,
php user_upload.php -u root -p my-secret-pw -h 127.0.0.1:3306 --file users.csv"
?>
