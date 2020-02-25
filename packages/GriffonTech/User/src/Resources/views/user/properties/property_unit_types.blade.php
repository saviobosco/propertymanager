@if ($propertyUnitTypes)
    @foreach($propertyUnitTypes as $id => $unitType)
        <option value="{{ $id }}"> {{ $unitType }} </option>
    @endforeach
@endif
