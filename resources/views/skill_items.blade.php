@forelse ($skills as $skill)
        <li id="skill{{ $skill->id }}">
            <span data-pk="{{ $skill->id }}">{{ $skill->name }} </span>
            @if (Auth::check())
                <button class="delete_skill btn btn-primary btn-xs btn-danger" title="Удалить навык" data-pk="{{ $skill->id }}">X</button>
            @endif
        </li>
@empty
@endforelse