<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <ul class="navbar-nav bd-navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link <?= $pagetitle == 'Branches' ? 'active' : '' ?>" href="/chessable/">Branches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pagetitle == 'Users' ? 'active' : '' ?>" href="/chessable/users">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pagetitle == 'Transactions' ? 'active' : '' ?>" href="/chessable/transactions">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pagetitle == 'Reports' ? 'active' : '' ?>" href="/chessable/reports">Reports</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>