<?php
namespace DB;

class Event extends \Eloquent {
    protected $table = 'event';
    
    /** RELATIONSHIPS **/
    public function occurrences() {
        return $this->hasMany('EventOccurrence');
    }
    
    public function venue() {
        return $this->belongsTo('Venue');
    }
    
    public function tags() {
        return $this->belongsToMany('Tag');
    }
    
    /** PROPERTIES **/
    public function getSimilarAttribute() {
        $tagIDs = array();
        // Fetch the IDs of tags this is attached to
        foreach( $this->tags as $tag )
            $tagIDs[] = $tag->id;
        
        // Find events with similar tags
        $similar = Event::whereHas('tags',function($q) use ($tagIDs){
            $q->whereIn('id', $tagIDs );
        })->where('id','!=',$this->id)->get();
        
        return $similar;
    }
}