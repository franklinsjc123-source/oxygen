<?php

namespace App\Http\Controllers\user\userlogin;

use App\Http\Controllers\Controller;
use App\Models\User\Userreg;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserloginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.front-end.usersignin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        // dd($request->all());
        $userreg = new Userreg();
        $statement = FacadesDB::select("SHOW TABLE STATUS LIKE 'userregs'");
        $stmt = FacadesDB::select("SHOW TABLE STATUS LIKE 'users'");
        // print_r($statement);
        // exit();
        $user_id = $statement[0]-> Auto_increment;
       $id = $stmt[0]-> Auto_increment;
        try {
            
        $use_id = $userreg->id = $user_id;

        $userreg->name = $request->username;
        $userreg->mobileno = $request->mobileno;
        $userreg->password = $request->password;
       //dd($userreg);
        $userreg1 = $userreg->save();
      


        if($userreg1)
        {
            $user = new User();
            $pass   =  Hash::make($request->password);
            $user->id = $id;
            //$user->admin_id = 0;
            // $user->vendor_id = $ven;
            $user->login_id = $use_id;
           
            $user->name     = $request->username;
            $user->firstName = 'NUll';
            $user->lastName =  'NUll';
            $user->email =   'NUll';
            $user->username = $request->username;
            $user->password = $pass;
            $user->level = 0;
            $user->status = 3;
        //    dd($user);
            $user->save();
        }else{
           return 'failde'   ;
           
        }

        $flasher->addSuccess('User Information has been saved successfully!');
            return redirect()->route('home');
        

        } catch (\Throwable $th) {
            //$flasher->addError('Something Error!!');
            $flasher->addError('Something Error!! =>' . $th);
            return redirect()->route('home');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
