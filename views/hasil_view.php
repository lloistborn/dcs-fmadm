<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="http://localhost/basicmvc_testcase/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="http://localhost/basicmvc_testcase/>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://localhost/basicmvc_testcase/assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="http://localhost/basicmvc_testcase/assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://localhost/basicmvc_testcase/assets/fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="http://localhost/basicmvc_testcase/assets/fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
    <script type="text/javascript">

      FusionCharts.ready(function(){
        var revenueChart = new FusionCharts({
            "type": "column2d",
            "renderAt": "chartContainer",
            "width": "100%",
            "height": "50%",
            "dataFormat": "json",
            "dataSource":  {
              "chart": {
                "caption": "Alternatif pilihan jurusan",
                "subCaption": "",
                "xAxisName": "Pilihan Jurusan",
                "yAxisName": "Nilai bobot",
                "theme": "fint"
            },
            "data": [
            {
             "label": "IPA",
             "value": "<?php echo $ipa; ?>"
         },
         {
             "label": "IPS",
             "value": "<?php echo $ips; ?>"
         }
         ]
     }

 });
        revenueChart.render();
    })
</script>
</head>
<body>

  <!-- Main content -->
  <section class="content">
    <div class="container" style="max-width:100%;">
        <div class="panel panel-primary">

            <div class="panel-heading">
            <h3 class="panel-title">Hasil</h3>
            </div>

            <div class="panel-body">
                <div id="chartContainer"></div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<!-- jQuery 2.0.2 -->
<script src="http://localhost/basicmvc_testcase/assets/js/jquery-1.12.0.min.js"></script>

<!-- jQuery UI 1.10.3 -->
<script src="http://localhost/basicmvc_testcase/assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

<!-- jQuery Validator -->
<script src="http://localhost/basicmvc_testcase/assets/js/jquery.validate.min.js" type="text/javascript"></script>

<!-- Custom jQuery -->
<script src="http://localhost/basicmvc_testcase/assets/js/app.js" type="text/javascript"></script>

<!-- Bootstrap -->
<script src="http://localhost/basicmvc_testcase/assets/js/bootstrap.min.js" type="text/javascript"></script>

<!-- AdminLTE App -->
<script src="http://localhost/basicmvc_testcase/assets/js/AdminLTE/app.js" type="text/javascript"></script>
</body>
</html>