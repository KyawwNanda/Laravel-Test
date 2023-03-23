<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function delete($id){
        $comment = Comment::find($id);

        if(Gate::allows('comment-delete',$comment)){
            $comment->delete();
            return back();
        }else{
            return back()->with('error','Unauthoirze');
        }

    }

    public function create(){
        $comment = new Comment();
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back();
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
