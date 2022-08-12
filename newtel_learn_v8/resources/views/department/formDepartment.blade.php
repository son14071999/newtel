<div class="modal fade" id="formDepartmentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@{{ title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name_display" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name_display" ng-model="data.departmentInfo.name"
                            value="@{{ data.departmentInfo.name }}">
                    </div>
                    <div style="margin-top: 7px;"><span>Chọn department cha: </span></div>
                    <div class="form-group"
                        style="width: 100%; min-height: 150px; overflow: auto;margin-top: 5px; margin-left: 10px">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search"
                                ng-change="searchDepartment()" ng-model="data.searchDepartment">
                        </div>
                        <select name="department" class="form-select" id="department"
                            ng-model="data.departmentInfo.parent_id" aria-label="Chọn department">
                            <option value="root">Gốc</option>
                            <option ng-repeat="department in data.departments" ng-value="@{{ department.id }}"
                                ng-selected="department.selected">
                                <div>
                                    <div>
                                        @{{ department.name }}
                                    </div>
                                    <div>
                                        (@{{ department.pathName }})
                                    </div>
                                </div>
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="saveDepartment()">Save</button>
            </div>
        </div>
    </div>
</div>
