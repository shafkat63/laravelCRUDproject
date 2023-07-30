<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <title>Document</title>
</head>

<body>
    @auth
    <p class="test">You are loged in!!!</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Logout</button>

    </form>
    <div
        style="border: 3px solid rgb(65, 74, 74);background: rgb(238,174,202);
                 background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);display:flex; justify-content:center;padding:10px">
        <form action="/createPosts" method="POST">
            @csrf
            <input type="text" name="title" placeholder="title"><br>
            <label for="body">Body Content...</label><br>
            <textarea name="body" id="" placeholder="Body Content..." style="background: #acb6e5;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #86fde8, #acb6e5);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #86fde8, #acb6e5); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            ">

            </textarea>
            <button>Submit</button>

        </form>
    </div>


    <div style="border: 3px solid grey;background: rgb(238,174,202);
                 background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);">
        <h2>All posts</h2>
        @foreach($posts as $post)
        <div
            style="background-color: gray;background: rgb(34,193,195);
                    background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%); padding:10px; margin:10px">
            <h3>
                {{$post['title']}} by {{$post->user->firstName}} {{$post->user->lastName}}
            </h3>
            <p>{{$post['body']}} </p>
        </div>
        @endforeach
    </div>

    <div style="border: 3px solid grey;background: rgb(63,94,251);
                background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);">
        <h2>Current User posts</h2>
        @foreach($currentUserPost as $post)
        <div
            style="background-color: #34d399;background: rgb(34,193,195);
                   background: linear-gradient(0deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%); padding:10px; margin:10px">
            <h3>
                {{$post['title']}} by {{$post->user->firstName}} {{$post->user->lastName}}
            </h3>
            <p>{{$post['body']}} </p>
            <p><a style="all:unset; cursor: pointer; color: blue; hover{color:red}; padding:10px; font-size:larger"
                    href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>

            </form>
        </div>
        @endforeach
    </div>


    @else
    <div style="border: 3px solid grey;background: rgb(63,94,251);
                  background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);">

        <h2>Register</h2>
        <form method="POST" action="/register">
            @csrf
            <input type="text" placeholder="First Name" name="firstName" id="">
            <input type="text" placeholder="Last Name" name="lastName" id="">
            <input type="email" placeholder="Email " name="email" id="">
            <input type="password" placeholder="password" name="password" id="">
            <button type="submit">Submit</button>
        </form>

    </div>


    <div style="border: 3px solid grey;background: #FC466B;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #3F5EFB, #FC466B);  /* Chrome 10-25, Safari 5.1-6 */
                 background: linear-gradient(to right, #3F5EFB, #FC466B); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    ">

        <h2>Login</h2>
        <form method="POST" action="/login">
            @csrf
            {{-- <input type="text" placeholder="First Name" name="firstName" id=""> --}}
            {{-- <input type="text" placeholder="Last Name" name="lastName" id=""> --}}
            <input type="email" placeholder="loginEmail " name="loginEmail" id="">
            <input type="password" placeholder="loginPassword" name="loginPassword" id="">
            <button type="submit">Log in</button>
        </form>

    </div>
    @endauth


</body>

</html>