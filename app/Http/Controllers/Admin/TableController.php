<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Table;
use Exception;
use Illuminate\Support\Facades\Log;

class TableController extends Controller
{
    protected $table;

    public function __construct(Table $table)
    {
        $this->table =$table;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->table->all();
        return view('admin.tables.index',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tables.creat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->table_name,
            'description' => $request->desc_table,
            'quantity' => $request->quantity
        ];
        $this->table->create($data);
        return redirect()->route('admin.table.index');
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
        $table = $this->table->findOrFail($id);
        return view('admin.tables.edit',compact('table'));
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
        $table = $this->table->findOrFail($id);
        $data = [
            'name' => $request->table_name,
            'description' => $request->desc_table,
            'quantity' => $request->quantity,
            'status' => $request->status
        ];
        $table->update($data);
        return redirect()->route('admin.table.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $this->table->find($id)->delete();
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