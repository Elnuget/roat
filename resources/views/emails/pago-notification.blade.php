<!DOCTYPE html>
<html>
<head>
    <title>Notificación de Pago</title>
</head>
<body>
    <h2>Nuevo Pago Registrado</h2>
    <p>Se ha registrado un nuevo pago con los siguientes detalles:</p>
    
    <ul>
        <li>Orden: {{ $pago->pedido->numero_orden }}</li>
        <li>Cliente: {{ $pago->pedido->cliente }}</li>
        <li>Monto: ${{ number_format($pago->pago, 2) }}</li>
        <li>Método de pago: {{ $pago->mediodepago->medio_de_pago }}</li>
        <li>Fecha: {{ $pago->created_at->format('d/m/Y H:i:s') }}</li>
    </ul>
</body>
</html>
