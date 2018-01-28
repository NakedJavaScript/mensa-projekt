<!--Edit User Modal-->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- header -->
                            <div class="modal-header">
                            <h3 class="modal-title">Nutzer bearbeiten</h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <!-- body -->
                            <div class="modal-body">
                                <form role="form" method="POST" action="">
                                <div class="form-group" id="editform">
                                    <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control" id="vorname"  placeholder="<?php echo $_SESSION['vorname'] ?>"/> <br>
                                    <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control" id="nachname"  placeholder="<?php echo $_SESSION['nachname'] ?>"/><br>
                                    <label for="email">Email</label><input type="email" name="email" class="form-control" id="email"  placeholder="<?php echo $_SESSION['email'] ?>"/><br>
                                    <label for="passwort" >Passwort</label><input type="new_password" name="passwort" class="form-control"/><br>
                                    <label for="passwort" >Passwort Bestätigen</label><input type="confirm_password" name="passwort" class="form-control"/><br>
                                </div>

                            </div>
                            <!-- footer -->
                            <div class="modal-footer">
                                <input type="submit" name="edit_profile" class="btn btn-primary btn-block" value="Änderungen Speichern">
                            </div>
                            </form>

                            </div>
                        </div>
                        </div>
<!--Edit User Modal End-->
