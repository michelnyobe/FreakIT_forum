@extends('layouts.forum')

@section('content')

<section class="question-area pt-40px pb-40px">
    <div class="container">
        <div class="filters pb-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">
                <h3 class="fs-22 fw-medium">Users</h3>
                <a href="{{ route('post.create')}}" class="btn theme-btn theme-btn-sm">Publier un sujet</a>
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <form method="post" class="mr-3 w-25">
                    <div class="form-group">
                        <input class="form-control form--control form-control-sm h-auto lh-34" type="text" name="search" placeholder="Filter by user">
                        <button class="form-btn" type="button"><i class="la la-search"></i></button>
                    </div>
                </form>
                <div class="btn-group btn--group mb-3" role="group" aria-label="Filter button group">
                    <a href="{{ route('post.index')}}" class="btn active">tous les sujets</a>
                    <a href="{{ route('categories.index')}}" class="btn">les categories</a>
                   
                    
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($users as $user) 
            <div class="col-lg-3 responsive-column-half">
                <div class="media media-card p-3">
                    <a href="#" class="media-img d-inline-block flex-shrink-0">
                        @if ($user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="avatar">
                                        @else
                                        <img src="{{ asset('img/avatar.jpg') }}" alt="avatar" >
                                        @endif
                    </a>
                    <div class="media-body">
                        <h5 class="fs-16 fw-medium"><a href="user-profile.html">{{ $user->name}}</a></h5>
                        <small class="meta d-block lh-24 pb-1"><span>{{ $user->roles->intitule }}</span></small>
                        <p class="fw-medium fs-15 text-black-50 lh-18">
                            @if($user->actived)
                            <p>En ligne</p>
                            @else
                            <p>Hors ligne</p>
                        @endif
                        </p>
                        <div class="form-group">

                            <input type="range" min="1" max="2" value="{{ $user->roles_id }}" class="slider" id="roleSlider{{ $user->id }}">
                        </div>
 
                    </div><form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')" class="btn btn-danger" >Supprimer</button>
                    </form>
                    
                </div>
            </div>
            @endforeach
        </div>       
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliders = document.querySelectorAll('.slider');
        sliders.forEach(slider => {
            slider.addEventListener('input', function() {
                const selectedRoleId = this.value;
                const userId = this.id.replace('roleSlider', '');
                updateRole(userId, selectedRoleId);
            });
        });
    });

    function updateRole(userId, roleId) {
        // Envoyer une requête AJAX pour mettre à jour le rôle de l'utilisateur
        fetch(`/user/${userId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ roles_id: roleId })
        })
        .then(response => {
            if (response.ok) {
                
                console.log(`Rôle de l'utilisateur ${userId} mis à jour avec succès`);
                // Recharger la page /userlist
               
                location.reload();
            } else {
                console.error(`Erreur lors de la mise à jour du rôle de l'utilisateur ${userId}`);
            }
        })
        .catch(error => console.error(`Erreur lors de la mise à jour du rôle de l'utilisateur ${userId}:`, error));
        
    }
   
</script>

@endsection