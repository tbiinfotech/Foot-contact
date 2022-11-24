<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $fillable = [
        'title',
        'logo',
        'description',
        'to_user',
        'from_user',
        'is_read',
        'type',
        'status'
    ];
    public function sendNotifications($deviceTokenArray, $titleArr, $messageArr)
    {
       
        $headers = array(
            "Content-Type: application/json; charset=utf-8"
        );
        $content = array(
            'en' => $titleArr
        );
        $headings = array(
            'en' => $messageArr
        ); 
       $device_token[]=$deviceTokenArray;
        $fields = array(
            'app_id' => '1c922212-a21f-4170-91b8-64ec5a5c74fd',
            'include_player_ids' => $device_token,
            'contents' => $content,
            'headings' => $headings
        );
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $errorno = curl_errno($ch);
        curl_close($ch);
      
        if ($error) {
            $status = false;
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $errorMsg = 'Error: ' . $error . ' Status: ' . $statusCode;
            $responseId = null;
        } else {
            $status = true;
            $errorMsg = '';
            $decodedResp = json_decode($response, true);
            $responseId = isset($decodedResp['id']) ? $decodedResp['id'] : null;
        }
        return array(
            'status' => $status,
            'error_message' => $errorMsg,
            'response_id' => $responseId
        );
    }
}
