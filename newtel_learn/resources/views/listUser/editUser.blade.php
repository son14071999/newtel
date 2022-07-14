<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="email-name" class="col-form-label">email</label>
                                <input type="text" class="form-control" id="email-name" ng-model="userEdit.email"
                                    value="@{{ userEdit.email }}">
                            </div>
                            <div class="form-group">
                                <label for="name-text" class="col-form-label">name:</label>
                                <input type="text" class="form-control" id="name-text" ng-model="userEdit.name"
                                    value="@{{ userEdit.name }}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="saveEditUser()">Save</button>
                    </div>
                </div>
            </div>
        </div>