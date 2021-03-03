<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Http\Response;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderby('created_at','DESC')->get();
        return view('brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
       $this->validate($request, [
        'name' => 'required|min:2|max:50|unique:categories'
   ]);

   $brand = new Brand();
   $brand->name = $request->name;
   $brand->save();

   flash('Brand created successfully')->success();
   return back();
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
        $brand = Brand::findorFail($id);
        return view('brands.edit',compact('brand'));
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
        $this->validate($request, [
            'name' => 'required|min:2|max:50|unique:brands,name,' .$id ]);

       $brand = Brand::findorFail($id);

       $brand->name = $request->name;
       $brand->save();

       flash('Brand updated successfully')->success();
       return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findorFail($id);
        $brand->delete();

        flash('Brand Deleted successfully')->success();
        return redirect()->route('brands.index');
    }

     // Hand Ajax request

     public function getBrandsJson(){
        $brands = Brand::all();

       return response()->json([
            'success' =>true,
            'data'=>$brands
        ], Response::HTTP_OK);
    }

}
