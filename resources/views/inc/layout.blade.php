<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    </head>
    <body>
        @include('inc.header')
        
        @yield('content')
        <div class="mt-3 p-3 bg-secondary text-white text-center">
            <p>&copy; Med.Life LTD. 1780</p>
        </div>
    </body>
</html>