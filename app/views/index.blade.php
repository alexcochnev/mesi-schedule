<!doctype html>
<html>
<head>
    <title>iCal Расписание МЭСИ</title>
    <link rel="stylesheet" type="text/css" href="/css/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
    <div id="groups">
        <form id='group-select-form' method="post" action="/schedule/">
            <select data-placeholder="Выберите группы" name="groups[]" style="width:350px;" multiple></select>
            <button type="submit">Получить расписание</button>
        </form>
    </div>
    <div id="schedule"></div>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="/js/chosen.jquery.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>