<style>
.widget-user-header{
    background-position: center center;
    background-size:cover;
    height: 400px !important;
}
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/background.jpg')">
                <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                <h5 class="widget-user-desc text-right">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
        </div>



    <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>

                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                        <h2>Dashboard</h2>
                  </div>


                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" v-model="form.email"  class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                          <input type="text" v-model="form.type" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" v-model="form.bio" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>

                         <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="text" v-model="form.password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                      </div>



                    <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photos</label>
                        <div class="col-sm-12">
                          <input type="file"  @change="updateImage" class="form-input" id="photo" name="photo">
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-success edit-btn">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>



    </div>
</template>

<script>
    export default {
      data(){

           return{

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
        methods:{
            updateInfo(){
                this.form.put('api/profile/')
                .then(()=>{

                })
                .catch(()=>{

                })

            },
            updateImage(e){
                let file = e.target.files[0];
        // console.log(file);
      let reader = new FileReader();
    //   reader.onloadend = function(){
    //     //   console.log('RESULT', reader.result)
    //   }
    //   reader.readAsDataURL(file);
      if (file["size"] < 2111775) {
        reader.onloadend = file => {
          // console.log("RESULT", reader.result);
          this.form.photo = reader.result;
        };

        reader.readAsDataURL(file);
      } else {
        swal.fire("Oops...", "File size is more then 2 MB", "error");
      }

            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            // axios.get("api/profile").then(( {data} ) => (this.form.fill(data)));
            axios.get("api/profile").then(({ data }) => this.form.fill(data));

        }
    }
</script>
