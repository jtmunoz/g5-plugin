<?php 

    class Workshop {
        public $id;
        public $fields = array();
        public $name = false ;

        function __construct($attr){

            $this->id = $attr['id'];

            // Uses ACF method to retrieve fields
            $this->fields = get_fields($this->id, false);

            if (isset($attr['name'])){
                $this->name = $attr['name'];
            }
        }

        // Return Any Key
        function returnKey($key){ return $this->fields[$key]; }

        //Return Specific Key
        function returnName() { return $this->fields['workshop_name']; }
        function returnDescription() { return $this->fields['workshop_description']; }
        function returnPhotoId() { return $this->fields['workshop_photo']; }

        // Format and Return Date, Time
        function returnDate() { return $this->fields['workshop_date']->format('M j, Y'); }
        function returnTime() { return $this->fields['workshop_time']->format('g:i A'); }   

       
        function printSingleWorkshop(){
            $output = '';
            if($this->id){
                $output .= '<div class="uk-panel uk-panel-header uk-panel-box g5-padding g5-border-success g5-background-white g5-boxshadow-medium tm-workshop-panel uk-text-center"><h3 class="tm-workshop-panel-title">'.$this->fields['workshop_name'].'</h3><div class="g5-padding uk-panel-teaser uk-margin-bottom-remove tm-workshop-panel-teaser">';
                if( $this->fields['workshop_photo'] ) {
                    $size = 'large';
                    $attributes = 'class="uk-align-center g5-padding-small-all g5-border-small g5-border-primary g5-boxshadow-all-small uk-border-rounded tm-workshop-panel-photo"';
                    $output .= wp_get_attachment_image($this->fields['workshop_photo'], $size, false, $attributes);
                }               
                $output .= '</div><div><p class="uk-margin-top-remove  uk-text-h3 tm-workshop-panel-date">' . meta_print_date($this->fields['workshop_date']) . '</p><p class="uk-margin-small-top uk-h3 tm-workshop-panel-time">' . meta_print_time($this->fields['workshop_time']) . '</p>';
                if ( get_field('workshop_description') ) {
                    $output .= '<p class="tm-workshop-panel-description">'.$this->fields['workshop_description'].'</p>';
                }
                $args = array( 'p' => $this->id, 'post_type' => 'workshop' );
                $workshop_query = new WP_Query($args); 
                if ( $workshop_query->have_posts() ) {
                    while ( $workshop_query->have_posts() ) {
                        $workshop_query->the_post() ;
                        $output .= '<p><a href="'.get_permalink($this->id).'" class="uk-button uk-button-success g5-transition-half tm-workshop-button">View the Workshop</a></p>';
                    } 
                }
                $output .= '</div></div>';
            } else {
                $output .= '<h3>Workshop ID not set</h3>';
            }
            return $output;
        }

        function attrName() {
            return ($this->name) ? $this->fields['workshop_name'] : '';
        }
        




    }

