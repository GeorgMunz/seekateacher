<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-06-19 07:30:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 5 - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `jobs`
WHERE `deleted` =0
AND `status` = 'publish'
AND `user_id` IN()
ERROR - 2016-06-19 07:32:29 --> Severity: Notice --> Array to string conversion /var/www/v1.seekateacher.com/vendor/codeigniter/framework/system/database/DB_query_builder.php 669
ERROR - 2016-06-19 07:32:29 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `jobs`
WHERE `deleted` =0
AND `status` = 'publish'
AND `user_id` = `Array`
