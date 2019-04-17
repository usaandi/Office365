@foreach( ['danger','warning','success','info'] as $msg)
    <div id="alert" class="alert alert-{{$msg}} alert-dismissible text-center">
        <a href="" class="close " data-dismiss="alert" aria-label="close"></a>
        <strong>{{$msg}}</strong>
    </div>
@endforeach
