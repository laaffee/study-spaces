<?php
include "./config/config.php";
require_once 'auth/check.php';

$currentPage = basename($_SERVER['PHP_SELF']);
$editMode = false;
$id = "";
$list = "";

if (isset($_GET['edit'])) {
  $editMode = true;
  $id = intval($_GET['edit']);

  $result = mysqli_query($con, "SELECT * FROM todo WHERE id='$id'");

  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $list = $data['list'];
  }
}

$rawData = mysqli_query($con, "SELECT * FROM todo ORDER BY id DESC");

// Ambil data profile user jika login
$profile_name = 'Guest';
$profile_email = '';
if (isset($_SESSION['username'])) {
  $u = mysqli_real_escape_string($con, $_SESSION['username']);
  $q = mysqli_query($con, "SELECT name, email FROM users WHERE username = '$u' LIMIT 1");
  if ($q && mysqli_num_rows($q) > 0) {
    $user = mysqli_fetch_assoc($q);
    $profile_name = $user['name'];
    $profile_email = $user['email'];
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">

  <title>Study Spaces</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <script src="https://kit.fontawesome.com/ede70cc9f6.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>


<body>
  <div class="page-shell">
    <div class="decor-pill" aria-hidden="true"></div>

    <img class="hero-background" src="assets/img/bg.gif" alt="Study spaces background">

    <div class="side-actions">
      <a href="#bgr" class="icon-link" aria-label="Change background"><i class="fa-solid fa-image"></i></a>
      <a href="#timer" class="icon-link" aria-label="Timer"><i class="fa-solid fa-clock"></i></a>
      <a href="#sound" class="icon-link" aria-label="Sound"><i class="fa-solid fa-volume-up"></i></a>
      <a href="#music" class="icon-link" aria-label="Music"><i class="fa-solid fa-music"></i></a>
      <a href="#todolist" class="icon-link" aria-label="To do list"><i class="fa-solid fa-pen-to-square"></i></a>
    </div>

    <div class="top-actions">
      <a href="#profile" class="menu-btn btn1" aria-label="Profile">
        <i class="fa-regular fa-user"></i>
      </a>
      <a href="./feedback/comments_page.php" class="menu-btn btn2" aria-label="Feedback">
        <i class="fa-brands fa-gratipay"></i>
      </a>
      <a href="#share" class="menu-btn btn3" aria-label="Share">
        <i class="fa-solid fa-share-nodes"></i>
      </a>
      <a href="#contactus" class="menu-btn btn4" aria-label="Contact">
        <i class="fa-regular fa-comment"></i>
      </a>
      <a href="#"
        class="menu-btn logout-btn"
        aria-label="Logout"
        onclick="confirmLogout(event)">

        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span>Logout</span>

      </a>
    </div>

    <div class="contactus" id="contactus">

      <div class="contactus_inside">

        <a href="#" class="contactus_close">&times;</a>

        <div class="contactus_header">

          <div class="contactus_icon">
            <i class="fa-solid fa-headset"></i>
          </div>

          <h2>Contact Us</h2>

          <p>
            We'd love to hear from you. Feel free to contact us anytime.
          </p>

        </div>

        <div class="contact_list">

          <div class="contact_item">
            <div class="contact_icon">
              <i class="fa-solid fa-location-dot"></i>
            </div>

            <div class="contact_info">
              <h3>Office Address</h3>
              <p>
                Cisarua Bogor
              </p>
            </div>
          </div>

          <div class="contact_item">
            <div class="contact_icon">
              <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="contact_info">
              <h3>Email</h3>
              <p>rullaaliyahzulfa@gmail.com</p>
            </div>
          </div>

          <div class="contact_item">
            <div class="contact_icon">
              <i class="fa-solid fa-phone"></i>
            </div>

            <div class="contact_info">
              <h3>Phone</h3>
              <p>0895365587630</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <div class="profile" id="profile">

      <div class="profile_inside">

        <a href="#" class="profile_close">&times;</a>

        <div class="profile_header">

          <div class="profile_avatar">
            <img src="assets/img/avatar.png" alt="User Avatar">
          </div>

          <h2>User Profile</h2>
          <p>Your personal information</p>

        </div>

        <div class="profile_detail">
          <div class="btn_profile">
            <i class="fa-solid fa-id-card"></i>
            User Details
          </div>
        </div>

        <div class="profile_text">

          <div class="profile_row">
            <span class="label">
              <i class="fa-solid fa-user"></i>
              Name
            </span>

            <span class="value">
              <?php echo htmlspecialchars($profile_name); ?>
            </span>
          </div>

          <div class="profile_row">
            <span class="label">
              <i class="fa-solid fa-envelope"></i>
              Email
            </span>

            <span class="value">
              <?php echo htmlspecialchars($profile_email); ?>
            </span>
          </div>

        </div>

      </div>

    </div>

    <div class="sound" id="sound">

      <div class="sound_inside">

        <a href="#" class="sound_close">&times;</a>

        <div class="sound_header">
          <h2>🎧 Ambient Sounds</h2>
          <p>Pick a relaxing sound to help you focus while studying.</p>
        </div>

        <div class="sound_items">

          <!-- Rain -->
          <div class="sound_item">

            <div class="sound_icon">🌧️</div>

            <div class="sound_content">

              <h3>Rain</h3>
              <span>Relaxing Rain</span>

              <div class="player">

                <button class="play-btn">
                  <i class="fa-solid fa-play"></i>
                </button>

                <div class="player-right">

                  <input
                    type="range"
                    class="progress"
                    value="0"
                    min="0"
                    max="100">

                  <div class="player-info">
                    <span class="current">00:00</span>
                    <span class="duration">00:00</span>
                  </div>

                </div>

              </div>

              <audio class="sound-audio" loop>
                <source src="assets/audio/wsweb.mp3" type="audio/mpeg">
              </audio>

            </div>

          </div>

          <!-- Fire -->
          <div class="sound_item">

            <div class="sound_icon">🔥</div>

            <div class="sound_content">

              <h3>Fire Crackling</h3>
              <span>Fireplace Ambience</span>

              <div class="player">

                <button class="play-btn">
                  <i class="fa-solid fa-play"></i>
                </button>

                <div class="player-right">

                  <input
                    type="range"
                    class="progress"
                    value="0"
                    min="0"
                    max="100">

                  <div class="player-info">
                    <span class="current">00:00</span>
                    <span class="duration">00:00</span>
                  </div>

                </div>

              </div>

              <audio class="sound-audio" loop>
                <source src="assets/audio/fireweb.mp3" type="audio/mpeg">
              </audio>

            </div>

          </div>

          <!-- Water -->
          <div class="sound_item">

            <div class="sound_icon">🌊</div>

            <div class="sound_content">

              <h3>Water</h3>
              <span>Flowing Water</span>

              <div class="player">

                <button class="play-btn">
                  <i class="fa-solid fa-play"></i>
                </button>

                <div class="player-right">

                  <input
                    type="range"
                    class="progress"
                    value="0"
                    min="0"
                    max="100">

                  <div class="player-info">
                    <span class="current">00:00</span>
                    <span class="duration">00:00</span>
                  </div>

                </div>

              </div>

              <audio class="sound-audio" loop>
                <source src="assets/audio/nature.mp3" type="audio/mpeg">
              </audio>

            </div>

          </div>

        </div>

      </div>

    </div>


    <div class="music" id="music">
      <div class="music_inside">

        <a href="#" class="music_close">&times;</a>

        <div class="music-header">
          <div class="music-icon">
            🎵
          </div>

          <div>
            <h2>Music Player</h2>
            <p>Relax while studying</p>
          </div>
        </div>

        <div class="music-list">

          <div class="music-card" data-video="hpFvN4uwIPc">
            <div class="music-info">
              <h3>Soft</h3>
              <p>Lany</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="_nRzDvk1Yrg">
            <div class="music-info">
              <h3>Prettiest Thing I've Ever Seen</h3>
              <p>Lany</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="BZ-rLBkUZf4">
            <div class="music-info">
              <h3>All Too Well </h3>
              <p>Taylor Swift</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="fU_ZrS15WpM">
            <div class="music-info">
              <h3>Enchanted</h3>
              <p>Taylor Swift</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="DCcAtJ1PuEU">
            <div class="music-info">
              <h3>Olivia Rodrigo - traitor</h3>
              <p>Official Video</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="bzRMneypG04">
            <div class="music-info">
              <h3>Coldplay - Fix You</h3>
              <p>Official Video</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="1vrEljMfXYo">
            <div class="music-info">
              <h3>John Denver - Take Me Home</h3>
              <p>Country Roads</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="ErmgY5GX_wI">
            <div class="music-info">
              <h3>NIKI - La La Lost You</h3>
              <p>Official Video</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

          <div class="music-card" data-video="FjHGZj2IjBk">
            <div class="music-info">
              <h3>Meditation - Monoman</h3>
              <p>Meditation</p>
            </div>

            <button class="play-btn">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>

        </div>

        <div id="player"></div>

      </div>
    </div>

  </div>
  </div>


  <div class="bgr" id="bgr">

    <div class="bgr_inside">

      <a href="#" class="bgr_close">&times;</a>

      <div class="bgr_header">

        <div class="bgr_icon">
          <i class="fa-solid fa-image"></i>
        </div>

        <h2>Change Background</h2>

        <p>
          Choose your favorite background theme.
        </p>

      </div>

      <div class="background_grid">

        <a href="firecrackling.php" class="background_card">

          <img src="assets/img/bg1.gif" alt="Background 1">

          <span>Fire Crackling</span>

        </a>

        <a href="rain.php" class="background_card">

          <img src="assets/img/bg2.gif" alt="Background 2">

          <span>Rain</span>

        </a>

        <a href="workspace.php" class="background_card">

          <img src="assets/img/bg3.gif" alt="Background 3">

          <span>Workspace</span>

        </a>

        <a href="index.php" class="background_card">

          <img src="assets/img/bg.gif" alt="Home">

          <span>Home</span>

        </a>

      </div>

    </div>

  </div>

  <div class="share" id="share">
    <div class="share_inside">

      <a href="#" class="share_close">&times;</a>

      <div class="share_header">
        <div class="share_icon">
          <i class="fa-solid fa-share-nodes"></i>
        </div>

        <h2>Share Study Spaces</h2>

        <p>
          Copy the invitation link and share it with your friends.
        </p>
      </div>

      <div class="share_box">

        <input
          type="text"
          id="text"
          class="text"
          value="https://study.invitellaaa.my.id"
          readonly>

        <button
          id="copyBtn"
          class="btn_copy"
          type="button"
          onclick="copyText()">

          <i class="fa-solid fa-copy"></i>
          <span>Copy</span>

        </button>

      </div>

    </div>
  </div>

  <div class="todolist" id="todolist">
    <div class="todolist_inside">

      <a href="#" class="todolist_close">&times;</a>

      <div class="todolist_header">
        <h2>📝 To Do List</h2>
        <p class="text-white">Manage your tasks efficiently.</p>
      </div>

      <form action="<?php echo $editMode ? './todo/update.php' : './todo/insert.php'; ?>" method="POST" class="todolist_form">

        <?php if ($editMode) { ?>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <input type="hidden" name="return_to" value="<?php echo htmlspecialchars($currentPage . '#todolist'); ?>">

        <input
          type="text"
          name="list"
          class="todo_input"
          placeholder="Add a task..."
          value="<?php echo htmlspecialchars($list); ?>"
          required>

        <?php if ($editMode) { ?>

          <button class="todo_update" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>
            Update
          </button>

          <a href="<?php echo $currentPage; ?>#todolist" class="todo_cancel">
            <i class="fa-solid fa-xmark"></i>
            Cancel
          </a>

        <?php } else { ?>

          <button class="todo_add" type="submit">
            <i class="fa-solid fa-plus"></i>
            Add
          </button>

        <?php } ?>

      </form>

      <div class="todolist_list">

        <?php while ($row = mysqli_fetch_array($rawData)) { ?>

          <div class="todolist_item">

            <div class="todo_text">
              <?php echo htmlspecialchars($row['list']); ?>
            </div>

            <div class="todolist_actions">

              <a href="<?php echo $currentPage; ?>?edit=<?php echo $row['id']; ?>#todolist" class="edit_btn">
                <i class="fa-solid fa-pen"></i>
              </a>

              <a href="./todo/delete.php?id=<?php echo $row['id']; ?>&return_to=<?php echo urlencode($currentPage . '#todolist'); ?>" class="delete_btn">
                <i class="fa-solid fa-trash"></i>
              </a>

            </div>

          </div>

        <?php } ?>

      </div>

    </div>
  </div>

  <div class="timer" id="timer">
    <div class="timer_inside">

      <a href="#" class="timer_close">&times;</a>

      <div class="timer_header">
        <div class="timer_icon">
          🍅
        </div>

        <h2>Pomodoro Timer</h2>
      </div>

      <div class="pomodoro">

        <div class="timer_card">
          <div class="progress-container">

            <svg class="progress-ring" viewBox="0 0 260 260">

              <circle
                class="bg-circle"
                cx="130"
                cy="130"
                r="110">
              </circle>

              <circle
                id="progressCircle"
                class="progress-circle"
                cx="130"
                cy="130"
                r="110">
              </circle>

            </svg>

            <div class="timer-text">
              <h2 id="mode">Study</h2>
              <div id="time">25:00</div>
            </div>

          </div>
        </div>

        <div class="mode-button">

          <button id="studyBtn">
            <i class="fa-solid fa-book-open"></i>
            Study
          </button>

          <button id="breakBtn">
            <i class="fa-solid fa-mug-hot"></i>
            Break
          </button>

        </div>

        <div class="control">

          <button id="startBtn">
            <i class="fa-solid fa-play"></i>
            Start
          </button>

          <button id="pauseBtn">
            <i class="fa-solid fa-pause"></i>
            Pause
          </button>

          <button id="resetBtn">
            <i class="fa-solid fa-rotate-left"></i>
            Reset
          </button>

        </div>

        <div class="setting">

          <!-- Study -->
          <div class="input-group">
            <label>Study</label>

            <div class="time-input">
              <button class="minus" data-target="studyInput">−</button>

              <input
                type="text"
                id="studyInput"
                value="25"
                readonly>

              <button class="plus" data-target="studyInput">+</button>
            </div>

            <span class="text-white">minutes</span>
          </div>

          <!-- Break -->
          <div class="input-group">
            <label>Break</label>

            <div class="time-input">
              <button class="minus" data-target="breakInput">−</button>

              <input
                type="text"
                id="breakInput"
                value="5"
                readonly>

              <button class="plus" data-target="breakInput">+</button>
            </div>

            <span class="text-white">minutes</span>
          </div>

        </div>

      </div>

    </div>
  </div>

  <script>
    function copyText() {

      const text = document.getElementById("text").value;
      const btn = document.getElementById("copyBtn");

      navigator.clipboard.writeText(text)
        .then(() => {

          btn.innerHTML = `
                <i class="fa-solid fa-check"></i>
                <span>Copied</span>
            `;

          setTimeout(() => {
            btn.innerHTML = `
                    <i class="fa-solid fa-copy"></i>
                    <span>Copy</span>
                `;
          }, 2000);

        })
        .catch(() => {
          alert("Failed to copy.");
        });

    }
  </script>

  <!-- Pomodoro Timer -->
  <script>
    const studyInput = document.getElementById("studyInput");
    const breakInput = document.getElementById("breakInput");

    const time = document.getElementById("time");
    const mode = document.getElementById("mode");

    const progress = document.getElementById("progressCircle");

    const startBtn = document.getElementById("startBtn");
    const pauseBtn = document.getElementById("pauseBtn");
    const resetBtn = document.getElementById("resetBtn");

    const studyBtn = document.getElementById("studyBtn");
    const breakBtn = document.getElementById("breakBtn");

    let duration = studyInput.value * 60;
    let current = duration;

    let interval;

    let currentMode = "study";

    const radius = 110;
    const circumference = 2 * Math.PI * radius;

    progress.style.strokeDasharray = circumference;

    function updateDisplay() {

      let m = Math.floor(current / 60);
      let s = current % 60;

      time.innerHTML =
        String(m).padStart(2, "0") + ":" +
        String(s).padStart(2, "0");

      let percent = current / duration;

      progress.style.strokeDashoffset =
        circumference - (percent * circumference);

    }

    updateDisplay();

    function playBeep(freq, time) {

      const ctx = new(window.AudioContext || window.webkitAudioContext)();

      const osc = ctx.createOscillator();

      const gain = ctx.createGain();

      osc.frequency.value = freq;

      osc.connect(gain);

      gain.connect(ctx.destination);

      osc.start();

      gain.gain.exponentialRampToValueAtTime(
        0.0001,
        ctx.currentTime + time
      );

      osc.stop(ctx.currentTime + time);

    }

    function startTimer() {

      clearInterval(interval);

      interval = setInterval(() => {

        if (current <= 0) {

          clearInterval(interval);

          playBeep(500, .4);
          setTimeout(() => playBeep(700, .4), 300);
          setTimeout(() => playBeep(900, .4), 600);

          return;
        }

        current--;
        updateDisplay();

        if (current === 30) playBeep(900, .25);
        if (current === 20) playBeep(900, .25);
        if (current === 10) playBeep(900, .25);

      }, 1000);

    }

    startBtn.onclick = startTimer;

    pauseBtn.onclick = () => {

      clearInterval(interval);

    };

    resetBtn.onclick = () => {

      clearInterval(interval);

      if (currentMode == "study") {

        duration = studyInput.value * 60;

      } else {

        duration = breakInput.value * 60;

      }

      current = duration;

      updateDisplay();

    };

    studyBtn.onclick = () => {

      clearInterval(interval);

      currentMode = "study";

      mode.innerHTML = "Study";

      duration = studyInput.value * 60;

      current = duration;

      updateDisplay();

    };

    breakBtn.onclick = () => {

      clearInterval(interval);

      currentMode = "break";

      mode.innerHTML = "Break";

      duration = breakInput.value * 60;

      current = duration;

      updateDisplay();

    };

    studyInput.onchange = () => {

      if (currentMode == "study") {

        duration = studyInput.value * 60;

        current = duration;

        updateDisplay();

      }

    };

    breakInput.onchange = () => {

      if (currentMode == "break") {

        duration = breakInput.value * 60;

        current = duration;

        updateDisplay();

      }

    };
  </script>

  <script>
    document.querySelectorAll(".plus").forEach(btn => {

      btn.addEventListener("click", () => {

        const input = document.getElementById(btn.dataset.target);

        const max = input.id === "studyInput" ? 90 : 60;

        let value = parseInt(input.value);

        if (value < max) {

          input.value = value + 1;

        }

        if (currentMode === "study" && input.id === "studyInput") {

          duration = input.value * 60;
          current = duration;
          updateDisplay();

        }

        if (currentMode === "break" && input.id === "breakInput") {

          duration = input.value * 60;
          current = duration;
          updateDisplay();

        }

      });

    });


    document.querySelectorAll(".minus").forEach(btn => {

      btn.addEventListener("click", () => {

        const input = document.getElementById(btn.dataset.target);

        let value = parseInt(input.value);

        if (value > 1) {

          input.value = value - 1;

        }

        if (currentMode === "study" && input.id === "studyInput") {

          duration = input.value * 60;
          current = duration;
          updateDisplay();

        }

        if (currentMode === "break" && input.id === "breakInput") {

          duration = input.value * 60;
          current = duration;
          updateDisplay();

        }

      });

    });
  </script>

  <script>
    const audios = document.querySelectorAll("audio");

    audios.forEach(audio => {

      audio.loop = true;

      audio.addEventListener("play", () => {

        audios.forEach(otherAudio => {

          if (otherAudio !== audio) {
            otherAudio.pause();
            otherAudio.currentTime = 0;
          }

        });

      });

    });
  </script>

  <script>
    const players = document.querySelectorAll(".sound_item");

    players.forEach(player => {

      const audio = player.querySelector("audio");

      const playBtn = player.querySelector(".play-btn");

      const progress = player.querySelector(".progress");

      const current = player.querySelector(".current");

      const duration = player.querySelector(".duration");

      function format(sec) {

        let m = Math.floor(sec / 60);

        let s = Math.floor(sec % 60);

        return String(m).padStart(2, "0") + ":" + String(s).padStart(2, "0");

      }

      audio.addEventListener("loadedmetadata", () => {

        duration.innerHTML = format(audio.duration);

      });

      playBtn.onclick = () => {

        document.querySelectorAll(".sound-audio").forEach(other => {

          if (other !== audio) {

            other.pause();

            other.closest(".sound_item")
              .querySelector(".play-btn").innerHTML =
              '<i class="fa-solid fa-play"></i>';

          }

        });

        if (audio.paused) {

          audio.play();

          playBtn.innerHTML = '<i class="fa-solid fa-pause"></i>';

        } else {

          audio.pause();

          playBtn.innerHTML = '<i class="fa-solid fa-play"></i>';

        }

      };

      audio.ontimeupdate = () => {

        current.innerHTML = format(audio.currentTime);

        progress.value = (audio.currentTime / audio.duration) * 100;

      };

      progress.oninput = () => {

        audio.currentTime = (progress.value / 100) * audio.duration;

      };

      audio.onended = () => {

        playBtn.innerHTML = '<i class="fa-solid fa-play"></i>';

      };

    });
  </script>


  <script src="https://www.youtube.com/iframe_api"></script>

  <script>
    let player;
    let currentCard = null;
    let currentButton = null;
    let currentVideo = "";

    function onYouTubeIframeAPIReady() {

      player = new YT.Player("player", {
        height: "0",
        width: "0",
        videoId: "",
        playerVars: {
          autoplay: 0,
          controls: 0
        },
        events: {
          onStateChange: onPlayerStateChange
        }
      });

    }

    document.querySelectorAll(".music-card").forEach(card => {

      const btn = card.querySelector(".play-btn");

      btn.addEventListener("click", function(e) {

        e.stopPropagation();

        const videoId = card.dataset.video;

        if (currentVideo === videoId && player.getPlayerState() === YT.PlayerState.PLAYING) {

          player.pauseVideo();

          btn.innerHTML = '<i class="fa-solid fa-play"></i>';

          return;
        }

        // Jika lagu yang sama sedang pause
        if (currentVideo === videoId && player.getPlayerState() === YT.PlayerState.PAUSED) {

          player.playVideo();

          btn.innerHTML = '<i class="fa-solid fa-pause"></i>';

          return;
        }

        // Reset semua tombol
        document.querySelectorAll(".music-card .play-btn").forEach(button => {
          button.innerHTML = '<i class="fa-solid fa-play"></i>';
        });

        currentCard = card;
        currentButton = btn;
        currentVideo = videoId;

        player.loadVideoById(videoId);

        btn.innerHTML = '<i class="fa-solid fa-pause"></i>';

      });

    });

    function onPlayerStateChange(event) {

      if (!currentButton) return;

      if (event.data === YT.PlayerState.PLAYING) {

        currentButton.innerHTML = '<i class="fa-solid fa-pause"></i>';

      }

      if (
        event.data === YT.PlayerState.PAUSED ||
        event.data === YT.PlayerState.ENDED
      ) {

        currentButton.innerHTML = '<i class="fa-solid fa-play"></i>';

      }

    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmLogout(event) {

      event.preventDefault();

      Swal.fire({
        title: 'Log Out?',
        text: 'Are you sure you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6C63FF',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Log Out',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true
      }).then((result) => {

        if (result.isConfirmed) {

          Swal.fire({
            title: 'Logged Out',
            text: 'See you again!',
            icon: 'success',
            timer: 1200,
            showConfirmButton: false
          }).then(() => {
            window.location.href = "./auth/logout.php";
          });

        }

      });

    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.querySelectorAll('.delete_btn').forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();

        const deleteUrl = this.getAttribute('href');

        Swal.fire({
          title: 'Are you sure?',
          text: 'Do you really want to delete this task?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#e74c3c',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'Cancel',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = deleteUrl;
          }
        });
      });
    });
  </script>
</body>

</html>