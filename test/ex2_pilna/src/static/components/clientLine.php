<div class="row valign-wrapper <?= ($index % 2 == 0) ? "light-green lighten-4" : "brown lighten-4" ?>" style="margin: 0;">
    <div class="col s3">
        <label>
            <input type="checkbox" id="<?= $index ?>" name="<?= $client["numTel"] ?>"/>
            <span></span>
        </label>
    </div>

    <div class="col s9">
        <?= $client["nom"] ?>
    </div>
</div>