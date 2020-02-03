<?php 

    class Workshop {
        public $id;
        public $fields = array();

        function __construct($attr){
            $this->id = $attr['id'];
            // Uses ACF method to retrieve fields
            $this->fields = get_fields($this->id, false);
            // foreach($fields_info as $key=>$value){
            //     $this->fields[$$key]=$value;
            // }
        }

        // public function set_workshop_info($id){
        //     $fields_info = get_fields($id, false);
        //     foreach($fields_info as $key=>$value){
        //         $this->fields[$$key]=$value;
        //     }
        // }

        // Return Any Key
        function returnKey($key){ return $this->fields[$key]; }

        //Return Specific Key
        function returnName() { return $this->fields['workshop_name']; }
        function returnDescription() { return $this->fields['workshop_description']; }
        function returnPhotoId() { return $this->fields['workshop_photo']; }

       	// Format and Return Date, Time
        function returnDate() { return $this->fields['workshop_date']->format('M j, Y'); }
        function returnTime() { return $this->fields['workshop_time']->format('g:i A'); }   

       
        
        
    }
