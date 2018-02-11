/* Transparent - Color Picker */
!function(r,a,e,o){"use strict";typeof Color.fn.toString!==o&&(Color.fn.toString=function(){if(this._alpha<1)return this.toCSS("rgba",this._alpha).replace(/\s+/g,"");var r=parseInt(this._color,10).toString(16);if(this.error)return"";if(r.length<6)for(var a=6-r.length-1;a>=0;a--)r="0"+r;return"#"+r}),r.cs_ParseColorValue=function(r){var a=r.replace(/\s+/g,""),e=-1!==a.indexOf("rgba")?parseFloat(100*a.replace(/^.*,(.+)\)/,"$1")):100,o=100>e?!0:!1;return{value:a,alpha:e,rgba:o}},r.fn.cs_wpColorPicker=function(){return this.each(function(){var a=r(this);if(a.data("rgba")!==!1){var e=r.cs_ParseColorValue(a.val());a.wpColorPicker({clear:function(){a.trigger("keyup")},change:function(r,e){var o=e.color.toString();a.closest(".wp-picker-container").find(".cs-alpha-slider-offset").css("background-color",o),a.val(o).trigger("change")},create:function(){var o=a.data("a8cIris"),c=a.closest(".wp-picker-container"),l=r('<div class="cs-alpha-wrap"><div class="cs-alpha-slider"></div><div class="cs-alpha-slider-offset"></div><div class="cs-alpha-text"></div></div>').appendTo(c.find(".wp-picker-holder")),i=l.find(".cs-alpha-slider"),t=l.find(".cs-alpha-text"),n=l.find(".cs-alpha-slider-offset");i.slider({slide:function(r,e){var c=parseFloat(e.value/100);o._color._alpha=c,a.wpColorPicker("color",o._color.toString()),t.text(1>c?c:"")},create:function(){var s=parseFloat(e.alpha/100),p=1>s?s:"";t.text(p),n.css("background-color",e.value),c.on("click",".wp-picker-clear",function(){o._color._alpha=1,t.text(""),i.slider("option","value",100).trigger("slide")}),c.on("click",".wp-picker-default",function(){var e=r.cs_ParseColorValue(a.data("default-color")),c=parseFloat(e.alpha/100),l=1>c?c:"";o._color._alpha=c,t.text(l),i.slider("option","value",e.alpha).trigger("slide")}),c.on("click",".wp-color-result",function(){l.toggle()}),r("body").on("click.wpcolorpicker",function(){l.hide()})},value:e.alpha,step:1,min:1,max:100})}})}else a.wpColorPicker({clear:function(){a.trigger("keyup")},change:function(r,e){a.val(e.color.toString()).trigger("change")}})})},r(e).ready(function(){r(".cs-wp-color-picker").cs_wpColorPicker()})}(jQuery,window,document);

/*  Get alpha values   */
;(function ( $, window, undefined ) {
	$.cs_ParseColorValue = function( val ) {
    var value = val.replace(/\s+/g, ''),
        alpha = ( value.indexOf('rgba') !== -1 ) ? parseFloat( value.replace(/^.*,(.+)\)/, '$1') * 100 ) : 100,
        rgba  = ( alpha < 100 ) ? true : false;
    return { value: value, alpha: alpha, rgba: rgba };
  };
}(jQuery, window));

