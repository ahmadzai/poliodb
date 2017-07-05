
/*
This function creates the Trend chart of all region remaining children
 */
$(function () {
    regionTrendColumnChart = new Highcharts.Chart({
        chart: {
            renderTo: 'container_region_trend_remaining_children',
            type: 'column',
            events: {
                load: requestDataRegionTrend()
                //load: requestData('column', 'api_get_admin_data', this)
            }
        },
        title: {
            text: 'Remaining Children Trend'
        },
        xAxis: {
            categories: []
        },
        exporting: {
            sourceWidth: 800,
            sourceHeight:450,
            buttons: {
                contextButton: {
                    menuItems: [ {
                        text: 'Print chart',
                        onclick: function () {
                            this.print({
                            });
                        }

                    }, {
                        text: 'Export as Image',
                        onclick: function () {
                            var title = this.title.textStr;
                            this.exportChart({
                                type: 'image/jpeg',
                                filename: title,

                            });
                        }
                    }, {
                        text: 'Export as PDF',
                        onclick: function () {
                            var title = this.title.textStr;
                            this.exportChart({
                                type: 'application/pdf',
                                filename: title,

                            });
                        },

                    }, {
                        text: 'Stack Percent Chart',
                        onclick: function () {
                            changeChartRegionTrend('percent', 'container_region_trend_remaining_children');
                        },
                        separator: false
                    }, {
                        text: 'Back to normal',
                        onclick: function () {
                            changeChartRegionTrend('normal', 'container_region_trend_remaining_children');
                        },
                        separator: false
                    }]
                }
            },
        },
        colors: ['#FF0000', '#C99900', '#FFFF00'],
        yAxis: {
            min: 0,
            title: {
                text: 'Total Remaining Children'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: []
    });

    lineChart = new Highcharts.Chart({
        chart: {
            renderTo: 'container1',
            type: 'line',
            events: {
                //load: requestData2()
            }
        },
        title: {
            text: 'Remaining children by campaign',
            x: -20 //center
        },
        // subtitle: {
        //     text: 'Source: WorldClimate.com',
        //     x: -20
        // },
        colors: ['#FFFF00', '#C99900', '#FF0000'],
        xAxis: {
            categories: ['May', 'Jul', 'Aug', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Remaining Children'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'Children'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Absent',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5]
        }, {
            name: 'Sleep',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0]
        }, {
            name: 'Refusal',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0]
        }]
    });

    chart2 = new Highcharts.Chart({
        chart: {
            renderTo: 'container2',
            type: 'column',
            events: {
                load: requestData2()
            }
        },
        title: {
            text: 'Vaccinated Children Trend'
        },
        xAxis: {
            categories: []
        },
        colors: ['#39FF91', '#3DE2FF', '#FFFF00'],
        yAxis: {
            min: 0,
            title: {
                text: 'Total Remaining Children'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 5,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: []
    });

    Highcharts.chart('container-last', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Vaccinated Children by Region'
        },
        subtitle: {
            text: 'Source: Admin Data'
        },
        xAxis: {
            categories: ['May-2016', 'July-2016', 'August-2016', 'October-2016', 'November-2016', 'December-2016', 'January-2017'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Billions'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000;
                }
            }
        },
        tooltip: {
            split: true,
            valueSuffix: ' millions'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: 'South',
            data: [502, 635, 809, 947, 1402, 3634, 5268]
        }, {
            name: 'East',
            data: [106, 107, 111, 133, 221, 767, 1766]
        }, {
            name: 'West',
            data: [163, 203, 276, 408, 547, 729, 628]
        }, {
            name: 'Central',
            data: [18, 31, 54, 156, 339, 818, 1201]
        }, {
            name: 'Other',
            data: [2, 2, 2, 6, 13, 30, 46]
        }]
    });

    Highcharts.chart('container-vaccine', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Vaccine Usage Trends'
        },
        xAxis: {
            categories: ['May', 'July', 'August', 'October', 'November', 'December']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Vaccine Usage'
            }
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            column: {
                stacking: 'percent'
            }
        },
        series: [{
            name: 'Used Vaccine',
            data: [5, 3, 4, 7, 2, 7]
        }, {
            name: 'Remaining Vaccine',
            data: [2, 2, 3, 2, 1, 2]
        }, {
            name: 'Wastage',
            data: [2, 1, 1, 2, 3, 1]
        }]
    });


    regionTrendLastCampaign = new Highcharts.Chart({
        chart: {
            renderTo: 'cont_reg_trend_last_camp',
            type: 'column',
            events: {
                load: requestDataRegionTrendLastCampiagn()
            }
        },
        title: {
            text: 'Last Campaign Remaining Children'
        },
        xAxis: {
            categories: ['South', 'East', 'West', 'Central', 'North', 'NorthEast']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Remaining Children'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        labels: {
            items: [{
                html: 'Total Remaining',
                style: {
                    left: '250px',
                    top: '18px',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                }
            }]
        },
        colors: ['#FF0000', '#C99900', '#FFFF00'],
        series: []

    });

    options = {
        chart: {
            renderTo:'',
            type: ''
        },
        series:[{}]
    };

    requestTestData();
    requestTestData2();

});

