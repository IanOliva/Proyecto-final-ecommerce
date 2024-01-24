<form action="index.php?modulo=factura" method="post">


<table class="table table-striped table-inverse" id="tablaPasarela">
    <thead class="thead-inverse">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>


    </tbody>
</table>



<div class="mt-3 text-center">
    <h4>Atención</h4>
    <p>Luego de confirmar el pedido recuerde realizar su pago a la cuenta bancaria que aparece en la factura
        y enviar el comprobante con el ID de pedido a la siguiente dirección de email <strong>ecommerce@gmail.com </strong>una vez recibido el comprobante 
        se armara el pedido y se avisara cuando este listo para retirar. Muchas gracias!
    </p>
   
</div>
<div class="mt-3">
    <a class="btn btn-warning" href="index.php?modulo=envio" role="button">Ir a envio</a>
    <button type="submit" class="btn btn-primary float-right" name="pagar">Confirmar Pedido</button>
</div>

</form>