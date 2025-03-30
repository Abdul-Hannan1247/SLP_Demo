<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Document</title>

</head>
<body>
    <div>
        <form action="{{ route('send.mail') }}" method="POST">
            @csrf
            
            <label for="">Email</label>
            <input type:"email" name="email">
            <br>
            <label for="">Message</label>
            <input type:"text" name="message">
            <button type="submit">Send</button>

        </form>
    </div>


</body>
</html>
