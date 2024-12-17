@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('components.card')

                {{-- Start Comment Section --}}
                <div class="overflow-auto" style="height: 300px;">
                    <div class="container">
                        <div class="row">
                            {{-- Loop through all comments --}}
                            @foreach($post->comments as $comment)
                                @if($comment->commentator instanceof \App\Models\User)
                                    {{-- Top-level comment --}}
                                    @if($comment->parent_id == null)
                                        <div class="col-12 border p-2">
                                            <div class="d-flex flex-row mb-3">
                                                <div class="p-2">
                                                    <span class="bg-dark-subtle">
                                                        {{ $comment->commentator->username }}
                                                    </span>
                                                </div>
                                                <div class="p-2">
                                                    {{ $comment->original_text  }}
                                                    <pre>{{ $comment->created_at->diffForHumans() }}</pre>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-flex flex-row mb-3">
                                                    {{-- Edit --}}
                                                    <div class="p-2 mt-4">
                                                        @if(Auth::id() == $comment->commentator->id)
                                                            <span class="px-3 mt-2">
                                                                <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#EditCommentModal">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </a>
                                                            </span>
                                                            @include('components.comments.edit')
                                                        @endif
                                                    </div>

                                                    {{-- Delete --}}
                                                    <div class="p-2">
                                                        <span class="px-3">
                                                            @if(Auth::id() == $comment->commentator->id)
                                                            <form action="{{route('comments.delete', $comment->id)}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="col">
                                                                    <button type="submit" class="btn btn-link">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                            @endif
                                                        </span>
                                                    </div>

                                                    {{-- Reply --}}
                                                    <div class="p-2 mt-4">
                                                        <span class="px-3 mt-2">
                                                            <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#ReplyModal-{{ $comment->id }}">
                                                                <i class="bi bi-reply"></i>
                                                            </a>
                                                        </span>
                                                        @include('components.reply.create', ['parentComment' => $comment])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Replies --}}
                                        @foreach($comment->replies as $reply)
                                            <div class="col-11 ms-5 mt-1 bg-info-subtle p-2 mb-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <div>
                                                        <span class="bg-dark-subtle">{{ $reply->commentator->username }}</span>
                                                    </div>
                                                    <div class="mx-3">
                                                        <span class="text-black">
                                                            {{ $reply->original_text }}
                                                            <pre>{{ $reply->created_at->diffForHumans() }}</pre>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row mb-3">
                                                    {{-- Edit reply --}}
                                                    <div class="mt-1">
                                                        @auth
                                                        @if(Auth::id() == $reply->commentator->id)
                                                            <span>
                                                                <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#EditReplyModal-{{ $reply->id }}">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </a>
                                                            </span>
                                                            @include('components.reply.edit', ['reply' => $reply])
                                                        @endif
                                                        @endauth
                                                    </div>

                                                    {{-- Delete reply --}}
                                                    <div class="mx-3">
                                                        @auth
                                                            @if(Auth::id() == $reply->commentator->id)
                                                                <span>
                                                                    <form action="{{ route('replies.destroy', $reply->id) }}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-link">
                                                                            <i class="bi bi-trash-fill"></i>
                                                                        </button>
                                                                    </form>
                                                                </span>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>

                                                {{-- Always show the Reply button for each reply --}}
                                                <div class="p-2 mt-4">
                                                    <span class="px-3 mt-2">
                                                        <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#ReplyModal-{{ $comment->id }}">
                                                            <i class="bi bi-reply"></i>
                                                        </a>
                                                    </span>
                                                    @include('components.reply.create', ['parentComment' => $reply])
                                                </div>
                                                
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- End Comment Section --}}

                {{-- Create comment form --}}
                <div class="mt-3">
                    @include('components.comments.create')
                </div>
                {{-- End Create comment form --}}
            </div>
        </div>
    </div>
@endsection
