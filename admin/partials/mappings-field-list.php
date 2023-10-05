<?php
    global $wpdb;
    $fieldlists = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_activecampaign_field_mapping");
?>
    <h2><?php echo esc_html__('Fields Mapping List'); ?></h2>

    <table id="mapping-list-table" class="wp-list-table widefat fixed striped table-view-list display">
        <thead>
            <th><?php echo esc_html__('Id', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Zoho Module', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Zoho Field', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('WP Module', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('WP Field', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Status', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Description', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Action', 'wpsaci-smart-activecampaign'); ?></th>
        </thead>

        <tfoot>
            <th><?php echo esc_html__('Id', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Zoho Module', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Zoho Field', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('WP Module', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('WP Field', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Status', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Description', 'wpsaci-smart-activecampaign'); ?></th>
            <th><?php echo esc_html__('Action', 'wpsaci-smart-activecampaign'); ?></th>
        </tfoot>
        <tbody>
            <!-- WP Modules Row -->
            <?php
                if ( $fieldlists ) {
                    foreach ( $fieldlists as $singlelist ) {
                        ?>
                        <tr>
                            <td><?php echo esc_html__($singlelist->id, 'wpsaci-smart-activecampaign'); ?></td>
                            <td><?php echo esc_html__($singlelist->activecampaign_module, 'wpsaci-smart-activecampaign'); ?></td>
                            <td><?php echo esc_html__($singlelist->activecampaign_field, 'wpsaci-smart-activecampaign'); ?></td>
                            <td><?php echo esc_html__($singlelist->wp_module, 'wpsaci-smart-activecampaign'); ?></td>
                            <td><?php echo esc_html__($singlelist->wp_field, 'wpsaci-smart-activecampaign'); ?></td>
                            <td><?php echo ucfirst( esc_html__($singlelist->status, 'wpsaci-smart-activecampaign') ); ?></td>
                            <td><?php echo esc_html__($singlelist->description, 'wpsaci-smart-activecampaign'); ?></td>
                            <td>
                                <?php if($singlelist->is_predefined != 'yes' ){ ?>
                                    <a href="<?php echo admin_url('admin.php?page=wpsaci-smart-activecampaign-mappings&action=trash&id='.$singlelist->id); ?>">
                                        <button type="submit"><?php echo esc_html__('Delete', 'wpsaci-smart-activecampaign'); ?></button>
                                    </a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php
                    }   
                } else {
                    ?>
                    <tr>
                        <td colspan="7">
                            <?php echo esc_html__('No Record Found', 'wpsaci-smart-activecampaign'); ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>