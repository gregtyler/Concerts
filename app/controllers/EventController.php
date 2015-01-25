<?php
class EventController extends BaseController {
    
    
   /*
    * Translate timeframes
    */
    public function getTimeframe( $title ) {
        if( $title === 'this_week' ) {
            // From now until Sunday night
            $from = time();
            $to = strtotime( 'This Sunday' ) + $secDay - 1;
        }
        
        return $from && $to ? array( $title, $from, $to ) : null;
    }
    
   /**
    * Show the profile for the given user.
    */
    public function showList( $get_area, $get_timeframe = 'this_week' ) {
        // Get area
        if( isset( $get_area ) )
            $area = Area::where('label','LIKE',$get_area)->first();
        
        if( empty( $area ) )
            return $this->showFind( $search );
        
        // Get timeframe
        if( isset( $get_timeframe ) )
            $timeframe = TimeframeTranslator::get( $get_timeframe );
        
        if( empty( $timeframe ) )
            $timeframe = TimeframeTranslator::get( 'this_week' );
        
        // Create a stream
        $stream = new Stream();
        
        // Add criteria
        if( Input::get( 'sort' ) === 'alpha' )
            $stream->criteria->orderBy( 'title', 'ASC' );
        $stream->criteria->whereBetween( 'start', [$timeframe->from, $timeframe->to] );
        
        // Searching
        $q = Input::get( 'q' );
        if( !empty( $q ) )
            $stream->criteria->where( 'title', 'LIKE', '%' . $q . '%' );
        
        // Extract tags
        $tags = new Illuminate\Database\Eloquent\Collection;
        foreach( $stream->getEvents() as $event ) {
            if( $event->event->tags )
                $tags = $tags->merge( $event->event->tags );
        }
        // Sort tags
        $tags = $tags->unique();
        $tags = $tags->sort(function($a,$b){
            return strcmp( $a->label, $b->label );
        });
        
        return View::make('events.list', array(
            'area' => $area,
            'timeframe' => $timeframe,
            'stream' => $stream,
            'tags' => $tags
        ));
    }
    
    public function showPerformance($id) {
        $occurrence = EventOccurrence::find( $id );
        return View::make('events.performance', array('occurrence'=>$occurrence));
    }
    
   /**
    * Show the finder page
    */
    public function doFind() {
        // Incoming
        $input = Input::all();
        foreach( $input as $key => $value )
            if( $key === '_token' || empty( $value ) || ($key==='sort' && $value==='chrono') )
                unset( $input[$key] );
        return Redirect::action('EventController@showList', $input);
    }
     
    public function showFind() {     
        // Create the find form
        $areas = Area::where('parent_id')->get();
        return View::make('events.find', array('areas'=>$areas));
    }
    
   /**
    * Show an abstract for a run of events
    */
    public function showSingle( $id ) {
        $abstract = DB\Event::where('id','=',$id)->first();
        return View::make('events.single', array('abstract'=>$abstract));
    }

}