<?php

namespace XORLabs\XC\Core;

class Model extends \CI_Model
{
    use Events;
    use Model\Observers;
    use Model\DB_Wrapper;
    use Model\Utility;

    const __EVENTS = [
    'before_insert', 'after_insert',
    'before_update', 'after_update',
    'before_get', 'after_get',
    'before_delete', 'after_delete',
    'at_paginate',
  ];

  /* --------------------------------------------------------------
  * VARIABLES
  * ------------------------------------------------------------ */

  /**
   * This model's default database table. Automatically
   * guessed by pluralising the model name.
   */
  protected $_table;

  /**
   * The database connection object. Will be set to the default
   * connection. This allows individual models to use different DBs
   * without overwriting CI's global $this->db connection.
   */
  public $_database;

  /**
   * This model's default primary key or unique identifier.
   * Used by the get(), update() and delete() functions.
   */
  protected $primary_key = 'id';

  /**
   * map the array data.
   */
  public $map = null;

  // don't from while getting
  public $dont_from = false;

    protected static $_instances = [];

    public static function get_instance($model, $new = false)
    {
        // direct return without saving
    if ($new) {
        return new static();
    }

        if (!isset(static::$_instances[$model])) {
            static::$_instances[$model] = new static();
        }

        return static::$_instances[$model];
    }

  /* --------------------------------------------------------------
  * GENERIC METHODS
  * ------------------------------------------------------------ */

  /**
   * Initialise the model, tie into the CodeIgniter superobject and
   * try our best to guess the table name.
   */
  public function __construct()
  {
      parent::__construct();

      get_instance()->load->helper('inflector');

      $this->_fetch_table();

      $this->_database = clone get_instance()->db;
  }

  /* --------------------------------------------------------------
  * CRUD INTERFACE
  * ------------------------------------------------------------ */

  /**
   * Fetch a single record based on the primary key / where. Returns an object.
   */
  public function get($primary_value)
  {
      return $this->get_by("{$this->_table}.{$this->primary_key}", $primary_value);
  }

  /**
   * Fetch a single record based on an arbitrary WHERE call. Can be
   * any valid value to $this->_database->where().
   */
  public function get_by()
  {
      $where = func_get_args();

      $this->_set_where($where);

      $this->__event_trigger('before_get');

      $row = $this->_database
                ->get($this->_table)
                ->row();

      $callback_data = $this->__event_trigger('after_get', [$row]);
      $row = $callback_data ? $callback_data : $row;

    // Map
    if ($this->map) {
        $row = $row->{$this->map};
        $this->map = null;
    }

      return $row;
  }

  /**
   * Fetch all the records in the table. Can be used as a generic call
   * to $this->_database->get() with scoped methods.
   */
  public function get_all()
  {
      $this->__event_trigger('before_get');

      if ($this->dont_from) {
          $result = $this->_database
                     ->get()
                     ->result();
          $this->dont_from = false;
      } else {
          $result = $this->_database
                     ->get($this->_table)
                     ->result();
      }

      for ($i = 0; $i < count($result); ++$i) {
          $row = $result[$i];
      // remove on last iteration
      $callback_data = $this->__event_trigger('after_get', [$row], ($i == count($result)));
          $row = $callback_data ? $callback_data : $row;
      }

    // Map
    if ($this->map) {
        $result = array_map(function ($obj) {
        return $obj->{$this->map};
      }, $result);
        $this->map = null;
    }

      return $result;
  }

  /**
   * Fetch an array of records based on an arbitrary WHERE call.
   */
  public function get_many_by()
  {
      $where = func_get_args();
      $this->_set_where($where);

      return $this->get_all();
  }

  /**
   * Try to fetch the record. If no result found then return the object
   * with all the fields initiated to ''.
   */
  public function get_forced($primary_value)
  {
      $row = $this->get($primary_value);

      if (!$row) {
          $row = [];
          $fields = $this->db->list_fields($this->table());
          foreach ($fields as $field) {
              $row[$field] = '';
          }
          $row = (object) $row;
      }

      return $row;
  }

    public function get_forced_by()
    {
        $row = call_user_func_array([$this, 'get_by'], func_get_args());

        if (!$row) {
            $row = $this->get_forced(0);
        }

        return (object) $row;
    }

