$(document).ready(function () {
	document.title = 'Summary';
	$('#example').DataTable({
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
});