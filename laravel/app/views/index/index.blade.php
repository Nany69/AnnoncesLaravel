@extends('layouts.master')

@section('content')
    <div class="searchform">
        <a id="dropsearch" class="btn btn-default btn-lg" href="#">Recherche d'annonces</a>
        <div class="navbar-form searchinputs" style="display:none;">
        {{ Form::open(array( 'url' => 'search','method' => 'POST')) }}
            <div class="col-sm-10">
                <label id="keys">Par Mots clés</label>
                 <div id="keysinput" class="form-control">
                    {{ Form::text('keywords',null, array('class'=>'form-control', 'placeholder'=>'ex: iPhone')) }}
                </div>
            </div>
            <div class="col-sm-10">
                <label id="price">Par Prix</label>
                <div id="priceinput" class="form-control">
                    {{ Form::select('prix', array('0' => 'Tous', '1' => '0 - 100€', '2' => '100-300€', '3' => '300-500€', '4' => '500-1000€', '5' => '+ 1000€')) }}
                </div>
            </div>
            <div class="col-sm-10">
                <label id="category">Par Catégorie</label>
                <div id="catinput" class="form-control">
                    {{ Form::select('category', array('0' => 'Toutes', 'media' => 'Multimédia', 'automoto' => 'Auto/Moto', 'service' => 'Service', 'autre' => 'Autres')) }}
                </div>
            </div>
            <button id="subsearch" class="btn btn-default btn-sm" type="submit"><i class="fa fa-search"></i></button>
            {{ Form::close() }}
        </div>
    </div>
<div class="articleindex">
    @foreach($annonces as $v)
   <div class="onebillet well">
        <a class=" btn btn-default fa fa-eye" href="{{ URL::to('view/'.$v->id) }}"></a> <span class="titre">{{ $v->titre }}</span>
        <div class="row @if(isset($v->photo1)) photos @else photos2 @endif">
            @if(isset($v->photo1))
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a class="fancybox fancybox.image" href="<?php echo 'uploads'.DIRECTORY_SEPARATOR.$v->id.DIRECTORY_SEPARATOR.strtolower($v->photo1); ?>" >
                        <img class="imgadd img-responsive" src="<?php echo 'uploads'.DIRECTORY_SEPARATOR.$v->id.DIRECTORY_SEPARATOR.strtolower($v->photo1); ?>" alt="photo"/>
                    </a>
                </div>
            @endif
            @if(isset($v->photo2))
                <div class="col-md-3 col-sm-4 col-xs-6">
                     <a class="fancybox fancybox.image" href="<?php echo 'uploads'.DIRECTORY_SEPARATOR.$v->id.DIRECTORY_SEPARATOR.strtolower($v->photo2); ?>" >
                        <img class="img-responsive imgleft" src="<?php echo 'uploads'.DIRECTORY_SEPARATOR.$v->id.DIRECTORY_SEPARATOR.strtolower($v->photo2); ?>" alt="photo2"/>
                     </a>
                </div>
            @endif
            @if(isset($v->photo3))
                <div class="col-md-3 col-sm-4 col-xs-6">
                     <a class="fancybox fancybox.image" href="<?php echo 'uploads'.DIRECTORY_SEPARATOR.$v->id.DIRECTORY_SEPARATOR.strtolower($v->photo3); ?>" >
                        <img class="img-responsive imgright" src="<?php echo 'uploads'.DIRECTORY_SEPARATOR.$v->id.DIRECTORY_SEPARATOR.strtolower($v->photo3); ?>" alt="photo3"/>
                    </a>
                </div>
            @endif
        </div>
        <p class="description">
           <span class="prixlabel label label-info">Prix : {{$v->prix }}€</span> <br><br>
            Description : {{ str_limit($v->description, 200) }}
        </p>
        @if(Auth::check())
            <a href="#" class="accesview btn btn-primary btn-sm"><i class="fa fa-star"></i></a><br>
            <span class="viewadd">Publié le {{ $v->created_at }} &nbsp;</span>
            <div class="buttonadd">
                @if($v->user_id == Auth::user()->id)
                    <a class="btn btn-default fa fa-pencil editad" href="{{ URL::to('annonce/'.$v->id.'/edit') }}"></a>
                    <a class="deladd btn btn-danger fa fa-trash" href="{{ URL::to('delete/annonce/'.$v->id) }}" onclick="return confirm('Voulez vous vraiment supprimer cette annonce ?');"></a>
                @endif
            </div>


        @endif
    </div>
    @endforeach

    <div class="pagination">
        <?php echo $annonces->links(); ?>
    </div>
</div>
@stop