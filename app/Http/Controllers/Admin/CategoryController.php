<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Model\Category;
use Illuminate\Support\Str;
use App\Components\Recusive;
use App\Traits\UploadImageTrait;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    use UploadImageTrait;
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->paginate(10);
        $recusivee = new Recusive($categories);
        $tableRecusive = $recusivee->recusiveCategoryIndex();
        return view('admin.categories.index',compact('categories','tableRecusive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->recusiveCategory('');
        return view('admin.categories.add',compact('htmlOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->except(['_token']);
        $dataParentid = (empty($data['parent_id'])) ? 0 : $data['parent_id'];
        $dataImg = $this->storageTraitUpload($request,'image_category','categories');
            if(!empty($dataImg)){
                $this->category->img_category= $dataImg['file_path'];
            }
        if(!empty($data)){
            $this->category->category_name = $data["category_name"];
            $this->category->slug = Str::slug($data['category_name']);
            $this->category->parent_id = $dataParentid;
        }
        $this->category->save();
        toast('Your Category as been submited!','success');
        return redirect()->route('admin.category.index');
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
    public function getCategory($parent_id){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->recusiveCategory($parent_id);
        return $htmlOption;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemCategory = $this->category->findOrFail($id);
        $htmlOptions = $this->getCategory($itemCategory['parent_id']);
        return view('admin.categories.edit',compact('itemCategory','htmlOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data =[];
        $itemCategory = $this->category->findOrFail($id);
        $dataImg = $this->storageTraitUpload($request,'image_category','categories');
        $img_cate =!empty($dataImg) ? $dataImg['file_path'] : '';
        // dd($img_cate);
        $data =  [
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_id,
            'img_category' => $img_cate
        ];
        $itemCategory->update($data);
        toast('Your Category as been updated!','success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->findOrFail($id)->delete();
        toast('Your Category as been deleted!','success');
        return redirect()->route('admin.category.index');
    }
}