<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('/css/listUser.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ url('/js/list.js') }}"></script>
  </head>
<body>
    <div class="container">
        <div class="row header-wrapper">
            <div class="col-lg-8 col-sm-8 col-md-8">
                <h3>List User</h3>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4">
                <a href="{{ route('addUser') }}"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add User</button></a>
            </div>
        </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Stt</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
              <th>{{ $loop->index + 1 }}</th>
              <th>{{ $user->name }}</th>
              <th>{{ $user->email ?? '' }}</th>
              <th>
                <a href="{{ route('deleteUser', ['id' => $user->id]) }}"><i class="fa-solid fa-circle-minus"></i></a>
                <a href="{{ route('showUser', ['id' => $user->id]) }}"><i class="fa-solid fa-pen-to-square"></i></a>
              </th>
        </tr>
        @endforeach
        </tbody>
      </table>
      <div class="footer">
          <div class="row">
              <div class="col-lg-8 col-md-8">
                {{ $users->links() }}
              </div>
              <div class="col-lg-4 col-md-4">
                <input type="number" min="1" max="2000" value="{{ $itemPerPage ?? 0 }}" id="itemPerPage">
              </div>
          </div>
      </div>
    </div>
    
</body>
</html>