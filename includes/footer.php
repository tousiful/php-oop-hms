<!-- footer content -->
        <footer>
          <div class="pull-right">
            Hospital Management System By <a href="https://colorlib.com">Tonmoy</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
   
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- bootbox code -->
    <script src="vendors/bootstrap/dist/js/bootbox.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/bernii/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="js/flot/jquery.flot.orderBars.js"></script>
    <script src="js/flot/date.js"></script>
    <script src="js/flot/jquery.flot.spline.js"></script>
    <script src="js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>
    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	  
	  <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="endors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
	
	  <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>

    <!-- Flot -->
	 <!-- validator -->
    <script src="vendors/validator/validator.js"></script>
  
    <!-- jVectorMap -->
    <script src="js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/maps/jquery-jvectormap-us-aea-en.js"></script>
    <script src="js/maps/gdp-data.js"></script>
	 <!-- select2 -->
    <script src="vendors/select2/dist/js/select2.min.js"></script>
    
	<!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->
	
	<!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable({
			
			 responsive: true,
			 
			"columnDefs": [ {
							"targets": 6,
							"orderable": false
							},{ 'searchable': false, 
							
							'aTargets': [ 1,2,3,4,5,6] 
							} 
		                  ]				
        });
	   $('#ward_datatable').dataTable({
		    responsive: true,
			"columnDefs": [ {
							"targets": 2,
							"orderable": false
							},{ 'searchable': false, 
							
							'aTargets': [ 1,2] 
							} 
		                  ]		
		});
		$('#cabin_datatable').dataTable({
			 responsive: true,
			"columnDefs": [ {
							"targets":4,
							"orderable": false
							},{ 'searchable': false, 
							
							'aTargets': [ 1,2,3,4] 
							} 
		                  ]		
		});
		$('#vipcabin_datatable').dataTable({
			 responsive: true,
			"columnDefs": [ {
							"targets":4,
							"orderable": false
							},{ 'searchable': false, 
							
							'aTargets': [ 1,2,3,4] 
							} 
		                  ]		
		});
		
		$('#bed_datatable').dataTable({
			 responsive: true,
			"columnDefs": [ {
							"targets": 5,
							"orderable": false
							},{ 'searchable': false, 
							
							'aTargets': [ 1,2,3,4,5] 
							} 
		                  ]		
		});
		$('#billing_datatable').dataTable({
			 responsive: true,
			"columnDefs": [ {
							"targets": 5,
							"orderable": false
							},{ 'searchable': false, 
							
							'aTargets': [ 1,2,3,4,5] 
							} 
		                  ]		
		});
		
		$('#test_datatable').dataTable({
			 responsive: true,
			"columnDefs": [ {
							"targets": 3,
							"orderable": false
							},{ 'searchable': false, 
							
							'aTargets': [ 1,2,3] 
							} 
		                  ]		
		});
		
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
	  
	<!-- show current time -->
	<script type="text/javascript"> 
			function display_c(){
			var refresh=1000; // Refresh rate in milli seconds
			mytime=setTimeout('display_ct()',refresh)
			}

			function display_ct() {
		var strcount
		var x = new Date()
		document.getElementById('ct').value = x;
		tt=display_c();
		}
	</script>
 <!-- add more input field -->
	<script>
	   $(document).ready(function() {
		var max_fields      = 10; //maximum input boxes allowed
		var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				$(wrapper).append('<div class="input_style2"><input type="text" name="ward[]" class="input_style form-control"  required /><a href="#" class="remove_field">Remove</a></div>'); //add input box
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});
</script>
 <!-- dynamic select box -->
	<script>
		$(document).ready(function(){
			  $('#category').change(function(){
				var cabin_type = $(this).val();
				var token_id = $('#token').val();
				$.ajax({
					url:"fetch_room.php",
					method:"POST",
					data:{cabinType:cabin_type,tokenId:token_id},
					dataType:"text",
					success:function(response)
					{
						$('#selected_cabins').html(response);
					}
				});
			});
			/*$('#room').change(function(){
				var room_id = $(this).val();
				var token_id = $('#token').val();
				$.ajax({
					url:"fetch_room.php",
					method:"POST",
					data:{roomId:room_id,tokenId:token_id},
					dataType:"text",
					success:function(response)
					{
						$('#bed').html(response);
					}
				});
			});*/

		});
	</script> 
	
	<!-- billing calculation -->
    <!-- <script>
		$(document).ready(function(){
				<!-- $('#consult_fee, #other_fees, #concession').keyup(function(){

				var troom_charges = $('#troom_charges').val();
				var consult_fee = parseInt($('#consult_fee').val()) || 0;
				/*var tal = parseInt($(this).val()) || 0; 
						or
				if(isNaN(tal)) {
				var tal = 0;
				}*/
				var other_fees = parseInt($('#other_fees').val()) || 0;
				var totalcharge = parseInt(consult_fee) + parseInt(other_fees) + parseInt(troom_charges);
				$('#t_amount').val(parseInt(totalcharge));
				
				var concession = $('#concession').val();
				var t_amount = $('#t_amount').val();
				var concession_amt = ((concession/100)* t_amount).toFixed(2);
				$('#concession_amount').val(concession_amt);
				
				var concession_amount = $('#concession_amount').val();
				$('#net_amount').val(t_amount - concession_amount);
				
				var amount_paid = $('#amount_paid').val();
				var net_amount = $('#net_amount').val();
				var balance = (net_amount - amount_paid).toFixed(2);
				$('#balance').val(balance);
			});-->
			
			
			<!-- $('#discharge').change(function(){
				if($(this).is(':checked')){
						
					var amount_paid = $('#amount_paid').val();
					var net_amount = $('#net_amount').val();
					var due = $('#balance').val();
					if(amount_paid < net_amount){
						
						$('#save').click(function(e) {
							var currentForm = this;
							e.preventDefault();
							
							bootbox.confirm({ 
									size: 'small',
									message: "Due is " + due +". Are you sure to confirm discharge?", 
									callback: function(result){ if (result) {
									$(currentForm).submit();
									
								} }
							});

							/*bootbox.confirm('Due is ' + due +'.Are you sure to confirm discharge?', function(result) {
								if (result) {
									$(currentForm).submit();
									
								}
								className: "modal70"
								
								
							});*/
	
						});
							
							//alert("Patient Due is" + due + "Confirm discharge?");
							
					}
						
				}
			});
		});
	</script>-->
	
	<!--bootstrap modal before delete -->
	<script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
	<!--custom validation 
   <script>
	$(document).ready(function () {
		$('#send').click(function(){
			var value = $('#select').val(); //console.log(value);
			if(value == ""){
				$('#show_message').show();
				return false;
			}
			//return false;
		});
	});
   
   </script>-->  
   <script>
		$(document).ready(function(){
			$("#myBtn").click(function(){
				$("#myModal").modal();
				return false;
			});
			
		});
 </script>