/*
this function is to request data for the region missed children trend chart
 */
function requestDataRegionTrendLastCampiagn(type) {
    $.ajax({

        url: Routing.generate('api_get_admin_data_last'),
        beforeSend: function () {
            //chart.showLoading();
        },
        success: function(data) {
            regionTrendLastCampaign.hideLoading();
            var obj = JSON.parse(data);
            regionTrendLastCampaign.xAxis[0].setCategories(obj.categories);
            regionTrendLastCampaign.setTitle({text:obj.title});
            //regionTrendColumnChart.exporting.setFileName(obj.title);
            //console.log("We requested by line");
            //console.log(obj.series.length);
            var seriesOptions = obj.series;
            var second_data = [];
            var colors = ['#FF0000', '#C99900', '#FFFF00'];
            for(i=0; i<=seriesOptions.length; i++){
                if(i < seriesOptions.length) {
                    var dataName = seriesOptions[i].name;
                    var dataData = seriesOptions[i].data.reduce(function(prev, cur) {
                        return prev + cur;
                    });
                    var tmpObj = {name: dataName, y:dataData, color: colors[i]};
                    //tmpObj[dataName] = dataData;
                    second_data.push(tmpObj);

                    regionTrendLastCampaign.addSeries({
                        name: seriesOptions[i].name,
                        data: seriesOptions[i].data,
                    }, true);
                } else if (i == seriesOptions.length) {
                    regionTrendLastCampaign.addSeries({
                        type: 'pie',
                        name: 'Total',
                        data: second_data,
                        center: [90, 10],
                        size: 100,
                        showInLegend: false,
                        dataLabels: {
                            enabled: false
                        }
                    }, true);
                }

            }
        },
        cache: false
    });
}

function changeChartRegionTrend(type, element) {
    var chart = $('#'+element).highcharts(),
        s = chart.series,
        sLen = s.length;
    //chart.settings.tooltip

    for(var i =0; i < sLen; i++){
        s[i].update({
            stacking: type
        }, false);
    }
    chart.redraw();
}

function requestDataRegionTrend(type) {
    $.ajax({

        url: Routing.generate('api_get_admin_data'),
        beforeSend: function () {
            //chart.showLoading();
        },
        success: function(data) {
            regionTrendColumnChart.hideLoading();
            var obj = JSON.parse(data);
            regionTrendColumnChart.xAxis[0].setCategories(obj.categories);
            regionTrendColumnChart.setTitle({text:obj.title});
            //regionTrendColumnChart.exporting.setFileName(obj.title);
            //console.log("We requested by line");
            //console.log(obj.series[1].data);
            var seriesOptions = obj.series;
            for(i=0; i<seriesOptions.length; i++){
                regionTrendColumnChart.addSeries({
                    name: seriesOptions[i].name,
                    data: seriesOptions[i].data,
                }, true);

            }
        },
        cache: false
    });
}

