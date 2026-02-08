<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Factura</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- CSRF para AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Nueva Factura</h5>
        </div>

        <div class="card-body">

            <form id="formFactura" method="POST" action="{{ route('factura.guardar') }}">
                @csrf

                <!-- Datos generales -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Número de factura</label>
                        <input type="text" name="numero_factura" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha emisión</label>
                        <input type="date" name="fecha_emision" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Método de pago</label>
                        <select name="metodo_pago" class="form-select" required>
                            <option value="">Seleccione</option>
                            <option value="EFECTIVO">Efectivo</option>
                            <option value="TARJETA">Tarjeta</option>
                            <option value="TRANSFERENCIA">Transferencia</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <input type="text" name="cliente" class="form-control" required>
                </div>

                <hr>

                <!-- Detalle de productos -->
                <h6>Detalle de factura</h6>

                <table class="table table-bordered" id="tablaDetalle">
                    <thead class="table-secondary">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="detalleFactura">
                        <tr>
                            <td>
                                <input type="text" name="productos[0][producto]" class="form-control" required>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="productos[0][cantidad]" class="form-control cantidad" required>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="productos[0][precio]" class="form-control precio" required>
                            </td>
                            <td>
                                <input type="number" step="0.01" class="form-control subtotal" readonly>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm btnEliminar">X</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-outline-primary mb-3" id="btnAgregar">
                    + Agregar producto
                </button>

                <hr>

                <!-- Totales -->
                <div class="row justify-content-end">
                    <div class="col-md-4">
                        <div class="mb-2">
                            <label>Subtotal</label>
                            <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" readonly>
                        </div>

                        <div class="mb-2">
                            <label>IVA</label>
                            <input type="number" step="0.01" name="iva" id="iva" class="form-control" readonly>
                        </div>

                        <div class="mb-2">
                            <label>Total</label>
                            <input type="number" step="0.01" name="total" id="total" class="form-control fw-bold" readonly>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observación</label>
                    <textarea name="observacion" class="form-control" rows="2"></textarea>
                </div>

                <!-- Acciones -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('factura.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Factura</button>
                </div>

            </form>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="{{ asset('js/facturacion.js') }}"></script>
</body>
</html>
