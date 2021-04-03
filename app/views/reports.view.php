<?php require('partials/head.php') ?>

<div class="container">


    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-sm">

                <?php if (count($branchesWithHighestBalance)) : ?>

                    <h2>Branches along with the highest balance at each.</h2>
                    
                    <table class="table table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>MAX balance</th>
                            </tr>
                        </thead>

                        <?php foreach ($branchesWithHighestBalance as $row) : ?>

                            <tr>
                                <td><?= $row->id ?></td>
                                <td><?= $row->name ?></td>
                                <td><?= $row->location ?></td>
                                <td><?= is_null($row->max_balance) ? 0 : $row->max_balance ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </table>

                <?php endif; ?>
                
            </div>
            <div class="col-sm">
                
                <?php if (count($branchesWithHighestBalance)) : ?>

                    <h2>Branches that have more than two customers with a balance over <?= number_format($amount, 2) ?></h2>

                    <table class="table table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Location</th>
                            </tr>
                        </thead>

                        <?php foreach ($branchesWithTwoCustomersMoreThenXAmount as $row) : ?>

                            <tr>
                                <td><?= $row->id ?></td>
                                <td><?= $row->name ?></td>
                                <td><?= $row->location ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </table>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div> 

<?php require('partials/footer.php') ?>



