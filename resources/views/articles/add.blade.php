@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post">
        @csrf
            <div class="mb-2">
                <label >Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" >
            </div>
            <div class="mb-2">
                <label >Body</label>
                <textarea class="form-control" name="body" placeholder="Body" ></textarea>
            </div>
            <div class="mb-2">
                <label >Category</label>
                <select name="category_id" id=""class="form-select mb-2">
                    @foreach ($categories as $category )
                    <option value="{{$category['id']}}">
                        {{$category['name']}}
                    </option>

                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" value="Add Article">Submit</button>
        </form>
    </div>
@endsection


