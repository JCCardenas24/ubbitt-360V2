var input = document.getElementById('f02')
    input.addEventListener('change', function() {
    readXlsxFile(input.files[0], { dateFormat: 'MM/DD/YY' }).then(function(data) {
    // `data` is an array of rows
    // each row being an array of cells.
    document.getElementById('result').innerText = JSON.stringify(data, null, 2)

    // Applying `innerHTML` hangs the browser when there're a lot of rows/columns.
    // For example, for a file having 2000 rows and 20 columns on a modern
    // mid-tier CPU it parses the file (using a "schema") for 3 seconds
    // (blocking) with 100% single CPU core usage.
    // Then applying `innerHTML` hangs the browser.

    document.getElementById('result-table').innerHTML =
    	'<table id="data" class="table table-bordered bg-white" cellspacing="0" width="150%">' +
    	'<tbody>' +
    	data.map(function (row) {
    		return '<tr>' +
    			row.map(function (cell) {
    				return '<td>' +
         				(cell === null ? '' : cell) +
         				'</td>'
    			}).join('') +
    			'</tr>'
    	}).join('') +
    	'</tbody>' +
    	'</table>'
    }, function (error) {
    console.error(error)
    alert("Error while parsing Excel file. See console output for the error stack trace.")
    });
})