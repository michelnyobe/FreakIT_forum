<form method="POST" action="{{ route('commentaire.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="comment_text">Commentaire</label>
        <textarea name="commentaire" id="comment_text" rows="4" cols="50" required class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>