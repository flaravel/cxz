<div class="card" style="margin-top: 20px">
    <div class="card-body">
        <ul class="nav nav-pills">
            @foreach($status as $key => $value)
                <li class="nav-item">
                    <a class="nav-link @if(request()->has('_status') && request()->input('_status') == $key) active @elseif(is_null(request()->input('_status')) && $key == $default) active @endif"
                       href="{{url(request()->route()->uri().'?_status='.$key)}}" >{{$value}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
