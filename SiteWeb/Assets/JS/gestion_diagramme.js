  
var MesureChartContext = document.getElementById('diagrammeMesure').getContext('2d');
var MesureChart;

$(document).ready(InitialDraw());

function InitialDraw()
{
  $.ajax({
    url:'ajaxHandler.php?event=GetVariationMesure',
    success: function(output) {
      var data = JSON.parse(output);

      PopMesureChart(data["temperature"], data["humidite"], data["date"]);
    }
  })
}

function UpdateMesureChart(newTemperature, newHumidite, newTime){

  
  window.MesureChart.data.datasets[0].data.shift();
  window.MesureChart.data.datasets[0].data.push(parseInt(newTemperature));
  window.MesureChart.data.datasets[1].data.push(parseInt(newHumidite));
  window.MesureChart.data.labels.push(newTime); 
 
  //window.MesureChart.date.datasets[1].data.shift();
  
  window.MesureChart.update();
}

function GetNewMesureChartData(){
  $.ajax({
    url:'ajaxHandler.php?event=GetVariationMesure',
    success: function(output) {
      var data = JSON.parse(output);

    }
  })
}

function PopMesureChart(arrayDataTemperature, arrayDataHumidite, labelTime){

  window.MesureChart = new Chart(MesureChartContext, {
      type:'line',
      data:{
          labels: labelTime,          // nom des valeurs en axis X
          datasets:[{
            label:'Temperature',
            borderColor: 'rgb(17, 173, 59)',
            data: arrayDataTemperature,
          },
          {
            label:'humidite',
            borderColor: 'rgb(22, 43, 181)',
            data: arrayDataHumidite,
          }]
          
      },
      options:{
        responsive: true,
        scales: {
          xAxes: [ {
            //type: 'time',
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Temps'
            }
          }],
          yAxes: [ {
            //type: 'number',
            display: true,
            scaleLabel: {
              display: true,
              labelString: '(°C) / (%) '
            }
          }]
        }
      }
  });
}