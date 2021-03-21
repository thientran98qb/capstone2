<?php
namespace App\Components;

use App\Model\Menu;

class RecusiveMenu {
    private $htmlOp;

    public function __construct()
    {
        $this->htmlOp = '';
    }

    public function recusiveMenu($parent_id, $subMark='') {
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
                        <a href='' class='btn btn-success'>Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <form action='' method='post' class='d-inline delete_category'>
                            <input type='hidden' name='_token' value=".csrf_token()." />
                            <input type='hidden' name='_method' value='DELETE'>
                            <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr>";
                $this->recusiveMenuIndex($value['id'],$text.'--');
        }
        return $this->htmlOp;
    }
}