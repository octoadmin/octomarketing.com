<?php

class ImageElevatorActivate extends Factory325_Activator {
    
    public function activate() {
 
            $this->plugin->license->setDefaultLicense( array(
                'Category'      => 'free',
                'Build'         => 'premium',
                'Title'         => __('OnePress Zero License', 'sociallocker'),
                'Description'   => __('Please, activate the plugin to get started. Enter a key 
                                    you received with the plugin into the form below.', 'sociallocker')
            ));
        

        
        add_option('imgelv_clipboard_enable', true);
        add_option('imgelv_dragdrop_enable', true);
        
        add_option('imgelv_compression_max_size', 400);  
        add_option('imgelv_compression_quality', 80);   
    } 
}

$clipImages->registerActivation('ImageElevatorActivate');