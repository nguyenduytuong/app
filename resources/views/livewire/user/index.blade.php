<div>
    @foreach ($users as $user)
    <p>{{ $user->name }}</p>
    <p>{{ $user->email }}</p>
    <p>{{ $user->created_at }}</p>
    <p>{{ $user->updated_at }}</p>
    @endforeach
    
</div>
