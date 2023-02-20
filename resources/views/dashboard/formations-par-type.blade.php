@extends('layouts.app')

@section('content')

<style>
    .presentation-img img{
        
        width: 40%;
        max-width: 400px;
        margin:auto;
    }
</style>


<div class="container mb-4 ">
    <div class="row align-items-center   ">
    <div class="col-md-3 mt-3">
                        <div class="card">
                        <div class="presentation-img mb-2 center ">
                        <img class="img-center mt-1" src="https://img.freepik.com/icones-gratuites/barres_318-354011.jpg?size=626&ext=jpg&ga=GA1.1.938414909.1676740287&semt=ais" alt="Image de programmation">
                        </div>
                        <div class="card-header">
                        <h4 id="" class="text-align-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Dashboard ->     
                        </h4>
                        </div>
                    </div>
                    <div class="col-md-8 align-items-center ">
                        <ul class="nav nav-pills " style="color: black;">
                        <li class="nav-item dropdown ml-2">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Parcourir</button>
                            <ul class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('c-p-f') }}">Nombre de candidatures par formation</a>
                            <a class="dropdown-item" href="{{ route('f-p-r') }}">Nombre de formations par référentiel</a>
                            <a class="dropdown-item" href="{{ route('c-p-s') }}">Répartition des candidatures par sexe</a>
                            <a class="dropdown-item" href="{{ route('f-p-t') }}">Répartition des formations par type</a>
                            <a class="dropdown-item" href="{{ route('t-a') }}">Tranches d'âge des candidats</a>
                            <a class="dropdown-item" href="{{ route('f-p-s') }}">Statut des formations (démarrées ou non)</a>
                            </ul>
                        </li>
                        </ul>
                        </div>
                    </div>
    
        <div class="col-md-8 mb-14">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <h3>Formations Par Type</h3>
                </div>

                
            <div class="row justify-content-center mb-4 " style="width: 100%;">
            <div id="formations-par-type"></div>
                <div>
                        <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Total</th>
                            </tr>
                            @if($formations->count() != 0)
                            @foreach($formations as $formation)
                                <tr>
                                    <td>{{$formation->libelle}}</td>
                                    <td>{{$formation->total}}</td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2"><h2>Desolee Aucune donnée a representer</h2></td>
                            </tr>
                            @endif
                        </table>
                </div>
            </div>
            </div>
        

            </div>
        </div>
   
    </div>


<div> 


@section('scripts')
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
        // Récupération des données
        var data = {!! json_encode($formations) !!};

        console.log(data);
        // Définition des dimensions du graphique
        var width = 500,
            height = 500,
            radius = Math.min(width, height) / 2;

        // Création du graphique
        var svg = d3.select('#formations-par-type')
            .append('svg')
            .attr('width', width)
            .attr('height', height)
            .append('g')
            .attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')');

        // Création de la fonction pie
        var pie = d3.pie()
            .value(function(d) { return d.total; })
            .sort(null);

        // Définition des couleurs
        var color = d3.scaleOrdinal(d3.schemeCategory10);

        // Création de l'arc
        var arc = d3.arc()
            .innerRadius(radius - 150)
            .outerRadius(radius - 50);

        // Création des éléments du graphique
        var g = svg.selectAll('.arc')
            .data(pie(data))
            .enter()
            .append('g')
            .attr('class', 'arc');

        // Création des arcs
        g.append('path')
            .attr('d', arc)
            .style('fill', function(d) { return color(d.data.libelle); });

        // Ajout des labels
        g.append('text')
            .attr('transform', function(d) { return 'translate(' + arc.centroid(d) + ')'; })
            .attr('dy', '.35em')
            .text(function(d) { return d.data.libelle + ' (' + d.data.total + ')'; });

</script>
</div>
@endsection
@endsection



