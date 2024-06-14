// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Function to fetch data from both endpoints and update the chart
function fetchDataAndUpdateChart() {
  // URLs for pre-test and post-test data
  const pretestUrl = 'https://mathgasing.cloud/api/averageScoresPretestByMateri';
  const posttestUrl = 'https://mathgasing.cloud/api/averageScoresPosttestByMateri';

  // Perform AJAX requests to both endpoints
  $.when(
    $.ajax({ url: pretestUrl, method: 'GET' }),
    $.ajax({ url: posttestUrl, method: 'GET' })
  ).done(function(pretestResponse, posttestResponse) {
    const pretestData = pretestResponse[0];
    const posttestData = posttestResponse[0];

    // Prepare data for the chart
    var labels = [];
    var pretestScores = [];
    var posttestScores = [];

    // Create a map for post-test scores
    var posttestMap = {};
    posttestData.forEach(function(item) {
      posttestMap[item.title] = parseFloat(item.average_score);
    });

    // Iterate over pre-test data and prepare labels and scores
    pretestData.forEach(function(item) {
      labels.push(item.title);
      pretestScores.push(parseFloat(item.average_score));
      posttestScores.push(posttestMap[item.title] || 0);
    });

    // Update chart data
    myLineChart.data.labels = labels;
    myLineChart.data.datasets[0].data = pretestScores;
    myLineChart.data.datasets[1].data = posttestScores;

    // Update chart
    myLineChart.update();
  }).fail(function(error) {
    console.error('Error fetching data:', error);
  });
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [],
    datasets: [
      {
        label: "PRE-TEST",
        lineTension: 0.3,
        backgroundColor: "rgba(255, 99, 132, 0.2)", // Adjust color as needed
        borderColor: "rgba(255, 99, 132, 1)", // Adjust color as needed
        pointRadius: 5,
        pointBackgroundColor: "rgba(255, 99, 132, 1)", // Adjust color as needed
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(255, 99, 132, 1)", // Adjust color as needed
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: [] // Will be updated after fetching data
      },
      {
        label: "POST-TEST",
        lineTension: 0.3,
        backgroundColor: "rgba(54, 162, 235, 0.2)", // Adjust color as needed
        borderColor: "rgba(54, 162, 235, 1)", // Adjust color as needed
        pointRadius: 5,
        pointBackgroundColor: "rgba(54, 162, 235, 1)", // Adjust color as needed
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(54, 162, 235, 1)", // Adjust color as needed
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: [] // Will be updated after fetching data
      }
    ],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

// Fetch data and update chart on page load
fetchDataAndUpdateChart();
