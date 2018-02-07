<?PHP
    confModal('Wollen Sie diese Speise wirklich löschen?');
?>

<!--New Food Modal-->
<div class="modal fade" id="NewFood" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <!-- header -->
                            <div class="modal-header">
                            <h3 class="modal-title">Neues Essen hinzufügen</h3>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <!-- body -->
                            <div class="modal-body">
                              <form role="form" method="POST" action="#FoodAdded">
                                <div class="form-group">
                                  <label for="name">Name der Speise</label><input type="text" name="name" class="form-control"  placeholder="Schnitzel, Pommes, Gurke..." required/><br>
                                    <fieldset>
                                    <p>Allergene/Inhaltsstoffe:</p>
                                                <div class="form-check">
                                                    <input class="form-check-input ka" name="allergene[]" type="checkbox" id="ka" value="- Keine Allergene -">
                                                    <label class="form-check-label" for="ka">Keine Allergene</label>

                                                </div>

                                    <div class="form-check">
                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="gg" value="GG">
                                        <label class="form-check-label" for="gg">Glutenhaltiges Getreide</label>

                                    </div>

                                            <div class="form-check">
                                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="kre" value="Kre">
                                                    <label class="form-check-label" for="kre">Krebstiere</label>
                                            </div>

                                    <div class="form-check">
                                            <input class="form-check-input cb" name="allergene[]" type="checkbox" id="ei" value="Ei">
                                            <label class="form-check-label" for="ei">Eier und daraus hergestellte Erzeugnisse</label>
                                    </div>

                                            <div class="form-check">
                                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="f" value="F">
                                                    <label class="form-check-label" for="f">Fisch und daraus hergestellte Erzeugnisse</label>
                                            </div>

                                <div class="form-check">
                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="erd" value="Erd">
                                        <label class="form-check-label" for="erd">Erdnüsse</label>
                                </div>

                                            <div class="form-check">
                                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="soj" value="Soj">
                                                    <label class="form-check-label" for="soj">Soja und daraus hergestellte Erzeugnisse</label>
                                            </div>

                            <div class="form-check">
                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="mil" value="Mil">
                                    <label class="form-check-label" for="mil">Milch und daraus hergestellte Erzeugnisse(Laktose)</label>
                            </div>

                                            <div class="form-check">
                                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="nus" value="Nus">
                                                    <label class="form-check-label" for="nus">Schalenfrüchte(Nüsse)</label>
                                            </div>

                            <div class="form-check">
                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="sel" value="Sel">
                                    <label class="form-check-label" for="sel">Sellerie und daraus hergestellte Schalenfrüchte</label>
                            </div>

                                            <div class="form-check">
                                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="sen" value="Sen">
                                                    <label class="form-check-label" for="sen">Senf und daraus hergestellte Erzeugnisse</label>
                                            </div>

                            <div class="form-check">
                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="ses" value="Ses">
                                    <label class="form-check-label" for="ses">Sesamsamen und daraus hergestellte Erzeugnisse</label>
                            </div>

                                            <div class="form-check">
                                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="sch" value="Sch">
                                                    <label class="form-check-label" for="sch">Schwefeldioxid und Sulfite</label>
                                            </div>

                            <div class="form-check">
                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="lup" value="Lup">
                                    <label class="form-check-label" for="lup">Lupinen und daraus hergestellte Erzeugnisse</label>
                            </div>

                                            <div class="form-check">
                                                    <input class="form-check-input cb" name="allergene[]" type="checkbox" id="wei" value="Wei">
                                                    <label class="form-check-label" for="wei">Weichtiere und daraus hergestellte Erzeugnisse</label>
                                            </div>
                </fieldset><br>
                                  <label for="sonstiges" >Sonstiges:</label><input type="text" name="sonstiges" class="form-control" placeholder="Pommes + kleine Cola" /><br>
                                  <label for="preis" >Preis:</label><input type="text" name="preis" class="form-control" placeholder="123€" aria-labelledby="preisHelp"  required/>
                                    <small id="preisHelp" class="form-text text-muted">Bitte verwende bei Kommazahlen ein punkt: '.'</small>
                                </div>

                            </div>
                            <!-- footer -->
                            <div class="modal-footer">
                              <input type="submit" name="Essen_hinzufügen" class="btn btn-primary btn-block" value="Essen hinzufügen">
                            </div>
                            </form>

                          </div>
                        </div>
                      </div>
