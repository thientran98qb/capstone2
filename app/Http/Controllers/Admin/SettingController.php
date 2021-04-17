<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Model\Setting;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    protected $setting;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = $this->setting->paginate(5);
        return view('admin.settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataSetting = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_name,
                'scope' => $request->scope
            ];
            $this->setting->create($dataSetting);
            DB::commit();
            return redirect()->route('admin.setting.index');
        }catch(Exception $exception){
            DB::rollBack();DB::commit();
            Log::error('message' . $exception->getMessage() . 'line' . $exception->getLine());
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
        $setting = $this->setting->find($id);
        return view('admin.settings.edit',compact('setting'));
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
            $dataSetting = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_name,
                'scope' => $request->scope
            ];
            $this->setting->find($id)->update($dataSetting);
            DB::commit();
            return redirect()->route('admin.setting.index');
        }catch(Exception $exception){
            DB::rollBack();DB::commit();
            Log::error('message' . $exception->getMessage() . 'line' . $exception->getLine());
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
            $this->setting->find($id)->delete();
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