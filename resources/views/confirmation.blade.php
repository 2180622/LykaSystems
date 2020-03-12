<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <form class="form-group" action="{{route('confirmation.update', $user)}}" method="post">
      @csrf
      <div class="form-group">
         <label>Password:</label>
         <input type="password" class="form-control" name="password"/>
      </div>
      <div class="form-group">
         <label>Password Confirmation:</label>
         <input type="password" class="form-control" name="password_confirmation"/>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </form>
  </body>
</html>
