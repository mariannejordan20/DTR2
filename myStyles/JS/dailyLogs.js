$(document).ready(function () {
    // data table attributes
    $('#dailyLogsTable').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export as Excel',
                title: 'Daily_Logs_Lists',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Export as PDF',
                title: 'Daily_Logs_Lists',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ]
    });
});