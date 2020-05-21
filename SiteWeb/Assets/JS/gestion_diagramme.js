  
var MesureChartContext = document.getElementById('diagrammeMesure').getContext('2d');   // Doit être un <canvas></canvas>
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

  if(window.MesureChart.data.datasets[0].data.length == 12)   // Définie le nombre maximum de données dans le graphique
  {
    window.MesureChart.data.datasets[0].data.shift();   //Supprime la première donnée entré dans le graphique et décale les autres données vers la gauche
    window.MesureChart.data.datasets[1].data.shift();
    window.MesureChart.data.labels.shift();
  }
  
  window.MesureChart.data.labels.push(newTime);   // Ajoute une données a la fin du graphique
  window.MesureChart.data.datasets[0].data.push(parseInt(newTemperature));
  window.MesureChart.data.datasets[1].data.push(parseInt(newHumidite));
  
  
  window.MesureChart.update();
}

function PopMesureChart(arrayDataTemperature, arrayDataHumidite, labelTime){    // Affiche le graphique pour la première fois

  window.MesureChart = new Chart(MesureChartContext, {
      type:'line',
      data:{
          labels: labelTime,          // nom des valeurs pour axis X
          datasets:[{   // datasets[0]
            label:'Temperature',
            borderColor: 'rgb(17, 173, 59)',
            data: arrayDataTemperature,
          },
          {   // datasets[1]
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