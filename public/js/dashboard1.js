/*
Template Name: Elitehospital Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
"use strict";
// Dashboard 1 Morris-chart
Morris.Area({ 
        element: 'morris-area-chart2',
        data: [{ // Insert Field DB
            period: '2021',
            OPD: 0, // sAMPLE FIELD

            
        }, {
            period: '2022',
            OPD: 130,

            
        }, {
            period: '2023',
            OPD: 30,

            
        }, {
            period: '2024',
            OPD: 30,

            
        }, {
            period: '2025',
            OPD: 200,
  
            
        }, {
            period: '2026',
            OPD: 105,
 
            
        },
         {
            period: '2027',
            OPD: 250,
 
           
        }],
        xkey: 'period',
        ykeys: ['OPD'],
        labels: ['Jumlah Pasien'],
        pointSize: 0,
        fillOpacity: 0.4,
        pointStrokeColors:['#00c292'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 0,
        smooth: false,
        hideHover: 'auto',
        lineColors: ['#00c292'],
        resize: true
        
    });

var sparklineLogin = function () { 
$("#sparkline8").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
            type: 'line',
            width: '100%',
            height: '130',
            lineColor: '#00c292',
            fillColor: 'rgba(0, 194, 146, 0.2)',
            maxSpotColor: '#00c292',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#00c292'
        });
        $("#sparkline9").sparkline([2,4,8,6,8,5,6,4,8,6,6,2 ], {
            type: 'line',
            width: '100%',
            height: '130',
            lineColor: '#03a9f3',
            fillColor: 'rgba(3, 169, 243, 0.2)',
            minSpotColor:'#03a9f3',
            maxSpotColor: '#03a9f3',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#03a9f3'
        });
        $("#sparkline10").sparkline([2,4,4,6,8,5,6,4,8,6,6,2], {
            type: 'line',
            width: '100%',
            height: '130',
            lineColor: '#fb9678',
            fillColor: 'rgba(251, 150, 120, 0.2)',
            maxSpotColor: '#fb9678',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#fb9678'
        });
}
var sparkResize;
$(window).resize(function (e) {
    clearTimeout(sparkResize);
    sparkResize = setTimeout(sparklineLogin, 100);
});
sparklineLogin();