<!--New Food Modal End-->

                                    <!--Edit Food Modal-->
                                    <div class="modal fade" id="EditFood" tabindex="-1" role="dialog" aria-labelledby="New User" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <!-- header -->
                                                                <div class="modal-header">
                                                                <h3 class="modal-title">Speise Bearbeiten</h3>
                                                                    <button type="button" class="close" id="close_modal" data-dismiss="modal">&times;</button>

                                                                </div>
                                                                <!-- body -->
                                                                <div class="modal-body">
                                                                    <form role="form" method="POST" action="#FoodEdited">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="speise_ID" id="speise_ID" class="form-control"  placeholder="123" readonly/><br>
                                                                        <label for="name">Name der Speise</label><input type="text" name="name" class="form-control" id="name" placeholder="Schnitzel, Pommes, Gurke..." required/><br>
                                                                        <fieldset>
                                                                        <p>Allergene/Inhaltsstoffe:</p>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input ka" name="allergene[]" type="checkbox" id="ka" value="- Keine Allergene -">
                                                                                        <label class="form-check-label" for="ka">Keine Allergene</label>

                                                                                    </div>

                                                                        <div class="form-check">
                                                                            <input class="form-check-input cb" name="allergene[]" type="checkbox" id="gg" value="GG">
                                                                            <label class="form-check-label" for="gg">Glutenhaltiges Getreide</label>

                                                                        </div>

                                                                                <div class="form-check">
                                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="kre" value="Kre">
                                                                                        <label class="form-check-label" for="kre">Krebstiere</label>
                                                                                </div>

                                                                        <div class="form-check">
                                                                                <input class="form-check-input cb" name="allergene[]" type="checkbox" id="ei" value="Ei">
                                                                                <label class="form-check-label" for="ei">Eier und daraus hergestellte Erzeugnisse</label>
                                                                        </div>

                                                                                <div class="form-check">
                                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="f" value="F">
                                                                                        <label class="form-check-label" for="f">Fisch und daraus hergestellte Erzeugnisse</label>
                                                                                </div>

                                                                    <div class="form-check">
                                                                            <input class="form-check-input cb" name="allergene[]" type="checkbox" id="erd" value="Erd">
                                                                            <label class="form-check-label" for="erd">Erdnüsse</label>
                                                                    </div>

                                                                                <div class="form-check">
                                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="soj" value="Soj">
                                                                                        <label class="form-check-label" for="soj">Soja und daraus hergestellte Erzeugnisse</label>
                                                                                </div>

                                                                <div class="form-check">
                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="mil" value="Mil">
                                                                        <label class="form-check-label" for="mil">Milch und daraus hergestellte Erzeugnisse(Laktose)</label>
                                                                </div>

                                                                                <div class="form-check">
                                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="nus" value="Nus">
                                                                                        <label class="form-check-label" for="nus">Schalenfrüchte(Nüsse)</label>
                                                                                </div>

                                                                <div class="form-check">
                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="sel" value="Sel">
                                                                        <label class="form-check-label" for="sel">Sellerie und daraus hergestellte Schalenfrüchte</label>
                                                                </div>

                                                                                <div class="form-check">
                                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="sen" value="Sen">
                                                                                        <label class="form-check-label" for="sen">Senf und daraus hergestellte Erzeugnisse</label>
                                                                                </div>

                                                                <div class="form-check">
                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="ses" value="Ses">
                                                                        <label class="form-check-label" for="ses">Sesamsamen und daraus hergestellte Erzeugnisse</label>
                                                                </div>

                                                                                <div class="form-check">
                                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="sch" value="Sch">
                                                                                        <label class="form-check-label" for="sch">Schwefeldioxid und Sulfite</label>
                                                                                </div>

                                                                <div class="form-check">
                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="lup" value="Lup">
                                                                        <label class="form-check-label" for="lup">Lupinen und daraus hergestellte Erzeugnisse</label>
                                                                </div>

                                                                                <div class="form-check">
                                                                                        <input class="form-check-input cb" name="allergene[]" type="checkbox" id="wei" value="Wei">
                                                                                        <label class="form-check-label" for="wei">Weichtiere und daraus hergestellte Erzeugnisse</label>
                                                                                </div>
                                                    </fieldset><br>
                                                                        <label for="sonstiges" >Sonstiges:</label><input type="text" name="sonstiges" id="sonstiges" class="form-control" placeholder="Pommes + kleine Cola" /><br>
                                                                        <label for="preis" >Preis:</label><input type="text" name="preis" id="preis" class="form-control" placeholder="123€" aria-labelledby="preisHelp"  required/>
                                                                        <small id="preisHelp" class="form-text text-muted">Bitte verwende bei Kommazahlen ein punkt: '.'</small>
                                                                    </div>

                                                                </div>
                                                                <!-- footer -->
                                                                <div class="modal-footer">
                                                                    <input type="submit" name="Essen_bearbeiten" class="btn btn-primary btn-block" value="Änderungen Speichern">
                                                                </div>
                                                                </form>

                                                                </div>
                                                            </div>
                                                            </div>
                                    <!--Edit Food Modal End-->
