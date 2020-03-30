var dateToday = new Date();
var dd = String(dateToday.getDate()).padStart(2, '0');
var mm = String(dateToday.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = dateToday.getFullYear();

dateToday = mm + '/' + dd + '/' + yyyy;

document.addEventListener('DOMContentLoaded', function () {
    var initialLocaleCode = 'pt';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        header: {
            left: 'prev, next, today',
            center: 'title',
            right: '',
        },
        dateToday,
        locale: initialLocaleCode,
        buttonIcons: true, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                start: '2020-02-01'
            },
            {
                title: 'Long Event',
                start: '2020-02-07',
                end: '2020-02-10'
            },
            {
                groupId: 999,
                title: 'Repeating Event',
                start: '2020-02-09T16:00:00'
            },
            {
                groupId: 999,
                title: 'Repeating Event',
                start: '2020-02-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2020-02-11',
                end: '2020-02-13'
            },
            {
                title: 'Meeting',
                start: '2020-02-12T10:30:00',
                end: '2020-02-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2020-02-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2020-02-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2020-02-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2020-02-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2020-02-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2020-02-28'
            }
        ]
    });

    calendar.render();

    // build the locale selector's options
    calendar.getAvailableLocaleCodes().forEach(function (localeCode) {
        var optionEl = document.createElement('option');
        optionEl.value = localeCode;
        optionEl.selected = localeCode === initialLocaleCode;
        optionEl.innerText = localeCode;
        localeSelectorEl.appendChild(optionEl);
    });

    // when the selected option changes, dynamically change the calendar option
    localeSelectorEl.addEventListener('change', function () {
        if (this.value) {
            calendar.setOption('locale', this.value);
        }
    });

});
