<?php
class UsersController extends \BaseController {
    public function saveToken()
    {
        $data = Input::all();
        try{
            $gcm = GcmToken::create($data);
            return $gcm->toJson();
        } catch(Exception $e){
            $gcm = new GcmToken();
            $gcm->id_user = '';
            $gcm->token = '';
            return json_encode($gcm);;
        }
    }

    public function removeToken()
    {
        $token = Input::get('token','');
        $userId = Input::get('id_user','');
        if ($token && $userId){
            GcmToken::where('token',$token)->where('id_user',$userId)->delete();
        }
    }
}
