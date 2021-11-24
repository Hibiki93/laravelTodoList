<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hibiki To Do List</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js">
    </script>
</head>

<body class="bg-info">
    <div class="container w-25 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>To-do List</h3>
                @if(isset(Auth::user()->email))
                    <div class="alert alert-danger success-block">
                        <strong>Welcome {{Auth::user()->email}}</strong>
                        <br>
                        <a href="{{url('/login/logout')}}">Logout</a>
                    </div>
                else
                    <script>window.location = '/login';</script>
                @endif
                <form action="{{route('store')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="content" class="form-control" placeholder="What to do">
                        <button type="submit" class="btn btn-dark btn-sm m-0"><i class="fa fa-plus"></i>Add Task</button>
                    </div>
                </form>
                @if(count($todolists))
                <ul class="list-group list-group-flush mt-3">
                    @foreach($todolists as $todolist)
                    <li class="list-group-item">
                        <form action="{{route('destroy', $todolist -> id)}}" method="POST">
                            {{$todolist->content}}
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-link btn-sm ml-auto">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
                <div class="card-footer">
                    <p class="text-muted">
                        You have {{count($todolists)}} pending tasks
                    </p>
                </div>
                @else
                <p class="text-center mt-3">No Tasks!</p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
