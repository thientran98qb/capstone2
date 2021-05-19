<?php

namespace App\Http\Controllers\Customer;

use App\Comment;
use App\Components\CommentRecusive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $product;
    protected $comment;

    public function __construct(Product $product,Comment $comment)
    {
        $this->product = $product;
        $this->comment = $comment;
    }

    public function index($id){
        $product = $this->product->findOrFail($id);
        $comments = $this->comment->where('product_id',$id)->get();
        $commetRecusive = new CommentRecusive();
        $comment_data = $commetRecusive->commentRecusive($comments);
        return view('customers.products.index',compact('product','comment_data'));
    }

    public function getComment(Request $request){
        if(Auth::check()){
            $comment['user_id'] = Auth::user()->id;
            $comment['product_id'] = (int)$request->product_id;
            $comment['content'] = $request->content;
            $comment['parent_id'] = (int)$request->cmr_id;
            $comment['status'] = 0;
            $this->comment->create($comment);
            $comments = $this->comment->where('product_id',$request->product_id)->get();
            $commetRecusive = new CommentRecusive();
            $response = $commetRecusive->commentRecusive($comments);

            return $response;
        } else {
            // Session::flash('Error', 'Login first');
            return redirect()->route('login');
        }
    }
    public function update(Request $request)
    {
        if(Auth::check()){
            $comment['content'] = $request->content;
            $this->comment->find($request->cmr_id)->update($comment);
            $comments = $this->comment->where('product_id',$request->product_id)->get();
            $commetRecusive = new CommentRecusive();
            $response = $commetRecusive->commentRecusive($comments);

            return $response;
        } else {
            return redirect()->route('login');
        }
    }
    public function destroy(Request $request)
    {
        $cmr_id = (int)($request->cmr_id);
        $this->comment->find($cmr_id)->delete();
        $comments = $this->comment->where('product_id',$request->product_id)->get();
        $commetRecusive = new CommentRecusive();
        $response = $commetRecusive->commentRecusive($comments);
        return $response;
    }

    public function postPost(Request $request)
    {
        request()->validate(['rate' => 'required']);
        $post = $this->product->find($request->id);
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $request->rate;
        $rating->user_id = Auth::user()->id;
        $post->ratings()->save($rating);

        return redirect()->back();
    }
    public function search(Request $request)
    {
        $products = $this->product->getProductSearch($request);
        return view('customers.search.index',compact('products'));

    }
    public function searchIndex(Request $request){
        $status = $request->case;
        if($status == 'rate'){
            $products= $this->product->select('products.*')->leftJoin('ratings', 'products.id', '=', 'ratings.rateable_id')
            ->addSelect(DB::raw('AVG(ratings.rating) as average_rating'))
            ->groupBy('products.id')
            ->orderBy('average_rating', 'desc')
            ->paginate(4);
        }elseif($status == 'name'){
            $products= $this->product->orderBy('product_name')->paginate(4);
        }else{
            $products= $this->product->paginate(4);
        }
        return view('customers.search.index',compact('products'));
    }

    public function voucher($product_id){
        $product = $this->product->findOrFail($product_id);
        $voucher = $product->createVoucher(['discount_percent' => 10]);
    }
}