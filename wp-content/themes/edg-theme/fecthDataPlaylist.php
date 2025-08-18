<?php

// /**
//  * Sample PHP code for youtube.playlistItems.list
//  * See instructions for running these code samples locally:
//  * https://developers.google.com/explorer-help/code-samples#php
//  */

// if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
//     throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
// }
// require_once __DIR__ . '/vendor/autoload.php';

// /*
// * https://github.com/googleapis/google-api-php-client/issues/1095
// */
// use Google\Service\YouTube;

// $client = new Google_Client();
// $client->setApplicationName('API code samples');
// $client->setScopes([
//     'https://www.googleapis.com/auth/youtube.readonly',
// ]);

// // TODO: For this request to work, you must replace
// // "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
// // client_secret.json file. For more information, see
// // https://cloud.google.com/iam/docs/creating-managing-service-account-keys
// $client->setAuthConfig('YOUR_CLIENT_SECRET_FILE.json');
// $client->setAccessType('offline');

// // Request authorization from the user.
// $authUrl = $client->createAuthUrl();
// printf("Open this link in your browser:\n%s\n", $authUrl);
// print('Enter verification code: ');
// $authCode = trim(fgets(STDIN));

// // Exchange authorization code for an access token.
// $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
// $client->setAccessToken($accessToken);

// // Define service object for making API requests.
// $service = new Youtube($client);

// $queryParams = [
//     'maxResults' => 25,
//     'playlistId' => 'PLqHZBWnF55De2NsaYa1BQhRomP3OXrWKX'
// ];

// $response = $service->playlistItems->listPlaylistItems('snippet,contentDetails', $queryParams);
// print_r($response);

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

/*
* https://github.com/googleapis/google-api-php-client/issues/1095
*/

use Google\Service\YouTube;

$apiKey = 'AIzaSyAHfIMc9gSCJk4C8UO-gE2N_knLuOHLJSw';
$client = new Google_Client();
$client->setDeveloperKey($apiKey);
$service = new Youtube($client);

$nextPageToken = null;
$videos = [];
$idPlaylistYoutube = 'PLBr12FP1TO5i3ubwbkzRxIkYGs2bwHlFP'; // l'id de la playist Youtube

while (!isset($response) || $nextPageToken != null) {
    $response = $service->playlistItems->listPlaylistItems(
        'snippet',
        [
            'playlistId' => $idPlaylistYoutube,
            'pageToken' => $nextPageToken,
            'maxResults' => 50,
        ]
    );

    $nextPageToken = $response->$nextPageToken ?? null;
    $videos = array_merge($videos, $response->items);
}

// dump($response);
?>

<div class="playlist-container">
    <div id="playlist">
        <div id="video-dis">
            <iframe id="display-frame" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <div id="v-list" class="video-li">
            <div id="vli-info">
                <div id="upper-info">
                    <div id="li-titles">
                        <div class="title">L'École du Gameplay - L'émission</div>
                        <div class="sub-title">
                            <!-- <a href="https://www.youtube.com/@mkrza5959" class="channel">MK RZA</a>
                            - -->
                            <span id="video-count">1 / 2</span>
                        </div>
                    </div>
                    <!-- <div id="drop-icon"></div> -->
                </div>
                <!-- <div id="lower-info">
                <div id="btn-repeat"></div>
                <div id="btn-suffle"></div>
                <div id="btn-save"></div>
            </div> -->
            </div>

            <div id="vli-videos">

                <?php foreach ($videos as $video):
                    $idVideo = "https://www.youtube.com/embed/" . $video->snippet->resourceId->videoId . "?si=0Rb1TylvP0fcLhKs";



                    $titleVideo = $video->snippet->title;
                    $ownerVideo = $video->snippet->videoOwnerChannelTitle;
                    $idChannel = "https://www.youtube.com/channel/" . $video->snippet->channelId;

                    if ($video->snippet->resourceId->videoId !== null) {
                ?>
                        <div class="video-con active-con" video=<?php echo $idVideo; ?>>
                            <div class="index title">0</div>
                            <div class="thumb">
                                <img src=<?php echo $video->snippet->thumbnails->standard->url; ?> alt=<?php echo $video->snippet->title; ?>>
                            </div>
                            <div class="v-titles">
                                <div class="title"><?php echo $titleVideo; ?></div>
                                <div class="sub-title">
                                    <a href=<?php echo $idChannel; ?> class="channel" target="_blank"><?php echo $ownerVideo; ?></a>
                                </div>
                            </div>
                        </div>
                <?php }
                endforeach; ?>

            </div>

        </div>
    </div>
</div>
