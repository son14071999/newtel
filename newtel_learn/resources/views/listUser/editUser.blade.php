<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="email-name" class="col-form-label">email</label>
                        <input type="text" class="form-control" id="email-name" ng-model="data.userEdit.email"
                            value="@{{ data.userEdit.email }}">
                    </div>
                    <div class="form-group">
                        <label for="name-text" class="col-form-label">name:</label>
                        <input type="text" class="form-control" id="name-text" ng-model="data.userEdit.name"
                            value="@{{ data.userEdit.name }}">
                    </div>
                    <div class="form-group">
                        <label for="password-text" class="col-form-label">Role:</label>
                        <select name="role" class="form-select" id="role" ng-model="data.userEdit.role_id"
                            aria-label="Chọn role">
                            <option ng-repeat="role in data.roles" ng-value="@{{ role.id }}"
                                ng-selected="role.selected">@{{ role.name }}</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="saveEditUser()">Save</button>
            </div>
        </div>
    </div>
</div>
