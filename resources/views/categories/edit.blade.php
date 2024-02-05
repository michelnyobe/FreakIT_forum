


    <h1>Modifier la catégorie</h1>

    <!-- Formulaire de mise à jour avec les champs pré-remplis -->
    <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Vos champs de formulaire ici avec les valeurs pré-remplies -->
        <label for="intitule">Intitulé :</label>
        <input type="text" name="intitule" value="{{ old('intitule', $categorie->intitule) }}" required>

        <label for="details">Détails :</label>
        <textarea name="details">{{ old('details', $categorie->details) }}</textarea>

        <!-- Autres champs du formulaire -->

        <button type="submit">Mettre à jour</button>
    </form>
