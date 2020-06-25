<template>
    <div class="container">



        <div class="row mt-5" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Info Table</h3>

                <div class="card-tools">
                        <button class="btn btn-success edit-btn " data-toggle="modal" data-target="#AddNew">Add new <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i></button>
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
                        <a href="#" class="btn btn-success edit-btn"><i class="fas fa-edit"></i></a>
                        /
                        <a href="#" class="btn btn-danger delete-btn" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                        /
                        <a href="#" class="btn btn-primary view-btn"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
        <h5 class="modal-title" id="AddNewUsers">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="createUser">
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

      <input v-model="form.password" type="password" name="password" id="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="Password">
      <has-error :form="form" field="password"></has-error>
    </div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile01">
    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
  </div>
</div>


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create User</button>
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
               users:{},
               form:new form({
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
    createUser(){
        this.$Progress.start();
        this.form.post('api/user');
        this.$Progress.finish();


    },

    loadUsers(){
        axios.get("api/user").then(({data})=>(this.users = data.data));
    }
},
        created() {
            this.loadUsers();
        }
    }
</script>
