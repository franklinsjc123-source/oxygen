<?php

namespace App\Models\ViewModels;

class UserVM
{
    public  $userId, $userName, $email, $phoneNo, $loginDateTime;

    public function __construct($user = null)
    { 
        if($user != null){
            $this->userId    = $user->userId;
            $this->userName  = $user->userName;
            $this->email     = $user->email;
            $this->phoneNo   = $user->phoneNo;
            $now = new \DateTime('now', new \DateTimeZone('Asia/Singapore')); 
            $this->loginDateTime  = $now->format('d/m/Y');

            session(['userId' => $user->userId]);
            session(['userName' => $user->userName]);
            session(['email' => $user->email]);
            session(['phoneNo' => $user->phoneNo]);
            session(['loginDateTime' => $now->format('d/m/Y')]);
        }
        else if (session('userId') != null){
            $this->userId  = session('userId');
            $this->userName  = session('userName');
            $this->email  = session('phoneNo');
            $this->phoneNo  = session('phoneNo');
            $this->loginDateTime  = session('loginDateTime');
        }
    } 
}
