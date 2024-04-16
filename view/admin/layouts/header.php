<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
</head>
<style>
    .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }

    trix-toolbar [data-trix-button-group="file-tools"] {
        display: none;
    }

    .card {
        width: 250px;
        height: 100px;
        border-radius: 15px;
        background: rgba(245, 40, 145, 0.8);
        /* Mengubah warna latar belakang menjadi ungu gelap dengan opasitas */
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: "";
        height: 100px;
        width: 100px;
        position: absolute;
        top: -40%;
        left: -20%;
        border-radius: 50%;
        border: 35px solid rgba(255, 255, 255, 0.1);
        transition: all .8s ease;
        filter: blur(.5rem);
    }

    .text {
        flex-grow: 1;
        padding: 15px;
        display: flex;
        flex-direction: column;
        color: #fff;
        /* Mengubah warna teks menjadi putih */
        font-weight: 900;
        font-size: 1.2em;
        justify-content: center;
    }

    .subtitle {
        font-size: .9em;
        font-weight: 500;
        color: rgba(240, 248, 255, 0.691);
    }

    .card:hover::before {
        width: 140px;
        height: 140px;
        top: -30%;
        left: 50%;
        filter: blur(0rem);
    }
</style>

<body>
    <div class="container-fluid">
        <div class="d-flex">