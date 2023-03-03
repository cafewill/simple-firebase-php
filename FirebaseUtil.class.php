<?php
class FirebaseUtil 
{
    public static $SUCCESS = 100;
    public static $PARTIAL = 200;
    public static $FAILURE = 400;
    
    private static $ENCODING = "UTF-8";
    private static $FIREBASE_SERVER = "https://fcm.googleapis.com/fcm/send";
    private static $FIREBASE_SERVER_KEY = "FIREBASE-SERVER-KEY";
    
    public static function send ($token, $title, $body, $link = null)
    {
        $status = self:: $FAILURE;
        
        $response = FirebaseUtil:: exec ($token, $title, $body, $link);
        $data = json_decode ($response, true); $success = $data ["success"];
        $check = 1; if ("array" == gettype ($token)) $check = count ($token);
        if (0 == $success) $status = self:: $FAILURE;
        if ($check == $success) $status = self:: $SUCCESS;
        if (0 < $success && $check > $success) $status = self:: $PARTIAL;
        
        return $status;
    }
    
    public static function exec ($token, $title, $body, $link = null)
    {
        $notification = array ();
        $notification ["title"] = $title;
        $notification ["body"] = $body;
        $notification ["icon"] = "default";
        $notification ["sound"] = "default";
        
        $request = array ();
        if ("array" == gettype ($token)) { $request ["registration_ids"] = $token; } else { $request ["to"] = $token; }
        $request ["notification"] = $notification;
        if (null != $link)
        {
            $data = array ();
            $data ["link"] = $link;
            $request ["data"] = $data;
        }
        $response = FirebaseUtil:: post (json_encode ($request));

        return ($response);
    }

    public static function post ($data) 
    {
        $headers = array ();
        $headers [] = "Accept-Charset: " . self:: $ENCODING;
        $headers [] = "Authorization: key=" . self:: $FIREBASE_SERVER_KEY;
        $headers [] = "Content-Type: application/json; Charset=" . self:: $ENCODING;

        $client = curl_init ();
        curl_setopt ($client, CURLOPT_VERBOSE, true);
        // curl_setopt ($client, CURLOPT_TIMEOUT, 30);
        curl_setopt ($client, CURLOPT_POST, true);
        curl_setopt ($client, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($client, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt ($client, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($client, CURLOPT_URL, self:: $FIREBASE_SERVER);
        curl_setopt ($client, CURLOPT_ENCODING, self:: $ENCODING);
        curl_setopt ($client, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec ($client);
        curl_close ($client);

        return $response;
    }
}
?>