(function ($) {
	"use strict";
	vc.atts.dfd_font_container_param = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;
			options.tag = $block.find('.vc_font_container_form_field-tag-select input[type="radio"]:checked').val();
			options.font_size = $block.find('.vc_font_container_form_field-font_size-input').val();
			options.text_align = $block.find('.vc_font_container_form_field-text_align-select > option:selected').val();
			options.font_family = $block.find('.vc_font_container_form_field-font_family-select input[type="radio"]:checked').val();
			options.color = $block.find('.field-color-result').val();
			options.line_height = $block.find('.vc_font_container_form_field-line_height-input').val();
			options.letter_spacing = $block.find('.vc_font_container_form_field-letter_spacing-input').val();
			options.font_style_italic = $block.find('.vc_font_container_form_field-font_style-checkbox.italic').prop('checked') ? "1" : "";
			options.font_style_bold = $block.find('.vc_font_container_form_field-font_style-checkbox.bold').prop('checked') ? "1" : "";
			options.font_style_underline = $block.find('.vc_font_container_form_field-font_style-checkbox.underline').prop('checked') ? "1" : "";
			string_pieces = _.map(options, function (value, key) {
				if (_.isString(value) && 0 < value.length) {
					return key + ':' + encodeURIComponent(value);
				}
			});
			string = $.grep(string_pieces, function (value) {
				return _.isString(value) && 0 < value.length;
			}).join('|');
			return string;
		},
		init: function (param, $field) {
			$field.find(".vc_font_container_form_field-color-input").wpColorPicker({
				palettes: true,
				change: function (event, ui) {
					var hexcolor = $(this).wpColorPicker('color');
					$field.find(".field-color-result").val(hexcolor);
				},
				clear: function () {
					$field.find(".field-color-result").val('');
				}
			});
			
			var $fontContainer = $field.find(".vc_font_container_form_field-font_family-select"),
				$google_fonts_param = $fontContainer.parents('[data-param_type="dfd_font_container"]').next('[data-vc-shortcode-param-name*="_google_fonts"]'),
				showHideElements = function () {
					var select = $('input[type="radio"]:checked', $fontContainer).val(),
						$google_fonts_param_checkbox_checked = $google_fonts_param.find('.dfd_single_checkbox_wrap input[type="checkbox"]:checked');

					if ($google_fonts_param.length > 0) {
						if (select != '') {
							if ($google_fonts_param_checkbox_checked.length > 0) {
								$google_fonts_param_checkbox_checked
									.click()
									.next('.dfd_single_checkbox')
									.find('.button-animation')
									.toggleClass('right-active');
							}

							$google_fonts_param
								.hide();
						} else {
							$google_fonts_param
								.show();
						}
					}
				};

			showHideElements();

			$fontContainer.find('input[type="radio"]').on('change', function () {
				$(this).parents('li').addClass('active').siblings().removeClass('active');
				showHideElements();
			});

			$field.find('.vc_font_container_form_field-tag-select input[type="radio"]').on('change', function () {
				$(this).parents('li').addClass('active').siblings().removeClass('active');
			});
		}
	};

	vc.atts.radio_image_select = {
		render: function (param, value) {
			return value;
		},
		init: function (param, $field) {

			$field.find('.wpb_vc_param_value').imagepicker();
		}
	};
	
	/*radio advanced*/
	vc.atts.dfd_radio_advanced = {
		init: function (param, $field) {
			$field.find('input[type="radio"]').on('click', function () {
				$(this).parents('li').addClass('active').siblings().removeClass('active');
				$field.find('input[type="hidden"]').val($(this).val()).trigger('change');
			});
		}
	};
    
    /*border*/
	vc.atts.dfd_param_border = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;
			options.border_style = $block.find('.vc_container_form_field-border_style > option:selected').val();
			options.border_width = $block.find('.vc_container_form_field-border_width').val();
			options.border_top_width = $block.find('.vc_container_form_field-border_top_width').val();
			options.border_bottom_width = $block.find('.vc_container_form_field-border_bottom_width').val();
			options.border_left_width = $block.find('.vc_container_form_field-border_left_width').val();
			options.border_right_width = $block.find('.vc_container_form_field-border_right_width').val();
			options.border_radius = $block.find('.vc_container_form_field-border_radius').val();
			options.border_color = $block.find('.field-color-result').val();
			string_pieces = _.map(options, function (value, key) {
				if (_.isString(value) && 0 < value.length) {
					return key + ':' + encodeURIComponent(value);
				}
			});
			string = $.grep(string_pieces, function (value) {
				return _.isString(value) && 0 < value.length;
			}).join('|');
			return string;
		},
		init: function (param, $field) {
			var $border_width_field = $field.find('.vc_container_form_field-border_width');
			$field.find(".vc_container_form_field-color-input").wpColorPicker({
				palettes: true,
				change: function (event, ui) {
					var hexcolor = $(this).wpColorPicker('color');
					$field.find(".field-color-result").val(hexcolor);
				},
				clear: function () {
					$field.find(".field-color-result").val('');
				}
			});
//            $field.find(".vc_container_form_field-border_style").chosen({
//                disable_search_threshold: 3,
//                inherit_select_classes: true,
//                no_results_text: "Oops, nothing found!",
//                width: "100%"
//            });
			if ($border_width_field.val() == '') {
				$field.find('.dfd-border-width').removeClass('expandable');
			}
			$field.find('.border-width-block input[type="number"]').change(function () {
				var $self = $(this);
				if ($self.hasClass('vc_container_form_field-border_width') && $self.val() != '') {
					$self.siblings('input[type="number"]').val('');
				} else if (!$self.hasClass('vc_container_form_field-border_width') && $self.val() != '') {
					$self.siblings('.vc_container_form_field-border_width').val('');
				}
			});
			$field.find('.dfd-border-expand').bind('click', function (e) {
				e.preventDefault();
				$(this).parents('.dfd-border-width').toggleClass('expandable');
			});
			var $borderStyle = $field.find('.vc_container_form_field-border_style'),
				showHideOptions = function () {
					if ($borderStyle.val() != 'none' && $borderStyle.val() != 'default') {
						$borderStyle.parents('.dfd-border-style').addClass('expanded').siblings().show();
					} else {
						$borderStyle.parents('.dfd-border-style').removeClass('expanded').siblings().hide();
					}
				};
			showHideOptions();
			$borderStyle.change(function () {
				showHideOptions();
			});
		},
	};
	
	/*box-shadow*/
	vc.atts.dfd_box_shadow_param = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;
			options.box_shadow_enable = $block.find('.vc_container_form_field-box_shadow_enable input[type="radio"]:checked').val();
			options.shadow_horizontal = $block.find('.vc_container_form_field-shadow_horizontal').val();
			options.shadow_vertical = $block.find('.vc_container_form_field-shadow_vertical').val();
			options.shadow_blur = $block.find('.vc_container_form_field-shadow_blur').val();
			options.shadow_spread = $block.find('.vc_container_form_field-shadow_spread').val();
			options.box_shadow_color = $block.find('.field-color-result').val();
			string_pieces = _.map(options, function (value, key) {
				if (_.isString(value) && 0 < value.length) {
					return key + ':' + encodeURIComponent(value);
				}
			});
			string = $.grep(string_pieces, function (value) {
				return _.isString(value) && 0 < value.length;
			}).join('|');
			return string;
		},
		init: function (param, $field) {
			$field.find(".vc_container_form_field-color-input").wpColorPicker({
				palettes: true,
				change: function (event, ui) {
					var hexcolor = $(this).wpColorPicker('color');
					$field.find(".field-color-result").val(hexcolor);
				},
				clear: function () {
					$field.find(".field-color-result").val('');
				}
			});
			var currValue = $field.find('.vc_container_form_field-box_shadow_enable input[type="radio"]:checked').val(),
				expandSection = function (val) {
					if (val != 'disable') {
						$field.find('.dfd-box-shadow-enable').addClass('expanded').siblings().show();
					} else {
						$field.find('.dfd-box-shadow-enable').removeClass('expanded').siblings().hide();
					}
				};

			expandSection(currValue);
			$field.find('.vc_container_form_field-box_shadow_enable input[type="radio"]').on('click', function () {
				$(this).attr('checked', 'checked').parents('li').addClass('active').siblings().removeClass('active').find('input[type="radio"]').removeAttr('checked');
				expandSection($(this).val());
			});
		},
	};
	
	/*responsive*/
	vc.atts.dfd_param_responsive_css = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;

