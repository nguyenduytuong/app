<table class="table-auto mt-6">
    <thead>
        <tr>
            <th class="text-green-500">Name
                @include('components.table.sort', ['field' => 'name'])
            </th>
            <th>Email @include('components.table.sort', ['field' => 'email'])</th>
            <th>Created At @include('components.table.sort', ['field' => 'created_at'])</th>
            <th>Updated At @include('components.table.sort', ['field' => 'updated_at'])</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
