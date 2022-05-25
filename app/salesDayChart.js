$(document).ready(function()
{
    
    $.ajax({
        url: 'http://thewebaxis.com/hr/getSalesDay.php',
        dataType: 'json',
        async: false,
        success: function (jsonData)
        {
            console.log(jsonData);
            getChart(jsonData);  
        }
    });
    
    
    function getChart(jsonData)
    {
        
        var numrows   = jsonData.length;
    
        console.log(jsonData);  
        var amount  = [];
        var date    = [];
        var invoice = [];
        
        for(var i = 0; i < jsonData.length; i++)
        {
            amount.push(jsonData[i][0]);
            date.push(jsonData[i][1] +" Invoice No "+ jsonData[i][2]);
        }
        
        var chartdata = {
            labels: date,
            datasets : [
            {
                label: "My First dataset",
                fillColor: "rgba(21,113,186,0.5)",
                strokeColor: "rgba(151,187,205,0.8)",
                highlightFill: "rgba(21,113,186,0.2)",
                highlightStroke: "rgba(21,113,186,0.2)",
                data: amount
            }
		  ]
        };
        var ctx = $(".bar-chartday")[0].getContext("2d");
            
        window.myLine = new Chart(ctx).Bar(chartdata, 
        {
            responsive: true,
            showTooltips: true
        });
    }
});














