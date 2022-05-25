//$(document).ready(function(){
//	$.ajax({
//		url: "http://localhost/hr/getSales.php",
//		method: "GET",
//		success: function(data) {
//			console.log(data);
//			var amounts = [];
//			var dates = [];
//			for(var i in data) {
//                alert(i);
//				amounts.push(data[i].subTotal);
//				dates.push(data[i].id);
//	 		}
//			var chartdata = {
//				labels: dates,
//				datasets : [
//					{
//						label: "My First dataset",
//                        fillColor: "rgba(21,186,103,0.4)",
//                        strokeColor: "rgba(220,220,220,0.8)",
//                        highlightFill: "rgba(21,186,103,0.2)",
//                        highlightStroke: "rgba(21,186,103,0.2)",
//                        data: amounts
//					}
//				]
//			};
//			var ctx = $(".bar-chart")[0].getContext("2d");
//            
//            window.myLine = new Chart(ctx).Bar(chartdata, 
//            {
//                responsive: true,
//                showTooltips: true
//            });
//        },
//        error: function(data) {
//			console.log(data);
//		}
//	});
// });

$(document).ready(function()
{
    
    $.ajax({
        url: 'http://thewebaxis.com/hr/getSales.php',
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
        var amount = [];
        var date   = [];
        
        for(var i = 0; i < jsonData.length; i++)
        {
            amount.push(jsonData[i][0]);
            date.push(jsonData[i][1]);
        }
        
        var chartdata = {
            labels: date,
            datasets : [
            {
                label: "My First dataset",
                fillColor: "rgba(21,186,103,0.4)",
                strokeColor: "rgba(220,220,220,0.8)",
                highlightFill: "rgba(21,186,103,0.2)",
                highlightStroke: "rgba(21,186,103,0.2)",
                data: amount
            }
		  ]
        };
        var ctx = $(".bar-chart")[0].getContext("2d");
            
        window.myLine = new Chart(ctx).Bar(chartdata, 
        {
            responsive: true,
            showTooltips: true
        });
    }
});