//            options.margin_desktop = $block.find('.vc_container_form_field-margin_desktop').val();
			options.margin_top_desktop = $block.find('.vc_container_form_field-margin_top_desktop').val();
			options.margin_bottom_desktop = $block.find('.vc_container_form_field-margin_bottom_desktop').val();
			options.margin_left_desktop = $block.find('.vc_container_form_field-margin_left_desktop').val();
			options.margin_right_desktop = $block.find('.vc_container_form_field-margin_right_desktop').val();
//            options.border_desktop = $block.find('.vc_container_form_field-border_desktop').val();
			options.border_top_desktop = $block.find('.vc_container_form_field-border_top_desktop').val();
			options.border_bottom_desktop = $block.find('.vc_container_form_field-border_bottom_desktop').val();
			options.border_left_desktop = $block.find('.vc_container_form_field-border_left_desktop').val();
			options.border_right_desktop = $block.find('.vc_container_form_field-border_right_desktop').val();
//            options.padding_desktop = $block.find('.vc_container_form_field-padding_desktop').val();
			options.padding_top_desktop = $block.find('.vc_container_form_field-padding_top_desktop').val();
			options.padding_bottom_desktop = $block.find('.vc_container_form_field-padding_bottom_desktop').val();
			options.padding_left_desktop = $block.find('.vc_container_form_field-padding_left_desktop').val();
			options.padding_right_desktop = $block.find('.vc_container_form_field-padding_right_desktop').val();

//            options.margin_tablet = $block.find('.vc_container_form_field-margin_tablet').val();
			options.margin_top_tablet = $block.find('.vc_container_form_field-margin_top_tablet').val();
			options.margin_bottom_tablet = $block.find('.vc_container_form_field-margin_bottom_tablet').val();
			options.margin_left_tablet = $block.find('.vc_container_form_field-margin_left_tablet').val();
			options.margin_right_tablet = $block.find('.vc_container_form_field-margin_right_tablet').val();
//            options.border_tablet = $block.find('.vc_container_form_field-border_tablet').val();
			options.border_top_tablet = $block.find('.vc_container_form_field-border_top_tablet').val();
			options.border_bottom_tablet = $block.find('.vc_container_form_field-border_bottom_tablet').val();
			options.border_left_tablet = $block.find('.vc_container_form_field-border_left_tablet').val();
			options.border_right_tablet = $block.find('.vc_container_form_field-border_right_tablet').val();
//            options.padding_tablet = $block.find('.vc_container_form_field-padding_tablet').val();
			options.padding_top_tablet = $block.find('.vc_container_form_field-padding_top_tablet').val();
			options.padding_bottom_tablet = $block.find('.vc_container_form_field-padding_bottom_tablet').val();
			options.padding_left_tablet = $block.find('.vc_container_form_field-padding_left_tablet').val();
			options.padding_right_tablet = $block.find('.vc_container_form_field-padding_right_tablet').val();

//            options.margin_mobile = $block.find('.vc_container_form_field-margin_mobile').val();
			options.margin_top_mobile = $block.find('.vc_container_form_field-margin_top_mobile').val();
			options.margin_bottom_mobile = $block.find('.vc_container_form_field-margin_bottom_mobile').val();
			options.margin_left_mobile = $block.find('.vc_container_form_field-margin_left_mobile').val();
			options.margin_right_mobile = $block.find('.vc_container_form_field-margin_right_mobile').val();
//            options.border_mobile = $block.find('.vc_container_form_field-border_mobile').val();
			options.border_top_mobile = $block.find('.vc_container_form_field-border_top_mobile').val();
			options.border_bottom_mobile = $block.find('.vc_container_form_field-border_bottom_mobile').val();
			options.border_left_mobile = $block.find('.vc_container_form_field-border_left_mobile').val();
			options.border_right_mobile = $block.find('.vc_container_form_field-border_right_mobile').val();
