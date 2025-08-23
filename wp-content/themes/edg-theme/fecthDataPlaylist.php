<?php
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

    <h2 class="playlist-message">Émission tous les Mercredis à 12H sur <a href="https://www.twitch.tv/mk_rza" target="_blank">la chaîne Twitch de RZA</a> !</h2>
</div>
