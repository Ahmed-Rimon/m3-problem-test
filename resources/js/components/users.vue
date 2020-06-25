<template>
    <div class="container">



        <div class="row mt-5" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Info Table</h3>

                <div class="card-tools">
                        <button class="btn btn-success" data-toggle="modal" data-target="#AddNew">Add new <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Type</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>

                      <td><span class="tag tag-success">Approved</span></td>
                        <td>User</td>
                      <td>
                        <a href="#" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        /
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        /
                        <a href="#" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </td>
                    </tr>



                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>





            <!-- Modal -->
<div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="AddNewUsers" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddNewUsers">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
        }
    }
</script>
