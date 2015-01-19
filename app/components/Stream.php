<?php
/**
 * Given a bunch of event occurrences, creates a stream which it then outputs with the render() method
 */
class Stream {
    public $criteria;
    
    function __construct() {
        $this->criteria = EventOccurrence::join('event','event.id','=','event_occurrence.event_id');
    }
    
    public function addCriteria( $func ) {
        $func( $this->criteria );
    }
    
    public function getEvents() {
        // Default ordering
        $this->criteria->orderBy('start');
        // Default criteria
        $this->criteria->where('start','>',time());
        
        return $this->criteria->get();
    }
    
    public function render() {
        $events = $this->getEvents();
        
        // Track which events are first of type
        $handledEvents = [];
        foreach( $events as $occurrence )
            if( !in_array( $occurrence->event->id, $handledEvents ) ) {
                $handledEvents[] = $occurrence->event->id;
                $occurrence->first_of_event = true;
            }
        
        return View::make('stream.stream', array('stream'=>$events));
    }
}