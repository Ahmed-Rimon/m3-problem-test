<template>
    <div class="container">
         <div class="row mt-5" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Info Table</h3>

                <div class="card-tools">
                        <button class="btn btn-primary view-btn " @click="productModal">Add Products <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">

                    <tr >
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Type</th>
                      <th>Register Id</th>
                      <th>Total Bit placed</th>

                      <th>Image</th>
                      <th>Expired</th>
                      <th>Modify</th>
                    </tr>



                    <tr v-for="productt in products" :key="productt.id" >

                      <td>{{productt.id}}</td>
                      <td>{{productt.name}}</td>
                      <td>{{productt.Price}}</td>

                      <td>{{productt.type |upText}}</td>
                      <td>{{productt.created_at | newDate}}</td>
                      <td>{{productt.bit_placed}}</td>
                      <td>{{productt.Higest-Price}}</td>
                      <td>{{productt.Image}}</td>
                        <td>{{productt.task_date}}</td>
                      <td>
                        <a href="#" class="btn btn-success edit-btn" @click="editProducts(productt)"><i class="fas fa-edit"></i></a>
                        /
                        <a href="#" class="btn btn-danger delete-btn" @click="deleteProducts(productt.id)"><i class="fa fa-trash" aria-hidden="true"></i></a>

                      </td>
                    </tr>



                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


     <!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="AddNewProducts" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
               <h5 class="modal-title" v-show="!editmode" id="AddNewUsers"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Add User info</h5>
        <h5 class="modal-title" v-show="editmode" id="AddNewUsers"><i class="fa fa-user-secret fa-fw" aria-hidden="true"></i> Edit User</h5>


        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="editmode ? updateproducts() : createProduct()">

      <div class="modal-body">

         <div class="form-group">

      <input v-model="form.name" type="text" name="name" id="product_name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="User Name">
      <has-error :form="form" field="name"></has-error>
    </div>
    <div class="form-group">

         <input v-model="form.Price" type="number" name="price" id="price"
        class="form-control" :class="{ 'is-invalid': form.errors.has('Price') }" placeholder="Price">
      <has-error :form="form" field="Price"></has-error>
    </div>

    <div class="form-group">

      <textarea v-model="form.bio" type="text" name="bio" id="bio"
        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" placeholder="Write About you"></textarea>
      <has-error :form="form" field="bio"></has-error>
    </div>

 <div class="form-group">

      <input v-model="form.task_date" type="date" name="task_date" id="task_date"
        class="form-control" :class="{ 'is-invalid': form.errors.has('task_date') }" >
      <has-error :form="form" field="task_date"></has-error>
    </div>


 <div class="form-group">

      <select v-model="form.type" type="text" name="type" id="type"
        class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
        <option value="">Select user role</option>
        <option value="Admin">Stone</option>
        <option value="User">Iron</option>
        <option value="Sellers">Diamond</option>
        </select>
      <has-error :form="form" field="type"></has-error>
    </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
        <button v-show="!editmode" type="submit" class="btn btn-primary">Create User</button>
      </div>
       </form>
    </div>
  </div>
</div>



    </div>
</template>

