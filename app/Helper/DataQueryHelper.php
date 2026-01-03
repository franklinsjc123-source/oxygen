<?php
namespace App\Helper;
class DataQueryHelper
{
      /* #Start Query Helper */
      //Min 21-03-2021 
      function composeSP($sp_name, $obj = null)
      {
            $sp = "Exec " . $sp_name . " ";
            $param_array = array();
            if($obj != null)
            foreach ($obj as $key => $value) {

                  $sp = $sp . "@" . $key . " = ?, ";
                  if (gettype($value) == "string") {
                        $value = trim($value);
                  }

                  $param_array[] = $value != null? $value  : NULL;
            }
            $sp = rtrim($sp, ", ");

            $sp_and_param = new \stdClass;
            $sp_and_param->sp = $sp;
            $sp_and_param->param = $param_array;
            return $sp_and_param;
      }
}
/* #End Query Helper collection */