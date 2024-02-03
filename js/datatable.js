$(document).ready(function () {
	document.title = 'Summary';
	$('#example').DataTable({
		"dom": "<'col-sm-12 col-md-1 btn btn-primary btn-sm my-2'B><'col-sm-12 col-md-10'f><'col-sm-12 col-md-1 dataright'l>" + "<'col-sm-12 col-md-12 px-0'tr>" + "<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 pull-right'p>",
		"paging": true,
		"pagingType": "simple",
		"responsive": true,
		"autoWidth": true,
		"buttons": [
			{
				extend: 'excelHtml5',
				text: 'Excel',
				customize: function (xlsx) {
					var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
					source.setAttribute('name', 'New Name');
				}
			}
		]

	});
	$('#invoice_bulk').DataTable({
		"paging": true,
		"pagingType": "simple",
		"responsive": true,
		"autoWidth": true,
		ajax: {
			url: 'ajaxphp/ajaxinvoice.php',
			type: 'post',
			data: { 'datatable': 'datatable' },
			dataSrc: ''
		},
		columns: [
			{ "data": "inc_id" },
			{ "data": "date" },
			{ "data": "inc_no" },
			{ "data": "billed_to" },
			{ "data": "comp_name" },
			{ "data": "taxa_amt" },
			{ "data": "tot_amt" },
			{ "data": "balance" },
			{ "data": "status" },
			{ "data": "action" },
		]
		// "buttons": [
		// 		{
		// extend: 'excelHtml5',
		// text: 'Excel',
		// customize: function( xlsx ) {
		//   var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
		//   source.setAttribute('name','New Name');
		// 			}
		// 		}
		// ] 

	});
	$('#invoice').DataTable({
		"paging": true,
		"pagingType": "simple",
		"responsive": true,
		"autoWidth": true,
		ajax: {
			url: 'ajaxphp/ajaxinvoice.php',
			type: 'post',
			data: { 'invoice_table': 'invoice_table' },
			dataSrc: ''
		},
		columns: [
			{ "data": "sl_no" },
			{ "data": "company_details" },
			{ "data": "cust_details" },
			{ "data": "action" },
		]
		// "buttons": [
		// 		{
		// extend: 'excelHtml5',
		// text: 'Excel',
		// customize: function( xlsx ) {
		//   var source = xlsx.xl['workbook.xml'].getElementsByTagName('sheet')[0];
		//   source.setAttribute('name','New Name');
		// 			}
		// 		}
		// ] 

	});
});