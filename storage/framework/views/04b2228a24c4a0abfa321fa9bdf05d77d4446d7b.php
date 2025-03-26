<?php $__env->startSection('content'); ?>
    <div class="right-side-section">
        <div class="right-section-content">
            <div class="admin-sec-btn-area">
                <div class="report-title-section">
                    <h4>Welcome Admin</h4>
                </div>
                
            </div>
           
            <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="row">
              <div class="col-md-6">
                <h6><?php echo e(__("Laundry Bookings in Next Week")); ?></h6>
                <canvas id="myChart"  ></canvas>
              </div>
              <div class="col-md-6">
                
                  <h6><?php echo e(__("Reported Issues in Last Month")); ?></h6>
                  <canvas id="reportedIssues"  ></canvas>
               
              </div>

              <div class="col-md-12">
                
                  <h6><?php echo e(__("Total Expenses in this year")); ?></h6>
                  <canvas id="reportedIssuesExp"  ></canvas>
               
              </div>
            </div>


            
        </div>
    </div>

    <!--  ===============================  -->
    <!--  ======= Main Banner ===========  -->
    <!--  ===============================  -->

<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          <?php echo json_encode($dayNames) ?>,
          <?php echo json_encode($counts) ?>,
          
        ]);

        var options = {
          title : 'Next Week Bookings',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {<?php echo count($dayNames) ?>: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script> -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\rosen\resources\views/admin/welcome.blade.php ENDPATH**/ ?>