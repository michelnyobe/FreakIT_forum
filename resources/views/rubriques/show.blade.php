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
  </div>
<section class="hero-area bg-white shadow-sm overflow-hidden pt-40px pb-40px">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="hero-content">
                    <h2 class="section-title pb-2 fs-24 lh-34">Exprimez-vous en créant un nouveau sujet.<br>
                        chaque sujet que vous publiez peut inspirer
                    </h2>
                    <p class="lh-26"> Nous sommes impatients de découvrir vos pensées et de  
                        <br> construire ensemble une communauté dynamique.
                    </p>
                    <ul class="generic-list-item pt-3">
                    </ul>   
                </div><!-- end hero-content -->
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="hero-btn-box text-right py-3">
                    <a href="{{ route('post.create')}}" class="btn theme-btn">publier un sujet</a>
                </div>
                <div class="hero-btn-box text-right py-3">
                    <a href="{{ route('post.index')}}" class="btn theme-btn">Tous les sujet</a>
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@php
    use App\Http\Controllers\RubriqueController;
    $commentsExist = count($commentaire) > 0;
@endphp
<section class="question-area pt-40px pb-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="question-main-bar mb-50px">
                    <div class="question-highlight">
                        <div class="media media-card shadow-none rounded-0 mb-0 bg-transparent p-0">
                            <div class="media-body">
                                <div class="media media-card user-media align-items-center">
                                            <a href="{{ asset('storage/' . $rubrique->users->profile_photo_path) }}"" class="media-img d-block">
                                                @if ($rubrique->users->profile_photo_path)
                                                <img src="{{ asset('storage/' . $rubrique->users->profile_photo_path) }}" alt="avatar">
                                                @else
                                                <img src="{{ asset('img/avatar.jpg') }}" alt="avatar" >
                                                @endif
                                            </a>
                                            <h5 class="pb-1">{{ $rubrique->users->name}}</h5>
                                            @if($rubrique->users->actived)
                                            <h6 style="font-size: 10px">En ligne</h6>
                                            @else
                                            <h6 style="font-size: 10px">Hors ligne</h6>
                                            @endif
                                </div>
                                <h5 class="fs-20">{{ $rubrique->titre }}</h5>
                                <div class="meta d-flex flex-wrap align-items-center fs-13 lh-20 py-1">
                                    <div class="pr-3">
                                        <span>poste</span>
                                        <span class="text-black">{{ $rubrique->created_at->diffForHumans() }}</span>
                                    </div>
                                    @can( 'update', $rubrique)
                                    <div class="pr-3">
                                        @if($rubrique->etat == 1)
                                        <span class="text-black d-block lh-18"><span class="ball gold" style="width: 10px; height: 10px;"></span>ouvert</span>
                                        <form action="{{ route('post.update', $rubrique->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="etat" value="2">
                                            <button type="submit" class="btn btn-primary">Fermer le sujet</button>
                                        </form>
                                        @else
                                        <form action="{{ route('post.update', $rubrique->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="etat" value="1">
                                            <button type="submit" class="btn btn-primary">ouvrir le sujet</button>
                                        </form>
                                        <span class="text-black d-block lh-18"><span class="ball silver" style="width: 10px; height: 10px;"></span>ferme</span>
                                        @endif
                                    </div>
                                    
                                    @endcan
                                    @can( 'delete', $rubrique)
                                    <form action="{{ route('post.destroy', $rubrique->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette rubrique et tous ses commentaires ?')" class="btn btn-danger">
                                            Supprimer la rubrique
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                                
                            </div>
                        </div><!-- end media -->
                    </div><!-- end question-highlight -->
                    <div class="question d-flex">
                       

                        <div class="question-post-body-wrap flex-grow-1">
                            <div class="question-post-body">
                                @if($rubrique->image === 'NULL')
                                <p class="mt-4">{!! RubriqueController::rendreLiensCliquables($rubrique->message) !!}</p>
                                @else
                                <p class="mt-4">{!! RubriqueController::rendreLiensCliquables($rubrique->message) !!}
                                    
                                </p>
                                <img src="{{ $rubrique->image }}" width="500px" height="500px">
                                @endif
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="subheader d-flex align-items-center justify-content-between">
                        <div class="subheader-title">
                            <h3 class="fs-16">Commentaires</h3>
                        </div>
                        
                    </div>
                    <div class="answer-wrap d-flex">
                      
                        <div class="answer-body-wrap flex-grow-1">
                            <div class="answer-body">
    
        
                            </div>
                            <div class="question-post-user-action">
                                
                                <div class="media media-card user-media align-items-center">
                                    
                                    <div class="media-body d-flex align-items-center justify-content-between">
                                        <div>
                            
                                            @if($commentsExist)
                                            
                                            @foreach($commentaire as $commentaire)
                                            <a href="{{ asset('storage/' . $rubrique->users->profile_photo_path) }}"" class="media-img d-block">
                                                @if ($rubrique->users->profile_photo_path)
                                                <img src="{{ asset('storage/' . $rubrique->users->profile_photo_path) }}" alt="avatar">
                                                @else
                                                <img src="{{ asset('img/avatar.jpg') }}" alt="avatar" >
                                                @endif
                                            </a>
                                            <h5 class="pb-1"><a href="user-profile.html">{{ $commentaire->users->name}}</a></h5>
                                            @if($commentaire->users->actived)
                                            <h6 style="font-size: 10px">En ligne</h6>
                                            @else
                                            <h6 style="font-size: 10px">Hors ligne</h6>
                                            @endif
                                            <div class="bg-gray-100 p-4 mt-4">
                                                {!! RubriqueController::rendreLiensCliquables($commentaire->commentaire) !!}<br/>
                                                <h6 style="font-size: 10px">{{ $commentaire->users->banner}}</h6>
                                            </div>
                                                <small class="meta d-block items-center">
                                                    @can( 'delete', $commentaire)
                                                    <form method="POST" action="{{ route('commentaire.destroy', $commentaire->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</button>
                                                    </form>
                                                    @endcan
                                                    <span class="d-block lh-18 fs-12">{{ $commentaire->created_at->diffForHumans() }}</span>
                                                </small>
                                                     
                                            @endforeach
                                            @else
                                            <!-- Display a message if no comments exist -->
                                            <div class="bg-gray-100 p-4 mt-4">
                                                Aucun commentaire disponible.
                                            </div>
                                            @endif
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div><!-- end answer-body-wrap -->
                    </div><!-- end answer-wrap -->
                    <div class="subheader">
                        <div class="subheader-title">
                            <h3 class="fs-16">Ton commentaire</h3>
                        </div><!-- end subheader-title -->
                    </div><!-- end subheader -->
                    <div class="post-form">
                        @if($rubrique->etat == 1)
                        <form method="POST" action="{{ route('commentaire.store', $rubrique->id) }}" enctype="multipart/form-data" class="pt-3">
                            @csrf
                            <input type="hidden" name="rubriques_id" value="{{ $rubrique->id }}">
                            <div class="input-box">
                                <label class="fs-14 text-black lh-20 fw-medium">commentaire</label>
                                <div class="form-group">
                                    <textarea class="form-control form--control form-control-sm fs-13 user-text-editor " name="commentaire" rows="6" placeholder="Votre commentaire ici..." id="myTextarea"></textarea>
                                </div>
                                <span onclick="toggleSmileys()">😊</span>
                                <div id="smileyContainer">
                                    <span class="hidden" onclick="insertSmiley('😍')">😍</span>
                                    <span class="hidden" onclick="insertSmiley('😂')">😂</span>
                                    <span class="hidden" onclick="insertSmiley('😎')">😎</span>
                                    <span class="hidden" onclick="insertSmiley('😜')">😜</span>
                                    <span class="hidden" onclick="insertSmiley('😇')">😇</span>
                                    <span class="hidden" onclick="insertSmiley('🤩')">🤩</span>
                                    <span class="hidden" onclick="insertSmiley('😋')">😋</span>
                                    <span class="hidden" onclick="insertSmiley('🤔')">🤔</span>
                                    <span class="hidden" onclick="insertSmiley('😢')">😢</span>
                                    <span class="hidden" onclick="insertSmiley('😍')">😍</span>
                                    <span class="hidden" onclick="insertSmiley('😂')">😂</span>
                                    <span class="hidden" onclick="insertSmiley('😎')">😎</span>
                                    <span class="hidden" onclick="insertSmiley('😜')">😜</span>
                                    <span class="hidden" onclick="insertSmiley('😇')">😇</span>
                                    <span class="hidden" onclick="insertSmiley('🤩')">🤩</span>
                                    <span class="hidden" onclick="insertSmiley('😋')">😋</span>
                                    <span class="hidden" onclick="insertSmiley('🤔')">🤔</span>
                                    <span class="hidden" onclick="insertSmiley('😢')">😢</span>
                                    <span class="hidden" onclick="insertSmiley('😄')">😄</span>
                                    <span class="hidden" onclick="insertSmiley('😃')">😃</span>
                                    <span class="hidden" onclick="insertSmiley('😀')">😀</span>
                                    <span class="hidden" onclick="insertSmiley('😅')">😅</span>
                                    <span class="hidden" onclick="insertSmiley('😆')">😆</span>
                                    <span class="hidden" onclick="insertSmiley('😁')">😁</span>
                                    <span class="hidden" onclick="insertSmiley('😸')">😸</span>
                                    <span class="hidden" onclick="insertSmiley('😺')">😺</span>
                                    <span class="hidden" onclick="insertSmiley('😻')">😻</span>
                                    <span class="hidden" onclick="insertSmiley('🙀')">🙀</span>
                                    <span class="hidden" onclick="insertSmiley('😿')">😿</span>
                                    <span class="hidden" onclick="insertSmiley('😹')">😹</span>
                                    <span class="hidden" onclick="insertSmiley('😾')">😾</span>
                                    <span class="hidden" onclick="insertSmiley('😽')">😽</span>
                                    <span class="hidden" onclick="insertSmiley('😼')">😼</span>
                                    <span class="hidden" onclick="insertSmiley('👍')">👍</span>
                                    <span class="hidden" onclick="insertSmiley('👎')">👎</span>
                                    <span class="hidden" onclick="insertSmiley('👌')">👌</span>
                                    <span class="hidden" onclick="insertSmiley('👊')">👊</span>
                                    <span class="hidden" onclick="insertSmiley('✊')">✊</span>
                                    <span class="hidden" onclick="insertSmiley('✌️')">✌️</span>
                                    <span class="hidden" onclick="insertSmiley('🤞')">🤞</span>
                                    <span class="hidden" onclick="insertSmiley('🤟')">🤟</span>
                                    <span class="hidden" onclick="insertSmiley('🤘')">🤘</span>
                                    <span class="hidden" onclick="insertSmiley('👏')">👏</span>
                                    <span class="hidden" onclick="insertSmiley('🙌')">🙌</span>
                                    <span class="hidden" onclick="insertSmiley('👐')">👐</span>
                                    <span class="hidden" onclick="insertSmiley('🤲')">🤲</span>
                                    <span class="hidden" onclick="insertSmiley('🤝')">🤝</span>
                                    <span class="hidden" onclick="insertSmiley('🙏')">🙏</span>
                                    <span class="hidden" onclick="insertSmiley('✍️')">✍️</span>
                                    <span class="hidden" onclick="insertSmiley('💪')">💪</span>
                                    <span class="hidden" onclick="insertSmiley('🤳')">🤳</span>
                                    <span class="hidden" onclick="insertSmiley('💅')">💅</span>
                                    <span class="hidden" onclick="insertSmiley('👂')">👂</span>
                                    <span class="hidden" onclick="insertSmiley('👃')">👃</span>
                                    <span class="hidden" onclick="insertSmiley('👀')">👀</span>
                                    <span class="hidden" onclick="insertSmiley('👁️')">👁️</span>
                                    <span class="hidden" onclick="insertSmiley('👅')">👅</span>
                                    <span class="hidden" onclick="insertSmiley('👄')">👄</span>
                                    <span class="hidden" onclick="insertSmiley('👶')">👶</span>
                                    <span class="hidden" onclick="insertSmiley('🧒')">🧒</span>
                                    <span class="hidden" onclick="insertSmiley('👦')">👦</span>
                                    <span class="hidden" onclick="insertSmiley('👧')">👧</span>
                                    <span class="hidden" onclick="insertSmiley('🧑')">🧑</span>
                                    <span class="hidden" onclick="insertSmiley('👨')">👨</span>
                                    <span class="hidden" onclick="insertSmiley('👩')">👩</span>
                                    <span class="hidden" onclick="insertSmiley('👱')">👱</span>
                                    <span class="hidden" onclick="insertSmiley('👴')">👴</span>
                                    <span class="hidden" onclick="insertSmiley('👵')">👵</span>
                                    <span class="hidden" onclick="insertSmiley('👲')">👲</span>
                                    <span class="hidden" onclick="insertSmiley('👳')">👳</span>
                                    <span class="hidden" onclick="insertSmiley('👮')">👮</span>
                                    <span class="hidden" onclick="insertSmiley('👷')">👷</span>
                                    <span class="hidden" onclick="insertSmiley('💂')">💂</span>
                                    <span class="hidden" onclick="insertSmiley('🕵️')">🕵️</span>
                                    <span class="hidden" onclick="insertSmiley('👩‍⚕️')">👩‍⚕️</span>
                                    <span class="hidden" onclick="insertSmiley('👨‍⚕️')">👨‍⚕️</span>
                                    <span class="hidden" onclick="insertSmiley('👩‍🌾')">👩‍🌾</span>
                                    <span class="hidden" onclick="insertSmiley('👨‍🌾')">👨‍🌾</span>
                                    <span class="hidden" onclick="insertSmiley('👩‍🍳')">👩‍🍳</span>
                                    <span class="hidden" onclick="insertSmiley('👨‍🍳')">👨‍🍳</span>
                                    <span class="hidden" onclick="insertSmiley('👩‍🎓')">👩‍🎓</span>
                                    <span class="hidden" onclick="insertSmiley('👨‍🎓')">👨‍🎓</span>
                                    <span class="hidden" onclick="insertSmiley('👩‍🎤')">👩‍🎤</span>
                                    <span class="hidden" onclick="insertSmiley('👨‍🎤')">👨‍🎤</span>
                                    <span class="hidden" onclick="insertSmiley('👩‍🏫')">👩‍🏫</span>
                                    <span class="hidden" onclick="insertSmiley('👨‍🏫')">👨‍🏫</span>
                                </div>              
                            </div>
                            <button class="btn theme-btn theme-btn-sm" type="submit">Publie ton commentaire</button>
                        </form>              
                        @else
                          <p>impossible de laisser un commentaire</p>              
                        @endif
                        
                    </div>    
                </div>
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="fs-17 pb-3">Number Achievement</h3>
                            <div class="divider"><span></span></div>
                            <div class="row no-gutters text-center">
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color">980k</span>
                                        <p class="fs-14">Questions</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color-2">610k</span>
                                        <p class="fs-14">Answers</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color-3">650k</span>
                                        <p class="fs-14">Answer accepted</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color-4">320k</span>
                                        <p class="fs-14">Users</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-12 pt-3">
                                    <p class="fs-14">To get answer of question <a href="signup.html" class="text-color hover-underline">Join<i class="la la-arrow-right ml-1"></i></a></p>
                                </div>
                            </div><!-- end row -->
                        </div>
                    </div><!-- end card -->
                    
                </div><!-- end sidebar -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<script>
   function toggleSmileys() {
var smileys = document.querySelectorAll('#smileyContainer span');

smileys.forEach(function(smiley) {
smiley.classList.toggle('hidden');
});
}
function insertSmiley(smiley) {
var textarea = document.getElementById("myTextarea");

var cursorPosition = textarea.selectionStart;


var textBefore = textarea.value.substring(0, cursorPosition);
var textAfter = textarea.value.substring(cursorPosition);
textarea.value = textBefore + smiley + textAfter;


textarea.selectionStart = cursorPosition + smiley.length;
textarea.selectionEnd = cursorPosition + smiley.length;

textarea.focus();
}

    // Code JavaScript pour masquer l'alerte après 5 secondes
    setTimeout(function(){
        $('.notif').alert('close');
    }, 5000);
</script>
@endsection
