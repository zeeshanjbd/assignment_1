<template>
    <div> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link :to="{name : 'listing'}" class="navbar-brand" >Home</router-link>
                 
                 
                <div class="collapse navbar-collapse" id="navbarSupportedContent">  
                    <router-link :to="{name : 'product_add'}"  class="btn btn-outline-success" >Add Product</router-link>
                     
                </div>
            </div>
        </nav> 

        <div class="container  mt-3 mb-4 pr-4 pl-4">  
            <router-view></router-view> 
        </div> 
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

