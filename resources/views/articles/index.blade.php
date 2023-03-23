@extends('layouts.app')

@section('content')
<div class="container">
    {{ $articles->links() }}
    @foreach ($articles as $article )
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5>{{$article->title}}</h5>
                <h4>{{$article->user->name}} </h4>
                <div class="card-subtitle text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="card-content">
                <p>{{$article->body}}</p>
            </div>
            <a href="{{url("/articles/detail/$article->id")}}" class="card-link">View Detail &raquo;</a>
        </div>
    </div>


    @endforeach
</div>






@endsection
