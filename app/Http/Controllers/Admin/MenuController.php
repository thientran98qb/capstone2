<?php

namespace App\Http\Controllers\Admin;

use App\Components\RecusiveMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Model\Menu;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    protected $recusiveMenu;
    protected $menu;

    public function __construct(RecusiveMenu $recusiveMenu, Menu $menu)
    {
        $this->recusiveMenu = $recusiveMenu;
        $this->menu = $menu;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuIndex = $this->recusiveMenu->recusiveMenuIndex();
        return view('admin.menus.index',compact('menuIndex'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = $this->recusiveMenu->recusiveMenu();
        return view('admin.menus.add',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *ff
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $data = $request->except('_token');
        if(empty($data['parent_id'])){
            $parent_id = 0;
        }
        $parent_id = (empty($data['parent_id'])) ? 0 : $data['parent_id'];
        $this->menu->create([
            'name' => $data['menu_name'],
            'parent_id'=> $parent_id,
        ]);
        toast('Your Menu as been submited!','success');
        return redirect()->route('admin.menu.index');
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
        $valueMenu = $this->menu->findOrFail($id);
        $menus = $this->recusiveMenu->recusiveEditMenu($valueMenu['parent_id']);
        return view('admin.menus.edit',compact('menus','valueMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $data = [
            'name' => $request->menu_name,
            'parent_id' => $request->parent_id,
        ];
        $updateMenu = $this->menu->find($id)->update($data);
        if($updateMenu){
            toast('Your Menu has been updated','success');
        }else{
            toast('Your Menu error','error');
        }
        return redirect()->route('admin.menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->menu->find($id)->delete();
        toast('Your Menu as been deleted!','success');
        return redirect()->route('admin.menu.index');
    }
}