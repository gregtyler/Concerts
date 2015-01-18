<?php
class TagController extends BaseController {
    
    public function showSingle($type, $slug) {
        $tag = Tag::whereHas( 'type', function( $q ) use ( $type ){
            $q->where('slug','=',$type);
        })->where( 'slug', '=', $slug )->first();
        
        if( !$tag )
            return Response::view('errors.missing', array(), 404);
        
        // Create a stream
        $stream = new Stream();
        
        // Find events with the appropriate tag
        $stream->criteria->whereHas('event',function($q) use ($tag){
            $q->whereHas('tags',function($q) use ($tag){
                $q->where( 'id', '=', $tag->id );
            });
        });
        
        return View::make('tags.single', array('tag'=>$tag, 'stream'=>$stream));
    }

}