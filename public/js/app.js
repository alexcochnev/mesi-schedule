// get groups and setup group list
$.get('/api/groups', function (data) {
    select = $('#group-select-form > select').first();
    data.forEach(function (group) {
        option = document.createElement('option');
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
        $('#schedule').text('hello');
    });
});