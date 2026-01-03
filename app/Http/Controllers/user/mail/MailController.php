<?php

namespace App\Http\Controllers\user\mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Mail;
// use App\user\mail\
class MailController extends Controller
{
 
    public function sendcontactmail(Request $request)
    {
    $contact_data = [];
    $contact_data['name'] = $request->input('name');
    $contact_data['email'] = $request->input('email');
    $contact_data['review'] = $request->input('review');
    $contact_data['description'] = $request->input('description');
    }
}