//            options.padding_mobile = $block.find('.vc_container_form_field-padding_mobile').val();
			options.padding_top_mobile = $block.find('.vc_container_form_field-padding_top_mobile').val();
			options.padding_bottom_mobile = $block.find('.vc_container_form_field-padding_bottom_mobile').val();
			options.padding_left_mobile = $block.find('.vc_container_form_field-padding_left_mobile').val();
			options.padding_right_mobile = $block.find('.vc_container_form_field-padding_right_mobile').val();

			string_pieces = _.map(options, function (value, key) {
				if (_.isString(value) && 0 < value.length) {
					return key + ':' + encodeURIComponent(value);
				}
			});
			string = $.grep(string_pieces, function (value) {
				return _.isString(value) && 0 < value.length;
			}).join('|');
			return string;
		},
		init: function (param, $field) {
			$('h4.resolution', $field).click(function (e) {
				$(this).parent('.dfd-responsive-properties-wrap').addClass('active').siblings().removeClass('active');
			});
		},
	};

	/*responsive*/
	vc.atts.dfd_param_responsive_text = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;

			options.font_size_desktop = $block.find('.vc_container_form_field-font_size_desktop').val();
			options.line_height_desktop = $block.find('.vc_container_form_field-line_height_desktop').val();
			options.letter_spacing_desktop = $block.find('.vc_container_form_field-letter_spacing_desktop').val();

			options.font_size_tablet = $block.find('.vc_container_form_field-font_size_tablet').val();
			options.line_height_tablet = $block.find('.vc_container_form_field-line_height_tablet').val();
			options.letter_spacing_tablet = $block.find('.vc_container_form_field-letter_spacing_tablet').val();

			options.font_size_mobile = $block.find('.vc_container_form_field-font_size_mobile').val();
			options.line_height_mobile = $block.find('.vc_container_form_field-line_height_mobile').val();
			options.letter_spacing_mobile = $block.find('.vc_container_form_field-letter_spacing_mobile').val();

			string_pieces = _.map(options, function (value, key) {
				if (_.isString(value) && 0 < value.length) {
					return key + ':' + encodeURIComponent(value);
				}
			});
			string = $.grep(string_pieces, function (value) {
				return _.isString(value) && 0 < value.length;
			}).join('|');
			return string;
		},
		init: function (param, $field) {
			$field.find('a.dfd-resolution-section-expand').click(function (e) {
				e.preventDefault();
				$(this).parents('.inner-wrap').toggleClass('expanded').find('input[type="number"]').each(function () {
					$(this).val('');
				});
			});
		}
	};
	
	/*hotspot*/
	vc.atts.dfd_hotspot_param = {
		init: function (param, $field) {
			if(!$field.prev().data('vc-shortcode-param-name') || !$field.prev().data('vc-shortcode-param-name') == 'image') {
				return false;
			}
			
			var imgSrc = '',
				$imgInput = $field.prev().find('input[name="image"]'),
				previewImage = function() {
					if($field.prev().find('img').length > 0) {
						var id = $field.find('.dfd_hotspot_ls_var').attr('id');
						imgSrc = $field.prev().find('img').attr('src');
						imgSrc = imgSrc.replace('-150x150', '', imgSrc);
						if($field.find('img.dfd-hotspot-image').length > 0) {
							$field.find('img.dfd-hotspot-image').attr('src', imgSrc);
						} else {
							$field.find('.dfd-hotspot-image-holder').append('<img src="'+imgSrc+'" alt="Preview image" class="dfd-hotspot-image" />');
						}
						$field.find('.dfd-hotspot-image-holder').hotspot({
							mode:			'admin',
							LS_Variable:	'#'+id,
							popupTitle:		$field.find('.dfd-hotspot-image-holder').data('popup-title') ? $field.find('.dfd-hotspot-image-holder').data('popup-title') : 'Save',
							saveText:		$field.find('.dfd-hotspot-image-holder').data('save-text') ? $field.find('.dfd-hotspot-image-holder').data('save-text') : 'Save',
							closeText:		$field.find('.dfd-hotspot-image-holder').data('close-text') ? $field.find('.dfd-hotspot-image-holder').data('close-text') : 'Close',
							dataStuff: [
								{
									'property': 'Title',
									'default': 'Please enter title here'
								},
								{
									'property': 'Message',
									'default': 'Please enter content here'
								}
							]
						});
					}
				};
				
			previewImage();
			$imgInput.change(function() {
				previewImage();
			});
		},
	};
})(window.jQuery);

