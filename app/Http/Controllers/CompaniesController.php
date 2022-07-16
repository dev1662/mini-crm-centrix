<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Companies::paginate(10);
        return view('companies', compact('company'));
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
    public function store(Request $request)
    {
        // dd($request->all());exit;
        $this->validate($request,[
            // 'email' => 'required',
            'name' => 'required',
            'logo' => 'required|image|dimensions:min_width=100,min_height=100',


        ]);
        $name = $request->name;
        $email = $request->email;
        $website = $request->website;
        $logo = $request->file('logo');
        $filename = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = pathinfo($logo->getClientOriginalName(), PATHINFO_EXTENSION);
        $image = $filename."-".time().".".$logo->getClientOriginalExtension();
        $uploadPath = 'storage/';
        $logo->move($uploadPath, $image);
        $imageUrl = $image;

        $company = new Companies();
        $company->name = $name;
        $company->email = $email;
        $company->logo = $imageUrl;
        $company->website = $website;
        $company->save();
        return redirect()->to('/companies')->with('status', 'Company Created');

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
        // dd($id);exit;
        $this->validate($request,[
            // 'email' => 'required',
            'name' => 'required',
            'logo' => 'required|image|dimensions:min_width=100,min_height=100',


        ]);
        $name = $request->name;
        $email = $request->email;
        $website = $request->website;
        $logo = $request->file('logo');
        $filename = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = pathinfo($logo->getClientOriginalName(), PATHINFO_EXTENSION);
        $image = $filename."-".time().".".$logo->getClientOriginalExtension();
        $uploadPath = 'storage/';
        $logo->move($uploadPath, $image);
        $imageUrl = $image;

        $company =  Companies::find($id);
        $company->name = $name;
        $company->email = $email;
        $company->logo = $imageUrl;
        $company->website = $website;
        $company->save();
        return redirect()->to('/companies')->with('status', 'Company Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $com = Companies::find($id);
        $path = public_path().'/storage/'.$com->logo;
        if(file_exists($path)){

            unlink($path);
        }

        $com->delete();
        return redirect()->to('/companies')->with('status', 'Companies Deleted');


    }

}
