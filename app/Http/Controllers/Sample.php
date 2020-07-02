<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use DataTables;
use Crypt;

class Sample extends Controller
{
    function index()
    {
        // return session()->get('data');
        // $data = DB::table('users')->get();
        $data = User::paginate(2);
        return view('listing_view',['data'=>$data]);
    }

    function login(Request $req)
    { 
            $User = User::where("email",$req->input('username'))->get();
            $req->session()->put('data', $User);
            if(Crypt::decrypt($User[0]->password)==$req->input('password'))
            {
                $req->session()->get('data');
                return redirect('main');
            }
            else
            {
                return redirect('login');
            }
        
    }

    function register(Request $req)
    {
            $User           =   new User;
            $User->name     =   $req->input('name');
            $User->email    =   $req->input('email');
            $User->password =   Crypt::encrypt($req->input('password'));
            $User->phone    =   $req->input('phone');
            $User->save();
            $req->session()->put('User', $req->input('name'));
            $sen['res'] = true;
            $sen['result'] = $User->toArray();
            return \Response::json( $sen );
    }

    function edit($id)
    {
        $data = User::where("userId",$id)->get();
        // return Crypt::decrypt($data[0]->password); exit;
        $sen['success'] = true;
        $sen['result'] = $data->toArray();
        $sen['password']  = Crypt::decrypt($data[0]->password);
        return \Response::json( $sen );
        
    }

    function edit_update(Request $req)
    {
        // echo $req->input('userId'); exit;
        $User = User::find($req->input('userId'));
        $User->name     =   $req->input('name');
        $User->email    =   $req->input('email');
        $User->password =   Crypt::encrypt($req->input('password'));
        $User->phone    =   $req->input('phone');
        $User->save();
        $sen['res'] = true;
        $sen['result'] = $User->toArray();
        return \Response::json( $sen );
    }

    function delete($id)
    {
        User::where("userId", $id)->delete();
        return redirect('main')->with('success','deleted successfully');
    }

}