<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Employees;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data['companies']=Companies::orderBy('id','desc')->paginate(10);
      return view('company.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
       $data['companies']=Companies::orderBy('id','desc')->get();
       return view('company.create',$data);
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
         "email" => ['unique:companies,email', 'email', 'nullable'],
         'website' => 'required|max:255',
         'image'=>'required|mimes:jpeg,jpg,png'
        ]);

        if($request->hasFile('image')){
            $image=$request->file('image');
            $image_name=time().'.'.$image->extension();
            $image->move(public_path('post_images'),$image_name);
        }
        $post=Companies::create([
         'name'=>$request->fname,
         'email'=>$request->email,
         'logo'=>$image_name,
         'website'=>$request->website
        ]);

        return redirect()->route('companies.index')->with('success','Companies successfully created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['companies']=Companies::findOrFail($id);
        return view('company.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       $data['companies']=Companies::findOrFail($id);
       return view('company.edit',$data);
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

        $post=Companies::findOrFail($id);

        $request->validate([
            'fname'=>'required|max:255',
            "email" => ['email', 'nullable', \Illuminate\Validation\Rule::unique('companies')->ignore($id)],
            'website' => 'required|max:255',
            'image'=>'nullable|mimes:jpeg,jpg,png',
           ]);


           if($request->hasFile('image')){
            $image=$request->file('image');
            $image_name=time().'.'.$image->extension();
            $image->move(public_path('post_images'),$image_name);
            $old_path=public_path().'post_images/'.$post->image;

            if(\File::exists($old_path)){
             \File::delete($old_path);
            }

        }else{
           $image_name =$post->logo;
        }
        $post->update([
            'name'=>$request->fname,
            'email'=>$request->email,
            'logo'=>$image_name,
            'website'=>$request->website
        ]);
        return redirect()->route('companies.index')->with('success','Companies successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post=Companies::findOrFail($id);
         $post->delete();
        return redirect()->route('companies.index')->with('success','Companies successfully deleted.');
    }
}
