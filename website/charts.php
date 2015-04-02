<?php include("backend/checksession.php") ?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Charts</title>
    <link rel="stylesheet" href="http://localhost/taogei/website/assets/css/style.css" type="text/css">
    <!-- base -->
    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="http://localhost/taogei/website/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/taogei/website/assets/css/font-awesome.min.css">
    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="http://localhost/taogei/website/assets/css/bootstrap-theme.css" media="screen" >
    <link rel="stylesheet" href="http://localhost/taogei/website/assets/css/main.css">  
    <!-- end base -->

    <script src="http://localhost/taogei/website/assets/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="http://localhost/taogei/website/assets/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <?php 
        include("backend/data.php"); 
    ?>  
    <script type="text/javascript">
        var chart;
        var legend;
        var chartData = <?php echo $output; ?> ;
        AmCharts.ready(function () {
            // PIE CHART
            chart = new AmCharts.AmPieChart();
            chart.dataProvider = chartData;
            chart.titleField = "industry";
            chart.valueField = "count";
            chart.outlineColor = "#FFFFFF";
            chart.outlineAlpha = 0.8;
            chart.outlineThickness = 2;
            // WRITE
            chart.write("chartdiv");
        });
    </script>          
</head>
    
<body>
    <header id="head" class="secondary"></header>

    <div class="navbar navbar-inverse navbar-fixed-top headroom" >
        <div class="container">
            <div class="navbar-header">
                <!-- Button for smallest screens -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#"><i class="fa fa-group"></i> TAOGEI</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li><a class="btn" href="http://localhost/taogei/website/charts/2015-01-01_2099-12-31/100">Charts</a></li>
                    <li><a class="btn" href="http://localhost/taogei/website/newidea.php">New Idea</a></li>
                    <li><a class="btn" href="http://localhost/taogei/website/dashboard.php">Dashboard</a></li>
                    <li><a class="btn" href="http://localhost/taogei/website/backend/logout.php">Log Out</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div> 
    <!-- /.navbar -->

    <div class="container">
        <?php
                $start = $_GET['start'];
                $end = $_GET['end'];
                $k = $_GET['k']; 
            ?>
        <h2 class="page-title top-space">Top <?php echo $k ;?> projects from <?php echo $start . " to " . $end ; ?></h2>
        <?php 
                $topproject = "select vote.projid, sum(rating), project.submitdate, project.title, project.email from project right join vote on project.projid=vote.projid where submitdate>=$1 and submitdate <=$2 group by vote.projid, project.submitdate, project.title, project.email order by sum(rating) desc limit $3" ;
                pg_prepare($dbconn, "topproject", $topproject);
                $result = pg_execute($dbconn, "topproject", array($start, $end, $k ));


                $output = "[";
                while ($row = pg_fetch_array($result) ) {
                    if ($output != "[") {
                        $output .= ", ";
                    }
                    $output .= "{
                                projid: '". $row[0] ."',
                                rating: '". $row[1] ."',
                                submitdate: '". $row[2] ."',
                                title: '". $row[3] ."',
                                email: '" . $row[4] . "'
                                }";
                }
                $output .= "]";      
                echo $output;          
                //include("ideas.php");
        ?>        

        <h2 class="page-title top-space">Idea Distribution</h2>
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>

    </div>
    <?php 
        include("template/footers.php");
    ?> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="http://localhost/taogei/website/assets/js/headroom.min.js"></script>
    <script src="http://localhost/taogei/website/assets/js/jQuery.headroom.min.js"></script>
    <script src="http://localhost/taogei/website/assets/js/template.js"></script>       
</body>

</html>