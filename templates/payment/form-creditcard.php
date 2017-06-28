<p class="form-row form-row-wide omise-required-field">
	<label for="omise_card_name"><?php echo _x( 'Name', 'Card holder name at payment form', 'omise' ); ?> <span class="required">*</span></label>
	<input id="omise_card_name" class="input-text" type="text"
		maxlength="255" autocomplete="off" placeholder="<?php echo _x( 'Name', 'Placeholder for card holder name', 'omise' ); ?>"
		name="omise_card_name">
</p>
<p class="form-row form-row-wide omise-required-field">
	<label for="omise_card_number"><?php echo _x( 'Card Number', 'Card number at payment form', 'omise' ); ?> <span class="required">*</span></label>
	<input id="omise_card_number" class="input-text" type="text"
		maxlength="20" autocomplete="off" placeholder="<?php echo _x( 'Card Number', 'Placeholder for card number', 'omise' ); ?>"
		name="omise_card_number">
</p>
<p class="form-row form-row-first omise-required-field">
	<label for="omise_card_expiration_month"><?php echo _x( 'Expiration Month', 'Expiration month at payment form', 'omise' ); ?> <span class="required">*</span></label>
	<input id="omise_card_expiration_month" class="input-text" type="text"
		autocomplete="off" placeholder="<?php echo _x( 'MM', 'Placeholder for expiration month', 'omise' ); ?>" name="omise_card_expiration_month">
</p>
<p class="form-row form-row-last omise-required-field">
	<label for="omise_card_expiration_year"><?php echo _x( 'Expiration Year', 'Expiration year at payment form', 'omise' ); ?> <span class="required">*</span></label>
	<input id="omise_card_expiration_year" class="input-text" type="text"
		autocomplete="off" placeholder="<?php echo _x( 'YYYY', 'Placeholder for expiration year', 'omise' ); ?>"
		name="omise_card_expiration_year">
</p>
<p class="form-row form-row-first omise-required-field">
	<label for="omise_card_security_code"><?php echo _x( 'Security Code', 'Security Code at payment form', 'omise' ); ?> <span class="required">*</span></label>
	<input id="omise_card_security_code"
		class="input-text" type="password" autocomplete="off"
		placeholder="<?php echo _x( 'Security Code', 'Placeholder for security Code', 'omise' ); ?>" name="omise_card_security_code">
</p>