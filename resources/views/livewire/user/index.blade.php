<div>
    @foreach ($users as $user)
    <h1>{{ $user->name }}</h1>
    <h1>{{ $user->email }}</h1>
    <h1>{{ $user->created_at }}</h1>
    <h1>{{ $user->updated_at }}</h1>
    @endforeach
    
</div>
