<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
 <div class='p-5'>
    <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">ID
            </th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
          </tr>
        </thead>
        <tbody>
            @foreach( $categories as $category )
          <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->title}}</td>
            <td>{{$category->slug}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
 </div>
</body>
</html>
