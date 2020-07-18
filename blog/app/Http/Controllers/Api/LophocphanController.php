<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\diem;
use App\student;
use App\vang;
use App\lophocphan;
use App\gv;

class LophocphanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $stu = new diem;
        $stu->idclass = $request->idclass;
        $stu->idsv = $request->idsv;
        $stu->test = $request->test;
        $stu->midterm = $request->midterm;
        $stu->endterm = $request->endterm;
        $stu->avarage = (0.2*$request->test+0.3*$request->midterm+0.5*$request->endterm);
        $stu->save();
        $gv = lophocphan::where('idclass',$request->idclass)->get();
        foreach($gv as $id ){
            $idgv = $id->idgv;
        }
        return $idgv;
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
        $idsvs = diem::select('idsv')->where('idclass', $id)->get();
        $idsvm = student::select('id')->get();
        foreach($idsvm as $ids){
            foreach($idsvs as $idsv){
                if($ids->id==$idsv->idsv){
                    $ids->id = 0;
                }
                
            }
        }
        $stu = student::find($idsvm);
        return response()->json($stu);
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

    public function capnhat(Request $request){
        $stus = diem::where('idclass', $request->idclass)->where('idsv', $request->idsv)
        ->update(['test' => $request->test, 'midterm' => $request->midterm, 'endterm' => $request->endterm, 
        'avarage' => (0.2*$request->test+0.3*$request->midterm+0.5*$request->endterm)]);
        
        $stus = diem::where('idclass', $request->idclass)->where('idsv', $request->idsv)->get();
        return response()->json($stus);
    }
    public function xoa(Request $request){
        $stu = diem::where('idclass', $request->idclass)->where('idsv', $request->idsv)->delete();
        $stu = vang::where('idclass', $request->idclass)->where('idsv', $request->idsv)->delete();
        return diem::all();
    }
}
