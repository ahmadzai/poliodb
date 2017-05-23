
$(function () {

  chart = new Highcharts.Chart({
       chart: {
           renderTo: 'container',
           defaultSeriesType: 'line',
           events: {
               load: requestData("all")
           }
       },
      loading: {
          labelStyle: {
              top: '45%',
              backgroundImage: 'url("ajax-loader.gif")',
              display: 'block',
              width: '136px',
              height: '26px',
              backgroundColor: '#000'
          }
      },
    title: {
        text: 'Monthly Form Submission',
        x: -20 //center
    },
    subtitle: {
        text: 'ONA ODK Data',
        x: -20
    },
    xAxis: {
        categories: []
    },
    yAxis: {
        title: {
            text: 'No. of Submission'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        valueSuffix: ''
    },
    colors: ['#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a', "#4F399a", "#FFF243", "#CCC893"],
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
    },
    series: []
});

// Pie Chart
myPie1 = new Highcharts.Chart({
       chart: {
           renderTo: 'container2',
           type: 'pie',
           events: {
             load: requestDataPie("form")
           },
           options3d: {
               enabled: true,
               alpha: 45,
               beta: 0
           }
       },
       title: {
           text: 'Percentage of Forms submissions'
       },
       tooltip: {
           pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
       },
       plotOptions: {
           pie: {
               allowPointSelect: true,
               cursor: 'pointer',
               depth: 35,
               dataLabels: {
                   enabled: true,
                   format: '{point.name}'
               }
           }
       },
       series: [{
           type: 'pie',
           name: 'Submission',
           data: []
       }]
   });

   // Pie Chart
   myPie2 = new Highcharts.Chart({
          chart: {
              renderTo: 'container1',
              type: 'pie',
              events: {
                load: requestDataPie("region")
              },
              options3d: {
                  enabled: true,
                  alpha: 45,
                  beta: 0
              }
          },
          title: {
              text: 'Percentage of Forms Submisson By Regions'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  depth: 35,
                  dataLabels: {
                      enabled: true,
                      format: '{point.name}'
                  }
              }
          },
          series: [{
              type: 'pie',
              name: 'Submisson',
              data: []
          }]
      });

      // Pie Chart
      myPie3 = new Highcharts.Chart({
             chart: {
                 renderTo: 'container3',
                 type: 'pie',
                 events: {
                   load: requestDataPie("position"),
                   click: function() {
                     alert("Hell It is clicked");
                   }
                 },
                 options3d: {
                     enabled: true,
                     alpha: 45,
                     beta: 0
                 }
             },
             title: {
                 text: 'Percentage of Forms Submisson By Position'
             },
             tooltip: {
                 pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
             },
             plotOptions: {
                 pie: {
                     allowPointSelect: true,
                     cursor: 'pointer',
                     depth: 35,
                     dataLabels: {
                         enabled: true,
                         format: '{point.name}'
                     }
                 }
             },
             series: [{
                 type: 'pie',
                 name: 'Submisson',
                 data: []
             }]
         });

         myColumn = new Highcharts.Chart({
            chart: {
                renderTo: 'container4',
                type: 'column',
                events: {
                  load: requestData("column")
                },
            },
            title: {
                text: 'Total Submisson Record'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['All Submissions'],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'No. Of Submission'
                }
            },
            tooltip: {
                // headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                // pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                //     '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                // footerFormat: '</table>',
                // shared: true,
                // useHTML: true
                valueSuffix: ''
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: []
        });

});

function requestData(type) {

$.ajax({

    url: Routing.generate('api_count_submissions', {slug:type}),
    beforeSend: function () {
        //chart.showLoading();
    },
    success: function(data) {
        chart.hideLoading();
        // add the point
        if(type === "column") {
          var obj = JSON.parse(data);
          myColumn.xAxis[0].setCategories(obj.categories);
          console.log("We requested by column");
          //console.log(obj.series.length)
          var seriesOptions = obj.series;
          for(i=0; i<seriesOptions.length; i++){
            myColumn.addSeries({
                  name: seriesOptions[i].name,
                  data: seriesOptions[i].data
              }, true);

            };
        } else if(type === "all") {
          var obj = JSON.parse(data);
          chart.xAxis[0].setCategories(obj.categories);
          console.log("We requested by line");
          console.log(obj.series.length)
          var seriesOptions = obj.series;
          for(i=0; i<seriesOptions.length; i++){
            chart.addSeries({
                  name: seriesOptions[i].name,
                  data: seriesOptions[i].data
              }, true);

            };
        }
    },
    cache: false
  });
}

function requestDataPie(type) {
$.ajax({
    url: Routing.generate('api_count_submissions_by', {type:type}),
    success: function(data) {

        // add the point
        var obj = JSON.parse(data);
        //chart.xAxis[0].setCategories(obj.categories);
        console.log(obj.series.data);
        console.log(obj.series.length)
        //var seriesOptions = obj.series;
        if(type === "form")
          myPie1.series[0].setData(obj.series.data);
        else if(type === "region")
          myPie2.series[0].setData(obj.series.data);
        else if(type === "position")
          myPie3.series[0].setData(obj.series.data);
        // for(i=0; i<seriesOptions.length; i++){
        //   chart.addSeries({
        //         name: seriesOptions[i].name,
        //         data: seriesOptions[i].data
        //     }, true);
        //
        //   };
    },
    cache: false
  });
}