/* DFD Delimiter param  */
;(function ( $, window, undefined ) {
	function update_visibility(el) {
		var status = el.find('.dfd-delimiter-style-section select').val() || 'none';
		if( status === 'none' ) {
			el.find('.dfd-delim-settings-fields, .dfd-colorpicker-section').hide();
		} else {
			el.find('.dfd-delim-settings-fields, .dfd-colorpicker-section').show();
		}
	}

	if(typeof $.fn.chosen !== 'undefined') {
		$('.dfd-select').chosen({
			allow_single_deselect: true,
			width: "100%"
		});
	}

	$('.dfd-delimiter').each(function(index, element) {
		var el = $(element);
		
		update_visibility(el);
		$('.dfd-delimiter-style-section select',el).change(function() {
			update_visibility(el);
		});
		
		dfd_delimiter_set_init_values(el);
		
		el.find('input, select').change(function() {
			dfd_delimiter_update_values(el);
		});
	});
	
	function dfd_delimiter_update_values(el) {
		var new_val = '',
			hidden_input = el.find('.dfd-delimiter-value'),
			units = el.find(".dfd-units").val();
		
		new_val += 'border-bottom-style:'+el.find(".dfd-border-bottom-style").val()+';|';
		new_val += 'border-bottom-width:'+el.find(".dfd-border-bottom-width").val()+units+';|';
		new_val += 'width:'+el.find(".dfd-width").val()+units+';|';
		new_val += 'border-bottom-color:'+el.find(".dfd-border-bottom-color").val()+';';
		
		hidden_input.val(new_val);
	}
	
	function dfd_delimiter_set_init_values(el) {
		var hidden_input = el.find('.dfd-delimiter-value'),
			option_value = hidden_input.val();
		
		if(option_value != '') {
			var val = option_value.split('|');
			val.forEach(function(item, i, arr) {
				var prop_arr = item.split(':');
				if(el.find('.dfd-'+prop_arr[0]).length > 0) {
					if(el.find('.dfd-'+prop_arr[0]).hasClass('dfd-border-bottom-style')) {
						el.find('.dfd-'+prop_arr[0]).val(prop_arr[1].slice(0, prop_arr[1].length - 1));
						el.find('.dfd-'+prop_arr[0]).trigger('chosen:updated');
						update_visibility(el);
					} else if(el.find('.dfd-'+prop_arr[0]).hasClass('dfd-width')) {
						el.find('.dfd-'+prop_arr[0]).val(prop_arr[1].slice(0, prop_arr[1].length - 3));
						el.find('.dfd-units').val(prop_arr[1].slice(-3,-1));
						el.find('.dfd-units').trigger('chosen:updated');
					} else if(el.find('.dfd-'+prop_arr[0]).hasClass('dfd-border-bottom-width')) {
						el.find('.dfd-'+prop_arr[0]).val(prop_arr[1].slice(0, prop_arr[1].length - 3));
					} else if(el.find('.dfd-'+prop_arr[0]).hasClass('dfd-border-bottom-color')) {
						el.find('.dfd-'+prop_arr[0]).val(prop_arr[1].slice(0, prop_arr[1].length - 1)).trigger('change');
					} else {
						el.find('.dfd-'+prop_arr[0]).val(prop_arr[1].slice(0, prop_arr[1].length - 1));
					}
				}
			});
		}
	}
}(jQuery.noConflict(), window));

