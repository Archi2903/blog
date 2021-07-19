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
        $paginate = BlogCategory::paginate(5);

        return view('blog.admin.categories.index', compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        dd(__METHOD__, 'create new categories');
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
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $item = BlogCategory::find($id);// вывод значения при выборе
        /* валидация на существование значения*/
        if (empty($item)) {      //если наше значение пустое,то возвращение назад
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();// с сохранением данных в полях
        }
        /* получение данных после редактирования*/
        $data = $request->all();
        /* перезапись в исходные поля с сохранением*/
        $result = $item->fill($data)->save();

        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено!']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

}
