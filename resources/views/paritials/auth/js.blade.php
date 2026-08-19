<script src="{{ asset('assets/JQuery/jquery.validate-1.0.9.min.js') }}"></script>
<script src="{{ asset('assets/toastify/toastify.js') }}"></script>


<script type="text/javascript">
(function($) {
		$.fn.serializeFormJSON = function() {
			var o = {};
			var a = this.serializeArray();
			$.each(a, function(index, row) {
				//object or array
				if (o[row.name]) {
					if (!o[row.name].push) {
						o[row.name] = [o[row.name]];
					}
					//extended function for datetimepicker formate DD/MM/YYYY to YYYY-MM-DD
					if ($('#' + row.name).attr("class").indexOf("datepicker") >= 0) {
						var value = moment(row.value, 'DD/MM/YYYY').isValid() ?
							moment(moment(row.value, 'DD/MM/YYYY')).format("YYYY-MM-DD") : '';
						o[row.name].push(value);
					}
					else if ($('#' + row.name).attr("class").indexOf("checkbox") >= 0) {
						var value =$('#' + row.name).prop("checked") == true ?  1 :  0;
						o[row.name].push(value);
					}
					//to float value for number and number4D class
					else if ($('#' + row.name).attr("class").indexOf("number") >= 0 ||
						$('#' + row.name).attr("class").indexOf("number4D") >= 0 ||
						$('#' + row.name).attr("class").indexOf("number8D") >= 0) {
						var value = parseFloat(row.value.toString().replace(/\,/g, ''));
						o[row.name].push(value);
					} else {
						o[row.name].push(row.value || '');
					}
				}
				//single entity
				else {
					//extended function for datetimepicker formate DD/MM/YYYY to YYYY-MM-DD 
					if (typeof $('#' + row.name).attr("class") !== "undefined") {

						if ($('#' + row.name).attr("class").indexOf("datepicker") >= 0) {
							var value = moment(row.value, 'DD/MM/YYYY').isValid() ?
								moment(moment(row.value, 'DD/MM/YYYY')).format("YYYY-MM-DD") : '';
							o[row.name] = value;
						}
						else if ($('#' + row.name).attr("class").indexOf("checkbox") >= 0) {
							var value =$('#' + row.name).prop("checked") == true ?  1 :  0;
							o[row.name] = value;
						}
						//to float value for number and number4D class
						else if ($('#' + row.name).attr("class").indexOf("number") >= 0 ||
							$('#' + row.name).attr("class").indexOf("number4D") >= 0 ||
							$('#' + row.name).attr("class").indexOf("number8D") >= 0) {
							var value = parseFloat(row.value.toString().replace(/\,/g, ''));
							o[row.name] = value;
						} else {
							o[row.name] = row.value || '';
						}
					} else {
						o[row.name] = row.value || '';
					}
				}
			});
			return o;
		};
	})(jQuery);
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function ajaxGet(formData, url, scbFunction, fcbFunction = null) {
		ajax(formData, url, scbFunction, fcbFunction, "GET");
	}

	function ajaxPost(formData, url, scbFunction, fcbFunction = null) {
		ajax(formData, url, scbFunction, fcbFunction, "POST");
	}

	function ajax(formData, url, scbFunction, fcbFunction, type) {
		$(".alert").hide();
		$('#mainAjaxbusy').show();
		$.ajax({
			type: type,
			data: formData,
			dataType: 'json',
			url: url,
			success: function(data, status, xhr) {
				console.log(data);
				if (data.statusCode > 0) {

					if (data.statusMsg != "") {
						showSuccessNotification(data.statusMsg); //from notification.blade                        
					}

					if (typeof scbFunction !== 'undefined' && $.isFunction(scbFunction)) {
						scbFunction(data);
					}
				} else {
					if (data.statusMsg != "") {
						showErrorNotification(data.statusMsg);
						console.log(data.statusMsg);
					}
					if (typeof fcbFunction !== 'undefined' && $.isFunction(fcbFunction)) {
						fcbFunction(data);
					}
				}

				$('#mainAjaxbusy').hide();
			},
			error: function(data, status, xhr) {
				$('#mainAjaxbusy').hide();
				showErrorNotification(data.statusMsg);
			}
		});
	}
	var dataTableOptions = function(options) {
		var tableOptions = {
			columns: options.hasOwnProperty("columns") ? options.columns : null,
			columnDefs: options.hasOwnProperty("columnDefs") ? options.columnDefs : null,
			data: options.hasOwnProperty("data") ? options.data : null,
			filter: options.hasOwnProperty("filter") ? options.filter : true,
			info: options.hasOwnProperty("info") ? options.info : true,
			ordering: options.hasOwnProperty("ordering") ? options.ordering : true,
			ajax: options.hasOwnProperty("ajax") ? options.ajax : null,
			serverSide: options.hasOwnProperty("serverSide") ? options.serverSide : false,
			paging: options.hasOwnProperty("paging") ? options.paging : true,
			iDisplayLength: options.hasOwnProperty("iDisplayLength") ? options.iDisplayLength : 25,
			lengthMenu: options.hasOwnProperty("lengthMenu") ? options.lengthMenu : [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			lengthChange: options.hasOwnProperty("lengthChange") ? options.lengthChange : true,
			processing: options.hasOwnProperty("processing") ? options.processing : true,
			bAutoWidth: options.hasOwnProperty("bAutoWidth") ? options.bAutoWidth : true,
			retrieve: options.hasOwnProperty("retrieve") ? options.retrieve : true,
			responsive: options.hasOwnProperty("responsive") ? options.responsive : true,
			rowReorder: options.hasOwnProperty("rowReorder") ? options.responsive : null,
			columnDefs: options.hasOwnProperty("columnDefs") ? options.columnDefs : [{
				"className": "dt-center",
				"targets": "_all"
			}],
			dom: options.hasOwnProperty("dom") ? options.dom : '<"row"<"col-sm-2" l><"col col-sm-6" B ><"col-sm-4"f>>' +
				'<"row"<"col-sm-12"tr>>' +
				'<"row"<"col-sm-8"i><"col-sm-4"p>>',

			buttons: options.hasOwnProperty("buttons") ? options.buttons : [{
				extend: "excelHtml5",
				text: 'EXCEL <i class="far fa-file-excel"></i>',
				orientation: 'landscape',
				className: 'btn btn-primary',
				exportOptions: {
					columns: ':not(.no_export)'
				},
				init: function(api, node, config) {
					$(node).removeClass('btn-secondary')
				}
			}],
			footerCallback: options.hasOwnProperty("footerCallback") ? options.footerCallback : null,
			select: options.hasOwnProperty("select") ? options.select : false,
			drawCallback: options.hasOwnProperty("drawCallback") ? options.drawCallback : null,
			rowGroup: options.hasOwnProperty("rowGroup") ? options.rowGroup : null,
			initComplete: options.hasOwnProperty("initComplete") ? options.initComplete : null
		};

		return tableOptions;
	};

	var dataTableOptionsWithoutExcel = function(options) {

		var tableOptions = {
			columns: options.hasOwnProperty("columns") ? options.columns : null,
			columnDefs: options.hasOwnProperty("columnDefs") ? options.columnDefs : null,
			data: options.hasOwnProperty("data") ? options.data : null,
			filter: options.hasOwnProperty("filter") ? options.filter : true,
			info: options.hasOwnProperty("info") ? options.info : true,
			ordering: options.hasOwnProperty("ordering") ? options.ordering : true,
			ajax: options.hasOwnProperty("ajax") ? options.ajax : null,
			serverSide: options.hasOwnProperty("serverSide") ? options.serverSide : false,
			paging: options.hasOwnProperty("paging") ? options.paging : true,
			iDisplayLength: options.hasOwnProperty("iDisplayLength") ? options.iDisplayLength : 25,
			lengthMenu: options.hasOwnProperty("lengthMenu") ? options.lengthMenu : [
				[10, 25, 50, 100, -1],
				[10, 25, 50, 100, "All"]
			],
			lengthChange: options.hasOwnProperty("lengthChange") ? options.lengthChange : true,
			processing: options.hasOwnProperty("processing") ? options.processing : true,
			bAutoWidth: options.hasOwnProperty("bAutoWidth") ? options.bAutoWidth : true,
			retrieve: options.hasOwnProperty("retrieve") ? options.retrieve : true,
			responsive: options.hasOwnProperty("responsive") ? options.responsive : true,
			rowReorder: options.hasOwnProperty("rowReorder") ? options.responsive : null,
			columnDefs: options.hasOwnProperty("columnDefs") ? options.columnDefs : [{
				"className": "dt-center",
				"targets": "_all"
			}],
			dom: options.hasOwnProperty("dom") ? options.dom : '<"row"<"col-sm-3" l><"col col-sm-5"><"col-sm-4 pull-right"f>>' +
				'<"row"<"col-sm-12"tr>>' +
				'<"row"<"col-sm-8"i><"col-sm-4"p>>',
			footerCallback: options.hasOwnProperty("footerCallback") ? options.footerCallback : null,
			select: options.hasOwnProperty("select") ? options.select : false,
			drawCallback: options.hasOwnProperty("drawCallback") ? options.drawCallback : null,
			rowGroup: options.hasOwnProperty("rowGroup") ? options.rowGroup : null,
			initComplete: options.hasOwnProperty("initComplete") ? options.initComplete : null
		};

		return tableOptions;
	};
</script>


<script type="text/javascript">


	function loadJsonToHtml(jsonData) {
		$.each(jsonData.data, function(key, value) { 
			$("#" + key).val(value);
		});
	}
</script>


<script type="text/javascript">
	var getValidationOptions = function(options) {
		var validation_option = {
			rules: options.hasOwnProperty("rules") ? options.rules : null,			
			//messages: options.hasOwnProperty("messages") ? options.messages : null,
			messages: options.hasOwnProperty("messages") ? options.messages : '',
			ignore: options.hasOwnProperty("ignore") ? options.ignore : ':hidden:not([class~=selectized]),:hidden > .selectized, .selectize-control .selectize-input input',
			errorPlacement: options.hasOwnProperty("errorPlacement") ? options.errorPlacement : function(error,
				element) { 

				var errorholderid = $(element).data('errorholderid');
				if (errorholderid) {
					$('#' + errorholderid).append(error)
				} else {
					if (element.attr("class").indexOf("select") >= 0) {
						element.parent().children('.selectize-control').children('.selectize-input').after(
							error);
					} else if (element.parent('div').attr("class").indexOf("input-group") >= 0) {
						element.parent().children('.error_message').after(error);

					} else {
						error.insertAfter(element);
					}
				}

			},
			success: options.hasOwnProperty("success") ? options.success : function(label) {
				
			},
			highlight: options.hasOwnProperty("highlight") ? options.highlight : function(element, errorClass,
				validClass) {
				$(element).addClass("is-invalid"); 
				if ( $(element).attr("class").indexOf("selectized") >= 0 )  {
					$(element).parent().children('.selectize-control').addClass("is-invalid");
				}
			},
			unhighlight: options.hasOwnProperty("unhighlight") ? options.unhighlight : function(element,
				errorClass, validClass) {
				$(element).removeClass("is-invalid");
				if ( $(element).attr("class").indexOf("selectized") >= 0 )  {
					$(element).parent().children('.selectize-control').removeClass("is-invalid");
				}
			}
		}
		return validation_option;
	}
</script>



{{-- Number Formatter: UpdatedOn: 2021-11-03 --}}
<script type="text/javascript">
	$('.number').keypress(function(event) {
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	$('.number4D').keypress(function(event) {
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	$('.number8D').keypress(function(event) {
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});

	
	function convertToDBDate(value) {
		return moment(value, 'DD/MM/YYYY').isValid() ? moment(moment(value, 'DD/MM/YYYY')).format("YYYY-MM-DD") : '';
	}	
</script>

{{-- Selectize: UpdatedOn: 2021-11-03 --}}
<script type="text/javascript">
	function seletizeDisableDropdown(id) {
		id = id.replace('#', '');
		$('#' + id).prop('disabled', true);
		$select_region = $('#' + id).selectize();
		select_region = $select_region[0].selectize;
		select_region.disable();
	}

	function seletizeSetdata(id, data, option = null) {
		id = id.replace('#', '');
		$("#" + id)[0].selectize.destroy();
		$("#" + id).html("");
		$("#" + id).append(data);
		if (option == null) {
			$("#" + id).selectize({
				sortField: 'text'
			});
		} else {
			$("#" + id).selectize(option);
		}
	}

	function seletizeCleardata(id, option = null) {
		id = id.replace('#', '');
		$("#" + id)[0].selectize.destroy();
		$("#" + id).html("<option value= ''> -- Select -- </option>");
		if (option == null) {
			$("#" + id).selectize({
				sortField: 'text'
			});
		} else {
			$("#" + id).selectize(option);
		}
	}

	function seletizeSetVal(id, selected_val) {
		id = id.replace('#', '');
		$("#" + id)[0].selectize.setValue(selected_val, true); //no change event will trigger.
	}

	function seletizeSetValFromObj(model, key, defaultValue = 1){		
		model.hasOwnProperty(key)?  seletizeSetVal(key, model[key]) : seletizeSetVal(key,defaultValue); 
	}

	function seletizeClearAllOptions(id)
	{
		id = id.replace('#', '');
		var $select = $("#" + id).selectize({});
		var control = $select[0].selectize;
		control.clear();
		control.clearCache('option');
		control.clearOptions();
		control.refreshOptions(true);
	}

	function seletizeResetOption(id)
	{
		id = id.replace('#', '');
		var $select = $("#" + id).selectize({});
		var control = $select[0].selectize;
		control.clear();
	}

</script>

{{-- Float Value Formatter: UpdatedOn: 2021-11-03 --}}
<script type="text/javascript">
	function getFloatValue(id) {
		return parseFloat($('#' + id).val().replace(/\,/g, ''));
	}

	function convertToPureFloatValue(value, returnZeorOnEmpty = false) {
		if (typeof value === 'string') {
			if (value.trim() != "") {
				return parseFloat(value.toString().replace(/\,/g, ''));
			} else {
				if (!returnZeorOnEmpty)
					return "";
				else
					return 0.0;
			}
		}
		if ($.isNumeric(value))
			return parseFloat(value.toString().replace(/\,/g, ''));
		else if (!returnZeorOnEmpty)
			return "";
		else
			return 0.0;
	}

	function convertToPureDecimalValue(value, returnZeorOnEmpty = false) {
		if (typeof value === 'string') {
			if (value.trim() != "") {
				return parseFloat(value.toString().replace(/\,/g, '')).toFixed(8);
			} else {
				if (!returnZeorOnEmpty)
					return "";
				else
					return 0.0;
			}
		}
		if ($.isNumeric(value))
			return parseFloat(value.toString().replace(/\,/g, '')).toFixed(8);

		else if (!returnZeorOnEmpty)
			return "";
		else
			return 0.0;
	}

	function formatFileSize (bytes) {
		if (typeof bytes !== 'number') {
			return '';
		}
		if (bytes >= 1000000000) {
			return (bytes / 1000000000).toFixed(2) + ' GB';
		}
		if (bytes >= 1000000) {
			return (bytes / 1000000).toFixed(2) + ' MB';
		}
		return (bytes / 1000).toFixed(2) + ' KB';
	}
</script>

<script type="text/javascript">
$(document).ready(function() {
    function adjustMobileBackButton() {
        if ($(window).width() < 992) {
            $('.page-header-left').each(function() {
                var $container = $(this);
                if ($container.find('.mobile-title-back-btn').length === 0) {
                    var backBtnHtml = '<a href="javascript:void(0)" onclick="window.history.back()" class="mobile-title-back-btn btn btn-primary btn-sm" style="margin-left: auto; display: inline-flex; align-items: center; gap: 5px; margin-top: 15px; padding: 6px 12px; font-weight: 600; border-radius: 4px; font-size: 11px; text-transform: uppercase; line-height: 1;">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left" style="vertical-align: middle;"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>' +
                        'Back</a>';
                    $container.css({
                        'width': '100%',
                        'display': 'flex',
                        'align-items': 'center'
                    }).append(backBtnHtml);
                } else {
                    $container.find('.mobile-title-back-btn').show();
                }
            });
        } else {
            $('.mobile-title-back-btn').hide();
        }
    }

    adjustMobileBackButton();
    $(window).on('resize', adjustMobileBackButton);
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(document).on('input', 'input[name="r_days"], input[name="r_days[]"], input[name^="r_days["]', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    function syncVariantImages() {
        // 1. Tag each wrapper with its original card ID (first run only)
        $('.variant-card').each(function() {
            let cardId = $(this).attr('id');
            if (!cardId) return;
            // Only tag non-cloned wrappers
            $(this).find('.variant-fields-wrapper:not([data-inline-cloned])').each(function() {
                if (!$(this).data('orig-card')) $(this).data('orig-card', cardId);
            });
            $(this).find('.variant-images-wrapper').each(function() {
                if (!$(this).data('orig-card')) $(this).data('orig-card', cardId);
            });
        });

        // 2. Restore non-cloned fields/images to their original card
        $('.variant-fields-wrapper:not([data-inline-cloned])').each(function() {
            let origCard = $(this).data('orig-card');
            if (origCard) {
                let $cardBody = $('#' + origCard + ' > .card-body');
                if ($cardBody.length && !$(this).parent().is($cardBody)) {
                    $cardBody.prepend($(this));
                }
            }
        });
        $('.variant-images-wrapper').each(function() {
            let origCard = $(this).data('orig-card');
            if (origCard) {
                let $cardBody = $('#' + origCard + ' > .card-body');
                if ($cardBody.length && !$(this).parent().is($cardBody)) {
                    $cardBody.append($(this));
                }
            }
        });

        // 3. Show everything, remove temp dividers
        $('.variant-card').show();
        $('.variant-card .variant-card-header').show();
        $('.variant-images-wrapper').show();
        $('.variant-size-divider').remove();

        // 4. Group by color
        let colorGroups = {};
        let cardOrder = [];
        $('.variant-card').each(function(idx) {
            let $card = $(this);
            let cardId = $card.attr('id');
            // Use first non-cloned color select for grouping
            let color = $card.find('.variant-fields-wrapper:not([data-inline-cloned]) select[name="attrcolor[]"]').first().val();
            if (!color || color === 'Color') {
                color = '__NOCOLOR_' + idx;
            }
            if (!colorGroups[color]) {
                colorGroups[color] = [];
                cardOrder.push(color);
            }
            colorGroups[color].push($card);
        });

        // 5. For each color group, merge children into parent
        cardOrder.forEach(function(color) {
            let cards = colorGroups[color];
            let $parent = cards[0];
            let $parentBody = $parent.find('> .card-body');
            let $parentImages = $parent.find('.variant-images-wrapper').first();

            if (cards.length > 1) {
                for (let i = 1; i < cards.length; i++) {
                    let $child = cards[i];
                    let $childFields = $child.find('.variant-fields-wrapper:not([data-inline-cloned])');
                    let $childImages = $child.find('.variant-images-wrapper');

                    // Move child fields into parent card body, before parent images
                    $childFields.insertBefore($parentImages);

                    // Hide child's images and card
                    $childImages.hide();
                    $child.hide();

                    // Sync image hidden values
                    syncHiddenImages($parent, $child);
                }
            }
        });
    }
    window.syncVariantImages = syncVariantImages;

    function syncHiddenImages($parentCard, $childCard) {
        let parentCardId = $parentCard.attr('id');
        let childCardId = $childCard.attr('id');
        if (!parentCardId || !childCardId) return;

        ['old_mainimg[]', 'old_subimg1[]', 'old_subimg2[]', 'old_subimg3[]'].forEach(function(name) {
            let $pImages = $('.variant-images-wrapper').filter(function() {
                return $(this).data('orig-card') === parentCardId;
            });
            let $cImages = $('.variant-images-wrapper').filter(function() {
                return $(this).data('orig-card') === childCardId;
            });
            let val = $pImages.find('input[name="' + name + '"]').val();
            $cImages.find('input[name="' + name + '"]').val(val);
        });

        [
            { prefix: 'p_mainimg' },
            { prefix: 'subimg1' },
            { prefix: 'subimg2' },
            { prefix: 'subimg3' }
        ].forEach(function(item) {
            let $pImages = $('.variant-images-wrapper').filter(function() {
                return $(this).data('orig-card') === parentCardId;
            });
            let $cImages = $('.variant-images-wrapper').filter(function() {
                return $(this).data('orig-card') === childCardId;
            });
            let srcInput = $pImages.find('input[type="file"][id^="' + item.prefix + '"]')[0];
            let targetInput = $cImages.find('input[type="file"][id^="' + item.prefix + '"]')[0];
            if (srcInput && targetInput && srcInput.files && srcInput.files.length > 0) {
                try {
                    let dt = new DataTransfer();
                    for (let f = 0; f < srcInput.files.length; f++) {
                        dt.items.add(srcInput.files[f]);
                    }
                    targetInput.files = dt.files;
                } catch(e) {}
            }
        });
    }

    // Run on page load
    if ($('.variant-card').length) {
        syncVariantImages();
    }

    // Re-run when color changes
    $(document).on('change', 'select[name="attrcolor[]"]', function() {
        let newColor = $(this).val();
        let $parentCard = $(this).closest('.variant-card');
        if ($parentCard.length) {
            // Update color on ALL rows in this card (including cloned ones)
            $parentCard.find('select[name="attrcolor[]"]').val(newColor);
        }
        syncVariantImages();
    });

    // Re-run when images change
    $(document).on('change', 'input[name="mainimg[]"], input[name="subimg1[]"], input[name="subimg2[]"], input[name="subimg3[]"]', function() {
        setTimeout(syncVariantImages, 150);
    });

    // Re-run when new variant added via "ADD MORE VARIANT" button
    $(document).on('click', '#add_m', function() {
        setTimeout(syncVariantImages, 300);
    });

    // ========================================================
    // INLINE "+ Add Size" — simply clones the input row
    // ========================================================
    $(document).on('click', '.add-size-row-inline-btn', function(e) {
        e.preventDefault();

        let $currentRow = $(this).closest('.variant-fields-wrapper');
        let $parentCard = $(this).closest('.variant-card');
        let $cardBody = $parentCard.find('> .card-body');
        let $parentImages = $cardBody.find('.variant-images-wrapper').first();

        // 1. Clone the entire row (inputs + dropdowns)
        let $newRow = $currentRow.clone(false);

        // 2. Reset Size to placeholder
        let $sizeSelect = $newRow.find('select[name="attrsize[]"]');
        if ($sizeSelect.find('option[value=""]').length === 0 && $sizeSelect.find('option:contains("Size")').length === 0) {
            $sizeSelect.prepend('<option value="" disabled selected hidden>Size</option>');
        }
        $sizeSelect.val('');

        // 3. Clear input values (start with empty text boxes except price fields)
        $newRow.find('input[name="quantity[]"]').val('');
        $newRow.find('input[name="low_stock_limit[]"]').val('');
        $newRow.find('input[name="product_details_id[]"]').val('');

        // 4. Give unique IDs to avoid conflicts
        let uid = Date.now();
        $newRow.find('[id]').each(function() {
            $(this).attr('id', $(this).attr('id') + '_c' + uid);
        });

        // 5. Mark as inline-cloned
        $newRow.attr('data-inline-cloned', 'true');
        $newRow.attr('data-clone-uid', uid);

        // 6. Insert the cloned row before the images section
        $newRow.insertBefore($parentImages);

        // 7. Create hidden image inputs for form array alignment
        //    (appended AFTER images wrapper so PHP array order matches)
        let $hiddenImgs = $('<div class="cloned-row-images" data-clone-uid="' + uid + '" style="display:none !important"></div>');
        $hiddenImgs.html(
            '<input type="file" name="mainimg[]">' +
            '<input type="hidden" name="old_mainimg[]" value="">' +
            '<input type="file" name="subimg1[]">' +
            '<input type="hidden" name="old_subimg1[]" value="">' +
            '<input type="file" name="subimg2[]">' +
            '<input type="hidden" name="old_subimg2[]" value="">' +
            '<input type="file" name="subimg3[]">' +
            '<input type="hidden" name="old_subimg3[]" value="">'
        );
        $cardBody.append($hiddenImgs);
    });

    // ========================================================
    // INLINE "Remove Size" — removes cloned row
    // ========================================================
    $(document).on('click', '.remove-size-row-inline-btn', function(e) {
        e.preventDefault();
        let $wrapper = $(this).closest('.variant-fields-wrapper');

        // If inline-cloned, remove the row + its hidden image inputs
        let cloneUid = $wrapper.attr('data-clone-uid');
        if (cloneUid) {
            $wrapper.closest('.variant-card').find('.cloned-row-images[data-clone-uid="' + cloneUid + '"]').remove();
            $wrapper.remove();
            return;
        }

        // Otherwise, this is a merged row from syncVariantImages
        let targetCardId = $wrapper.data('orig-card');
        if (targetCardId) {
            let $targetCard = $('#' + targetCardId);
            let detailId = $targetCard.find('input[name="product_details_id[]"]').val();
            if (detailId) {
                let $removeBtn = $targetCard.find('.remove_field');
                if ($removeBtn.length) {
                    $removeBtn.trigger('click');
                } else {
                    $targetCard.remove();
                }
            } else {
                $targetCard.remove();
            }
        }
        $wrapper.remove();
        setTimeout(syncVariantImages, 300);
    });

    // Re-run when variant removed
    $(document).on('click', '.remove_field', function() {
        setTimeout(syncVariantImages, 300);
    });
});
</script>

<!-- sidebar handled by assets/js/sidebar-menu.js -->