/* Ultimate Border - Param  */
;(function ( $, window, undefined ) {

  function update_visibility(t) {
    var status = t.find(".ultimate-border-style-selector option:selected").val() || 'none';     // set data status
    if( status === 'none' ) {
      t.find('.ultimate-four-input-section, .ultimate-border-radius-block, .ultimate-colorpicker-section').hide();
    } else {
      t.find('.ultimate-four-input-section, .ultimate-border-radius-block, .ultimate-colorpicker-section').show();
    }
  }

  //  Enable chosen
  if(typeof $.fn.chosen !== 'undefined') {
	  $('.ultimate-border-style-selector').chosen({
		  allow_single_deselect: true,
		  width: "100%"
	  });
  }

  $(".ultimate-border").each(function(index, element) {
    var t = $(element);
      init(t);
      get_hidden_with_border_style(t);
      //set_hidden_with_border_style(t);
  });
  function init(t) {
    //  Hide {all}
    t.find('.ultb-width-all, .ultb-radius-all').attr('data-status', 'hide-all');
    t.find('.ultb-width-single, .ultb-radius-single').hide();
    t.find('.ultb-width-section .ult-expand, .ultb-radius-section .ult-expand').addClass('ult-collapse');

    //  border-width
    t.find('.ultb-width-section .ult-expand').click(function(event) {
      t.find('.ultb-width-all, .ultb-width-single').toggle();

      //  UPDATE STATUS
      var status = t.find('.ultb-width-all').attr('data-status') || 'hide-me';
      if( status === 'hide-me' ) {
        t.find('.ultb-width-section .ult-expand').addClass('ult-collapse');
        t.find('.ultb-width-all').attr('data-status', 'hide-all');
      } else {
        t.find('.ultb-width-section .ult-expand').removeClass('ult-collapse');
        t.find('.ultb-width-all').attr('data-status', 'hide-me');
      }
      set_hidden_with_border_style(t);
    });


    //  border-radius
    t.find('.ultb-radius-section .ult-expand').click(function(event) {
      t.find('.ultb-radius-all, .ultb-radius-single').toggle();

      //  UPDATE STATUS
      var status = t.find('.ultb-radius-all').attr('data-status') || 'hide-me';
      if( status === 'hide-me' ) {
        t.find('.ultb-radius-section .ult-expand').addClass('ult-collapse');
        t.find('.ultb-radius-all').attr('data-status', 'hide-all');
      } else {
        t.find('.ultb-radius-section .ult-expand').removeClass('ult-collapse');
        t.find('.ultb-radius-all').attr('data-status', 'hide-me');
      }
      set_hidden_with_border_style(t);
    });

    //  unit change
    t.find('.ult-unit-border-width, .ult-unit-border-radius').change(function(event) {
      set_hidden_with_border_style(t);
    });
    
    //  Clear the color
    t.find('.wp-picker-clear').click(function(event) {
      var hxcolor = 'transparent';
      set_hidden_with_border_style(t, hxcolor);
    });

    /* = Color Picker  
     ----------------------------------------*/
    t.find(".ultimate-colorpicker").wpColorPicker();
  }

  function get_hidden_with_border_style(t) {
      var l = t.find(".ultimate-border-style-selector").length;
      var mv = t.find(".ultimate-border-value").val();

      if (mv != "") {
        if(l) {
          var vals = mv.split("|");
            // set border style 
            var splitval = vals[0].split(":");
            var bstyle = splitval[1].split(";");
            t.find(".ultimate-border-style-selector").val(bstyle[0]);
            t.find(".ultimate-border-style-selector").trigger("chosen:updated");
            
            // Disable inputs if border-style - {none}
            if(typeof bstyle[0] != 'undefined' && bstyle[0] != null) {
              if(bstyle[0]==='none') {
                update_visibility(t);
              }
            }

            //  set border widths
            var bw = vals[1].split(";");
        }

        $.each(bw, function(i, vl) {
            if (vl != "") {
                t.find(".ultimate-border-inputs").each(function(input_index, elem) {
                  var splitval = vl.split(":");
                  var dataid = $(elem).attr("data-id");

                  if( typeof splitval[0] != 'undefined' && splitval[0] != null ) {

                    //  Collapse / Expand - {border width}
                    /*if( splitval[0] === 'border-width') {
                    }*/

                    //  Collapse / Expand - {border radius}
                    /*if( splitval[0] === 'border-radius') {
                    }*/

                    switch(splitval[0]) {
                      case 'border-width':
                                            t.find('.ultb-width-all').show();
                                            t.find('.ultb-width-all').attr('data-status', 'hide-all');
                                            t.find('.ultb-width-single').hide();
                                            t.find('.ultb-width-section .ult-expand').addClass('ult-collapse');
                                    break;

                      case 'border-top-width':
                      case 'border-right-width':
                      case 'border-bottom-width':
                      case 'border-left-width':
                                            t.find('.ultb-width-all').hide();
                                            t.find('.ultb-width-all').attr('data-status', 'hide-me');
                                            t.find('.ultb-width-single').show();
                                            t.find('.ultb-width-section .ult-expand').removeClass('ult-collapse');
                        break;

                      case 'border-radius':
                                            t.find('.ultb-radius-all').show();
                                            t.find('.ultb-radius-all').attr('data-status', 'hide-all');
                                            t.find('.ultb-radius-single').hide();
                                            t.find('.ultb-radius-section .ult-expand').addClass('ult-collapse');
                                    break;
                      case 'border-top-left-radius':
                      case 'border-top-right-radius':
                      case 'border-bottom-right-radius':
                      case 'border-bottom-left-radius':
                                            t.find('.ultb-radius-all').hide();
                                            t.find('.ultb-radius-all').attr('data-status', 'hide-me');
                                            t.find('.ultb-radius-single').show();
                                            t.find('.ultb-radius-section .ult-expand').removeClass('ult-collapse');
                        break;
                    }



                    switch(splitval[0]) {
                      case 'border-width':
                      case 'border-top-width':
                      case 'border-right-width':
                      case 'border-bottom-width':
                      case 'border-left-width':
                        var val = splitval[1].match(/\d+/);
                        var b = splitval[1].split(val);
                        var unit = 'px';
                        if(typeof b[1] != 'undefined' && b[1] != null) {
                          unit = b[1];
                        }
                        t.find(".ult-unit-border-width").val(unit);     // set border select unit
                        if( dataid==splitval[0] ) {
                          mval = splitval[1].split(unit);
                          $(elem).val(mval[0]);
                        }
                        break;

                      case 'border-radius':
                      case 'border-top-left-radius':
                      case 'border-top-right-radius':
                      case 'border-bottom-right-radius':
                      case 'border-bottom-left-radius':
                        var val = splitval[1].match(/\d+/);
                        var b = splitval[1].split(val);
                        var unit = 'px';
                        if(typeof b[1] != 'undefined' && b[1] != null) {
                          unit = b[1];
                        }
                        t.find(".ult-unit-border-radius").val(unit);     // set border select unit
                        if( dataid==splitval[0] ) {
                          mval = splitval[1].split(unit);
                          $(elem).val(mval[0]);
                        }
                        break;
                    }

                  }
               });
            }
        });

        // set color 
        var splitcols = mv.split("|");
        if(typeof splitcols[2] != 'undefined' || splitcols[2] != null){
          var sp = splitcols[2].split(":");
          var nd = sp[1].split(";");
          var did = t.find(".ultimate-colorpicker").attr("data-id");
          if(sp[0]==did) {
            if( nd[0] !== 'transparent') {
              t.find(".ultimate-colorpicker").val(nd[0]).trigger('change');
              //t.find("a.wp-color-result").css({"background-color": nd[0]});
              //   set alpha value
              var picker = $.cs_ParseColorValue( nd[0] );
              var sl_value = parseFloat( picker.alpha / 100 );
              var alpha_val = sl_value < 1 ? sl_value : '';
              t.find('.cs-alpha-text').text( alpha_val );
              //  drag position
              if(alpha_val == '') {
                t.find('.cs-alpha-slider .ui-slider-handle').css('left', '100%');
              } else {
                alpha_val = parseFloat(alpha_val * 100);
                t.find('.cs-alpha-slider .ui-slider-handle').css('left', alpha_val+'%');
              }
              t.find('.wp-picker-container').find('.cs-alpha-slider-offset').css('background-color', nd[0]);
              t.find('.iris-strip').css('background-image', '-webkit-linear-gradient(top, '+nd[0]+', rgb(197, 197, 197))');
            }
          }
        }
      } else {
        update_visibility(t);
        t.find(".ultimate-border-inputs").each(function(input_index, elem) {
          var d = $(elem).attr("data-default");
          $(elem).val(d);
        });
      }
  }

  // [2]  On change - input / select
  $(".ultimate-border-input, .ultimate-border-style-selector, .ultimate-colorpicker").on('change', function(e){
    var t = $(this).closest('.ultimate-border');
    var v = t.find('.ultimate-border-value').val();

    update_visibility(t);
    set_hidden_with_border_style(t);
  });

  function set_hidden_with_border_style(t, hxcolor) {
    var nval = "";
    var l = t.find(".ultimate-border-style-selector").length;
    //  check border style is avai. then add border style
    if(l) {
      var sv = t.find(".ultimate-border-style-selector option:selected").val();
      t.find(".ultimate-border-value").val(nval);
      var nval = "border-style:" +sv+ ";|";
    } 
    
    //  border
    var wd = t.find('.ultb-width-all').attr('data-status') || 'hide-all';
    var border = '';
    if( wd === 'hide-all' ) {
      border = 'ultb-width-all'; }
    else {
      border = 'ultb-width-single';
    }
    t.find('.'+border+' .ultimate-border-input').each(function(index, elm) {
      var unit = t.find(".ult-unit-border-width option:selected").val() || t.find(".ultimate-border-value").attr("data-unit");
      var ival = $(elm).val();
      if ($.isNumeric(ival)) {
          if (ival.match(/^[0-9]+$/))
              var item = $(elm).attr("data-id") + ":" + $(elm).val() + unit + ";";
          nval += item;
      }
    });

    //  radius
    var rd = t.find('.ultb-radius-all').attr('data-status') || 'hide-all';
    var radius = '';
    if( rd === 'hide-all' ) {
      radius = 'ultb-radius-all'; }
    else {
      radius = 'ultb-radius-single';
    }
    t.find('.'+radius+' .ultimate-border-input').each(function(index, elm) {
      var unit = t.find(".ult-unit-border-radius option:selected").val() || t.find(".ultimate-border-value").attr("data-unit");
      var ival = $(elm).val();
      if ($.isNumeric(ival)) {
          if (ival.match(/^[0-9]+$/))
              var item = $(elm).attr("data-id") + ":" + $(elm).val() + unit + ";";
          nval += item;
      }
    });
    
    //  colors
    if(typeof hxcolor != "undefined" || hxcolor != null) {
      var nval = nval + "|border-color:" +hxcolor+ ";";
    } else {
      var va = t.find(".ultimate-colorpicker").val();
      if(va!='') {
        var nval = nval + "|border-color:" +va+ ";";
      }
    }
    t.find(".ultimate-border-value").val(nval);
  }

}(jQuery, window));

