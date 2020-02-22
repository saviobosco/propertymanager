<table class="table">
    <thead>
    <tr>
        <td>#</td>
        <td>Identifier</td>
        <td>Name</td>
        <td>Phone Number</td>
        <td>Lease Ends</td>
    </tr>
    </thead>
    <tbody>
    @if (count($tenants))
        @foreach($tenants as $tenant)
            <tr>
                <td>{{ $tenant['id'] }}</td>
                <td>{{ $tenant['identifier'] }}</td>
                <td>{{ $tenant['first_name'].' '.$tenant['last_name'] }}</td>
                <td> {{ $tenant['phone_number'] }} </td>
                <td>{{ $tenant['lease_ends'] }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
    @endif
</table>
