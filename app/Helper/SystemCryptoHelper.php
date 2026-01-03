<?php
namespace App\Helper;
class SystemCryptoHelper
{

    
    public function generateCryptoHashKey()
    {
        $random_hex = base64_encode(random_bytes(8));
        return $random_hex;
    }

    public function encrypt($data, $key = null)
    {
        if( $key == null)
            $key = config('app.openSSLPassword');
        return  $encrypted_string = openssl_encrypt($data, "AES-128-ECB", $key);
    }

    public function decrpty($data, $key = null)
    {
        if( $key == null)
            $key = config('app.openSSLPassword');
        return  openssl_decrypt($data, "AES-128-ECB", $key);
    }

    public function composeURLFriendly($url)
    {

        return  str_replace(array('+', '/', '='), array('-', '_', '~'), $url);
    }

    public function deComposeURLFriendly($urlFriendly)
    {
        return  str_replace(array('-', '_', '~'), array('+', '/', '='), $urlFriendly);
    } 

}