{{$data['atsign']}}if(auth()->user()->isAbleTo('{{$data['permissions']['view']}}'))
    <div class="nav-item {{ $data['curlstart'] }} ($segment2 == '{{$data['view_name']}}') ? 'active' : '' }}">
        <a href="{{$data['curlstart']}} route('{{$as}}.index')}}" class="a-item" ><i class="ik ik-user-x"></i><span>{{ $heading}}</span></a>
    </div> 
{{$data['atsign']}}endif
