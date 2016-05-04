function calendar_getHourFunc(){
    return function(hour, part){
        var time_start = this.options.time_start.split(":");
        var time_split = parseInt(this.options.time_split);
        var h = "" + (parseInt(time_start[0]) + hour * Math.max(time_split / 60, 1));
        var m = "" + (time_split * part + (hour == 0) ? parseInt(time_start[1]) : 0);
        var d = new Date();
        d.setHours(h)
        d.setMinutes(m);
        return moment(d).format(calendarGetTimeFormat());
    }
}

function calendar_getTransFunc(){
    return function(label){
        return calendar_translations[label];
    }
}

function calendarGetTimeFormat(){
    // http://momentjs.com/docs/#/displaying/format/
    // vs http://www.malot.fr/bootstrap-datetimepicker/#options
   console.log(salon);
    if(!salon.moment_time_format)
        salon.moment_time_format = salon.time_format
        .replace('ii','mm')
        .replace('hh','{|}')
        .replace('H','h')
        .replace('{|}','H')
        .replace('p','a')
        .replace('P','A')
        ;
    return salon.moment_time_format; 
}

function initSalonCalendar($, ajaxUrl, ajaxDay, templatesUrl){
	var options = {
		events_source: ajaxUrl,
		view: 'month',
		tmpl_path: templatesUrl,
		tmpl_cache: false,
		format12: true,
		day: ajaxDay,
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html(val.event_html)
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.current-view--title').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

	var calendar = $('#calendar').calendar(options);
	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});
                calendar.setLanguage($('html').attr('lang'));
                calendar.view();
 
/*
	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});

	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
		//e.preventDefault();
		//e.stopPropagation();
	});
*/
}
