<template>
    <div>
            <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
          </div>

          <div class="row mb-3">




            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                  <a class="btn tbn-sm btn-info"><font color="ffffff">Add Customer</font></a>

                </div>


                            <div class="table-responsive" style="font-size:12px;">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="pro in carts" :key="pro.id">
                                    <td>{{pro.pro_name}}</td>
                                    <td><input type="text" readonly="" :value="pro.pro_quantity" style="width:30px;">
                                    <button @click.prevent="increment(pro.id)" class="btn btn-sm btn-success">+</button>
                                    <button @click.prevent="decrement(pro.id)"class="btn btn-sm btn-danger" v-if="pro.pro_quantity >=2">-</button>
                                    <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>
                                    </td>
                                    <td>{{pro.product_price}}</td>
                                    <td>{{pro.sub_total}}</td>
                                    <td><a @click="removeItem(pro.id)" class="btn btn-sm btn-primary"><font color="ffffff">X</font></a></td>
                                </tr>


                                </tbody>
                            </table>
                            </div>
                            <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity: <strong>50</strong></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total: <strong>560 $</strong></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Vat: <strong>35 %</strong></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total : <strong>5060 $</strong></li>
                            </ul>
                            <br>

                            <form >
                                <label for="">Customer Name</label>
                                <select class="form-control" v-model="customer_id" name="" id="">
                                    <option v-for="customer in customers">{{customer.name}}</option>

                                </select>
                                <label for="">Pay</label>
                                <input type="text" name="" class="form-control" required="" id="" v-model="pay">
                                <label for="">Due</label>
                                <input type="text" name="" class="form-control" required="" id="" v-model="due">

                                <label for="">Pay By</label>
                                <select class="form-control" v-model="customer_id" name="" id="">
                                    <option value="Handcash">Hand Cash</option>
                                    <option value="Cheaque">Cheaque</option>
                                    <option value="Giftcard">Gift Card</option>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                            </div>

              </div>
            </div>
            <!-- Pie Chart -->


            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                </div>

        <!-- Category wise product -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" >
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Product</a>
                        </li>


                        <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" @click="subproduct(category.id)">{{category.category_name}}</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body">
                                <input type="text" class="form-control" style="width:500px;" v-model="searchTerm" placeholder="search product">

                                <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch" :key="product.id">
                                        <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                                        <div class="card" style="width: 8rem; margin-bottom:5px;">
                                        <img :src="product.image" id="em_photo" class="card-img-top">
                                        <div class="card-body">
                                            <h6 class="card-title">{{product.product_name}}</h6>
                                        <span class="badge badge-success" v-if="product.product_quantity >=1" >Available {{product.product_quantity}}</span>
                                        <span class="badge badge-danger" v-else="" >Stock Out</span>


                                        </div>
                                        </div></button>

                                    </div>
                            </div>

                         </div>
                        </div> <!-- End TABS HOME-->

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                             <input type="text" class="form-control" style="width:500px;" v-model="getsearchTerm" placeholder="search product">

                                <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfilterSearch" :key="getproduct.id">
                                        <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)">
                                        <div class="card" style="width: 8.6rem; margin-bottom:5px;">
                                        <img :src="getproduct.image" id="em_photo" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{getproduct.product_name}}</h5>
                                        <span class="badge badge-success" v-if="getproduct.product_quantity >=1" >Available {{getproduct.product_quantity}}</span>
                                        <span class="badge badge-danger" v-else="" >Stock Out</span>


                                        </div>
                                        </div></button>

                                    </div>
                                    </div>

                        </div>

                    </div>
        <!-- End Of Category wise product -->


              </div>
            </div>

          </div>
          <!--Row-->



        </div>

    </div>


</template>

<script type="text/javascript">

export default{
    created(){
        if(!User.loggedIn()){
            this.$router.push({name:'/'})
        }

    },
    mounted(){
        this.cartProduct();
        Reload.$on('AfterAdd',()=>{
            this.cartProduct();
        })
    },

     created(){
        this.allProduct();
        this.allCategory();
        this.allCustomer();


    },

    data(){
        return{
            products:[],
            categories:[],
            getproducts:[],
            searchTerm:'',
            getsearchTerm:'',
            customers:'',
            errors:'',
            carts:[]
        }
    },
    computed:{
      filterSearch(){
        return this.products.filter(product=>{
          return product.product_name.match(this.searchTerm)

        })
      },
      getfilterSearch(){
        return this.getproducts.filter(getproduct=>{
          return getproduct.product_name.match(this.getsearchTerm)

        })
      },
    },

    methods: {

        AddToCart(id){
           axios.get('/api/addToCart/'+id)
            .then(()=>{
                Reload.$emit('AfterAdd')
                Notification.cart_success()
            })
            .catch()
        },

         cartProduct(){
            axios.get('/api/cart/product/')
            .then(({data})=>(this.carts = data))
            .catch()
        },

        removeItem(id){
            axios.get('/api/remove/cart/'+id)
            .then(()=>{
                Reload.$emit('AfterAdd')
                Notification.cart_delete()
            })
            .catch()
        },

        increment(id){
            axios.get('/api/increment/'+id)
            .then(()=>{
                Reload.$emit('AfterAdd')
                Notification.success()
            })
            .catch()
        },

         decrement(id){
            axios.get('/api/decrement/'+id)
            .then(()=>{
                Reload.$emit('AfterAdd')
                Notification.success()
            })
            .catch()
        },

        allProduct(){
            axios.get('/api/product/')
            .then(({data})=>(this.products = data))
            .catch()
        },
        allCategory(){
            axios.get('/api/category/')
            .then(({data})=>(this.categories = data))
            .catch()
        },
        allCustomer(){
            axios.get('/api/customer/')
            .then(({data})=>(this.customers = data))
            .catch(console.log(error))
        },
        subproduct(id){
            axios.get('/api/getting/product/'+id)
            .then(({data})=>(this.getproducts = data))
            .catch()
        },


    },


}

</script>

<style type="text/css" scoped>
#em_photo{
    height: 100px;
    width: 120px;;
}
</style>
