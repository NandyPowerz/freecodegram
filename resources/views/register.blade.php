<!DOCTYPE html>
<html>
<head>
    <title>Register Member</title>
    
</head>
<body>
    <h1>Register a Member</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

        @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('members.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" name="phone" placeholder="Phone (optional)"><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