  /**
   * Insert a new row into the table. $data should be an associative array
   * of data to be inserted. Returns newly created ID.
   */
  public function insert($data)
  {
      $callback_data = $this->__event_trigger('before_insert', [$data]);
      $data = $callback_data ? $callback_data : $data;

      $this->_database->insert($this->_table, $data);
      $insert_id = $this->_database->insert_id();

      $this->__event_trigger('after_insert', [$insert_id]);

      return $insert_id;
  }

  /**
   * Insert multiple rows into the table. Returns an array of multiple IDs.
   */
  public function insert_many($data)
  {
      $ids = array();

      if (is_array($data)) {
          foreach ($data as $key => $row) {
              $ids[] = $this->insert($row);
          }
      }

      return $ids;
  }

  /**
   * Insert only db_fields from the $data.
   */
  public function insert_only($data)
  {
      $filtered = [];
      foreach ($data as $key => $value) {
          if ($this->db->field_exists($key, $this->table())) {
              $filtered[$key] = is_array($value) ? serialize($value) : $value;
          }
      }

      // TODO quick fix for mysql 5.7
      // check all the fields and set default fields except id
      $fields = $this->db->field_data($this->table());
      $filler = [
          'int' => 0,
          'tinyint' => 0,
          'bigint' => 0,
          'varchar' => '',
          'text' => '',
          'mediumtext' => '',
          'longtext' => '',
          'date' => date('Y-m-d'),
          'datetime' => date('Y-m-d H:i:s')
      ];
      foreach ($fields as $field) {
          // donot alter primary key
          if ($field->primary_key) continue;

          if (!isset($filtered[$field->name])) {
              $filtered[$field->name] = $filler[$field->type];
          }
      }


      return $this->insert($filtered);
  }

  /**
   * Insert in batch fashion will not produce before_insert or after_insert.
   */
  public function insert_batch($batch)
  {
      if (count($batch)) {
          $this->_database->insert_batch($this->table(), $batch);
      }
  }

  /**
   * Updated a record based on the primary value.
   */
  public function update($primary_value, $data)
  {
      $callback_data = $this->__event_trigger('before_update', [$data]);
      $data = $callback_data ? $callback_data : $data;

      $result = $this->_database
                   ->where($this->primary_key, $primary_value)
                   ->set($data)
                   ->update($this->_table);

      $this->__event_trigger('after_update', [$data, $result]);

      return $result;
  }

  /**
   * Update only db_fields from the $data.
   */
  public function update_only($primary_value, $data)
  {
      $filtered = [];
      foreach ($data as $key => $value) {
          if ($this->db->field_exists($key, $this->table())) {
              $filtered[$key] = is_array($value) ? serialize($value) : $value;
          }
      }
      if (count($filtered)) {
          return $this->update($primary_value, $filtered);
      }
  }

    public function update_only_by()
    {
        $args = func_get_args();
        $data = array_pop($args);

        $filtered = [];
        foreach ($data as $key => $value) {
            if ($this->db->field_exists($key, $this->table())) {
                $filtered[$key] = is_array($value) ? serialize($value) : $value;
            }
        }

    // reinserting filtered data
    $args[] = $filtered;

        return call_user_func_array([$this, 'update_by'], $args);
    }

  /**
   * Updated a record based on an arbitrary WHERE clause.
   */
  public function update_by()
  {
      $args = func_get_args();
      $data = array_pop($args);

      $callback_data = $this->__event_trigger('before_update', [$data]);
      $data = $callback_data ? $callback_data : $data;

      $this->_set_where($args);
      $result = $this->_database
                   ->set($data)
                   ->update($this->_table);

      $this->__event_trigger('after_update', [$data, $result]);

      return $result;
  }

  /**
   * Update all records.
   */
  public function update_all($data)
  {
      $callback_data = $this->__event_trigger('before_update', [$data]);
      $data = $callback_data ? $callback_data : $data;

      $result = $this->_database
                   ->set($data)
                   ->update($this->_table);

      $this->__event_trigger('after_update', [$data, $result]);

      return $result;
  }

  /**
   * Delete a row from the table by the primary value.
   */
  public function delete($id)
  {
      $this->__event_trigger('before_delete', [$id]);

      $this->_database->where($this->primary_key, $id);

      $result = $this->_database->delete($this->_table);

      $this->__event_trigger('after_delete', [$result]);

      return $result;
  }

