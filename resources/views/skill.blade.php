<div class='container'>
<h2>Мои навыки</h2>
<ul id="skills_list">
    @forelse ($data['skill_groups'] as $group)
        <li id="group{{ $group->id }}">
            <span data-pk="{{ $group->id }}">{{ $group->name }} </span>
            @if (Auth::check())
                <button class="add_skill btn btn-xs btn-success" title="Добавить навык" data-pk="{{ $group->id }}">+</button>
                <button class="btn btn-xs btn-danger delete_group" title="Удалить группу" data-pk="{{ $group->id }}">X</button>
            @endif
            <ul>
                @if($data['skill']->get($group->id))
                    @include('skill_items', ['skills' => $data['skill']->get($group->id)])
                @endif
            </ul>
        </li>
@empty
    <p>
        Группы навыков не найдены.
    </p>
@endforelse
</ul>
@if (Auth::check())
    <div id="group_add form-group">
        <input id="new_group_name" type="text" placeholder="Введите название группы" class="form-control">
        <button id="add_new_group" class="btn btn-success form-control">Добавить группу</button>
    </div>
@endif
</div>