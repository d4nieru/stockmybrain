<h1>Modification de la Tâche</h1>

    <form action="/edit/{{$task["id"]}}" method="post">
        @csrf

        <input type="text" name="nom" placeholder="Nom de la tâche">

        <input type="text" name="description" placeholder="Déscription de la tâche" size="20" maxlength="30">

        {{-- <input type="date" name="date" placeholder="Date de création"> --}}

        <select name="importance">
            <option selected disabled>--Choisissez le type de contrat--</option>
            <option value="Pas Urgent">Pas urgent</option>
            <option value="Peu Urgent">Peu urgent</option>
            <option value="Urgence">Urgent</option>
            <option value="Urgence modéré">Très urgent</option>
            <option value="Urgence prioritaire">À faire en priorité !</option>
        </select>

        <input type="submit" name='sub' value="Enregistrez">

    </form>