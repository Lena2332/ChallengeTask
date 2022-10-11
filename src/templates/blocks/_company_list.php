<div class="raw text-center">
    <a href="/company/add">
        <button type="button" class="btn btn-success mb-5 w-23">
            <i class="fa fa-plus" aria-hidden="true"></i> Add new company
        </button>
    </a>
</div>

<?php   if ( !empty($list) ) { ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">Name</th>
            <th scope="col">Organization Number</th>
            <th scope="col">Note</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php /** @var \Project\Models\Company $company */ ?>

        <?php foreach ( $list as $company ) { ?>

            <tr>
                <th scope="row"><?php echo $company->getId(); ?></th>
                <td><?php echo $company->getName(); ?></td>
                <td><?php echo $company->getOrganizationNumber(); ?></td>
                <td><?php echo $company->getNotes(); ?></td>
                <td>
                    <a href="/company/<?php echo $company->getId(); ?>">
                        <button type="button" class="btn btn-outline-success btn-sm" title="Edit company">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                    </a>
                    &nbsp;
                    <a href="/store/add/<?php echo $company->getId(); ?>">
                        <button type="button" class="btn btn-outline-success btn-sm" title="Add store">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                    &nbsp;
                    <button type="button"
                            data-id="<?php echo $company->getId(); ?>"
                            data-type="company"
                            class="btn btn-outline-danger btn-sm remove"
                            title="Remove company">
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
                    <p>Do you really want to remove this company?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary confirm-remove">Yes</button>
                </div>
            </div>
        </div>
    </div>

<?php    } else { ?>
    <div class = 'class="alert alert-warning" role="alert"'>Unfortunately, no companies have been added yet </div>
<?php    }  ?>

