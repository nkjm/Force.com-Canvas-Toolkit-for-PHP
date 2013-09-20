<?php
class SignedRequest {
    // consumer secret of the connected app
    public $consumer_secret;

    // context of signed request will be set when set_context is called
    public $canvas_request;

    public function __construct($consumer_secret){
        $this->consumer_secret = $consumer_secret;
    }

    private function extract_signed_request(){
        if (empty($_POST)){
            trigger_error("Signed Request is not set", E_USER_ERROR);
            return false;
        }
        if (!array_key_exists("signed_request", $_POST)){
            trigger_error("Signed Request is not set", E_USER_ERROR);
            return false;
        }

        // split signed request with "."
        $sr_r = explode('.', $_POST["signed_request"], 2);

        if (count($sr_r) != 2){
            trigger_error("Signed Request is invalid format.", E_USER_ERROR);
            return false;
        }
        return($sr_r);
    }


    /*
     * function to validate signed request
     */
    public function validate_signed_request(){
        // recieve signed request from POST
        $sr_r = $this->extract_signed_request();

        if (empty($this->consumer_secret)){
            trigger_error("CONSUMER SECRET is not set.", E_USER_ERROR);
            return false;
        }

        // calculate signed encoded context
        $calculated_value = base64_encode(hash_hmac("sha256", $sr_r[1], $this->consumer_secret, true));

        // validate signed encoded context
        if ($sr_r[0] == $calculated_value){
            return true;
        } else {
            return false;
        }
    }

    public function get_canvas_request_in_json(){
        $sr_r = $this->extract_signed_request();
        return base64_decode($sr_r[1]);
    }


    /*
     * function to set canvas request to property
     */
    public function set_canvas_request(){
        $this->canvas_request = json_decode($this->get_canvas_request_in_json());
    }
}
?>
