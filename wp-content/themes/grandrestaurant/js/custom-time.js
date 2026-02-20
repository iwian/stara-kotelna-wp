var tgStartTime = jQuery('#pp_reservation_start_time').val();
var tgEndTime = jQuery('#pp_reservation_end_time').val();
var tgStep = parseInt(jQuery('#pp_reservation_time_step').val());
var tgHoursFormat = jQuery('#pp_reservation_24hours').val();

if(tgHoursFormat == '') {
	tgHoursFormat = false;
}

jQuery('.pp_time').timePicker({step:tgStep, startTime:tgStartTime, endTime:tgEndTime,show24Hours:tgHoursFormat});