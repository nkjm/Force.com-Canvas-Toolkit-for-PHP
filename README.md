How to use 
================================

Sample Code
------------------------------------------------------------------------------------------------------
    <?php
    // Import toolkit
    require_once "SignedRequest.php";
    
    ini_set('display_errors', 'stdout');
    
    // Initialte instance of SignedRequest class assigning consumer secret of the connected app.
    $sr = new SignedRequest(CONSUMER_SECRET);
    
    // Call validate_signed_request method to validate recieved signed request. True will be returned if validation succeeds. False will be returned if validation fails.
    if(!$sr->validate_signed_request()){
        trigger_error("Validation Failed.", E_USER_ERROR);
    }
    
    // By executing set_canvas_request method, canvas request are assigned to $sr->canvas_request property.
    $sr->set_canvas_request();
    
    // For example, you can access oauthToken and instanceUrl as follows.
    echo $sr->canvas_request->client->oauthToken;
    echo $sr->canvas_request->client->instanceUrl;
    ?>
