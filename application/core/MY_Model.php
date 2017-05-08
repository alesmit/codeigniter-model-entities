<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder db
 */
abstract class MY_Model extends CI_Model
{

    protected $id;
    protected $table;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the first object matching some attributes
     * @param array $attributes
     * @return $this
     */
    public function findByAttributes($attributes = array())
    {
        foreach ($attributes as $key => $value)
        {
            $this->db->where($key, $value);
        }

        $this->db->select('*');
        $query = $this->db->get($this->table);

        if (!$query || $query->row() === null)
        {
            return null;
        }
        else
        {
            return $query->custom_row_object(0, get_class($this));
        }
    }

    /**
     * Get an array of objects matching some attributes
     * @param array $attributes
     * @return $this[]
     */
    public function findAllByAttributes($attributes = array())
    {
        foreach ($attributes as $key => $value)
        {
            $this->db->where($key, $value);
        }

        $this->db->select('*');
        $query = $this->db->get($this->table);

        if (!$query || (is_array($query->result()) && count($query->result()) === 0))
        {
            return array();
        }
        else
        {
            return $query->custom_result_object(get_class($this));
        }
    }

    /**
     * Insert or update model
     * @return $this
     */
    public function save()
    {
        $obj = $this->get_save_array();

        foreach ($obj as $key => $value)
        {
            $this->db->set($key, $value);
        }

        if (!$this->id || $this->id === null)
        {
            // insert
            $result = $this->db->insert($this->table);
            $saved_object = !$result ? false : $this->getByID($this->getLastID());
        }
        else
        {
            // update
            $this->db->where(array('id' => (int)$this->id));
            $result = $this->db->update($this->table);
            $saved_object = !$result ? false : $this->getByID($this->id);
        }

        return $saved_object;

    }

    /**
     * Delete
     * @return bool
     */
    public function remove()
    {
        $res = $this->db->delete($this->table, array('id' => $this->id));
        return !!$res;
    }

    /**
     * Get object by id
     * @param $id
     * @return $this
     */
    public function getByID($id)
    {
        return $this->findByAttributes(array('id' => $id));
    }

    /**
     * Get all objects in the table
     * @return $this[]
     */
    public function getAll()
    {
        return $this->findAllByAttributes();
    }

    /**
     * Get higher ID
     * @return mixed
     */
    public function getLastID()
    {
        $query = $this->db->query('select max(id) as id from ' . $this->table);
        return $query->row()->id;
    }

    /**
     * Get array of data to save based on object properties
     * @return array
     */
    private function get_save_array()
    {
        $save_arr = array();

        $table_fields = $this->db->list_fields($this->table);
        $model_properties = get_object_vars($this);
        $exclude_fields = array('id', 'table');

        foreach ($model_properties as $prop => $val)
        {
            if (in_array($prop, $table_fields) && !in_array($prop, $exclude_fields))
            {
                $save_arr[$prop] = $val;
            }
        }

        return $save_arr;
    }

}
