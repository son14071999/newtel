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
                        <input type="text" class="form-control" id="code" ng-model="data.roleInfo.code"
                            value="@{{ data.roleInfo.code }}">
                    </div>
                    <div class="form-group">
                        <label for="name_display" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name_display" ng-model="data.roleInfo.name"
                            value="@{{ data.roleInfo.name }}">
                    </div>
                    <div style="margin-top: 7px;"><span>Chọn permission: </span></div>
                    <div class="form-group"
                        style="width: 100%; min-height: 150px; overflow: auto;margin-top: 5px; margin-left: 10px">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" ng-change="searchPermit()" ng-model="data.permitSearch">
                        </div>
                        <div ng-repeat="parentPermit in data.listPermit">
                            <input type="checkbox" id="chk_@{{ parentPermit.code }}" ng-value="parentPermit.code" ng-click="parentClick($index)" ng-checked="parentPermit.checked">
                            <label for="chk_@{{ parentPermit.code }}">@{{ parentPermit.display_name }}</label>
                            <br>
                            <div ng-repeat="permit in parentPermit.child_permit" class="childPermission">
                                <input type="checkbox" id="chk_@{{ permit.code }}" ng-value="permit.code" ng-checked="permit.checked" ng-click="childClick($parent.$index,$index)">
                                <label for="chk_@{{ permit.code }}">@{{ permit.display_name }}</label><br>
                            </div>
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
