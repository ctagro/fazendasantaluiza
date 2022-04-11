<x-app-layout layout="simple">
<span class="uisheet screen-darken"></span>
    <div class="header" style="background-color:  #faf2e3; background-size: cover; background-repeat: no-repeat; height: 100vh;position: relative;">
        <div class="main-img">
            <div class="container">
                <img class="" src="{{ asset('images/logo/logo_fazenda_santa_luisa_vetor_1.svg')}}"  style="height: 300px; width: 500px;"alt="Logo" >
                <!--      <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                        <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                        <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                        <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                      </svg>
                      <h4 class="logo-title">Hope UI</h4>
                    -->
                <h1 class="my-4">
                    <span>Hope UI - Design System</span>
                </h1>
                <h4 class="text-green mb-5">Production ready FREE Open Source <b>Dashboard UI Kit</b> and <b>Design System</b>.</h4>
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <a class="btn btn-light bg-white" href="{{route('dashboard')}}">Dashboard Demo</a>
                    </div>
                    <div class="ms-3">
                        <a class="btn btn-light bg-white" href="#components">UI KIT</a>
                    </div>
                    <div class="ms-3">
                        <a class="btn btn-light bg-white"  href="{{route('plantetc.dashboard')}}">Plant.etc.br</a>
                    </div>
                </div>

            </div>

        </div>
        <div class="container">
            <nav class="nav navbar navbar-expand-lg navbar-light top-1 rounded">
                <div class="container-fluid">
                    <a class="navbar-brand mx-2" href="#">
                        <img class="" src="{{ asset('images/logo/logo_fazenda_santa_luisa_vetor_1.svg')}}"  style="height: 50px; width: 100px;"alt="Logo" >
                        <!--      <svg width="30" class="text-primary" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                              </svg>
                              <h4 class="logo-title">Hope UI</h4>
                            -->
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-2" aria-controls="navbar-2" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-2">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-start">
                            <li class="nav-item me-3">
                                <a class="nav-link" aria-current="page" href="{{route('plantetc.dashboard')}}" target="_blank">Entrar</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
      
    
</x-app-layout>

