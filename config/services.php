<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],


    'facebook' => [
     'client_id' => '2161344750835948',
     'client_secret' => 'c27afe7f76c3270b25b83a98d5313e5f',
     'redirect' => 'https://hfrtechnologies.com/dev/lost_found/callback/facebook',
 ],

 'google' => [
    'client_id' => '873543926325-udevflp43hakmmh7pi8fa4i7qq869ggk.apps.googleusercontent.com',
    'client_secret' => 'sZqwl6VwWQGSAkV8wzt4jenM',
    'redirect' => 'https://hfrtechnologies.com/dev/lost_found/auth/google/callback',
],

'twitter' => [
   'client_id' => 'hLB7cGY6HpcnPQ8inREuWFpbp',
   'client_secret' => 'VeBXecBtHFjW9W1Nl8ZXE1smKruuublkWYgHk7hSxKkm63GtMt',
   'redirect' => 'https://hfrtechnologies.com/dev/lost_found/callback/twitter',
],

];
