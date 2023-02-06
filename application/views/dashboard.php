<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="padding-top: 20px;">
      <h1>
        Hai <b><?php echo $name; ?></b> Selamat Datang, Apa kabar hari ini? :)
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>    
    <section class="content">

    </section>
</div>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	axisY: {
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2: {
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Debit",
		legendText: "Debit",
		showInLegend: true, 
		dataPoints:
        <?= json_encode($arr, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "column",	
		name: "Kredit",
		legendText: "Kredit",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints:
    <?= json_encode($arr2, JSON_NUMERIC_CHECK); ?>
	}    
    ]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script> 