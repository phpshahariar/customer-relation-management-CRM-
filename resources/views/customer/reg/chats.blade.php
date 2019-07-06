@foreach($chats as $chat)
    <p>{{ $chat->chating }}</p>
    <p>{{ $chat->created_at }}</p>
    <p style="color: green">( {{ auth()->user()->name }} )</p>
@endforeach