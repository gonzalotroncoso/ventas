<?php 
require_once "../dependencias.php"; 
require_once '../../clases/Conexion.php';
$c = new conectar();
$dbh = $c->conexion();


?>


<h4>Vender un producto</h4>
<div class="row">	
	<div class="col-sm-4">
		<form id="frmVentaProductos">
			<label>Selecciona Cliente</label>
			<select class="form-control input-sm
			" id="clienteVenta" name="clienteVenta">
			<option value="0">Sin cliente </option>
			<?php
			$sql ="SELECT * FROM clientes";
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			while ($cliente = $stmt->fetch()):
				?>
				<option value="<?php echo $cliente['id_cliente'] ?>"><?php echo $cliente['apellido']." ".$cliente['nombre']; ?></option>
			<?php endwhile; ?>
		</select>

		<label>Producto</label>


		<select class="form-control input-sm" id="ProductoVenta" name="ProductoVenta">
			<option value="0"> Selecciona Producto</option>
			<?php
			$sql ="SELECT * FROM articulos where cantidad >0";
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			while ($producto = $stmt->fetch()):
				?>
				<option value="<?php echo $producto['id_producto'] ?>"><?php echo $producto['nombre'] ?></option>
			<?php endwhile; ?>
		</select>


		<label>Descripcion</label>
		<textarea readonly="" id="descripcionV" name="descripcionV" class="form-control input-sm"></textarea>
		<label>Cantidad</label>
		<input readonly="" type="text" class="form-control input-sm" id="cantidadV" name="cantidadV">
		<label>Precio</label>
		<input readonly="" type="text" class="form-control input-sm" id="precioV" name="precioV">
		<p></p>

		<span class="btn btn-primary" id="btnAgregaVenta">Agregar</span>
		<span class="btn btn-danger" id="btnVaciarVenta">Vaciar Ventas </span>

	</form>

</div>
<div class="col-sm-3">
	<div id="imgProducto"></div>
</div>

<div class="col-sm-4">
	<div id="tablaVentasTempLoad"></div>
</div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteVenta').select2();
		$('#ProductoVenta').select2();

	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
				$('#tablaVentasTempLoad').load("ventas/tablasVentasTemp.php");
		
		$('#ProductoVenta').change(function(){			
			$.ajax({
				type:"POST",
				data:"idproducto="+ $('#ProductoVenta').val(),
				url:"../procesos/ventas/llenarProducto.php",
				success:function(r){	
					
					dato=jQuery.parseJSON(r);
					$('#descripcionV').val(dato['descripcion']);
					$('#cantidadV').val(dato['cantidad']);
					$('#precioV').val(dato['precio']);
					$('#imgProducto').prepend('<img class="img-thumbnail" width="80" height="80" id="imgp" src="' + dato['ruta'] + '" />');	
					

				}

			});

		});	




		$('#btnAgregaVenta').click(function(){
			vacios=validarFormVacio('frmVentaProductos');
			if(vacios>0){
				alertify.alert("Debes llenar todos los campos");
				return false;
			}
			datos=$('#frmVentaProductos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/ventas/agregaProductoTemp.php",
				success:function(r){
					
					$('#tablaVentasTempLoad').load("ventas/tablasVentasTemp.php");
					$("#ProductoVenta option[value=0]");
					$("._ProductoVenta").val('2');										
					$("#descripcionV").val($("Hola").val());
					$("#cantidadV").val($("").val());
					$("#precioV").val($("").val());

				
					
				}
			});
		});	
		$('#btnVaciarVenta').click(function(){		
			$.ajax({			
				url:"../procesos/ventas/vaciarTemp.php",
				success:function(r){
					$('#tablaVentasTempLoad').load("ventas/tablasVentasTemp.php")


				}
			});
		});
	});

</script>
<script type="text/javascript">
	function quitarP(index){
		$.ajax({
			type:"POST",
			data:"ind="+index,
			url:"../procesos/ventas/quitarProducto.php",
			success:function(r){
			
				alertify.success("Se quito el producto");
				$('#tablaVentasTempLoad').load("ventas/tablasVentasTemp.php");


			}
		});

	}

	function crearVenta(){
		$.ajax({			
			url:"../procesos/ventas/crearVenta.php",
			success:function(r){
				
				if(r>0){
					$('#tablaVentasTempLoad').load("ventas/tablasVentasTemp.php");
					alertify.alert("Venta creada con exito, consulte la informacion de esta en ventas hechas");


				}else if(r==0){
					alertify.alert("No hay lista de venta");
				}else{
					alertify.error("No se pudo crear la venta");
				}

			}
		});
	}

</script>
