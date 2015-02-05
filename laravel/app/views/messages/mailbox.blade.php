@extends('layouts.master')

@section('content')
<div class="body-complete">
    <div class="messagerie-index">
        <div>
            <h3>Boîte de Réception&nbsp;&nbsp;<span class="btn btn-default nbrmsg badge"></span></h3>
        </div>
        <div class="recus panel panel-default">
            <table class="table">
                <thead class="titremenu">
                    <tr>
                        <th>Pseudo</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
               @foreach($recus as $v)
                    <tr>
                        <td>{{ $v->sendername }}</td>
                        <td> {{ $v->created_at }}</td>
                        <td >{{ $v->content }}</td>
                        <td><a class="btn btn-default fa fa-trash" href="#"></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

<div class="pagination">
    <?php echo $recus->links(); ?>
</div>

<div class="messagerie-index">
    <div>
        <h3>Boîte d'envoi&nbsp;&nbsp;</h3>
    </div>
    <div class="recus panel panel-default">
        <table class="table">
            <thead class="titremenu">
                <tr>
                <a href="#">
                    <th>Pseudo</th>
                    <th>Date</th>
                    <th>Message</th>
                    <th>Actions</th>
                    </a>
                </tr>
            </thead>
            <tbody>
                @foreach($recus as $v)
                        <tr>
                            <td>{{ $v->receivername }}</td>
                            <td> {{ $v->created_at }}</td>
                            <td >{{ $v->content }}</td>
                            <td><a class="btn btn-default fa fa-trash" href="#"></a></td>
                        </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div>
    <div class="pagination">
        <?php echo $envoyes->links(); ?>
    </div>
</div>

@stop