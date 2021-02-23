<div class="admin-login">
    <div class="row">
        <div class="col-md-4">
            <form method="post" class="login-form">
                <h5 class="form-head">Sign In</h5>
                <hr />
                <?php if ($_SESSION['errmsg'] != "") { ?>
                <span class="error-msg">
                    <?php echo htmlentities($_SESSION['errmsg']); ?>
                </span>
                <?php } ?>
                <div class="form-group">
                    <label for="admin-username">Username</label>
                    <input type="text" class="form-control" id="admin-username" name="username">
                </div>
                <div class="form-group">
                    <label for="admin-password">Password</label>
                    <input type="password" class="form-control" id="admin-password" name="password">
                </div>
                <hr />
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>
</div>