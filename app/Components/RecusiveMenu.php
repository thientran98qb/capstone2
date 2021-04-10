<?php
namespace App\Components;

use App\Model\Menu;

class RecusiveMenu {
    private $htmlOp;
    private $html;
    public function __construct()
    {
        $this->htmlOp = '';
        $this->html ='';
    }

    public function recusiveMenu($parent_id=0, $subMark='') {
        $data = Menu::where('parent_id',$parent_id)->get();
        foreach ($data as $value) {
            $this->htmlOp .= "<option value='".$value['id']."'>".$subMark.$value['name']."</option>";
            $this->recusiveMenu($value['id'], $subMark .'--');
        }
        return $this->htmlOp;
    }
    public function recusiveMenuIndex($parent_id=0,$text=''){
        $data = Menu::where('parent_id',$parent_id)->get();
        foreach ($data as $key => $value) {
                $this->htmlOp .=
                "<tr>
                    <td class='text-left font-weight-bold'>". $text.$value['name']."</td>
                    <td>
                        <a href='".route('admin.menu.edit',$value['id'])."' class='btn btn-success'>Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <form action='".route('admin.menu.destroy',$value['id'])."' method='post' class='d-inline delete_menu'>
                            <input type='hidden' name='_token' value=".csrf_token()." />
                            <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr>";
                $this->recusiveMenuIndex($value['id'],$text.'--');
        }
        return $this->htmlOp;
    }
    public function recusiveEditMenu($parent_id_edit,$parent_id=0, $subMark='') {
        $data = Menu::where('parent_id',$parent_id)->get();
        foreach ($data as $value) {
            if($parent_id_edit == $value['id']){
                $this->html .= "<option selected value='".$value['id']."'>".$subMark.$value['name']."</option>";
            }else{
                $this->html .= "<option value='".$value['id']."'>".$subMark.$value['name']."</option>";
            }
            $this->recusiveEditMenu($parent_id_edit,$value['id'], $subMark .'--');
        }
        return $this->html;
    }
}