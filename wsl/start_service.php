<?php

$directive = !empty($argv[1]) ? $argv[1] : "start";
if (!file_exists('/var/run/mysqld')) {
    shell_exec("sudo mkdir -p /var/run/mysqld && sudo chown mysql:mysql /var/run/mysqld");
}
shell_exec("sudo service nginx $directive && sudo service php8.0-fpm $directive && sudo service mysql $directive");
