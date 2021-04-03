<?php require('partials/head.php') ?>

<div class="container">

    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-sm">
                <h3>Branches:</h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">

                <?php if (count($branches)) : ?>

                    <table class="table table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($branches as $branch) : ?>

                                <tr>
                                    <td><?= $branch->id ?></td>
                                    <td><?= $branch->name ?></td>
                                    <td><?= $branch->location ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </div>
            <div class="col-sm">
                <h4>Add new Branch</h4>

                <?php require('partials/form_errors.php') ?>

                <form action="" method="post">

                    <div class="form-group">
                        <label for="branchName">Name</label>
                        <input type="text" name="name" class="form-control" id="branchName" value="<?= $data['name'] ?? ''; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="branchLocation">Location</label>
                        <textarea name="location" class="form-control" id="branchLocation" rows="3" maxlength="255"><?= $data['location'] ?? ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>
        </div>
    </div>
</div> 

<?php require('partials/footer.php') ?>