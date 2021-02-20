

Vue.component('component-store', {
    data() {
        return {
            carrito: {},
            shoppingCart: [],
            products: {},
            search: '',
            cantidad: 0,
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
        addCart(product, index) {
            if (this.cantidad <= (product.stock * 1)) {
                product.cantidad = this.cantidad
                this.shoppingCart.push(product)
                this.products[index].stock = this.products[index].stock - this.cantidad
            }
            console.log(this.products);
        }
    },
    template: `
<div>
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

    <h2>Productos agregados</h2>
    <div class="table-responsive">
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
                <tr v-for="product in shoppingCart">
                    <td>{{product.id_producto}}</td>
                    <td>{{product.nombre}}</td>
                    <td>$ {{product.precio_unitario}}</td>
                    <td>{{product.cantidad}}</td>
                    <td>$ {{product.cantidad * product.precio_unitario}}</td>
                    <td>$ remove</td>
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
        },
        deleteProduct(id) {
            this.$emit('delete-product', id)
            this.loading = true
            this.getCategorias()
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
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="table-responsive" v-if='productos.length > 0'>
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
                            <td v-if="admin == 'true' "><a href="#">Editar</a></td>
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
        message: 'hello world'
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
        }
    }
}) 