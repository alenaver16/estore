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
            text: "Orders Count and Price /thousands/ by dates"
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

function createChart3() {
    $("#chart3").kendoChart({
        title: {
            text: "Orders count by Cities"
        },
        legend: {
            visible: false
        },
        chartArea: {
            background: ""
        },
        seriesDefaults: {
            type: "donut",
            startAngle: 150
        },
        series: [{
            name: "2018",
            data: ordersByCities
        }, {
            name: "2019",
            data: ordersByCities,
            labels: {
                visible: true,
                background: "transparent",
                position: "outsideEnd",
                template: "#= category #: \n #= value#"
            }
        }],
        tooltip: {
            visible: true,
            template: "#= category # (#= series.name #): #= value #"
        }
    });
}

function createChart4() {
    $("#chart4").kendoChart({
        pdf: {
            fileName: "Kendo UI Stock Chart Export.pdf",
            proxyURL: "https://demos.telerik.com/kendo-ui/service/export"
        },
        dataSource: {
            transport: {
                read: {
                    url: "../content/dataviz/js/boeing-stock.json",
                    dataType: "json"
                }
            },
            schema: {
                model: {
                    fields: {
                        Date: { type: "date" }
                    }
                }
            }
        },
        title: {
            text: "Orders Cont by Month"
        },
        legend: {
            position: "bottom"
        },
        chartArea: {
            background: ""
        },
        seriesDefaults: {
            type: "line",
            style: "smooth"
        },
        series: [{
            name: "Orders count",
            data: ordersByMonth['count']
        }],
        valueAxis: {
            labels: {
                format: "{0}"
            },
            line: {
                visible: false
            },
            axisCrossingValue: -10
        },
        categoryAxis: {
            categories: ordersByMonth['month'],
            majorGridLines: {
                visible: false
            },
            labels: {
                rotation: "auto"
            }
        },
        tooltip: {
            visible: true,
            format: "{0}%",
            template: "#= series.name #: #= value #"
        }
    });
}
// $(document).ready(function() {
//     $(".export-pdf").click(function() {
//         // Convert the DOM element to a drawing using kendo.drawing.drawDOM
//         kendo.drawing.drawDOM($(".content-wrapper"))
//             .then(function(group) {
//                 // Render the result as a PDF file
//                 return kendo.drawing.exportPDF(group, {
//                     paperSize: "auto",
//                     margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" }
//                 });
//             })
//             .done(function(data) {
//                 // Save the PDF file
//                 kendo.saveAs({
//                     dataURI: data,
//                     fileName: "HR-Dashboard.pdf",
//                     proxyURL: "https://demos.telerik.com/kendo-ui/service/export"
//                 });
//             });
//     });
// $(".export-pdf").click(function() {
//     $("#chart4").getKendoChart().saveAsPDF();
// });

$(document).ready(createChart1);
$(document).bind("kendo:skinChange", createChart1);

$(document).ready(function () {
    createChart2();
    $(document).bind("kendo:skinChange", createChart2);
    $(".options").bind("change", refresh);
});

$(document).ready(createChart3);
$(document).bind("kendo:skinChange", createChart3);

$(document).ready(createChart4);
$(document).bind("kendo:skinChange", createChart4);
