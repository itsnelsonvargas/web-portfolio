<?php

namespace App\Services;

class GoogleDriveService
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $accessToken;
    private $folderId;

    public function __construct()
    {
        $this->clientId = config('services.google.client_id');
        $this->clientSecret = config('services.google.client_secret');
        $this->redirectUri = config('services.google.redirect_uri');
        $this->folderId = config('services.google.drive_folder_id');
    }

    /**
     * Get the authorization URL
     */
    public function getAuthUrl()
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => 'https://www.googleapis.com/auth/drive.readonly',
            'access_type' => 'offline',
            'prompt' => 'consent'
        ];

        return 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($params);
    }

    /**
     * Exchange authorization code for access token
     */
    public function getAccessToken($code)
    {
        $url = 'https://oauth2.googleapis.com/token';

        $data = [
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code'
        ];

        $response = $this->makeRequest($url, 'POST', $data);

        if (isset($response['access_token'])) {
            $this->accessToken = $response['access_token'];

            // Store in session
            session(['google_access_token' => $response['access_token']]);
            if (isset($response['refresh_token'])) {
                session(['google_refresh_token' => $response['refresh_token']]);
            }

            return $response;
        }

        return null;
    }

    /**
     * Refresh the access token
     */
    public function refreshAccessToken($refreshToken)
    {
        $url = 'https://oauth2.googleapis.com/token';

        $data = [
            'refresh_token' => $refreshToken,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'refresh_token'
        ];

        $response = $this->makeRequest($url, 'POST', $data);

        if (isset($response['access_token'])) {
            $this->accessToken = $response['access_token'];
            session(['google_access_token' => $response['access_token']]);
            return $response['access_token'];
        }

        return null;
    }

    /**
     * List files in the specified Google Drive folder
     */
    public function listFiles()
    {
        // Try to get access token from session
        if (!$this->accessToken) {
            $this->accessToken = session('google_access_token');
        }

        if (!$this->accessToken) {
            return ['error' => 'No access token available'];
        }

        $url = 'https://www.googleapis.com/drive/v3/files';

        $params = [
            'q' => "'{$this->folderId}' in parents and trashed=false",
            'fields' => 'files(id,name,mimeType,modifiedTime,size,webViewLink,iconLink,thumbnailLink)',
            'orderBy' => 'name'
        ];

        $url .= '?' . http_build_query($params);

        $response = $this->makeAuthenticatedRequest($url);

        if (isset($response['error'])) {
            // Try to refresh token if we have a refresh token
            $refreshToken = session('google_refresh_token');
            if ($refreshToken) {
                $newToken = $this->refreshAccessToken($refreshToken);
                if ($newToken) {
                    // Retry the request
                    $response = $this->makeAuthenticatedRequest($url);
                }
            }
        }

        return $response;
    }

    /**
     * Make an authenticated request to Google API
     */
    private function makeAuthenticatedRequest($url, $method = 'GET', $data = null)
    {
        $ch = curl_init($url);

        $headers = [
            'Authorization: Bearer ' . $this->accessToken,
            'Content-Type: application/json'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $result = json_decode($response, true);

        if ($httpCode !== 200) {
            return ['error' => $result ?? 'Request failed', 'http_code' => $httpCode];
        }

        return $result;
    }

    /**
     * Make a request (for non-authenticated endpoints)
     */
    private function makeRequest($url, $method = 'GET', $data = null)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            }
        }

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    /**
     * Set access token manually
     */
    public function setAccessToken($token)
    {
        $this->accessToken = $token;
        session(['google_access_token' => $token]);
    }
}
