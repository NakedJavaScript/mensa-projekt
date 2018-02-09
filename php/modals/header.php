<!-- Login Modal -->
<div class="modal fade" id="popUpWindow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Login</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <div class="form-group">
                        <label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="Email" required/><br>
                        <label for="password" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" required/>
                    </div>
                    <div class="modal-footer flex-column">
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Einloggen">
                        <a href="forgotPassword.php">Passwort vergessen?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
