@extends('layouts.app')
@section('content')
    <div class="list-group ">
        @forelse($users as $user)
            <a href="{{route('Profile', $user->id)}}" class="list-group-item list-group-item-action text-center">
                {{$user->name}}
                <span class="font-weight-bold"> Email: </span>
                {{$user->email}}
            </a>
        @empty
            <h2 class="text-center"><span>Другие пользователи пока не зарегестрировались</span></h2>
        @endforelse
    </div>
@endsection
