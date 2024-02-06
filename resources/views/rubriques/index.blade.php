@extends('layouts.forum')

@section('content')
    @php
    use App\Http\Controllers\RubriqueController;
    @endphp
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
<section class="question-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 pr-0">
                <div class="sidebar position-sticky top-0 pt-40px">
                    <ul class="generic-list-item generic-list-item-highlight fs-15">
                      
                        <li class="lh-26"><a href="{{ route('userlist')}}"><i class="la la-user mr-1 text-black"></i> Utilisateurs</a></li>
                       
                        <li class="lh-26"><a href="{{ route('categories.index')}}"><i class="la la-sort mr-1 text-black"></i> Categories</a></li>
                    </ul>
                </div><!-- end sidebar -->
            </div><!-- end col-lg-2 -->
            <div class="col-lg-7 px-0">
                <div class="question-main-bar border-left border-left-gray pt-40px pb-40px">
                    <div class="filters pb-4 pl-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">
                            <h3 class="fs-22 fw-medium">Tous les sujets</h3>
                            <a href="{{ route('post.create')}}" class="btn theme-btn theme-btn-sm">creer un sujet</a>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <p class="pt-1 fs-15 fw-medium lh-20">{{ $totalRubriques }} Sujets</p>
                            
                        </div>
                    </div><!-- end filters -->
                    <div class="questions-snippet border-top border-top-gray">
                    @foreach($rubriquesWithCommentsCount->reverse() as $rubrique)
                        <div class="media media-card rounded-0 shadow-none mb-0 bg-transparent p-3 border-bottom border-bottom-gray">
                            <div class="votes text-center votes-2">
                                <div class="vote-block">
                                    <span class="vote-counts d-block text-center pr-0 lh-20 fw-medium">NaN</span>
                                    <span class="vote-text d-block fs-13 lh-18">j'aime</span>
                                </div>
                                <div class="answer-block answered my-2">
                                    <span class="answer-counts d-block lh-20 fw-medium">{{ $rubrique->commentaires->first()->commentaire_count ?? 0 }}</span>
                                    <span class="answer-text d-block fs-13 lh-18">messages</span>
                                </div>
                                <div class="view-block">
                                    <span class="view-counts d-block lh-20 fw-medium">NaN</span>
                                    <span class="view-text d-block fs-13 lh-18">vue</span>
                                </div>
                            </div>
                            <div class="media-body">
                                <h5 class="mb-2 fw-medium"><a href="{{ route('post.show', $rubrique->id) }}">{{ $rubrique->titre }}</a></h5>
                                @if($rubrique->image === "NULL")
                                <p class="mb-2 truncate lh-20 fs-15">{!! RubriqueController::rendreLiensCliquables($rubrique->message) !!}</p>
                                @else
                                    <p class="mt-4"><p class="mb-2 truncate lh-20 fs-15">{!! RubriqueController::rendreLiensCliquables($rubrique->message) !!}</p>
                                        <img src="{{ $rubrique->image }}" width="250px" height="250px">
                                    </p>
                                @endif
                                <div class="media media-card user-media align-items-center px-0 border-bottom-0 pb-0">
                                    <a href="#" class="media-img d-block">
                                        @if ($rubrique->users->profile_photo_path)
                                        <img src="{{ asset('storage/' . $rubrique->users->profile_photo_path) }}" alt="avatar">
                                        @else
                                        <img src="{{ asset('img/avatar.jpg') }}" alt="avatar" >
                                        @endif
                                    </a>
                                    <div class="media-body d-flex flex-wrap align-items-center justify-content-between">
                                        <div>
                                            <h5 class="pb-1"><a href="#">{{ $rubrique->users->name}}</a></h5>
                                            @if($rubrique->users->actived)
                                            <h6 style="font-size: 10px">En ligne</h6>
                                            @else
                                            <h6 style="font-size: 10px">Hors ligne</h6>
                                            @endif
                                        </div>
                                        <small class="meta d-block text-right">
                                            @if($rubrique->etat == 1)
                                            <span class="text-black d-block lh-18"><span class="ball gold" style="width: 10px; height: 10px;"></span>ouvert</span>
                                            @else
                                            <span class="text-black d-block lh-18"><span class="ball silver" style="width: 10px; height: 10px;"></span>ferme</span>
                                            @endif
                                            <span class="d-block lh-18 fs-12">{{ $rubrique->created_at->diffForHumans() }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    </div>
                    <div class="pager pt-30px px-3 center">
                        <nav aria-label="Page navigation example items-center">
                            <ul class="pagination generic-pagination pr-1 items-center">
                                
                                {{ $rubriquesWithCommentsCount->links('pagination::bootstrap-4') }} 
                                 
                            </ul>
                        </nav>
                       
                    </div>
                </div><!-- end question-main-bar -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-3">
                <div class="sidebar pt-40px">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="fs-17 pb-3">Sujets frequents</h3>
                            <div class="divider"><span></span></div>
                            @foreach($rubriquefreaquents as $sujet) 
                            <div class="sidebar-questions pt-3">
                                <div class="media media-card media--card media--card-2">
                                    <div class="media-body">
                                        <h5><a href="{{ route('post.show', $sujet->id) }}">{{ $sujet->titre}}</a></h5>
                                        <small class="meta">
                                            <p>{{ \Illuminate\Support\Str::limit($sujet->message, 20, $end='...') }}</p>
                                            <span class="pr-1">. par</span>
                                            <a href="#" class="author">{{ $sujet->users->name}}</a>
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                              
                            </div><!-- end sidebar-questions -->
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="fs-17 pb-3">les categories</h3>
                            <div class="divider"><span></span></div>
                            <div class="tags pt-4">
                                @foreach($categories as $categorie)
                                <div class="tag-item">
                                    <a href="{{ route('categories.show', $categorie->id)}}" class="tag-link tag-link-md">{{ $categorie->intitule}}</a>
                                    <span class="item-multiplier fs-13">
                                    <span>x</span>
                                    <span>{{ $categorie->rubriques_count}} sujet</span>
                                    </span>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div><!-- end card -->
                    
                </div><!-- end sidebar -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection
