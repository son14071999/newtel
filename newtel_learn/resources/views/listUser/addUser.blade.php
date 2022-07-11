<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">

    
<div class="edit-wrapper">
    <div>
        
      <form method="POST" action="{{ route('addUserPost') }}">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
          <label for="exampleInputName">Name address</label>
          <input type="text" class="form-control" id="exampleInputName"  name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputName">password</label>
            <input type="text" class="form-control" id="exampleInputName"  name="password">
          </div>
        <div class="btn-submit-wrapper" style="margin-top: 30px">
          <button type="submit" class="btn btn-primary">save</button>
        </div>
        </form>
    </div>
</div>
</div>
</body>