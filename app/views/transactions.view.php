<?php require('partials/head.php') ?>

<div class="container">

    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-sm">
                <h3>Transactions:</h3>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-sm">

                <?php if (count($transactions)) : ?>

                    <table class="table table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <?php foreach ($transactions as $transaction) : ?>

                            <tr>
                                <td><?= $transaction->id ?></td>
                                <td><?= $transaction->ufrom_firstname . ' ' . $transaction->ufrom_lastname ?></td>
                                <td><?= $transaction->uto_firstname . ' ' . $transaction->uto_lastname ?></td>
                                <td><?= $transaction->amount ?></td>
                                <td><?= $transaction->f_date ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </table>

                <?php endif; ?>
            </div>
            <div class="col-sm">
                <h4>Make a transfer</h4>
                
                <?php require('partials/form_errors.php') ?>

                <form action="" method="post">
                    
                    <div class="form-group">
                        <label for="branch">From</label>
                        <select name="from_user" class="form-control">
                            <option value="0"></option>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id ?>" <?= $user->id == $data['from_user'] ? 'selected' : '' ?>><?= $user->firstname . ' ' . $user->lastname ?></option>
                            <?php endforeach; ?>                                
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="branch">To</label>
                        <select name="to_user" class="form-control">
                            <option value="0"></option>
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user->id ?>" <?= $user->id == $data['to_user'] ? 'selected' : '' ?>><?= $user->firstname . ' ' . $user->lastname ?></option>
                            <?php endforeach; ?>                                
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="balance">Amount</label>
                        <input type="text" name="amount" class="form-control" id="amount" value="<?= $data['amount'] ?? '0.00'; ?>" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>
        </div>
    </div>
</div> 

<?php require('partials/footer.php') ?>



