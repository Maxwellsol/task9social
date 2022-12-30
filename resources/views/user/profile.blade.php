@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="text-center">{{$user->name}}</h1>

    <div class="container">
        <div id="comments_section">
            @include('comment.comments')
        </div>
    </div>
    <div class="container">
        @can('add-comment')
            <form action="{{ route('AddComment', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Заголовок:</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label>Текст:</label>
                    <textarea class="form-control" type="text" name="text" required></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Оставить комментарий</button>
            </form>
        @endcan
    </div>

@endsection

