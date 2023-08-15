<!doctype html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Phoenix</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('dashassets/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashassets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>

<body>
    <main class="main" id="top">
        <div class="container-fluid px-0">
             <!--include sidebar and nav bar-->
           @include('inc.admin.sidebar')
            @include('inc.admin.navbar')
            <div class="content">
                <div class="pb-5">
                    <div class="row g-5 ">
                        <h2> Liste des Produits</h2>
                        <hr />
                        <div class="col-md-8 p-0">

                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Ajouter
                                Produits</a>
                                <div class="mt-3">

                                    <form action="/admin/product/search" method="POST">
                                        @csrf
                                        <div class="row">

                                            <div class="col-5"> <input type="text" name="product_name" class="form-control" placeholder="tapper un nom de  produit"></div>
                                            <div class="col-5" > <input type="number" name="qte" class="form-control " min="0" placeholder="tapper un nom de  produit"></div>
                                            <div class="col-2"><button class="btn btn-success" type="submit"> Chercher</button></div>
                                        </div>
                                            
                                            
                                    </form>
                                </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom Produit</th>
                                    <th scope="col">Description Produit</th>
                                    <th scope="col">Prix Produit</th>
                                    <th scope="col">Quantite Produit</th>
                                    <th scope="col">Image produit</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $p)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->description }}</td>
                                        <td>{{ $p->price }}</td>
                                        <td>{{ $p->qte }}</td>
                                        <td>
                                           <img src="{{asset('uploads')}}/{{ $p->photo }}" width="150" alt="">
                                        </td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#editProducts{{$p->id}}" class="btn btn-success">Modifier</a>
                                            <a onclick="return confirm('voulez-vous vraiment supprimer cette categorie')"
                                                href="/admin/products/{{ $p->id }}/delete"
                                                class="btn btn-danger">Supprimer</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>





                    </div>
                </div>


                <footer class="footer">
                    <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                    class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                    class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.1.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </main>



    <!--Modal Ajouter-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Produit</h5><button class="btn p-1"
                        type="button" data-bs-dismiss="modal" aria-label="Close"><svg
                            class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 352 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>

                </div>
                <form action="/admin/products/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1"> Categorie Produit </label>
                            <select name="categorie" class="form-control" >
                                @foreach($categories as $c)
                                <option value="{{$c->id}}"> {{$c->name}}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Nom Produit </label>
                            <input name="name" class="form-control" id="exampleFormControlInput1" type="text"
                                placeholder="tapper nom produit">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-0">
                            <label class="form-label" for="exampleTextarea">Description Produit </label>
                            <textarea name="description" class="form-control" rows="3" placeholder="tapper description produit"> </textarea>
                            @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Prix Produit </label>
                            <input name="price" class="form-control" id="exampleFormControlInput1" type="number"
                                placeholder="tapper prix produit">
                            @error('price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Quantite Produit </label>
                            <input name="qte" class="form-control" id="exampleFormControlInput1" type="number"
                                placeholder=" tapper quantite produit">
                            @error('qte')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Image Produit </label>
                            <input name="photo" class="form-control" id="exampleFormControlInput1" type="file"
                                placeholder="tapper nom categorie">
                            @error('file')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="submit">Okay</button><button
                            class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 <!--Modal Modifier-->
 @foreach ($products as $index => $p)
   <div class="modal fade" id="editProducts{{$p->id}}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier Produit</h5><button class="btn p-1"
                        type="button" data-bs-dismiss="modal" aria-label="Close"><svg
                            class="svg-inline--fa fa-times fa-w-11 fs--1" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 352 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                        </svg><!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com --></button>

                </div>
                <form action="/admin/products/update" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <img src="{{asset('uploads')}}/{{ $p->photo }}" width="150" alt="">
                        <input type="hidden" name="idproduit" value="{{$p->id}}">
                        <div class="mb-3">
                           
                            <label class="form-label" for="exampleFormControlInput1"> Categorie Produit  (No modifiable) </label>
                           
                                @foreach($categories as $c)
                                 @if ($c->id== $p->category_id)
                                  <input  class="form-control" id="exampleFormControlInput1" type="text" name="catproduit" value="{{$c->name}}">
                                 @endif
                                 
                                
                                @endforeach
                          
                            @error('catproduit')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Nom Produit </label>
                            <input name="name" value="{{$p->name}}" class="form-control" id="exampleFormControlInput1" type="text"
                                placeholder="tapper nom produit">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-0">
                            <label class="form-label" for="exampleTextarea">Description Produit </label>
                            <textarea name="description" class="form-control" rows="3" placeholder="tapper description produit"> {{$p->description}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Prix Produit </label>
                            <input name="price" value="{{$p->price}}" class="form-control" id="exampleFormControlInput1" type="number"
                                placeholder="tapper prix produit">
                            @error('price')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Quantite Produit </label>
                            <input name="qte" value="{{$p->qte}}"class="form-control" id="exampleFormControlInput1" type="number"
                                placeholder=" tapper quantite produit">
                            @error('qte')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlInput1">Image Produit </label>
                            <input name="photo" class="form-control" id="exampleFormControlInput1" type="file"
                                placeholder="tapper nom categorie">
                            @error('file')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="submit">Okay</button><button
                            class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

    <script src="{{ asset('dashassets/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashassets/js/ecommerce-dashboard.js') }}"></script>
</body>

</html>
