import VueRouter from "vue-router";
 

import ProductListing from './components/product/ProductListing';
import ProductAdd from './components/product/ProductAdd';
import ProductEdit from './components/product/ProductEdit';

const routes = [ 
	{
		path: "/",
		component: ProductListing,
		name: "listing",
	},
	{
		path: "/add",
		component: ProductAdd,
		name: "product_add",
	},
	{
		path: "/edit/:id",
		component: ProductEdit,
		name: "product_edit",
	} 
];


const router = new VueRouter({
	routes,
	mode: "history"
});


export default router;