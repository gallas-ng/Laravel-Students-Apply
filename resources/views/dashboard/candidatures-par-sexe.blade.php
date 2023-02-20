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
                    <h3>Candidatures Par Sexe</h3>
                </div>

                
            <div class="row justify-content-center mb-4 " style="width: 100%;">
            <div id="candidatures-par-sexe"></div>
                <div>
                        <table class="table">
                            <tr>
                                <th>Genre</th>
                                <th>Total</th>
                            </tr>
                            @if($candidatures->count() != 0)
                            @foreach($candidatures as $candidature)
                                <tr>
                                    <td>{{$candidature->sexe}}</td>
                                    <td>{{$candidature->total}}</td>
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













@section('scripts')
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
        // Récupération des données depuis le contrôleur
        var data = {!! json_encode($candidatures) !!};

        // Création du pie chart
        var width = 600,
            height = 400,
            radius = Math.min(width, height) / 2;

        var color = d3.scaleOrdinal()
                    .range(["#98abc5", "#8a89a6"]);

        var arc = d3.arc()
                    .outerRadius(radius - 10)
                    .innerRadius(0);

        var labelArc = d3.arc()
                        .outerRadius(radius - 40)
                        .innerRadius(radius - 40);

        var pie = d3.pie()
                    .sort(null)
                    .value(function(d) { return d.total; });

        var svg = d3.select("#candidatures-par-sexe").append("svg")
                    .attr("width", width)
                    .attr("height", height)
                    .append("g")
                    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

        var g = svg.selectAll(".arc")
                .data(pie(data))
                .enter().append("g")
                .attr("class", "arc");

        g.append("path")
        .attr("d", arc)
        .style("fill", function(d) { return color(d.data.sexe); });

        g.append("text")
        .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
        .attr("dy", ".35em")
        .text(function(d) { return d.data.sexe + " (" + d.data.total + ")"; });
</script>

@endsection

@endsection

