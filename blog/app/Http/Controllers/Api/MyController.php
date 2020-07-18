<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\account;
use App\lophocphan;
use App\diem;
use Illuminate\Support\Facades\Response;
class MyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $account = account::where("id",'1')->get();
        return response()->json($account);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        echo"store";
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
        $list = lophocphan::where('idgv',$id)->get();
        foreach($list as $item){
            $number = diem::where('idclass',$item->idclass)->count('idsv');
            $item->number=$number;
        }
        return response()->json($list);
        
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
        $gv = account::find($id);
        $gv->pass = $request->pass;
        $gv->save();
        return response()->json(account::find($id));
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
    public function login(Request $request){
        $user = $request->user;
        $pass = $request->pass;
        $s = 'error';
        $id;
        $acc = account::select('id')->where('user',$user)->where('pass',$pass)->get();
        foreach($acc as $acc){
            $id = $acc->id;
        }
        if(isset($id)){
            return $acc->id;
        }
        else{
            return $s;
        }
        
    }
    public function diem(Request $request){
        $stu = diem::where('idclass', $request->idclass)->where('idsv', $request->idsv)->get();
        foreach($stu as $bt){
            $test = $bt->test;
        }
        return $stu;
    }
}