!function($) {
	$('.ultimate_google_font_param_block > select').each(function(index, element) {
        $select = $(this);
		var random_num = Math.floor((Math.random() * 10000000) + index);
		process_vc_gfont_fields($select, random_num, change = 'false');
    });
	$('.ultimate_google_font_param_block > select').change(function(e){
		e.preventDefault();
		var random_num = Math.floor((Math.random() * 10000000) + 1);
		process_vc_gfont_fields($(this), random_num , change = 'true');
	});
	$('body').on('click', '.ugfont-input', function () {
		var font_style = '';
		var temp_chk = 0;
		$fstyle = $(this).parent('.ultimate_fstyle').parent();
		var tmp_array = new Array();
		$fstyle.find('.ugfont-input').each(function (index, checkbox) {
			if ($(this).is(':checked')) {
				var val = $(this).val();
				tmp_array.push(val);
			}
		});
		var font_style = '';
		$.each(tmp_array,function (index, value) {
			if (index != 0) {
				font_style += ',';
			}
			font_style += value;
		});
		$fstyle.find('.ugfont-style-value').val(font_style);
	});
	$('body').on('click', '.style_by_google', function(){
		var variant = $(this).attr('data-variant');
		if($(this).is(':checked'))
		{
			var wpb_el_type_ultimate_google_fonts_style = $(this).parents('.wpb_el_type_ultimate_google_fonts_style');
			var wpb_el_type_ultimate_google_fonts = wpb_el_type_ultimate_google_fonts_style.prev();
			var vc_ultimate_google_font = wpb_el_type_ultimate_google_fonts.find('.vc-ultimate-google-font').val();
			var split_font = vc_ultimate_google_font.split('|'); //font_family=xyz|font_call=xyz:100,200
			var font_family = split_font[0]; //font_family=xyz
			var font_call = split_font[1]; //font_call=xyz
			var new_font = font_family+'|'+font_call+'|variant:'+variant;
			wpb_el_type_ultimate_google_fonts.find('.vc-ultimate-google-font').val(new_font);
		}
	});
}(window.jQuery);
var temp_count = 0;
function process_vc_gfont_fields($select, random_num, is_font_change)
{
	var ultimate_vc_gfonts_field = $select.parents('.wpb_el_type_ultimate_google_fonts');
	var vc_ultimate_google_font = ultimate_vc_gfonts_field.find('.vc-ultimate-google-font');
	var vc_ultimate_google_font_val = vc_ultimate_google_font.val();
	var val = '';
	if(is_font_change == 'false')
	{
		if(vc_ultimate_google_font_val != '')
		{
			var gfont_name_attr = vc_ultimate_google_font_val.split('|');
			var gfont_name = gfont_name_attr[0].split(':');
			val = gfont_name[1];
			if(val == '')
				val = 'default';
		}
		else
			val = 'default';
			
		$select.find('option').each(function(index, option) {
        	if(jQuery(option).val() == val)
				jQuery(option).attr('selected',true);
    	});
	}
	else
	{
		var val = $select.find('option:selected').val();
		var new_font_call = val.replace(/\s+/g,'+');
		var new_font = 'font_family:'+val+'|font_call:'+new_font_call;
		vc_ultimate_google_font.val(new_font);
	}
	var $next_fstyler = ultimate_vc_gfonts_field.next('.wpb_el_type_ultimate_google_fonts_style').find('.ultimate_fstyle');	
	if(typeof $next_fstyler != "undefined")
	{		
		$next_fstyler.html('<span class="spinner" style="display:inline-block; float:left;margin:0;visibility:visible"></span>');
		var data = {
			action : 'get_font_variants',
			font_name : val
		}
		jQuery.post(ajaxurl, data, function(response) {
			var current_style = '';
			if($next_fstyler.parent().find('.ugfont-style-value'))
				current_style = $next_fstyler.parent().find('.ugfont-style-value').val();
			var temp_array = new Array();
			var is_array = false;
			if (temp_array = split(',',current_style)) {
				is_array = true;
			}
			else {
				if(current_style && current_style != '')
					temp_array.push(current_style);
			}
			var html = temp_last_fgroup = '';
			var font_variant = jQuery.parseJSON(response);
			jQuery.each(font_variant, function (index, variant) {
				var flabel = variant.label;
				var fstyle = variant.style;
				var ftype = variant.type;
				var fgroup = variant.group+'-'+temp_count;
				var fclass = variant.class;
				var checked = '';
				if(temp_array && temp_array.length != 0)
				{
					jQuery.each(temp_array, function (i,v) {
						if (v == fstyle && is_font_change == 'false')
							checked = 'checked';
					});
				}
				var label_style = 'font-family:\''+val+'\';'+fstyle;
				if (fgroup != temp_last_fgroup && temp_last_fgroup != '')
				{
					html += '<div style="height:6px">&nbsp;</div>';
					if(ftype == 'radio')
						html += '<input type="radio" name="'+fgroup+'" data-variant="regular" style="width:auto; margin-left: 5px; margin-right: 2px;" id="uvc-default-font-'+fgroup+'" class="ugfont-input '+fclass+'" checked value="font-weight:normal;font-style:normal;" />&nbsp;<label for="uvc-default-font-'+fgroup+'" style="font-family:\''+val+'\';font-style: normal;">Default</label> &nbsp; ';
				}
				var vl = val.replace(/\s+/g, '-').toLowerCase();
				var uid = vl +'-'+ random_num;
				uid += '-'+flabel+'-'+index;
				if(jQuery('#'+uid).length != 0)
					uid += '-'+$('#'+uid).length;
				html += '<input type="'+ftype+'" data-variant="'+flabel+'" name="'+fgroup+'" style="width:auto; margin-left: 5px; margin-right: 2px;" '+checked+' id="'+uid+'-'+fgroup+'" class="'+fclass+' '+flabel+' ugfont-input" value="'+fstyle+'" />&nbsp;<label for="'+uid+'-'+fgroup+'" style="'+label_style+'">'+flabel+'</label> &nbsp; ';
				temp_last_fgroup = fgroup;
			});
			$next_fstyler.html(html);
		});
		temp_count++;
	}
}

