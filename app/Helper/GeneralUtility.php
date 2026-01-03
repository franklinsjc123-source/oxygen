<?php

namespace App\Helper;

class GeneralUtility
{
    /* #Start UTF 8 Session */
    //UTF 8 Lastest Update: 27-04-2022
    public function utf8Converter($array)
    {
        if ($array) {
            array_walk_recursive($array, function (&$item, $key) {
                if (is_string($item)) {
                    if (!mb_detect_encoding($item, 'utf-8', true)) {
                        $item = utf8_encode($item);
                    }
                }
            });
        }
        return $array;
    }

    /* #End UTF 8 Session */

    /* #Start Object Handler */
    // Object to Object Mapping
    function stdToTypeClass($instance, $className)
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            strlen($className),
            $className,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }

    // Sidd_K Last Update: 27-04-2022
    // To handle manual way for those array from Elequent Model to Array; if casting array like (array) someElequentModel will come out *columnname     
    function objectToArray($object, $exclude_keys = null)
    {
        $array = array();
        if (!is_object($object) && !is_array($object)) {
            return $object;
        } else {

            foreach ($object as $key => $value) {
                if ($exclude_keys != null && is_array($exclude_keys)) {
                    if (!in_array($key, $exclude_keys)) {
                        $array[$key] =  $value;
                    }
                } else {
                    $array[$key] =  $value;
                }
            }

            return $this->utf8Converter($array);
        }
    }

    //Sidd_K 27-04-2022
    public function removeProperty($obj, $key)
    {
        if (is_object($obj))
            unset($obj->{$key});
        else
            unset($obj[$key]);
        return $obj;
    }

    //Sidd_K 27-04-2022
    public function removeProperties($obj, $keys)
    {
        foreach ($keys as $key) {
            if (is_object($obj))
                unset($obj->{$key});
            else
                unset($obj[$key]);
        }
        return $obj;
    }

    //Sidd_K 27-04-2022
    public function keepProperties($obj, $keys)
    {
        foreach ($obj as $obj_key => $obj_value) {
            if (!in_array($obj_key, $keys)) {

                if (is_object($obj))
                    unset($obj->{$obj_key});
                else
                    unset($obj[$obj_key]);
            }
        }
        return $obj;
    }

    /* #End Object Handler */

    /* #Start Validation Helper */
    //Validation Latest Update: 28-04-2022
    function isNullOrEmptyString($str)
    {
        return (!isset($str) || trim($str) === '');
    }

    function nullToEmptyString($str)
    {
        if (is_null($str))
            return "";
        else
            return $str;
    }

    function isDateTime($str)
    {
        return (strtotime($str));
    }

    public function convertBlankNumberToNegativeOne($value)
    {
        if (isset($value) && $value == '')
            $value = -1;
        return $value;
    }
    /* #End Validation Helper */

    /* #Start Query Helper */

    //Sidd_K 27-04-2022
    public function composeSP($spName, $obj)
    {
        $sp = "Exec " . $spName . " ";
        $paramArray = array();
        foreach ($obj as $key => $value) {

            $sp = $sp . "@" . $key . " = ?, ";
            if (gettype($value) == "string") {
                $value = trim($value);
            }

            $paramArray[] = $value;
        }
        $sp = rtrim($sp, ", ");

        $spAndParam = new \stdClass;
        $spAndParam->sp = $sp;
        $spAndParam->param = $paramArray;
        return $spAndParam;
    }
    /* #End Query Helper */
}
