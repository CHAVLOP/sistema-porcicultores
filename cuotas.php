<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuotas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua4b1rLm6X6f5k5n5f5h5f5n5u5f5w5h5f5u5f5w5h5f5u5w5h5f5u5w5" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" href="css/cuotas.css">
</head>
<body>
  
   <!-- -----------------------------CUOTA UNION----------------------------------------------- -->
   <div id="print-header">
  ASOCIACION GANADERA LOCAL DEPORCICULTORES DE ABASOLO GTO
</div>
   <div id="fecha" class="print-header"></div>
   <div class="container">
   <div id="print-header1">
 RELACION DE INGRESOS DEL DIA
</div>
    <h1 class="mt-4">CUOTA UNION</h1>
    <button id="limpiarTodo" class="btn btn-danger float-right">Limpiar Todo</button>

    <div class="table-responsive">
      <table id="miTabla1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nombre de la cuota</th>
            <th>Cuota</th>
            <th>Cantidad de cerdos</th>
            <th>Total $</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota c.n,p" readonly value="Cuota c.n,p"></td>
            <td><input type="number" class="form-control cuota" name="numero1"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad1"></td>
            <td><input type="number" class="form-control total" name="total1" readonly ></td>
          </tr>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota c.n,g" readonly value="Cuota c.n,g"></td>
            <td><input type="number" class="form-control cuota" name="numero2"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad2"></td>
            <td><input type="number" class="form-control total" name="total2" readonly></td>
          </tr>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota fipocla" readonly value="Cuota fipocla"></td>
            <td><input type="number" class="form-control cuota" name="numero3"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad3"></td>
            <td><input type="number" class="form-control total" name="total3" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota prot.cer" readonly value="Cuota prot.cer"></td>
            <td><input type="number" class="form-control cuota" name="numero4"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad4"></td>
            <td><input type="number" class="form-control total" name="total4" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota comite protec, del" readonly value="Cuota comite protec, del"></td>
            <td><input type="number" class="form-control cuota" name="numero5"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad5"></td>
            <td><input type="number" class="form-control total" name="total5" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cerdo" readonly value="Cerdo"></td>
            <td><input type="number" class="form-control cuota" name="numero6"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad6"></td>
            <td><input type="number" class="form-control total" name="total6" readonly></td>
          </tr>
          <!-- Agrega más filas con datos de muestra aquí -->
        </tbody>
      </table>
    </div>
    <!-- Campos extra para la suma -->
   
    <div class="mt-3">
      <label for="totalSuma1">Total de ingresos $:</label>
      <input type="number" class="form-control" id="totalSuma1" readonly >
    </div>
  </div>


   <!--------------------------------------------- CUOTA ASOCIACION ---------------------------------->
  <div class="container">
    <h1 class="mt-4">CUOTA ASOCIACION</h1>
    <div class="table-responsive">
      <table id="miTabla2" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nombre de la cuota</th>
            <th>Cuota</th>
            <th>Cantidad de cerdos</th>
            <th>Total $</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota no 2" readonly value="Cuota no 2"></td>
            <td><input type="number" class="form-control cuota" name="numero1"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad1"></td>
            <td><input type="number" class="form-control total" name="total1" readonly></td>
          </tr>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota" readonly value="Cuota"></td>
            <td><input type="number" class="form-control cuota" name="numero2"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad2"></td>
            <td><input type="number" class="form-control total" name="total2" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota lechon" readonly value="Cuota lechon"></td>
            <td><input type="number" class="form-control cuota" name="numero3"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad3"></td>
            <td><input type="number" class="form-control total" name="total3" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota guia de carne" readonly value="Cuota guia de carne"></td>
            <td><input type="number" class="form-control cuota" name="numero4"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad4"></td>
            <td><input type="number" class="form-control total" name="total4" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Cuota refrendo o inscripcion" readonly value="Cuota refrendo o inscripcion"></td>
            <td><input type="number" class="form-control cuota" name="numero5"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad5"></td>
            <td><input type="number" class="form-control total" name="total5" readonly></td>
          </tr>


          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Papeleria" readonly value="Papeleria"></td>
            <td><input type="number" class="form-control cuota" name="numero6"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad6"></td>
            <td><input type="number" class="form-control total" name="total6" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Dosis de semen" readonly value="Dosis de semen"></td>
            <td><input type="number" class="form-control cuota" name="numero7"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad7"></td>
            <td><input type="number" class="form-control total" name="total7" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Botas, Overoles, Veneno, Desin, Otros" readonly value="Botas, Overoles, Veneno, Desin, Otros"></td>
            <td><input type="number" class="form-control cuota" name="numero8"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad8"></td>
            <td><input type="number" class="form-control total" name="total8" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Permiso de movilizacion" readonly value="Permiso de movilizacion"></td>
            <td><input type="number" class="form-control cuota" name="numero9"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad9"></td>
            <td><input type="number" class="form-control total" name="total9" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Fleje zoosanitario" readonly value="Fleje zoosanitario"></td>
            <td><input type="number" class="form-control cuota" name="numero10"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad10"></td>
            <td><input type="number" class="form-control total" name="total10" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Alimento" readonly value="Alimento"></td>
            <td><input type="number" class="form-control cuota" name="numero11"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad11"></td>
            <td><input type="number" class="form-control total" name="total11" readonly></td>
          </tr>

          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Otros (especificar)" readonly value="Otros (especificar)"></td>
            <td><input type="number" class="form-control cuota" name="numero12"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad12"></td>
            <td><input type="number" class="form-control total" name="total12" readonly></td>
          </tr>

          
          <!-- Agrega más filas con datos de muestra aquí -->
        </tbody>
      </table>
    </div>
    <!-- Campos extra para la suma -->
    <div class="mt-3">
      <label for="totalSuma2">Total de ingresos $:</label>
      <input type="number" class="form-control" id="totalSuma2" readonly>
    </div>
  </div>

  <div class="container">
    <h1 class="mt-4">PAGOS DE CLIENTES</h1>
    <div class="table-responsive">
      <table id="miTabla3" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nombre de la cuota</th>
            <th>Cuota</th>
            <th>Cantidad</th>
            <th>Total $</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Por guias" readonly value="Por guias"></td>
            <td><input type="number" class="form-control cuota" name="numero1"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad1"></td>
            <td><input type="number" class="form-control total" name="total1" readonly></td>
          </tr>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Por alimento" readonly value="Por alimento"></td>
            <td><input type="number" class="form-control cuota" name="numero2"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad2"></td>
            <td><input type="number" class="form-control total" name="total2" readonly></td>
          </tr>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Por varios (especifica)" readonly value="Por varios (especifica)"></td>
            <td><input type="number" class="form-control cuota" name="numero3"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad3"></td>
            <td><input type="number" class="form-control total" name="total3" readonly></td>
          </tr>
          <!-- Agrega más filas con datos de muestra aquí -->
        </tbody>
      </table>
    </div>
    <!-- Campos extra para la suma -->
    <div class="mt-3">
      <label for="totalSuma3">Total de ingresos $::</label>
      <input type="number" class="form-control" id="totalSuma3" readonly>
    </div>
  </div>


  <div class="container">
    <h1 class="mt-4">PAGO DEUDORES DIVERSOS</h1>
    <div class="table-responsive">
      <table id="miTabla4" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nombre de la cuota</th>
            <th>Cuota</th>
            <th>Cantidad</th>
            <th>Total $</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Por guias" readonly value="Por guias"></td>
            <td><input type="number" class="form-control cuota" name="numero1"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad1"></td>
            <td><input type="number" class="form-control total" name="total1" readonly></td>
          </tr>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Por alimento" readonly value="Por alimento"></td>
            <td><input type="number" class="form-control cuota" name="numero2"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad2"></td>
            <td><input type="number" class="form-control total" name="total2" readonly></td>
          </tr>
          <tr>
            <td><input type="text" class="form-control form-control-readonly" name="Por varios (especifica)" readonly value="Por varios (especifica)"></td>
            <td><input type="number" class="form-control cuota" name="numero3"></td>
            <td><input type="number" class="form-control cantidad" name="cantidad3"></td>
            <td><input type="number" class="form-control total" name="total3" readonly></td>
          </tr>
          <!-- Agrega más filas con datos de muestra aquí -->
        </tbody>
      </table>
    </div>
    <!-- Campos extra para la suma -->
    <div class="mt-3">
      <label for="totalSuma4">Total de ingresos $::</label>
      <input type="number" class="form-control" id="totalSuma4" readonly>
    </div>
    <br>
    <button id="imprimirTablas" class="btn btn-primary">Imprimir Tablas</button>
  </div>
  <script src="js/cuotas.js"></script>
</body>
</html>
