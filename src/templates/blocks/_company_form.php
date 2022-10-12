    <div class="col-md-3">
    </div>

    <?php /** @var \Project\Models\Company $companyData */ ?>

    <form class="col-md-6"
          method="post"
          action="<?php echo $_SERVER['REQUEST_URI']; ?>"
    >
        <div class="mb-3">
            <label for="companyName" class="form-label">Company name <sub class="text-danger">*</sub></label>
            <input
                type="text"
                name="name"
                class="form-control"
                id="companyName"
                <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                    value="<?php echo $_SESSION['old_form_data']['name']; ?>"
                <?php } elseif ( isset($companyData)) { ?>
                    value="<?php echo $companyData->getName(); ?>"
                <?php } ?>
                required
            >

            <?php if ( isset($_SESSION['errors']['name']) ) { ?>
               <div class="form-text text-danger"><?php echo $_SESSION['errors']['name']; ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="orgNum" class="form-label">Organization number <sub class="text-danger">*</sub></label>
            <input
                type="number"
                name="organization_number"
                class="form-control"
                id="orgNum"
                <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                    value="<?php echo $_SESSION['old_form_data']['organization_number']; ?>"
                <?php } elseif ( isset($companyData)) { ?>
                    value="<?php echo $companyData->getOrganizationNumber(); ?>"
                <?php } ?>
                required
            >

            <?php if ( isset($_SESSION['errors']['organization_number']) ) {  ?>
                <div class="form-text text-danger"><?php echo $_SESSION['errors']['organization_number']; ?></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes" id="notes" rows="3"><?php if ( isset($_SESSION['old_form_data']) ) { ?><?php echo $_SESSION['old_form_data']['notes']; ?><?php } elseif ( isset($companyData)) { ?><?php echo $companyData->getNotes(); ?><?php } ?></textarea>
        </div>

        <div class="row mb-3 mt-3 justify-content-between">
            <div class="col-auto me-auto col-md-6">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-auto col-md-3">
                <div class="form-text"><sub class="text-danger">*</sub> Requiered field</div>
            </div>
        </div>
    </form>

    <div class="col-md-3">
    </div>



