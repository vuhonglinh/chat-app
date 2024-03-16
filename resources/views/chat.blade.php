@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ $receiver->name }} (<span class="text-danger" id="status">Đã Offline</span>)
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="messages" class="col- overflow-auto gap-2 " style="height: 50vh">
                                @foreach ($messages as $item)
                                    <div
                                        class="border border-dark p-1 {{ $item->users->id == auth()->user()->id ? 'bg-info rounded-bottom-4 rounded-start-4 ' : ' rounded-bottom-4 rounded-end-4' }}  mb-2 ">
                                        <span class="font-weight-light">{{ $item->created_at->format('H:i d-m-Y') }}</span>
                                        <p>{{ $item->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="">
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="content" id="content">
                                </div>
                                <div class="col-2">
                                    <button id="send" class="btn btn-primary  w-100">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
    <script>
        const sendElement = document.getElementById('send');
        const messagesElement = document.getElementById('messages');
        sendElement.addEventListener('click', (e) => {
            e.preventDefault();
            const contentElement = document.getElementById('content');
            if (contentElement.value != "") {
                window.axios.post('/add/{{ request()->route()->id }}', {
                    content: contentElement.value,
                }).then(response => {
                    const result = response.data;
                    const htmls = `<div class="border border-dark p-1 mb-2 bg-info rounded-bottom-4 rounded-start-4 ">
                                    <span class="font-weight-light">${result.created_at}</span>
                                    <p>${result.content}</p>
                                </div>`;
                    messagesElement.innerHTML += htmls
                    messagesElement.scrollTop = messagesElement.scrollHeight;
                    contentElement.value = "";
                })
            }
        });
    </script>
    <script type="module">
        const messagesElement = document.getElementById('messages');
        Echo.private('user.{{ request()->route()->id }}')
            .listen('ChatEvent', function(e) {
                console.log(e);
                if (e.receiver.id == {{ auth()->user()->id }}) {
                    const htmls = ` <div class="border border-dark p-1 mb-2 rounded-bottom-4 rounded-end-4">
                                        <span class="font-weight-light">${e.message.created_at}</span>
                                        <p>${e.message.content}</p>
                                    </div>`;
                    messagesElement.innerHTML += htmls
                    messagesElement.scrollTop = messagesElement.scrollHeight;
                }
            })
        messagesElement.scrollTop = messagesElement.scrollHeight;
    </script>
@endsection
