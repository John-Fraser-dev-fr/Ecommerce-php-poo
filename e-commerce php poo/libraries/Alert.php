<?php 

class Alert
{
    public static function success($msg)
    {
  
      echo"<div class='alert alert-dismissible alert-success'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <p>$msg</p>
    </div>";
    }

    public static function danger($msgAlert)
    {
        echo"<div class='alert alert-dismissible alert-danger'>
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
      <p>$msgAlert</p>
    </div>";
    }
}