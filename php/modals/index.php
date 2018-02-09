<!-- Modal for editing daily meals -->
<div class="modal fade" id="EditDaymeal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Ein neues Tagesangebot erstellen</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
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
                                    $food_options = $food_options . "<option value=". $food['speise_ID'] .">" . $food['name'] ."</option>"; // Every meal is saved as a dropdown option
                                }

                                echo $food_options;
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="EditDaymeal" class="btn btn-primary btn-block" value="Tagesangebot bearbeiten">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add new daily meal Modal-->
<div class="modal fade" id="AddDayMeal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Ein neues Tagesangebot erstellen</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
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
									$food_options = $food_options . "<option value=". $food['speise_ID'] .">" . $food['name'] ."</option>"; // Every meal is saved in a dropdown menu
								}
								echo $food_options;
							?>
						</select>
					</div>
					<div class="modal-footer">
						<input type="submit" name="create_daily_meal" class="btn btn-primary btn-block" value="Tagesangebot erstellen">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
