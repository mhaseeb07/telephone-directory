//Month Wise
var myChart = new Chart(
    document.getElementById('month_wise'),
    config = {
        type: 'line',
        data : {
            labels: [ 'June',  'July',  'August',  'September',  'October',  'November', ],
            datasets: [
                {
                    label: 'Orders',
                    data: [ 100,  200,  150,  400,  600,  500],
                    borderColor: '#00BCD4',
                    backgroundColor: '#00BCD4',
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                },
                {
                    label: 'New Visitors',
                    data: [ 400,  250,  350,  500,  400,  700],
                    borderColor: '#FF9800',
                    backgroundColor: '#FF9800',
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position:'bottom',
                    align:'start',
                    labels:{
                        boxWidth:15,
                        boxHeight:15
                    },
                },
            },
        },
    });
//Application Status
var myChart = new Chart(
    document.getElementById('application_status'),
    config = {
        type: 'doughnut',
        data: {
            labels: [
                "Pending",
                "Viewed",
                "Approved",
                "Rejected",
            ],
            datasets: [{
                data: [150,100, 250,90],
                backgroundColor: [
                    '#00BCD4',
                    '#FF9800',
                    '#009688',
                    '#E91E63',
                ],
                hoverOffset: 10
            }],
        },
        options: {
            cutout:'75%',
            plugins: {
                legend: {
                    position:'bottom',
                    align:'start',
                    labels:{
                        boxWidth:15,
                        boxHeight:15
                    },
                },
            },
            responsive: true,
            maintainAspectRatio: false
        },
    },
);
