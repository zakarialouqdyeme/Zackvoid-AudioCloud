<?php
require_once(dirname(__FILE__) . "/" . '../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php echo Config::$websiteName ?> - Home
    </title>
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>
<div id="playlist">
<select v-on:change = "playlistChanged($event)" id="selectPlaylist">
<option v-for = "data in getPlaylists()" v-bind:value = "data.index">{{data.name}}</option>
</select>

<!-- Blue Playlist Container -->
<div id="blue-playlist-container">

<!-- Amplitude Player -->
<div id="amplitude-player">

    <!-- Left Side Player -->
    <div id="amplitude-left">
        <img data-amplitude-song-info="cover_art_url" class="album-art"/>
<div class="amplitude-visualization" id="large-visualization">

</div>
        <div id="player-left-bottom">
            <div id="time-container">
                <span class="current-time">
                    <span class="amplitude-current-minutes" ></span>:<span class="amplitude-current-seconds"></span>
                </span>
                <div id="progress-container">
                    <div class="amplitude-wave-form">

            </div>
    <input type="range" class="amplitude-song-slider"/>
                    <progress id="song-played-progress" class="amplitude-song-played-progress"></progress>
                    <progress id="song-buffered-progress" class="amplitude-buffered-progress" value="0"></progress>
                </div>
                <span class="duration">
                    <span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
                </span>
            </div>

            <div id="control-container">
               <!--  <div id="repeat-container">
                    <div class="amplitude-repeat" id="repeat"></div>
                    <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
                </div> -->

                <div id="central-control-container">
                    <div id="central-controls">
                        <div class="amplitude-prev" id="previous"></div>
                        <div class="amplitude-play-pause" id="play-pause"></div>
                        <div class="amplitude-next" id="next"></div>
                    </div>
                </div>

                <div id="volume-container">
                    <div class="volume-controls">
                        <div class="amplitude-mute amplitude-not-muted"></div>
                        <input type="range" class="amplitude-volume-slider"/>
                        <div class="ms-range-fix"></div>
                    </div>
                    <!-- <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle-right"></div> -->
                </div>
            </div>

            <div id="meta-container">
                <span data-amplitude-song-info="name" class="song-name"></span>

                <div class="song-artist-album">
                    <span data-amplitude-song-info="artist"></span>
                    <span data-amplitude-song-info="album"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Left Side Player -->

    <!-- Right Side Player -->
   
    <div id="amplitude-right"> 
        <div class="song amplitude-song-container amplitude-play-pause" v-for="data in getTracks()" v-bind:data-amplitude-song-index="data.index" v-on:click="playTrack(data.index)">
            <div class="song-now-playing-icon-container">
                <div class="play-button-container">

                </div>
                <img class="now-playing" src="https://521dimensions.com/img/open-source/amplitudejs/blue-player/now-playing.svg"/>
            </div>
            <div class="song-meta-data">
                <span class="song-title">{{data.name}}</span>
                <span class="song-artist">{{data.album}}</span>
            </div>
            <!-- <a href="https://switchstancerecordings.bandcamp.com/track/risin-high-feat-raashan-ahmad" class="bandcamp-link" target="_blank">
                <img class="bandcamp-grey" src="https://521dimensions.com/img/open-source/amplitudejs/blue-player/bandcamp-grey.svg"/>
                <img class="bandcamp-white" src="https://521dimensions.com/img/open-source/amplitudejs/blue-player/bandcamp-white.svg"/>
            </a> -->
           <!--  <span class="song-duration">3:30</span> -->
        </div>
       
    </div>
    
    <!-- End Right Side Player -->
</div>
<!-- End Amplitdue Player -->

</div>
</div>

    <script src="lib/jquery-3.6.0.js"></script>
    <script src="https://unpkg.com/vue/dist/vue.min.js"></script>
    <script src="lib/amplitude.js"></script>
    <script src="scripts/main.js"></script>
</body>
</html>