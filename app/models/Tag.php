<?php
class Tag extends Eloquent {
    protected $table = 'tag';
    public $timestamps = false;
    
    /** RELATIONSHIPS **/
    public function type() {
        return $this->belongsTo('TagType');
    }
    
    /** PROPERTIES **/
    public function getLinkAttribute() {
        $params = array('slug'=>$this->slug);
        if( $this->type_id )
            $params['type'] = $this->type->slug;
        return action('TagController@showSingle', $params);
    }
}