function requestTestData(type) {
    $.ajax({

        url: Routing.generate('api_get_admin_data'),
        beforeSend: function () {
            $('#container-test').html('Loading...');
        },
        success: function(data) {
            $('#container-test').html('');
            options.chart.renderTo = 'container-test';
            options.chart.type = 'column';
            var obj = JSON.parse(data);
            options['title'] = {text:obj.title};
            options['xAxis'] = {categories:obj.categories};
            options.series = obj.series;
            var chart = new Highcharts.Chart(options);
        },
        cache: false
    });
}

function requestTestData2(type) {
    $.ajax({

        url: Routing.generate('api_get_admin_data_last'),
        beforeSend: function () {
            $('#container-test2').html('Loading...');
        },
        success: function(data) {
            $('#container-test2').html('');
            options.chart.renderTo = 'container-test2';
            options.chart.type = 'column';
            var obj = JSON.parse(data);
            options['title'] = {text:obj.title};
            options['xAxis'] = {categories:obj.categories};
            options['colors'] = ['#FF0000', '#C99900', '#FFFF00'];
            options.series = obj.series;
            var chart = new Highcharts.Chart(options);
        },
        cache: false
    });
}

function requestData2(type) {

    $.ajax({

        url: Routing.generate('api_get_admin_data'),
        beforeSend: function () {
            //chart.showLoading();
        },
        success: function(data) {
            chart2.hideLoading();
            // add the point
            if(type === "column") {
                var obj = JSON.parse(data);
                myColumn.xAxis[0].setCategories(obj.categories);
                //console.log("We requested by column");

                //console.log(obj.series.length)
                var seriesOptions = obj.series;
                for(i=0; i<seriesOptions.length; i++){
                    myColumn.addSeries({
                        name: seriesOptions[i].name,
                        data: seriesOptions[i].data
                    }, true);

                };
            } else if(typeof(type) == "object"){
                //alert('Hi we are in the right place')
                var obj = JSON.parse(data);
                chart2.xAxis[0].setCategories(obj.categories);
                chart2.setTitle({text:obj.title});
                //console.log("We requested by line");
                //console.log(obj.series.length);
                var seriesOptions = obj.series;
                for(i=0; i<seriesOptions.length; i++){
                    chart2.addSeries({
                        name: seriesOptions[i].name,
                        data: seriesOptions[i].data
                    }, true);

                };
            } else {
                var obj = JSON.parse(data);
                chart2.xAxis[0].setCategories(obj.categories);
                chart2.setTitle({text:obj.title});
                //console.log("We requested by line");
                //console.log(obj.series.length);
                var seriesOptions = obj.series;
                for(i=0; i<seriesOptions.length; i++){
                    chart2.addSeries({
                        name: seriesOptions[i].name,
                        data: seriesOptions[i].data
                    }, true);

                };
            }
        },
        cache: false
    });
}

function requestData(type, apiUrl, chart) {
    $.ajax({
        url: Routing.generate(apiUrl),
        success: function(data) {
            switch (type) {
                case "column":
                    columnStack(data, chart);
                    break;
                case "line":
                    break;
                case "pie":
                    break;
                case "area":
                    break;
                case "columpie":
                    break;
            }
        },
        cache: false
  });
}

function columnStack(data, chart) {

    var obj = JSON.parse(data);
    chart.xAxis[0].setCategories(obj.categories);
    chart.setTitle({text:obj.title});
    //regionTrendColumnChart.exporting.setFileName(obj.title);
    //console.log("We requested by line");
    //console.log(obj.series[1].data);
    var seriesOptions = obj.series;
    for(i=0; i<seriesOptions.length; i++){
        chart.addSeries({
            name: seriesOptions[i].name,
            data: seriesOptions[i].data,
        }, true);

    }

}

