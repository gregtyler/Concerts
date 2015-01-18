<?php
class EventController extends BaseController {
    /**
     * Show the profile for the given user.
     */
    public function showList() {
        // Create a stream
        $stream = new Stream();
        
        return View::make('events.list', array('stream'=>$stream));
    }
    
    public function showSingle($id) {
        $occurrence = EventOccurrence::find( $id );
        return View::make('events.single', array('occurrence'=>$occurrence));
    }

}