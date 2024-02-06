@extends('layouts.forum')

@section('content')
@if(session('warning'))
    <div  class="alert alert-warning alert-dismissible fade show notif" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif
@if(session('success'))
    <div  class="alert alert-success alert-dismissible fade show notif" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif
<section class="question-area pt-40px pb-40px">
    <div class="container">
        <div class="filters pb-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                <div class="pr-3">
                    <h3 class="fs-22 fw-medium">Categories</h3>
                    <p class="fs-15 lh-22 my-2"> classez votre sujet avec d'autres sujets similaires.
                        <br> L'utilisation des bonnes categorie permet aux autres de trouver des sujets plus facilement </p>
                </div>
                <a href="{{ route('categories.create') }}" class="btn theme-btn theme-btn-sm" data-toggle="modal" data-target="#exampleModal">creer une categorie</a>
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <form method="post" class="mr-3 w-25">
                    <div class="form-group">
                        <input class="form-control form--control form-control-sm h-auto lh-34" type="text" name="search" placeholder="trouver une categorie">
                        <button class="form-btn" type="button"><i class="la la-search"></i></button>
                    </div>
                </form>
                <div class=" mb-3" role="group" aria-label="Filter button group">
                    <a href="{{ route('post.create')}}" class="btn btn-primary mr-2">publier un sujet </a> 
                    <a href="{{ route('post.index')}}" class="btn btn-primary">Tous les sujets</a> 
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($categories as $categorie)
            <div class="col-lg-3 responsive-column-half">
                <div class="card card-item">
                    <div class="card-body">
                        <div class="tags pb-1">
                            <a href="{{ route('categories.show', $categorie->id) }}" class="tag-link tag-link-md tag-link-blue">{{ $categorie->intitule }}</a>
                        </div>
                        <p class="card-text fs-14 truncate-4 lh-24 text-black-50">
                            {{ $categorie->details }}
                        </p>
                        
                            
                            <div class="container mt-5 row">
                              
                                <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-primary col-6">Modifier</a>
                            
                                
                                <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" class="col-6">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette categorie?')" class="btn btn-danger">Supprimer</button>
                                </form>
                                
                                
                            </div>
                    
                        <div class="d-flex tags-info fs-14 pt-3 border-top border-top-gray mt-3">
                            <p class="pr-1 lh-18">{{ $categorie->rubriques_count}} sujets</p>
                            <p class="lh-18">{{$categorie->commentaires_count}} commentaires</p>
                        </div>
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvelle categorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire à l'intérieur du modal -->
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="intitule">Intitulé :</label>
                                <input type="text" name="intitule" class="form-control" id="intitule" placeholder="Entrez l'intitulé">
                            </div>
                            <div class="form-group">
                                <label for="details">Détails :</label>
                                <textarea name="details" class="form-control" id="details" rows="3" placeholder="Entrez les détails"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="pager pt-30px">
            <nav aria-label="Page navigation example">
                {{ $categories->links('pagination::bootstrap-4') }}    
            </nav>
            
        </div>
    </div><!-- end container -->
</section><!-- end question-area -->


<script>

setTimeout(function(){
    $('.notif').alert('close');
}, 5000);
</script>
@endsection
