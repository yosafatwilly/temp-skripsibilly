<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Alert;

class CategoryController extends Controller
{
    protected $validationRules = [
        'name' => 'required',
        'slug' => 'required',
        'icon' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', null)->get();
        return view("admin.category.index", compact('categories'));
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
        $this->validate(request(),
            $this->validationRules
        );

        $category = new Category;
        $category->slug = $request->slug;
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->icon = $request->icon;
        $category->user_id = Auth::user()->id;
        $category->save();
        Alert::success('', 'Category Berhasil di Tambahkan');
        return redirect()->back();
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
        $category = Category::find($id);
   		$categories = Category::where('parent_id',null)->get();
   		return view('admin.category.edit',compact('category','categories'));
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
        $this->validate(request(),
            $this->validationRules
        );

        $category = Category::find($id);
        $category->slug = $request->slug;
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->icon = $request->icon;
        $category->save();
        Alert::success('', 'Category Berhasil di perbarui');
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Alert::success('', 'Category Berhasil di Hapus');
        return redirect(route('category.index'));
    }
}
