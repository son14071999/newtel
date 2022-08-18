<div class="modal fade" id="formUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="email-name" class="col-form-label">email</label>
                        <input type="text" class="form-control" id="email-name" ng-model="data.userInfo.email"
                            value="@{{ data.userInfo.email }}">
                    </div>
                    <div class="form-group">
                        <label for="name-text" class="col-form-label">name:</label>
                        <input type="text" class="form-control" id="name-text" ng-model="data.userInfo.name"
                            value="@{{ data.userInfo.name }}">
                    </div>


                    <div class="form-group"
                        style="width: 100%; min-height: 150px; overflow: auto;margin-top: 5px; margin-left: 10px">
            
                        <div ng-repeat="(roleId, role) in data.roles">
                            <input type="checkbox" id="chk_@{{ roleId }}" ng-checked="role.checked" ng-model="data.roles[roleId].checked" >
                            <label for="chk_@{{ roleId }}">@{{ role.name }}</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-text" class="col-form-label">Department:</label>
                        <select name="role" class="form-select" id="role" ng-model="data.userInfo.department_id"
                            aria-label="Chọn department">
                            <option value="0">--Chọn department--</option>
                            <option ng-repeat="department in data.departments" ng-value="@{{ department.id }}"
                                ng-selected="department.selected" style="height: 60px">
                                    <div>@{{department.name}}</div>
                                    <div>(@{{department.pathName}})</div>
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="saveUser()">Save</button>
            </div>
        </div>
    </div>
</div>