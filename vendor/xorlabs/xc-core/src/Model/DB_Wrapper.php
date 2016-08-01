<?php

namespace XORLabs\XC\Core\Model;

trait DB_Wrapper
{
    public function select($fields, $model = '') {
      $fields = explode(',', $fields);
      $table = $model ? model($model)->table() : $this->table();

      foreach ($fields as $field) {
        $field = trim($field);
        if (strpos($field, '(') > 0) {
          $select = $field;
        }
        else {
          $select = $table . '.' . $field;
        }
        $this->_database->select($select);
      }
      return $this;
    }

  /**
   * A wrapper to $this->_database->select().
   */
  public function select_as($field, $as, $model = '')
  {
      $table = $model ? model($model)->table() : $this->table();
      $this->_database->select("{$table}.{$field} as {$as}");

      return $this;
  }

  /**
   * Join with model.
   */
  public function join($model, $model_field, $self_field, $type = '')
  {
      $model_table = model($model)->table();
      $self_table = $this->table();

      $this->_database->join($model_table, "{$model_table}.{$model_field} = {$self_table}.{$self_field}", $type);

      return $this;
  }

    public function join_custom($table, $custom, $type = '')
    {
        $this->_database->join($table, $custom, $type);

        return $this;
    }

  /**
   * Join where build up.
   */
  public function where($col, $val, $model = '')
  {
      $table = $model ? model($model)->table() : $this->table();
      $col = "{$table}.{$col}";

      $this->_database->where($col, $val);

      return $this;
  }

  /**
   * Group by.
   */
  public function group_by()
  {
      $where = func_get_args();
      foreach ($where as $w) {
          $this->_database->group_by($w);
      }

      return $this;
  }

  /**
   * A wrapper to $this->_database->order_by().
   */
  public function order_by($criteria, $order = 'ASC')
  {
      if (is_array($criteria)) {
          foreach ($criteria as $key => $value) {
              $this->_database->order_by($key, $value);
          }
      } else {
          $this->_database->order_by($criteria, $order);
      }

      return $this;
  }

  /**
   * A wrapper to $this->_database->limit().
   */
  public function limit($limit, $offset = 0)
  {
      $this->_database->limit($limit, $offset);

      return $this;
  }

  /**
   * directly running query.
   */
  public function query($sql)
  {
      return $this->_database->query($sql);

      return $this;
  }

    public function group_start()
    {
        call_user_func_array([$this->_database, 'group_start'], func_get_args());

        return $this;
    }

    public function or_group_start()
    {
        call_user_func_array([$this->_database, 'or_group_start'], func_get_args());

        return $this;
    }

    public function not_group_start()
    {
        call_user_func_array([$this->_database, 'not_group_start'], func_get_args());

        return $this;
    }

    public function or_not_group_start()
    {
        call_user_func_array([$this->_database, 'or_not_group_start'], func_get_args());

        return $this;
    }

    public function group_end()
    {
        call_user_func_array([$this->_database, 'group_end'], func_get_args());

        return $this;
    }

  /**
   * Wrapper for where_in.
   */
  public function where_in($key, $values)
  {
      $this->_database->where_in($key, $values);

      return $this;
  }

    public function or_where()
    {
        call_user_func_array([$this->_database, 'or_where'], func_get_args());

        return $this;
    }

    public function like($title, $match, $wildcardPos = 'both', $model = '')
    {
        $table = $model ? model($model)->table() : $this->table();
        $title = "{$table}.{$title}";

        $this->_database->like($title, $match, $wildcardPos);

        return $this;
    }

    public function or_like($title, $match, $wildcardPos = 'both', $model = '')
    {
        $table = $model ? model($model)->table() : $this->table();
        $title = "{$table}.{$title}";

        $this->_database->or_like($title, $match, $wildcardPos);

        return $this;
    }

    public function start_cache()
    {
        $this->_database->start_cache();

        return $this;
    }

    public function stop_cache()
    {
        $this->_database->stop_cache();

        return $this;
    }

    public function flush_cache()
    {
        $this->_database->flush_cache();

        return $this;
    }

    public function get_compiled_select($reset = true)
    {
        return $this->_database->get_compiled_select($this->table(), $reset);
    }

  /**
   * Fetch a count of rows based on an arbitrary WHERE call.
   */
  public function count_by()
  {
      $where = func_get_args();
      $this->_set_where($where);

      return $this->_database->count_all_results($this->_table);
  }

    public function count_all_results($reset = true)
    {
        return $this->_database->count_all_results($this->_table, $reset);
    }

  /**
   * Fetch a total count of rows, disregarding any previous condition.
   */
  public function count_all()
  {
      return $this->_database->count_all($this->_table);
  }

    public function last_query()
    {
        return $this->_database->last_query();
    }
}
