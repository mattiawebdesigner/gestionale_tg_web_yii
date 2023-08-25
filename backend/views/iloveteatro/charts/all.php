<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Grafico generale di vendita')
?>
<h1><?= Html::encode($this->title) ?></h1>
<h3><?= Yii::t('app', 'Totale posti')?>: <?= $totalPlace ?></h3>

<p>
    <?= Html::a('<i class="fa-solid fa-ticket"></i> ' . Yii::t('app', 'Torna ai biglietti'),
            ['iloveteatro/ticket'],
            ['class' => 'btn btn-warning']) ?>
</p>

<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ["Spettacolo", "Vendita", { role: "style" } ],
              <?php
              $cont = 0;
              foreach($shows as $show){
                  echo "[", $show[0], ", ", $show[1],", ", "'#" . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT), "']";

                  if(++ $cont <> sizeof($shows)){echo ", ";}
              }
              ?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                             { calc: "stringify",
                               sourceColumn: 1,
                               type: "string",
                               role: "annotation" },
                             2]);

            var options = {
              title: '<?= Yii::t('app', 'Resoconto delle vendite totali') ?>',
              width: 600,
              height: 400,
              bar: {groupWidth: "95%"},
              legend: { position: "none" },
            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(view, options);
        }
    </script>
    
    
    <?php if(isset($shows) && sizeof($shows) > 0) : ?>
        <!--Div that will hold the pie chart-->
        <div id="barchart_values" style="width: 900px; height: auto;"></div>
    <?php else : ?>
        <p class="alert alert-info"><?= Yii::t('app', 'Non ci sono biglietti venduti') ?></p>
    <?php endif; ?>