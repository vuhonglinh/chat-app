@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Danh sách bạn bè</span></div>

                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach ($users as $item)
                                <li><a href="{{ route('chat', $item->id) }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
