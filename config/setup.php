<?php
    include 'database.php';

    // CREATE DATABASE
    try {
        // Connect to Mysql server
        $dbh = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Database created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING DB: \n".$e->getMessage()."\nAborting process\n";
        exit(-1);
    }

    // CREATE TABLE USERS
    try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(25) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `verified` INT NOT NULL DEFAULT 0,
            `picturesource` LONGBLOB,
			`token` VARCHAR(255)
            )";
        $dbh->exec($sql);
        echo "Table users created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE IMAGE
    try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `image` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `userid` INT NOT NULL,
            `source` LONGBLOB NOT NULL,
			-- `type` VARCHAR(255) NOT NULL,
            `creationdate` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
            FOREIGN KEY (userid) REFERENCES users(id) ON DELETE CASCADE
            )";
        $dbh->exec($sql);
        echo "Table gallery created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE LIKE
    try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `like` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `userid` INT(11) NOT NULL,
            `imageid` INT(11) NOT NULL,
            FOREIGN KEY (userid) REFERENCES `users`(id) ON DELETE CASCADE,
            FOREIGN KEY (imageid) REFERENCES `image`(id) ON DELETE CASCADE
            )";
        $dbh->exec($sql);
        echo "Table like created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE COMMENT
    try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `comment` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `userid` INT NOT NULL,
            `imageid` INT NOT NULL,
            `text` VARCHAR(255) NOT NULL,
            FOREIGN KEY (userid) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (imageid) REFERENCES image(id) ON DELETE CASCADE
            )";
        $dbh->exec($sql);
        echo "Table comment created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
	}
	
    // CREATE TABLE FOLLOWING
    try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `following` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `userid` INT(11) NOT NULL,
            `followid` INT(11) NOT NULL,
            FOREIGN KEY (userid) REFERENCES `users`(id),
            FOREIGN KEY (userid) REFERENCES `users`(id)
            )";
        $dbh->exec($sql);
        echo "Table following created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }
?>