  
var DiagrammeMesure = document.getElementById('diagrammeMesure').getContext('2d');

$(document).ready(InitialDraw());

function InitialDraw()
{
  $.ajax({
    url:'ajaxHandler.php?event=GetVariationMesure',
    success: function(output) {
      var data = JSON.parse(output);

      PopDiagramme(data["temperature"], data["humidite"], data["date"])
    }
  })
}

function PopDiagramme(arrayDataTemperature,arrayDataHumidite,labelTime){

  var PopDiagrammeTemperature = new Chart(DiagrammeMesure, {
      type:'line',
      data:{
          labels: labelTime,          // nom des valeurs en axis X
          datasets:[{
            label:'Temperature',
            borderColor: 'rgb(17, 173, 59)',
            data: arrayDataTemperature
          },
          {
            label:'humidite',
            borderColor: 'rgb(22, 43, 181)',
            data: arrayDataHumidite
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