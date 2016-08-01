<?php
namespace XORLabs\XC\Core;
use XORLabs\XC\Helpers\File;
use XORLabs\XC\Helpers\Dir;
use XORLabs\XC\Core\Events;

class Upload {
  // using trait
  use Events;

  // defining events
  const __EVENTS = ['after_upload'];

  protected static $_mime_types;

  protected static $_instance;

  // Instace properties
  // -------------------

  // store the custom file obj
  protected $_file;

  // rename method helper
  protected $_rename = 'time';

  // store relative path helper
  protected $_relative_path = 'ym';


  public static function get_instance() {
    if ( ! self::$_instance) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  protected function _set_file($field) {
    // check
    if ( ! isset($_FILES[$field])) {
      alert()->set_error($field . ' file not uploaded');
      return false;
    }
    // PHP inbuilt
    $file = (object) $_FILES[$field];
    $file->ext = File::ext($file->name);
    $file->field = $field;

    // rename file
    $file->rename = Upload\Rename::exec($this->_rename, $file);

    // relative path
    $file->rel_path = Upload\Relative_Path::exec($this->_relative_path, $file);

    $file->dir = APP_UPLOADS . '/' . $file->rel_path;
    $file->full_name = APP_UPLOADS . '/' . $file->rel_path . '/' . $file->rename;

    // check if file exist
    if (File::file_exists($file->full_name)) {
      // rename file
      $file->rename = File::name_insert($file->rename, '-'.time());

      // relative path
      $file->rel_path = \XORLabs\XC\Upload\Relative_Path::exec($this->_relative_path, $file);

      $file->dir = APP_UPLOADS . '/' . $file->rel_path;
      $file->full_name = APP_UPLOADS . '/' . $file->rel_path . '/' . $file->rename;
    }

    // set
    $this->_file = $file;
  }

  protected function _set_rename($method) {
    $method ? $this->_rename = $method : '';
  }

  protected function _set_relative_path($method) {
    $method ? $this->_relative_path = $method : '';
  }

  /**
   * post request at form
   */
  public function do_upload($field, $rename_method = '', $relative_path_method = '') {
    $this->_set_rename($rename_method);
    $this->_set_relative_path($relative_path_method);
    $this->_set_file($field);

    if ( ! $this->file_check()) return false;

    // make dir
    DIR::cmkdir($this->_file->dir, 0777, true);

    // save file
    if (move_uploaded_file($this->_file->tmp_name, $this->_file->full_name)) {
      // save db
      $id = model('upload')->insert([
        'name' => $this->_file->rename,
        'caption' => '',
        'uri' => '/uploads' . '/' . $this->_file->rel_path . '/' . $this->_file->rename,
        'md5' => md5_file($this->_file->full_name),
        'size' => $this->_file->size,
        'mime' => $this->_file->type,
        'ext' => $this->_file->ext,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ], true);

      // callback after upload
      $this->__event_trigger('after_upload', [$id, $this->_file]);

      return $id;
    }
    else {
      Alert::set_error('File MOVE error');
      return false;
    }
  }

  public function do_multi_upload($field) {
    $ids = [];
    foreach ($_FILES[$field]['name'] as $key => $name) {
      $_FILES["{$field}_{$key}"] = [
        'name' => $_FILES[$field]['name'][$key],
        'type' => $_FILES[$field]['type'][$key],
        'tmp_name' => $_FILES[$field]['tmp_name'][$key],
        'error' => $_FILES[$field]['error'][$key],
        'size' => $_FILES[$field]['size'][$key]
      ];
      $ids["{$field}_{$key}"] = $this->do_upload("{$field}_{$key}");
    }
    return $ids;
  }

  public function file_check() {
    if ($this->_file->error !== 0) {
      Alert::set_error('File UPLOAD error');
      return false;
    }
    else if ( ! self::exist($this->_file->ext, $this->_file->type)) {
      Alert::set_error('File RECOGNIZE error');
      return false;
    }
    else {
      return true;
    }
  }


  public static function mimes() {
    if ( ! self::$_mime_types) {
      require_once __DIR__ . '/Upload/mimes.php';
      self::$_mime_types = $mime_types;
    }
    return self::$_mime_types;
  }

  public static function exist($ext, $mime) {
    $mimes = isset(self::mimes()[$ext]) ? self::mimes()[$ext] : false;
    return ($mimes && in_array($mime, $mimes));
  }

}
