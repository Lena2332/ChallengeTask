<div class="raw text-center">
    <a href="/store/add">
        <button type="button" class="btn btn-success mb-5 w-23">
            <i class="fa fa-plus" aria-hidden="true"></i> Add new store
        </button>
    </a>
</div>

<?php   if ( !empty($list) ) { ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">Name</th>
            <th scope="col">Company</th>
            <th scope="col">Country</th>
            <th scope="col">City</th>
            <th scope="col">Address</th>
            <th scope="col">Zipcode</th>
            <th scope="col">Longitude</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php /** @var \Project\Models\Store $store */ ?>

        <?php foreach ( $list as $store ) { ?>

            <tr>
                <th scope="row"><?php echo $store->getId(); ?></th>
                <td><?php echo $store->getName(); ?></td>
                <td><?php echo $store->getCompanyName(); ?></td>
                <td><?php echo $store->getCountry(); ?></td>
                <td><?php echo $store->getCity(); ?></td>
                <td><?php echo $store->getAddress(); ?></td>
                <td><?php echo $store->getZip(); ?></td>
                <td><?php echo $store->getLongitude(); ?></td>

                <td>
                    <a href="/store/<?php echo $store->getId(); ?>">
                        <button type="button" class="btn btn-outline-success btn-sm" title="Edit company">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                    </a>
                    &nbsp;
                    <button type="button"
                            data-id="<?php echo $store->getId(); ?>"
                            data-type="store"
                            class="btn btn-outline-danger btn-sm remove"
                            title="Remove store">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal" id="confirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to remove this store?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary confirm-remove">Yes</button>
                </div>
            </div>
        </div>
    </div>

<?php    } else { ?>
    <div class = 'class="alert alert-warning" role="alert"'>Unfortunately, stores have not been added yet </div>
<?php    }  ?>

