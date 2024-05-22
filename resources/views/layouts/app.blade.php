<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    <script src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <title>MoCU sports and events management system</title>
  </head>
  <style>
    #loader {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9998;
    }
    a.disabled {
        pointer-events: none;
        color: #6c757d;
    }
  </style>
  <body>
    <div id="overlay"></div>
    <div id="loader">
        <img src="{{asset('assets/images/mocu.webp')}}" width="300" height="300" alt="Loading...">
    </div>
    @include('layouts.nav')
    @include('layouts.sidebar')

    <main class="mt-5 pt-3">
      @yield('content')
    </main>

    @stack('modals')
    <script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    @stack('scripts')
    @if (session()->has('success'))
        <script>
            var notyf = new Notyf({dismissible: true, duration: 3000, position: {x: 'right', y: 'top'}, types: [{ type: 'success', background: '#00b894', icon: { className: 'fas fa-check', tagName: 'span', color: '#fff' }, dismissible: true, duration: 3000, }]})
            notyf.success('{{ session('success') }}')
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            var notyf = new Notyf({dismissible: true, duration: 3000, position: {x: 'right', y: 'top'}, types: [{ type: 'error', background: '#ff7675', icon: { className: 'fas fa-times', tagName: 'span', color: '#fff' }, dismissible: true, duration: 3000, }]})
            notyf.error('{{ session('error') }}')
        </script>
    @endif

    <script>
        /* Simple Alpine Image Viewer */
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageViewer', (src = '') => {
                return {
                    imageUrl: src,

                    refreshUrl() {
                        this.imageUrl = this.$el.getAttribute("image-url")
                    },

                    fileChosen(event) {
                        this.fileToDataUrl(event, src => this.imageUrl = src)
                    },

                    fileToDataUrl(event, callback) {
                        if (!event.target.files.length) return

                        let file = event.target.files[0],
                            reader = new FileReader()

                        reader.readAsDataURL(file)
                        reader.onload = e => callback(e.target.result)
                    },
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#loader, #overlay').show();

            $(window).on('load', function() {
                $('#loader, #overlay').hide();
            });

            // Fallback in case the window load event does not fire
            setTimeout(function() {
                $('#loader, #overlay').hide();
            }, 5000);

            $('#update-form').on('submit', function(event) {
                $('#loader, #overlay').show();
            });
        });
    </script>
  </body>
</html>
