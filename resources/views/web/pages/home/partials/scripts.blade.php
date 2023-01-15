<script type="text/javascript">
  var chart = JSC.chart('chartDiv', { 
    debug: true, 
    type: 'column', 
    title_label_text: 'Acme Tool Sales', 
    xAxis_label_text: 'Quarter', 
    yAxis: [ 
      { 
        id: 'stacked', 
        scale_type: 'stacked', 
        label_text: 'Stacked', 
        orientation: 'opposite'
      }, 
      { id: 'normal', label_text: 'Unstacked' } 
    ], 
    series: [ 
      { 
        name: 'Saw', 
        id: 's1', 
        yAxis: 'normal', 
        points: [ 
          { x: 'Q1', y: 530 }, 
          { x: 'Q2', y: 740 }, 
          { x: 'Q3', y: 667 }, 
          { x: 'Q4', y: 838 } 
        ] 
      }, 
      { 
        name: 'Hammer', 
        yAxis: 'normal', 
        points: [ 
          { x: 'Q1', y: 325 }, 
          { x: 'Q2', y: 367 }, 
          { x: 'Q3', y: 382 }, 
          { x: 'Q4', y: 371 } 
        ] 
      }, 
      { 
        name: 'Grinder', 
        yAxis: 'stacked', 
        points: [ 
          { x: 'Q1', y: 285 }, 
          { x: 'Q2', y: 292 }, 
          { x: 'Q3', y: 267 }, 
          { x: 'Q4', y: 218 } 
        ] 
      }, 
      { 
        name: 'Drill', 
        yAxis: 'stacked', 
        points: [ 
          { x: 'Q1', y: 185 }, 
          { x: 'Q2', y: 192 }, 
          { x: 'Q3', y: 198 }, 
          { x: 'Q4', y: 248 } 
        ] 
      } 
    ] 
  }); 

</script>