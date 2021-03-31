<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recusive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Model\Category;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\Tag;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadImageTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use UploadImageTrait;
    protected $product;
    protected $tag;
    protected $productimage;
    public function __construct(Product $product,Tag $tag,ProductImage $productimage)
    {
        $this->product = $product;
        $this->tag = $tag;
        $this->productimage = $productimage;
    }

    public function getCategory($parent_id){
        $data = Category::all();
        $recusive = new Recusive($data);
        $categories = $recusive->recusiveCategory($parent_id);
        return $categories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->paginate(5);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategory(0);
        return view('admin.products.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataProduct = [
                'product_name'=>$request->product_name,
                'price' => $request->price,
                'product_description' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->parent_id,
            ];
            $data = $this->storageTraitUpload($request,'image_product','product');
            if(!empty($data)){
                $dataProduct['product_image'] = $data['file_path'];
                $dataProduct['feature_image_name'] = $data['file_name'];
            }
            $product = $this->product->create($dataProduct);
            if($request->hasFile('image_detail_product')){
                foreach ($request->image_detail_product as $imageItem) {
                    $dataProductDetail = $this->storageTraitUploadMult($imageItem,'product');
                    $product->images()->create([
                        'image_path' => $dataProductDetail['file_path'],
                        'image_name' => $dataProductDetail['file_name']
                    ]);
                }
            }
            //add tag
            if(!empty($request->tag_product)){
                $tags = $request->tag_product;
                foreach ($tags as $tag) {
                    $tagInstance = $this->tag->firstOrCreate([
                        'tag_name' => $tag
                    ]);
                    $tagId[] = $tagInstance->id;
                }
            }

            $product->tags()->attach($tagId);
            DB::commit();
            return redirect()->route('admin.product.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('message'.$exception->getMessage(). 'line' . $exception->getLine());
        }
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
        $productItem = $this->product->findOrFail($id);
        $categories = $this->getCategory($productItem->category_id);
        return view('admin.products.edit',compact('productItem','categories'));
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
        try{
            DB::beginTransaction();
            $dataProduct = [
                'product_name'=>$request->product_name,
                'price' => $request->price,
                'product_description' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->parent_id,
            ];
            $data = $this->storageTraitUpload($request,'image_product','product');
            if(!empty($data)){
                $dataProduct['product_image'] = $data['file_path'];
                $dataProduct['feature_image_name'] = $data['file_name'];
            }
            $this->product->find($id)->update($dataProduct);
            $product = $this->product->find($id);
            if($request->hasFile('image_detail_product')){
                $this->productimage->where('product_id',$id)->delete();
                foreach ($request->image_detail_product as $imageItem) {
                    $dataProductDetail = $this->storageTraitUploadMult($imageItem,'product');
                    $product->images()->create([
                        'image_path' => $dataProductDetail['file_path'],
                        'image_name' => $dataProductDetail['file_name']
                    ]);
                }
            }
            if(!empty($request->tag_product)){
                $tags = $request->tag_product;
                foreach ($tags as $tag) {
                    $tagInstance = $this->tag->firstOrCreate([
                        'tag_name' => $tag
                    ]);
                    $tagId[] = $tagInstance->id;
                }
            }

            $product->tags()->sync($tagId);
            DB::commit();
            return redirect()->route('admin.product.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('message'.$exception->getMessage(). 'line' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    public function delete($id)
    {
        try{
            $this->product->find($id)->delete();
            return response()->json([
                'code' => '200',
                'message' => 'success'
            ],200);
        }catch(Exception $exception){
            Log::error('message'.$exception->getMessage(). 'line' . $exception->getLine());
            return response()->json([
                'code' => '500',
                'message' => 'fail'
            ],500);
        }
    }
}