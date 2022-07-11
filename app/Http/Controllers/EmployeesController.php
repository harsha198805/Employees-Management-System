<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Employees;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['companies']=Companies::orderBy('id','desc')->get();

      //$post_query=Employees::get();
      $post_query = new Employees();
    
      if($request->companies){
        $post_query->whereHas('Companies',function($q) use ($request){
         $q->where('name',$request->companies);
        });
      }

      if($request->keyword){
       $post_query->where('title','LIKE','%'.$request->keyword.'%');
      }

      $data['employees']=$post_query->orderBy('id','DESC')->paginate(10);
      return view('employee.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
       $data['companies']=Companies::orderBy('id','desc')->get();
       return view('employee.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'fname'=>'required|max:255',
         'lname'=>'required|max:255',
         "email" => ['unique:employees,email', 'email', 'nullable'],
         'phone' => ['numeric', 'digits_between:10,12', 'unique:employees,phone', 'nullable'],
         'companies'=>'required'
        ],[
         'companies.required'=>'Please select a companies.'
        ]);

        $post=Employees::create([
         'fname'=>$request->fname,
         'lname'=>$request->lname,
         'email'=>$request->email,
         'phone'=>$request->phone,
         'company_id'=>$request->companies
        ]);

        return redirect()->route('employees.index')->with('success','Employees successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['employees']=Employees::findOrFail($id);
        return view('employee.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      
       $data['employees']=Employees::findOrFail($id);
       $data['companies']=Companies::orderBy('id','desc')->get();
       return view('employee.edit',$data);
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

        $post=Employees::findOrFail($id);

        $request->validate([
            'fname'=>'required|max:255',
            'lname'=>'required|max:255',
            "email" => [\Illuminate\Validation\Rule::unique('employees')->ignore($id), 'email', 'nullable'],
            'phone' => ['numeric', 'digits_between:10,12', \Illuminate\Validation\Rule::unique('employees')->ignore($id), 'nullable'],
            'companies'=>'required'
           ],[
            'companies.required'=>'Please select a companies.'
           ]);

        $post->update([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company_id'=>$request->companies
        ]);
        return redirect()->route('employees.index')->with('success','Employees successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post=Employees::findOrFail($id);
         $post->delete();
        return redirect()->route('employees.index')->with('success','Employees successfully deleted.');
    }
}
