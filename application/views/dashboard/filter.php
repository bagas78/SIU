<script>
window.onload = function () {

var options = {
  theme: "light2",
  exportEnabled: false,
  animationEnabled: true,
  title:{
    text: "Grafik Pembelian | Produksi | Penjualan Tahun <?=date('Y')?>"
  },
  subtitles: [{
    text: ""
  }],
  axisX: {
    title: ""
  },
  axisY: {
    title: "",
    titleFontColor: "#4F81BC",
    lineColor: "#4F81BC",
    labelFontColor: "#4F81BC",
    tickColor: "#4F81BC"
  },
  axisY2: {
    title: "",
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E"
  },
  axisY3: {
    title: "",
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E"
  },
  toolTip: {
    shared: true
  },
  legend: {
    cursor: "pointer",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "spline",
    name: "Pembelian",
    showInLegend: true,
    xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [

      <?php foreach($pembelian_data as $p): ?>

        { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

      <?php endforeach ?>
    
    ]
  },
  {
    type: "spline",
    name: "Produksi",
    axisYType: "secondary",
    showInLegend: true,
    xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [
      
      <?php foreach($produksi_data as $p): ?>

        { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

      <?php endforeach ?>

    ]
  },
  {
    type: "spline",
    name: "Penjualan",
    axisYType: "secondary",
    showInLegend: true,
    xValueFormatString: "<?=(@$filter == 1)?'DD MMMM YYYY':'MMMM YYYY' ?>",
    yValueFormatString: "Rp #,##0.#",
    dataPoints: [
      
      <?php foreach($penjualan_data as $p): ?>

        { x: new Date(<?=$p['tahun'].','.$p['bulan'].','.$p['tanggal']?>),  y: <?=$p['total']?> },

      <?php endforeach ?>

    ]
  }]
};

$("#chartContainer").CanvasJSChart(options);

function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}

}

</script>