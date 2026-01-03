<?php

namespace App\Helper;

class ApiHelper
{
 
      public function getHeaders($token = null)
      {
            $headers = ['Content-Type: application/json'];
            if ($token != null) {
                  $authorization = "Authorization: Bearer " . $token;
                  array_push($headers, $authorization);
            }
            return $headers;
      }

      public function getMultipartHeaders($token = null)
      {
            $headers = ['Content-Type: multipart/form-data'];
            if ($token != null) {
                  $authorization = "Authorization: Bearer " . $token;
                  array_push($headers, $authorization);
            }
            return $headers;
      }

      public function authApiCall($url, $type, $data, $headers = null)
      {
            $post =  (array) $data;
            if ($headers == null) {
                  $headers = $this->getHeaders();
            }
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);

            if ($result === false) {
                  return "Fail in call";
                  exit;
            } else {

                  $return_object = json_decode($result);
                  //if (isset($return_object->result) && !empty($return_object->result[0])) { // This comment is For VO API
                  if (isset($return_object)) {
                        // return $return_object->result[0]; // This comment is For VO API
                        return $return_object;
                  } else {
                        return  $result;
                  }
            }
      }

      public function dataApiCall($url, $type, $data, $headers = null)
      {
            $post =  (array) $data;

            if ($headers == null) {
                  $headers = $this->getHeaders();
            }
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            if ($result === false) {
                  return "Fail in call";
                  exit;
            } else {

                  $return_object = json_decode($result);
                  //if (isset($return_object->result) && !empty($return_object->result[0])) { // This comment is For VO API
                  if (isset($return_object)) {
                        // return $return_object->result[0]; // This comment is For VO API
                        return $return_object;
                  } else {
                        return  $result;
                  }
            }
      }
}
