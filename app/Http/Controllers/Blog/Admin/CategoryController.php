<?php

namespace App\Http\Controllers\Blog\Admin;

use App\BlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Repository\BlogCategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

/**
 * Управление категорями блога
 * Class CategoryController
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    /**
     * Создание экземпляра
     * CategoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory
     */
    public function index()
    {
        //Вариант вывода без использования репозитория


        //$paginate = BlogCategory::paginate(5);

        $paginator = $this->blogCategoryRepository->getAllWithPaginate();
        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit', compact('categoryList', 'item'));
    }

    /**
     * Store a newly created resource in storage
     * @param BlogCategoryUpdateRequest $request
     * @return RedirectResponse
     */
    public function store(BlogCategoryUpdateRequest $request)
    {
        $data = $request->input();
        //Создаст обьект но не добавит в БД
        //$item = new BlogCategory($data);
        //$item->save();

        $item = (new BlogCategory())->create($data);

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено!']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Редактируем используя репозиторий
     * @param $id
     * @param BlogCategoryRepository $categoryRepository
     * @return Application|Factory|View
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        /*нахождение единственного значения по id(есть несколько вариантов)*/
        //$item = BlogCategory::findOrFail($id);
        //$item[] = BlogCategory::find($id);
        //$item[] = BlogCategory::where('id','>', $id)->first();
        //$categoryList = BlogCategory::all();

        // Получить обьект запись по ее id
        $item = $this->blogCategoryRepository->getEdit($id);
//        $v['before']=$item->title;
//        $item->title='ASASsasasAS sadsadasd 121540';
//        $v['title_after']=$item->title;
//        $v['getAttribute']=$item->getAttribute('title');
//        $v['attributesToArray']=$item->attributesToArray();
////        $v['attributes']=$item->attributes['title'];
//        $v['getAttributeValue']=$item->getAttributeValue('title');
//        $v['getMutatedAttributes']=$item->getMutatedAttributes();
//        $v['hasGetMutator for title']=$item->hasGetMutator('title');
//        $v['toArray']=$item->toArray;
//        dd($v,$item);
        // Получить обьекты для выпадающего списка
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    /*Добавили валидацию,BlogCategoryUpdateRequest новый созданный request*/
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        /*Validate все 3 версии не корректные */
        // 3 version validate
        //Create class validator
//        $validator = \Validator::make($request->all(), $rules);
        //Проверяет все поля и выводит общий true или false(не показывает над каким полем не прошла валидацию)
//        $validatedData[] = $validator->passes();
        //проверка полей c редиректом на туже страницу ,с выводом $errors
//        $validatedData[]=$validator->validate();
        //проверка полей, с выводом через dd(), показывает поле,которое не прошло валидацию
//        $validatedData[] = $validator->invalid();
        //проверка полей, с выводом через dd(), показывает поле,которые прошли валидацию
//        $validatedData[] = $validator->valid();
        // проверка полей и вывод имени поля не прошедшего валидацию и его условие выполнения ,через dd()
//        $validatedData[] = $validator->failed();
        // проверка полей и вывод имени поля не прошедшего валидацию и вывод правил по которым оно должно выполняться dd()
//        $validatedData[] = $validator->errors();
        // вывод true или false ,на наличие ошибки true - если есть ошибка
//        $validatedData[] = $validator->fails();
//        $item = BlogCategory::find($id);// вывод значения при выборе
        /* валидация на существование значения*/
        if (empty($item)) {      //если наше значение пустое,то возвращение назад
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();// с сохранением данных в полях
        }
        /* получение данных после редактирования*/
        $data = $request->all();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
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



