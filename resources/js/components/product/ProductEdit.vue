<template>
    <div >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Edit</div>

                    <div class="card-body">
                        <form @submit.prevent="updateProduct">
                            <div v-if="loading">
                                <p>Data is loading...</p>
                            </div> 
                            <div v-else>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" v-model="product.title"  /> 
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description"  v-model="product.description"></textarea> 
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Price</label>
                                    <input type="number" step="any" class="form-control" id="price" v-model="product.price" /> 
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
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
                product: null,
                loading: true,
            };
        },
        methods: {
            updateProduct(){

                axios.post(`/api/update/${this.$route.params.id}`,{ title: this.product.title, description :this.product.description, price: this.product.price, '_method': "put" })
                .then((response)=>{  
                    if(response.data.success)
                    {
                        alert(response.data.message);
                    }else {
                        alert(response.data.error);
                    } 
                })
            }
        },
        created()
        {
            const request = axios
                .get(`/api/get_product/${this.$route.params.id}`)
                .then(response => {
                    console.log(response.data.data)
                    this.product = response.data.data;
                    this.loading  = false;
                });
        }
    }
</script>
