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
                <h3>Candidats Par Tranches D'age</h3>
                </div>

                
            <div class="row justify-content-center mb-4 " style="width: 100%;">
            <div id="tranches-age"></div>
                <div>
                        <table class="table">
                            <tr>
                                <th>Tranche d'Age</th>
                                <th>Total</th>
                            </tr>
                            @if($tranchesAge->count() != 0)
                            @foreach($tranchesAge as $TA)
                                <tr>
                                    <td>{{$TA->tranche_age}}</td>
                                    <td>{{$TA->total}}</td>
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

<script src="https://d3js.org/d3.v6.min.js"></script>
<script>
  // Récupération des données depuis Laravel
        var data = {!! json_encode($tranchesAge) !!};

        console.log(data);

        // Configuration du graphique
        var color = d3.scaleOrdinal()
            .domain(d3.range(data.length))
            .range(["black","gray","grey"]);

        var margin = {top: 20, right: 30, bottom: 30, left: 40},
            width = 300 - margin.left - margin.right,
            height = 400 - margin.top - margin.bottom;

        // Création de l'échelle en X
        var x = d3.scaleBand()
            .range([0, width])
            .domain(data.map(function(d) { return d.tranche_age; }))
            .padding(0.1);

        // Création de l'échelle en Y
        var y = d3.scaleLinear()
            .range([height, 0])
            .domain([0, d3.max(data, function(d) { return d.total; })]);

        // Création de l'axe en X
        var xAxis = d3.axisBottom(x);

        // Création de l'axe en Y
        var yAxis = d3.axisLeft(y);

        // Création du graphique
        var svg = d3.select("#tranches-age")
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform",
                    "translate(" + margin.left + "," + margin.top + ")");

        // Création des barres
        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", function(d) { return x(d.tranche_age); })
            .attr("width", x.bandwidth())
            .attr("y", function(d) { return y(d.total); })
            .attr("height", function(d) { return height - y(d.total); })
            .attr("rx", 6)
            .style("fill", function(d, i) { return color(i); }); // Ajout de border radius sur les coins supérieurs des barres

        // Ajout de l'axe en X
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        // Ajout de l'axe en Y
        svg.append("g")
            .call(yAxis);

        // Ajout du titre du graphique
        svg.append("text")
            .attr("x", (width / 2))
            .attr("y", 0 - (margin.top / 2))
            .attr("text-anchor", "middle")
            .style("font-size", "16px")
            
</script>

@endsection

@endsection