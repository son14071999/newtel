<div class="modal fade" id="formClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <label for="name" class="col-form-label">Name: </label>
                        <input type="text" class="form-control" id="name" ng-model="data.clientInfo.name">
                    </div>

                    <div class="form-group">
                        <label for="redirect" class="col-form-label">Redirect:</label>
                        <input type="text" class="form-control" id="redirect" ng-model="data.clientInfo.redirect"
                            value="@{{ data.clientInfo.redirect }}">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="saveClient()">Save</button>
            </div>
        </div>
    </div>
</div>
