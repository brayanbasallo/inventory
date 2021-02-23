<h1>Historial de ventas</h1>
<div class="table-responsive">
    <table class="table table-striped table-sm" id="table">
        <thead>
            <tr>
                <th>Factura</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="factura in facturas">
                <td>{{factura.id_factura}}</td>
                <td>{{factura.nombre}}</td>
                <td>{{factura.fecha}}</td>
                <td>{{factura.saldo_total | moneyFormat}}</td>
                <td> <span @click="mostrarFactura(factura)" class="btn text-primary">Detalles</span> </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="modal d-block border-none" @click="factura = false" tabindex="-1" v-if="factura" style="background:#000b1bbf">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-block" style="background: #e6eaec;">
                <div class="d-flex col-12 justify-content-between align-items-center">
                    <h5 class="modal-title fw-bolder">Detalles de factura</h5>
                    <span class="fw-bolder">{{facturaActiva.id_factura}}</span>
                </div>
                <div class="d-flex col-12 justify-content-between align-items-center">
                    <div class="col-6">
                        <p class="m-0 p-0 fs-6 fw-bolder">Vendedor: {{facturaActiva.nombre}}</p>
                        <p class="m-0 p-0 fw-light">{{facturaActiva.fecha | diaFacturacion}}</p>
                        <p class="m-0 p-0 fw-light">{{facturaActiva.fecha | horaFacturacion}}</p>
                    </div>
                    <div class="p-2 col-6 justify-content-between d-flex text-white" style="background:#2d343e;">
                        <span>Total</span>
                        <h5>${{facturaActiva.saldo_total | moneyFormat}}</h5>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">Nombre</td>
                                <td scope="col">Cantidad productos</td>
                                <td scope="col">Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="detalles in detallesFactura">
                                <td>{{detalles.nombre_producto}}</td>
                                <td>{{detalles.cantidad_productos}}</td>
                                <td>{{detalles.total | moneyFormat}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="d-flex col-12 justify-content-between align-items-center" style="background: #e6eaec;">
                    <div class="col-6 p-1">
                        <p class="m-0 p-0 fs-6 " v-if="facturaActiva.descuento != 0">Total sin descuento: ${{facturaActiva.saldo_total /facturaActiva.descuento*100 }} </p>
                        <p class="m-0 p-0 fs-6 ">Descuento: {{facturaActiva.descuento}}%</p>
                    </div>
                    <div class="p-2 col-6 justify-content-between d-flex text-white" style="background:#2d343e;">
                        <span>Total</span>
                        <h5>${{facturaActiva.saldo_total | moneyFormat}}</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" @click="factura = false" class="btn btn-secondary" data-dismiss="modal">Ocultar factura</button>
            </div>
        </div>
    </div>
</div>