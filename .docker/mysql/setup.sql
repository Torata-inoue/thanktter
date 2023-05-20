CREATE DATABASE main_db;
CREATE USER 'main_user'@'%' IDENTIFIED BY 'main_user_pass';
GRANT ALL PRIVILEGES ON main_db.* TO 'main_user'@'%';
FLUSH PRIVILEGES;

CREATE DATABASE test_db;
CREATE USER 'test_user'@'%' IDENTIFIED BY 'test_user_pass';
GRANT ALL PRIVILEGES ON test_db.* TO 'test_user'@'%';
FLUSH PRIVILEGES;
