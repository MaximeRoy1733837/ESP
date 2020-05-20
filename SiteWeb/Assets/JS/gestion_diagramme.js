  
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

  if(window.MesureChart.data.datasets[0].data.length >= 12)
  {
    window.MesureChart.data.datasets[0].data.shift();
    window.MesureChart.data.datasets[1].data.shift();
    window.MesureChart.data.labels.shift();
  }
  
  window.MesureChart.data.labels.push(newTime); 
  window.MesureChart.data.datasets[0].data.push(parseInt(newTemperature));
  window.MesureChart.data.datasets[1].data.push(parseInt(newHumidite));
  
  
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
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Temps'
            }
          }],
          yAxes: [ {
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