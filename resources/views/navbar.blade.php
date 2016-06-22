<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class='col-md-10 greetings'>
        @if (Auth::check())
        Добро пожаловать, <strong>{{ Auth::user()->name }}</strong>!
            {!! link_to_action('Auth\AuthController@logout', 'Выйти', null, array('class' => 'login-btn btn btn-primary btn-info')) !!}
        @else
        {!! Form::open(array('url' => '/auth/login', 'class' => 'form navbar-form navbar-right')) !!}
            <div class="form-group">
              {!! Form::text('email', null, array('class' => 'email form-control', 'placeholder' => 'E-mail')) !!}
            </div>
            <div class="form-group">
              {!! Form::password('password', array('class' => 'password form-control', 'placeholder' => 'Пароль')) !!}
            </div>
            <div class="form-group">
                <label class="remember-check btn btn-info">{!! Form::checkbox('remember', 'remember') !!} Запомнить меня</label>
            </div>
            {!! Form::submit('Войти', array('class'=>'login-btn btn btn-info')) !!}
        {!! Form::close() !!}
        @endif
        <div id="msg"></div>
        </div>
    </div>
</nav>

@if (count($errors) > 0)
    <div class="container alert alert-danger">
        Войти не удалось:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif