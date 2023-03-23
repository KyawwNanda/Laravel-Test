@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h5 class="">
                        {{$article->title}}
                    </h5>
                    {{$article->user->name}}
                    <h4></h4>
                    Category:{{$article->category->name}}

                </div>
                <div class="text-muted small">
                    {{$article->created_at->diffForHumans()}}
                </div>
                <div class="card-content mb-3">
                    {{$article->body}}
                </div>
                @auth
                    @can('article-delete',$article)
                    <a href="{{url("articles/delete/$article->id")}}" class="btn btn-primary">Delete</a>
                    @endcan

                    <a href="{{url("articles/edit/$article->id")}}" class="btn btn-secondary">Edit</a>
                
                @endauth
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                Comments({{count($article->comments)}})
            </li>
            @foreach ($article->comments as $comment )

                <li class="list-group-item">

                        {{$comment->content}}

                        @auth
                            @can('comment-delete',$comment)
                            <a href="{{url("comments/delete/$comment->id")}}" class="btn-close float-end"></a><br>
                            @endcan
                        @endauth
                        <b>{{$comment->user->name}}</b>
                    {{$comment->created_at->diffForHumans()}}
                </li>

            @endforeach
        </ul>
        @auth
        <form method="post" action="{{url("comments/add")}}">
            @csrf
            <input type="hidden"name="article_id" value="{{$article->id}}">
            <textarea name="content" class="form-control" placeholder="Your comment" ></textarea>
            <button>Add Comment</button>
        </form>
        @endauth
    </div>
@endsection



