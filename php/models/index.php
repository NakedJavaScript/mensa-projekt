<!--AddDayMeal Modal-->
<div class="modal fade" id="AddDayMeal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- header -->
            <div class="modal-header">
                <h3 class="modal-title">Ein neues Tagesangebot erstellen</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <!-- body -->
            <div class="modal-body">
                <form role="form" method="POST" action="#AddedTagesangebot">
                        <div class="form-group">
                            <input type="hidden" id="date_field" name="date" value="">
                            <label for="foodlist">Speisen</label>
                            <select name="foodlist" id="foodlist">
                                <?php
                                    $getFood = "SELECT * FROM speise";
                                    $result = $conn->query($getFood);
                                    $food_options ="";
                                    while($food = $result->fetch_assoc()) {
                                        $food_options = $food_options . "<option value=". $food['speise_ID'] .">" . $food['name'] ."</option>";//Alle speisen werden als dropdownoption gespeichert.
                                    }
                                    echo $food_options;
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- footer -->
                    <div class="modal-footer">
                        <input type="submit" name="Tagesangebot_erstellen" class="btn btn-primary btn-block" value="Tagesangebot erstellen">
                    </div>
                </form>
        </div>
    </div>
</div>
<!--AddDayMeal Modal End-->

<?php
    confModal('Wollen Sie dieses Tagesangebot wirklich löschen?');
?>