  /**
   * Delete a row from the database table by an arbitrary WHERE clause.
   */
  public function delete_by()
  {
      $where = func_get_args();

      $callback_where = $this->__event_trigger('before_delete', [$where]);
      $where = $callback_where ? $callback_where : $where;

      $this->_set_where($where);

      $result = $this->_database->delete($this->_table);

      $this->__event_trigger('after_delete', [$result]);

      return $result;
  }

  /**
   * try to get the record by $get_by
   * INSERT $data IF NOT present, UPDATE it IF present
   * Returns the id.
   */
  public function save($data, $get_by = '')
  {
      // if not present only insert
    $update = true;

      if (!$get_by) {
          $get_by = $data;
          $update = false;
      }

      $db_data = $this->get_by($get_by);

      if (!count($db_data)) {
          // insert with merged get_by data
          $data = array_merge($get_by, $data);
          // remove id
          if (isset($data['id'])) unset($data['id']);

          $id = $this->insert_only($data);
      } elseif ($update) {
          $this->update_only($db_data->id, $data);
      }

      return isset($id) ? $id : $db_data->id;
  }

  /**
   * Truncates the table.
   */
  public function truncate()
  {
      $result = $this->_database->truncate($this->_table);

      return $result;
  }

  /* --------------------------------------------------------------
  * UTILITY METHODS
  * ------------------------------------------------------------ */

  /**
   * Retrieve and generate a form_dropdown friendly array.
   */
  public function dropdown()
  {
      $args = func_get_args();

      if (count($args) > 1) {
          list($key, $value) = $args;
      } else {
          $key = $this->primary_key;
          $value = $args[0];
      }

      $result = $this->_database->select(array($key, $value))
    ->get($this->_table)
    ->result();

      if (isset($args[2])) {
          $options = ['' => ''];
      } else {
          $options = [];
      }

      foreach ($result as $row) {
          $options[$row->{$key}] = $row->{$value};
      }

      return $options;
  }

  /**
   * Return the next auto increment of the table. Only tested on MySQL.
   */
  public function get_next_id()
  {
      return (int) $this->_database->select('AUTO_INCREMENT')
    ->from('information_schema.TABLES')
    ->where('TABLE_NAME', $this->_table)
    ->where('TABLE_SCHEMA', $this->_database->database)->get()->row()->AUTO_INCREMENT;
  }

  /**
   * Getter for the table name.
   */
  public function table()
  {
      return $this->_table;
  }

  /* --------------------------------------------------------------
  * INTERNAL METHODS
  * ------------------------------------------------------------ */

  /**
   * Guess the table name by pluralising the model name.
   */
  private function _fetch_table()
  {
      if ($this->_table == null) {
          $this->_table = plural(preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this))));
      }
  }

  /**
   * Guess the primary key for current table.
   */
  private function _fetch_primary_key()
  {
      if ($this->primary_key == null) {
          $this->primary_key = $this->_database->query('SHOW KEYS FROM `'.$this->_table."` WHERE Key_name = 'PRIMARY'")->row()->Column_name;
      }
  }

  /**
   * Set WHERE parameters, cleverly.
   */
  protected function _set_where($params)
  {
      if (count($params) == 1 && is_array($params[0])) {
          foreach ($params[0] as $field => $filter) {
              if (is_array($filter)) {
                  if (count($params[1]))
                  $this->_database->where_in($field, $filter);
                  else
                  $this->_database->where_in('id',[0]);
              } else {
                  if (is_int($field)) {
                      $this->_database->where($filter);
                  } else {
                      $this->_database->where($field, $filter);
                  }
              }
          }
      } elseif (count($params) == 1) {
          $this->_database->where($params[0]);
      } elseif (count($params) == 2) {
          if (is_array($params[1])) {
              if (count($params[1]))
              $this->_database->where_in($params[0], $params[1]);
              else
              $this->_database->where_in('id',[0]);
          } else {
              $this->_database->where($params[0], $params[1]);
          }
      } elseif (count($params) == 3) {
          $this->_database->where($params[0], $params[1], $params[2]);
      } else {
          if (is_array($params[1])) {
              if (count($params[1]))
                $this->_database->where_in($params[0], $params[1]);
                else
                $this->_database->where_in('id',[0]);
          } else {
              $this->_database->where($params[0], $params[1]);
          }
      }
  }
}
