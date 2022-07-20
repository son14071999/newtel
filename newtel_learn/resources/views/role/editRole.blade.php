<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="code" class="col-form-label">code</label>
                        <input type="text" class="form-control" id="code" ng-model="roleEdit.code"
                            value="@{{ roleEdit.code }}">
                    </div>
                    <div class="form-group">
                        <label for="name_display" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name_display" ng-model="roleEdit.name"
                            value="@{{ roleEdit.name }}">
                    </div>
                    <div class="form-group">
                        <div ng-repeat="permit in permits">
                            <input type="checkbox" name="permitsOfRole" id="@{{permit.code}}" value="@{{permit.display_name}}">
                            <label for="@{{permit.code}}">@{{permit.display_name}}</label><br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="saveEditRole()">Save</button>
            </div>
        </div>
    </div>
</div>
