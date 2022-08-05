<link rel="stylesheet" href="{{ url('/css/formIssue.css') }}">
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
                        <label for="descripttion" class="col-form-label">Mô tả: </label>
                        <textarea id="descripttion" rows="4" cols="60" ng-model="data.issueInfo.descripttion">
                            Mô tả công việc
                        </textarea>
                    </div>


                    <div class="form-group">
                        <label for="employee" class="col-form-label">Người thực hiện: </label>
                        <select name="employee" class="form-select" id="role"
                            ng-model="data.issueInfo.jobAssignor_id" aria-label="Chọn người thực hiện">
                            <option value="0">--Chọn người thực hiện--</option>
                            <option ng-repeat="employee in data.employees" ng-value="@{{ employee.id }}"
                                ng-selected="employee.selected" style="height: 60px">@{{ employee.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-form-label">Trạng thái: </label>
                        <select name="status" class="form-select" id="role" ng-model="data.issueInfo.status_id"
                            aria-label="Chọn trạng thái">
                            <option value="0">--Chọn trạng thái--</option>
                            <option ng-repeat="status in data.statuses" ng-value="@{{ status.id }}"
                                ng-selected="status.selected" style="height: 60px">@{{ status.name }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="md-form md-outline input-with-post-icon datepicker"
                            inline="true">
                            <label for="deadline">Deadline...</label>
                            <input placeholder="Select date" type="date" id="deadline" class="form-control" ng-model="data.issueInfo.deadline">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="md-form md-outline input-with-post-icon datepicker"
                            inline="true">
                            <label for="finishDay">Ngày hoàn thành...</label>
                            <input placeholder="Select date" type="date" id="finishDay" class="form-control" ng-model="data.issueInfo.finishDay">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="statusFinishId" class="col-form-label">Trạng thái hoàn thành: </label>
                        <select name="status" class="form-select" ng-model="data.issueInfo.status_finish_id"
                            aria-label="Chọn trạng thái">
                            <option value="0">--Chọn trạng thái--</option>
                            <option ng-repeat="status in data.statusFinishes" ng-value="@{{ status.id }}"
                                ng-selected="status.selected" style="height: 60px">@{{ status.name }}
                            </option>
                        </select>
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