<script>
    export default {
        data(){

           return{
               editmode:false,
               products:{},
               form:new form({
                   id:'',
                   name: '',
                   Price: '',
                   task_date:'',
                   type: '',
                   Status: '',
                   bio: '',
                    photo: ''


               })
           }
        },
        methods:{
            editProducts(productt){
                 this.editmode = true;
        this.form.reset();
        $('#productModal').modal('show');
        this.form.fill(productt);
            },
            deleteProducts(id){
    swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

 if (result.value) {
                this.form.delete('api/products/'+id)
                .then(()=>{

                swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )

              loadPage.$emit('AfterCreated');
                })
                .catch(()=>{

this.$Progress.fail()
        toast.fire({
          icon: 'error',
          title: 'There is something wrong'
        })
                });
 }


            })
            },
            updateproducts(){
                this.$Progress.start();

        this.form.put('api/products/'+this.form.id)
        .then(()=>{
        $('#productModal').modal('hide');


        swal.fire(
                  'Updated!',
                  'User has been Updated.',
                  'success'
                )
                this.$Progress.finish();
              loadPage.$emit('AfterCreated');


        })
        .catch(()=>{
        this.$Progress.fail();
        toast.fire({
          icon: 'error',
          title: 'There is something wrong'
        })

        });
            },
            createProduct(){
                       this.$Progress.start();

        this.form.post('api/products')
        .then(()=>{
            loadPage.$emit('AfterCreated');

        $('#productModal').modal('hide');
            toast.fire({
          icon: 'success',
          title: 'User Created successfully'
        })

        this.$Progress.finish();
        })
        .catch(()=>{
            this.$Progress.fail()
        toast.fire({
          icon: 'error',
          title: 'There is something wrong'
        })
        });

            },

            productModal(){
                this.editmode = false;
        this.form.reset();
        $('#productModal').modal('show');
            },
            loadProducts(){
                axios.get("api/products").then(({data})=>(this.products = data.data));
            }
        },
        created(){
            this.loadProducts();
             loadPage.$on('AfterCreated', ()=> {
                this.loadProducts();
            });
        },
        mounted() {
            console.log('Component mounted.')
        }
    }


//     export default {

//         data(){

//            return{
//                editmode:false,
//                users:{},
//                form:new form({
//                    id:'',
//                    name: '',
//                    email: '',
//                    password: '',
//                    type: '',
//                    bio: '',
//                     photo: ''
//                })
//            }
//         },
// methods: {
//     updateUser(){
//         this.$Progress.start();

//         this.form.put('api/user/'+this.form.id)
//         .then(()=>{
//         $('#AddNew').modal('hide');


//         swal.fire(
//                   'Updated!',
//                   'User has been Updated.',
//                   'success'
//                 )
//                 this.$Progress.finish();
//               loadPage.$emit('AfterCreated');


//         })
//         .catch(()=>{
//         this.$Progress.fail();
//         toast.fire({
//           icon: 'error',
//           title: 'There is something wrong'
//         })

//         });
//     },
//     NewModal(){
//         this.editmode = false;
//         this.form.reset();
//         $('#AddNew').modal('show');



//     },
//     editModal(user){
//         this.editmode = true;
//         this.form.reset();
//         $('#AddNew').modal('show');
//         this.form.fill(user);


//     },
//     deleteUser(id){

//             swal.fire({
//               title: 'Are you sure?',
//               text: "You won't be able to revert this!",
//               icon: 'warning',
//               showCancelButton: true,
//               confirmButtonColor: '#3085d6',
//               cancelButtonColor: '#d33',
//               confirmButtonText: 'Yes, delete it!'
//             }).then((result) => {

//  if (result.value) {
//                 this.form.delete('api/user/'+id)
//                 .then(()=>{

//                 swal.fire(
//                   'Deleted!',
//                   'Your file has been deleted.',
//                   'success'
//                 )

//               loadPage.$emit('AfterCreated');
//                 })
//                 .catch(()=>{

// this.$Progress.fail()
//         toast.fire({
//           icon: 'error',
//           title: 'There is something wrong'
//         })
//                 });
//  }


//             })
//     },
//     createUser(){
//         this.$Progress.start();

//         this.form.post('api/user')
//         .then(()=>{
//             loadPage.$emit('AfterCreated');

//         $('#AddNew').modal('hide');
//             toast.fire({
//           icon: 'success',
//           title: 'User Created successfully'
//         })

//         this.$Progress.finish();
//         })
//         .catch(()=>{
//             this.$Progress.fail()
//         toast.fire({
//           icon: 'error',
//           title: 'There is something wrong'
//         })
//         });
//     },

//     loadUsers(){

//         axios.get("api/user").then(({data})=>(this.users = data.data));
//     }
// },
//         created() {
//             this.loadUsers();
//             // setInterval(()=> this.loadUsers(),3000);
//             loadPage.$on('AfterCreated', ()=> {
//                 this.loadUsers();
//             });

//         }
//     }
</script>
