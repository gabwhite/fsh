@extends('layouts.admin')

@section('title', 'Import User Products')

@section('content')

    <form id="form1" name="form1" method="post" action="{{url('admin/import')}}">

        <div>
            <table border="1">
                <thead>
                @if(isset($previewData['headers']))
                    <tr>
                    @foreach($previewData['headers'] as $h)
                        <th>{{$h}}</th>
                    @endforeach
                    </tr>
                @endif
                </thead>
                <tbody>
                    @foreach($previewData['rows'] as $row)
                    <tr>
                        @foreach($row as $col)
                            <td valign="top">{{$col}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div>
            <input type="submit" name="submit" value="Process File" class="btn btn-primary"/>
            <a href="{{url('admin/import')}}">Cancel</a>
        </div>

    </form>

@endsection


@section('scripts')

    <script type="text/javascript">

        $(document).ready(function()
        {

        });

    </script>

@endsection