@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @foreach ($posts as $post)
            <div class="card mb-2">
  
                    <div class="card-body">
                        <h1 class="card-text">
                            {{$post->title}}
                        </h1>
                        <p class="card-text">
                            {{$post->description}}
                        </p>
                    
                        <div class="flex flex-column">
                            <div class="py-2 px-2">
                                <span class="badge rounded-pill text-bg-secondary">
                                    Posted by: {{ $post->user->username }}
                                </span>
                            </div>
                            <div class="p-2">
                                <a href="{{route('posts.show',$post->id)}}" 
                                    class="btn btn-primary card-link rounded-0 text-decoration-none">
                                    {{__('read more')}}
                                </a>
                            </div>
                        </div>
                    </div>
           
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection