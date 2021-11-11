<template>
    <div >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of products <button  v-on:click="exportProducts" class="btn btn-primary">Export</button>  </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="loading">
                                    <tr>
                                        <td colspan="5">Data is loading...</td>
                                    </tr> 
                                </tbody>
                                <tbody v-else> 
                                    <tr v-for="(product,index) in products" :key="index">
                                        <td>{{product.id}}</td>
                                        <td>{{product.title}}</td>
                                        <td>{{product.description}}</td>
                                        <td>${{product.price}}</td>
                                        <td>
                                            <router-link :to="`/edit/${product.id}`"   class="btn btn-primary" >Edit</router-link>

                                            <a class="btn btn-danger" v-on:click="deleteProduct(product.id)" >Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                products: null,
                loading: true,
            };
        },
        methods: {
            
            deleteProduct(id)
            {
                const request = axios
                    .get('/api/delete_product/' + id)
                    .then(response => 
                    {  
                        if(response.data.success)
                        { 
                            const productsIndex = this.products.findIndex(p => p.id === id)
                            this.products.splice(productsIndex, 1);
                            alert(response.data.message);
                        }else {
                            alert(response.data.error);
                        } 
                    });
            },

            exportProducts()
            { 
                const response = axios
                        .get('/api/export_csv')
                        .then(response => 
                        {
                            const url = window.URL.createObjectURL(
                                new Blob([response.data], { type: "text/csv" })
                            );
                            const link = document.createElement("a");
                            link.href = url;
                            link.setAttribute("download", 'opportunities.csv');
                            document.body.appendChild(link);

                            link.click(); 
                        }); 

            }
        },
        created()
        {
            const request = axios
                .get('/api/get_products')
                .then(response => {
                    console.log(response.data.data)
                    this.products = response.data.data;
                    this.loading  = false;
                });
        }
    }
</script>
