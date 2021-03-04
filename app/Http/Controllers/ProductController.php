<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $data = [
          'title' => 'Product List'
        ];
        return view('product.v_product_index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Product'
        ];
        return view('product.v_product_add', $data);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
