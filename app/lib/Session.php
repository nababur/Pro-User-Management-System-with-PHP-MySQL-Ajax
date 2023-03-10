<?php
class Session{
  
   public static function init(){
    if (version_compare(phpversion(), '5.4.0', '<')) {
          if (session_id() == '') {
              session_start();
          }
      } else {
          if (session_status() == PHP_SESSION_NONE) {
              session_start();
          }
      }
   }
   
   public static function set($key, $val){
    $_SESSION[$key] = $val;
   }

   public static function get($key){
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    } else {
      return false;
    }
   }

   public static function checkUserSession(){
    self::init();
    if (self::get("userLogin") == false) {
      self::destroy();
      echo "<script>location.href='login.php';</script>";
    }
   }

   public static function checkSession(){
    self::init();
    if (self::get("login") == false) {
      self::destroy();
      echo "<script>location.href='dashboard.php';</script>";
    }
   }

   public static function checkUserLogin(){
    self::init();
    if (self::get("userLogin") == true) {
      echo "<script>location.href='dashboard.php';</script>";
    }
   }

   public static function destroy(){
    session_destroy();
   
     echo "<script>location.href='login.php';</script>";
    session_unset();

   }
}

?>