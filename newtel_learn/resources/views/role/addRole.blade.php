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
                            value="@{{ roleAdd.code }}">
                    </div>
                    <div class="form-group">
                        <label for="name_display" class="col-form-label">Name: </label>
                        <input type="text" class="form-control" id="name_display" ng-model="roleAdd.name"
                            value="@{{ roleAdd.name }}">
                    </div>

                    <div style="margin-top: 7px;"><span>Chọn permission: </span></div>
                    <div class="form-group"
                        style="width: 100%; min-height: 150px; overflow: auto;margin-top: 5px; margin-left: 10px">
                        <div ng-repeat="parent in parentPermits">
                            <input type="checkbox" name="parentPermits" ng-model="parent.checked"
                                value="@{{ parent.display_name }}" ng-click="parentClick($index)">
                            <label>@{{ parent.display_name }}</label><br>
                            <div ng-repeat="permit in parent.child_permit" class="childPermission">
                                <input type="checkbox" name="permitsOfRole" id="@{{ permit.id }}"
                                    value="@{{ permit.display_name }}" ng-model="permit.checked">
                                <label for="@{{ permit.code }}">@{{ permit.display_name }}</label><br>
                            </div>
                        </div>
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
