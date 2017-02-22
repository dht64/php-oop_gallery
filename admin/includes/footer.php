<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="vendor/raphael/raphael.min.js"></script>
<script src="vendor/morrisjs/morris.min.js"></script>
<script src="data/morris-data.js"></script>

<!-- Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<!-- TinyMCE -->
<script src="vendor/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<!-- Dropzone -->
<script src="dist/js/dropzone.min.js"></script>

<script src="dist/js/custom.js"></script>

<!-- Google Chart Initialize -->
<script type="text/javascript">
	/** Load Google Charts */
	// Load the Visualization API and the corechart package.
	google.charts.load('current', {'packages':['corechart']});

	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);

	// Callback that creates and populates a data table,
	// instantiates the pie chart, passes in the data and
	// draws it.
	function drawChart() {

	// Create the data table.
	var data = new google.visualization.DataTable();
	data.addColumn('string', 'Topping');
	data.addColumn('number', 'Slices');
	data.addRows([
	    ['Views', <?= $session->count; ?>],
	    ['Photos', <?= Photo::count_all(); ?>],
	    ['Users', <?= User::count_all(); ?>],
	    ['Comments', <?= Comment::count_all(); ?>],
	]);

	// Set chart options
	var options = {
	    'title': 'My Daily Activities',
	    pieHole: 0.4,
	    colors:['#337ab7','#5cb85c', '#f0ad4e', '#d9534f'],
	    'height': 400};

	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
	chart.draw(data, options);
	}
</script>
