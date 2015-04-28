install php mongod driver:
1.sudo apt-get install php-pear php5-dev
2.sudo pecl install mongo
3.***add extension=mongo.so to /etc/php5/cli/conf.d/mongodb.ini
4.restart apache:
5.sudo service apache2 restart

