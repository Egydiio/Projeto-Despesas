<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<h1>Nova Despesa Cadastrada</h1>


<h3>Usuario:{{$user->name}}</h3>

<h3>Despesa:</h3>
<ul>
    <li>{{$despesas->desc}}</li>
    <li>{{$despesas->valor}}</li>
    <li>{{$despesas->data}}</li>
</ul>


</body>
</html>