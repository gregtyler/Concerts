<table class="table calendar">
<caption>
    {{ $cal->month_verbose }} {{ $cal->year }}
</caption>
<thead>
    <tr>
        <th>M
        <th>T
        <th>W
        <th>T
        <th>F
        <th>S
        <th>S
    </tr>
</thead>
<tbody>
    @for($i=0;$i<5;$i++)
        {{ View::make( 'calendar.row', ['cal'=>$cal, 'start'=> ($cal->start_day - 6) + ($i*7)] ) }}
    @endfor
</tbody>
</table>