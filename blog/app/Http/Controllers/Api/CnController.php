<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\diem;
use App\student;
use App\gv;
use App\vang;

class CnController extends Controller
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
        
        $stu = new student;
        $stu->name = $request->name;
        $stu->age = $request->age;
        $stu->address = $request->address;
        $stu->class = $request->class;
        $stu->idclasssh = $request->idclasssh;
        $stu->masv = $request->masv;
        $stu->save();
        return response()->json("success");
        
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
        $idclass = gv::select('idclasscn')->where('id',$id)->get();
        foreach($idclass as $id){
            $listsv = student::where('idclasssh',$id->idclasscn)->orderBy("masv",'ASC')->get();
        }
        return response()->json($listsv);
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
        $stu = student::find($id);
        $stu->name = $request->name;
        $stu->age = $request->age;
        $stu->address = $request->address;
        $stu->masv = $request->masv;
        $stu->save();
        $stu = student::find($id);
        return response()->json($stu);
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
        $stu = student::where('id',$id)->delete();
        
        $sv = diem::where('idsv', $id)->delete();
        
        $stu = vang::where('idsv', $id)->delete();
        
        return response()->json(student::all());
    }
}
