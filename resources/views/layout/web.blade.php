<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/web.css') }}">
</head>
<script>

function toggleProfile() {

    let dropdown = document.getElementById("profileDropdown");

    if(dropdown.style.display === "block"){
        dropdown.style.display = "none";
    }else{
        dropdown.style.display = "block";
    }

}

function toggleAIChat(){

let chat = document.getElementById("aiChatbox");

if(chat.style.display === "flex"){
chat.style.display = "none";
}else{
chat.style.display = "flex";
}

}

/* KIRIM PESAN */

function sendMessage(){

let input = document.getElementById("aiInput");

let message = input.value;

if(message === "") return;

let chat = document.getElementById("aiMessages");

/* PESAN USER */

let userMessage = document.createElement("div");

userMessage.classList.add("ai-message","user-message");

userMessage.innerText = message;

chat.appendChild(userMessage);

/* RESPON AI (sementara) */

let aiMessage = document.createElement("div");

aiMessage.classList.add("ai-message");

aiMessage.innerText = "AI sedang berpikir tentang ide fashion kamu...";

chat.appendChild(aiMessage);

chat.scrollTop = chat.scrollHeight;

input.value="";

}

</script>
<body>
<nav class="navbar">

    <!-- LOGO -->
    <div class="logo">
        <span class="logo-box">LapakLama</span>
    </div>


    <!-- MENU -->
    <ul class="nav-menu">

        <li><a href="{{ route('main') }}">Home</a></li>
        <li><a href="{{ route('jual') }}">Jual</a></li>
        <li><a href="{{ route('beli') }}">Beli</a></li>
        <li><a href="{{ route('daurulang') }}">Recycle</a></li>
        <li><a href="#">About</a></li>

    </ul>

    <!-- ICON -->
    <div class="nav-icons">

        <!-- AI BUTTON -->
        <!-- AI ICON -->
<i class="bi bi-stars ai-icon" onclick="toggleAIChat()"></i>

<!-- AI CHAT BOX -->
<div class="ai-chatbox" id="aiChatbox">

    <div class="ai-header">
        <span>AI Fashion Assistant</span>
        <i class="bi bi-x" onclick="toggleAIChat()"></i>
    </div>

    <div class="ai-messages" id="aiMessages">

        <!-- pesan awal -->
        <div class="ai-message">
            Halo! Saya bisa membantu ide daur ulang baju 👕
        </div>

    </div>

    <div class="ai-input">
        <input type="text" id="aiInput" placeholder="Tanya tentang outfit atau daur ulang...">
        <button onclick="sendMessage()">Kirim</button>
    </div>

</div>
        <i class="bi bi-bag"></i>
        <div class="profile-menu">

        <i class="bi bi-person-circle profile-icon" onclick="toggleProfile()"></i>

        <!-- DROPDOWN CARD -->
        <div class="profile-dropdown" id="profileDropdown">

            <a href="/profile">
                <i class="bi bi-pencil-square"></i> Edit Profile
            </a>

            <a href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

        </div>

    </div>

    </div>
    </div>

</nav>

<!-- CONTENT -->
<div class="content">

    <main class="main-content">
        @yield('content')
    </main>

</div>
<section class="about-section">
    <h2>Tentang Lapaklama</h2>
    <div class="about-content">
        <p>Lapaklama adalah platform jual beli baju bekas yang memudahkan kamu untuk menjual atau membeli baju bekas berkualitas.</p>
        <p>Kamu juga bisa mendaur ulang baju lama menjadi fashion baru.</p>
        <p>Bersama Lapaklama kita membantu mengurangi limbah fashion.</p>
    </div>
</section>

<footer class="footer">
    <p>&copy; 2024 Lapaklama. All rights reserved.</p>
</footer>

<script>

const recycleSlider = document.querySelector('.recycle-slider');

if(recycleSlider){

    const leftBtn = document.querySelector('.recycle-btn.left');
    const rightBtn = document.querySelector('.recycle-btn.right');

    if(leftBtn){
        leftBtn.onclick = function(){
            recycleSlider.scrollLeft -= 300;
        }
    }

    if(rightBtn){
        rightBtn.onclick = function(){
            recycleSlider.scrollLeft += 300;
        }
    }

}

</script>

</body>
</html>