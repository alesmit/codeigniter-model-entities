<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class User
 * This class demonstrate how a model class should be:
 * 1. should extends MY_Model
 * 2. should have the property $table: the name of the corresponding db table
 * 3. should have the property $id: also on db each table should have the 'id' field
 *
 * This is the create code for the table mapped on this model:
 *
    CREATE TABLE `users` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `first_name` VARCHAR(255) NULL DEFAULT NULL,
        `last_name` VARCHAR(255) NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    )
    COLLATE='latin1_swedish_ci'
    ENGINE=InnoDB;
 *
 */
class User extends MY_Model {

    public $table = 'users';

    public $id;
    public $first_name;
    public $last_name;

}
