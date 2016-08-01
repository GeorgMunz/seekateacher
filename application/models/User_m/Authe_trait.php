<?php
namespace User_m;

trait Authe_trait {
  /* --------------------------------------------------------------
  * OBSERVERS
  * ------------------------------------------------------------ */

  /**
  * Hash the password before storing it to database
  */
  public function password_hash_before_create($row) {
    if (isset($row['password']) && $row['password'])
    {
      // Called at time of storing
      $row['password'] = $this->password_hash($row['password']);
    }

    return $row;
  }

  /**
  * Hash the password before storing it to database
  */
  public function password_hash_before_update($array) {
    list($primary_value, $row) = $array;
    if (isset($row['password']) && $row['password'])
    {
      // Called at time of storing
      $row['password'] = $this->password_hash($row['password']);
    }

    return [$primary_value, $row];
  }

  /* --------------------------------------------------------------
  * Helper methods
  * ------------------------------------------------------------ */

  public function password_hash($password) {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  public function password_verify($password, $hash) {
    return password_verify($password, $hash);
  }

}
