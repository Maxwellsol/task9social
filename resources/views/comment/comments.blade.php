@if($comments->count() != 0)
    @foreach($comments as $comment)
        @if($comment->deleted_at)
            <h1>Комментарий удалён</h1>
        @else
            <div class="card mb-4">
                <div class="card-body {{ $comment->parent_comment_id ? 'bg-light bg-gradient':''}} " >
                    <div class="d-flex justify-content-between ">
                        <div class="d-flex flex-row align-items-center">
                            <p class=" mb-0 ms-2 ">{{ $comment->title }}</p>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <p class="small text-muted mb-0"><a href="{{ route('Profile', $comment->sender_id) }}">{{ $comment->user->name }}</a></p>
                            <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                        </div>
                    </div>
                    <hr/>
                    <p class="mt-3 mb-4 pb-2">{{$comment->text}}</p>
                    <hr/>
                    <div class="d-flex justify-content-between">
                        @can('reply-comment', $comment)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                                Ответить
                            </button>
                        @endcan
                        @can('delete-comment', $comment)
                            <div class=" d-flex flex-row">
                                <a class="comment-button" href="{{ route('Delete', $comment->id) }}">Удалить</a>
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
            @if($comment->children()->count() > 0)
                <div class="pl-4">
                    @include('comment.comments', ['comments' => $comment->children(), 'children' =>true])
                </div>
            @endif

            <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <span class="text-center text-truncate"><a href="{{ route('Profile', $comment->sender_id) }}">{{ $comment->user->name }}</a>: {{$comment->text}}</span>

                        <form action="{{ route('AddComment', $user->id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <input name="parent_id" value="{{$comment->id}}" hidden/>
                                <input type="text" class="form-control" name="title" placeholder="Заголовок" required>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Текст:</label>
                                    <textarea class="form-control" type="text" name="text" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Ответить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endif
    @endforeach
    @if($commentsCount > 5  && empty($children))
        <button type="button" id="showAll" class="d-block mr-0 ml-auto btn btn-secondary"  data-id="{{ $user->id }}">
            показать все
        </button>
    @endif
@else
    <h1 class="text-center">Пользователи пока не оставили комментарии</h1>
@endif