$jvh = jQuery.noConflict();
$jvh('.ultimate-margin-inputs').on('change', function(e){
	$umargin = $jvh(this).parent();
	var temp = '';
	$umargin.find('.ultimate-margin-inputs').each(function(input_index, input){
		var margin_parameter = $jvh(input).attr('data-hmargin');
		var input_value = $jvh(input).val();
		if(input_value != '')
		{
			if(input_value.match(/^[0-9]+$/))
				input_value += 'px';
			temp += 'margin-'+margin_parameter+':'+input_value+';';
		}
	});
	$umargin.find('.ultimate-margin-value').val(temp);
});
$jvh('.ultimate-margins').each(function(index, element){
	$umargin = $jvh(this);
	var ultimate_margin_value = $umargin.find('.ultimate-margin-value').val();
	if(ultimate_margin_value != '')
	{
		var vals = ultimate_margin_value.split(';');
		$jvh.each(vals, function(i,vl){
			if(vl != '')
			{
				var splitval = vl.split(':');
				var margin_value = splitval[1];
				var param = splitval[0].split('-');
				var margin_parameter = param[1];
				$umargin.find('.ultimate-margin-inputs').each(function(input_index, input){
					var input_margin_parameter = $jvh(input).attr('data-hmargin');
					if(margin_parameter == input_margin_parameter)
						$jvh(input).val(margin_value);
				});
			}
		})
	}
});