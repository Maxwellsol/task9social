@extends('layouts.app')
@section('content')
    @if($comments->count() != 0)
        @foreach($comments as $comment)
            <div class="container">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <p class=" mb-0 ms-2">{{ $comment->title }}</p>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <p class="small text-muted mb-0"><a
                                        href="{{ route('Profile', $comment->sender_id) }}">{{ $comment->user->name }}</a>
                                </p>
                                <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                            </div>
                        </div>
                        <hr/>
                        <p class="mt-3 mb-4 pb-2">{{$comment->text}}</p>
                        <hr/>
                        <div class="d-flex justify-content-between">
                            @can('delete-comment', $comment)
                                @if($comment->deleted_at)
                                    <div class=" d-flex flex-row">
                                        <a class="comment-button" href="{{ route('Restore', $comment->id) }}">Восстановить</a>
                                    </div>
                                @else
                                <div class=" d-flex flex-row">
                                    <a class="comment-button" href="{{ route('Delete', $comment->id) }}">Удалить</a>
                                </div>
                                @endif
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container">
        {{ $comments->links() }}
        </div>
    @else
        <h1 class="text-center">Вы пока не оставили комментарии</h1>
    @endif
@endsection
