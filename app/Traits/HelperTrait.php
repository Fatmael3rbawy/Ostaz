<?php

namespace App\Traits;

use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;

trait HelperTrait
{
    public function uploadImages($imageRequest, $placeMove)
    {
        $img = time() . md5(uniqid()) . "." . $imageRequest->guessExtension();
        $path = $imageRequest->storeAs($placeMove, $img, 'public');

        return  '/storage/'.$path;
    }
    public function sendNotification(array $tokens , array $data, array $additional_data)
    {
        $deviceTokens = $tokens;
        $notification = Notification::create($data['title'], $data['body']);

        $messaging = app('firebase.messaging');

        // $message = CloudMessage::withTarget('token',$token)->withNotification($notification);
        $message =  CloudMessage::new()->withNotification($notification)->withData($additional_data);
        $messaging = app('firebase.messaging');
        // try {
        //     // $messaging->validate($message);
        //     // $response = $messaging->send($message);
        //     $response = $messaging->sendMulticast($message, $deviceTokens);
        // } catch (InvalidMessage $e) {
        //     $response = $e->errors();
        // }
        $response = $messaging->sendMulticast($message, $deviceTokens);
        return $response;
    }

    public function sendNotification1(array $tokens , array $data)
    {
        $data = [
            'message' => [
                "registration_ids" => $tokens,
                "notification" => [
                    "title" => $data['title'],
                    "body" => $data['body'],  
                ],
            ],
        ];

        $dataString = json_encode($data);
        $SERVER_API_KEY = env('FCM_SERVER_KEY');
        $PROJECT_NAME = env('FCM_PROJECT_NAME');
        $url = 'https://fcm.googleapis.com/v1/projects/'.$PROJECT_NAME.'/messages:send';

        $headers = [
            'Authorization: Bearer ' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
      
        $ch = curl_init();
        
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                 
        $response = curl_exec($ch);
        return $response;
    }
}
