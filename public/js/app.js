var createDiv = function (div_class, content) {
    var div = document.createElement('div');
    div.setAttribute('class', div_class);
    if (content !== undefined) {
        div.innerHTML = content;
    }
    return div;
}

var scheduleHelpers = {
    'dayNames': ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница'],
    'weekNames': {
        'even': 'Верхняя неделя',
        'odd': 'Нижняя неделя'
    },
    'createPair': function (num, name, type, teacher, loc) {
        var pairDiv = createDiv('pair', '')

        var timeDiv = createDiv('time', num); // @TODO: FIXME
        var nameDiv = createDiv('name', name);
        var typeDiv = createDiv('type', type);
        var teacherDiv = createDiv('teacher', teacher);
        var locDiv = createDiv('loc', loc);

        pairDiv.appendChild(timeDiv);
        pairDiv.appendChild(nameDiv);
        pairDiv.appendChild(typeDiv);
        pairDiv.appendChild(teacherDiv);
        pairDiv.appendChild(locDiv);

        return pairDiv;
    },
    'createDay': function (day) {
        var dayDiv = createDiv('day', '');
        var dayHedaderDiv = createDiv('day-header', day);
        dayDiv.appendChild(dayHedaderDiv);

        return dayDiv;
    },
    'createWeek': function (type) {
        var weekDiv = createDiv('week', '');
        var weekHeader = createDiv('week-header', type);
        weekDiv.appendChild(weekHeader);

        return weekDiv;
    }
};

var createSchedule = function (div_id, data) {

    $('#schedule').empty();

    var evenWeekDiv = scheduleHelpers.createWeek(scheduleHelpers.weekNames['even']);
    var oddWeekDiv = scheduleHelpers.createWeek(scheduleHelpers.weekNames['odd']);

    var foo = function (weekDiv, data) {
        for (var day in data) {
            var dayDiv = scheduleHelpers.createDay(scheduleHelpers.dayNames[day]);
            data[day].forEach(function (value) {
                var pairDiv = scheduleHelpers.createPair(value.num, value.name, value.type, value.teacher, value.aud);
                dayDiv.appendChild(pairDiv);
            });
            weekDiv.appendChild(dayDiv);
        }
    }

    foo(evenWeekDiv, data.even);
    foo(oddWeekDiv, data.odd);

    $('#schedule').append(evenWeekDiv);
    $('#schedule').append(oddWeekDiv);
};

// get groups and setup group list
$.get('/api/groups', function (data) {
    var select = $('#group-select-form > select').first();
    data.forEach(function (group) {
        var option = document.createElement('option');
        option.setAttribute('value', group['id']);
        option.innerHTML = group['name'];
        select.append(option);
    });
    select.chosen();
});

// override groups select form submit behavior
$('#group-select-form').submit(function (event) {
    event.preventDefault();
    $.post('/api/schedule', $(this).serialize(), function (data) {
        createSchedule('#schedule', data);
    });
});