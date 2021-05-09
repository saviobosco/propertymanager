<div class="mb-3">
    <h1> {{ $property->address }} </h1>
    <div>
        <span> {{ $property->type->category }}  </span> | <span> {{ $property->type->name }} </span>
        <a href="#">Edit</a>
    </div>
</div>

<div class="mt-5 mb-5">
    <ul class="quick__nav__tab">
        <li class="quick__nav__item ">
            <a class="quick__nav__link {{ (request()->url() == route('user.properties.show', ['id' => $property->id]) ) ? 'active' : '' }}"
               href="{{ route('user.properties.show', ['id' => $property->id]) }}">Summary</a>
        </li>
        <li class="quick__nav__item">
            <a class="quick__nav__link" href="">Financials</a>
        </li>
        <li class="quick__nav__item">
            <a class="quick__nav__link {{ ( strpos(request()->url(), 'units') !== false) ? 'active' : '' }}" href="{{ route('manager.properties.units.index', ['property' => $property->id]) }}">Units({{ $property->units()->count() }})</a>
        </li>
        <li class="quick__nav__item">
            <a class="quick__nav__link" href="">Event History</a>
        </li>
        <li class="quick__nav__item">
            <a class="quick__nav__link" href="">File</a>
        </li>
        <li class="quick__nav__item">
            <a class="quick__nav__link" href="">Vendors</a>
        </li>
    </ul>
</div>
