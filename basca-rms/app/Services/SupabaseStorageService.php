<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseStorageService
{
    protected string $url;
    protected string $serviceKey;
    protected string $bucket;

    public function __construct()
    {
        $this->url = rtrim(env('SUPABASE_URL'), '/');
        $this->serviceKey = env('SUPABASE_SERVICE_KEY', '');
        $this->bucket = env('SUPABASE_BUCKET', 'senior-documents');
    }

    public function upload(string $filename, string $contents, ?string $mimeType = null): bool
    {
        if (empty($this->serviceKey)) {
            Log::error('Supabase upload skipped: SUPABASE_SERVICE_KEY is not configured.');
            return false;
        }

        $endpoint = $this->url . '/storage/v1/object/' . $this->bucket . '/' . ltrim($filename, '/');

        $response = Http::withHeaders([
            'apikey' => $this->serviceKey,
            'Authorization' => 'Bearer ' . $this->serviceKey,
        ])->withBody($contents, $mimeType ?: 'application/octet-stream')
          ->withoutVerifying()
          ->post($endpoint);

        if ($response->successful()) {
            return true;
        }

        Log::error('Supabase upload failed', [
            'status' => $response->status(),
            'body' => $response->body(),
            'endpoint' => $endpoint,
        ]);

        return false;
    }

    public function delete(string $filename): bool
    {
        if (empty($this->serviceKey)) {
            return false;
        }

        $endpoint = $this->url . '/storage/v1/object/' . $this->bucket . '/' . ltrim($filename, '/');

        $response = Http::withHeaders([
            'apikey' => $this->serviceKey,
            'Authorization' => 'Bearer ' . $this->serviceKey,
        ])->withoutVerifying()
          ->delete($endpoint);

        return $response->successful() || $response->status() === 404;
    }

    public function getPublicUrl(string $filename): string
    {
        return $this->url . '/storage/v1/object/public/' . $this->bucket . '/' . ltrim($filename, '/');
    }
}
