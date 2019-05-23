<?php

?>
<div class="reports">
    <div class="report-chart col-md-6 col-xs-12 well">
        <div class="demo-section k-content wide">
            <div id="chart1"></div>
        </div>
    </div>

    <div class="report-chart col-md-6 col-xs-12 well">
        <div class="demo-section k-content wide">
            <div id="chart3"
                 style="background: center no-repeat url('https://demos.telerik.com/kendo-ui/content/shared/styles/world-map.png');"></div>
        </div>
    </div>

    <div class="report-chart col-md-6 col-xs-12 well">
        <div class="demo-section k-content wide">
            <div id="chart2"></div>
        </div>
        <div class="box wide">
            <div class="box-col">
                <br><h4>Diagrams type</h4>
                <ul class="options">
                    <li>
                        <input id="typeColumn" name="seriesType"
                               type="radio" value="column" checked="checked" autocomplete="off"/>
                        <label for="typeColumn">Columns</label>
                    </li>
                    <li>
                        <input id="typeBar" name="seriesType"
                               type="radio" value="bar" autocomplete="off"/>
                        <label for="typeBar">Bars</label>
                    </li>
                    <li>
                        <input id="typeLine" name="seriesType"
                               type="radio" value="line" autocomplete="off"/>
                        <label for="typeLine">Lines</label>
                    </li>
                    <li>
                        <input id="stack" type="checkbox" autocomplete="off" checked="checked"/>
                        <label for="stack">Stacked</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="report-chart col-md-6 col-xs-12 well">
        <div class="demo-section k-content wide">
            <div id="chart4"></div>
        </div>
    </div>
</div>
<script>
    var ordersByCategory = <?= $ordersByCategory ?>;
    var ordersByDate = <?= $ordersByDate ?>;
    var ordersByCities = <?= $ordersByCities ?>;
    var ordersByMonth = <?= $ordersByMonth ?>
</script>