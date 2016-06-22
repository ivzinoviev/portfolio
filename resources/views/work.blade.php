<div class="container">
<h2>Проекты</h2>
<div class="work-wrap">
    @forelse ($data as $work)
        <div id="work{{ $work->id }}" class="work-item">
            <h3 data-name="name" data-pk="{{ $work->id }}">{{ $work->name }}</h3>
            <div class="col-md-4">
                <a href="img/{{ $work->image }}" class="popup-image"><img src="img/{{ $work->image }}"></a>
            </div>
            <div class="col-md-8">
                <h4>Описание</h4>
                <span data-pk="{{ $work->id }}" data-name="description">{{ $work->description }} </span>
                <h4>Технологии</h4>
                <span data-pk="{{ $work->id }}" data-name="technology">{{ $work->technology }} </span>
                <h4>Роль в проекте</h4>
                <span data-pk="{{ $work->id }}" data-name="role">{{ $work->role }} </span><br>
                @if (Auth::check())
                    <button class="delete_work btn btn-xs btn-danger form-control" title="Удалить данные" data-pk="{{ $work->id }}">Удалить работу</button>
                @endif
            </div>
        </div>
    @empty
        <p>Тут пока ничего нет, но можно попробовать добавить!</p>
    @endforelse
</div>
@if (Auth::check())
    <form id="work-add">
        <label>Название: <input type="text" name="name" class="form-control"></label><br>
        <label>Изображение: <input type="file" name="image" accept="image/x-png, image/gif, image/jpeg" class="form-control"></label><br>
        <label>Описание: <input type="text" name="description"  class="form-control"></label><br>
        <label>Технологии: <input type="text" name="technology"  class="form-control"></label><br>
        <label>Роль: <input type="text" name="role"  class="form-control"></label><br>
        <button class="add-work btn btn-xs btn-success form-control">Добавить</button>
    </form>
@endif
</div>