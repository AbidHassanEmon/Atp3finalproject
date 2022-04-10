
@extends('inc.layout')
@section('content')
@include('inc.navadmin')
<center>@if(Session::has('msg'))<span class="alert alert-info">{{Session::get('msg')}}</span>@endif</center>
<br>
<br>


<center><h1 style="color:red;">Number of Orders In Months</h1></center>
<div id="container"></div>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    var userData = <?php echo json_encode($orderData)?>;
    Highcharts.chart('container', {
        title: {
            text: 'Number of Orders'
        },
        subtitle: {
            text: 'AEFM Pharmacy'
        },
        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ]
        },
        yAxis: {
            title: {
                text: 'Number of Orders'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New Orders',
            data: userData
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>



<center><h1 style="color:red;">Number of User In Months</h1></center>
<div id="container1"></div>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    var userData = <?php echo json_encode($cusdata)?>;
    Highcharts.chart('container1', {
        title: {
            text: 'Number of User'
        },
        subtitle: {
            text: 'AEFM Pharmacy'
        },
        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ]
        },
        yAxis: {
            title: {
                text: 'Number of User'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'New User',
            data: userData
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>

@endsection

