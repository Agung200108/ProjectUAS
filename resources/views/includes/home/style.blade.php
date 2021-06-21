<link rel="stylesheet" href="{{asset('css/app.css')}}">
<style>
    .gradient {
        background-image: linear-gradient(-225deg, #6a38f2 0%, #24d7dd 100%);
    }

    .gradient2 {
        background-color: #86e3f3;
        background-image: linear-gradient(315deg, #69ffd2 0%, #4bdeff 74%);
        /* color: white; */
    }

    .browser-mockup {
        border-top: 2em solid rgba(230, 230, 230, 0.7);
        position: relative;
        height: 60vh;
    }

    .browser-mockup:before {
        display: block;
        position: absolute;
        content: "";
        top: -1.25em;
        left: 1em;
        width: 0.5em;
        height: 0.5em;
        border-radius: 50%;
        background-color: rgb(68, 134, 255);
        box-shadow: 0 0 0 2px rgb(68, 174, 255), 1.5em 0 0 2px rgb(51, 71, 187), 3em 0 0 2px rgb(93, 85, 255);
    }

    .browser-mockup>* {
        display: block;
    }

</style>