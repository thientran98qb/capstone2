<?php

namespace App\Components;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRecusive{
    protected $html = '';
    protected $i=0;
    public function commentRecusive($comments,$id=0,$prefix=''){
        foreach ($comments as $key => $comment) {
            if($comment->parent_id == $id){
                $this->html .= "<div class='cmt__detail {$prefix}'>";
                $this->html .= "<div class='cmt__detail-avatar'>
                <div class='cmt__avatar-name'>
                    <span>H</span>
                </div>
                </div>";
                $this->html .= "
                <div class='cmt__detail-body'>
                <div class='cmt__detail-content'>
                    <h5 class='cmt__detail-content-author'>
                    {$comment->user->name}
                    </h5>
                    <div class='cmt__detail-content-text'>
                    &emsp;<span id=\"rootComment{$comment->id}\">{$comment->content}</span>
                    </div>
                </div>
                <div class='cmt__detail-time'>
                    <p class='created-At'>
                        <span class='cmt__detail-rep' onClick=\"reply($comment->id)\">Trả lời</span>
                        .
                        {$comment->created_at}
                    </p>
                </div>";
                if(Auth::check()){

                    if(Auth::user()->can('update', $comment)){
                        $this->html .= "<button class=\"btn btn-light\" onClick=\"edit($comment->id)\">Edit</button>";
                    }
                    if(Auth::user()->can('delete', $comment)){
                        $this->html .= "<button class=\"btn btn-light\" onClick=\"destroy($comment->id)\">Delete</button>";
                    }
                }
                $this->html .= "<div id=\"text{$comment->id}\"></div>";
                $this->html .= "</div>";
                $this->html .= "</div>";
                $this->commentRecusive($comments, $comment->id, $prefix.' cmt__detail'.++$this->i);
            }
        }
        return $this->html;
    }
}