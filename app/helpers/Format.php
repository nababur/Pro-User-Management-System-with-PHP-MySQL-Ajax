<?php
/**
* Format Class
*/
  class Format{

    // Date formate Method 
     public function formatDate($date){
        $strtime = strtotime($date);
      return date('Y-m-d H:i:s', $strtime);
     }
     // Readmore or Textshorten formate Method 
     public function textShorten($text, $limit = 400){
        $text = $text. " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text.".....";
        return $text;
     }

     // Text Validation formate Method 
     public function validation($data){
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }


     // Sanitize get URL from ID
     public function sanitizeid($data){
        $pattern = '/^TEXTMASH-[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/';
        $data = preg_match($pattern, $data);
        $data = htmlentities($data);
        $data = (int)($data);
        return $data;

     }


     // Email Validate formate Method 
     public function validateEmail($data){
        $data = filter_var($data, FILTER_VALIDATE_EMAIL);
        return $data;
     }

     // Title URL
     public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        //$title = str_replace('_', ' ', $title);
        if ($title == 'index') {
         $title = 'home';
        }elseif ($title == 'contact') {
         $title = 'contact';
        }
        return $title = ucfirst($title);
     }


     // Create Base Url
    function base_url(){
      return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
      );
    }











  }
?>