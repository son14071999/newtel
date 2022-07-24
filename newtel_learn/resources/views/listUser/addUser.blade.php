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
                    <input type="text" class="form-control" id="name" ng-model="data.userAdd.name"
                        value="@{{data.userAdd.name}}">
                </div>
                <div class="form-group">
                    <label for="email-name" class="col-form-label">email</label>
                    <input type="text" class="form-control" id="email-name" ng-model="data.userAdd.email"
                        value="@{{data.userAdd.email}}">
                </div>
                <div class="form-group">
                    <label for="password-text" class="col-form-label">password:</label>
                    <input type="password" class="form-control" id="name-text" ng-model="data.userAdd.password"
                        value="@{{data.userAdd.password}}">
                </div>
                <div class="form-group">
                    <label for="password-text" class="col-form-label">Role:</label>
                    <select class="form-select" name="role" id="role" ng-model="data.userAdd.role_id" aria-label="Chọn role">
                        <option ng-repeat="role in data.roles" value="@{{role.id}}">@{{role.name}}</option>
                      </select>
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
