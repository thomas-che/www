<div class="row">
    <form class="post-forum-input col s6 offset-s3 z-depth-3" method="POST">
        <div class="row center">
            <?php
                if($clients != null){
                    foreach(array_values($clients) as $index => $client){
                        require("/src/static/components/clientLine.php");
                    }
                } else {
                    echo "<div class=\"row\" style=\"margin: 1%\"> Aucune ligne ne répond a votre requête</div>";
                }
            ?>
            <button class="btn waves-effect waves-light" type="submit" name="deleteClient" style="margin-top: 2%">Delete
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>