<!-- modal update confirm 
 <script>
		function test(){
        return true;
    };

 confirm
    $('button[data-toggle="modal-confirm"]').click(function(event) {
        event.preventDefault();
        var self = $(this);
        var message = self.data('message');
        var title = self.data('title');
        var target = $(self.data('target'));
        var condition = self.data('condition');
        if( target.length == 1) {
            target.find('.modal-title').html(title);
            target.find('.modal-body').html(message);
            var showModal = true;
            var fn = window[condition];
            if(typeof fn === 'function') {
                showModal = fn(condition);
            }
            if( showModal ) {
                target.on('shown.bs.modal', function(e) {
                    target.find('button[data-confirm="modal"]').click(function(e){
                        e.preventDefault();
                        var parentForm = self.closest('form');
                        console.log(parentForm.html());
                        if( parentForm.length == 1 ) {
                            parentForm.submit();
                        }
                    });
                });
                target.modal({ show: true });
            };
        };
    });
});
</script>-->
 <!--select2- room type select-->
	<script type="text/javascript">
	$(document).ready(function() {
		//$('select').select2();
	  $("#category").select2({
		      minimumResultsForSearch: -1
		});   

	});
	</script>
	
	<script type="text/javascript">
	$(document).ready(function() {
		$(".js-example-placeholder-multiple").select2({
            placeholder: "Select Test Name"
         });

    });
	</script>
	
	<script>
		$(document).ready(function(){
			$('#discharge').click(function(e) {
				var currentForm = this;
				e.preventDefault();
							
				bootbox.confirm({ 
								size: 'small',
								message: "Are you sure to confirm discharge?", 
								callback: function(result){ if (result) {
								$(currentForm).submit();
									
								}}
				});
			
		   });
	   });
			
   </script>



 </body>
</html> 