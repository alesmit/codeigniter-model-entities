<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property User User
 */
class Example extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('User');
    }

    /**
     * Common use cases
     */
    public function index()
    {
        /*
         * insert a new user
         */

        $mike = new User();
        $mike->first_name = 'Mike';
        $mike->last_name = 'Shinoda';

        // save it
        $mike = $mike->save();

        /*
         * update an existing user:
         */

        // get higher id
        $last_id = $this->User->getLastID();

        // select last inserted object
        $user = $this->User->getByID($last_id);

        // update info
        $user->first_name = 'Chester';
        $user->last_name = 'Bennington';

        // save
        $chester = $user->save();

        /*
         * get all users
         */
        $all_users = $this->User->getAll();

        /*
         * get users by attributes
         */
        $users = $this->User->findAllByAttributes(array('first_name' => "Chester"));

        /*
         * delete a user
         */
        $removed = $chester->remove();

    }
}