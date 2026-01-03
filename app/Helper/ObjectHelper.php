<?php
namespace App\Helper;
class ObjectHelper
{
      //Min 2022-02-10
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

      // Min Last Update: 2021-11-10 
      // To handle manual way for those array from Elequent Model to Array;
      // if casting array like (array) someElequentModel will come out *columnname 
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

                  return $this->converterUTF8($array);
            }
      }

      //Min 19-03-2021 
      function removeProperty($obj, $key)
      {
            if (is_object($obj))
                  unset($obj->{$key});
            else
                  unset($obj[$key]);
            return $obj;
      }

      //Min 19-03-2021 
      function removeProperties($obj, $keys)
      {
            foreach ($keys as $key) {
                  if (is_object($obj))
                        unset($obj->{$key});
                  else
                        unset($obj[$key]);
            }
            return $obj;
      }

      //Min 19-03-2021 
      function keepProperties($obj, $keys)
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


      //sample
      //mapObject($jwtPayload, (object) $Eloquent->getRawOriginal(), "SourceClassName");
      function mapObject(&$destinationObj, $sourceObj, $sourceClassName = "stdClass")
      {
            foreach ($sourceObj as $skey => $svalue) {
                  foreach ($destinationObj as $dkey => $dvalue) {
                        if ($dkey == $skey) {
                              $destinationObj->{$dkey} =  $sourceObj->{$skey};
                        } else if (method_exists($destinationObj, 'custom_map')) {

                              $destinationObj->custom_map($sourceClassName, $skey, $svalue);
                        }
                  }
            }
      }

      function deepCloneObj($sourceObj){
            return clone $sourceObj;
      }

      function deepCloneArray($sourceObj){
            $new = array();
            foreach ($sourceObj as $k => $v) {
                  $new[$k] = clone $v;
            }
            return $new;
      }
      /* #End Object Handler */

      /* #Start UTF 8 Session */
      //UTF 8 Lastest Update: 2021-11-05 
      function converterUTF8($array)
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
}
