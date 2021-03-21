<?php
namespace App\Components;
class Recusive{
    protected $data;
    protected $htmlOpt='';
    protected $htmlTable ='';
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function recusiveCategory($parent_id,$id=0,$text=''){

        foreach ($this->data as $value) {
            if($value['parent_id'] == $id ) {
                if(!empty($parent_id) && $parent_id==$value['id']){
                    $this->htmlOpt .= "<option selected value=".$value['id'].">".$text.$value['category_name']."</option>";
                }else {
                    $this->htmlOpt .= "<option value=".$value['id'].">".$text.$value['category_name']."</option>";
                }
                $this->recusiveCategory($parent_id,$value['id'],$text.'--');
            }
        }
        return $this->htmlOpt;
    }
    public function recusiveCategoryIndex($id=0,$text=''){
        foreach ($this->data as $key => $value) {
            if($value['parent_id'] == $id ) {
                $this->htmlTable .=
                "<tr>
                    <td class='text-left font-weight-bold'>". $text.$value['category_name']."</td>
                    <td>
                        <a href=" .route('admin.category.edit',$value['id']). " class='btn btn-success'>Edit</a>
                        <meta name='csrf-token' content=". csrf_token() .">
                        <form action=".route('admin.category.destroy',$value['id'])." method='post' class='d-inline delete_category'>
                            <input type='hidden' name='_token' value=".csrf_token()." />
                            <input type='hidden' name='_method' value='DELETE'>
                            <button type='submit' class='btn btn-danger' id='deleteCategory_".$value['id']."'>Delete</button>
                        </form>
                    </td>
                </tr>";
                $this->recusiveCategoryIndex($value['id'],$text.'--');
            }
        }
        return $this->htmlTable;
    }
}