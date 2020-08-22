<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Open+Sans&family=Montserrat&family=Noto+Sans&family=Poppins&family=Raleway&family=Roboto&family=Ubuntu&family=PT+Sans&display=swap" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('/public_assets/css/payment.css') ?>" />
    <script>
        const BASE_URL = "<?= base_url() ?>"
    </script>
</head>


<body>
    <div class="d-flex justify-content align-items-center">
        <div class="container">
            <div class="card">
                <!-- Payment form -->
                <form class="form-row" action="<?= base_url('/payments') ?>" method="POST" id="payment-form">
                    <div class="col-12">
                        <div id="card-error" role="alert">
                            <?php if (null !== session('formerror')) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <?= session('formerror') ?>
                                </div>
                            <?php elseif (null !== session('formsuccess')) : ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <?= session('formsuccess') ?>
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control  <?= isset(session('error')['name']) ? 'is-invalid' : '' ?> " placeholder="Full name" autofocus="">
                            <?php if (isset(session()->error['name'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->error['name'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" class="form-control  <?= isset(session('error')['phone']) ? 'is-invalid' : '' ?> " placeholder="Mobile No">
                            <?php if (isset(session()->error['phone'])) : ?>
                                <div class="invalid-feedback">
                                    <?= session()->error['phone'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div id="card-number"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div id="card-expiry"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <div id="card-cvv"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-dark" id="payBtn">Pay <?= $amount ?></button>


                </form>
            </div>
        </div>
    </div>


    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?= base_url('/public_assets/js/client.js') ?>" defer></script>

</body>

</html>