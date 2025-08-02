</div><div class="wpsf-sections">
                    <div class="wpsf-simple-footer">
                        <?php
				if ($is_ajax === true) {
					echo '<span id="wpsf-save-ajax">' . esc_html__ ( "Settings Saved", 'our-team-members' ) . '</span>';
				}
				 echo $class->get_settings_buttons (); ?>
</div>
</div>
            </div>    
        </div>
    </div>
</div>