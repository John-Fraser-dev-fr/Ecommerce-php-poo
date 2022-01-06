<?php 

class Alert
{
    public static function messageFlash($msg)
    {
  
      echo"<div class='alert alert-dismissible alert-success'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <p>$msg</p>
    </div>";
    }
}