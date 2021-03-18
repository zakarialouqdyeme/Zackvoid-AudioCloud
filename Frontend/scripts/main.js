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

    let requestInit = {
        credentials: 'include',
        method: 'get',
    };

    let vm = new Vue({
        el: "#amplitude-right",
        data: { Tracks: [] },
        methods: {
            updateTracks: async function (item) {
                this.Tracks.splice(0);
                this.Tracks = item;
                if (item == null) {
                    this.Tracks = [];
                }

            },
            getTracks: function () {

                return this.Tracks;

            },
            playTrack: function (e) {
                initAmplitude();
                Amplitude.playSongAtIndex(e);

            }
        }
    });

    let playlistSelected = 1;
    let tracksArray = [];
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

    await loadTracksData();
    await vm.updateTracks(tracksArray);
    initAmplitude();
    Amplitude.playSongAtIndex(0);



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

                /* if (!this.classList.contains('amplitude-active-song-container')) {
                    this.querySelectorAll('.play-button-container')[0].style.display = 'block';
                } else {
                    this.querySelectorAll('.play-button-container')[0].style.display = 'none';
                } */

                this.querySelectorAll('img.bandcamp-grey')[0].style.display = 'none';
                this.querySelectorAll('img.bandcamp-white')[0].style.display = 'block';
                this.querySelectorAll('.song-duration')[0].style.color = '#FFFFFF';
            });

            /*
                Ensure that on mouseout, CSS styles don't get messed up for active songs.
            */
            songElements[i].addEventListener('mouseout', function () {
                this.style.backgroundColor = '#FFFFFF';
                this.querySelectorAll('.song-meta-data .song-title')[0].style.color = '#272726';
                this.querySelectorAll('.song-meta-data .song-artist')[0].style.color = '#607D8B';
                this.querySelectorAll('.play-button-container')[0].style.display = 'none';
                this.querySelectorAll('img.bandcamp-grey')[0].style.display = 'block';
                this.querySelectorAll('img.bandcamp-white')[0].style.display = 'none';
                this.querySelectorAll('.song-duration')[0].style.color = '#607D8B';
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
        //document.getElementById('large-visualization').style.height = document.getElementById('album-art').offsetWidth + 'px';
    }


    async function fetchPlaylistsData() {
        let data = await fetch(url, requestInit);
        return data.json();
    }
});