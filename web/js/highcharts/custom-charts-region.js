
$(function () {
  var url_var = $("#main").data('ajax-url');
  //alert(url_var);
  chart = new Highcharts.Chart({
       chart: {
           renderTo: 'container',
           type: 'column',
           events: {
               load: requestData(url_var)
           }
       },
      title: {
          text: 'Remaining Children Trend'
      },
      xAxis: {
          categories: []
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

/*// Pie Chart
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
        });*/

});

function requestData(type) {

$.ajax({

    url: Routing.generate('api_get_admin_data_region', {slug:type}),
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
        } else if(typeof(type) == "object"){
            //alert('Hi we are in the right place')
          var obj = JSON.parse(data);
          chart.xAxis[0].setCategories(obj.categories);
          chart.setTitle({text:obj.title});
          console.log("We requested by line");
          console.log(obj.series.length);
          var seriesOptions = obj.series;
          for(i=0; i<seriesOptions.length; i++){
            chart.addSeries({
                  name: seriesOptions[i].name,
                  data: seriesOptions[i].data
              }, true);

            };
        } else {
            var obj = JSON.parse(data);
            chart.xAxis[0].setCategories(obj.categories);
            chart.setTitle({text:obj.title});
            console.log("We requested by line");
            console.log(obj.series.length);
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
