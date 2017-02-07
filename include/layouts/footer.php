        </div>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="assets/js/active.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="assets/js/bootstrap.min.js"></script>   

  
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/bootstrap-datepicker.js"></script>

        <!-- data-table js -->
        <script src="assets/js/data-table.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <!-- data-table js -->

<!--     <script type='text/javascript' src='assets/js/jquery.ba-hashchange.min.js'></script>
    <script type='text/javascript' src='assets/js/dynamicpage.js'></script>   -->

        <!-- data table -->
        <script type="text/javascript">
          $(document).ready(function() {
            $('#moneyManagement').DataTable();
        } );
        </script>

        <script type="text/javascript">
            $('.datepicker').datepicker();<!--Date Picker-->
            $(".timepicker").kitkatclock();<!--Time Picker-->
        </script> 


        <!-- delete earn item -->
        <script type="text/javascript">
            $(function(){
              $(".delete").click(function(){
                var element = $(this);
                var userid = element.attr("id");
                var info = 'id='+userid;
                //alert(info);
                if(confirm("Are yout sure want to delete")){
                  $.ajax({
                    url:'deleteearn.php',
                    type: 'post',
                    data: info,
                    success: function(){
                      
                    }
                  });
                  $(this).parent().parent().fadeOut(300,function(){
                    $(this).remove();
                  })
                };
                return false;
              });
            });
        </script>

        <!-- delete cost item -->
        <script type="text/javascript">
            $(function(){
              $(".deletecost").click(function(){
                var element = $(this);
                var costid = element.attr("id");
                var info = 'id='+ costid;
                //alert(info);
                if(confirm("Are yout sure want to delete")){
                  $.ajax({
                    url:'deletecostitem.php',
                    type: 'post',
                    data: info,
                    success: function(){
                      
                    }
                  });
                  $(this).parent().parent().fadeOut(300,function(){
                    $(this).remove();
                  })
                };
                return false;
              });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#create_Excel').click(function(){
                    var excel_data = $('#invoiceExcel').html();
                    var page = "excel.php?data=" + excel_data;
                    window.location = page;
                });
            });
        </script>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>