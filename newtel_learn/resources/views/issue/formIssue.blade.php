<div class="modal fade" id="formIssueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@{{ title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Tên nhiệm vụ: </label>
                        <input type="text" class="form-control" id="name" ng-model="data.issueInfo.name">
                    </div>

                    <div class="form-group">
                        <label for="descripttion" class="col-form-label">Tên nhiệm vụ: </label>
                        <textarea id="descripttion" rows="4" cols="50" ng-model="data.issueInfo.descripttion">
                            Mô tả công việc
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-form-label">Người thực hiện: </label>
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

                    <div style="margin-top: 7px;"><span>Chọn permission: </span></div>
                    <div class="form-group"
                        style="width: 100%; min-height: 150px; overflow: auto;margin-top: 5px; margin-left: 10px">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" ng-change="searchPermit()"
                                ng-model="data.permitSearch">
                        </div>
                        <div ng-repeat="(parentCode, parentPermit) in data.listPermit">
                            <input type="checkbox" id="chk_@{{ parentCode }}" ng-checked="parentPermit.checked"
                                ng-model="data.listPermit[parentCode].checked"
                                ng-change="action.toggleParentPermit(parentCode)">
                            <label for="chk_@{{ parentCode }}">@{{ parentPermit.display_name }}</label>
                            <br>
                            <div ng-repeat="(permitCode, permit) in parentPermit.child_permit" class="childPermission">
                                <input type="checkbox" id="chk_@{{ permitCode }}" ng-checked="permit.checked"
                                    ng-model="data.listPermit[parentCode].child_permit[permitCode].checked">
                                <label for="chk_@{{ permitCode }}">@{{ permit.display_name }}</label><br>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="saveIssue()">Save</button>
            </div>
        </div>
    </div>
</div>
