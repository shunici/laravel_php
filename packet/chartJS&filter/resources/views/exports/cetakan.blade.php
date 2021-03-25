<table>
    <thead>
        <tr>
            <th colspan="2"><strong>Laporan DataCetakan {{ $month }} - {{ $year }}</strong></th>
        </tr>
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataCetakan as $row)
            <tr>
                <td>{{ $row['date'] }}</td>
                <td> {{ $row['total'] }}</td>
            </tr>
        @endforeach
        
     
        ?>
        

    </tbody>
</table>