<tr>
    @for( $i=$start; $i<$start+7; $i++ )
    {? $hit = $cal->hit( $i ) ?}
        <td class="@if( $hit > -1 ) calendar-event @endif @if( $i==date('j') && $cal->month==date('n') && $cal->year==date('Y') ) calendar-today @endif @if( $i < 1 || $i > $cal->month_length ) calendar-outlier @endif" @if($hit>-1) title="{{ date( 'H:i A', $cal->events[$hit][0] ) }}" @endif>
        {{
            $i < 1 ? $cal->prev_month_length + $i :
            ($i > $cal->month_length ? $i - $cal->month_length : $i)
        }}
    @endfor
</tr>