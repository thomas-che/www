<div class="row" style='margin: 2% 0'>
    <form class="post-forum-input col s6 offset-s3 z-depth-3" method="POST">
        <div class="row valign-wrapper">
            <div class="input-field col s6">
                <input placeholder="Nom" id="first_name" type="text" name="nom" class="validate">
                <label for="first_name">Nom</label>
            </div>
        
            <div class="input-field col s6">
                <input placeholder="Prenom" id="first_name" type="text" name="prenom" class="validate">
                <label for="first_name">Prenom</label>
            </div>
        </div>

        <div class="row valign-wrapper">
            <div class="input-field col s6">
                <input placeholder="Numero telephone" id="first_name" type="text" name="numtel" class="validate">
                <label for="first_name">Numero telephone</label>
            </div>

            <div class="col s3">
                <label for="Icon_date">Date Born</label>
                <input type="date" class="datepicker" id="datepicker" name="date">
            </div>

            <div class="col s3">
                <button class="btn waves-effect waves-light" type="submit" name="addClient">add Client
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>

    </form>
</div>