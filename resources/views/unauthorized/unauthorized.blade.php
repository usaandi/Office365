<div class=”title”>
    <p>Something went wrong! Contact Admin.</p>
    @isset($error)
        <p>{{$error}}</p>
        @endisset
    <div class="col-xs-9">
        <div class="profile__details--info">
            <a href="/home"><span><button
                            class="btn btn-success">Main Page</button></span></a>
        </div>
    </div>
</div>