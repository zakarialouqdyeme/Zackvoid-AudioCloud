$(document).ready(async () => {

    Array.prototype.next = function () {
        return this[this.current++];
    };
    Array.prototype.prev = function () {
        return this[this.current--];
    };
    Array.prototype.reset = function () {
        this.current = 0;
    };
    Array.prototype.current = 0;

    const url = "http://127.0.0.1:8080/Zackvoid%20AudioCloud/api/Playlists.php";

    let playlistSelected = 0;
    let tracksArray = [];
    let playlistsArray = [];

    let requestInit = {
        credentials: 'include',
        method: 'get',
    };


    let vm = new Vue({
        el: "#playlist",
        data: { Tracks: [], Playlists: [] },
        methods: {
            updateTracks: async function (item) {
                this.Tracks.splice(0);
                this.Tracks = item;
                if (item == null) {
                    this.Tracks = [];
                }

            },
            updatePlaylists: async function (item) {
                this.Playlists.splice(0);
                this.Playlists = item;
                if (item == null) {
                    this.Playlists = [];
                }

            },
            getTracks: function () {

                return this.Tracks;

            },
            getPlaylists: function () {

                return this.Playlists;

            },
            playTrack: function (e) {
                // initAmplitude();
                Amplitude.skipTo(0, e, playlist = null);
                Amplitude.playSongAtIndex(e);

            },
            playlistChanged: function (event) {
                playlistSelected = event.target.value;
                Amplitude.stop();
                initAll();
            }
        }
    });


    async function loadTracksData() {

        let data = await fetchPlaylistsData();
        for (let i = 0; i < data[playlistSelected].tracks[0].length; i++) {
            let currentTrackData = {
                "name": `${data[playlistSelected].tracks[0][i].title}`,
                "album": `${data[playlistSelected].name}`,
                "url": 'http://' + `${data[playlistSelected].tracks[0][i].url}`,
                "cover_art_url": 'data:image/png;base64,' + `${data[playlistSelected].tracks[0][i].image}`,
                "duration": ``,
            };
            tracksArray.push(currentTrackData);
        }

    }
    async function loadPlaylistsData() {

        let data = await fetchPlaylistsData();
        for (let i = 0; i < data.length; i++) {
            let currentTrackData = {
                "name": `${data[i].name}`,
                "index": `${i}`,
            };
            playlistsArray.push(currentTrackData);
        }
    }

    vm.updatePlaylists(null);
    await loadPlaylistsData();
    await vm.updatePlaylists(playlistsArray);
    initAll();

    async function initAll() {
        vm.updateTracks(null);
        await loadTracksData();
        await vm.updateTracks(tracksArray);
        initAmplitude();
        Amplitude.playSongAtIndex(0);
    }

    function initAmplitude() {
        let bandcampLinks = document.getElementsByClassName('bandcamp-link');

        for (var i = 0; i < bandcampLinks.length; i++) {
            bandcampLinks[i].addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }


        let songElements = document.getElementsByClassName('song');

        for (var i = 0; i < songElements.length; i++) {
            /*
                Ensure that on mouseover, CSS styles don't get messed up for active songs.
            */
            songElements[i].addEventListener('mouseover', function () {
                this.style.backgroundColor = '#00A0FF';

                this.querySelectorAll('.song-meta-data .song-title')[0].style.color = '#FFFFFF';
                this.querySelectorAll('.song-meta-data .song-artist')[0].style.color = '#FFFFFF';
            });

            /*
                Ensure that on mouseout, CSS styles don't get messed up for active songs.
            */
            songElements[i].addEventListener('mouseout', function () {
                this.style.backgroundColor = '#FFFFFF';
                this.querySelectorAll('.song-meta-data .song-title')[0].style.color = '#272726';
                this.querySelectorAll('.song-meta-data .song-artist')[0].style.color = '#607D8B';
                this.querySelectorAll('.play-button-container')[0].style.display = 'none';

            });

            /*
                Show and hide the play button container on the song when the song is clicked.
            */
            $($(".song")[0]).removeClass("amplitude-song-container");
            $($(".song")[0]).addClass("amplitude-active-song-container");
            $(".song").click(function (e) {

                $('.play-button-container')[0].style.display = 'none';
                $(".song").removeClass("amplitude-active-song-container");
                $(e.currentTarget).addClass("amplitude-active-song-container");
            });

        }

        /*
            Initializes AmplitudeJS
        */
        Amplitude.init({
            "songs": tracksArray,
            "callbacks": {
                'play': function () {
                    document.getElementById('album-art').style.visibility = 'hidden';
                    document.getElementById('large-visualization').style.visibility = 'visible';
                },

                'pause': function () {
                    document.getElementById('album-art').style.visibility = 'visible';
                    document.getElementById('large-visualization').style.visibility = 'hidden';
                },
                'next': function () {
                    $(".song").removeClass("amplitude-active-song-container");
                    $($(".song")).removeClass("amplitude-song-container");
                    $($(".song")[Amplitude.getActiveSongMetadata().index]).addClass("amplitude-active-song-container");

                },
                'prev': function () {
                    $(".song").removeClass("amplitude-active-song-container");
                    $($(".song")).removeClass("amplitude-song-container");
                    $($(".song")[Amplitude.getActiveSongMetadata().index]).addClass("amplitude-active-song-container");
                }
            },
            waveforms: {
                sample_rate: 50
            },

        });
    }


    async function fetchPlaylistsData() {
        let data = await fetch(url, requestInit);
        return data.json();
    }

});