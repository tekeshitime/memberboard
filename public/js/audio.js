var aud = {
    // (A) INITIALIZE PLAYER
    player: null, // html <audio> element
    playlist: null, // html playlist
    now: 0, // current song
    init: () => {
        // (A1) GET HTML ELEMENTS
        aud.player = document.getElementById("demoAudio");
        aud.playlist = document.querySelectorAll("#demoList .song");

        // (A2) LOOP THROUGH ALL THE SONGS, CLICK TO PLAY
        for (let i = 0; i < aud.playlist.length; i++) {
            aud.playlist[i].onclick = () => aud.play(i);
        }

        // (A3) AUTO PLAY WHEN SUFFICIENTLY LOADED
        aud.player.oncanplay = aud.player.play;

        // (A4) AUTOPLAY NEXT SONG IN PLAYLIST WHEN CURRENT SONG ENDS
        aud.player.onended = () => {
            aud.now++;
            if (aud.now >= aud.playlist.length) {
                aud.now = 0;
            }
            aud.play(aud.now);
        };
    },
};
window.addEventListener("DOMContentLoaded", aud.init);

// (B) START PLAYING
aud.play = (id) => {
    // (B1) UPDATE CURRENT & PLAY
    aud.now = id; // aud オブジェクトの now プロパティを更新
    aud.player.src = "audio/" + aud.playlist[id].dataset.src; // aud オブジェクトの player プロパティの src を更新

    // (B2) A LITTLE BIT OF COSMETIC
    for (let i = 0; i < aud.playlist.length; i++) {
        if (i == id) {
            aud.playlist[i].classList.add("now"); // aud オブジェクトの playlist 配列の i 番目の要素に "now" クラスを追加
        } else {
            aud.playlist[i].classList.remove("now"); // aud オブジェクトの playlist 配列の i 番目の要素から "now" クラスを削除
        }
    }
};
