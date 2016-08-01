<?php

namespace XORLabs\XC\Core\Model;

trait Utility
{
    /**
   * toggle value 0 / 1.
   */
  public function toggle($primary_key, $field)
  {
      $value = $this->get($primary_key)->$field;

      ($value == 0) ? $this->update($primary_key, [$field => 1])
                    : $this->update($primary_key, [$field => 0]);

      return true;
  }

  /**
   * Increment value by $inc.
   */
  public function increment($primary_key, $field, $inc = 1)
  {
      $value = $this->get($primary_key)->$field;
      $this->update($primary_key, [$field => ($value + $inc)]);
  }

    public function active($primary_key, $field)
    {
        $this->update($primary_key, [$field => 1]);
    }

    public function deactive($primary_key, $field)
    {
        $this->update($primary_key, [$field => 1]);
    }
}
