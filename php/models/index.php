<!--AddDayMeal Modal-->
<div class="modal fade" id="EditDaymeal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- header -->
            <div class="modal-header">
                <h3 class="modal-title">Ein neues Tagesangebot erstellen</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <!-- body -->
            <div class="modal-body">
                <form role="form" method="POST" action="#EditDaymeal">
                        <div class="form-group">
                            <input type="hidden" id="edit_date_field" name="date" value="">
                            <input type="hidden" id="edit_food_field" name="food" value="">
                            <label for="foodlist">Speisen</label>
                            <select name="foodlist" id="edit_foodlist">
                                <?php
                                    $getFood = "SELECT * FROM speise";
                                    $result = $conn->query($getFood);

                                    $food_options ="";
                                    while($food = $result->fetch_assoc()) {
                                        $selected = '';
                                        $food_options = $food_options . "<option value=". $food['speise_ID'] .">" . $food['name'] ."</option>";//Alle speisen werden als dropdownoption gespeichert.
                                    }
                                    echo $food_options;
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- footer -->
                    <div class="modal-footer">
                        <input type="submit" name="EditDaymeal" class="btn btn-primary btn-block" value="Tagesangebot bearbeiten">
                    </div>
                </form>
        </div>
    </div>
</div>
<!--AddDayMeal Modal End-->

<?php
    confModal('Wollen Sie dieses Tagesangebot wirklich löschen?');
?>
