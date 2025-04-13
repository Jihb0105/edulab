<?php

namespace App\Http\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Log;
use Illuminate\Support\Facades\Http;
use App\Models\User;
/**
 * Class SyncsWithFirebase
 * @package App\Traits
 */
trait UseZoom
{
    public $client;
    public $jwt;
    public $headers;

    public function __construct()
    {


        $this->client = new Client();
        $this->accessToken = '9EAv4Xi3QxiKDINdfZNwog';

        $this->headers = [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
    }

    /**
     * Display a generateZoomToken.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function generateZoomToken()
    {
        return JWT::generateToken(
            [
                'iss' => config('zoom.api_key'),
                'exp' => time() + config('zoom.token_life')
            ],
            config('zoom.api_secret')
        );
    }*/

    function generateZoomAccessToken()
    {
        $apiKey = '1XGmh5U6TwiISWBfVHKTqA';
        $apiSecret = 'zmOn7DQ4vHH4ArxwI8UkIakUNsxITm0P';
        $account_id = 'cM3FcIPZRQWg9-58Yqzn1w';

        $base64Credentials = base64_encode("$apiKey:$apiSecret");

        $client = new Client(); 

        $response = $client->request('POST', 'https://zoom.us/oauth/token', [
            'headers' => [
                'Authorization' => 'Basic ' . $base64Credentials,
                'Content-Type'  => 'application/x-www-form-urlencoded',
                'Host' => 'zoom.us',
            ],
            'query' => [
                "grant_type" => "account_credentials",
                "account_id" => $account_id
            ],
            'http_errors' => false,
        ]);
    
        // $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $token = json_decode($body, true);

        if (isset($token['access_token'])) {
            return $token['access_token'];
        } else {
            // Log or print the entire response for debugging purposes.
            \Log::error('Zoom OAuth Token Response: ' . json_encode($body));

            // Handle the error as needed.
            return null; // You might want to return null or throw an exception here.
        }
    }
    /**
     * Display a zoomRequest.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function zoomRequest()
    {
        $token = $this->generateZoomToken();

        return \Illuminate\Support\Facades\Http::withHeaders([
            //'authorization' => 'Bearer ' . $token,
            //'content-type' => 'application/json',
        ]);
    }*/

    private function retrieveZoomUrl()
    {
        return env('ZOOM_API_URL', '');
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());

            return '';
        }
    }

    public function create($data)
    {
        
        $accessToken = $this->generateZoomAccessToken();
        
        // $doctor = User::findOrfail(auth()->user()->id);
        
        
        $url = 'https://api.zoom.us/v2/users/'.$doctor->zoom_id.'/meetings';

        $response = Http::withToken($accessToken)->post($url, [
            'topic'      => 'Online Meeting',
            'type'       => self::MEETING_TYPE_SCHEDULE,
            'start_time' => time() + config('zoom.token_life'),
            'duration'   => 1,
            'agenda'     => 'Meeting for Patient',
            'timezone' => 'Africa/Cairo',
        ]);
            return [
                'success' => $response->getStatusCode() === 201,
                'data'    => json_decode($response->getBody(), true),
            ];


        if ($response->successful()) {
            return [
                'success' => $response->getStatusCode() === 201,
                'data'    => json_decode($response->getBody(), true),
            ];
        } else {
            return [
                'success' => $response->getStatusCode() === 201,
                'data'    => json_decode($response->getBody(), true),
            ];
            return response()->json(['error' => 'Failed to create a Zoom meeting'], 500);
        }
    }

    public function createMeeting($data)
    {
        $accessToken = $this->generateZoomAccessToken();
        
        $requestBody = [
            'topic'      => $data->topic ?? 'New Meeting General Talk',
            'type'       => 2,
            'start_time' => $data->start_time ?? date('Y-m-dTh:i:00') . 'Z',
            'duration'   => $data->duration ?? 30,
            'password'   => $data->password ?? mt_rand(),
            'timezone'   => 'Asia/Singapore',
            'agenda'     => 'Video Call',
            'settings'   => [
                'host_video'        => false,
                'participant_video' => true,
                'cn_meeting'        => false,
                'in_meeting'        => false,
                'join_before_host'  => true,
                'mute_upon_entry'   => true,
                'watermark'         => false,
                'use_pmi'           => false,
                'approval_type'     => 0,
                'registration_type' => 0,
                'audio'             => 'voip',
                'auto_recording'    => 'none',
                'waiting_room'      => false,
            ],
        ];

        $client = new Client();

        try {
            $response = $client->request('POST', 'https://api.zoom.us/v2/users/me/meetings', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type'  => 'application/json',
                ],
                'json' => $requestBody,
                'http_errors' => false,
            ]); 
        
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();

            return $body;
        
        } catch (RequestException $e) {
            echo "HTTP Request failed\n";
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $body = $response->getBody()->getContents();
                echo "Status Code: $statusCode\n";
                echo "Error Body: $body\n";
            } else {
                echo $e->getMessage();
            }
        }
    }

    public function updatezoom($id, $data)
    {
        $accessToken = $this->generateZoomAccessToken();
        $url = 'https://api.zoom.us/v2/meetings/' . $id;

        $response = Http::withToken($accessToken)->patch($url, [
            'topic' => 'Online Meeting',
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($data['start_time']),
            'duration' => $data['duration'],
            'agenda' => (!empty($data['agenda'])) ? $data['agenda'] : null,
            'timezone' => 'Africa/Cairo',
        ]);

        if ($response->successful()) {
            // Meeting updated successfully
            return [
                'success' => true,
                'data' => $response->json(),
            ];
        } else {
            // Handle the error
            return response()->json(['error' => 'Failed to update the Zoom meeting'], 500);
        }
    }


    public function get($id)
    {
        $path = 'meetings/' . $id;
        $url = $this->retrieveZoomUrl();
        $this->jwt = $this->generateZoomToken();
        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([]),
        ];

        $response =  $this->client->get($url . $path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
            'data'    => json_decode($response->getBody(), true),
        ];
    }

    /**
     * @param string $id
     *
     * @return bool[]
     */

    public function delete($id)
    {
        $accessToken = $this->generateZoomAccessToken();
        $url = 'https://api.zoom.us/v2/meetings/' . $id;

        $response = Http::withToken($accessToken)->delete($url);

        if ($response->successful()) {
            // Meeting deleted successfully
            return [
                'success' => true,
                'data' => $response->json(),
            ];
        } else {
            // Handle the error
            return response()->json(['error' => 'Failed to delete the Zoom meeting'], 500);
        }
    }

