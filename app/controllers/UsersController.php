<?php
class UsersController extends \BaseController {
    public function saveToken()
    {
        $data = Input::all();
        try{
            $gcm = GcmToken::create($data);
            return $gcm->toJson();
        } catch(Exception $e){
            return array();
        }
    }
}
