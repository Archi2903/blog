<?php

namespace App\Http\Controllers\Blog\Admin;

use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $paginate = BlogCategory::paginate(3);

        return view('blog.admin.category.index', compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        dd(__METHOD__, 'create new category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__, 'store');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        /*нахождение единственного значения по id(есть несколько вариантов)*/
        $item = BlogCategory::findOrFail($id);
        //        $item[] = BlogCategory::find($id);
//        $item[] = BlogCategory::where('id','>', $id)->first();
        $categoryList = BlogCategory::all();
        return view('blog.admin.category.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        dd(__METHOD__, $request->all(), $id);
    }

}
