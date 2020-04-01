var dateToday = new Date();
var dd = String(dateToday.getDate()).padStart(2, '0');
var mm = String(dateToday.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = dateToday.getFullYear();

dateToday = mm + '/' + dd + '/' + yyyy;

document.addEventListener('DOMContentLoaded', function () {
    var initialLocaleCode = 'pt';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'rrule'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        dateToday,
        locale: initialLocaleCode,
        editable: true,
        events: [
            {
                title: 'rrule event',
                rrule: {
                    dtstart: '2020-02-09T13:00:00',
                    // until: '2020-02-01',
                    freq: 'weekly'
                },
                duration: '02:00'
            }
        ],
        eventClick: function (arg) {
            if (confirm('delete event?')) {
                arg.event.remove()
            }
        }
    });

    calendar.render();

    // build the locale selector's options
    calendar.getAvailableLocaleCodes().forEach(function (localeCode) {
        var optionEl = document.createElement('option');
        optionEl.value = localeCode;
        optionEl.selected = localeCode === initialLocaleCode;
        optionEl.innerText = localeCode;
    });
});
