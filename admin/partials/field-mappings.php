<div class="loader"></div>

<form method="post" action="<?php echo admin_url('/admin.php?page=wpsaci-smart-activecampaign-mappings') ?>" id="wpsaci-smart-activecampaign-mappings-form">

    <h2><?php echo esc_html__('Fields Mapping', 'wpsaci-smart-activecampaign'); ?></h2>

    <table class="form-table">
        <!-- WP Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'WP Modules', 'wpsaci-smart-activecampaign' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="wp_module">
                    <option><?php echo  esc_html__('Select Module', 'wpsaci-smart-activecampaign'); ?></option>
                    <?php 
                        if($wp_modules){
                            foreach ($wp_modules as $key => $singleModule) {
                                ?>            
                                <option value = "<?php echo $key; ?>"><?php echo esc_html__($singleModule, 'wpsaci-smart-activecampaign'); ?></option>
                                <?php            
                            }
                        }
                    ?>
                </select>
            </td>
        </tr>

        <!-- WP Fields Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'WP Fields', 'wpsaci-smart-activecampaign' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="wp_field">
                    <option><?php echo  esc_html__('Please select WP Modules', 'wpsaci-smart-activecampaign'); ?></option>
                </select>
            </td>
        </tr>

        <!-- Zoho Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Zoho Modules', 'wpsaci-smart-activecampaign' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="activecampaign_module">
                    <option><?php echo  esc_html__('Select Zoho Module', 'wpsaci-smart-activecampaign'); ?></option>
                    <?php
                        $activecampaign_modules_options = "";

                        if($getListModules['modules']){
                            foreach ($getListModules['modules'] as $key => $singleModule) {
                                if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
                    ?>
                                <option value = '<?php echo $singleModule['api_name']; ?>'> 
                                    <?php echo  esc_html__($singleModule['plural_label'], 'wpsaci-smart-activecampaign'); ?>
                                </option>
                    <?php                
                                }
                            }
                        }
                    ?>
                </select>
            </td>
        </tr>

        <!-- Zoho Fields Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Zoho Fields', 'wpsaci-smart-activecampaign' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="activecampaign_field">
                    <option><?php echo  esc_html__('Please select Zoho Modules', 'wpsaci-smart-activecampaign'); ?></option>
                </select>
            </td>
        </tr>

        <!-- Zoho Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo  esc_html__( 'Status', 'wpsaci-smart-activecampaign' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <select name="status">
                    <option value="active"><?php echo esc_html__( 'Active', 'wpsaci-smart-activecampaign' ); ?></option>
                    <option value="inactive"><?php echo esc_html__( 'In Active', 'wpsaci-smart-activecampaign' ); ?></option>
                </select>
            </td>
        </tr>

        <!-- Zoho Modules Row -->
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label><?php echo esc_html__( 'Description', 'wpsaci-smart-activecampaign' ); ?></label>
            </th>
            <td class="forminp forminp-text">
                <textarea name="description" rows="5" cols="46"></textarea>
            </td>
        </tr>

    </table>

    <p class="submit">
        <input type="submit" name="add_mapping" class="button-primary woocommerce-save-button" value="<?php echo  esc_html__( 'Add Mapping', 'wpsaci-smart-activecampaign' ); ?>">
    </p>
</form>