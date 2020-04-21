  
  var diagrammeTemperature = document.getElementById('diagrammeTemperature').getContext('2d');
  var diagrammeHumidite = document.getElementById('diagrammeHumidite').getContext('2d');

$(document).ready(PopDiagramme());

function PopDiagramme()
{
    PopTemperature();
    PopHumidite();
}

function PopTemperature(){
    var PopDiagrammeTemperature = new Chart(diagrammeTemperature, {
        type:'line',
        data:{
            labels:['2 avil 2020 17h02:51', '3 avril 2020 11h14:14', '4 Avril 2020 12h45:16'],          // nom des valeurs en axis X
            datasets:[{
              label:'Temperature',
              data:[                              // nombre sur axe Y
                50,
                64,
                2
              ]
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
                labelString: 'Temperature'
              }
            }]
          }
        }
    });
}

function PopHumidite(){
    var PopDiagrammeHumidite = new Chart(diagrammeHumidite, {
        type:'line',
        data:{
            labels:['2 avil 2020 17h02:51', '3 avril 2020 11h14:14', '4 Avril 2020 12h45:16'],          // nom des valeurs en axis X
            datasets:[{
              label:'Humidite',
              data:[                              // nombre sur axe Y
                50,
                64,
                2
              ]
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
                labelString: 'Date'
              }
            }],
            yAxes: [ {
              //type: 'number',
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Pourcentage (%)'
              }
            }]
          }
        }
    });
}
