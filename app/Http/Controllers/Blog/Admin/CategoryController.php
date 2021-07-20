<?php

namespace App\Http\Controllers\Blog\Admin;

use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    //вывод всех категорий
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
    //свойство редактирования
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
    //свойство Сохранения
    public function update(Request $request, $id)
    {
        /*Validate*/
        $rules = [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200',
            'description' => 'string|max:500|min:3',
            'parent_id' => 'required|integer|exists:blog_categories,id',
        ];
        /* все 3 версии не корректные */
        /* 1 version validate
        // $validatedData=$this->validate($request,$rules); */
        /* 2 version validate */
        //$validatedData = $request->validate($rules);
        /* 3 version validate
        //Create class validator
        $validator = \Validator::make($request->all(), $rules);
        //Проверяет все поля и выводит общий true или false(не показывает над каким полем не прошла валидацию)
        $validatedData[] = $validator->passes();
        //проверка полей c редиректом на туже страницу ,с выводом $errors
//        $validatedData[]=$validator->validate();
        //проверка полей, с выводом через dd(), показывает поле,которое не прошло валидацию
        $validatedData[] = $validator->invalid();
        //проверка полей, с выводом через dd(), показывает поле,которые прошли валидацию
        $validatedData[] = $validator->valid();
        // проверка полей и вывод имени поля не прошедшего валидацию и его условие выполнения ,через dd()
        $validatedData[] = $validator->failed();
        // проверка полей и вывод имени поля не прошедшего валидацию и вывод правил по которым оно должно выполняться dd()
        $validatedData[] = $validator->errors();
        // вывод true или false ,на наличие ошибки true - если есть ошибка
        $validatedData[] = $validator->fails();
        */
        dd($validatedData);

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
