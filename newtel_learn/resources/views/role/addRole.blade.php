<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="code" class="col-form-label">Code</label>
                    <input type="text" class="form-control" id="code" ng-model="roleAdd.code"
                        value="@{{roleAdd.code}}">
                </div>
                <div class="form-group">
                    <label for="name_display" class="col-form-label">Name: </label>
                    <input type="text" class="form-control" id="name_display" ng-model="roleAdd.name"
                        value="@{{roleAdd.name}}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-click="saveAddRole()">Save</button>
        </div>
    </div>
</div>
</div>