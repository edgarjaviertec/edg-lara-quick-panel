<div class="modal" tabindex="-1" id="confirmationModal">
    <div class="modal-dialog modal-md modal-dialog-centered border-0 shadow">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title h4">Confirm Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-0">
                    <p>For your security, please confirm your password to continue.</p>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" autocomplete="off" required/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center border-0 bg-light">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-btn">
                    <span class="btn-content">
                        Confirm password
                    </span>
                    <span class="spinner d-none">
                        <span class="spinner-border spinner-border-sm"></span>
                        <span>Loading...</span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>