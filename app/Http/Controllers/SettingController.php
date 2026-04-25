<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repository\SharedRepo;
use App\Helper\CommonHelper;
use App\Repository\ProfileRepo;
use Illuminate\Support\Facades\Session;


class SettingController extends Controller
{ 
    public function __construct(SharedRepo $sharedRepo, CommonHelper $commonHelper, ProfileRepo $profileRepo)
    {
        $this->sharedRepo   = $sharedRepo;
        $this->commonHelper   = $commonHelper;
        $this->profileRepo   = $profileRepo;
    }
    public function profile()
    {
        $userId = Session::get('userId');
        $status = Session::get('status');
        $viewBag['data'] = $this->profileRepo->getRecords($userId); 
        
        if ($status == 2) {
            return view('layout.vendor.setting.profile', $viewBag);
        }
        
        return view('layout.admin.setting.profile', $viewBag);
    }
}
