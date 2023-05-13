<footer class="footer">
    <div class="container">
        <div class="footer-body">
            <div class="footer-left">
                <img src="{{asset('images/Logo.svg')}}" alt="" width="160" height="95">
{{--                <img src="{{asset('images/Logo.svg')}}" alt="" width="102" height="45">--}}
            </div>

            <div class="footer-center-block">
                <div class="footer-center">
                    <div class="connect">
                        Егер сізде қандай да бір сұрақтар болса, бізбен байланысыңыз:
                    </div>
                    <div class="menu-items">
                        <div class="phones">
                            <img src="{{asset('images/call.svg')}}" alt="">
                            <a href="tel:77783648876">
                                +7 (778) 364-88-76
                            </a>
                        </div>
                    </div>
                </div>
            </div>
			
			<div class="footer-center-block">
                <div class="footer-center">
                    <div class="connect">
                        Әлеуметтік желілер
                    </div>
                    <div class="menu-items social">
                        <div class="phones">
                            <a href="tel:77783648876">
                                <img class="whimg" src="{{asset('images/whatsapp.png')}}" alt="">
                            </a>
                            <a href="tel:77783648876">
                                <img class="whimg" src="{{asset('images/instagram.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @guest
                <div class="footer-right">
                    <button class="default-btn" onclick="openLogin(this)">
                        <img src="{{asset('images/usericon.svg')}}" alt="">
                        Кіру/Тіркелу
                    </button>
                </div>
            @endguest

        </div>
    </div>
</footer>
