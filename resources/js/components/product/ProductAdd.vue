<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Add</div>

                    <div class="card-body">
                        <form  @submit.prevent="createProduct">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" v-model="title"  /> 
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description"  v-model="description" ></textarea> 
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Price</label>
                                <input type="number" step="any" v-model="price" class="form-control" id="price"  /> 
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
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
                title: null, 
                price: null, 
                description: null, 
            };
        },
        methods: {
            createProduct()
            {

                axios.post('/api/store',{ title: this.title, description: this.description, price: this.price, '_method': "POST" })
                .then((response)=>{  
                    if(response.data.success)
                    {
                        alert(response.data.message);
                    }else {
                        alert(response.data.error);
                    } 
                })
            }
        } 
    }
</script>
