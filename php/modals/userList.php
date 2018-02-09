<!--New User Modal-->
<div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Neuer Nutzer</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="">
          <div class="form-group">
            <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control"  placeholder="Max" required/> <br>
            <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control"  placeholder="Mustermann" required/><br/>
            <label for="email">Email</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="email" placeholder="max.mustermann" aria-label="Recipient's username" aria-describedby="emailDomain" required>
              <div class="input-group-append">
                <span class="input-group-text" id="emailDomain">@its-stuttgart.de</span>
              </div>
            </div>
            <label for="passwort" >Passwort</label><input type="password" name="passwort" class="form-control" value="" placeholder="Passwort" required/><br>
            <label for="kontostand" >Kontostand</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="kontostand" placeholder="123" aria-label="Tragen sie den gewünschten Betrag ein." aria-labelledby="kontostandHelp" aria-describedby="unit" required>
              <div class="input-group-append">
                <span class="input-group-text" id="unit">€</span>
              </div>
            </div>
            <small id="kontostandHelp" class="form-text text-muted">Bitte verwenden Sie anstelle eines Kommas einen Punkt: '.'</small><br>
            <label for="adminrechte" >Adminrechte</label><br>
            <div class="form-check form-check-inline">
              <input type="radio" name="adminrechte" id="keineAdminrechte" class="form-check-input" value="3" checked><label class="form-check-label" for="keineAdminrechte">Nein</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="adminrechte" id="adminrechte" class="form-check-input" value="2"><label class="form-check-label" for="adminrechte">Ja</label>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" name="neuer_nutzer" class="btn btn-primary btn-block" value="Neuen Nutzer anlegen">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Edit User Modal-->
<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Nutzer bearbeiten</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="">
          <div class="form-group" id="editform">
            <input type="hidden" name="benutzer_ID" class="form-control" id="benutzer_ID"  placeholder="123" readonly/> <br> <!--Dieses Feld ist für den Nutzer unsichtbar. -->
            <label for="vorname">Vorname</label><input type="text" name="vorname" class="form-control" id="vorname"  placeholder="Max" required/> <br>
            <label for="nachname">Nachname</label><input type="text" name="nachname" class="form-control" id="nachname"  placeholder="Mustermann" required/><br>
            <label for="email">Email</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="email" placeholder="max.mustermann" id="email" aria-label="Recipient's username" aria-describedby="emailDomain" required>
              <div class="input-group-append">
                <span class="input-group-text" id="emailDomain">@its-stuttgart.de</span>
              </div>
            </div>
            <label for="passwort" >Passwort</label><input type="password" name="passwort" class="form-control" placeholder="Passwort" /><br>
            <label for="kontostand" >Kontostand</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="kontostand"id="kontostand" placeholder="123" aria-label="Tragen sie den gewünschten Betrag ein." aria-labelledby="kontostandHelp" aria-describedby="unit" required>
              <div class="input-group-append">
                <span class="input-group-text" id="unit">€</span>
              </div>
            </div>
            <label for="adminrechte" >Adminrechte</label><br>
            <div class="form-check form-check-inline">
              <input type="radio" name="adminrechte" id="keineAdminrechte" class="form-check-input" value="3" checked><label class="form-check-label" for="adminrechte">Nein</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="adminrechte" id="adminrechte" class="form-check-input" value="2"><label class="form-check-label" for="adminrechte">Ja</label>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" name="bearbeiten_nutzer" class="btn btn-primary btn-block" value="Änderungen Speichern">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
