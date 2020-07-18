<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\diem;
use App\student;
use App\vang;

class StudentController extends Controller
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
        $date = date('yy-m-d');
        $stu = new vang;
        $stu->idclass = $request->idclass;
        $stu->idsv = $request->idsv;
        $stu->date = $date;
        $stu->save();
        return $stu=vang::where('idclass',$request->idclass)->where('idsv',$request->idsv)->count('idsv');
        
       
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
        $today = date('yy-m-d');
        $date="";
        $idsv = diem::select("idsv")->where('idclass',$id)->get();
        $students = student::select("thongtinsv.*","diem.idclass")
        ->join('diem','thongtinsv.id','=','diem.idsv')
        ->orderBy("thongtinsv.masv",'asc')
        ->where("idclass",$id)->find($idsv);
        foreach($students as $student){
            $student->vang = vang::where('idclass',$id)->where('idsv',$student->id)->count('idsv');
            $buoivang = vang::where('idclass',$id)->where('idsv',$student->id)->orderBy('date','desc')->first();
            if(isset($buoivang)){
            if($today===$buoivang->date){
                $student->dd = 1;
            }
            else{
                $student->dd = 0;
            }
        }else $student->dd = 0;
    }
        return response()->json($students);
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
    public function diemdanh(Request $request){
        $date = date('yy-m-d');
        $stu = vang::where('idclass',$request->idclass)->where('idsv', $request->idsv)->where('date',$date);
        $stu->delete();
        return response()->json(vang::all());
    }
    public function ngayvang(Request $request){
        $stu = vang::select('date')->where('idsv',$request->idsv)->where('idclass', $request->idclass)->get();
        return response()->json($stu);
    }
}
