<? 
$title="ай Салем! ";
include ($_SERVER['DOCUMENT_ROOT']."/header.php");
?>

<script type="text/javascript" src="/js/datepicker/jquery.datepick.pack.js"></script>
<style type="text/css">
@import "/js/datepicker/jquery.datepick.css";
</style>





<script type="text/javascript">
//$('#datepicker').datepick({onSelect: showDate});


(function($) {
	$.datepick.regional['ru'] = {
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
		'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		dateFormat: 'dd.mm.yyyy', firstDay: 1,
		renderer: $.datepick.defaultRenderer,
		prevText: '&larr; пред',  prevStatus: '',
		prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
		nextText: 'след &rarr;', nextStatus: '',
		nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
		currentText: 'Сегодня', currentStatus: '',
		todayText: 'Сегодня', todayStatus: '',
		clearText: 'Очистить', clearStatus: '',
		closeText: 'Закрыть', closeStatus: '',
		yearStatus: '', monthStatus: '',
		weekText: 'Не', weekStatus: '',
		dayStatus: 'D, M d', defaultStatus: '',
		isRTL: false
	};
	$.datepick.setDefaults($.datepick.regional['ru']);

	$.datepick._defaults['useMouseWheel']=true
	$.datepick._defaults['changeMonth']=true
	


})(jQuery);

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>

<script>
Schedule.drawDiv();
Schedule.getSchedule()
//Schedule.drawGrid();
</script>

<style>
.schedule-grid td
{
	font-size: 10px;
}
</style>





<? include ($_SERVER['DOCUMENT_ROOT']."/template_footer.php");?>