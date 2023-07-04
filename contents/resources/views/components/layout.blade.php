@props(['rootId' => 'react-root'])
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    {{$slot}}
</head>
<body style="margin: 0">
<div id="{{$rootId}}"></div>
</body>
</html>
