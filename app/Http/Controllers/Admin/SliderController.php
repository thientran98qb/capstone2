<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slider;
use App\Traits\UploadImageTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    protected $slide;
    use UploadImageTrait;
    public function __construct(Slider $slide)
    {
        $this->slide = $slide;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = $this->slide->paginate(5);
        return view('admin.slides.index',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slides.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $data = [
                'name' => $request->slide_name,
                'description' => $request->desc_slide
            ];

            $imageSlide = $this->storageTraitUpload($request,'image_slide','slide');
            $data['image'] = $imageSlide['file_path'];
            $this->slide->create($data);
            DB::commit();
            return redirect()->route('admin.slide.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('message'.$exception->getMessage().'line'.$exception->getLine());
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
        $slide = $this->slide->findOrFail($id);
        return view('admin.slides.edit',compact('slide'));
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
            $data = [
                'name' => $request->slide_name,
                'description' => $request->desc_slide
            ];

            if($request->hasFile('image_slide')){
                $imageSlide = $this->storageTraitUpload($request,'image_slide','slide');
                $data['image'] = $imageSlide['file_path'];
            }
            $this->slide->find($id)->update($data);
            DB::commit();
            return redirect()->route('admin.slide.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('message'.$exception->getMessage().'line'.$exception->getLine());
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
        //
    }

    public function delete($id){
        try {
            $this->slide->find($id)->delete();
            return response()->json([
                'code' => 200,
                'status' => 'success'
            ],200);
        } catch (Exception $exception) {
            Log::error('message'.$exception->getMessage().'line'.$exception->getLine());
            return response()->json([
                'code' => 500,
                'status' => 'fail'
            ],500);
        }
    }
}