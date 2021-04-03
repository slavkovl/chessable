<?php require('partials/head.php') ?>

<div class="container">

    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-sm">
                <h3>Users:</h3>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-sm">

                <?php if (count($users)) : ?>

                    <table class="table table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Branch</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Balance</th>
                            </tr>
                        </thead>

                        <?php foreach ($users as $user) : ?>

                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= $user->branch_name ?></td>
                                <td><?= $user->firstname ?></td>
                                <td><?= $user->lastname ?></td>
                                <td><?= $user->balance ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </table>

                <?php endif; ?>
            </div>
            <div class="col-sm">
                
                <h4>Add new User</h4>
                
                <?php require('partials/form_errors.php') ?>

                <form action="" method="post">
                    
                    <div class="form-group">
                        <label for="branch">Branch</label>
                        <select name="branch_id" class="form-control">
                            <option value="0"></option>
                            <?php foreach ($branches as $branche) : ?>
                                <option value="<?= $branche->id ?>" <?= $branche->id == $data['branch_id'] ? 'selected' : '' ?>><?= $branche->name ?></option>
                            <?php endforeach; ?>                                
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" value="<?= $data['firstname'] ?? ''; ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $data['lastname'] ?? ''; ?>" />
                    </div>
                    
                    <div class="form-group">
                        <label for="balance">Balance</label>
                        <input type="text" name="balance" class="form-control" id="balance" value="<?= $data['balance'] ?? '0.00'; ?>" />
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>
        </div>
    </div>
</div> 

<?php require('partials/footer.php') ?>



