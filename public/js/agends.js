var dateToday = new Date();
var dd = String(dateToday.getDate()).padStart(2, '0');
var mm = String(dateToday.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = dateToday.getFullYear();

dateToday = mm + '/' + dd + '/' + yyyy;

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'rrule'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        dateToday,
        locale: 'pt',
        editable: true,
        navLinks: true,
        eventLimit: true,
        selectable: true,
        events: routeEvents('routeEventAgend'),

        eventClick: function (arg) {
            if (confirm('delete event?')) {
                arg.event.remove()
            }
        }
    });

    calendar.render();
});

