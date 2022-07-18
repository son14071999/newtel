<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="name" class="col-form-label">name</label>
                    <input type="text" class="form-control" id="name" ng-model="userAdd.name"
                        value="@{{userAdd.name}}">
                </div>
                <div class="form-group">
                    <label for="email-name" class="col-form-label">email</label>
                    <input type="text" class="form-control" id="email-name" ng-model="userAdd.email111213232"
                        value="@{{userAdd.email213213}}">
                </div>
                <div class="form-group">
                    <label for="password-text" class="col-form-label">password:</label>
                    <input type="password" class="form-control" id="name-text" ng-model="userAdd.password"
                        value="@{{userAdd.password}}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-click="saveAddUser()">Save</button>
        </div>
    </div>
</div>
</div>