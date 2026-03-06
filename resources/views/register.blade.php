<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <label for="name">Name</label>
        @csrf
        <input type="text" name="name" id="name"value="{{ old('name')}}">
        @error('name')
        <p>{{$message}}</p>
        <label for="image">Image</label>
        <input type="file" name="image" id="image" >
            <button type="submit">Submit</button>
    </form>
</body>
</html>