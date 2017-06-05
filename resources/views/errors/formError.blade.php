    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <li style="list-style-type:none;">
                <p style="line-height:10px;color:#ff0303">{{$error}}</p>
            </li>
        @endforeach
    @endif