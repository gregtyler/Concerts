<?php
class VenueController extends BaseController {
    
    public function showSingle($id) {
        $venue = Venue::find( $id );
        
        // Create a stream
        $stream = new Stream();
        
        // Get events which are in the venue, either for one occurrence or generally
        $stream->criteria->where(function($q) use ($venue) {
            $q->whereHas('event',function( $q ) use ($venue) {
                $q->where('event.venue_id', '=', $venue->id);
            })->where('venue_id');
        })->orWhere( 'venue_id', '=', $venue->id );
        
        return View::make('venues.single', array('venue'=>$venue, 'stream'=>$stream));
    }

}