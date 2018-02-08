<!-- Modal for editing the profile -->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nutzer bearbeiten</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                    <div class="form-group" id="editform">
                        <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control" id="vorname"  placeholder="<?php echo $_SESSION['vorname'] ?>"/> <br>
                        <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control" id="nachname"  placeholder="<?php echo $_SESSION['nachname'] ?>"/><br>
                        <label for="email">Email</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="email" placeholder="<?php echo strstr($_SESSION['email'], '@', true); ?>" aria-label="Recipient's username" aria-labelledby="emailHelp" aria-describedby="emailDomain" >
                            <div class="input-group-append">
                                <span class="input-group-text" id="emailDomain">@its-stuttgart.de</span>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Bitte bedenke, dass lediglich '@its-stuttgart' Domänen erlaubt sind.</small><br/>
                        </div>
                        <label for="passwort" >Passwort</label><input type="password" name="new_password" class="form-control"/><br>
                        <label for="passwort" >Passwort Bestätigen</label><input type="password" name="confirm_password" class="form-control"/><br>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="edit_profile" class="btn btn-primary btn-block" value="Änderungen Speichern">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