/////////////////////////////////////////////////////



  public function zoomRequest()
    {
        $token = $this->generateZoomAccessToken();

        return \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => 'Bearer ' . $token,
            'content-type' => 'application/json',
        ]);
    }


    public function linkZoom($id, $email)
    {


        $user = User::findOrFail($id);

        if ($user->zoom_id == "") {

            $body = [
                'action' => "create",
                'user_info' => [
                    'email' => $email,
                    'first_name' => $user->name,
                    'type' => 1
                ]
            ];


            $res = $this->zoomPost('users', $body);
             
            $res = json_decode($res->body(), true);
            
            if(isset($res['id']))
            {
                    $user->zoom_id = $res['id'];
            $user->zoom_email = $email;
            $user->save();

            return $data = [
                'message' => 'You have been associated with Ipersona Zoom portol.However, check your email inbox to accept invitation.'
            ];
            }
            
            return $data = ['message' => 'This email is already exist plz use another'];
        

        }

        return $data = [
            'message' => 'You have already linked with Zoom.'
        ];



    }

   public function zoomGet(string $path, array $body = [])
    {
        $request = $this->zoomRequest();
        return $request->get(config('zoom.base_url') . $path, $body);
    }

    /**
     * Display a zoomPost.
     *
     * @return \Illuminate\Http\Response
     */
    public function zoomPost(string $path, array $body = [])
    {
        $request = $this->zoomRequest();
        return $request->post(config('zoom.base_url') . $path, $body);
    }
    
    
    
    
    
    




}
