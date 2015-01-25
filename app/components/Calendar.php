<?php
class Calendar {
    public $events = array();
    public $affected = array();
    public $month;
    public $month_verbose;
    public $year;
    public $start_day;
    public $month_length;
    
    // On construction, load the performances
    public function __construct( $performances ) {
        $this->loadPerformances( $performances );
    }
    
    // Add a bunch of performances to the hitlist
    public function loadPerformances( $performances ) {
        // Reindex events
        foreach( $performances as $performance ) {
            $this->events[] = array( $performance->start, $performance->end );
            
            $date = date( 'Yn', $performance->start );
            if( !in_array( $date, $this->affected ) )
                $this->affected[] = $date;
        }
        // Sort the events, this makes lookups quicker
        sort( $this->events );
    }
    
    // Output the calendar(s)
    public function render() {
        $out = '';
        if( count( $this->affected ) )
            foreach( $this->affected as $yearmonth ) {
                // For each affected month/year pair, create a calendar
                $this->year = substr( $yearmonth, 0, 4 );
                $this->month = substr( $yearmonth, 4 );
                $out .= $this->renderLoop();
            }
        else
            $out = View::make( 'calendar.empty' );
        
        return $out;
    }
    
    // Output an individual calendar
    private function renderLoop() {
        // Load up some variables
        $theFirst = mktime( 0, 0, 0, $this->month, 1, $this->year );
        
        $this->month_verbose = date( 'F', $theFirst );
        $this->start_day = date( 'N', $theFirst );
        $this->month_length = date( 't', $theFirst );
        $this->prev_month_length = date( 't', mktime( 0, 0, 0, $this->month-1, 1, $this->year ) );
        
        // Load up the view
        return View::make( 'calendar.wrapper', array( 'cal' => $this ) );
    }
    
    // Is there an event on this day?
    public function hit( $day, $month=false, $year=false ) {
        if( $month === false ) $month = $this->month;
        if( $year === false ) $year = $this->year;
        
        // Get timeframe
        $start = mktime( 0, 0, 0, $month, $day, $year );
        $end = mktime( 23, 59, 59, $month, $day, $year );
        
        foreach( $this->events as $index=>$event ) {
            if( $event[0] > $start && $event[0] < $end ) // If an event is found, return the hit index
                return $index;
            else if( $event[0] > $end ) // Since the events are in order, once one starts after the end of the day we're good
                return -1;
        }
        
        return -1;
    }
}   