function createChart1() {
    $("#chart1").kendoChart({
        title: {
            text: "Average order price by Categories by all period"
        },
        legend: {
            visible: false
        },
        chartArea: {
            background: ""
        },
        seriesDefaults: {
            labels: {
                visible: true,
                background: "transparent",
                template: "#= category #: \n #= value#$"
            }
        },
        series: [{
            type: "pie",
            startAngle: 150,
            data: ordersByCategory
        }],
        tooltip: {
            visible: true,
            format: "{0}$"
        }
    });
}

var series2 = [{
    name: "Orders Total Count",
    data: ordersByDate['count'],

    // Line chart marker type
    markers: {type: "square"}
}, {
    name: "Orders Total Price /thousands/",
    data: ordersByDate['price'],
}];

function createChart2() {
    $("#chart2").kendoChart({
        title: {
            text: "Orders Count and Price /thousands/ by month"
        },
        legend: {
            position: "bottom"
        },
        seriesDefaults: {
            type: "column",
            stack: true
        },
        series: series2,
        valueAxis: {
            line: {
                visible: false
            }
        },
        categoryAxis: {
            categories: ordersByDate['date'],
            majorGridLines: {
                visible: false
            }
        },
        tooltip: {
            visible: true,
            format: "{0}"
        }
    });
}

function refresh() {
    var chart2 = $("#chart2").data("kendoChart"),
        type = $("input[name=seriesType]:checked").val(),
        stack = $("#stack").prop("checked");

    for (var i = 0, length = series2.length; i < length; i++) {
        series2[i].stack = stack;
        series2[i].type = type;
    }
    ;

    chart2.setOptions({
        series: series2
    });
}


$(document).ready(createChart1);
$(document).bind("kendo:skinChange", createChart1);

$(document).ready(function () {
    createChart2();
    $(document).bind("kendo:skinChange", createChart2);
    $(".options").bind("change", refresh);
});
