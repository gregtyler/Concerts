<?php
class Venue extends Eloquent {
    protected $table = 'venue';
    
    /** RELATIONSHIPS **/
    public function area() {
        return $this->belongsTo('Area');
    }
    
    /** PROPERTIES **/
    public function getLinkAttribute() {
        return action('VenueController@showSingle', array('id'=>$this->id));
    }
}