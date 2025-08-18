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

while (!isset($response) || $nextPageToken != null) {
    $response = $service->playlistItems->listPlaylistItems(
        'snippet',
        [
            'playlistId' => 'PLitZkRNNn1LhLK-5UQQG7cDvA5VdKHKLa',
            'pageToken' => $nextPageToken,
            'maxResults' => 50,
        ]
    );

    $nextPageToken = $response->$nextPageToken ?? null;
    $videos = array_merge($videos, $response->items);
}

dump($videos);

// $video = $response->items[0]->snippet;

// dump($response);

foreach ($videos as $video):
    $idVideo = "https://www.youtube.com/embed/" . $video->snippet->resourceId->videoId . "?si=0Rb1TylvP0fcLhKs";
?>
    <iframe
        width="560"
        height="315"
        src=<?php echo $idVideo; ?>
        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

<?php endforeach; ?>



<!--
    Icon Images are coming from my github account.
    Thumbnail images are coming directly from youtube.

    Visit the behance project to see the behind the sences
    // link will be shared soon

    Please leave a love!
-->

<div id="playlist">

    <div id="video-dis">
        <iframe id="display-frame" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div id="v-list" class="video-li">

        <div id="vli-info">
            <div id="upper-info">
                <div id="li-titles">
                    <div class="title">Web Development Videos</div>
                    <div class="sub-title">
                        <a href="https://www.youtube.com/channel/UCD7RHHe-SuFiTWEsC0S1dLg" class="channel">Rejwan Islam</a>
                        -
                        <span id="video-count">1 / 2</span>
                    </div>
                </div>
                <div id="drop-icon"></div>
            </div>
            <div id="lower-info">
                <div id="btn-repeat"></div>
                <div id="btn-suffle"></div>
                <div id="btn-save"></div>
            </div>
        </div>

        <div id="vli-videos">
            <div class="video-con active-con" video="https://www.youtube.com/embed/BVyTt3QJfIA">
                <div class="index title">0</div>
                <div class="thumb">
                    <img src="https://i.ytimg.com/vi/BVyTt3QJfIA/hqdefault.jpg?sqp=-oaymwEbCKgBEF5IVfKriqkDDggBFQAAiEIYAXABwAEG&rs=AOn4CLDNZqTQuBOTuGgLFnsrstzTBdJhgg" alt="">
                </div>
                <div class="v-titles">
                    <div class="title">Google chrome custom new tab</div>
                    <div class="sub-title">
                        <a href="https://www.youtube.com/channel/UCD7RHHe-SuFiTWEsC0S1dLg" class="channel" target="_blank">Rejwan Islam</a>
                    </div>
                </div>
            </div>

            <div class="video-con" video="https://www.youtube.com/embed/O-D1VsX7J4s">
                <div class="index title">0</div>
                <div class="thumb">
                    <img src="https://i.ytimg.com/vi/O-D1VsX7J4s/hqdefault.jpg?sqp=-oaymwEbCKgBEF5IVfKriqkDDggBFQAAiEIYAXABwAEG&rs=AOn4CLAmbtXY8Fuq9TWBwe9KPru9q6nnyg" alt="">
                </div>
                <div class="v-titles">
                    <div class="title">Awesome Periodic Table using Html and Css</div>
                    <div class="sub-title">
                        <a href="https://www.youtube.com/channel/UCD7RHHe-SuFiTWEsC0S1dLg" class="channel" target="_blank">Rejwan Islam</a>
                    </div>
                </div>
            </div>

            <div class="video-con" video="https://www.youtube.com/embed/glqWxsQmY3U">
                <div class="index title">0</div>
                <div class="thumb">
                    <img src="https://i.ytimg.com/vi/glqWxsQmY3U/hqdefault.jpg?sqp=-oaymwEbCKgBEF5IVfKriqkDDggBFQAAiEIYAXABwAEG&rs=AOn4CLA32gZV0D42Si70gSXZ3B4Aoz4P1w" alt="">
                </div>
                <div class="v-titles">
                    <div class="title">JavaScript Debugging - Android Button Effect</div>
                    <div class="sub-title">
                        <a href="https://www.youtube.com/channel/UCD7RHHe-SuFiTWEsC0S1dLg" class="channel" target="_blank">Rejwan Islam</a>
                    </div>
                </div>
            </div>

            <div class="video-con" video="https://www.youtube.com/embed/Eg4hPSMRtds">
                <div class="index title">0</div>
                <div class="thumb">
                    <img src="https://i.ytimg.com/vi/Eg4hPSMRtds/hqdefault.jpg?sqp=-oaymwEbCKgBEF5IVfKriqkDDggBFQAAiEIYAXABwAEG&rs=AOn4CLBrnuS1go5YalWfku7pWWqScHvkkQ" alt="">
                </div>
                <div class="v-titles">
                    <div class="title">Calculator: Parallel and series resistance</div>
                    <div class="sub-title">
                        <a href="https://www.youtube.com/channel/UCD7RHHe-SuFiTWEsC0S1dLg" class="channel" target="_blank">Rejwan Islam</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
