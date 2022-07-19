<div class="modal fade" id="addPermitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Permit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="code" class="col-form-label">Display name</label>
                    <input type="text" class="form-control" id="code" ng-model="permitAdd.code"
                        value="@{{permitAdd.code}}">
                </div>
                <div class="form-group">
                    <label for="name_display" class="col-form-label">Code</label>
                    <input type="text" class="form-control" id="name_display" ng-model="permit.display_name"
                        value="@{{permit.display_name}}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-click="saveAddPermit()">Save</button>
        </div>
    </div>
</div>
</div>