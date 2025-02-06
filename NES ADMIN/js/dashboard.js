

anychart.onDocumentReady(function () {
	
anychart.theme('darkEarth');
      
      anychart.data.loadJsonFile(
        'https://cdn.anychart.com/samples/maps-general-features/world-choropleth-map/data.json',
        function (data) {
          var map = anychart.map();

          map
            .credits()
            .enabled(true)
            .url(
              'https://en.wikipedia.org/wiki/List_of_sovereign_states_and_dependent_territories_by_population_density'
            )
            .logoSrc('https://en.wikipedia.org/static/favicon/wikipedia.ico')
            .text(
              'Data source: https://en.wikipedia.org/wiki/List_of_sovereign_states_and_dependent_territories_by_population_density'
            );

          map
            .title()
            .enabled(true)
            .useHtml(true)
            .padding([10, 0, 10, 0])
            .text(
              '' +
              ''
            );

          map.geoData('anychart.maps.world');
          map.interactivity().selectionMode('none');
          map.padding(0);

          var dataSet = anychart.data.set(data);
          var densityData = dataSet.mapAs({ value: 'density' });
          var series = map.choropleth(densityData);

          series.labels(false);

          series
            .hovered()
            .fill('#f48fb1')
            .stroke(anychart.color.darken('#f48fb1'));

          series
            .selected()
            .fill('#c2185b')
            .stroke(anychart.color.darken('#c2185b'));

          series
            .tooltip()
            .useHtml(true)
            .format(function () {
              return (
                '<span style="color: #d9d9d9">Density</span>: ' +
                parseFloat(this.value).toLocaleString() +
                ' pop./km&#178 <br/>' +
                '<span style="color: #d9d9d9">Population</span>: ' +
                parseInt(this.getData('population')).toLocaleString() +
                '<br/>' +
                '<span style="color: #d9d9d9">Area</span>: ' +
                parseInt(this.getData('area')).toLocaleString() +
                ' km&#178'
              );
            });

          var scale = anychart.scales.ordinalColor([
            { less: 10 },
            { from: 10, to: 30 },
            { from: 30, to: 50 },
            { from: 50, to: 100 },
            { from: 100, to: 200 },
            { from: 200, to: 300 },
            { from: 300, to: 500 },
            { from: 500, to: 1000 },
            { greater: 1000 }
          ]);
          scale.colors([
            '#81d4fa',
            '#4fc3f7',
            '#29b6f6',
            '#039be5',
            '#0288d1',
            '#0277bd',
            '#01579b',
            '#014377',
            '#000000'
          ]);

          var colorRange = map.colorRange();
          colorRange.enabled(true).padding([0, 0, 20, 0]);
          colorRange
            .ticks()
            .enabled(true)
            .stroke('3 #ffffff')
            .position('center')
            .length(7);
          colorRange.colorLineSize(5);
          colorRange.marker().size(7);
          colorRange
            .labels()
            .fontSize(11)
            .padding(3, 0, 0, 0)
            .format(function () {
              var range = this.colorRange;
              var name;
              if (isFinite(range.start + range.end)) {
                name = range.start + ' - ' + range.end;
              } else if (isFinite(range.start)) {
                name = 'More than ' + range.start;
              } else {
                name = 'Less than ' + range.end;
              }
              return name;
            });

          series.colorScale(scale);

        
          var zoomController = anychart.ui.zoom();
          zoomController.render(map);

         
          map.container('mapa');
         
          map.draw();
        }
      );
    });




    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
       
        xAxis: {
            categories: ['USA', 'China', 'Brazil', 'EU', 'Argentina', 'India'],
            crosshair: true,
            accessibility: {
                description: 'Countries'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Corn',
                data: [387749, 280000, 129000, 64300, 54000, 34300]
            },
            {
                name: 'Wheat',
                data: [45321, 140000, 10000, 140500, 19500, 113500]
            }
        ]
    });
    
// chart derecha
    

// JavaScript
document.addEventListener('DOMContentLoaded', function() {
  // Set up circular progress
  const circles = document.querySelectorAll('.circle:not(.inner):not(.outer)');
  circles.forEach(circle => {
    const circumference = 100;
    const percentage = 65;
    circle.style.strokeDasharray = `${(percentage * circumference) / 100}, ${circumference}`;
  });

  // Set up double progress ring
  const outerRing = document.querySelector('.circle.outer');
  const innerRing = document.querySelector('.circle.inner');
  
  if (outerRing && innerRing) {
    const circumference = 100;
    const outerPercentage = 60;
    const innerPercentage = 50;
    
    outerRing.style.strokeDasharray = `${(outerPercentage * circumference) / 100}, ${circumference}`;
    innerRing.style.strokeDasharray = `${(innerPercentage * circumference) / 100}, ${circumference}`;
  }
});

  