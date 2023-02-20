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
                <h3>Formations Par Referentiel</h3>
                </div>

                
            <div class="row justify-content-center mb-4 " style="width: 100%;">
            <div id="formations-par-referentiel"></div>
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


<div> 
    


@section('scripts')
<script src="https://d3js.org/d3.v6.min.js"></script>

<script>
    // Récupération des données depuis la méthode formationsParReferentiel du contrôleur
    var data = {!! json_encode($formations) !!};

console.log(data);

// Création du tableau de données pour D3.js
var color = d3.scaleOrdinal()
        .domain(d3.range(data.length))
        .range(d3.schemeCategory10);

var chartData = [];
for (var i = 0; i < data.length; i++) {
    chartData.push({
        referentiel: data[i].libelle,
        total: data[i].total
    });
}

// Définition des dimensions du graphique
var margin = {top: 20, right: 20, bottom: 130, left: 40},
    width = 560 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

// Définition de l'échelle pour l'axe X
var x = d3.scaleBand()
    .range([0, width])
    .padding(0.1);

// Définition de l'échelle pour l'axe Y
var y = d3.scaleLinear()
    .range([height, 0]);

// Création du conteneur SVG pour le graphique
var svg = d3.select("#formations-par-referentiel").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

// Mise à jour des échelles de l'axe X et Y
x.domain(chartData.map(function(d) { return d.referentiel; }));
y.domain([0, d3.max(chartData, function(d) { return d.total; })]);

// Ajout de l'axe X avec titres verticaux
svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(x))
  .selectAll("text")
    .style("text-anchor", "end")
    .attr("dx", "-.8em")
    .attr("dy", ".15em")
    .attr("transform", "rotate(-90)");

// Ajout de l'axe Y
svg.append("g")
    .attr("class", "y axis")
    .call(d3.axisLeft(y).ticks(10));

// Ajout des barres du graphique
svg.selectAll(".bar")
    .data(chartData)
  .enter().append("rect")
    .attr("class", "bar")
    .attr("x", function(d) { return x(d.referentiel); })
    .attr("width", x.bandwidth())
    .attr("y", function(d) { return y(d.total); })
    .attr("height", function(d) { return height - y(d.total); })
    .style("fill", function(d, i) { return color(i); });

</script>
@endsection
    
@endsection