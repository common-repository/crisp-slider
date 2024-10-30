jQuery(document).ready(function($) {
	$type = $("input[type=radio][name='crisp_slider_type']:checked").val();
	if ($type == 'carousel') {
		$('.slider-carousel-setting').show();
		$('.slider-mode-setting').hide();
		$('.slider-pager-type').hide();
		$('#slider-pager').hide();
	}

	$auto = $("input[type=radio][name='crisp_slider_auto']:checked").val();
	if ($auto == 'false') {
		$('#slider-setting-interval').hide();
	}

	$pager = $("input[type=radio][name='crisp_slider_pager']:checked").val();
	if ($pager == 'false') {
		$('#slider-pager').hide();
	}

	$controls = $("input[type=radio][name='crisp_slider_controls']:checked").val();
	if ($controls == 'false') {
		$('#slider-controls').hide();
	}

	$bullets = $("input[type=radio][name='crisp_slider_pager_style']:checked").val();
	if ($bullets == 'number') {
		$('#slider-number').show();
		$('#slider-bullet').hide();
	} else if ($bullets == 'bullet') {
		$('#slider-bullet').show();
		$('#slider-number').hide();
	}

	$pgpos = $("input[type=radio][name='crisp_slider_pager_position']:checked").val();
	if ($pgpos == 'inside') {
		$('.slider-settings-vertical').show();
	} else if ($pgpos == 'outside') {
		$('.slider-settings-vertical').hide();
	}

	$cbgtype = $("input[type=radio][name='crisp_slider_control_bgtype']:checked").val();
	if ($cbgtype == 'transparent') {
		$('#slider-control-bgopacity').show();
	} else if ($cbgtype == 'solid') {
		$('#slider-control-bgopacity').hide();
	}
	
	$('input[type=radio][name=crisp_slider_type]').change(function() {
        if (this.value == 'basic') {
            $('.slider-carousel-setting').hide();
			$('.slider-mode-setting').show();
			$('.slider-pager-type').show();
			$('#slider-pager').show();
        } else if (this.value == 'carousel') {
            $('.slider-carousel-setting').show();
			$('.slider-mode-setting').hide();
			$('.slider-pager-type').hide();
			$('#slider-pager').hide();
        } else if (this.value == 'background') {
            $('.slider-carousel-setting').hide();
			$('.slider-mode-setting').show();
			$("input[name=slider_pager_position][value='inside']").prop("checked", true);
			$('.slider-settings-vertical').show();
			$('.slider-pager-type').show();
			$('#slider-pager').show();
        }
    });

	$('input[type=radio][name=crisp_slider_auto]').change(function() {
        if (this.value == 'false') {
            $('#slider-setting-interval').hide();
        } else if (this.value == 'true') {
            $('#slider-setting-interval').show();
        }
    });
	
	$('input[type=radio][name=crisp_slider_pager]').change(function() {
        if (this.value == 'false') {
            $('#slider-pager').hide();
        } else if (this.value == 'true') {
            $('#slider-pager').show();
        }
    });

	$('input[type=radio][name=crisp_slider_controls]').change(function() {
        if (this.value == 'false') {
            $('#slider-controls').hide();
        } else if (this.value == 'true') {
            $('#slider-controls').show();
        }
    });

	$('input[type=radio][name=crisp_slider_pager_style]').change(function() {
        if (this.value == 'number') {
            $('#slider-number').show();
			$('#slider-bullet').hide();
        } else if (this.value == 'bullet') {
            $('#slider-bullet').show();
			$('#slider-number').hide();
        }
    });

	$('input[type=radio][name=crisp_slider_pager_position]').change(function() {
        if (this.value == 'inside') {
            $('.slider-settings-vertical').show();
        } else if (this.value == 'outside') {
			$('.slider-settings-vertical').hide();
        }
    });

	$('input[type=radio][name=crisp_slider_control_bgtype]').change(function() {
        if (this.value == 'transparent') {
            $('#slider-control-bgopacity').show();
        } else if (this.value == 'solid') {
			$('#slider-control-bgopacity').hide();
        }
    });

    $('.crisp-color').iris();
});