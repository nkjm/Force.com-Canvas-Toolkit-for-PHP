<html>
<head>
    <meta charset="utf-8">
    <title>Sign in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet"></link>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap-responsive.min.css" rel="stylesheet"></link>
</head>
<body>
    <div class="alert alert-<?php echo $sr_validation_result; ?>">
        <?php
        if ($sr_validation_result == 'success'){
            echo 'Signed Request validation SUCCESS!!';
        } else {
            echo 'Failed to validate Signed Request.';
        }
        ?>
    </div>
    <?php 
    if (!is_null($sr->canvas_request)){
    ?>
    <table class="table">
        <tr>
            <th>Full Name</th>
            <th>Username</th>
        </tr>
        <tr>
            <td><?php echo $sr->canvas_request->context->user->fullName; ?></td>
            <td><?php echo $sr->canvas_request->context->user->userName; ?></td>
        </tr>
    </table>
    <?php
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</body>
</html>
