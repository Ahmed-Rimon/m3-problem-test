<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return product::latest()->paginate(10);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|string|max:191',
            'Price' =>'required',
            'task_date' =>'required',


        ]);

        return product::create([
            'name' => $request['name'],
            'Price' => $request['Price'],
            'type' => $request['type'],
            'bio' => $request['bio'],
            'photo' => $request['photo'],
            'task_date' => $request['task_date'],
        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product =product::findOrFail($id);


        $this->validate($request,[
            'name' =>'required|string|max:191',
            'Price' =>'required',
            'task_date' =>'required',
        ]);

        $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);

        $product->delete();
             return ['message' => 'Product Deleted'];
    }
}
