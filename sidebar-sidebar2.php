				<div id="sidebar2" class="sidebar span6" role="complementary">
				
					<?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar2' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="alert-message">
						
							<p>Please activate some Widgets.</p>
						
						</div>

					<?php endif; ?>

				</div>