@if ($errors->any())
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            @foreach ($errors->all() as $error)
                <p><strong>Please Fill !! &nbsp;</strong>{{ $error }}<p>
            @endforeach
    </div>
@endif 

@if(Session::has('success'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
@if(Session::has('login_success'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{ Session::get('login_success') }}</p>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

@if(Session::has('login_error'))
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>{{ Session::get('login_error') }}</p>
    </div>
@endif


