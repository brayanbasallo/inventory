
Vue.component('component-store', {
    data() {
        return {
            shoppingCart: new Object,
            products: {},
            search: '',
            cantidad: 0,
            descuento: 0,
            modal: false,
            cambio: false,
            total: 0,
            efectivo: 0,
            formFacturar: true,
            response: ''
        }
    },
    methods: {
        searchProduct() {
            let url = `../api/buscar/${this.search}`
            fetch(url).then(response => response.json())
                .then(result => {
                    this.products = result.products
                })
        },
        deletToCart(index) {
            this.$delete(this.shoppingCart, index)
            this.loadTotal()
        },
        addCart(product) {
            let nuevo = true
            if (this.cantidad > 0) {
                if (this.cantidad <= (product.stock * 1)) {
                    if (Object.keys(this.shoppingCart).length == 0) {
                        product.cantidad = this.cantidad
                        this.$set(this.shoppingCart, Object.keys(this.shoppingCart).length, product)
                    } else {
                        for (let i = 0; i < Object.keys(this.shoppingCart).length; i++) {
                            if (this.shoppingCart[i].id_producto == product.id_producto) {
                                let cantidad = (this.shoppingCart[i].cantidad * 1) + (this.cantidad * 1)
                                if (cantidad <= this.shoppingCart[i].stock) {
                                    this.shoppingCart[i].cantidad = cantidad
                                    this.shoppingCart = Object.assign({}, this.shoppingCart)
                                } else {
                                    this.modal = `Stock limitado ya agregaste ${this.shoppingCart[i].cantidad}, solo puedes agregar ${this.shoppingCart[i].stock}, intentas agregar ${cantidad}`
                                }
                                nuevo = false
                            }

                        }
                        this.loadTotal()
                        if (nuevo) {
                            product.cantidad = this.cantidad
                            this.$set(this.shoppingCart, Object.keys(this.shoppingCart).length, product)
                        }
                    }
                } else {
                    this.modal = "No hay suficiente stock"
                }
            } else {
                this.modal = "La cantidad de productos a agregar debe se mayor a 0"
            }
            this.loadTotal()
        },
        loadTotal() {
            let total = 0
            let porcentaje = parseFloat(`0.${this.descuento}`)
            for (let i = 0; i < Object.keys(this.shoppingCart).length; i++) {
                total += this.shoppingCart[i].precio_unitario * this.shoppingCart[i].cantidad
            }
            porcentaje = total * porcentaje;
            this.total = total - porcentaje
        },
        finailizarCompra() {
            let url = '../api/facturar.php'
            let data = {
                total: this.total,
                descuento: this.descuento,
                productos: this.shoppingCart
            }
            if (Object.keys(this.shoppingCart).length > 0) {
                fetch(url, {
                    method: "POST",
                    headers: {
                        'Accept': 'application/json, text/plain, */*',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(response => response.json())
                    .then(result => {
                        if (result.status == 200) {
                            this.shoppingCart = {}
                            this.product = {}
                            this.formFacturar = false
                            this.loadTotal()
                            this.response = "Se ha registrado correctamente"
                        } else if (result.status == 500) {
                            this.response = "Vuelve a intentarlo"
                        }
                    }).catch(response => {
                        console.log(response);
                    })
            } else {
                this.response = "Tienes que agregar productos para poder continuar"
            }
        },
        nuevaCompra() {
            this.cambio = false
            this.modal = false
            this.formFacturar = true
        }
    },
    template: `
    <div>
    <div class="modal d-block" tabindex="-1" v-if="cambio" style="background:#0d6efd33">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalizar Venta</h5>  
                </div>
                <div class="modal-body">
                    <div v-if="formFacturar">
                        <div class="form-group">
                            <label for="">Efectivo</label>
                            <input v-model="efectivo" type="text" class="form-control rounded" placeholder="dinero con el que paga el cliente" />
                        </div>
                        <div class="">
                            <p>Total a pagar: $ {{total}}</p>
                            <p>Cambio: $ {{(efectivo - total)>0?efectivo - total:0}}</p>
                            <p>Descuento: {{descuento}} %</p>
                            <p>{{response}}</p>
                        </div>
                    </div>
                    <div v-else>
                        {{response}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div v-if="formFacturar">
                        <button type="button" @click="cambio=false" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" @click="finailizarCompra" class="btn btn-primary" data-dismiss="modal">Continuar</button>
                    </div>
                    <div v-else>
                        <button type="button" @click="nuevaCompra" class="btn btn-primary" data-dismiss="modal">Seguir facturando</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal d-block" tabindex="-1" v-if="modal" style="background:#0d6efd33">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Advertencia</h5>
                    
                </div>
                <div class="modal-body">
                    <p>{{modal}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="modal = false" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Caja</h1>
    </div>

    <div class="pb-4">
    <label for="">Buscar producto</label>
        <div class="input-group">
            <input v-model="search" @keyup="searchProduct" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
            aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary">buscar</button>
        </div>
        <div class="form-group">
            <label for="">Descuento en %</label>
            <input @blur="loadTotal" v-model="descuento" type="text" class="form-control rounded" placeholder="descuento %" />
        </div>
        <div class="form-group pt-1">
            <button class="btn btn-primary col-12" @click="cambio=true">Generar factura</button>
        </div>
    </div>
    <div>
        <h2>Agregar producto</h2>
        <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Precio Unidad</th>
                    <th>Cantidad disponible</th>
                    <th>Cantidad a agregar</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" :key="product.id_producto">
                    <td>{{product.id_producto}}</td>
                    <td>{{product.nombre}}</td>
                    <td>$ {{product.precio_unitario}}</td>
                    <td>{{product.stock}}</td>
                    <td><input v-model="cantidad" type="number" name="number"  class="form-control" placeholder="Cantidad"></td>
                    <td><button @click="addCart(product, index)" type="button" class="btn btn-primary">Agregar</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>

    <div class="table-responsive" v-if="Object.keys(this.shoppingCart).length>0">
    <h2>Productos agregados</h2>
    {{total}}
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Precio Unidad</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product,index) in shoppingCart">
                    <td>{{product.id_producto}}</td>
                    <td>{{product.nombre}}</td>
                    <td>$ {{product.precio_unitario}}</td>
                    <td>{{product.cantidad}}</td>
                    <td>$ {{product.cantidad * product.precio_unitario}}</td>
                    <td><button class="btn btn-secondary" @click="deletToCart(index)">Quitar roducto</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>
    `
})

Vue.component('component-productos', {
    props: ['admin'],
    data() {
        return {
            api: '../api/',
            categorias: {},
            idCategoria: 1,
            productos: {},
            loading: true
        }
    },
    methods: {
        getCategorias() {
            url = this.api + 'categorias'
            fetch(url).then(response => response.json())
                .then(result => {
                    this.categorias = result
                    this.getProductos()
                })
        },
        getProductos() {
            this.loading = true
            url = this.api + 'productos/' + this.idCategoria
            fetch(url).then(response => response.json())
                .then(result => {
                    this.productos = result
                    this.loading = false;
                })
            console.log(Object.keys(this.productos).length);

        },
        deleteProduct(id) {
            this.$emit('delete-product', id)
            this.loading = true
            this.getCategorias()
            this.getProductos()
        }
    },
    created() {
        this.getCategorias()
    },
    template: `
<div class="col-12">
    <div class="row">
        <h4>Traer productos</h4>
        <div class="mt-2">
            <label for="">Seleccionar bodega</label>
            <select name="" id="" class="form-select" v-on:change="getProductos()" v-model="idCategoria">
                <option disabled select>Seleccionar</option>
                <option v-for="categoria in categorias" v-bind:key="categoria.id" :value="categoria.id">{{categoria.nombre}}</option>
            </select>
      </div>
    </div>
    <div v-for="categoria in categorias" v-bind:key="categoria.id">
        <p v-if="categoria.id == idCategoria" class="p-2">
            {{categoria.descripcion}}
        </p>
    </div>
    <div>
        <div class="">
            <h3>Productos en bodega</h3>
            <div class="text-center" v-if="loading">
                <div class="spinner-border text-success" role="status">
                    <button class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="table-responsive" v-if='Object.keys(this.productos).length > 0'>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lote</th>
                            <th>Nombre</th>
                            <th>Precio Unidad</th>
                            <th>Cantidad</th>
                            <th>Fecha de vencimiento</th>
                            <th>Total</th>
                            <th v-if="admin == 'true' ">Editar</th>
                            <th v-if="admin == 'true' ">Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(producto, index) in productos" v-bind:key="index" v-if="producto.estado != 0">
                            <td>{{index}}</td>
                            <td>{{producto.lote}}</td>
                            <td>{{producto.nombre}}</td>
                            <td>{{producto.precio_unitario}}</td>
                            <td>{{producto.stock}}</td>
                            <td>{{producto.fecha_vencimiento}}</td>
                            <td>$ {{producto.precio_unitario * producto.stock}}</td>
                            <td v-if="admin == 'true' "><a :href="'editarProducto.php?id='+producto.id_producto">Editar</a></td>
                            <td v-if="admin == 'true' ">
                                <span class="material-icons btn" v-on:click="deleteProduct(producto.id_producto)">
                                  delete
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-center" v-else-if="loading == false"> 
                <p>No tienes productos en esta bodega</p>
            </div>
        </div>
    </div> 
</div>
`,
})

new Vue({
    el: "#app",
    data: {
        facturas: {},
        factura: false,
        detallesFactura: {},
        facturaActiva: {}
    },
    methods: {
        eliminarBodega(e) {
            let action = confirm('Si eliminas la bodega, eliminas todos los productos que están en ella.¿deseas continuar? ')
            if (action == false) {
                e.preventDefault()
            }
        },
        deleteProduct(id) {
            console.log(id);
            url = `../api/productos.php?id_producto=${id}`
            fetch(url, {
                method: "POST",
                Headers: {
                    'Content-Type': 'application/json',
                }
            }).then(response => {
                console.log(response);
            }).catch(response => {
                console.log(response);
            })
        },
        cargarFactura() {
            let url = '../api/facturas/';
            fetch(url).then(response => response.json())
                .then(result => {
                    this.facturas = result
                })
        },
        mostrarFactura(factura) {
            let url = '../api/facturas/' + factura.id_factura;
            this.factura = true
            this.facturaActiva = factura
            fetch(url).then(response => response.json())
                .then(result => {

                    this.detallesFactura = result
                    console.log(this.detallesFactura);
                })
        }
    },
    filters: {
        diaFacturacion: function (value) {
            const event = new Date(value);
            const options = { month: 'long', year: 'numeric', day: 'numeric' };
            let date = event.toLocaleDateString('es', options).replace(/ de /g, '/')
            return date;
        },
        horaFacturacion: function (value) {
            const event = new Date(value);
            const time = event.toLocaleTimeString('en-US');
            return time
        },
        moneyFormat: function (value) {
            return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'COP' }).format(value);
        }
    },
    created() {
        this.cargarFactura()
    }
})
