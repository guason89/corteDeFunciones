{{--HTML--}}
<div class="panel panel-success">
    <div class="panel-heading" >
        <h3 class="panel-title">
            <a class="block-collapse collapsed" id='colp' data-toggle="collapse" href="#collapse-filter">
            B&uacute;squeda avanzada 
            <span class="right-content">
                <span class="right-icon"><i class="fa fa-plus icon-collapse"></i></span>
            </span>
            </a>
        </h3>
    </div>   
    <div id="collapse-filter" class="collapse">
        <div class="panel-body">

            {{-- COLLAPSE CONTENT --}}
            <form role="form" id="search-form">              
              <div class="row">
                <div class="col-sm-12 col-md-4 form-group">
                  <div class="input-group ">
                    <div class="input-group-addon"><b>NAME</b></div>
                    <input type="text" class="form-control" id="nameid" name="nameid" value="">                      
                  </div>
                </div>               
              </div>
                               
              <div class="modal-footer" >
                <div align="center">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control"/>
                <button type="submit" class="btn btn-success btn-perspective" id="btnConsultar"><i class="fa fa-search"></i> Buscar</button>
               </div>
              </div>
                  
                    
            </form>
            {{-- /.COLLAPSE CONTENT --}}
        </div><!-- /.panel-body -->
    </div><!-- /.collapse in -->
</div>
<div class="panel panel-success">	
	<div class="panel-heading">
		<h3 class="panel-title">TITULO</h3>    
	</div>
	<div class="panel-body the-box">		  
		<div class="table-responsive">		
			<table width="100%" id="dt-solicitudes" class="table table-th-block table-hover">
				<thead class="the-box dark full">
					<tr>           
            			<th width="100%">columnas</th>            
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

**********************************************************************************************
{{--JS--}}

table = $('#dt-id').DataTable({
      filter:false,
      processing: true,
      serverSide: true,
      lengthChange: false,
      //ordering: false,
       //pageLength: 5,
      ajax: {processing: true,
          url: "{{ route('route.route') }}",
          data: function (d) {
            d.idcampo = $('#idcampo').val();
                           
          }
          
      },
      columns: [ 
                  
          {data:'nombreCampo', name: 'nombreCampo',orderable:false, searchable:false}      
                  
      ],
      order: [[1, 'desc']],
      language: {
          "sProcessing": '<div class=\"dlgwait\"></div>',
          "url": "{{ asset('plugins/datatable/lang/es.json') }}"
          
          
      },
       columnDefs: [
          {                
            "visible": false,                         
          }
      ]    
  }); //end Datatable

    $('#search-form').on('submit', function(e) { 

        table.draw();
        e.preventDefault();
        $("#colp").attr("class", "block-collapse collapsed");
        $("#collapse-filter").attr("class", "collapse");
    });

    table.rows().remove();
