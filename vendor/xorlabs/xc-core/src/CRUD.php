<?php
namespace XORLabs\XC\Core;

require_once __DIR__ . '/grocery-crud/application/libraries/Grocery_CRUD.php';
require_once __DIR__ . '/grocery-crud/application/models/Grocery_crud_model.php';

class CRUD extends \Grocery_CRUD {

  protected $default_assets_path = 'themes/app-crud/assets/grocery_crud';
  protected $default_language_path = 'themes/app-crud/assets/grocery_crud/languages';

}
