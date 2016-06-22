<div class="container">
<h2>Контактная информация</h2>
<div class="row info-wrap">
    <div class="info-image col-md-6">
    @if($data->get('image'))
         <img src="img/{{ $data->get('image')->first()->value }}" id="profile-image">
    @else
        <img src="img/default.png" id="profile-image">
    @endif
    @if (Auth::check())
        <form id="image-upload">
            <input type="file" name="image" accept="image/x-png, image/gif, image/jpeg" class="form-control">
            <button class="btn btn-xs btn-success image-add form-control">Загрузить изображение</button>
            <button class="btn btn-xs btn-danger image-delete form-control">Удалить текущее изображение</button>
        </form>
    @endif
    </div>
    <div class='col-md-6'>
        <ul class="info-contacts">
            @forelse ($data->get('string') as $info)
                <li id="info{{ $info->id }}"> 
                    <h3 data-name="name" data-pk="{{ $info->id }}">{{ $info->name }}</h3>
                    @if (Auth::check() || !$info->protect)
                        <span data-pk="{{ $info->id }}" data-name="value">{{ $info->value }} </span>
                    @else
                        <span data-pk="{{ $info->id }}" data-name="value"><a href="#robot-check">Сначала подтвердите, что вы не робот</a></span>
                    @endif

                    @if (Auth::check())
                        <button class="delete_info btn btn-primary btn-xs btn-danger" title="Удалить данные" data-pk="{{ $info->id }}">X</button>
                    @endif
                </li>
            @empty
                <p>
                    Попробуйте добавить информацию о себе!
                </p>
            @endforelse
        </ul>
        @if (Auth::check())
            <div id="info-add">
                <label>Название: <input type="text" name="name" class="form-control"></label><br>
                <label>Значение: <input type="text" name="value"  class="form-control"></label><br>
                <label>Защитить от роботов: <input type="checkbox" name="protect"></label><br>
                <button class="add_info btn btn-success form-control">Добавить</button>
            </div>
        @else
        <form id="robot-check">
            {!! app('captcha')->display(); !!}
            <button class="robot-check-btn btn btn-xs btn-success">Я не робот</button>
        </form>
        @endif
    </div>
    </div>
</div>