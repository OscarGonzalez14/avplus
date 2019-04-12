<script>
    function pruebaDivAPdf() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#reportcons')[0];



        specialElementHandlers = {
            '#bypassme': function (element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 20,
            left: 40,
            width: 522
        };

        pdf.fromHTML(
            source, 
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, 
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                pdf.save('Prueba.pdf');
            }, margins
        );
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>   
   <div class="modal fade" id="detalle_consulta">
          <div class="modal-dialog modal-lg" id="tamanoModal">
           <!--antes tenia un class="modal-content" y lo cambié por bg-warning para que tuviera fondo blanco, deberia haber sido un color naranja claro pero me salió un color blanco de casualidad--> 
            <div class="bg-warning">
              <div class="modal-header" id="encabezado">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <h4 class="modal-title">
                  <span aria-hidden="true">&times;</span></button>

                <h4 align="center" class="modal-title"><i class="fa fa-user-circle" aria-hidden="true"></i> Detalle de Consultas</h4> 

                             
              </div>
              <div class="modal-body">

                 <div class="container box">
        
        <!--column-12 -->
        <div class="table-responsive">
         
  <div class="box-body" id="reportcons">


               
        <table id="detalle_consultas" class="table table-striped table-bordered table-condensed table-hover">

        <thead style="background-color:#A9D0F5" >
          <tr>
            <th colspan="2">Codigo</th>
            <th colspan="2">Paciente</th>
            <th>Fecha de consulta</th>
            <th>Atendido por: </th>
          </tr>
        </thead>
          <tbody>                            
              <tr>

                <td colspan="2"><p id="codigo" name="codigo"></p></td>
                <td colspan="2"><p id="nombres" name="nombres"></p></td>
                <td><p id="fecha_reg" name="fecha_reg"></p></td>
                <td><p id="usuario" name="usuario"></p></td> 
   
          </tbody>

      <thead style="background-color:#A9D0F5" align="center">
          <tr>
            <th colspan="6"><p align="center">Diagnostico</p></th>
          
          </tr>
        </thead>
          <tbody>                            
              <tr>
               
                <td colspan="6"><p id="diagnostico" name="diagnostico" align="center"></p></td>     
              </tr>
          </tbody>

  <thead style="background-color:#E8E8E8" align="center">
          <tr>
            <th colspan="6"><p align="center"><strong>Lensometria</strong></p></th>
          
          </tr>
        </thead>

          </tbody>

    <thead class="thead-light">
      <tr>
        <th style="text-align:center">OJO</th>
        <th style="text-align:center">ESFERAS</th>
        <th style="text-align:center">CILIDROS</th>
        <th style="text-align:center">EJE</th>
        <th style="text-align:center">PRISMA</th>
        <th style="text-align:center">ADICION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>OI</td>
        <td> <p name="oiesfreasl" id="oiesfreasl" align="center"></p></td>
        <td> <p name="oicilindrosl" id="oicilindrosl" align="center"></p></td>
        <td> <input type="text"  placeholder="---" name="oiejesl" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiprismal" ></td>
        <td> <input type="text" class="form-control" placeholder="---" name="oiadicionl"></td>
      </tr>
      <tr>
        <td>OD</td>
        <td> <input type="text" class="form-control" placeholder="---" name="odesferasl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odcilndrosl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odejesl"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odprismal"></td>
        <td> <input type="text" class="form-control" placeholder="---" name="odadicionl"></td>
        
      </tr>
    </tbody>
        </table>




                         
            </div>
            <!-- /.box-body -->

              <!--BOTON CERRAR DE LA VENTANA MODAL-->
             <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                
              </div>
              <!--modal-footer-->
          <!--</div>-->
          <!-- /.box -->

        </div>
        <!--/.col (12) -->
      </div>
      <!-- /.row -->
       
     
              </div>
              <!--modal body-->
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

     

    

        
  