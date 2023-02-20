@extends('layouts.app')

@section('content')
<style>
    .presentation-img img{
        
        width: 40%;
        max-width: 400px;
        margin:auto;
    }
</style>


<div class="container ">
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
                    <h3>Candidatures Par Formation</h3>
                </div>

                
            <div class="row justify-content-center mb-4 " style="width: 100%;">
            <div id="candidatures-par-formation"></div>
                <div>
                        <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Total</th>
                            </tr>
                            @if($candidatures->count() != 0)
                            @foreach($candidatures as $candidature)
                                <tr>
                                    <td>{{$candidature->nom}}</td>
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
        // ... code de visualisation des données ...

        var data =  {!! json_encode($candidatures) !!};

        console.log(data)
        var color = d3.scaleOrdinal()
            .domain(d3.range(data.length))
            .range(d3.schemeCategory10);

        var margin = {top: 20, right: 18, bottom: 30, left: 140},
            width = 660 - margin.left - margin.right,
            height = 200 - margin.top - margin.bottom;

        var x = d3.scaleLinear()
            .range([0, width])
            .domain([0, d3.max(data, function(d) { return d.total; })]);

        
        var y = d3.scaleBand()
            .range([height, 0])
            .padding(0.3)
            .domain(data.map(function(d) { return d.nom; }));

        var svg = d3.select("#candidatures-par-formation").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        svg.selectAll(".bar")
            .data(data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("width", function(d) { return x(d.total); })
            .attr("y", function(d) { return y(d.nom); })
            .attr("height", y.bandwidth())
            .style("fill", function(d, i) { return color(i); });
                    

        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x));

        svg.append("g")
            .call(d3.axisLeft(y));
    </script>
@endsection

@endsection

