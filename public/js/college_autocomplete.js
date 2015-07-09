<ul class="uk-nav uk-nav-autocomplete uk-autocomplete-results">
        {{~items}}
        <li data-value="{{ $item.id }}">
            <a>
                {{ $item.title }}
                <div>{{{ $item.text }}}</div>
            </a>
        </li>
        {{/items}}
    </ul>