<?php
	
	$wpsaci_smart_activecampaign 				= get_option( 'wpsaci_smart_activecampaign' );
	$wpsaci_smart_activecampaign_settings 		= get_option( 'wpsaci_smart_activecampaign_settings' );

	$client_id 						=  isset($wpsaci_smart_activecampaign_settings['client_id']) ? $wpsaci_smart_activecampaign_settings['client_id'] : "";
	$client_secret 					= isset($wpsaci_smart_activecampaign_settings['client_secret']) ? $wpsaci_smart_activecampaign_settings['client_secret'] : "";
	$wpsaci_smart_activecampaign_data_center 	= isset($wpsaci_smart_activecampaign_settings['data_center']) ? $wpsaci_smart_activecampaign_settings['data_center'] : "";

	$wpsaci_smart_activecampaign_data_center 	= ( $wpsaci_smart_activecampaign_data_center ? $wpsaci_smart_activecampaign_data_center : 'https://accounts.activecampaign.com' );
?>

<div class="wrap">                
	
	<h1><?php echo esc_html__( 'ActiveCampaign CRM Settings and Authorization' ); ?></h1>
	<hr>

	<form method="post">
		<?php 
			$tab = isset( $_REQUEST['tab'] ) ? $_REQUEST['tab'] : 'general';
		?>

		<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
			<a href="<?php echo admin_url('admin.php?page=wpsaci-smart-activecampaign-integration&tab=general'); ?>" class="nav-tab <?php if($tab == 'general'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'General', 'wpsaci-smart-activecampaign' ); ?></a>
			<a href="<?php echo admin_url('admin.php?page=wpsaci-smart-activecampaign-integration&tab=synch_settings'); ?>" class="nav-tab <?php if($tab == 'synch_settings'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'Synch Settings', 'wpsaci-smart-activecampaign' ); ?></a>
		</nav>
		
		<input type="hidden" name="tab" value="<?php echo esc_html($tab); ?>">

		<?php if( isset($tab) && 'general' == $tab ){ ?>
			
			<table class="form-table general_settings">
				<tbody>
					<tr>
						<th scope="row"><label><?php echo esc_html__( 'Data Center', 'wpsaci-smart-activecampaign' ); ?></label></th>
						<td>
							<fieldset>
								<label>
									<input 
										type="radio" 
										name="wpsaci_smart_activecampaign_settings[data_center]" 
										value="https://accounts.activecampaign.com"
										<?php echo esc_html( $wpsaci_smart_activecampaign_data_center == 'https://accounts.activecampaign.com' ? ' checked="checked"' : '' ); ?> />
										United States (US)
								</label><br>

								<label>
									<input 
										type="radio" 
										name="wpsaci_smart_activecampaign_settings[data_center]" 
										value="https://accounts.activecampaign.eu"
										<?php echo esc_html( $wpsaci_smart_activecampaign_data_center == 'https://accounts.activecampaign.eu' ? ' checked="checked"' : '' ); ?> />
										Europe (EU)
								</label><br>

								<label>
									<input 
										type="radio" 
										name="wpsaci_smart_activecampaign_settings[data_center]" 
										value="https://accounts.activecampaign.com.cn"
										<?php echo esc_html( $wpsaci_smart_activecampaign_data_center == 'https://accounts.activecampaign.com.cn' ? ' checked="checked"' : '' ); ?> />
										China (CN)
								</label>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Client ID', 'wpsaci-smart-activecampaign' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" name="wpsaci_smart_activecampaign_settings[client_id]" value="<?php echo esc_attr($client_id); ?>" required />
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Client Secret', 'wpsaci-smart-activecampaign' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" name="wpsaci_smart_activecampaign_settings[client_secret]" value="<?php echo esc_attr($client_secret); ?>" required />
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_attr( 'Redirect URI', 'wpsaci-smart-activecampaign' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo esc_url(WPSACI_REDIRECT_URI); ?>" readonly />
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Access Token', 'wpsaci-smart-activecampaign' ); ?></label>
						</th>
						<td>
							
							<?php 
								if(isset($wpsaci_smart_activecampaign->access_token)){
									echo esc_html($wpsaci_smart_activecampaign->access_token);
								}
							?>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Refresh Token', 'wpsaci-smart-activecampaign' ); ?></label>
						</th>
						<td>
							<?php 
								if(isset($wpsaci_smart_activecampaign->refresh_token)){
									echo esc_html($wpsaci_smart_activecampaign->refresh_token);
								}
							?>
						</td>
					</tr>
					
				</tbody>
			</table>

			<div class="inline">
				<p>
					<input type='submit' class='button-primary' name="submit" value="<?php echo esc_html__( 'Save & Authorize', 'wpsaci-smart-activecampaign' ); ?>" />
				</p>

				<?php 
					if(isset($wpsaci_smart_activecampaign->refresh_token)){
						echo '<p class="success">'.esc_html__('Authorized', 'wpsaci-smart-activecampaign').'</p>';
					}
				?>
			</div>

		<?php }else if( isset($tab) && 'synch_settings' == $tab ){ ?>
			<?php 
				$smart_activecampaign_obj   = new WPSACI_Smart_ActiveCampaign();
		        $wp_modules 	= $smart_activecampaign_obj->get_wp_modules();
		        $getListModules = $smart_activecampaign_obj->get_activecampaign_modules();
			?>
			<table class="form-table synch_settings">
				<tbody>
					<?php
						if($getListModules['modules']){
					        foreach ($getListModules['modules'] as $key => $singleModule) {
					            if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
					            	foreach ($wp_modules as $wp_module_key => $wp_module_name) {
					            		?>
						            		<tr>
												<th scope="row"><label><?php echo esc_html__( "Enable {$wp_module_key} to ActiveCampaign {$singleModule['api_name']} Sync", 'wpsaci-smart-activecampaign' ); ?></label></th>
												<td>
													<fieldset>
														<label>
															<input 
																type="checkbox" 
																name="wpsaci_smart_activecampaign_settings[synch][<?php echo $wp_module_key.'_'.$singleModule['api_name']; ?>]" 
																<?php @checked( $wpsaci_smart_activecampaign_settings['synch']["{$wp_module_key}_{$singleModule['api_name']}"], 1 ); ?>
																value="1" />
																Enable
														</label>
													</fieldset>
												</td>
											</tr>
						            	<?php	
					            	}
					            }
					        }
					    }
					?>    
    				
				</tbody>
			</table>
			<p><input type='submit' class='button-primary' name="submit" value="<?php echo esc_html__( 'Save', 'wpsaci-smart-activecampaign' ); ?>" /></p>
		
		<?php }?>	
		
	</form>
</div>