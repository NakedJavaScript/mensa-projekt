<?PHP
    confModal('Wollen Sie diesen Nutzer wirklich löschen?');
?>

<!--New User Modal-->
<div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <!-- header -->
                            <div class="modal-header">
                            <h3 class="modal-title">Neuer Nutzer</h3>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <!-- body -->
                            <div class="modal-body">
                              <form role="form" method="POST" action="">
                                <div class="form-group">
                                  <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control"  placeholder="Max" required/> <br>
                                  <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control"  placeholder="Mustermann" required/><br>
                                  <label for="email">Email</label><input type="email" name="email" class="form-control"  placeholder="max.mustermann@musterdomäne.de" required/><br>
                                  <label for="password" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" required/><br>
                                  <label for="kontostand" >Kontostand</label><input type="text" name="kontostand" class="form-control" placeholder="Tragen Sie den gewünschten Betrag ein" required/><br>
                                    <label for="adminrechte" >Adminrechte</label><br>
                                                <input type="radio" name="adminrechte" class="radio-inline" value="3" checked>Nein &nbsp
                                                <input type="radio" name="adminrechte" class="radio-inline" value="2">Ja
                                </div>

                            </div>
                            <!-- footer -->
                            <div class="modal-footer">
                              <input type="submit" name="neuer_nutzer" class="btn btn-primary btn-block" value="Neuen Nutzer anlegen">
                            </div>
                            </form>

                          </div>
                        </div>
                      </div>
<!--New User Modal End-->

                    <!--Edit User Modal-->
                    <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
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
                                                        <input type="hidden" name="benutzer_ID" class="form-control" id="benutzer_ID"  placeholder="123" readonly/> <br> <!--Dieses Feld ist für den Nutzer unsichtbar. -->
                                                        <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control" id="vorname"  placeholder="Max" required/> <br>
                                                        <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control" id="nachname"  placeholder="Mustermann" required/><br>
                                                        <label for="email">Email</label><input type="email" name="email" class="form-control" id="email"  placeholder="max.mustermann@musterdomäne.de" required/><br>
                                                        <label for="passwort" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" /><br>
                                                        <label for="kontostand" >Kontostand</label><input type="text" name="kontostand" class="form-control" id="kontostand" placeholder="Tragen Sie den gewünschten Betrag ein" required/><br>
                                                        <label for="adminrechte" >Adminrechte</label><br>
                                                                    <input type="radio" name="adminrechte" class="radio-inline" value="3"><span name="adminrechte">Nein &nbsp</span>
                                                                    <input type="radio" name="adminrechte" class="radio-inline" value="2"><span name="adminrechte">Ja</span>
                                                    </div>

                                                </div>
                                                <!-- footer -->
                                                <div class="modal-footer">
                                                    <input type="submit" name="bearbeiten_nutzer" class="btn btn-primary btn-block" value="Änderungen Speichern">
                                                </div>
                                                </form>

                                                </div>
                                            </div>
                                            </div>
                    <!--Edit User Modal End-->
