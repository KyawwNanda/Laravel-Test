<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    //

    public function index(){
        $data = Article::latest()->paginate(5);
        return view('articles.index',[
            "articles"=>$data
            ]);
    }



    public function detail($id){
        $data = Article::find($id);
        return view('articles.detail',[
        "article"=>$data]);
    }
    public function add(){
        $data = Category::all();
        return view('articles.add',
            [
                'categories'=>$data
            ]);
    }

    public function create(){
        $validator = Validator(request()->all(),[
            'title'=>"required",
            'body'=>"required",
            'category_id'=>"required",
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title =request()->title;
        $article->body =request()->body;
        $article->category_id=request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect("/articles");
    }

    public function delete($id){
        $article = Article::find($id);
        if(Gate::allows('article-delete',$article)){
            $article->delete();
            return redirect("/articles");

        }else{
            return back()->with('error','Unauthroize');
        }
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index','detail']);
    }
}
