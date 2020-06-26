<template>
    <div class="container">



        <div class="row mt-5" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Info Table</h3>

                <div class="card-tools">
                        <button class="btn btn-primary view-btn " @click="NewModal">Add new <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">

                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Register At</th>
                      <th>Modify</th>
                    </tr>



                    <tr v-for="user in users" :key="user.id" >

                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>

                      <td>{{user.type |upText}}</td>
                        <td>{{user.created_at | newDate}}</td>
                      <td>
                        <a href="#" class="btn btn-success edit-btn" @click="editModal(user)"><i class="fas fa-edit"></i></a>
                        /
                        <a href="#" class="btn btn-danger delete-btn" @click="deleteUser(user.id)"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
<div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="AddNewUsers" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-show="!editmode" id="AddNewUsers"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Add User info</h5>
        <h5 class="modal-title" v-show="editmode" id="AddNewUsers"><i class="fa fa-user-secret fa-fw" aria-hidden="true"></i> Edit User</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent=" editmode ? updateUser() : createUser()">
      <div class="modal-body">

         <div class="form-group">

      <input v-model="form.name" type="text" name="name" id="name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="User Name">
      <has-error :form="form" field="name"></has-error>
    </div>

        <div class="form-group">

      <input v-model="form.email" type="email" email="email" id="email"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" placeholder="Email">
      <has-error :form="form" field="email"></has-error>
    </div>

    <div class="form-group">

      <textarea v-model="form.bio" type="text" name="bio" id="bio"
        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" placeholder="Write About you"></textarea>
      <has-error :form="form" field="bio"></has-error>
    </div>

 <div class="form-group">

      <select v-model="form.type" type="text" name="type" id="type"
        class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
        <option value="">Select user role</option>
        <option value="Admin">Admin</option>
        <option value="User">User</option>
        <option value="Sellers">Sellers</option>
        </select>
      <has-error :form="form" field="type"></has-error>
    </div>

 <div class="form-group">

      <input v-show="!editmode" v-model="form.password" type="password" name="password" id="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="Password">
         <input v-show="editmode" v-model="form.password" type="password" name="password" id="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="Password" disabled>
      <has-error :form="form" field="password"></has-error>
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
               users:{},
               form:new form({
                   id:'',
                   name: '',
                   email: '',
                   password: '',
                   type: '',
                   bio: '',
                    photo: ''
               })
           }
        },
methods: {
    updateUser(){
        this.$Progress.start();

        this.form.put('api/user/'+this.form.id)
        .then(()=>{
        $('#AddNew').modal('hide');


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
    NewModal(){
        this.editmode = false;
        this.form.reset();
        $('#AddNew').modal('show');



    },
    editModal(user){
        this.editmode = true;
        this.form.reset();
        $('#AddNew').modal('show');
        this.form.fill(user);


    },
    deleteUser(id){

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
                this.form.delete('api/user/'+id)
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
    createUser(){
        this.$Progress.start();

        this.form.post('api/user')
        .then(()=>{
            loadPage.$emit('AfterCreated');

        $('#AddNew').modal('hide');
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

    loadUsers(){

        axios.get("api/user").then(({data})=>(this.users = data.data));
    }
},
        created() {
            this.loadUsers();
            // setInterval(()=> this.loadUsers(),3000);
            loadPage.$on('AfterCreated', ()=> {
                this.loadUsers();
            });

        }
    }
</script>
