<div class="col-md-3">
</div>

<?php /** @var \Project\Models\Store $storeData */ ?>
<?php /** @var int $companyId */ ?>

<form class="col-md-6"
      method="post"
      action="<?php echo $_SERVER['REQUEST_URI']; ?>"
>
    <div class="mb-3">
        <select class="form-select" name="company_id" aria-label="Company" required>
            <option selected>Choose company</option>
            <?php   if ( !empty($companyList) ) { ?>
                <?php foreach ( $companyList as $company ) { ?>
                    <option value="<?php echo $company->getId(); ?>"
                    <?php   if ( $companyId == $company->getId()) { ?>
                          selected
                    <?php    }  ?>
                    >
                        <?php echo $company->getName(); ?>
                    </option>
                <?php    }  ?>
            <?php    }  ?>
        </select>
        <?php if ( isset($_SESSION['errors']['company_id']) ) { ?>
            <div class="form-text text-danger"><?php echo $_SESSION['errors']['company_id']; ?></div>
        <?php } ?>
    </div>

    <div class="mb-3">
        <label for="storeName" class="form-label">Store name <sub class="text-danger">*</sub></label>
        <input
            type="text"
            name="name"
            class="form-control"
            id="storeName"
            <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                value="<?php echo $_SESSION['old_form_data']['name']; ?>"
            <?php } elseif ( isset($storeData)) { ?>
                value="<?php echo $storeData->getName(); ?>"
            <?php } ?>
            required
        >

        <?php if ( isset($_SESSION['errors']['name']) ) { ?>
            <div class="form-text text-danger"><?php echo $_SESSION['errors']['name']; ?></div>
        <?php } ?>
    </div>

    <div class="row mb-3">
        <div class="col col-md-8">
            <label for="address" class="form-label">Address <sub class="text-danger">*</sub></label>
            <input
                type="text"
                name="address"
                class="form-control"
                id="address"
                <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                    value="<?php echo $_SESSION['old_form_data']['address']; ?>"
                <?php } elseif ( isset($storeData)) { ?>
                    value="<?php echo $storeData->getAddress(); ?>"
                <?php } ?>
                required
            >

            <?php if ( isset($_SESSION['errors']['address']) ) {  ?>
                <div class="form-text text-danger"><?php echo $_SESSION['errors']['address']; ?></div>
            <?php } ?>
        </div>
        <div class="col col-md-4">
            <label for="longitude" class="form-label">Longitude </label>
            <input
                    type="text"
                    name="longitude"
                    class="form-control"
                    id="longitude"
                <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                    value="<?php echo $_SESSION['old_form_data']['longitude']; ?>"
                <?php } elseif ( isset($storeData)) { ?>
                    value="<?php echo $storeData->getLongitude(); ?>"
                <?php } ?>
            >

            <?php if ( isset($_SESSION['errors']['longitude']) ) {  ?>
                <div class="form-text text-danger"><?php echo $_SESSION['errors']['longitude']; ?></div>
            <?php } ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col col-md3">
            <label for="city" class="form-label">City <sub class="text-danger">*</sub></label>
            <input
                type="text"
                name="city"
                class="form-control"
                id="city"
                <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                    value="<?php echo $_SESSION['old_form_data']['city']; ?>"
                <?php } elseif ( isset($storeData)) { ?>
                    value="<?php echo $storeData->getCity(); ?>"
                <?php } ?>
            >

            <?php if ( isset($_SESSION['errors']['city']) ) {  ?>
                <div class="form-text text-danger"><?php echo $_SESSION['errors']['city']; ?></div>
            <?php } ?>
        </div>
        <div class="col col-md3">
            <label for="zip" class="form-label">Zipcode <sub class="text-danger">*</sub></label>
            <input
                type="text"
                name="zip"
                class="form-control"
                id="zip"
                <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                    value="<?php echo $_SESSION['old_form_data']['zip']; ?>"
                <?php } elseif ( isset($storeData)) { ?>
                    value="<?php echo $storeData->getZip(); ?>"
                <?php } ?>
           >

           <?php if ( isset($_SESSION['errors']['zip']) ) {  ?>
               <div class="form-text text-danger"><?php echo $_SESSION['errors']['zip']; ?></div>
           <?php } ?>
       </div>
       <div class="col col-md3">
            <label for="country" class="form-label">Country <sub class="text-danger">*</sub></label>
            <input
                type="text"
                name="country"
                class="form-control"
                id="country"
                <?php if ( isset($_SESSION['old_form_data']) ) { ?>
                    value="<?php echo $_SESSION['old_form_data']['country']; ?>"
                <?php } elseif ( isset($storeData)) { ?>
                    value="<?php echo $storeData->getCountry(); ?>"
                <?php } ?>
            >

            <?php if ( isset($_SESSION['errors']['country']) ) {  ?>
                <div class="form-text text-danger"><?php echo $_SESSION['errors']['country']; ?></div>
            <?php } ?>
        </div>
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




