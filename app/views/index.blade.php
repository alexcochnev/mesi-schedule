<!doctype html>
<html>
<head>
    <title>iCal Расписание МЭСИ</title>
    <link rel="stylesheet" type="text/css" href="/css/chosen.min.css">
</head>
<body>
    <div id="groups">
        <form id='group-select-form' method="post" action="/schedule/">
            <select data-placeholder="Выберите группы" name="groups[]" style="width:350px;" multiple>
            @foreach ($groups as $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
            @endforeach
            </select>
            <button type="submit">Получить расписание</button>
        </form>
    </div>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="/js/chosen.jquery.min.js"></script>
    <script>
        $('select').chosen();

        $('#group-select-form').submit(function (event) {
            event.preventDefault();
            $.post('/schedule/', $(this).serialize(), function (data) {
                // do smth
            });
        });
    </script>
</body>
</html>