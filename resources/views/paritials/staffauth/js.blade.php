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
			iDisplayLength: options.hasOwnProperty("iDisplayLength") ? options.iDisplayLength : 10,
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
			iDisplayLength: options.hasOwnProperty("iDisplayLength") ? options.iDisplayLength : 10,
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




