<?php
/**
 * Given a bunch of event occurrences, creates a stream which it then outputs with the render() method
 */
class Stream {
    public $criteria;
    
    function __construct() {
        $this->criteria = EventOccurrence::orderBy('start');
        $this->criteria->where('start','>',time());
    }
    
    public function addCriteria( $func ) {
        $func( $this->criteria );
    }
    
    public function render() {
        $events = $this->criteria->get();
        
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