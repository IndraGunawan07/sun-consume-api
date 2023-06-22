<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <script>        
        function getCookieValue(cookieName) {
            var cookies = document.cookie.split(';');

            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim();
                var separatorIndex = cookie.indexOf('=');
                var name = cookie.substr(0, separatorIndex);

                if (name === cookieName) {
                var value = cookie.substr(separatorIndex + 1);
                return decodeURIComponent(value);
                }
            }

            return null; // Cookie not found
        }

        // Usage example
        var token = getCookieValue('token');
        if(token){
            window.location.href = '/dashboard';
        }
    </script>
    <div class="container mt-5" style="width: 500px">
        <h3 class="mb-4">Sign In</h3>
        @isset($success)
            <div class="container alert alert-success">
                {{ $success }}
            </div>
        @endisset

        @isset($unauthorized)
            <div class="container alert alert-danger">
                {{ $unauthorized }}
            </div>
        @endisset
        
        <form action="/login" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name='email'/>
                @isset($messages['email'])
                    <div class="container alert alert-danger p-1 mt-2">
                        <label class="form-label"><small>{{ $messages['email'] }}</small></label>
                    </div>
                @endisset
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" />
                @isset($messages['password'])
                    <div class="container alert alert-danger p-1 mt-2">
                        <label class="form-label"><small>{{ $messages['password'] }}</small></label>
                    </div>
                @endisset
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a href="/register">Register</a></p>
            </div>
            </form>
    </div>
</body>
</html>