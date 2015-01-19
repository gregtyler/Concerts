<?php
class TimeframeTranslator {
    public static $secDay = 86400; // 1 day in seconds
    public static $secWeek = 604800; // 1 week in seconds
    
   /*
    * Translate timeframes
    */
    public static function get( $code ) {
        if( $code === 'this_week' ) {
            // From now until Sunday night
            $from = time();
            $to = strtotime( 'This Sunday' ) + TimeframeTranslator::$secDay - 1;
        } elseif( $code === 'next_week' ) {
            // From next Monday 'til next Sunday
            $from = strtotime( 'This Sunday' ) + TimeframeTranslator::$secDay;
            $to = strtotime( 'This Sunday' ) + TimeframeTranslator::$secWeek - 1;
        } elseif( $code === 'today' ) {
            // From now until midnight
            $from = time();
            $to = mktime( 23, 59, 59 );
        } elseif( $code === 'this_month' ) {
            // From now until the end of the month
            $from = time();
            $to = mktime( 0, 0, 0, date('n')+1, 1 ) - 1;
        } elseif( $code === 'next_month' ) {
            // From next month until its end
            $from = mktime( 0, 0, 0, date('n')+1, 1 );
            $to = mktime( 0, 0, 0, date('n')+2, 1 ) - 1;
        }
        
        return $from && $to ? new Timeframe( $code, $from, $to ) : null;
    }
}

class Timeframe {
    public $code;
    public $label;
    public $from;
    public $to;
    
    public $frames = array(
        'today', 'this_week', 'next_week', 'this_month', 'next_month'
    );
    
    public function __construct( $code, $from, $to ) {
        $this->code = $code;
        $this->label = str_replace( '_', ' ', $code );
        $this->from = $from;
        $this->to = $to;    
    }
}