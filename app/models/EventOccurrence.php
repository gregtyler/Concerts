<?php
class EventOccurrence extends Eloquent {
    protected $table = 'event_occurrence';
    
    /** RELATIONSHIPS **/
    public function event() {
        return $this->belongsTo('DB\Event');
    }
    
    public function venue() {
        return $this->venue_id ? $this->belongsTo('Venue') : $this->event->venue();
    }
    
    /** PROPERTIES **/
    public function getLinkAttribute() {
        return action('EventController@showSingle', array('id'=>$this->id));
    }
    
    public function getUpcomingAttribute() {
        $upcoming = EventOccurrence
            ::where('event_id', '=', $this->event_id)
            ->where('id', '!=', $this->id)
            ->where('start', '>', time())
            ->get();
        return $upcoming;
    }
}