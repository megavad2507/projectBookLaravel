<form method="GET">
    @foreach($class->adminFilterInputs() as $inputName => $inputInfo)
        <label for="{{ $inputName }}" style="margin-right: 20px">{{ $inputInfo['name'] }}
            @switch($inputInfo['type'])
                @case('select')
                    <select name="{{ $inputName }}" id="{{ $inputName }}">
                        @foreach($inputInfo['values'] as $value => $name)
                            <option v="{{ request()->input($inputName) }}" value="{{ $value }}" @if((int)request()->input($inputName) === $value && !empty(request()->input($inputName))) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                    @break
                @default
                    <input type="{{ $inputInfo['type'] }}" name="{{ $inputName }}" id="{{ $inputName }}" value="{{ request()->input($inputName) }}">
            @endswitch
        </label>
    @endforeach
    <button class="btn btn-success" style="margin-right: 20px;">Фильтровать</button>
        @php
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('?', $url);
            $url = $url[0];
        @endphp
    <button class="btn btn-secondary"><a href="{{ $url }}" style="text-decoration:none;color:#fff;">Очистить</a></button>
</form>
