<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<body class="antialiased">


<!-- Modal -->
<div class="modal modal-lg fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100" id="exampleModalLabel">Recits title</h5>
            </div>
            <div class="modal-body">
            <form id="recitsForm" action="/saverecits" method="POST" enctype="multipart/form-data">
            @csrf
                    <div class="inputimage d-flex w-100 gap-3">
                        <div class="drop-zone bg-dark w-25">
                            <span class="drop-zone__prompt"><ion-icon class="fs-1" name="add-outline"></ion-icon></span>
                            <input type="file" name="myFile[]" id="image" class="drop-zone__input" accept="image/*" onchange="fileSelected(this)" multiple>

                        </div>
                        <div class="uploaded w-75" id="uploadedFiles">

                        </div>
                    </div>

                    <div class="title d-flex flex-column">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title">
                    </div>
                    <div class="Description">
                        <label for="textarea">Content</label>
                        <textarea name="textarea" id="textarea" class="w-100" rows="5"></textarea>
                    </div>

                    <div class="destin">
                        <label for="continent">Select Destination</label>
                        <select name="continent" id="continent">
                            <option value="0">Select</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}" name="destination">{{ $destination->destination_name }}</option>
                            @endforeach
                        </select>
                    </div>
                
            </div>
            <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>

        </form>
        </div>
    </div>
</div>







    <div class="main">
        <div class="page1">
            <header class="w-100 mb-5">
                <nav class="d-flex justify-content-between align-items-center py-3 px-5">
                    <div class="logo">
                        <h2>RoamTrip</h2>
                    </div>

                    <ul class="d-flex gap-4 m-0 p-0 align-items-center" style="list-style:none">
                        <li><a class="fs-6 active" style="text-decoration:none" href="">Home</a></li>
                        <li><a class="fs-6 text-light" style="text-decoration:none;" href="">Statistiques</a></li>
                        <li><a class="fs-6 text-light" style="text-decoration:none;" href="">Recits</a></li>
                        <li class="btn btn-danger py-1 px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</li>
                    </ul>
                </nav>
            </header>
        </div>


            <section class="middlwhere">
            <div class="middlepage1">
            <h1>ROAM TRIP</h1>
            <h2>DISCOVER THE WORLD</h2>
            </div>
                </section>

                <div class="statistiques d-flex flex-column ">
                    <h1 class="text-light">Statistiques</h1>
                        <div class="colored">
                            <div>
                                
                            <h4>+{{$destinationStats}}</h4>
                            <div class="info">
                            <h5>Destinations</h5>
                            </div>
                        
                        </div>
                            <div>
                                
                            <h4>+{{$postsstats}}</h4>
                            <div class="info">
                            <h5>Recits in here</h5>
                            </div>
                        
                        </div>            
                        </div>
                    </div>







        <div class="page d-flex flex-column justify-content-center align-items-center gap-5">

            <div class="filter justify-content-between w-75 d-flex align-items-center">
                    <div class="filtrage d-flex gap-4">
                        @foreach($destinations as $destination)
                        <h5 onclick="destination(this)" class="destinationss text-light" style="cursor:pointer">{{$destination->destination_name}}</h5>
                        @endforeach
                    </div>

                <div class="">
                    <ion-icon class="button-filter fs-1 btn m-0 p-0" id="up" name="caret-up-outline"></ion-icon>
                    <ion-icon class="button-filter fs-1 btn m-0 p-0" id="down" name="caret-down-outline"></ion-icon>
                </div>


            </div>

            <div class="page2 d-flex flex-column gap-2 w-100 align-items-center justify-content-center">
                @foreach($posts as $post)
                <div class="cart col-md-10 d-flex">
                    <div class="left w-25">
                   


<div id="carouselExampleSlidesOnly" class="carousel slide w-100 h-100" data-bs-ride="carousel">
  <div class="carousel-inner w-100 h-100">




    @foreach($post->images as $index => $image)
    @if ($image->image)
        <?php $base64Image = base64_encode($image->image); ?>

        <div class="carousel-item h-100 @if($index == 0){{ 'active' }}@endif">
        <img class="w-100 h-100" src="data:image/jpeg;base64,{{ $base64Image }}" alt="Image">
        </div>
        
    @endif
@endforeach
    
  </div>
</div>






                    </div>
                    <div class="right w-75">
                        <h2>{{$post->Title}}</h2>
                        <p>Destination : {{$post->destination->destination_name}}</p>

                        
                        <p> {{ \Illuminate\Support\Str::limit($post->Content, 400, $end='...') }}</p>
                       
                    </div>
                </div>
                @endforeach

                
            </div>
    
        </div>
        
    </div>

    

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{asset('js/home.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>