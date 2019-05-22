<?php

?>
<div id="example">
    <div class="demo-section k-content wide">
        <div id="chart1"></div>
    </div>
</div>
<div id="example">
    <div class="demo-section k-content wide">
        <div id="chart2"></div>
    </div>
    <div class="box wide">
        <div class="box-col">
            <h4>API Functions</h4>
            <ul class="options">
                <li>
                    <input id="typeColumn" name="seriesType"
                           type="radio" value="column" checked="checked" autocomplete="off" />
                    <label for="typeColumn">Columns</label>
                </li>
                <li>
                    <input id="typeBar" name="seriesType"
                           type="radio" value="bar" autocomplete="off" />
                    <label for="typeBar">Bars</label>
                </li>
                <li>
                    <input id="typeLine" name="seriesType"
                           type="radio" value="line" autocomplete="off" />
                    <label for="typeLine">Lines</label>
                </li>
                <li>
                    <input id="stack" type="checkbox" autocomplete="off" checked="checked" />
                    <label for="stack">Stacked</label>
                </li>
            </ul>
        </div>
    </div>
<script>
    var ordersByCategory = <?= $ordersByCategory ?>;
    var ordersByDate     = <?= $ordersByDate ?>;
</script>