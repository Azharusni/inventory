<template>
    <div>
        <div class="row">
            <router-link to="/employee" class="btn btn-primary">All Employee</router-link>
        </div>
<div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                  </div>
                  <form class="user" @submit.prevent="employeeInsert" enctype="multipart/form-data">
                    <div class="form-group">

                         <div class="form-row">

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Full Name" v-model="form.name">
                                 <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" id="exampleInputFirstName" placeholder="Enter Email" v-model="form.email"> <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                            </div>
                        </div>



                    </div>

                    <div class="form-group">
                         <div class="form-row">

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Address" v-model="form.address">
                                 <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Sallery" v-model="form.sallery">
                                <small class="text-danger" v-if="errors.sallery">{{errors.sallery[0]}}</small>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                         <div class="form-row">

                            <div class="col-md-6">
                                <input type="date" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Joining Date" v-model="form.joining_date">
                                <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date[0]}}</small>
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your NID" v-model="form.nid">
                                <small class="text-danger" v-if="errors.nid">{{errors.nid[0]}}</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                         <div class="form-row">

                            <div class="col-md-6">
                                <input type="number" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Phone Number" v-model="form.phone">
                                <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                            </div>

                            <div class="col-md-6">

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                         <div class="form-row">

                            <div class="col-md-6">
                                <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>

                            <div class="col-md-6">
                                <img :src="form.photo" style="height:40px; width:40px;" alt="">
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <hr>

                  </form>
                  <hr>

                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
    data(){
        return {
            form:{
                name:null,
                email:null,
                phone:null,
                sallary:null,
                address:null,
                photo:null,
                nid:null,
                joining_date:null
            },
            errors:{}
        }
    },

    methods: {
        onFileSelected(event){
            let file = event.target.files[0];
            if(file.size >1048770){
                Notification.image_validation()
            }else{
                let reader = new FileReader();
                reader.onload = event=>{
                    this.form.photo = event.target.result
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        employeeInsert(){
            axios.post('/api/employee',this.form)
            .then(()=>{
                this.$router.push({name:'employee'})
                Notification.success()
            })
            .catch(error=>this.errors = error.response.data.errors)
//             .catch(function (error) {
//     if (error.response) {
//       // The request was made and the server responded with a status code
//       // that falls out of the range of 2xx
//       console.log(error.response.data);
//       console.log(error.response.status);
//       console.log(error.response.headers);
//       alert('data tidak bisa disimpan di server')
//     } else if (error.request) {
//       // The request was made but no response was received
//       // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
//       // http.ClientRequest in node.js
//       console.log(error.request);
//     } else {
//       // Something happened in setting up the request that triggered an Error
//       console.log('Error', error.message);
//     }
//     console.log(error.config);
//   });
        },
    }
}

</script>

<style type="text/css">

</style>
