<div class="modal fade" id="formRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@{{title}}</h5>
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
                        <div ng-repeat="(parentCode, parentPermit) in data.listPermit">
                            <input type="checkbox" id="chk_@{{ parentCode }}" ng-checked="parentPermit.checked" ng-model="data.listPermit[parentCode].checked" ng-change="action.toggleParentPermit(parentCode)">
                            <label for="chk_@{{ parentCode }}">@{{ parentPermit.display_name }}</label>
                            <br>
                            <div ng-repeat="(permitCode, permit) in parentPermit.child_permit" class="childPermission">
                                <input type="checkbox" id="chk_@{{ permitCode }}" ng-checked="permit.checked" ng-model="data.listPermit[parentCode].child_permit[permitCode].checked">
                                <label for="chk_@{{ permitCode }}">@{{ permit.display_name }}</label><br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="saveRole()">Save</button>
            </div>
        </div>
    </div>
</div>