<?php

namespace XORLabs\XC\Core\Model;

trait Observers
{
    /**
   * MySQL DATETIME created_at and updated_at.
   */
  public function created_at($row)
  {
      $row['created_at'] = date('Y-m-d H:i:s');

      return $row;
  }

    public function updated_at($row)
    {
        $row['updated_at'] = date('Y-m-d H:i:s');

        return $row;
    }
}
