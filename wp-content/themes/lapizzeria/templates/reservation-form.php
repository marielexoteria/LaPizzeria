<div class="reservation-info">
	<form class="reservation-form" method="post">
		<h2>Make a reservation</h2>
		<div class="field">
			<input type="text" name="name" placeholder="Name" required>
		</div><!-- ./field name -->
		
		<div class="field">
			<input type="datetime-local" name="date" placeholder="Date" step="300" required> 
			<!-- para que el formato de la hora sea HH:MM:SS AM/PM y que al usar las flechas de arriba/abajo en el calendar picker se mueva 5 minutos -->
		</div><!-- ./field date -->
		
		<div class="field">
			<input type="email" name="email" placeholder="E-mail" required>
		</div><!-- ./field e-mail -->
		
		<div class="field">
			<input type="tel" name="phone" placeholder="Phone number" required>
		</div><!-- ./field phone nr -->
		
		<div class="field">
			<textarea name="message" placeholder="Message" required></textarea>
		</div><!-- ./textarea -->
		
		<div class="g-recaptcha" data-sitekey="6Lei4mkUAAAAAPlgTKvn2rWyhZ_0P019-ZfOmzTY"></div> <!-- ./recaptcha script needed -->
		
		<input type="submit" name="reservation" value="Send" class="button">
		<input type="hidden" name="hidden" value="1">
	</form>
</div> <!-- ./reservation-info -->