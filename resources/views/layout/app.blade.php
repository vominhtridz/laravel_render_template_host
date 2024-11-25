<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="../../../public/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- link to config tailwind css  -->
    @vite('resources/css/app.css')
    <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <!-- ckeditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>


    <style>
        a{
            color:#444 !important;
           text-decoration-line: none !important;
            padding: 4px;
        }
    
        /* Scrollbar Styling */
        .active-link {
            background-color: #374151; /* Đậm hơn khi đang active */
        }

    </style>
</head>
<body id="app">
    @include('components.header')
    <div class="">
        @include('components.sidebar')
        <div class="w-full pl-64 pt-[74px] pr-4 h-full ">
             @yield('content')
        </div>
    </div>
    @include('config.configJsToast')
</body>
<script>
        // Initialize CKEditor
        ClassicEditor
        .create(document.querySelector('textarea'))
        .then(editor => {
        console.log('Editor was initialized', editor);
        })
        .catch(error => {
         console.error('Error during initialization of the editor', error);
        });
    </script>
</html>